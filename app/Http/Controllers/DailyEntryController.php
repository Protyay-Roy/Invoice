<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_transection;
use App\Models\Ledger;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyEntryController extends Controller
{
    public function index()
    {
        // $transactions = Transection::where('type', 'PAYMENT')->orderBy('transections.entry_date', 'DESC')->get();
        // foreach($transactions as $t){
        //     echo $ss = $t->getCustomer->name;
        // }
        // dd();

        $transactions = DB::table('transections')
            ->where('type', 'PAYMENT')
            ->orderByRaw('DATE(transections.entry_date) DESC')
            ->get();

        return view('entry_list', compact('transactions'));
    }
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
                'date.*' => 'required|date_format:Y-m-d',
                'type.*' => 'required',
                'profile.*' => 'required',
                'debit.*' => 'nullable|numeric|min:0',
                'credit.*' => 'nullable|numeric|min:0',
                'note.*' => 'nullable|string|max:255',
                'bank_name.*' => 'required_if:type.*,bank|string|max:255',
            ], [
                'date.*.required' => 'The date field is required.',
                'date.*.date_format' => 'The date field must be in the format dd-mm-yyyy.',
                'type.*.required' => 'The payment type field is required.',
                'type.*.in' => 'Invalid payment type.',
                'profile.*.required' => 'The profile field is required.',
                'debit.*.numeric' => 'The debit field must be a number.',
                'debit.*.min' => 'The debit field must be at least 0.',
                'credit.*.numeric' => 'The credit field must be a number.',
                'credit.*.min' => 'The credit field must be at least 0.',
                'note.*.string' => 'The note field must be a string.',
                'note.*.max' => 'The note field may not be greater than :max characters.',
                'bank_name.*.required_if' => 'The bank name field is required when payment type is bank.',
                'bank_name.*.string' => 'The bank name field must be a string.',
                'bank_name.*.max' => 'The bank name field may not be greater than :max characters.',
            ]);

            $validatedData = $request->validate([
                'date.*' => 'required|date_format:Y-m-d',
                'type.*' => 'required|in:customer,supplier,bank',
                'profile.*' => 'required',
                'debit.*' => 'nullable|numeric',
                'credit.*' => 'nullable|numeric',
                'note.*' => 'nullable|string|max:255',
                'bank_name.*' => 'nullable|string|max:255',
            ]);


            foreach ($request->date as $key => $date) {
                $note = !empty($request->note[$key]) ? $request->note[$key] : 'N/A';
                if (!empty($request->type[$key]) || !empty($request->profile[$key])) {
                    if ($request->type[$key] == 'customer' || $request->type[$key] == 'supplier') {

                        if (!empty($request->debit[$key]) || !empty($request->credit[$key])) {
                            $debit = 0;
                            $credit = 0;
                            if (is_numeric($request->debit[$key])) {
                                $debit = $request->debit[$key];
                            }
                            if (is_numeric($request->credit[$key])) {
                                $credit = $request->credit[$key];
                            }
                            $transections = new Transection;
                            $transections->ledger_id = $request->profile[$key];
                            $transections->entry_date = $date;
                            $transections->debit = $debit;
                            $transections->credit = $credit;
                            $transections->type = 'PAYMENT';
                            $transections->note = $note;
                            $transections->calan = 'N/A';
                            $transections->bank_name = !empty($request->bank_name[$key]) ? $request->bank_name[$key] : 'N/A';
                            $transections->save();
                        }
                    } else if ($request->type[$key] == 'bank') {
                        if (!empty($request->debit[$key]) || !empty($request->credit[$key])) {
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
                } else {
                    return back()->with('error_message', 'The payment type field is required. And also select profile!');
                }
            }

            return redirect('daily_entry-list')->with('success_message', 'Daily entry added successfully!');
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

        // dd($request->all());
        if ($request->isMethod('post')) {

            $request->validate([
                'date.*' => 'required|date_format:Y-m-d',
                'type.*' => 'required|in:customer,supplier,bank',
                'profile.*' => 'required',
                'debit.*' => 'nullable|numeric|min:0',
                'credit.*' => 'nullable|numeric|min:0',
                'note.*' => 'nullable|string|max:255',
                'bank_name.*' => 'required_if:type.*,bank|string|max:255',
            ], [
                'date.*.required' => 'The date field is required.',
                'date.*.date_format' => 'The date field must be in the format dd-mm-yyyy.',
                'type.*.required' => 'The payment type field is required.',
                'type.*.in' => 'Invalid payment type.',
                'profile.*.required' => 'The profile field is required.',
                'debit.*.numeric' => 'The debit field must be a number.',
                'debit.*.min' => 'The debit field must be at least 0.',
                'credit.*.numeric' => 'The credit field must be a number.',
                'credit.*.min' => 'The credit field must be at least 0.',
                'note.*.string' => 'The note field must be a string.',
                'note.*.max' => 'The note field may not be greater than :max characters.',
                'bank_name.*.required_if' => 'The bank name field is required when payment type is bank.',
                'bank_name.*.string' => 'The bank name field must be a string.',
                'bank_name.*.max' => 'The bank name field may not be greater than :max characters.',
            ]);
            if (!empty($request->type) || !empty($request->profile)) {
                $note = !empty($request->note) ? $request->note : 'N/A';
                if ($request->type == 'customer' || $request->type == 'supplier') {

                    if (!empty($request->debit) || !empty($request->credit)) {
                        $debit = 0;
                        $credit = 0;
                        if (is_numeric($request->debit)) {
                            $debit = $request->debit;
                        }
                        if (is_numeric($request->credit)) {
                            $credit = $request->credit;
                        }
                        $transection->ledger_id = $request->profile;
                        $transection->entry_date = $request->date;
                        $transection->debit = $debit;
                        $transection->credit = $credit;
                        $transection->type = 'PAYMENT';
                        $transection->note = $note;
                        $transection->bank_name = !empty($request->bank_name) ? $request->bank_name : 'N/A';
                        $transection->save();
                    }
                } else if ($request->type == 'bank') {
                    if (!empty($request->debit) || !empty($request->credit)) {
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
            } else {
                return back()->with('error_message', 'The payment type field is required. And also select profile!');
            }
        }

        return view('edit_daily_entry', compact('transection'));
    }

    public function destroy(Transection $transection)
    {
        $transection->delete();
        return back()->with('success_message', "Daily entry deleted succssfully!");
    }
}
