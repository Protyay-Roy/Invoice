<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = $request->all();
            // dd($data);
            if (Auth::attempt([
                'email' => $request->email, 'password' => $request->password
            ])) {
                return redirect('/invoice');
            } else {
                return redirect()->back()->with('error_msg', 'Invalid Email or Password');
                // return response()->json([
                //     'status' => false,
                //     'error_message' => 'Invalid Email or Password!'
                // ]);
            }
        }
        return view('login');
    }
    //  LOGOUT ADMIN
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
