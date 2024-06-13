@extends('template.main')

@section('content')
    <div class="container mt-5">
        <h3 class="text-dark">Permission for {{ $role->name }}</h3>
    </div>

    <div class="container">
        <div class="card mt-3 p-3">
                <div class="card-body">
                    <div class="row pt-4">
                        @foreach ($permissions as $permission)
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switch-{{ $permission->id }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        data-permission="{{ $permission->name }}">
                                    <label class="form-check-label d-flex"
                                        for="switch-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.form-check-input').forEach((element) => {
            element.addEventListener('change', (e) => {
                let permission = e.target.dataset.permission;
                let url = "{{ route('permissions.update', $role->id) }}";
                let checked = e.target.checked;
                let data = {
                    _token: "{{ csrf_token() }}",
                    permission: permission,
                    checked: checked,
                };
                axios.post(url, data)
                    .then((response) => {
                        if (response.data.success != undefined) {
                            let label = document.querySelector(`label[for="${e.target.id}"]`);
                            label.insertAdjacentHTML('beforeend', `<div class="ms-2">
                                        <div class="circle-border"></div>
                                                <div class="circle">
                                                    <div class="success"></div>
                                                    </div>
                                                </div>
                                            </div>`);
                            setTimeout(() => {
                                document.querySelector(`label[for="${e.target.id}"] div`)
                                    .remove();
                            }, 2000);
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });
        });
    </script>
@endsection
