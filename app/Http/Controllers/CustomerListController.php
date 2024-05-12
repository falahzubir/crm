<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerTitle;
use App\Models\MaritalStatus;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerListController extends Controller
{
    public function customer_list()
    {
        // Queries
        $states = State::all();
        $customers = Customer::select('customers.*')
            ->whereNull('customers.deleted_at')
            ->paginate(10);

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
        ]);
    }

    public function customer_profile($id)
    {
        $customer = Customer::select('customers.*', 'states.name as state_name', 'countries.flag as flag', 'users.name as updated_by')
            ->join('states', 'customers.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->join('users', 'customers.updated_by', '=', 'users.id')
            ->findOrFail($id);

        return view('customer_list/customer_profile', ['customer' => $customer]);
    }

    public function customer_edit($id)
    {
        $customer = Customer::select('customers.*', 'users.name as updated_by')
            ->join('users', 'customers.updated_by', '=', 'users.id')
            ->findOrFail($id);
        $titles = CustomerTitle::all();
        $maritalStatus = MaritalStatus::all();
        $bloodTypes = BloodType::all();
        $states = State::all();
        $countries = Country::all();

        return view('customer_list/customer_edit', [
            'customer' => $customer,
            'titles' => $titles,
            'maritalStatus' => $maritalStatus,
            'bloodTypes' => $bloodTypes,
            'states' => $states,
            'countries' => $countries,
        ]);
    }

    // For Search & Filters
    public function handle_search(Request $request)
    {
        // Variable
        $search = $request->input('search');
        $gender = $request->input('gender');
        $age = $request->input('age_range');
        $state_filter = $request->input('state');

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

        // Filter
        if ($request->filled('state') && $request->filled('gender')) {
            $query->where('gender', $gender)
                ->where('state_id', $state_filter);
        } elseif ($request->filled('state')) {
            // Only filter State
            $query->where('state_id', $state_filter);
        } elseif ($request->filled('gender')) {
            // Only filter Gender
            $query->where('gender', $gender);
        } elseif ($request->filled('age_range')) {
            // Only filter Age
            switch ($age) {
                case '1':
                    $query->where('age', '<=', '17');
                    break;
                case '2':
                    $query->whereBetween('age', ['18', '24']);
                    break;
                case '3':
                    $query->whereBetween('age', ['25', '34']);
                    break;
                case '4':
                    $query->whereBetween('age', ['35', '44']);
                    break;
                case '5':
                    $query->whereBetween('age', ['45', '54']);
                    break;
                case '6':
                    $query->whereBetween('age', ['55', '64']);
                    break;
                case '7':
                    $query->whereBetween('age', ['65', '74']);
                    break;
                case '8':
                    $query->where('age', '>=', '75');
                    break;
            }
        }

        // Put all together and apply paginate
        $customers = $query->paginate(10);

        // Send back what user filters
        $filters = [
            'gender' => $gender,
            'state_filter' => $state_filter,
            'age' => $age,
        ];

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'search' => $search,
            'filters' => $filters
        ]);
    }

    public function customer_update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
        ]);

        $photoPath = $request->file('photo')->store('photos');

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the customer data and set the updated_by column
        $customer->update(array_merge($request->all(), ['updated_by' => $user->id, 'photo' => $photoPath]));

        return response()->json(['message' => 'Customer updated successfully.'], 200);
    }

    // Get customers data using api
    public function fetchDataFromAnalytics()
    {
        // Fetch customers data
        $customersResponse = $this->makeRequest('http://127.0.0.1:8001/api/customers');
        $customers = json_decode($customersResponse, true);

        // Process data as needed
        return view('customer_list/customer_list', [
            'customers' => $customers,
        ]);
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
