@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Manajemen Orang Tua</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.parents.index') }}" class="mb-3">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Cari orang tua..." value="{{ request()->search }}">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createParentModal">
            <i class="fas fa-plus"></i> Tambah Orang Tua
        </button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Orang Tua</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="parentsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Orang Tua</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parents as $parent)
                                <tr>
                                    <td>{{ $parent->nama }}</td>
                                    <td>{{ ucfirst($parent->jenis_orangtua) }}</td>
                                    <td>
                                        <!-- Button trigger modal for Show -->
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showModal-{{ $parent->id }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>

                                        <!-- Button trigger modal for Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-{{ $parent->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <form action="{{ route('admin.parents.destroy', $parent->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $parent->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $parent->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal for Show -->
                                @include('admin.parents.partials.show-modal', ['parent' => $parent])

                                <!-- Modal for Edit -->
                                @include('admin.parents.partials.edit-modal', ['parent' => $parent])
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $parents->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.parents.partials.create-modal')
    <script>
        setTimeout(() => {
            $('.alert').alert('close');
        }, 3000);
        // SweetAlert Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus orang tua siswa ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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
