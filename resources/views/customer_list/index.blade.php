@extends('template.main')

@section('content')
    <div class="container mt-5">
        <h3 class="text-dark">Customer List</h3>
    </div>

    <div class="container">
        <div class="card mt-3 p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Filter</h5>
            </div>

            <div class="card-body">
                <form action="">
                    <input type="text" name="search" class="form-control bg-light" placeholder="Search">

                    <div class="mt-4">
                        <div class="row mb-4">
                            <div class="col">
                                <label>Tagging</label>
                                <select name="tagging" id="tagging" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Basket Value</label>
                                <select name="basket_value" id="basket_value" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Ranking</label>
                                <select name="ranking" id="ranking" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Age Range</label>
                                <select name="age_range" id="age_range" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col">
                                <label>State</label>
                                <select name="state" id="state" class="form-select mt-2">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger float-end mt-4"><i class='bx bx-search'></i>
                        Search</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>ACTION</th>
                                <th>NAME</th>
                                <th>PHONE</th>
                                <th>SPENT (MYR)</th>
                                <th>STATE</th>
                                <th>ORDER</th>
                                <th>OM</th>
                                <th>TAGGING</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{ route('customer.edit') }}" class="text-secondary"><i class='bx bx-pencil'></i></a>
                                    <a href="{{ route('customer.profile') }}" class="text-secondary"><i class='bx bx-show-alt'></i></a>
                                </td>
                                <td>
                                    <div class="row flex-row align-items-center">
                                        <div class="col-md-3">
                                            <ul class="navbar-nav flex-row align-items-center">
                                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/5.png"
                                                            class="w-px-45 h-100 rounded-circle" />
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <strong>Muhammad Sumbul</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    0123456789
                                </td>
                                <td>
                                    <div class="text-success"><strong>2,249.88</strong></div>
                                </td>
                                <td>
                                    &#127474;&#127486; Kedah
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    NCA
                                </td>
                                <td>
                                    Kolestrol, Jantung, Darah Tinggi
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item prev">
                            <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">2</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">5</a>
                        </li>
                        <li class="page-item next">
                            <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
