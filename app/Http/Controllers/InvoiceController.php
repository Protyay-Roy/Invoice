<?php

namespace App\Http\Controllers;

use App\Models\Invoice_item;
use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Ledger;

class InvoiceController extends Controller
{
    public function createInvoice(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'entry_date' => 'required',
                'ledger_id' => 'required',
                'item' => 'required',
                'size' => 'required',
                'unit' => 'required',
                'width' => 'required',
                'height' => 'required',
                'square_ft' => 'required',
                'rate' => 'required',
                'price' => 'required',
                'subtotal' => 'required',
            ]);

            $transections = new Transection;

            $transections->ledger_id = $request->ledger_id;
            $transections->entry_date = $request->entry_date;
            $transections->debit = $request->subtotal;
            $transections->credit = $request->credit;
            $transections->type = 'INVOICE';
            $transections->note = $request->note;
            $transections->bank_name = $request->bank_name;
            $transections->save();

            foreach ($request->price as $key => $price) {
                $invoice_items = new Invoice_item;

                $invoice_items->transection_id = $transections->id;
                $invoice_items->item = $request->item[$key];
                $invoice_items->size = $request->size[$key];
                $invoice_items->unit = $request->unit[$key];
                $invoice_items->width = $request->width[$key];
                $invoice_items->height = $request->height[$key];
                $invoice_items->square_ft = $request->square_ft[$key];
                $invoice_items->rate = $request->rate[$key];
                $invoice_items->price = $price;
                $invoice_items->entry_date = $request->entry_date;
                $invoice_items->save();
            }
            return redirect('invoice')->with('success_message', "Invoice items added succssfully!");
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
                'item' => 'required',
                'size' => 'required',
                'unit' => 'required',
                'width' => 'required',
                'height' => 'required',
                'square_ft' => 'required',
                'rate' => 'required',
                'price' => 'required',
                'subtotal' => 'required',
            ]);

            $pre_invoice_item = Invoice_item::where('transection_id', $id)->delete();

            $transections->ledger_id = $request->ledger_id;
            $transections->entry_date = $request->entry_date;
            $transections->debit = $request->subtotal;
            $transections->credit = $request->credit;
            $transections->type = 'INVOICE';
            $transections->note = $request->note;
            $transections->bank_name = $request->bank_name;
            $transections->save();



            foreach ($request->price as $key => $price) {
                $invoice_items = new Invoice_item;

                $invoice_items->transection_id = $transections->id;
                $invoice_items->item = $request->item[$key];
                $invoice_items->size = $request->size[$key];
                $invoice_items->unit = $request->unit[$key];
                $invoice_items->width = $request->width[$key];
                $invoice_items->height = $request->height[$key];
                $invoice_items->square_ft = $request->square_ft[$key];
                $invoice_items->rate = $request->rate[$key];
                $invoice_items->price = $price;
                $invoice_items->entry_date = $request->entry_date;
                $invoice_items->save();
            }
            return redirect('invoice')->with('success_message', "Invoice items updated succssfully!");
        }

        return view('edit_invoice', compact('transections'));
    }



    public function destroy($id)
    {
        Invoice_item::where('transection_id', $id)->delete();
        Transection::find($id)->delete();
        return back()->with('success_message', "Invoice deleted succssfully!");
    }
}
