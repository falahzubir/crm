@extends('template.main')

@section('content')
    <style>
        .star-rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            direction: ltr;
        }

        .star-rating .star {
            display: inline-block;
            font-size: 20px;
            cursor: pointer;
        }

        .star-rating .star:hover,
        .star-rating .star.active {
            color: orange;
        }

        /* Hide radio buttons */
        .star-rating input[type="radio"] {
            display: none;
        }

        /* Style labels as stars */
        .star-rating label {
            font-size: 30px;
            /* Adjust size as needed */
            color: #ccc;
            /* Default star color */
            cursor: pointer;
        }

        /* Style labels when radio button is checked */
        .star-rating input[type="radio"]:checked~label {
            color: #ffcc00;
            /* Change color to represent selected star */
        }
    </style>

    <div class="container">
        @if ($errors->any())
            <p class="alert alert-danger text-center my-3">Please check your input</p>
        @endif

        <form id="updateForm" action="{{ route('customer.update', ['id' => $customer->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Customer Photo --}}
            <div class="card mt-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 position-relative">
                            <img id="customer-photo"
                                src="{{ $customer->photo != null ? $customer->photo : asset('assets/img/avatars/user.jpeg') }}"
                                class="w-px-100 h-px-100 rounded-circle" />
                        </div>

                        <div class="col-md-4 float-start" style="margin-left: 50px;">
                            <div class="mb-1 mt-3">
                                <h3>{{ $customer->name }}</h3>
                            </div>

                            {{-- <div class="mb-0">
                                <label>LAST PURCHASE</label>
                                &nbsp;
                                <label class="text-success">10 days ago</label>
                            </div> --}}

                            <div class="mt-3">
                                <label>
                                    Last updated {{ $customer->updated_at->diffForHumans() }} 
                                    @if ($customer->updated_by)
                                        by {{ $customer->updated_by }}
                                    @else
                                        
                                    @endif
                                    
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customer Details --}}
            <div class="card mt-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Customer Details</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                    <div class="mb-3">
                        <label class="mb-3">Name :</label>
                        <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">Nick Name :</label>
                        <input type="text" class="form-control" name="nickname" value="{{ $customer->nickname }}">
                    </div>

                    <div class="row d-flex align-items-center justify-content-around">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="mb-3">Titles :</label>
                                <select name="title_id" class="form-select">
                                    <option selected disabled>Please Select</option>
                                    @foreach ($titles as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($customer->title_id) && $row->id == $customer->title_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col mb-3">
                                <label class="mb-4">Gender :</label>
                                <div class="d-flex justify-content-start">
                                    <input type="radio" name="gender" value="M"
                                        {{ $customer->gender === 'M' ? 'checked' : '' }}> <label
                                        class="ms-1">Male</label>
                                    <input type="radio" name="gender" value="F" class="ms-3"
                                        {{ $customer->gender === 'F' ? 'checked' : '' }}> <label
                                        class="ms-1">Female</label>
                                </div>
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">Marital Status :</label>
                                <select name="marital_status_id" class="form-select">
                                    <option selected disabled>Select Status</option>
                                    @foreach ($maritalStatus as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($customer->marital_status_id) && $row->id == $customer->marital_status_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col mb-3">
                                <label class="mb-3">Age :</label>
                                <input type="number" class="form-control" name="age" min="1"
                                    value="{{ $customer->age }}">
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">IC Number :</label>
                                <input type="text" class="form-control" name="identification_number"
                                    value="{{ $customer->identification_number }}">
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">Phone Number :</label>
                                <input type="tel" class="form-control" name="phone" value="{{ $customer->phone }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col mb-3">
                                <label class="mb-3">Weight (kg) :</label>
                                <input type="number" class="form-control" name="weight" min="1"
                                    value="{{ $customer->weight }}">
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">Height (cm) :</label>
                                <input type="number" class="form-control" name="height" min="1"
                                    value="{{ $customer->height }}">
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">Blood Type :</label>
                                <select name="blood_type_id" class="form-select">
                                    <option selected disabled>Select Blood Type</option>
                                    @foreach ($bloodTypes as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($customer->blood_type_id) && $row->id == $customer->blood_type_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customer Address --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Customer Address</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#customerAddress">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="customerAddress" data-bs-parent="#accordion">
                    <div class="mb-3">
                        <label class="mb-3">Address :</label>
                        <div>
                            <textarea name="address" class="form-control" cols="50" rows="4">{{ $customer->address }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">City :</label>
                        <div>
                            <input type="text" class="form-control" name="city" value="{{ $customer->city }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Postcode :</label>
                            <input type="number" class="form-control" name="postcode"
                                value="{{ $customer->postcode }}">
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">State :</label>
                            <select name="state_id" class="form-select">
                                <option selected disabled></option>
                                @foreach ($states as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($customer->state_id) && $row->id == $customer->state_id ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">Country :</label>
                            <input type="text" class="form-control" value="{{ $customer->country }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Place of Birth :</label>
                            <input type="text" class="form-control" name="birth_place"
                                value="{{ $customer->birth_place }}">
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">State of Birth :</label>
                            <select name="state_of_birth" class="form-select">
                                <option selected disabled>Please Select</option>
                                @foreach ($states as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($customer->state_id) && $row->id == $customer->state_id ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Occupation --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Occupation</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#occupation">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="occupation" data-bs-parent="#accordion">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="mb-3">
                            <label class="mb-3">Occupation :</label>
                            <div>
                                <input type="text" class="form-control" name="occupation"
                                    value="{{ $customer->occupation }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="mb-4">Sector :</label>
                                <div class="d-flex justify-content-start">
                                    <input type="radio" name="sector" value="P"
                                        {{ $customer->sector === 'P' ? 'checked' : '' }}> <label
                                        class="ms-1">Private</label>
                                    <input type="radio" name="sector" value="G" class="ms-3"
                                        {{ $customer->sector === 'G' ? 'checked' : '' }}> <label
                                        class="ms-1">Government</label>
                                </div>
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">IC Number Police/ Military :</label>
                                <input type="text" class="form-control" name="identification_number_police"
                                    value="{{ $customer->identification_number_police }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="mb-3">Salary :</label>
                                <select name="salary_range_id" class="form-select">
                                    <option selected disabled>Select Salary Range</option>
                                    @foreach ($salaryRanges as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($customer->salary_range_id) && $row->id == $customer->salary_range_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col mb-3">
                                <label class="mb-4">Working Hour :</label>
                                <div class="d-flex justify-content-start">
                                    <input type="radio" name="working_hour" value="S"
                                        {{ $customer->working_hour === 'S' ? 'checked' : '' }}> <label
                                        class="ms-1">Shift</label>
                                    <input type="radio" name="working_hour" value="N" class="ms-3"
                                        {{ $customer->working_hour === 'N' ? 'checked' : '' }}> <label
                                        class="ms-1">Normal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Family --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Family</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#family">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="family" data-bs-parent="#accordion">
                    <div class="mb-3">
                        <label class="mb-3">Child Birth Order
                            :</label>
                        <input type="text" class="form-control" name="birth_order"
                            value="{{ $customer->birth_order }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mb-3">Spouse Name :</label>
                            <input type="text" class="form-control" name="spouse_name"
                                value="{{ $customerSpouse->name }}">
                        </div>

                        <div class="col">
                            <label class="mb-3">Spouse Occupation :</label>
                            <input type="text" class="form-control" name="spouse_occupation"
                                value="{{ $customerSpouse->occupation }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">Spouse Age :</label>
                        <input type="text" class="form-control" name="spouse_age"
                            value="{{ $customerSpouse->age }}">
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div>
                            <label class="mb-3">Number of children :</label>
                            <input type="text" class="form-control" name="number_of_children"
                                value="{{ $numberOfChild }}" readonly>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-secondary btn-lg" onclick="addChildField()" type="button">
                                <i class='bx bx-child'></i> Add Child Information
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Child --}}
            <div id="childContainer" style="display: flex; flex-wrap: wrap; justify-content: flex-end;"></div>

            {{-- Others --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Others</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#others">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="others" data-bs-parent="#accordion">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="mb-3">Hobby :</label>
                            <input type="text" class="form-control" name="hobby"
                                value="{{ $customerAdditionalInfo->hobby }}">
                        </div>

                        <div class="col">
                            <label class="mb-3">Favourite Colour :</label>
                            <input type="text" class="form-control" name="fav_color"
                                value="{{ $customerAdditionalInfo->fav_color }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mb-3">Favourite Pet :</label>
                            <input type="text" class="form-control" name="fav_pet"
                                value="{{ $customerAdditionalInfo->fav_pet }}">
                        </div>

                        <div class="col">
                            <label class="mb-3">Favourite Food :</label>
                            <input type="text" class="form-control" name="fav_food"
                                value="{{ $customerAdditionalInfo->fav_food }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="mb-3">Favourite Drinks :</label>
                            <input type="text" class="form-control" name="fav_beverage"
                                value="{{ $customerAdditionalInfo->fav_beverage }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Suffering Disease --}}
            {{-- <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Suffering Disease</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#sufferingDisease">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="sufferingDisease" data-bs-parent="#accordion">
                    <div class="mb-3">
                        <label class="mb-3">Disease :</label>
                        <select name="disease" class="form-select">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">Other Disease :</label>
                        <input type="text" class="form-control" name="other_disease" value="">
                    </div>
                </div>
            </div> --}}

            {{-- Product & Service --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Product & Service</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                    <div class="mb-3">
                        <label class="mb-3">Aware or not about EMZI? :</label>
                        <div class="d-flex justify-content-start">
                            <input type="radio" name="aware_or_not_about_emzi" value="Y"
                                {{ optional($customerAnswers->where('question_id', 1)->where('customer_id', $customer->id)->first())->value === 'Y'? 'checked': '' }}>
                            <label class="ms-1">Yes</label>
                            <input type="radio" name="aware_or_not_about_emzi" value="N" class="ms-3"
                                {{ optional($customerAnswers->where('question_id', 1)->where('customer_id', $customer->id)->first())->value === 'N'? 'checked': '' }}>
                            <label class="ms-1">No</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">How do you know about EMZI? :</label>
                        <div class="d-flex justify-content-start">
                            <input type="checkbox" name="how_did_you_know_about_emzi" value="1"
                                {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->pluck('value')->contains('1')? 'checked': '' }}>
                            <label class="ms-1">Social Media</label>
                            <input type="checkbox" name="how_did_you_know_about_emzi" class="ms-3" value="2"
                                {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->pluck('value')->contains('2')? 'checked': '' }}>
                            <label class="ms-1">Friends</label>
                            <input type="checkbox" name="how_did_you_know_about_emzi" class="ms-3" value="3"
                                {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->pluck('value')->contains('3')? 'checked': '' }}>
                            <label class="ms-1">Website</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">First EMZI Product Purchased? :</label>
                        <input type="text" class="form-control" name="first_product_purchased_from_emzi"
                            value="{{ $customerAnswers->where('question_id', 3)->where('customer_id', $customer->id)->first()->value ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Why Buying EMZI Products? :</label>
                        <input type="text" class="form-control" name="why_buying_emzi_products"
                            value="{{ $customerAnswers->where('question_id', 4)->where('customer_id', $customer->id)->first()->value ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Why Support EMZI Products? :</label>
                        <input type="text" class="form-control" name="why_support_emzi_products"
                            value="{{ $customerAnswers->where('question_id', 5)->where('customer_id', $customer->id)->first()->value ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Purchase Frequency :</label>
                        <input type="number" class="form-control" name="frequency_of_purchase"
                            value="{{ $customerAnswers->where('question_id', 6)->where('customer_id', $customer->id)->first()->value ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">What Products Does EMZI Have? :</label>
                        <input type="text" class="form-control" name="what_products_does_emzi_have"
                            value="{{ $customerAnswers->where('question_id', 7)->where('customer_id', $customer->id)->first()->value ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Do you know EMZI has its own factory? :</label>
                        <div class="d-flex justify-content-start">
                            <input type="radio" name="do_you_know_emzi_has_its_own_factory" value="Y"
                                {{ optional($customerAnswers->where('question_id', 8)->where('customer_id', $customer->id)->first())->value === 'Y'? 'checked': '' }}>
                            <label class="ms-1">Yes</label>
                            <input type="radio" name="do_you_know_emzi_has_its_own_factory" value="N"
                                class="ms-3"
                                {{ optional($customerAnswers->where('question_id', 8)->where('customer_id', $customer->id)->first())->value === 'N'? 'checked': '' }}>
                            <label class="ms-1">No</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Do you know EMZI has a laboratory at the university? :</label>
                        <div class="d-flex justify-content-start">
                            <input type="radio" name="do_you_know_emzi_has_a_laboratory_at_the_university"
                                value="Y"
                                {{ optional($customerAnswers->where('question_id', 9)->where('customer_id', $customer->id)->first())->value === 'Y'? 'checked': '' }}>
                            <label class="ms-1">Yes</label>
                            <input type="radio" name="do_you_know_emzi_has_a_laboratory_at_the_university"
                                value="N" class="ms-3"
                                {{ optional($customerAnswers->where('question_id', 9)->where('customer_id', $customer->id)->first())->value === 'N'? 'checked': '' }}>
                            <label class="ms-1">No</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-3">Are EMZI Products Effective? :</label>
                        <div class="d-flex flex-column">
                            <div class="mb-2">
                                <input type="radio" name="are_emzi_products_effective" value="1"
                                    {{ $customerAnswers->where('question_id', 10)->where('customer_id', $customer->id)->pluck('value')->contains('1')? 'checked': '' }}>
                                <label class="ms-1">Yes, Highly Effective</label>
                            </div>
                            <div class="mb-2">
                                <input type="radio" name="are_emzi_products_effective" value="2"
                                    {{ $customerAnswers->where('question_id', 10)->where('customer_id', $customer->id)->pluck('value')->contains('2')? 'checked': '' }}>
                                <label class="ms-1">Less Effective</label>
                            </div>
                            <div class="mb-2">
                                <input type="radio" name="are_emzi_products_effective" value="3"
                                    {{ $customerAnswers->where('question_id', 10)->where('customer_id', $customer->id)->pluck('value')->contains('3')? 'checked': '' }}>
                                <label class="ms-1">Not Effective</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service Rating --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Service Rating</strong></h5>
                    <a class="collapsed btn" data-bs-toggle="collapse" href="#serviceRating">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="card-body ms-4" id="serviceRating" data-bs-parent="#accordion">
                    <div class="row mb-3">
                        <label for="deliveryService">Delivery Service:</label>
                        <div class="star-rating" name="delivery_service"
                            data-rating="{{ optional($customerAnswers->where('question_id', 11)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <input type="hidden" id="delivery_service_rating" name="delivery_service_rating"
                                value="{{ optional($customerAnswers->where('question_id', 11)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="customerService">Customer Service:</label>
                        <div class="star-rating" name="customer_service"
                            data-rating="{{ optional($customerAnswers->where('question_id', 12)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <input type="hidden" id="customer_service_rating" name="customer_service_rating"
                                value="{{ optional($customerAnswers->where('question_id', 12)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="productQuality">Product Quality:</label>
                        <div class="star-rating" name="product_quality"
                            data-rating="{{ optional($customerAnswers->where('question_id', 13)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <input type="hidden" id="product_quality_rating" name="product_quality_rating"
                                value="{{ optional($customerAnswers->where('question_id', 13)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="productQuantity">Product Quantity:</label>
                        <div class="star-rating" name="product_quantity"
                            data-rating="{{ optional($customerAnswers->where('question_id', 14)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                            <input type="hidden" id="product_quantity_rating" name="product_quantity_rating"
                                value="{{ optional($customerAnswers->where('question_id', 14)->where('customer_id', $customer->id)->first())->value ?? 0 }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="buy-now">
                <button type="submit" class="btn btn-primary btn-lg btn-buy-now">SAVE CHANGES</button>
            </div>
        </form>
    </div>
@endsection
