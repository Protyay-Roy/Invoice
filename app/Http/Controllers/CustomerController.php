<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Transection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:ledgers,email,' . $request->update_id,
            'address' => 'required',
            'phone' => 'required|numeric',
            'company_name' => 'required',
        ]);

        if ($request->update_id != null) {
            $ledgers = Ledger::find($request->update_id);
            $message = 'Customer update successfully!';
            $transections = Transection::where('ledger_id', $request->update_id)->first();
            if ($transections == null) {
                $transections_id = null;
                $transections = new Transection;
            } else {
                $transections_id = $transections->id;
            }
        } else {
            $ledgers = new Ledger;
            $message = 'Customer added successfully!';
            $transections = new Transection;
            $transections_id = null;
        }
        $ledgers->type = 1;
        $ledgers->name = ucwords($request->name);
        $ledgers->email = $request->email;
        $ledgers->address = ucwords($request->address);
        $ledgers->phone = $request->phone;
        $ledgers->company_name = $request->company_name;
        $ledgers->info = $request->info;
        $ledgers->save();

        if ($transections_id != null) {
            $transections->entry_date = date("d-m-Y");
            $transections->debit = $request->debit;
            $transections->credit = $request->credit;
            $transections->save();
        } else {
            if (!empty($request->debit) || !empty($request->credit)) {
                $transections->ledger_id = $ledgers->id;
                $transections->entry_date = date("d-m-Y");
                $transections->debit = $request->debit;
                $transections->credit = $request->credit;
                $transections->type = 'OPENING BALANCE';
                $transections->note = 'N/A';
                $transections->bank_name = null;
                $transections->save();
            }
        }

        return back()->with('success_message', $message);
    }

    public function updateCustomer($id)
    {
        $ledgers = Ledger::find($id);
        $transections = Transection::where('ledger_id', $id)->first();
        return response()->json([
            'status' => 200,
            'ledgers' => $ledgers,
            'transections' => $transections
        ]);
    }

    public function viewCustomer($id)
    {
        $ledgers = Ledger::find($id);
        $transections = Transection::where('ledger_id', $id);
        $total_balance = 0;
        $status = 'view';
        if (request()->ajax()) {
            $transections =
            // Transection::where('ledger_id', $id)
            $transections->when(request()->type == 'invoice', function ($query) {
                    return $query->where('type', 'INVOICE');
                })
                ->when(request()->type == 'payment', function ($query) {
                    return $query->where('type', 'PAYMENT');
                })
                ->when(!empty(request()->from) && !empty(request()->to), function ($query) {
                    return $query->whereBetween('entry_date', [request()->from, request()->to]);
                })
                ->get();
            return view('view_transection', compact('transections', 'total_balance', 'status'));
        }

        $transections = $transections->get();

        $debit = 0;
        $credit = 0;
        $balance = 0;
        foreach ($transections as $transection) {
            $debit += $transection->debit;
            $credit += $transection->credit;
            $balance = $debit - $credit;
        }
        return view('view_customer', compact('ledgers', 'transections', 'debit', 'credit', 'balance', 'total_balance', 'status'));
    }

    public function destroy($id)
    {
        $transections = Transection::where('ledger_id', $id)->delete();
        $ledgers = Ledger::find($id)->delete();
        return back()->with('success_message', "Customer deleted succssfully!");
    }

    public function downloadPDF($id)
    {
        $ledgers = Ledger::find($id);
        $transections = Transection::where('ledger_id', $id)->get();

        $total_balance = 0;
        $debit = 0;
        $credit = 0;
        $balance = 0;
        foreach ($transections as $transection) {
            $debit += $transection->debit;
            $credit += $transection->credit;
            $balance = $debit - $credit;
        }

        $pdf = Pdf::loadView('customer_pdf', [
            'transections' => $transections,
            'ledgers' => $ledgers,
            'total_balance' => $total_balance,
            'debit' => $debit,
            'credit' => $credit,
            'balance' => $balance,
        ]);
        return $pdf->download('customer_pdf.pdf');
    }
}
