@extends('layouts.admin')

@section('title', 'Manajemen Siswa')

@section('content')


    @if (session('email') && session('temporaryPassword') && session('nomorRegistrasi'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Pendaftaran Berhasil!',
                    html: `<p>Email: <strong>{{ session('email') }}</strong></p>
                       <p>Password Sementara: <strong>{{ session('temporaryPassword') }}</strong></p>
                       <p>Nomor Registrasi: <strong>{{ session('nomorRegistrasi') }}</strong></p>`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tindakan Selanjutnya',
                            text: 'Segera ganti password atau email Anda untuk alasan keamanan. Jangan lupa untuk menangkap screenshot halaman ini sebagai bukti pendaftaran.',
                            icon: 'info',
                            confirmButtonText: 'Saya Mengerti'
                        });
                    }
                });
            });
        </script>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Siswa</h1>
    </div>
    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('admin.students.index') }}">
        <div class="form-row mb-2">
            <!-- Search by Name -->
            <div class="col-md-4 mb-2 mb-md-0">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Siswa"
                    value="{{ request()->search }}">
            </div>

            <!-- Filter by Period -->
            <div class="col-md-3 mb-2 mb-md-0">
                <select name="period" class="form-control">
                    <option value="">Pilih Periode</option>
                    @foreach ($periods as $period)
                        <option value="{{ $period->id }}"
                            {{ request()->period == $period->id || (empty(request()->period) && $activePeriod && $activePeriod->id == $period->id) ? 'selected' : '' }}>
                            {{ $period->nama_periode }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal Daftar</th>
                            <th>Status Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->nomor_registrasi }}</td>
                                <td>{{ $student->nama_lengkap }}</td>
                                <td>{{ $student->registration->tanggal_daftar ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($student->registration->status == 'ditunda') badge-warning
                                    @elseif($student->registration->status == 'terdaftar') badge-info
                                    @elseif($student->registration->status == 'lulus') badge-success
                                    @elseif($student->registration->status == 'tidak_lulus') badge-danger @endif">
                                        {{ ucfirst($student->registration->status ?? 'Belum Terdaftar') }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <button class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#studentModal-{{ $student->id }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editModal-{{ $student->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal-{{ $student->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal for Student Details -->
                            @include('admin.students.partials.show-modal', ['student' => $student])
                            <!-- Modal for Student Edit -->
                            @include('admin.students.partials.edit-modal', ['student' => $student])
                            <!-- Modal for Student Deletion -->
                            @include('admin.students.partials.delete-modal', ['student' => $student])
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $students->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>
        // Auto dismiss alert setelah 5 detik (5000 ms)
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    </script>

@endsection
