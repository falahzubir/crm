@extends('template.auth')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">

                        <h4 class="mb-2 mt-3 text-center">Welcome! 👋</h4>
                        <p class="mb-4 text-center">Please sign-in to your account and start the adventure</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('submit-login') }}" method="POST">
                            @csrf

                            @if (session('success'))
                                <p class="alert alert-success text-center">{{ session('success') }}</p>
                            @endif

                            @if (session('error'))
                                <p class="alert alert-danger text-center">{{ session('error') }}</p>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                                    autofocus />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{ route('forgot-page') }}">
                                        <small>Forgot Password?</small>
                                      </a>
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
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    Sign in
                                </button>
                            </div>

                            <p class="text-center">
                                <span>New on our platform?</span>
                                <a href="{{ route('register-page') }}">
                                    <span>Create an account</span>
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection
