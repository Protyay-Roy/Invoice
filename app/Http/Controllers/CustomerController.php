<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Transection;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request, $id = null)
    {
        // dd($request->id);



        // die;
        // $request->validate([
        //     'name' => 'required',
        //     // 'email' => 'required|email|unique:table,column,except,id',
        //     'email' => 'required|email|unique:ledgers,email',
        //     'address' => 'required',
        //     'phone' => 'required|numaric',
        //     'phone' => 'required',
        //     'info' => 'required',
        // ]);

        if ($request->update_id != null) {
            $ledgers = Ledger::find($request->update_id);
            $message = 'Customer update successfully!';
            $transections = Transection::where('ledger_id', $ledgers->id)->first();
        } else {
            $ledgers = new Ledger;
            $message = 'Customer added successfully!';
            $transections = new Transection;
        }
        // dd($transections->id);
        // echo '<pre>';
        // print_r($ledgers->id);
        // die;
        $ledgers->type = 1;
        $ledgers->name = ucwords($request->name);
        $ledgers->email = $request->email;
        $ledgers->address = ucwords($request->address);
        $ledgers->phone = $request->phone;
        $ledgers->company_name = $request->company_name;
        $ledgers->info = $request->info;
        $ledgers->save();

        if ($transections->id != null) {
            $transections->entry_date = now();
            $transections->debit = $request->debit;
            $transections->credit = $request->credit;
            $transections->save();
        } else {
            if (!empty($request->debit || $request->credit)) {

                $transections->ledger_id = $ledgers->id;
                $transections->bank_id = null;
                $transections->entry_date = now();
                $transections->debit = $request->debit;
                $transections->credit = $request->credit;
                $transections->type = 'Opening balance';
                $transections->note = 'N/A';
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

    public function destroy($id)
    {
        $ledgers = Ledger::find($id)->delete();
        return back()->with('success_message', "Customer deleted succssfully");
    }
}
