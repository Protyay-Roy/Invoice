<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request, $id = null)
    {
        // dd($request->id);

        // $request->validate([
        //     'name' => 'required',
        //     // 'email' => 'required|email|unique:table,column,except,id',
        //     'email' => 'required|email|unique:ledgers,email',
        //     'address' => 'required',
        //     'phone' => 'required|numaric',
        //     'phone' => 'required',
        //     'info' => 'required',
        // ]);

        if($request->update_id != null){
            $ledgers = Ledger::find($request->update_id);
            $message = 'Customer update successfully!';
            // dd($ledgers);
        }else{
            $ledgers = new Ledger;
            $message = 'Customer added successfully!';
        }
        // die;
        $ledgers->type = 1;
        $ledgers->name = ucwords($request->name);
        $ledgers->email = $request->email;
        $ledgers->address = ucwords($request->address);
        $ledgers->phone = $request->phone;
        $ledgers->company_name = $request->company_name;
        $ledgers->info = $request->info;
        $ledgers->save();

        return back()->with('success_message', $message);
    }

    public function updateCustomer($id)
    {
        $ledgers = Ledger::find($id);
        return response()->json([
            'status' => 200,
            'ledgers' => $ledgers
        ]);
    }

    public function destroy($id)
    {
        $ledgers = Ledger::find($id)->delete();
        return back()->with('success_message', "Customer deleted succssfully");
    }
}
