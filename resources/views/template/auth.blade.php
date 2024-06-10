<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="data:image/png;base64,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" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    @yield('content')

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- MESSAGE ALERT -->
    {{-- <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    @if (session('success'))
        <script>
            swal({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "OK",
                buttonColor: "#fff",
            });
        </script>
    @endif


    @if (session('error'))
    <script>
        swal({
            title: "Error!",
            text: "{{ session('error') }}",
            icon: "error",
            button: "OK",
            buttonColor: "#fff",
        });
    </script>
    @endif --}}

</body>

</html>
