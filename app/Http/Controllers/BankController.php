<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_transection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BankController extends Controller
{
    public function createBank(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required',
            'branch' => 'required',
            // 'info' => 'required',
        ]);
        if ($request->update_id != null) {
            $banks = Bank::find($request->update_id);
            $message = 'Bank update successfully!';
            $bank_transections = Bank_transection::where('bank_id', $request->update_id)->first();
            if ($bank_transections == null) {
                $transections_id = null;
                $bank_transections = new Bank_transection;
            } else {
                $transections_id = $bank_transections->id;
            }
        } else {
            $banks = new Bank;
            $message = 'Bank added successfully!';
            $bank_transections = new Bank_transection;
            $transections_id = null;
        }

        $banks->name = $request->name;
        $banks->account_number = $request->account_number;
        $banks->branch = $request->branch;
        // $banks->info = $request->info;
        $banks->save();

        $debit = 0;
        $credit = 0;
        if (is_numeric($request->debit)) {
            $debit = $request->debit;
        }
        if (is_numeric($request->credit)) {
            $credit = $request->credit;
        }

        if ($transections_id != null) {
            $bank_transections->entry_date = date("Y-m-d");
            $bank_transections->debit = $debit;
            $bank_transections->credit = $credit;
            $bank_transections->save();
        } else {
            if (!empty($request->debit || $request->credit)) {
                $bank_transections->bank_id = $banks->id;
                $bank_transections->entry_date = date("Y-m-d");
                $bank_transections->debit = $debit;
                $bank_transections->credit = $credit;
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
        $bank_transections = Bank_transection::where('bank_id', $id);
        $total_balance = 0;
        if (request()->ajax()) {
            $bank_transections = $bank_transections->when(!empty(request()->from) && !empty(request()->to), function ($query) {
                return $query->whereBetween('entry_date', [request()->from, request()->to]);
            })->get();
            return view('view_bank_transection', compact('bank_transections', 'total_balance'));
        }
        $bank_transections = $bank_transections->get();
        $debit = 0;
        $credit = 0;
        $balance = 0;
        foreach ($bank_transections as $transection) {
            $debit += $transection->debit;
            $credit += $transection->credit;
            $balance = $debit - $credit;
        }
        $balance = number_format($balance, 2, '.', ',');
        $debit = number_format($debit, 2, '.', ',');
        $credit = number_format($credit, 2, '.', ',');
        return view('view_bank', compact('bank', 'bank_transections', 'debit', 'credit', 'balance', 'total_balance'));
    }

    public function destroy($id)
    {
        Bank_transection::where('bank_id', $id)->delete();
        $banks = Bank::find($id)->delete();
        return back()->with('success_message', "Bank deleted succssfully!");
    }

    public function search($value)
    {
        // $banks = Bank::where('name', 'LIKE', '%' . $value . '%')->get();
        // return $banks;
        return response()->json([
            'status' => 200,
            'banks' => Bank::where('name', 'LIKE', '%' . $value . '%')->get()
        ]);
    }


    public function downloadPDF(Request $request, $id)
    {
        // dd($request->all());
        $bank = Bank::find($id);
        $bank_transections = Bank_transection::where('bank_id', $id);

        if (!empty(request()->from) || !empty(request()->to)) {
            $bank_transections = $bank_transections->when(!empty(request()->from) && !empty(request()->to), function ($query) {
                return $query->whereBetween('entry_date', [request()->from, request()->to]);
            });
        }

        $bank_transections = $bank_transections->get();

        $total_balance = 0;

        $pdf = Pdf::loadView('bank_pdf', [
            'bank_transections' => $bank_transections,
            'bank' => $bank,
            'total_balance' => $total_balance,
            'id' => $id
        ]);
        // return view('bank_pdf', compact('bank_transections', 'bank', 'total_balance','id'));
        return $pdf->download('bank_pdf.pdf');
    }
}
