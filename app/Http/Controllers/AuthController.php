<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function login_post(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            return redirect()->route('customer.list');
        }
        
        return back()->with('error', 'Wrong email or password');
    }
}
