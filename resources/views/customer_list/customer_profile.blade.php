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
    </style>

    <div class="container mt-5">
        <h3 class="text-dark"><strong>Customer Profile</strong></h3>
    </div>

    <div class="container">
        <div class="card mt-3 p-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{ $customer->photo != null ? $customer->photo : asset('assets/img/avatars/user.jpeg') }}"
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
                                        value="{{ $customer->name }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Nick Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->nickname }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">Titles :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->title }}" readonly />
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
                                        value="{{ $customer->status }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">Age :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->age }}" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-4">IC Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->identification_number }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->phone }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Weight (KG) : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->weight }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Height (cm) :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->height }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2">BMI :</label>
                                @if ($customer->height != null && $customer->weight != null)
                                    @php
                                        $heightInMeters = $customer->height / 100; // Convert height from cm to meters
                                        $bmi = $customer->weight / ($heightInMeters * $heightInMeters); // Calculate BMI
                                    @endphp

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ number_format($bmi, 2) }}" readonly />
                                    </div>
                                @else
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="N/A" readonly />
                                    </div>
                                @endif
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3">Blood Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customer->blood_type }}" readonly />
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
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->address }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Place of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->birth_place }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">State of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->state_name }}" readonly />
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
                                            value="{{ $customer->occupation }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Sector
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->sector === 'P' ? 'Private' : 'Government' }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-6">IC Number Police/
                                        Military
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->identification_number_police != null ? $customer->identification_number_police : 'N/A' }}"
                                            readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Salary Range
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->salary }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Working Hour
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customer->working_hour == 'S' ? 'Shift' : 'Normal' }}" readonly />
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
                                        value="{{ $customer->birth_order }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Number of children
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $numberOfChild }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Spouse Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerSpouse->name }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Spouse Occupation
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerSpouse->occupation }}" readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4">Spouse Age :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerSpouse->age }}" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="text-dark">Children Information</label>
                            @foreach ($customerChildren as $row)
                                <div class="container border rounded my-3 p-3">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 mt-2">Name :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="{{ $row->name }}" readonly />
                                        </div>
                                        <hr class="border-light mt-2" />
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-4">Age :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="{{ $row->age }}" readonly />
                                        </div>
                                        <hr class="border-light mt-2" />
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-6 mb-3">Education
                                            Institution/ Workplace :</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="{{ $row->institution }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-6">Hobby
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customerAdditionalInfo->hobby }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Colour
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customerAdditionalInfo->fav_color }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Pet
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customerAdditionalInfo->fav_pet }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Food
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customerAdditionalInfo->fav_food }}" readonly />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4">Favourite Drinks
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0 text-end bg-white"
                                            value="{{ $customerAdditionalInfo->fav_beverage }}" readonly />
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
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="customerDetails" data-bs-parent="#accordion"
                        style="display: flex; flex-wrap: wrap; gap: 10px; font-size: 8pt;">
                        <span class="rounded-pill p-2" style="background-color: #d6d6ff;">#DarahTinggi</span>
                        <span class="rounded-pill p-2" style="background-color: #d6d6ff;">#Kolestrol</span>
                        <span class="rounded-pill p-2" style="background-color: #d6d6ff;">#KencingManis</span>
                        <span class="rounded-pill p-2" style="background-color: #d6d6ff;">#Jantung</span>
                        <span class="rounded-pill p-2" style="background-color: #d6d6ff;">#KencingMember</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product & Service --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Product & Service</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <form action="">
                    <div class="row p-4 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-7">Does EMZI familiar to you?
                                    :</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 1)->where('customer_id', $customer->id)->first()->value === 'Y'? 'Yes': 'No' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Where did you know about
                                    EMZI? :</label>
                                <div class="col-sm-6">
                                    @switch($customerAnswers->where('question_id', 2)->where('customer_id',
                                        $customer->id)->first()->value)
                                        @case(1)
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="Social Media" readonly />
                                        @break

                                        @case(2)
                                            <input type="text" class="form-control border-0 text-end bg-white" value="Friends"
                                                readonly />
                                        @break

                                        @case(3)
                                            <input type="text" class="form-control border-0 text-end bg-white" value="Website"
                                                readonly />
                                        @break

                                        @default
                                            <input type="text" class="form-control border-0 text-end bg-white" value="N/A"
                                                readonly />
                                    @endswitch
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-7">First EMZI Product
                                    Purchased? :</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 3)->where('customer_id', $customer->id)->first()->value ?? 'N/A' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Reason of buying EMZI
                                    Products? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 4)->where('customer_id', $customer->id)->first()->value ?? 'N/A' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Why Support EMZI product?
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 5)->where('customer_id', $customer->id)->first()->value ?? 'N/A' }}"
                                        readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-6">Purchase Frequency
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 6)->where('customer_id', $customer->id)->first()->value ?? 'N/A' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">What Products Does EMZI
                                    Have? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 7)->where('customer_id', $customer->id)->first()->value ?? 'N/A' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Do you know that EMZI has
                                    its own factory? : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 8)->where('customer_id', $customer->id)->first()->value === 'Y'? 'Yes': 'No' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6">Do you know that EMZI has
                                    a laboratory at the university? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0 text-end bg-white"
                                        value="{{ $customerAnswers->where('question_id', 9)->where('customer_id', $customer->id)->first()->value === 'Y'? 'Yes': 'No' }}"
                                        readonly />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-7">Does EMZI Products
                                    Effective? :</label>
                                <div class="col-sm-5">
                                    @switch($customerAnswers->where('question_id', 10)->where('customer_id',
                                        $customer->id)->first()->value)
                                        @case(1)
                                            <input type="text" class="form-control border-0 text-end bg-white"
                                                value="Yes, Highly Effective" readonly />
                                        @break

                                        @case(2)
                                            <input type="text" class="form-control border-0 text-end bg-white" value="Less Effective"
                                                readonly />
                                        @break

                                        @case(3)
                                            <input type="text" class="form-control border-0 text-end bg-white" value="Not Effective"
                                                readonly />
                                        @break

                                        @default
                                            <input type="text" class="form-control border-0 text-end bg-white" value="N/A"
                                                readonly />
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Service Rating --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Service Rating</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body ms-4" id="customerDetails" data-bs-parent="#accordion">
                <div class="row mb-3">
                    <label for="deliveryService">Delivery Service:</label>
                    <div class="star-rating" data-rating="">
                        <span class="star active" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="deliveryService">Customer Service:</label>
                    <div class="star-rating" data-rating="">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="deliveryService">Product Quality:</label>
                    <div class="star-rating" data-rating="">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="deliveryService">Product Quantity:</label>
                    <div class="star-rating" data-rating="">
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
