@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Periode Pendaftaran</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="create-form" action="{{ route('admin.periods.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_periode">Nama Periode:</label>
            <input type="text" name="nama_periode" id="nama_periode" class="form-control" value="Tahun Pelajaran 20xx/20xx" required>
            @error('nama_periode')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
            @error('tanggal_mulai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
            @error('tanggal_selesai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="button" class="btn btn-primary" onclick="confirmCreate()">Simpan</button>
    </form>
</div>
<script>
    document.getElementById('tanggal_mulai').addEventListener('change', function() {
        const tanggalMulai = new Date(this.value);
        const tahunMulai = tanggalMulai.getFullYear();

        if (tahunMulai === 2024) {
            const tahunSelesai = tahunMulai + 1;
            const bulanMulai = tanggalMulai.getMonth();
            const hariMulai = tanggalMulai.getDate();

            const tanggalSelesai = new Date(tahunSelesai, bulanMulai, hariMulai);
            document.getElementById('tanggal_selesai').value = tanggalSelesai.toISOString().split('T')[0];
        }
    });

    function confirmCreate() {
        Swal.fire({
            title: 'Yakin ingin menambahkan data?',
            text: "Pastikan data sudah benar sebelum disimpan!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('create-form').submit();
            }
        });
    }
</script>
@endsection
