<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- External Stylesheets -->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom Styles (if any) -->
    @stack('styles')
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('admin.partials.topbar')

                <!-- Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- Footer -->
            @include('admin.partials.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Core JS -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 Integration -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert for session alerts -->
   @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif

@if(session('error') || session('nisn'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let errorMessage = "";

            // Ambil pesan dari session('error') jika ada
            if ("{{ session('error') }}") {
                errorMessage += "{{ session('error') }}";
            }

            // Tambahkan pesan dari session('nisn') jika ada
            if ("{{ session('nisn') }}") {
                if (errorMessage !== "") errorMessage += " ";
                errorMessage += "{{ session('nisn') }}";
            }

            // Tampilkan alert jika errorMessage tidak kosong
            if (errorMessage !== "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    </script>
@endif

    <!-- SweetAlert for Validation Errors -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let errorMessages = `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ addslashes($error) }}</li>
                        @endforeach
                    </ul>
                `;
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: errorMessages,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <!-- Include SweetAlert Blade if needed -->
    @include('sweetalert::alert')

    <!-- Custom Scripts (if any) -->
    @stack('scripts')
</body>
</html>
