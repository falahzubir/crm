<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAdditionalInfo;
use App\Models\CustomerAnswer;
use App\Models\CustomerChildren;
use App\Models\CustomerSpouse;
use App\Models\CustomerTag;
use App\Models\CustomerTitle;
use App\Models\MaritalStatus;
use App\Models\SalaryRange;
use App\Models\State;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerListController extends Controller
{
    // ---------------------- [ INSIDE CRM ] ---------------------- //
    // List of customers
    public function customer_list()
    {
        $user = Auth::user();

        // Get the user's role
        $role = $user->role;

        // Get the permissions for the user's role
        $permissions = $role->permissions->pluck('id')->toArray();

        // Define permission IDs
        $seeAllCustomersPermissionId = 1;
        $seeTheirCustomersPermissionId = 2;

        // Check the permissions and fetch customers accordingly
        if (in_array($seeAllCustomersPermissionId, $permissions)) {
            // Can see all customers
            $customers = Customer::whereNull('customers.deleted_at')->paginate(10);
        } elseif (in_array($seeTheirCustomersPermissionId, $permissions)) {
            // Can see only customers assigned to them
            $customers = $user->customers()->whereNull('customers.deleted_at')->paginate(10);
        } else {
            // Default case, no access
            $customers = collect();
        }

        $states = State::all();
        $tags = Tag::all();

        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'tags' => $tags,
        ]);
    }

    // Go to details page
    public function customer_profile($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);

        $states = State::all();
        $customer = Customer::select(
            'customers.*', 
            'states.name as state_name', 
            'countries.flag as flag', 
            'countries.name as country_name', 
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

        return view('customer_list/customer_profile', [
            'customer' => $customer,
            'states' => $states,
        ]);
    }

    // Go to edit page
    public function customer_edit($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);

        $customer = Customer::with(['tags' => function($query) {
                $query->whereNull('customer_tags.deleted_at');
            }])
            ->select('customers.*', 'users.name as updated_by', 'countries.name as country')
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
        $tags = Tag::all();

        // Children numbers
        $customerChildren = CustomerChildren::where('customer_id', $id)->whereNull('deleted_at')->get();

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
            'customerChildren' => $customerChildren,
            'tags' => $tags,
        ]);
    }

    // Save updated data
    public function customer_update(Request $request, $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'customer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $newDate = Carbon::now();
        $tagIds = $request->input('tag_id', []);
        $customer = Customer::findOrFail($id);
        $user = Auth::user();

        // Update customer photo
        if ($request->hasFile('customer_photo')) {
            $fileName = time() . '_' . $request->file('customer_photo')->getClientOriginalName();
            $path = $request->file('customer_photo')->storeAs('photos', $fileName, 'public');
            $customer->photo = 'storage/' . $path; // Store the path to the photo
        }

        $customer->save();

        $this->updateCustomerTags($customer, $tagIds, $newDate);
        $this->updateCustomerAdditionalInfo($customer, $request);
        $this->updateCustomerSpouse($customer, $request);
        $this->updateCustomerAnswers($customer, $request, $newDate);
        $this->updateCustomerChildren($customer, $request, $newDate);

        $this->updateCustomerDataInAnalytics($request, $newDate);

        return response()->json(['message' => 'Customer updated successfully.'], 200);
    }

    private function updateCustomerTags($customer, $tagIds, $newDate)
    {
        $currentTagIds = $customer->tags->pluck('id')->toArray();
        $tagsToRemove = array_diff($currentTagIds, $tagIds);
        $tagsToAdd = array_diff($tagIds, $currentTagIds);

        // Handle tags to be removed (i.e., set deleted_at to current timestamp)
        if (!empty($tagsToRemove)) {
            DB::table('customer_tags')
                ->where('customer_id', $customer->id)
                ->whereIn('tag_id', $tagsToRemove)
                ->update(['deleted_at' => $newDate, 'updated_at' => $newDate]);
        }

        // Handle tags to be added or re-selected (i.e., set deleted_at to null and updated_at to current date)
        if (!empty($tagsToAdd)) {
            DB::table('customer_tags')
                ->where('customer_id', $customer->id)
                ->whereIn('tag_id', $tagsToAdd)
                ->update(['deleted_at' => null, 'updated_at' => $newDate]);

            // Add new tags if they don't exist in the pivot table
            foreach ($tagsToAdd as $tagId) {
                $exists = DB::table('customer_tags')
                    ->where('customer_id', $customer->id)
                    ->where('tag_id', $tagId)
                    ->exists();

                if (!$exists) {
                    DB::table('customer_tags')->insert([
                        'customer_id' => $customer->id,
                        'tag_id' => $tagId,
                        'deleted_at' => null,
                        'updated_at' => $newDate,
                    ]);
                }
            }
        }

        // Handle re-selected tags (i.e., tags that were previously deleted and now need to be restored)
        $tagsToRestore = array_intersect($currentTagIds, $tagIds);

        if (!empty($tagsToRestore)) {
            DB::table('customer_tags')
                ->where('customer_id', $customer->id)
                ->whereIn('tag_id', $tagsToRestore)
                ->whereNotNull('deleted_at')  // Only update if deleted_at is not null
                ->update(['deleted_at' => null, 'updated_at' => $newDate]);
        }
    }

    private function updateCustomerAdditionalInfo($customer, $request)
    {
        $customerAdditionalInfoData = [
            'customer_id' => $customer->id,
            'hobby' => $request->input('hobby'),
            'fav_color' => $request->input('fav_color'),
            'fav_pet' => $request->input('fav_pet'),
            'fav_food' => $request->input('fav_food'),
            'fav_beverage' => $request->input('fav_beverage'),
        ];

        $customerAdditionalInfo = CustomerAdditionalInfo::where('customer_id', $customer->id)->firstOrNew();
        $customerAdditionalInfo->fill($customerAdditionalInfoData)->save();

        $customer->update(array_merge($request->all(), [
            'updated_by' => Auth::id(),
            'additional_tags' => $request->input('additional_tags')
        ]));
    }

    private function updateCustomerSpouse($customer, $request)
    {
        $customerSpouse = CustomerSpouse::where('customer_id', $customer->id)->firstOrNew();
        $customerSpouse->fill([
            'customer_id' => $customer->id,
            'name' => $request->input('spouse_name'),
            'age' => $request->input('spouse_age'),
            'occupation' => $request->input('spouse_occupation')
        ])->save();
    }

    private function updateCustomerAnswers($customer, $request, $newDate)
    {
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

        foreach ($questions as $field => $questionId) {
            if ($field == 'how_did_you_know_about_emzi') {
                // Handle multiple select for 'how_did_you_know_about_emzi'
                $values = $request->input($field, []);
                $existingAnswers = CustomerAnswer::where('customer_id', $customer->id)
                    ->where('question_id', $questionId)
                    ->get()
                    ->keyBy('value');

                // Update or create new answers
                foreach ($values as $value) {
                    if (isset($existingAnswers[$value])) {
                        // Update existing answer if it is re-selected
                        $existingAnswers[$value]->update(['deleted_at' => null, 'updated_at' => $newDate]);
                    } else {
                        // Create new answer if it does not exist
                        CustomerAnswer::create([
                            'customer_id' => $customer->id,
                            'question_id' => $questionId,
                            'value' => $value,
                            'created_at' => $newDate,
                            'updated_at' => $newDate,
                        ]);
                    }
                }

                // Mark answers as deleted if they are not re-selected
                foreach ($existingAnswers as $answer) {
                    if (!in_array($answer->value, $values)) {
                        $answer->update(['deleted_at' => $newDate, 'updated_at' => $newDate]);
                    }
                }
            } else {
                // Handle other questions
                CustomerAnswer::updateOrCreate(
                    ['customer_id' => $customer->id, 'question_id' => $questionId],
                    ['value' => $request->input($field), 'updated_at' => $newDate]
                );
            }
        }
    }

    private function updateCustomerChildren($customer, $request, $newDate)
    {
        $childData = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'childId_') === 0) {
                $index = substr($key, strlen('childId_'));
                $childData[$index]['id'] = $value;
            } elseif (strpos($key, 'childName_') === 0) {
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

        foreach ($childData as $index => $child) {
            if (isset($child['id'])) {
                $existingChild = CustomerChildren::find($child['id']);

                if ($existingChild) {
                    $existingChild->update([
                        'name' => $child['name'],
                        'age' => $child['age'],
                        'institution' => $child['education'],
                        'updated_at' => $newDate,
                    ]);
                }
            } else {
                CustomerChildren::create([
                    'customer_id' => $customer->id,
                    'name' => $child['name'],
                    'age' => $child['age'],
                    'institution' => $child['education']
                ]);
            }
        }
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
            if (is_array($tag_filter)) {
                $filters['tag_filter'] = $tag_filter;

                // Join with customer_tags and tags table
                $query->join('customer_tags', 'customers.id', '=', 'customer_tags.customer_id')
                    ->join('tags', 'customer_tags.tag_id', '=', 'tags.id')
                    ->whereIn('tags.id', $tag_filter);
            }
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

        // Pagination with appends
        $customers = $query->paginate(10)->appends($request->except('page'));

        // Pass filters to the view
        return view('customer_list/customer_list', [
            'customers' => $customers,
            'states' => $states,
            'tags' => $tags,
            'search' => $search,
            'filters' => $filters
        ]);
    }


    // ---------------------- [ OUTSIDE CRM ] ---------------------- //
    public function updateCustomerDataInAnalytics($request, $newDate)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $gender = $request->input('gender');

        if ($gender == 'M') {
            $bos_gender = "male";
        } elseif ($gender == 'F') {
            $bos_gender = "female";
        }
        

        if (App::environment('production')) {
            DB::connection('EH')->table('customer')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'gender' => $bos_gender,
                ]);

            DB::connection('ED')->table('customer')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'gender' => $bos_gender,
                ]);

            DB::connection('EI')->table('customer')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'gender' => $bos_gender,
                ]);

            DB::connection('ANALYTIC-LIVE')->table('customers')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'updated_at' => $newDate,
                ]);
        } else {
            DB::connection('EH-STG')->table('customer')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'gender' => $bos_gender,
                ]);

            DB::connection('ED-STG')->table('customer')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'gender' => $bos_gender,
                ]);

            DB::connection('ANALYTIC-STG')->table('customers')
                ->where('customer_tel', $phone)
                ->update([
                    'customer_name' => $name,
                    'updated_at' => $newDate,
                ]);
        }
    }

    private function makeRequest($url, $method = 'GET', $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data), // Send data as JSON
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
