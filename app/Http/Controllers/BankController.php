<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_transection;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function createBank(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required',
            'branch' => 'required',
            'info' => 'required',
        ]);
        if ($request->update_id != null){
            $banks = Bank::find($request->update_id);
            $message = 'Bank update successfully!';
            $bank_transections = Bank_transection::where('bank_id', $request->update_id)->first();
            if ($bank_transections == null) {
                $transections_id = null;
                $bank_transections = new Bank_transection;
            } else {
                $transections_id = $bank_transections->id;
            }
        }else{
            $banks = new Bank;
            $message = 'Bank added successfully!';
            $bank_transections = new Bank_transection;
            $transections_id = null;
        }

        $banks->name = $request->name;
        $banks->account_number = $request->account_number;
        $banks->branch = $request->branch;
        $banks->info = $request->info;
        $banks->save();

        if ($transections_id != null) {
            $bank_transections->entry_date = date("d-m-Y");
            $bank_transections->debit = $request->debit;
            $bank_transections->credit = $request->credit;
            $bank_transections->save();
        } else {
            if (!empty($request->debit || $request->credit)) {
                $bank_transections->bank_id = $banks->id;
                $bank_transections->entry_date = date("d-m-Y");
                $bank_transections->debit = $request->debit;
                $bank_transections->credit = $request->credit;
                $bank_transections->type = 'OPENING BALANCE';
                $bank_transections->note = 'N/A';
                $bank_transections->save();
            }
        }

        return back()->with('success_message', $message);
    }


    public function updateBank($id)
    {
        // $banks = ;
        return response()->json([
            'status' => 200,
            'banks' => Bank::find($id),
            'bank_transections' => Bank_transection::where('bank_id', $id)->first()
        ]);
    }

    public function viewBank($id)
    {
        $bank = Bank::find($id);
        $bank_transection = Bank_transection::where(['bank_id' => $id, 'type' => 'OPENING BALANCE'])->first();
        return view('view_bank', compact('bank','bank_transection'));
    }

    public function destroy($id)
    {
        Bank_transection::where('bank_id', $id)->delete();
        $banks = Bank::find($id)->delete();
        return back()->with('success_message', "Bank deleted succssfully!");
    }
}
