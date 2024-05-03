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
                        <img src="../assets/img/avatars/5.png" class="w-px-100 h-px-100 rounded-circle" />
                    </div>

                    <div class="col-md-4 float-start" style="margin-left: 50px;">
                        <div class="mb-1">
                            <h3>Muhammad Sumbul</h3>
                        </div>

                        <div class="mb-0">
                            <label>LAST PURCHASE</label>
                            &nbsp;
                            <label class="text-success">10 days ago</label>
                        </div>

                        <div class="mt-3">
                            <label>Last Updated 10 h by Iqbal</label>
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
                                <label class="col-sm-2" for="basic-default-name">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4" for="basic-default-name">Nick Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2" for="basic-default-name">Titles :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3" for="basic-default-name">Gender :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4" for="basic-default-name">Marital Status :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2" for="basic-default-name">Age :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-4" for="basic-default-name">IC Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4" for="basic-default-name">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3" for="basic-default-name">Weight (KG) : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3" for="basic-default-name">Height (cm) :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2" for="basic-default-name">BMI :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3" for="basic-default-name">Blood Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
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
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-6" for="basic-default-name">Customer Address
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Place of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">State of Birth
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
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
                        <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                            <strong><i class='bx bx-chevron-down'></i></strong>
                        </a>
                    </div>
                    <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                        <form action="">
                            <div class="row p-4 d-flex align-items-center justify-content-between">
                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Occupation :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Sector
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-6" for="basic-default-name">IC Number Police/
                                        Military
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Salary Range
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Working Hour
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
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
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <form action="">
                    <div class="row p-3 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Child Birth Order
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Number of children
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Spouse Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Spouse Occupation
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4" for="basic-default-name">Spouse Age :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="text-dark">Children Information</label>
                            <div class="container border rounded my-3">
                                <div class="row mb-3">
                                    <label class="col-sm-4 mt-3" for="basic-default-name">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Age :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-6 mb-3" for="basic-default-name">Education
                                        Institution/ Workplace :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                </div>
                            </div>
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
                                    <label class="col-sm-6" for="basic-default-name">Hobby
                                        :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Favourite Colour
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Favourite Pet
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Favourite Food
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
                                    </div>
                                    <hr class="border-light mt-2" />
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4" for="basic-default-name">Favourite Drinks
                                        :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control border-0" id="basic-default-name" />
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
                                <label class="col-sm-7" for="basic-default-name">Does EMZI familiar to you?
                                    :</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Where did you know about
                                    EMZI? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-7" for="basic-default-name">First EMZI Product
                                    Purchased? :</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Reason of buying EMZI
                                    Products? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Why Support EMZI product?
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Purchase Frequency
                                    :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">What Products Does EMZI
                                    Have? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Do you know that EMZI has
                                    its own factory? : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6" for="basic-default-name">Do you know that EMZI has
                                    a laboratory at the university? :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-7" for="basic-default-name">Does EMZI Products
                                    Effective? :</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
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
