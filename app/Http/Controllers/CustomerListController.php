<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function customer_list()
    {
        // Queries
        $states = State::all();
        $customers = Customer::join('states', 'customers.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('customers.*', 'states.id as state_id', 'states.name as state_name', 'countries.flag as flag')
            ->whereNull('customers.deleted_at')
            ->paginate(10);

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states
        ]);
    }

    public function customer_profile()
    {
        return view('customer_list/customer_profile');
    }

    public function customer_edit()
    {
        return view('customer_list/customer_edit');
    }

    // For Search & Filters
    public function handle_search(Request $request)
    {
        // Variable
        $search = $request->input('search');
        $gender = $request->input('gender');
        $state = $request->input('state');

        // Queries
        $states = State::all();
        $query = Customer::join('states', 'customers.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('customers.*', 'states.id as state_id', 'states.name as state_name', 'countries.flag as flag')
            ->whereNull('customers.deleted_at');

        // Search
        if ($request->filled('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('customers.name', 'like', "%$search%")->orWhere('customers.phone', 'like', "%$search%");
            });
        }

        // Filter State
        if ($request->filled('state') && $request->filled('gender')) {
            $query->where('gender', $gender)
                ->where('state_id', $state);
        } elseif ($request->filled('state')) {
            // Only filter State
            $query->where('state_id', $state);
        } elseif ($request->filled('gender')) {
            // Only filter Gender
            $query->where('gender', $gender);
        }

        // Put all together and apply paginate
        $customers = $query->paginate(10);

        // Send back what user filters
        $filters = [
            'gender' => $gender,
            'state' => $state
        ];

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'search' => $search,
            'filters' => $filters
        ]);
    }
}
