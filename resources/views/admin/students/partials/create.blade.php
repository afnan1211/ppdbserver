@extends('layouts.admin')

@section('content')
    <!-- Card Layout for Form -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Siswa</h3>
        </div>

        <!-- /.box-header -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.students.store') }}" method="POST" id="addStudentForm">
                    @csrf
                    <div class="row">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required
                                    value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tempat Lahir -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required
                                    value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required
                                    value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- NISN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" name="nisn" id="nisn" class="form-control" value="{{ old('nisn') }}">
                                @error('nisn')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control">{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Sekolah Asal -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sekolah_asal">Sekolah Asal</label>
                                <input type="text" name="sekolah_asal" id="sekolah_asal" class="form-control"
                                    value="{{ old('sekolah_asal') }}">
                                @error('sekolah_asal')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat Sekolah Asal -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_sekolah_asal">Alamat Sekolah Asal</label>
                                <input type="text" name="alamat_sekolah_asal" id="alamat_sekolah_asal" class="form-control"
                                    value="{{ old('alamat_sekolah_asal') }}">
                                @error('alamat_sekolah_asal')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- No Telp -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp') }}">
                                @error('no_telp')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Periode -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periode_id">Periode</label>
                                <select name="periode_id" id="periode_id" class="form-control" required>
                                    <option value="">Pilih Periode</option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}" {{ old('periode_id') == $period->id ? 'selected' : '' }}>
                                            {{ $period->nama_periode }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('periode_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer text-left">
                        <button type="button" class="btn btn-primary" id="submitBtn">Tambah Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang Anda masukkan akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Daftarkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('addStudentForm').submit();
                }
            });
        });
    </script>
@endsection
