<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Transection;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function createSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:ledgers,email,' . $request->update_id,
            'address' => 'required',
            'phone' => 'required|numeric',
            'company_name' => 'required',
            'info' => 'required',
        ]);

        if ($request->update_id != null) {
            $ledgers = Ledger::find($request->update_id);
            $message = 'Supplier update successfully!';
            $transections = Transection::where('ledger_id', $request->update_id)->first();
            if ($transections == null) {
                $transections_id = null;
                $transections = new Transection;
            } else {
                $transections_id = $transections->id;
            }
        } else {
            $ledgers = new Ledger;
            $message = 'Supplier added successfully!';
            $transections = new Transection;
            $transections_id = null;
        }
        $ledgers->type = 2;
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
            if (!empty($request->debit || $request->credit)) {
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

    public function updateSupplier($id)
    {
        $ledgers = Ledger::find($id);
        $transections = Transection::where('ledger_id', $id)->first();
        return response()->json([
            'status' => 200,
            'ledgers' => $ledgers,
            'transections' => $transections
        ]);
    }

    public function viewSupplier($id)
    {
        $ledgers = Ledger::find($id);
        $transections = Transection::where('ledger_id', $id)->get();
        $debit = 0;
        $credit = 0;
        $balance = 0;
        $total_balance = 0;
        foreach ($transections as $transection) {
            $debit += $transection->debit;
            $credit += $transection->credit;
            $balance = $debit - $credit;
        }
        return view('view_supplier', compact('ledgers', 'transections', 'debit', 'credit', 'balance', 'total_balance'));
    }

    public function destroy($id)
    {
        $transections = Transection::where('ledger_id', $id)->delete();
        $ledgers = Ledger::find($id)->delete();
        return back()->with('success_message', "Supplier deleted succssfully!");
    }
}
