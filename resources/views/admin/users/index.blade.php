@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manajemen Pengguna</h1>

        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Email" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-control">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Pengguna</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUserModal">Tambah Pengguna Baru</button>
                </div>
            </div>
        </form>

        <!-- Tabel Pengguna -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @if($users->isEmpty())
                    <!-- Tampilkan jika tidak ada data -->
                    <div class="alert alert-warning text-center">
                        <strong>Data tidak ditemukan!</strong> Tidak ada pengguna yang sesuai dengan pencarian atau filter Anda.
                    </div>
                @else
                    <!-- Tampilkan tabel jika ada data -->
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editUserModal-{{ $user->id }}">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal" onclick="setDeleteAction({{ $user->id }})">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    {{ $users->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Modal Edit Pengguna -->
                    @foreach ($users as $user)
                        @include('admin.users.partials.edit-modal', ['user' => $user])
                    @endforeach

                    <!-- Modal Tambah Pengguna -->
                    @include('admin.users.partials.create-modal')

                    <!-- Modal Hapus Pengguna -->
                    @include('admin.users.partials.delete-modal')
                @endif
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengatur aksi form hapus
        function setDeleteAction(userId) {
            document.getElementById('deleteUserForm').action = '/admin/users/' + userId;
        }
    </script>
@endsection
