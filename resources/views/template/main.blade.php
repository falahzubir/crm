<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" /> --}}

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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="loader"></div>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('includes.sidebar')

            <!-- Layout container -->
            <div class="layout-page">

                @include('includes.navbar')

                @yield('content')

                <hr class="container-m-nx border-light my-4" />

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme mb-3">
                    <div class="container-xxl d-flex flex-wrap justify-content-center flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            <strong>CRM @
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                            </strong>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>

    <script src="{{ asset('js/window.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- For loader --}}
    <script>
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            if (loader && document.body.contains(loader)) {
                loader.classList.add("loader--hidden");

                // Add a delay before removing the loader
                setTimeout(() => {
                    document.body.removeChild(loader);
                }, 500); // Adjust the delay as needed
            }
        });
    </script>

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
    @endif

    <script>
        $('#logout-link').click(function(e) {
            e.preventDefault(); // Prevent default link behavior

            // Show SweetAlert confirmation dialog
            Swal.fire({
                icon: 'warning',
                title: 'Logout',
                text: 'Are you sure you want to logout?',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                // If user confirms logout, proceed with logout action
                if (result.isConfirmed) {
                    $('#logout-form').submit();
                }
            });
        });
    </script>

    {{-- For star rating --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to update star classes based on database value
            function updateStars(value, starContainer) {
                const stars = starContainer.querySelectorAll('.star');
                stars.forEach((star, index) => {
                    if (index < value) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }

            // Function to handle user click on stars
            document.querySelectorAll('.star-rating').forEach(starContainer => {
                starContainer.querySelectorAll('.star').forEach(star => {
                    star.addEventListener('click', function() {
                        const value = parseInt(this.getAttribute('data-value'));
                        updateStars(value, starContainer);
                    });
                });

                // Assume you retrieve the value from the database here for each rating
                const databaseValue = parseInt(starContainer.dataset.rating);
                updateStars(databaseValue, starContainer);
            });

            document.querySelectorAll('.star-rating .star').forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    const ratingInput = this.closest('.star-rating').querySelector(
                        'input[type="hidden"]');
                    if (ratingInput) {
                        ratingInput.value = value;
                    }
                });
            });
        });
    </script>

</body>

</html>
