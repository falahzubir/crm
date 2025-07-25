@extends('template.main')

@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="alert alert-danger text-center my-3">Please check your input</p>
        @endif

        <form id="updateForm" action="{{ route('customer.update', Crypt::encryptString($customer->id)) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Customer Photo --}}
            <div class="card mt-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 position-relative">
                            <img id="customer-photo"
                                src="{{ $customer->photo ? asset($customer->photo) : asset('assets/img/avatars/user.jpeg') }}"
                                class="w-px-100 h-px-100 rounded-circle customer-photo" />
                            <i class="bx bxs-camera camera-icon"></i>
                        </div>

                        <div class="col-md-4 float-start" style="margin-left: 50px;">
                            <div class="mb-1 mt-3">
                                <h3>{{ $customer->name }}</h3>
                            </div>

                            <div class="mt-3">
                                <label>
                                    Last updated {{ $customer->updated_at->diffForHumans() }}
                                    @if ($customer->updated_by)
                                        by {{ $customer->updated_by }}
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="file" name="customer_photo" id="customer_photo" class="form-control" accept="image/*">

            {{-- Customer Details --}}
            <div class="card mt-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Customer Details</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#customerDetails" aria-expanded="false"
                        aria-controls="customerDetails">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="customerDetails">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="mb-3">
                            <label class="mb-3">Name : <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="mb-3">Nick Name :</label>
                            <input type="text" class="form-control" name="nickname"
                                value="{{ $customer->nickname ?? null }}">
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

                            <div class="row d-flex justify-content-between">
                                <div class="col mb-3">
                                    <label class="mb-3">Age :</label>
                                    <input type="number" class="form-control" name="age" min="1"
                                        value="{{ $customer->age ?? null }}">
                                </div>

                                <div class="col mb-3">
                                    <label class="mb-3">IC Number :</label>
                                    <input type="number" class="form-control" name="identification_number"
                                        id="identification_number" value="{{ $customer->identification_number ?? null }}">
                                    <div id="identification_number_error" class="text-danger mt-2" style="font-size: 9pt;">
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label class="mb-3">Phone Number :</label>
                                    <input type="tel" class="form-control" name="phone"
                                        value="{{ $customer->phone }}" readonly>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between">
                                <div class="col mb-3">
                                    <label class="mb-3">Weight (kg) :</label>
                                    <input type="number" class="form-control" name="weight" min="1"
                                        value="{{ $customer->weight ?? null }}">
                                </div>

                                <div class="col mb-3">
                                    <label class="mb-3">Height (cm) :</label>
                                    <input type="number" class="form-control" name="height" min="1"
                                        value="{{ $customer->height ?? null }}">

                                    @if ($customer->height != null && $customer->weight != null)
                                        @php
                                            $heightInMeters = $customer->height / 100; // Convert height from cm to meters
                                            $bmi = $customer->weight / ($heightInMeters * $heightInMeters); // Calculate BMI

                                            if ($bmi < 18.5) {
                                                $status = 'Underweight';
                                            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                                                $status = 'Normal';
                                            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                                                $status = 'Overweight';
                                            } elseif ($bmi > 30) {
                                                $status = 'Obesity';
                                            }
                                        @endphp

                                        <label class="mt-2">BMI: {{ $status }}</label>
                                    @endif
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
            </div>

            {{-- Customer Address --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Customer Address</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#customerAddress" aria-expanded="false"
                        aria-controls="customerAddress">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="customerAddress">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="mb-3">
                            <label class="mb-3">Address :</label>
                            <div>
                                <textarea name="address" class="form-control" cols="50" rows="4">{{ $customer->address ?? null }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-3">City :</label>
                            <div>
                                <input type="text" class="form-control" name="city"
                                    value="{{ $customer->city ?? null }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="mb-3">Postcode :</label>
                                <input type="number" class="form-control" name="postcode"
                                    value="{{ $customer->postcode ?? null }}">
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
                                <input type="text" class="form-control" value="{{ $customer->country ?? null }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="mb-3">Place of Birth :</label>
                                <input type="text" class="form-control" name="birth_place"
                                    value="{{ $customer->birth_place ?? null }}">
                            </div>

                            <div class="col mb-3">
                                <label class="mb-3">State of Birth :</label>
                                <select name="birth_state" class="form-select">
                                    <option selected disabled>Please Select</option>
                                    @foreach ($states as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($customer->birth_state) && $row->id == $customer->birth_state ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Occupation --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Occupation</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#occupation" aria-expanded="false"
                        aria-controls="occupation">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="occupation">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <label class="mb-3">Occupation :</label>
                                <div>
                                    <input type="text" class="form-control" name="occupation"
                                        value="{{ $customer->occupation ?? null }}">
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
                                        value="{{ $customer->identification_number_police ?? null }}">
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
            </div>

            {{-- Family --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Family</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#family" aria-expanded="false"
                        aria-controls="family">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="family">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="mb-3">
                            <label class="mb-3">Child Birth Order
                                :</label>
                            <input type="number" class="form-control" name="birth_order"
                                value="{{ $customer->birth_order ?? null }}">
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
                            <input type="number" class="form-control" name="spouse_age"
                                value="{{ $customerSpouse->age }}">
                        </div>

                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div>
                                <label class="mb-3">Number of children :</label>
                                <input type="number" class="form-control" name="number_of_children"
                                    id="number_of_children" value="{{ $customer->number_of_children ?? null }}">
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-secondary btn-lg" onclick="addChildFields()" type="button">
                                    <i class='bx bx-child'></i> Add Child Information
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Child --}}
            <div style="display: flex; flex-wrap: wrap; justify-content: flex-end;">
                @foreach ($customerChildren as $index => $child)
                    <div class="card mt-4" style="width: 900px;">
                        <div class="card-header d-flex align-items-center justify-content-between childHeader">
                            <h5><strong>Child {{ $index + 1 }}</strong></h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="childId_{{ $index + 1 }}" value="{{ $child->id }}">
                            <label class="mb-2">Name:</label>
                            <input type="text" name="childName_{{ $index + 1 }}" class="form-control mb-3"
                                value="{{ $child->name }}">
                            <label class="mb-2">Age:</label>
                            <input type="number" name="childAge_{{ $index + 1 }}" class="form-control mb-3"
                                value="{{ $child->age }}">
                            <label class="mb-2">Education:</label>
                            <input type="text" name="childEducation_{{ $index + 1 }}" class="form-control mb-3"
                                value="{{ $child->institution }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="childContainer" style="display: flex; flex-wrap: wrap; justify-content: flex-end;"></div>

            {{-- Others --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Others</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#others" aria-expanded="false"
                        aria-controls="others">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="others">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mb-3">Hobby :</label>
                                <input type="text" class="form-control" name="hobby"
                                    value="{{ $customerAdditionalInfo->hobby ?? null }}">
                            </div>

                            <div class="col">
                                <label class="mb-3">Favourite Colour :</label>
                                <input type="text" class="form-control" name="fav_color"
                                    value="{{ $customerAdditionalInfo->fav_color ?? null }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mb-3">Favourite Pet :</label>
                                <input type="text" class="form-control" name="fav_pet"
                                    value="{{ $customerAdditionalInfo->fav_pet ?? null }}">
                            </div>

                            <div class="col">
                                <label class="mb-3">Favourite Food :</label>
                                <input type="text" class="form-control" name="fav_food"
                                    value="{{ $customerAdditionalInfo->fav_food ?? null }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="mb-3">Favourite Drinks :</label>
                                <input type="text" class="form-control" name="fav_beverage"
                                    value="{{ $customerAdditionalInfo->fav_beverage ?? null }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Suffering Disease --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Suffering Disease</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#sufferingDisease" aria-expanded="false"
                        aria-controls="sufferingDisease">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="sufferingDisease">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="mb-3">
                            <label class="mb-3">Disease :</label>
                            <select name="tag_id[]" id="tom_select" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ $customer->tags->contains('id', $tag->id) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="mb-3">Other Disease :</label>
                            <input type="text" class="form-control" name="additional_tags"
                                value="{{ $customer->additional_tags ?? null }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product & Service --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Product & Service</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#product" aria-expanded="false"
                        aria-controls="product">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="product">
                    <div class="card-body" data-bs-parent="#accordion">
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
                                <input type="checkbox" name="how_did_you_know_about_emzi[]" value="1"
                                    {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->whereNull('deleted_at')->pluck('value')->contains('1')? 'checked': '' }}>
                                <label class="ms-1">Social Media</label>
                                <input type="checkbox" name="how_did_you_know_about_emzi[]" class="ms-3"
                                    value="2"
                                    {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->whereNull('deleted_at')->pluck('value')->contains('2')? 'checked': '' }}>
                                <label class="ms-1">Friends</label>
                                <input type="checkbox" name="how_did_you_know_about_emzi[]" class="ms-3"
                                    value="3"
                                    {{ $customerAnswers->where('question_id', 2)->where('customer_id', $customer->id)->whereNull('deleted_at')->pluck('value')->contains('3')? 'checked': '' }}>
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
            </div>

            {{-- Service Rating --}}
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><strong>Service Rating</strong></h5>
                    <a class="btn" data-bs-toggle="collapse" href="#serviceRating" aria-expanded="false"
                        aria-controls="serviceRating">
                        <strong><i class='bx bx-chevron-down'></i></strong>
                    </a>
                </div>
                <div class="collapse show" id="serviceRating">
                    <div class="card-body ms-4" data-bs-parent="#accordion">
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
            </div>

            {{-- Save Button --}}
            <div class="buy-now">
                <button type="submit" id="submit_button" class="btn btn-primary btn-lg btn-buy-now" disabled>
                    <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status"
                        aria-hidden="true"></span>
                    SAVE CHANGES
                </button>
            </div>
        </form>
    </div>

    {{-- For submit form --}}
    <script>
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var form = this;

            // Perform form submission via AJAX
            axios.post(form.action, new FormData(form))
                .then(function(response) {
                    // Show SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.data.message,
                        showConfirmButton: true
                    }).then(function() {
                        // Redirect to customer list page after SweetAlert is closed
                        window.location.href = "{{ route('customer.list') }}";
                    });
                })
                .catch(function(error) {
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.response.data.message,
                        showConfirmButton: true
                    }).then(function() {
                        // Reload the page after SweetAlert is closed
                        location.reload();
                    });
                });
        });
    </script>

    {{-- For adding child --}}
    <script>
        let childCount = {{ $customerChildren->count() }};

        function addChildFields() {
            const container = document.getElementById('childContainer');
            childCount += 1;

            const card = document.createElement('div');
            card.classList.add('card', 'mt-4');
            card.style.width = '900px';

            const cardHeader = document.createElement('div');
            cardHeader.classList.add('card-header', 'd-flex', 'align-items-center', 'justify-content-between');
            const headerTitle = document.createElement('h5');
            headerTitle.innerHTML = `<strong>Child ${childCount}</strong>`; // Adjusted title here
            const removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.innerHTML = 'x';
            removeButton.onclick = function() {
                container.removeChild(card);
                childCount -= 1;
                updateCardTitles();
            };

            cardHeader.appendChild(headerTitle);
            cardHeader.appendChild(removeButton);

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            // Function to create input field with label and margin below
            function createInputWithLabel(labelText, type, inputName) {
                const label = document.createElement('label');
                label.innerText = labelText + ':';
                label.classList.add('mb-2');
                const input = document.createElement('input');
                input.setAttribute('type', type);
                input.setAttribute('name', inputName);
                input.classList.add('form-control', 'mb-3');
                cardBody.appendChild(label);
                cardBody.appendChild(input);
            }

            createInputWithLabel('Name', 'text', `childName_${childCount}`);
            createInputWithLabel('Age', 'number', `childAge_${childCount}`);
            createInputWithLabel('Education', 'text', `childEducation_${childCount}`);

            card.appendChild(cardHeader);
            card.appendChild(cardBody);

            container.appendChild(card);
        }

        function updateCardTitles() {
            const cards = document.querySelectorAll('#childContainer .card');
            cards.forEach((card, index) => {
                const headerTitle = card.querySelector('.card-header h5');
                headerTitle.innerHTML = `<strong>Child ${index + 1}</strong>`;
            });
        }
    </script>

    {{-- Prevent non-numeric / ic validation / loader for button --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const identificationNumberInput = document.getElementById('identification_number');
            const errorDiv = document.getElementById('identification_number_error');
            const submitButton = document.getElementById('submit_button');
            const form = document.getElementById('updateForm');
            const spinner = document.getElementById('spinner');

            function validateInput() {
                const value = identificationNumberInput.value.replace(/[^0-9]/g, '');

                if (value.length < 12 && value.length != 0) {
                    errorDiv.textContent = 'IC Number must be at least 12 digits long.';
                    submitButton.disabled = true;
                } else {
                    errorDiv.textContent = '';
                    submitButton.disabled = false;
                }

                identificationNumberInput.value = value;
            }

            identificationNumberInput.addEventListener('input', function(e) {
                validateInput();
            });

            identificationNumberInput.addEventListener('keydown', function(e) {
                // Allow navigation keys and backspace, delete
                if (
                    e.key === 'Backspace' ||
                    e.key === 'Delete' ||
                    e.key === 'ArrowLeft' ||
                    e.key === 'ArrowRight' ||
                    e.key === 'Tab'
                ) {
                    return;
                }

                // Prevent any non-numeric character except for digits
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            form.addEventListener('submit', function(e) {
                const identificationNumber = identificationNumberInput.value;
                if (identificationNumber.length < 12 && identificationNumber.length != 0) {
                    e.preventDefault();
                    errorDiv.textContent = 'IC Number must be at least 12 digits long.';
                } else {
                    // Show spinner and disable the button
                    spinner.classList.remove('d-none');
                    submitButton.disabled = true;
                }
            });

            // Initial validation check in case the input is pre-filled
            validateInput();
        });
    </script>

    {{-- For customer photo --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const photo = document.getElementById('customer-photo');
            const fileInput = document.getElementById('customer_photo');

            photo.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photo.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    {{-- For star rating --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to update star classes based on database value
            function updateStars(value, starContainer) {
                const stars = starContainer.querySelectorAll('.star');
                stars.forEach((star, index) => {
                    if (index < value) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }

            // Function to handle user click on stars
            document.querySelectorAll('.star-rating').forEach(starContainer => {
                starContainer.querySelectorAll('.star').forEach(star => {
                    star.addEventListener('click', function() {
                        const value = parseInt(this.getAttribute('data-value'));
                        updateStars(value, starContainer);
                    });
                });

                // Assume you retrieve the value from the database here for each rating
                const databaseValue = parseInt(starContainer.dataset.rating);
                updateStars(databaseValue, starContainer);
            });

            document.querySelectorAll('.star-rating .star').forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    const ratingInput = this.closest('.star-rating').querySelector(
                        'input[type="hidden"]');
                    if (ratingInput) {
                        ratingInput.value = value;
                    }
                });
            });
        });
    </script>
@endsection
