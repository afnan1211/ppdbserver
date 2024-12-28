@extends('layouts.main')

@section('title', 'Form Pendaftaran Siswa')

@section('content')
<div class="container mt-5 pt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Form Pendaftaran Siswa</h3>
                    <p class="mb-0">Silakan lengkapi form di bawah ini dengan informasi yang benar.</p>
                </div>
                <div class="card-body">
                    @if ($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif
                    <form method="POST" id="registrationForm" action="{{ route('registration.store') }}">
                        @csrf
                        <h5 class="text-primary">Data Siswa</h5>

                        <div class="form-group mt-3">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tempat_lahir">Tempat Lahir:</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="nisn">NISN:</label>
                            <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="alamat_lengkap">Alamat Lengkap:</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="3" required>{{ old('alamat_lengkap') }}</textarea>
                            @error('alamat_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="sekolah_asal">Sekolah Asal (SD/MI):</label>
                            <input type="text" name="sekolah_asal" id="sekolah_asal" class="form-control @error('sekolah_asal') is-invalid @enderror" value="{{ old('sekolah_asal') }}" required>
                            @error('sekolah_asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="alamat_sekolah_asal">Alamat Sekolah Asal:</label>
                            <input type="text" name="alamat_sekolah_asal" id="alamat_sekolah_asal" class="form-control @error('alamat_sekolah_asal') is-invalid @enderror" value="{{ old('alamat_sekolah_asal') }}" required>
                            @error('alamat_sekolah_asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="no_telp">No. Telp:</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" pattern="^\+?[\d\s\-]+$" required>
                            @error('no_telp')
                                <div class="invalid-feedback">No telepon tidak valid. Pastikan formatnya benar.</div>
                            @enderror
                        </div>

                        <hr>

                        <h5 class="text-primary">Data Orang Tua</h5>
                        <div class="form-group mt-3">
                            <label for="nama_ayah">Nama Ayah:</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" required>
                            @error('nama_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tempat_lahir_ayah">Tempat Lahir Ayah:</label>
                            <input type="text" name="tempat_lahir_ayah" id="tempat_lahir_ayah" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" value="{{ old('tempat_lahir_ayah') }}" required>
                            @error('tempat_lahir_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah:</label>
                            <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" value="{{ old('tanggal_lahir_ayah') }}" required>
                            @error('tanggal_lahir_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="nama_ibu">Nama Ibu:</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" required>
                            @error('nama_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tempat_lahir_ibu">Tempat Lahir Ibu:</label>
                            <input type="text" name="tempat_lahir_ibu" id="tempat_lahir_ibu" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" value="{{ old('tempat_lahir_ibu') }}" required>
                            @error('tempat_lahir_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu:</label>
                            <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" value="{{ old('tanggal_lahir_ibu') }}" required>
                            @error('tanggal_lahir_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mt-3">
                            <input type="checkbox" id="saveData" class="form-check-input" checked>
                            <label for="saveData" class="form-check-label">Simpan Data</label>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" id="submitBtn" class="btn btn-success btn-block">Daftar</button>
                            <button type="reset" class="btn btn-danger btn-block mt-2">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menyimpan form data ke localStorage
    function saveFormData() {
        const formData = new FormData(document.getElementById('registrationForm'));
        const formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });
        localStorage.setItem('registrationFormData', JSON.stringify(formObject));
    }

    // Fungsi untuk mengisi form dengan data yang disimpan di localStorage
    function loadFormData() {
        const savedData = JSON.parse(localStorage.getItem('registrationFormData'));
        if (savedData) {
            for (const key in savedData) {
                const input = document.querySelector(`[name=${key}]`);
                if (input) {
                    if (input.type === 'checkbox') {
                        input.checked = savedData[key] === 'on';
                    } else {
                        input.value = savedData[key];
                    }
                }
            }
        }
    }

    // Menangani form submission dan konfirmasi
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form dikirim langsung
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pastikan semua data sudah benar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Daftar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika checkbox diseleksi, simpan data ke localStorage
                if (document.getElementById('saveData').checked) {
                    saveFormData();
                }
                this.submit();
            }
        });
    });

    // Mengisi form dengan data yang sudah disimpan di localStorage ketika halaman dimuat
    window.addEventListener('load', loadFormData);

    // Menangani reset form
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        localStorage.removeItem('registrationFormData'); // Hapus data dari localStorage saat form di-reset
    });
</script>
@endsection
