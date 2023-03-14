<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Ledger;
use Illuminate\Http\Request;

class DailyEntryController extends Controller
{
    public function getProfile($type)
    {
        if($type == 'customer'){
            $profile = Ledger::where('type', 1)->get();
        } else if($type == 'supplier'){
            $profile = Ledger::where('type', 2)->get();
        }else if($type == 'bank'){
            $profile = Bank::get();
        }

        return $profile;
        // return response()->json([
        //     'status' => 200,
        //     'profile' => $profile
        // ]);
    }
}
