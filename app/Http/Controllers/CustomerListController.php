<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index()
    {
        return view('customer_list/index');
    }

    public function customer_profile()
    {
        return view('customer_list/customer_profile');
    }
}
