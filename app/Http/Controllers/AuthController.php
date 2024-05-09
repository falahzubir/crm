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
        $customersResponse = $this->makeRequest('http://127.0.0.1:8001/api/customers');
        $customers = json_decode($customersResponse, true);

        if (Auth::attempt($credetials)) {
            return view('customer_list/customer_list', [
                'customers' => $customers,
            ]);
        }
        
        return back()->with('error', 'Wrong email or password');
    }

    private function makeRequest($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
