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

        {{-- Shipping Information --}}
        <div class="card mt-5 w-50">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Shipping Information</strong></h5>
            </div>
            <div class="card-body">
                <div class="row p-2 mb-3">
                    <label class="col-sm-6">Customer Address
                        :</label>
                    <div class="col-sm-6 text-end">
                        @if ($customer->address != null || $customer->postcode != null || $customer->city != null)
                            {{ $customer->address }}
                            <br>
                            {{ $customer->postcode }} {{ $customer->city }}
                            <br>
                            {{ $customer->state_name }}
                            <br>
                            {{ $customer->country_name }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>

                @if ($customer->receiverAddresses->where('deleted_at', null)->isNotEmpty())
                    @foreach ($customer->receiverAddresses->where('deleted_at', null) as $index => $receiverAddress)
                        <div class="row p-2 my-3">
                            <hr class="border-light my-3" />
                            <label class="col-sm-6">Receiver Address {{ $index + 1 }}</label>
                            <div class="col-sm-6 text-end">
                                {{ $receiverAddress->address }}
                                <br>
                                {{ $receiverAddress->postcode }} {{ $receiverAddress->city }}
                                <br>
                                @if ($receiverAddress->state)
                                    {{ $receiverAddress->state->name }}
                                    <br>
                                    {{ $receiverAddress->state->country->name }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Customer Details --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Customer Details</strong></h5>
                <a class="btn" data-bs-toggle="collapse" href="#customerDetails" aria-expanded="false"
                    aria-controls="customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="collapse show" id="customerDetails">
                <div class="card-body" data-bs-parent="#accordion">
                    <div class="row p-4 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row my-3">
                                <label class="col-sm-4">Name :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->name ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-4">Nick Name :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->nickname ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-2">Titles :</label>
                                <div class="col-sm-10 text-end">
                                    {{ $customer->title ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-3">Gender :</label>
                                <div class="col-sm-9 text-end">
                                    @php
                                        if ($customer) {
                                            if ($customer->gender === 'M') {
                                                $gender = 'Male';
                                            } elseif ($customer->gender === 'F') {
                                                $gender = 'Female';
                                            } else {
                                                $gender = 'N/A';
                                            }
                                        } else {
                                            $gender = 'N/A';
                                        }
                                    @endphp
                                    {{ $gender }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-4">Marital Status :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->status ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-2">Age :</label>
                                <div class="col-sm-10 text-end">
                                    {{ $customer->age ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row my-3">
                                <label class="col-sm-4">IC Number :</label>
                                <div class="col-sm-8 text-end">
                                    @php
                                        $icNumber = $customer->identification_number ?? null;
                                        if ($icNumber == null) {
                                            $maskedIC = 'N/A';
                                        } else {
                                            $maskedIC = str_pad(
                                                substr($icNumber, -4),
                                                strlen($icNumber),
                                                '*',
                                                STR_PAD_LEFT,
                                            );
                                        }
                                    @endphp
                                    {{ $maskedIC }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-4">Phone Number :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->phone ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-4">Weight (KG) :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->weight ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
                                <label class="col-sm-4">Height (cm) :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->height ?? 'N/A' }}
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row my-3">
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

                            <div class="row my-3">
                                <label class="col-sm-4">Blood Type :</label>
                                <div class="col-sm-8 text-end">
                                    {{ $customer->blood_type ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Customer Address --}}
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Customer Address</strong></h5>
                        <a class="btn" data-bs-toggle="collapse" href="#customerAddress" aria-expanded="false" aria-controls="customerAddress">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="collapse show" id="customerAddress">
                    <div class="card-body" data-bs-parent="#accordion">
                        <div class="row p-4 d-flex align-items-center justify-content-between">
                            <div class="row mb-3">
                                <label class="col-sm-6">Customer Address
                                    :</label>
                                <div class="col-sm-6 text-end">
                                    @if ($customer->address != null || $customer->postcode != null || $customer->city != null)
                                        {{ $customer->address }}
                                        <br>
                                        {{ $customer->postcode }} {{ $customer->city }}
                                        <br>
                                        {{ $customer->state_name }}
                                        <br>
                                        {{ $customer->country_name }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Place of Birth
                                    :</label>
                                <div class="col-sm-8 text-end">
                                    @if ($customer->birth_place != null)
                                        {{ $customer->birth_place ?? 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">State of Birth
                                    :</label>
                                <div class="col-sm-8 text-end">
                                    @if ($customer->birth_state != null)
                                        @foreach ($states as $row)
                                            @if (isset($customer->birth_state) && $row->id == $customer->birth_state)
                                                {{ $row->name ?? 'N/A' }}
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Occupation</strong></h5>
                        <a class="btn" data-bs-toggle="collapse" href="#occupation" aria-expanded="false" aria-controls="occupation">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="collapse show" id="occupation">
                    <div class="card-body" data-bs-parent="#accordion">
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
                    </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Family --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Family</strong></h5>
                <a class="btn" data-bs-toggle="collapse" href="#family" aria-expanded="false" aria-controls="family">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="collapse show" id="family">
            <div class="card-body" data-bs-parent="#accordion">
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
            </div>
            </div>
        </div>

        {{-- Others & Suffering Disease --}}
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Others</strong></h5>
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#others" aria-expanded="false"
                            aria-controls="others">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="collapse show" id="others">
                    <div class="card-body" data-bs-parent="#accordion">
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
                                        value="{{ $customer->customerAdditionalInfos->fav_color ?? 'N/A' }}" readonly />
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
                                        value="{{ $customer->customerAdditionalInfos->fav_food ?? 'N/A' }}" readonly />
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
                    </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mt-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><strong>Suffering Disease</strong></h5>
                        <a class="btn" data-bs-toggle="collapse" href="#sufferingDisease" aria-expanded="false" aria-controls="sufferingDisease">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="collapse show" id="sufferingDisease">
                    <div class="card-body" data-bs-parent="#accordion"
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
        </div>

        {{-- Product & Service --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Product & Service</strong></h5>
                <a class="btn" data-bs-toggle="collapse" href="#productService" aria-expanded="false" aria-controls="productService">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="collapse show" id="productService">
            <div class="card-body" data-bs-parent="#accordion">
                <div class="row p-4 d-flex align-items-center justify-content-between">
                    <div class="col-md-5">
                        <div class="row mb-3">
                            <label class="col-sm-7">Does EMZI familiar to you?:</label>
                            <div class="col-sm-5 text-end">
                                @php
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 1);

                                    if ($answer) {
                                        if ($answer->value === 'Y') {
                                            $customer_answer = 'Yes';
                                        } elseif ($answer->value === 'N') {
                                            $customer_answer = 'No';
                                        } else {
                                            $customer_answer = 'N/A';
                                        }
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
                                    $answers = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->where('question_id', 2);
                                @endphp
                                @if ($answers->isNotEmpty())
                                    @foreach ($answers as $answer)
                                        @switch($answer->value)
                                            @case(1)
                                                <span>Social Media</span>
                                            @break

                                            @case(2)
                                                <span>Friends</span>
                                            @break

                                            @case(3)
                                                <span>Website</span>
                                            @break

                                            @default
                                                <span>N/A</span>
                                        @endswitch
                                        @if (!$loop->last)
                                            <span>, </span>
                                        @endif
                                    @endforeach
                                @else
                                    <span>N/A</span>
                                @endif
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-7">First EMZI Product Purchased?:</label>
                            <div class="col-sm-5 text-end">
                                @php
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 3);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Reason of buying EMZI Products?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 4);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6 mt-1">Why Support EMZI product?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 5);
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
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 6);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">What Products Does EMZI Have?:</label>
                            <div class="col-sm-6 text-end">
                                @php
                                    $answer = $customer->customerAnswers
                                        ->whereNull('deleted_at')
                                        ->firstWhere('question_id', 7);
                                @endphp
                                {{ $answer->value ?? 'N/A' }}
                            </div>
                            <hr class="border-light mt-2" />
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-6">Do you know that EMZI has its own factory?:</label>
                            @php
                                $answer = $customer->customerAnswers
                                    ->whereNull('deleted_at')
                                    ->firstWhere('question_id', 8);

                                if ($answer) {
                                    if ($answer->value === 'Y') {
                                        $customer_answer = 'Yes';
                                    } elseif ($answer->value === 'N') {
                                        $customer_answer = 'No';
                                    } else {
                                        $customer_answer = 'N/A';
                                    }
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
                                $answer = $customer->customerAnswers
                                    ->whereNull('deleted_at')
                                    ->firstWhere('question_id', 9);

                                if ($answer) {
                                    if ($answer->value === 'Y') {
                                        $customer_answer = 'Yes';
                                    } elseif ($answer->value === 'N') {
                                        $customer_answer = 'No';
                                    } else {
                                        $customer_answer = 'N/A';
                                    }
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
                                $answer = $customer->customerAnswers
                                    ->whereNull('deleted_at')
                                    ->firstWhere('question_id', 10);
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
        </div>

        {{-- Service Rating --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Service Rating</strong></h5>
                <a class="btn" data-bs-toggle="collapse" href="#serviceRating" aria-expanded="false" aria-controls="serviceRating">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="collapse show" id="serviceRating">
            <div class="card-body ms-4" data-bs-parent="#accordion">
                <div class="row mb-3">
                    <label for="deliveryService">Delivery Service:</label>
                    <div class="star-rating" name="delivery_service"
                        data-rating="{{ optional($customer->customerAnswers->whereNull('deleted_at')->firstWhere('question_id', 11))->value ?? 0 }}">
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
                        data-rating="{{ optional($customer->customerAnswers->whereNull('deleted_at')->firstWhere('question_id', 12))->value ?? 0 }}">
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
                        data-rating="{{ optional($customer->customerAnswers->whereNull('deleted_at')->firstWhere('question_id', 13))->value ?? 0 }}">
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
                        data-rating="{{ optional($customer->customerAnswers->whereNull('deleted_at')->firstWhere('question_id', 14))->value ?? 0 }}">
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
    </div>

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
