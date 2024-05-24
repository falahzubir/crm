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
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                    viewBox="0 0 25 25">
                                    <mask id="a" width="25" height="25" x="0" y="0"
                                        maskUnits="userSpaceOnUse" style="mask-type:luminance">
                                        <path fill="#fff" d="M25 0H0v25h25V0Z" />
                                    </mask>
                                    <g mask="url(#a)">
                                        <path fill="#18CDCA"
                                            d="M2.447 10.963a2.234 2.234 0 0 1 .578-2.158l5.78-5.78a2.234 2.234 0 0 1 2.158-.578l5.408 1.45a4.07 4.07 0 0 1 .746-2.058L10.603.094A2.758 2.758 0 0 0 7.94.808L.808 7.94a2.758 2.758 0 0 0-.714 2.663l1.812 6.763a4.068 4.068 0 0 1 2.04-.812l-1.5-5.591Zm18.557-2.704 1.548 5.778a2.236 2.236 0 0 1-.578 2.158l-5.78 5.78a2.235 2.235 0 0 1-2.158.578l-5.591-1.498a4.067 4.067 0 0 1-.812 2.039l6.763 1.812a2.754 2.754 0 0 0 2.664-.714l7.132-7.132a2.757 2.757 0 0 0 .713-2.663l-1.88-7.017a4.08 4.08 0 0 1-2.021.879Z" />
                                        <path fill="#4F80E1"
                                            d="M2.069 18.3A3.275 3.275 0 1 0 6.7 22.93a3.275 3.275 0 0 0-4.631-4.63ZM18.13 1.9a3.274 3.274 0 1 0 4.629 4.63 3.274 3.274 0 0 0-4.63-4.63Zm-3.708 19.281c-.131 0-.262-.017-.39-.05l-5.118-1.372a4.599 4.599 0 0 0-3.673-3.674l-1.372-5.118a1.51 1.51 0 0 1 .39-1.454L9.512 4.26a1.505 1.505 0 0 1 1.454-.39l4.975 1.333a4.6 4.6 0 0 0 3.778 3.565l1.41 5.265a1.508 1.508 0 0 1-.39 1.455l-5.253 5.253a1.493 1.493 0 0 1-1.064.44Z" />
                                    </g>
                                </svg>
                                <strong>CRM</strong>
                            </h4>
                            <p class="mb-2"><strong>Welcome to CRM</strong></p>
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
                                    id="username" name="email" placeholder="Enter your username"
                                    value="{{ old('email') }}" autofocus />
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

                            {{-- <div class="mb-4">
                                <div class="form-check custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input custom-control-input" id="remember" />
                                    <label class="form-check label custom-control-label" for="remember">Remember me</label>
                                </div>
                            </div> --}}

                            <div class="my-4">
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
