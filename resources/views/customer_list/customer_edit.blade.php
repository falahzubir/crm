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

    <div class="container">
        <div class="card mt-4 p-3">
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
        <div class="card mt-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Customer Details</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <form action="" class="p-3">
                    <div class="mb-3">
                        <label class="mb-3">Name :</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">Nick Name :</label>
                        <input type="text" class="form-control" name="nick_name">
                    </div>

                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <label class="mb-3">Titles :</label>
                                <select name="titles" class="form-select">
                                    <option selected disabled>Please Select</option>
                                    <option value="">Miss</option>
                                    <option value="">Mrs.</option>
                                    <option value="">Ms.</option>
                                    <option value="">Madam</option>
                                    <option value="">Mr.</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Gender :</label>
                                <div>
                                    <input type="radio" name="gender"> Male
                                    <input type="radio" name="gender"> Female
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Marital Status :</label>
                                <select name="marital_status" class="form-select">
                                    <option selected disabled>Select Status</option>
                                    <option value="">Single</option>
                                    <option value="">Married</option>
                                    <option value="">Divorced</option>
                                    <option value="">Widowed</option>
                                    <option value="">Seperated</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <label class="mb-3">Age :</label>
                                <input type="number" class="form-control" name="age">
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">IC Number :</label>
                                <input type="text" class="form-control" name="ic_number">
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Phone Number :</label>
                                <input type="tel" class="form-control" name="phone_number">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <label class="mb-3">Weight (kg) :</label>
                                <input type="number" class="form-control" name="weight">
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Height (cm) :</label>
                                <input type="text" class="form-control" name="height">
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Blood Type :</label>
                                <input type="tel" class="form-control" name="blood_type">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Customer Address --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Customer Address</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <div class="p-4">
                    <div class="mb-3">
                        <label class="mb-3">Address :</label>
                        <div>
                            <textarea name="address" class="form-control" cols="50" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-3">City :</label>
                        <div>
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Postcode :</label>
                            <input type="number" class="form-control" name="postcode">
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">State :</label>
                            <input type="text" class="form-control" name="state">
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">Country :</label>
                            <input type="tel" class="form-control" name="country">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Place of Birth :</label>
                            <input type="number" class="form-control" name="place_of_birth">
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">State of Birth :</label>
                            <select name="state_of_birth" class="form-select">
                                <option selected disabled>Please Select</option>
                                <option value="">Johor</option>
                                <option value="">Kedah</option>
                                <option value="">Kelantan</option>
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
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <div class="row p-4 d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                        <label class="mb-3">Occupation :</label>
                        <div>
                            <input type="text" class="form-control" name="occupation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Sector :</label>
                            <div>
                                <input type="radio" name="sector"> Private
                                <input type="radio" name="sector"> Government
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">IC Number Police/ Military :</label>
                            <input type="text" class="form-control" name="police_number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="mb-3">Salary :</label>
                            <select name="salary" class="form-select">
                                <option selected disabled>Select Salary Range</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label class="mb-3">Working Hour :</label>
                            <div>
                                <input type="radio" name="sector"> Shift
                                <input type="radio" name="sector"> Normal
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
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <div class="mb-3">
                    <label class="mb-3">Child Birth Order
                        :</label>
                    <input type="text" class="form-control" name="child_birth_order">
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="mb-3">Spouse Name :</label>
                        <input type="text" class="form-control" name="spouse_name">
                    </div>

                    <div class="col">
                        <label class="mb-3">Spouse Occupation :</label>
                        <input type="text" class="form-control" name="spouse_occupation">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="mb-3">Spouse Age :</label>
                    <input type="text" class="form-control" name="spouse_age">
                </div>

                <div class="mb-3 d-flex align-items-center justify-content-between">
                    <div>
                        <label class="mb-3">Number of children :</label>
                        <input type="text" class="form-control" name="spouse_name">
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-secondary btn-lg" onclick="addChildField()" type="button">
                            <i class='bx bx-child'></i> Add Child Information
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="child-list"></div>

        <script>
            const form = document.getElementById("child-list");

            function addChildField() {
                // Card
                const card = document.createElement("div");
                card.classList.add("card");
                card.classList.add("mt-5");
                card.classList.add("p-3");

                // Card Header
                const cardHeader = document.createElement("div");
                cardHeader.classList.add("card-header");
                cardHeader.classList.add("d-flex");
                cardHeader.classList.add("align-items-center");
                cardHeader.classList.add("justify-content-between");
                card.appendChild(cardHeader);

                // Title
                const title = document.createElement("h5");
                title.textContent = "Child";
                card.appendChild(title);

                // Create remove button
                const removeButton = document.createElement("a");
                removeButton.textContent = "X";
                removeButton.onclick = function() {
                    form.removeChild(card);
                };
                card.appendChild(removeButton);

                // Card Body
                const cardBody = document.createElement("div");
                cardBody.classList.add("card-body");
                card.appendChild(cardBody);

                // Name
                const nameLabel = document.createElement("label");
                nameLabel.classList.add("mb-3");
                nameLabel.textContent = "Name :";
                card.appendChild(nameLabel);

                const nameInput = document.createElement("input");
                nameInput.type = "text";
                nameInput.name = "child_name[]";
                nameInput.classList.add("form-control");
                nameInput.classList.add("mb-3");
                nameInput.required = true;
                card.appendChild(nameInput);

                // Age
                const ageLabel = document.createElement("label");
                ageLabel.classList.add("mb-3");
                ageLabel.textContent = "Age :";
                card.appendChild(ageLabel);

                const ageInput = document.createElement("input");
                ageInput.type = "number";
                ageInput.name = "child_age[]";
                ageInput.classList.add("form-control");
                ageInput.classList.add("mb-3");
                ageInput.required = true;
                card.appendChild(ageInput);

                // Education Institution/ Workplace
                const educationLabel = document.createElement("label");
                educationLabel.classList.add("mb-3");
                educationLabel.textContent = "Education Institution/ Workplace :";
                card.appendChild(educationLabel);

                const educationInput = document.createElement("input");
                educationInput.type = "text";
                educationInput.name = "child_education[]";
                educationInput.classList.add("form-control");
                educationInput.classList.add("mb-3");
                educationInput.required = true;
                card.appendChild(educationInput);

                // Append the new div to the form
                form.appendChild(card);
            }
        </script>

        {{-- Others --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Others</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <div class="row mb-3">
                    <div class="col">
                        <label class="mb-3">Hobby :</label>
                        <input type="text" class="form-control" name="hobby">
                    </div>

                    <div class="col">
                        <label class="mb-3">Favourite Colour :</label>
                        <input type="text" class="form-control" name="favourite_colour">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="mb-3">Favourite Pet :</label>
                        <input type="text" class="form-control" name="favourite_pet">
                    </div>

                    <div class="col">
                        <label class="mb-3">Favourite Food :</label>
                        <input type="text" class="form-control" name="favourite_food">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="mb-3">Favourite Drinks :</label>
                        <input type="text" class="form-control" name="favourite_drinks">
                    </div>
                </div>
            </div>
        </div>

        {{-- Suffering Disease --}}
        <div class="card mt-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5><strong>Suffering Disease</strong></h5>
                <a class="collapsed btn" data-bs-toggle="collapse" href="#customerDetails">
                    <strong><i class='bx bx-chevron-down'></i></strong>
                </a>
            </div>
            <div class="card-body" id="customerDetails" data-bs-parent="#accordion">
                <div class="mb-3">
                    <label class="mb-3">Disease :</label>
                    <select name="disease" class="form-select">
                        <option value=""></option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="mb-3">Other Disease :</label>
                    <input type="text" class="form-control" name="other_disease">
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
