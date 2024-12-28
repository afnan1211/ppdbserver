<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB Online')</title>

    <!-- SweetAlert2 CDN (only included if not on the login page) -->
    @if(!Request::is('login')) <!-- Adjust 'login' based on your actual route name for login -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif

    <!-- Font Awesome & SB Admin 2 CSS -->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles (Optional) -->
    @stack('styles')

    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="@yield('body-class', 'bg-light')">

    <!-- Main Content -->
    @yield('content')

    <!-- SweetAlert for session alerts (only if not on the login page) -->
    @if(!Request::is('login') && (session('success') || session('error') || $errors->any()))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Check if there's a success message
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                @elseif(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                @elseif($errors->any())
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

    <!-- SweetAlert Integration (only included if not on the login page) -->
    @if(!Request::is('login'))
        @include('sweetalert::alert')
    @endif

    <!-- Scripts -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
