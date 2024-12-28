@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800">Daftar Periode Pendaftaran</h2>

        <!-- Button untuk Tambah Periode -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Tambah Periode
        </button>

        <!-- Tabel Daftar Periode -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Periode Pendaftaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Periode</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periods as $period)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $period->nama_periode }}</td>
                                    <td>{{ \Carbon\Carbon::parse($period->tanggal_mulai)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($period->tanggal_selesai)->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $period->status ? 'success' : 'secondary' }}">
                                            {{ $period->status ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit Modal -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $period->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.periods.destroy', $period->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $period->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $period->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    @include('admin.periods.partials.create-modal')

    <!-- Modal Edit untuk Setiap Periode -->
    @foreach ($periods as $period)
        @include('admin.periods.partials.edit-modal', ['period' => $period])
    @endforeach

    <script>
        // Auto dismiss alert setelah 5 detik (5000 ms)
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    </script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak dapat dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
@endsection
