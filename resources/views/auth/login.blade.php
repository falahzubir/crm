@extends('template.auth')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="mb-4 mt-3 text-center text-uppercase">
                                <img src="data:image/png;base64,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">
                                <strong>{{ config('app.name') }}</strong></h4>
                            <p class="mb-2"><strong>Welcome to {{ config('app.name')}}</strong></p>
                            <p class="mb-2">Please sign-in to your account.</p>
                        </div>

                        <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">
                            @csrf

                            @if (session('success'))
                                <p class="alert alert-success text-center">{{ session('success') }}</p>
                            @endif

                            @if (session('error'))
                                <p class="alert alert-danger text-center">{{ session('error') }}</p>
                            @endif

                            <div class="mb-3">
                                <label for="username" class="form-label text-capitalize fw-bold">Username</label>
                                <input type="username" class="form-control  @error('username') is-invalid @enderror"
                                    id="username" name="email" placeholder="Enter your username" value="{{ old('email') }}"
                                    autofocus />
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label text-capitalize fw-bold" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" value="{{ old('password') }}" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input custom-control-input" id="remember" />
                                    <label class="form-check label custom-control-label" for="remember">Remember me</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button class="btn btn-dark d-grid w-100" type="submit">
                                    Sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection
