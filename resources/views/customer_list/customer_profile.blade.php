@extends('template.main')

@section('content')
    <div class="container mt-5">
        <h3 class="text-dark"><strong>Customer Profile</strong></h3>
    </div>

    <div class="container">
        {{-- Customer Photo --}}
        <div class="card mt-3 p-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{ $customer->photo ? asset($customer->photo) : asset('assets/img/avatars/user.jpeg') }}"
                            class="w-px-100 h-px-100 rounded-circle customer-photo" />
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
                            <label>Last updated {{ $customer->updated_at->diffForHumans() }} by
                                {{ $customer->updated_by }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Customer Details --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Customer Details</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <form action="">
                    <div class="row p-4 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-2">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->name ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Nick Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->nickname ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">Titles :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->title ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Gender :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->gender == 'M' ? 'Male' : 'Female' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Marital Status :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->status ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">Age :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->age ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-4">IC Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->identification_number ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->phone ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Weight (KG) : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->weight ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Height (cm) :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->height ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">BMI :</label>
                                <div class="col-sm-10 text-end">
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
                                        {{ $status }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Blood Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->blood_type ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Customer Address --}}
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Customer Address</strong></h5>
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#customerAddress">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="customerAddress" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-6">Customer Address
                                        :</label>
                                    <div class="col-sm-6 text-end">
                                        {{ $customer->address }}
                                        <br>
                                        {{ $customer->postcode }} {{ $customer->city }}
                                        <br>
                                        {{ $customer->state_name }}
                                        <br>
                                        {{ $customer->country_name }}
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Place of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->birth_place ?? 'N/A' }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">State of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        @foreach ($states as $row)
                                            @if (isset($customer->birth_state) && $row->id == $customer->birth_state)
                                                <input type="text" class="form-control border-0 text-end bg-white"
                                                    value="{{ $row->name ?? 'N/A' }}" readonly />
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Occupation</strong></h5>
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#occupation">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="occupation" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-4">Occupation :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->occupation ?? 'N/A' }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Sector
                                        :</label>
                                    <div class="col-sm-8">
                                        @php
                                            if ($customer->sector == 'P') {
                                                $sector = 'Private';
                                            } elseif ($customer->sector == 'G') {
                                                $sector = 'Government';
                                            } else {
                                                $sector = 'N/A';
                                            }
                                        @endphp
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $sector }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-6">IC Number Police/
                                        Military
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->identification_number_police != null ? $customer->identification_number_police : 'N/A' ?? 'N/A' }}"
                                            readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Salary Range
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->salary ?? 'N/A' }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Working Hour
                                        :</label>
                                    <div class="col-sm-8">
                                        @php
                                            if ($customer->working_hour == 'N') {
                                                $working_hour = 'Normal';
                                            } elseif ($customer->working_hour == 'S') {
                                                $working_hour = 'Shift';
                                            } else {
                                                $working_hour = 'N/A';
                                            }
                                        @endphp
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $working_hour }}" readonly />
                                    </div>
                                </div>
                            </div>
                        </form>
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
                <form action="">
                    <div class="row p-3 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-6">Child Birth Order
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->birth_order ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Number of children
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->customerChildrens->whereNull('deleted_at')->count() ?? 'N/A' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Spouse Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->customerSpouse->name ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Spouse Occupation
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->customerSpouse->occupation ?? 'N/A' }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Spouse Age :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->customerSpouse->age ?? 'N/A' }}" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="text-dark">Children Information</label>
                            @if ($customer->customerChildrens->isEmpty())
                                <div class="container border rounded my-3 p-3">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 mt-2">Name :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="N/A" readonly />
                                        </div>
                                        <hr class="border-light mt-2" />
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4">Age :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="N/A" readonly />
                                        </div>
                                        <hr class="border-light mt-2" />
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-6 mb-3">Education Institution/ Workplace :</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="N/A" readonly />
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach ($customer->customerChildrens as $row)
                                    @if (is_null($row->deleted_at))
                                        <div class="container border rounded my-3 p-3">
                                            <div class="row mb-3">
                                                <label class="col-sm-4 mt-2">Name :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control border-0 text-end bg-white"
                                                        value="{{ $row->name ?? 'N/A' }}" readonly />
                                                </div>
                                                <hr class="border-light mt-2" />
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-4">Age :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control border-0 text-end bg-white"
                                                        value="{{ $row->age ?? 'N/A' }}" readonly />
                                                </div>
                                                <hr class="border-light mt-2" />
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-6 mb-3">Education Institution/ Workplace :</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control border-0 text-end bg-white"
                                                        value="{{ $row->institution ?? 'N/A' }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- Others & Suffering Disease --}}
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Others</strong></h5>
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#others">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="others" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-6">Hobby
                                        :</label>
                                    <div class="col-sm-6 text-end">
                                        {{ $customer->customerAdditionalInfos->hobby ?? 'N/A' }}
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Colour
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->customerAdditionalInfos->fav_color ?? 'N/A' }}"
                                            readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Pet
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->customerAdditionalInfos->fav_pet ?? 'N/A' }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Food
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->customerAdditionalInfos->fav_food ?? 'N/A' }}"
                                            readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Drinks
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->customerAdditionalInfos->fav_beverage ?? 'N/A' }}"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Suffering Disease</strong></h5>
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#sufferingDisease">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="sufferingDisease" data-bs-parent="#accordion"
                        style="display: flex; flex-wrap: wrap; gap: 10px; font-size: 8pt;">
                        @foreach ($customer->tags as $tag)
                            <span class="rounded-pill p-2" style="background-color: #d6d6ff;">
                                #{{ $tag->name }}
                            </span>
                        @endforeach

                        @if ($customer->additional_tags != null)
                            <span class="rounded-pill p-2" style="background-color: #d6d6ff;">
                                #{{ $customer->additional_tags }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        {{-- Product & Service --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Product & Service</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#productService">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="productService" data-bs-parent="#accordion">
                <div class="row p-4 d-flex align-items-center justify-content-between">
                    <div class="col-md-5">
                        <div class="row mb-3">
                            <label class="col-sm-7">Does EMZI familiar to you?:</label>
                            <div class="col-sm-5 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 1);

                                    if ($answer->value === 'Y') {
                                        $customer_answer = 'Yes';
                                    } elseif ($answer->value === 'N') {
                                        $customer_answer = 'No';
                                    } else {
                                        $customer_answer = 'N/A';
                                    }
                                @endphp
                                {{ $customer_answer }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Where did you know about EMZI?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 2);
                                @endphp
                                @switch($answer->value ?? 'N/A')
                                    @case(1)
                                        Social Media
                                    @break

                                    @case(2)
                                        Friends
                                    @break

                                    @case(3)
                                        Website
                                    @break

                                    @default
                                        N/A
                                @endswitch
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-7">First EMZI Product Purchased?:</label>
                            <div class="col-sm-5 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 3);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Reason of buying EMZI Products?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 4);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6 mt-1">Why Support EMZI product?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 5);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="row mb-3">
                            <label class="col-sm-6">Purchase Frequency:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 6);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">What Products Does EMZI Have?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers->firstWhere('question_id', 7);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Do you know that EMZI has its own factory?:</label>
                            @php
                                $answer = $customer->customerAnswers->firstWhere('question_id', 8);

                                if ($answer->value === 'Y') {
                                    $customer_answer = 'Yes';
                                } elseif ($answer->value === 'N') {
                                    $customer_answer = 'No';
                                } else {
                                    $customer_answer = 'N/A';
                                }
                            @endphp
                            <div class="col-sm-6 text-end">
                                {{ $customer_answer }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Do you know that EMZI has a laboratory at the university?:</label>
                            @php
                                $answer = $customer->customerAnswers->firstWhere('question_id', 9);

                                if ($answer->value === 'Y') {
                                    $customer_answer = 'Yes';
                                } elseif ($answer->value === 'N') {
                                    $customer_answer = 'No';
                                } else {
                                    $customer_answer = 'N/A';
                                }
                            @endphp
                            <div class="col-sm-6 text-end">
                                {{ $customer_answer }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-7 mt-2">Does EMZI Products Effective?:</label>
                            @php
                                $answer = $customer->customerAnswers->firstWhere('question_id', 10);
                            @endphp
                            <div class="col-sm-5 text-end">
                                @switch($answer->value ?? 'N/A')
                                    @case(1)
                                        Yes, Highly Effective
                                    @break

                                    @case(2)
                                        Less Effective
                                    @break

                                    @case(3)
                                        Not Effective
                                    @break

                                    @default
                                        N/A
                                @endswitch
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
                <a class="collapsed btn" data-bs-toggle="collapse" href="#serviceRating">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body ms-4" id="serviceRating" data-bs-parent="#accordion">
                <div class="row mb-3">
                    <label for="deliveryService">Delivery Service:</label>
                    <div class="star-rating" name="delivery_service"
                        data-rating="{{ optional($customer->customerAnswers->firstWhere('question_id', 11))->value ?? 0 }}">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="customerService">Customer Service:</label>
                    <div class="star-rating" name="customer_service"
                        data-rating="{{ optional($customer->customerAnswers->firstWhere('question_id', 12))->value ?? 0 }}">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="productQuality">Product Quality:</label>
                    <div class="star-rating" name="product_quality"
                        data-rating="{{ optional($customer->customerAnswers->firstWhere('question_id', 13))->value ?? 0 }}">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="productQuantity">Product Quantity:</label>
                    <div class="star-rating" name="product_quantity"
                        data-rating="{{ optional($customer->customerAnswers->firstWhere('question_id', 14))->value ?? 0 }}">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
