<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB Pondok Pesantren')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Poppins" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- SB Admin 2 & Font Awesome -->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap 4.3.1 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles (Optional) -->
    @stack('styles')

    <!-- SweetAlert2 CDN (only included if not on login or register pages) -->
    @if (!Request::is('login') && !Request::is('registration.index'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif
</head>

<body>
    <!-- Header -->
    @include('main.header')

    <!-- Main Content Wrapper -->
    <div class="{{ Request::is('login') || Request::is('register') ? 'd-flex align-items-center justify-content-center' : '' }}" style="min-height: 80vh;">
        <div class="{{ Request::is('login') || Request::is('register') ? 'container mt-5' : '' }}">
            @yield('content')
        </div>
    </div>

    <!-- SweetAlert Session Alerts (only if not on login or register pages) -->
    @if (!Request::is('login') && !Request::is('daftar') && (session('success') || session('error') || $errors->any()))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                @elseif (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                @elseif ($errors->any())
                    let errorMessages = `
                        <ul style="text-align: left;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `;
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Errors',
                        html: errorMessages,
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>
    @endif

    <!-- Include SweetAlert Integration (only if not on login or register pages) -->
    @if (!Request::is('login') && !Request::is('register'))
        @include('sweetalert::alert')
    @endif

    <!-- Vendor JS Files -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Custom Scripts (Optional) -->
    @stack('scripts')
</body>

</html>
