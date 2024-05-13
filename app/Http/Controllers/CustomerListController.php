<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAdditionalInfo;
use App\Models\CustomerAnswer;
use App\Models\CustomerSpouse;
use App\Models\CustomerTitle;
use App\Models\MaritalStatus;
use App\Models\SalaryRange;
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
        $customer = Customer::select(
            'customers.*', 
            'states.name as state_name', 
            'countries.flag as flag', 
            'users.name as updated_by', 
            'customer_titles.name as title',
            'marital_statuses.name as status',
            'blood_types.name as blood_type',
            )
            ->join('states', 'customers.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->join('users', 'customers.updated_by', '=', 'users.id')
            ->join('customer_titles', 'customers.title_id', '=', 'customer_titles.id')
            ->join('marital_statuses', 'customers.marital_status_id', '=', 'marital_statuses.id')
            ->join('blood_types', 'customers.blood_type_id', '=', 'blood_types.id')
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
        $salaryRanges = SalaryRange::all();
        $customerAdditionalInfo = CustomerAdditionalInfo::where('customer_id', $id)->firstOrNew();
        $customerAnswers = CustomerAnswer::where('customer_id', $id)->firstOrNew();
        $customerSpouse = CustomerSpouse::where('customer_id', $id)->firstOrNew();

        return view('customer_list/customer_edit', [
            'customer' => $customer,
            'titles' => $titles,
            'maritalStatus' => $maritalStatus,
            'bloodTypes' => $bloodTypes,
            'states' => $states,
            'countries' => $countries,
            'salaryRanges' => $salaryRanges,
            'customerAdditionalInfo' => $customerAdditionalInfo,
            'customerAnswers' => $customerAnswers,
            'customerSpouse' => $customerSpouse,
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customerAnswer = CustomerAdditionalInfo::where('customer_id', $id)->firstOrNew();
        $user = Auth::user();
        $customerSpouse = CustomerSpouse::where('customer_id', $id)->firstOrNew();

        $customerSpouseData = [
            'customer_id' => $id,
            'name' => $request->input('spouse_name'),
            'age' => $request->input('spouse_age'),
            'occupation' => $request->input('spouse_occupation'),
        ];

        // Update the customer data and set the updated_by column
        $customer->update(array_merge($request->all(), ['updated_by' => $user->id]));
        $customerAnswer->update($request->all());
        $customerSpouse->updateOrCreate($customerSpouseData);

        // Define an array to map question field names to their corresponding question IDs
        $questions = [
            'aware_or_not_about_emzi' => 1,
            'how_did_you_know_about_emzi' => 2,
            'first_product_purchased_from_emzi' => 3,
            'why_buying_emzi_products' => 4,
            'why_support_emzi_products' => 5,
            'frequency_of_purchase' => 6,
            'what_products_does_emzi_have' => 7,
            'do_you_know_emzi_has_its_own_factory' => 8,
            'do_you_know_emzi_has_a_laboratory_at_the_university' => 9,
            'are_emzi_products_effective' => 10,
            'delivery_service' => 11,
            'customer_service' => 12,
            'product_quality' => 13,
            'product_quantity' => 14,
        ];

        // Iterate over the questions array to set question_id and value for each CustomerAnswer record
        foreach ($questions as $field => $questionId) {
            $customerAnswer = CustomerAnswer::updateOrCreate(
                ['customer_id' => $id, 'question_id' => $questionId],
                ['value' => $request->input($field)]
            );
        }

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
