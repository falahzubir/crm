<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAdditionalInfo;
use App\Models\CustomerAnswer;
use App\Models\CustomerChildren;
use App\Models\CustomerSpouse;
use App\Models\CustomerTitle;
use App\Models\MaritalStatus;
use App\Models\SalaryRange;
use App\Models\State;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerListController extends Controller
{
    public function customer_list()
    {
        // Queries
        $states = State::all();
        $tags = Tag::all();
        $customers = Customer::with('tags')
            ->whereNull('customers.deleted_at')
            ->paginate(10);

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'tags' => $tags,
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
            'salary_ranges.name as salary',
            )
            ->leftJoin('states', 'customers.state_id', '=', 'states.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
            ->leftJoin('users', 'customers.updated_by', '=', 'users.id')
            ->leftJoin('customer_titles', 'customers.title_id', '=', 'customer_titles.id')
            ->leftJoin('marital_statuses', 'customers.marital_status_id', '=', 'marital_statuses.id')
            ->leftJoin('blood_types', 'customers.blood_type_id', '=', 'blood_types.id')
            ->leftJoin('salary_ranges', 'customers.salary_range_id', '=', 'salary_ranges.id')
            ->findOrFail($id);

        // Children numbers
        $customerChildren = CustomerChildren::where('customer_id', $id)->whereNull('deleted_at')->get();
        $numberOfChild = $customerChildren->sum('customer_id');

        $customerSpouse = CustomerSpouse::where('customer_id', $id)->firstOrNew();
        $customerAdditionalInfo = CustomerAdditionalInfo::where('customer_id', $id)->firstOrNew();
        $customerAnswers = CustomerAnswer::where('customer_id', $id)->firstOrNew();

        return view('customer_list/customer_profile', [
            'customer' => $customer,
            'numberOfChild' => $numberOfChild,
            'customerSpouse' => $customerSpouse,
            'customerChildren' => $customerChildren,
            'customerAdditionalInfo' => $customerAdditionalInfo,
            'customerAnswers' => $customerAnswers,
        ]);
    }

    public function customer_edit($id)
    {
        $customer = Customer::select('customers.*', 'users.name as updated_by', 'countries.name as country')
            ->leftJoin('users', 'customers.updated_by', '=', 'users.id')
            ->leftJoin('states', 'customers.state_id', '=', 'states.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
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

        // Children numbers
        $customerChildren = CustomerChildren::where('customer_id', $id)->whereNull('deleted_at')->get();
        $numberOfChild = $customerChildren->sum('customer_id');

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
            'numberOfChild' => $numberOfChild,
        ]);
    }

    // For Search & Filters
    public function handle_search(Request $request)
    {
        // Initialize $search variable
        $search = '';

        $states = State::all();
        $tags = Tag::all();

        // Start with the base query
        $query = Customer::select('customers.*')
            ->whereNull('customers.deleted_at');

        // Array to hold filter conditions
        $filters = [];

        // Handle search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('customers.name', 'like', "%$search%")
                    ->orWhere('customers.phone', 'like', "%$search%");
            });
        }

        // Handle tags filter
        if ($request->filled('tag')) {
            $tag_filter = $request->input('tag');
            $filters['tag_filter'] = $tag_filter;

            // Join with customer_tags and tags table
            $query->join('customer_tags', 'customers.id', '=', 'customer_tags.customer_id')
                ->join('tags', 'customer_tags.tag_id', '=', 'tags.id')
                ->where('tags.id', $tag_filter);
        }

        // Handle state filter
        if ($request->filled('state')) {
            $state_filter = $request->input('state');
            $filters['state_filter'] = $state_filter;
            $query->where('state_id', $state_filter);
        }

        // Handle gender filter
        if ($request->filled('gender')) {
            $gender = $request->input('gender');
            $filters['gender'] = $gender;
            $query->where('gender', $gender);
        }

        // Handle age range filter
        if ($request->filled('age_range')) {
            $age_range = $request->input('age_range');
            $filters['age'] = $age_range;
            switch ($age_range) {
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

        // Pagination
        $customers = $query->paginate(10);

        // Pass filters to the view
        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'tags' => $tags,
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
            'delivery_service_rating' => 11,
            'customer_service_rating' => 12,
            'product_quality_rating' => 13,
            'product_quantity_rating' => 14,
        ];

        // Iterate over the questions array to set question_id and value for each CustomerAnswer record
        foreach ($questions as $field => $questionId) {
            $customerAnswer = CustomerAnswer::updateOrCreate(
                ['customer_id' => $id, 'question_id' => $questionId],
                ['value' => $request->input($field)]
            );
        }

        // Handle child card input
        $childData = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'childName_') === 0) {
                $index = substr($key, strlen('childName_'));
                $childData[$index]['name'] = $value;
            } elseif (strpos($key, 'childAge_') === 0) {
                $index = substr($key, strlen('childAge_'));
                $childData[$index]['age'] = $value;
            } elseif (strpos($key, 'childEducation_') === 0) {
                $index = substr($key, strlen('childEducation_'));
                $childData[$index]['education'] = $value;
            }
        }

        if (!empty($childData)) {
            foreach ($childData as $child) {
                // Create or update child record
                $childRecord = CustomerChildren::updateOrCreate(
                    ['customer_id' => $id, 'name' => $child['name']],
                    ['age' => $child['age'], 'institution' => $child['education']]
                );
            }
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
