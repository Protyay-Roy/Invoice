<?php

namespace App\Http\Controllers;

use App\Models\Bank;
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
        }else{
            $banks = new Bank;
            $message = 'Bank added successfully!';
        }

        $banks->name = $request->name;
        $banks->account_number = $request->account_number;
        $banks->branch = $request->branch;
        $banks->info = $request->info;
        $banks->save();

        return back()->with('success_message', $message);
    }


    public function updateBank($id)
    {
        $banks = Bank::find($id);
        return response()->json([
            'status' => 200,
            'banks' => $banks
        ]);
    }

    public function destroy($id)
    {
        $banks = Bank::find($id)->delete();
        return back()->with('success_message', "Bank deleted succssfully!");
    }
}
