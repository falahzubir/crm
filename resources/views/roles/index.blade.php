@extends('template.main')

@section('content')

        <div class="container mt-5">
            <h3 class="text-dark">Role List</h3>
        </div>

        <div class="container">
            <div class="card mt-3 p-3">
                <div class="card-body">
                    <div class="mt-3">
                        <!-- modal button -->
                        <button class="btn btn-info" id="add-role" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            Add Role
                        </button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit', $role->id) }}"
                                                class="btn btn-warning btn-sm">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('roles.store') }}" method="POST" id="add-role-form" autocomplete="off">
                        @csrf
                        <div class="">
                            <input type="text" name="name" id="name" class="form-control text-center" placeholder="New Role Name" value="{{ old('name') }}">
                            <div class="very-small-text text-danger text-center">Must be less than 10 characters</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-role-submit-btn">Add Role</button>
                </div>
            </div>
        </div>
    </div>
        <script>
            // Add Role
            document.querySelector('#add-role-submit-btn').onclick = function () {
                document.querySelector('#add-role-form').submit();
            };
        </script>

@endsection
