<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
                // return response()->json([
                //     'status' => false,
                //     'error_message' => 'Invalid Email or Password!'
                // ]);
            }
        }
        return view('login');
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'old_password' => 'required',
            'new_password' => 'required|min:6|same:confirm_password',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error_message', 'Your password does not match');
        }

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return back()->with('success_message', 'Your profile update successfully');

    }
    //  LOGOUT ADMIN
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
