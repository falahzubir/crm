@extends('template.main')

@section('content')
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

        <div class="card mt-5">
            <div class="card-header">
                <h5><strong>Customer Details</strong></h5>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row p-4 d-flex align-items-center justify-content-between">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="basic-default-name">Nick Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Titles :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Gender :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="basic-default-name">Marital Status :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Age :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="basic-default-name">IC Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="basic-default-name">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Weight (KG) : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Height (cm) :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">BMI :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                                <hr class="border-light mt-2" />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Blood Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control border-0" id="basic-default-name" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
