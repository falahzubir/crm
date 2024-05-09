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
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" class="form-control bg-light" placeholder="Search" name="search"
                        @if (isset($search)) value="{{ $search }}" @endif>

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
                        </div>

                        <div class="row">
                            <div class="col">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-select mt-2">
                                    <option selected disabled></option>
                                    <option value="Male"
                                        {{ isset($filters['gender']) && 'Male' == $filters['gender'] ? 'selected' : '' }}>
                                        Male</option>
                                    <option value="Female"
                                        {{ isset($filters['gender']) && 'Female' == $filters['gender'] ? 'selected' : '' }}>
                                        Female</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Age Range</label>
                                <select name="age_range" id="age_range" class="form-select mt-2">
                                    <option selected disabled></option>
                                    <option value="1" {{ isset($filters['age']) && '1' == $filters['age'] ? 'selected' : '' }}>Under 17</option>
                                    <option value="2" {{ isset($filters['age']) && '2' == $filters['age'] ? 'selected' : '' }}>18 - 24 years old</option>
                                    <option value="3" {{ isset($filters['age']) && '3' == $filters['age'] ? 'selected' : '' }}>25 - 34 years old</option>
                                    <option value="4" {{ isset($filters['age']) && '4' == $filters['age'] ? 'selected' : '' }}>35 - 44 years old</option>
                                    <option value="5" {{ isset($filters['age']) && '5' == $filters['age'] ? 'selected' : '' }}>45 - 54 years old</option>
                                    <option value="6" {{ isset($filters['age']) && '6' == $filters['age'] ? 'selected' : '' }}>55 - 64 years old</option>
                                    <option value="7" {{ isset($filters['age']) && '7' == $filters['age'] ? 'selected' : '' }}>65 - 74 years old</option>
                                    <option value="8" {{ isset($filters['age']) && '8' == $filters['age'] ? 'selected' : '' }}>75 years old and above</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>State</label>
                                <select name="state" id="state" class="form-select mt-2">
                                    <option selected disabled></option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ isset($filters['state']) && $state->id == $filters['state'] ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
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
                            @if ($customers->isEmpty())
                                <tr class="text-center">
                                    <td colspan="8" class="bg-light">No data</td>
                                </tr>
                            @else
                                @foreach ($customers as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ route('customer.edit', ['id' =>  $row->id]) }}" class="text-secondary"><i
                                                    class='bx bx-pencil'></i></a>
                                            <a href="{{ route('customer.profile', ['id' =>  $row->id]) }}" class="text-secondary"><i
                                                    class='bx bx-show-alt'></i></a>
                                        </td>
                                        <td>
                                            <div class="row flex-row align-items-center">
                                                <div class="col-sm-4">
                                                    <ul class="navbar-nav flex-row align-items-center">
                                                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                                            <div class="avatar">
                                                                <img src="{{ $row->photo }}"
                                                                    class="w-px-45 h-100 rounded-circle" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong>{{ $row->name }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $row->phone }}
                                        </td>
                                        <td>
                                            <div class="text-success"><strong>2,249.88</strong></div>
                                        </td>
                                        <td>
                                            {{ $row->flag }} {{ $row->state_name }}
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
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
