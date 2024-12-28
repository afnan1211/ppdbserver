@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Pengumuman</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Tambah Pengumuman
        </button>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.announcements.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col">
                <select name="month" class="form-control">
                    <option value="">Pilih Bulan</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="year" class="form-control">
                    <option value="">Pilih Tahun</option>
                    @foreach(range(date('Y'), 2000) as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>

    <!-- Table Pengumuman -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengumuman</h6>
        </div>
        <div class="card-body">
            @if($isEmpty)
                <!-- Pesan jika pengumuman kosong -->
                <div class="alert alert-warning" role="alert">
                    Tidak ada pengumuman yang ditemukan untuk bulan dan tahun yang dipilih.
                </div>
            @else
                <!-- Tabel Pengumuman -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal Dibuat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $index => $announcement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($announcement->judul, 30, '...') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $announcement->status ? 'success' : 'secondary' }}">
                                            {{ $announcement->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Button Edit -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $announcement->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <!-- Button Hapus -->
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $announcement->id }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>

                                        <!-- Button Lihat -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#showModal{{ $announcement->id }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{ $announcements->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Sections -->
    @if(!$isEmpty)
        <!-- Loop untuk Edit dan Show Modal -->
        @foreach($announcements as $announcement)
            @include('admin.announcements.partials.edit-modal', ['announcement' => $announcement])
            @include('admin.announcements.partials.create-modal')
            @include('admin.announcements.partials.show-modal', ['announcement' => $announcement])
        @endforeach
    @endif

    <!-- Delete Confirmation Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        // Delete confirmation function with SweetAlert2
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set action URL and submit the form
                    const form = document.getElementById('deleteForm');
                    form.action = `/admin/announcements/${id}`;
                    form.submit();
                }
            });
        }
    </script>
@endsection
