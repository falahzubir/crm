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

        // Queries
        $states = State::all();

        $customers = Customer::join('states', 'customers.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('customers.*', 'states.id as state_id', 'states.name as state_name', 'countries.flag as flag')
            ->whereNull('customers.deleted_at')
            ->paginate(10);

        if (Auth::attempt($credetials)) {
            return view('customer_list/customer_list', [
                'customers' => $customers,
                'states' => $states,
            ]);
        }
        
        return back()->with('error', 'Wrong email or password');
    }
}
