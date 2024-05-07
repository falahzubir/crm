<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function customer_list()
    {
        return view('customer_list/customer_list');
    }

    public function customer_profile()
    {
        return view('customer_list/customer_profile');
    }

    public function customer_edit()
    {
        return view('customer_list/customer_edit');
    }
}
