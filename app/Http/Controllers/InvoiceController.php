<?php

namespace App\Http\Controllers;

use App\Models\Invoice_item;
use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Ledger;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function createInvoice(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('post')) {
            $request->validate([
                'entry_date' => 'required',
                'ledger_id' => 'required',
                'subtotal' => 'required',
                'item.*' => 'required',
                'size.*' => 'required',
                'width.*' => 'required|numeric',
                'height.*' => 'required|numeric',
                'qty.*' => 'required|numeric',
                'rate.*' => 'required|numeric',
            ], [
                'ledger_id.required' => 'Please select Customer',
                'item.*.required' => 'Please enter the item name for all items.',
                'size.*.required' => 'Please enter the size for all items.',
                'width.*.required' => 'Please enter the width for all items.',
                'width.*.numeric' => 'The width must be a numeric value for all items.',
                'height.*.required' => 'Please enter the height for all items.',
                'height.*.numeric' => 'The height must be a numeric value for all items.',
                'qty.*.required' => 'Please enter the quantity for all items.',
                'qty.*.numeric' => 'The quantity must be a numeric value for all items.',
                'rate.*.required' => 'Please enter the rate for all items.',
                'rate.*.numeric' => 'The rate must be a numeric value for all items.',
            ]);

            $debit = 0;
            $credit = 0;
            if (is_numeric($request->subtotal)) {
                $debit = $request->subtotal;
            }
            if (is_numeric($request->credit)) {
                $credit = $request->credit;
            }

            $transections = new Transection;

            $transections->ledger_id = $request->ledger_id;
            $transections->entry_date = $request->entry_date;
            $transections->debit = $debit;
            $transections->credit = $credit;
            $transections->type = 'INVOICE';
            $transections->note = !empty($request->cheque) ? $request->cheque : 'N/A';
            $transections->calan = !empty($request->calan) ? $request->calan : 'N/A';
            $transections->bank_name = !empty($request->bank_name) ? $request->bank_name : 'N/A';
            $transections->save();

            foreach ($request->price as $key => $price) {
                $invoice_items = new Invoice_item;

                $invoice_items->transection_id = $transections->id;
                $invoice_items->item = $request->item[$key];
                $invoice_items->size = $request->size[$key];
                $invoice_items->width = $request->width[$key];
                $invoice_items->height = $request->height[$key];
                $invoice_items->square_ft = $request->square_ft[$key];
                $invoice_items->qty = $request->qty[$key];
                $invoice_items->total_square_ft = $request->total_square_ft[$key];
                $invoice_items->rate = $request->rate[$key];
                $invoice_items->price = $price;
                $invoice_items->entry_date = $request->entry_date;
                $invoice_items->save();
            }
            return redirect('/')->with('success_message', "Invoice items added succssfully!");
        }

        return view('create_invoice');
    }

    public function editInvoice(Request $request, $id)
    {
        $transections = Transection::with('getCustomer', 'getInvoiceItems')->find($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'entry_date' => 'required',
                'ledger_id' => 'required',
                'subtotal' => 'required',
                'item.*' => 'required',
                'size.*' => 'required',
                'width.*' => 'required|numeric',
                'height.*' => 'required|numeric',
                'qty.*' => 'required|numeric',
                'rate.*' => 'required|numeric',
            ], [
                'ledger_id.required' => 'Please select Customer',
                'item.*.required' => 'Please enter the item name for all items.',
                'size.*.required' => 'Please enter the size for all items.',
                'width.*.required' => 'Please enter the width for all items.',
                'width.*.numeric' => 'The width must be a numeric value for all items.',
                'height.*.required' => 'Please enter the height for all items.',
                'height.*.numeric' => 'The height must be a numeric value for all items.',
                'qty.*.required' => 'Please enter the quantity for all items.',
                'qty.*.numeric' => 'The quantity must be a numeric value for all items.',
                'rate.*.required' => 'Please enter the rate for all items.',
                'rate.*.numeric' => 'The rate must be a numeric value for all items.',
            ]);

            $pre_invoice_item = Invoice_item::where('transection_id', $id)->delete();

            $debit = 0;
            $credit = 0;
            if (is_numeric($request->subtotal)) {
                $debit = $request->subtotal;
            }
            if (is_numeric($request->credit)) {
                $credit = $request->credit;
            }

            $transections->ledger_id = $request->ledger_id;
            $transections->entry_date = $request->entry_date;
            $transections->debit = $debit;
            $transections->credit = $credit;
            $transections->type = 'INVOICE';
            $transections->note = !empty($request->cheque) ? $request->cheque : 'N/A';
            $transections->calan = !empty($request->calan) ? $request->calan : 'N/A';
            $transections->bank_name = $request->bank_name;
            $transections->save();



            foreach ($request->price as $key => $price) {
                $invoice_items = new Invoice_item;

                $invoice_items->transection_id = $transections->id;
                $invoice_items->item = $request->item[$key];
                $invoice_items->size = $request->size[$key];
                $invoice_items->width = $request->width[$key];
                $invoice_items->height = $request->height[$key];
                $invoice_items->square_ft = $request->square_ft[$key];
                $invoice_items->qty = $request->qty[$key];
                $invoice_items->total_square_ft = $request->total_square_ft[$key];
                $invoice_items->rate = $request->rate[$key];
                $invoice_items->price = $price;
                $invoice_items->entry_date = $request->entry_date;
                $invoice_items->save();
            }
            return redirect('/')->with('success_message', "Invoice items updated succssfully!");
        }

        return view('edit_invoice', compact('transections'));
    }

    public function viewInvoice($id)
    {
        $transections = Transection::with('getCustomer', 'getInvoiceItems')->find($id);
        return response()->json([
            'status' => 200,
            'transections' => $transections
        ]);
    }


    public function destroy($id)
    {
        Invoice_item::where('transection_id', $id)->delete();
        Transection::find($id)->delete();
        return back()->with('success_message', "Invoice deleted succssfully!");
    }


    public function downloadPDF($id)
    {
        $transections = Transection::with('getCustomer', 'getInvoiceItems')->where('id', $id)->first();
        $pdf = Pdf::loadView('download_pdf', [
            'transections' => $transections
        ]);
        // return view('download_pdf', compact('transections'));
        return $pdf->download('download_pdf.pdf');
    }
}
