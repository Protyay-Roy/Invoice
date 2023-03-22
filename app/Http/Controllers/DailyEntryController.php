<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_transection;
use App\Models\Ledger;
use App\Models\Transection;
use Illuminate\Http\Request;

class DailyEntryController extends Controller
{
    public function getProfile($type)
    {
        if ($type == 'customer') {
            $profile = Ledger::where('type', 1)->get();
        } else if ($type == 'supplier') {
            $profile = Ledger::where('type', 2)->get();
        } else if ($type == 'bank') {
            $profile = Bank::get();
        }

        return $profile;
    }
    public function getEditProfile($route, $type)
    {
        if ($type == 'customer') {
            $profile = Ledger::where('type', 1)->get();
        } else if ($type == 'supplier') {
            $profile = Ledger::where('type', 2)->get();
        } else if ($type == 'bank') {
            $profile = Bank::get();
        }

        return $profile;
    }

    public function addEditEntry(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'date' => 'required',
                'type' => 'required',
                'profile' => 'required'
            ]);

            foreach ($request->date as $key => $date) {
                $note = !empty($request->note[$key]) ? $request->note[$key] : 'N/A';
                if ($request->type[$key] == 'customer' || $request->type[$key] == 'supplier') {

                    if (!empty($request->debit[$key] || $request->credit[$key])) {
                        $transections = new Transection;
                        $transections->ledger_id = $request->profile[$key];
                        $transections->entry_date = $date;
                        $transections->debit = $request->debit[$key];
                        $transections->credit = $request->credit[$key];
                        $transections->type = 'PAYMENT';
                        $transections->note = $note;
                        $transections->bank_name = !empty($request->bank_name[$key]) ? $request->bank_name[$key] : null;
                        $transections->save();
                    }
                } else if ($request->type[$key] == 'bank') {
                    if (!empty($request->debit || $request->credit)) {
                        $bank_transections = new Bank_transection;
                        $bank_transections->bank_id = $request->profile[$key];
                        $bank_transections->entry_date = $date;
                        $bank_transections->debit = $request->debit[$key];
                        $bank_transections->credit = $request->credit[$key];
                        $bank_transections->type = 'PAYMENT';
                        $bank_transections->note = $note;
                        $bank_transections->save();
                    }
                }
            }

            return back();
        }
        return view('create_daily_entry');
    }

    public function getBank()
    {
        $banks = Bank::get();
        return response()->json([
            'bank' => $banks
        ]);
    }

    public function editEntry(Request $request, $id)
    {
        $transection = Transection::with('getCustomer')->find($id);

        // dd($transections);
        if ($request->isMethod('post')) {
            $request->validate([
                'date' => 'required',
                'type' => 'required',
                'profile' => 'required'
            ]);
            $note = !empty($request->note) ? $request->note : 'N/A';
            if ($request->type == 'customer' || $request->type == 'supplier') {

                if (!empty($request->debit || $request->credit)) {
                    $transection->ledger_id = $request->profile;
                    $transection->entry_date = $request->date;
                    $transection->debit = $request->debit;
                    $transection->credit = $request->credit;
                    $transection->type = 'PAYMENT';
                    $transection->note = $note;
                    $transection->bank_name = !empty($request->bank_name) ? $request->bank_name : null;
                    $transection->save();
                }
            } else if ($request->type == 'bank') {
                if (!empty($request->debit || $request->credit)) {
                    $bank_transections = new Bank_transection;
                    $bank_transections->bank_id = $request->profile;
                    $bank_transections->entry_date = $request->date;
                    $bank_transections->debit = $request->debit;
                    $bank_transections->credit = $request->credit;
                    $bank_transections->type = 'PAYMENT';
                    $bank_transections->note = $note;
                    $bank_transections->save();
                }
            }
            return redirect('daily_entry-list')->with('success_message', "Daily entry updated succssfully!");
        }

        return view('edit_daily_entry', compact('transection'));
    }

    public function destroy(Transection $transection)
    {
        $transection->delete();
        return back()->with('success_message', "Daily entry deleted succssfully!");
    }
}
