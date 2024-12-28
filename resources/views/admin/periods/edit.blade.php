@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Periode Pendaftaran</h2>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form id="edit-form" action="{{ route('admin.periods.update', $period->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Periode:</label>
            <input type="text" name="nama_periode" class="form-control" value="{{ old('nama_periode', $period->nama_periode) }}" required>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ old('status', $period->status) == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status', $period->status) == 0 ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $period->tanggal_mulai) }}" required>
        </div>
        <div class="form-group">
            <label>Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $period->tanggal_selesai) }}" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="confirmEdit()">Update</button>
    </form>
</div>
<script>
    function confirmEdit() {
        Swal.fire({
            title: 'Yakin ingin memperbarui data?',
            text: "Perubahan tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, perbarui!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('edit-form').submit();
            }
        });
    }
</script>
@endsection
