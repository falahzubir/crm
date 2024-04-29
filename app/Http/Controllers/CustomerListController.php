<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index()
    {
        return view('customer_list/index');
    }
}
