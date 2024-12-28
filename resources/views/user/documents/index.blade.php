@extends('layouts.user')

@section('title', 'Cetak Data Siswa & Kartu Ujian')

@section('content')
    <div class="container mt-5">

        <!-- Card untuk pilihan cetak -->
        <div class="row mb-4">
            <!-- Cetak Data Siswa hanya tampil jika status registrasi "terdaftar" -->
            <div class="col-md-6 mb-4">
                @if ($student->registration && $student->registration->status != 'ditunda')
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cetak Data Siswa</h5>
                            <p class="card-text">Cetak data lengkap siswa beserta informasi orang tua.</p>
                            <button class="btn btn-primary w-100" id="printStudentDataBtn">Cetak Data Siswa</button>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong> Anda tidak dapat mencetak data siswa karena status pendaftaran Anda ditunda.
                    </div>
                @endif
            </div>

            <!-- Cetak Kartu Ujian hanya tampil jika status registrasi "terdaftar" dan status bukan "lulus" atau "tidak_lulus" -->
            <div class="col-md-6 mb-4">
                @if ($student->registration && $student->registration->status == 'terdaftar')
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cetak Kartu Ujian</h5>
                            <p class="card-text">Cetak kartu ujian siswa untuk periode ujian.</p>
                            <button class="btn btn-success w-100" id="printExamCardBtn">Cetak Kartu Ujian</button>
                        </div>
                    </div>
                @elseif ($student->registration && in_array($student->registration->status, ['lulus', 'tidak_lulus']))
                    <div class="alert alert-info">
                        <strong>Informasi!</strong> Anda tidak dapat mencetak kartu ujian karena status Anda adalah "{{ $student->registration->status }}".
                    </div>
                @elseif ($student->registration && $student->registration->status == 'ditunda')
                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong> Anda tidak dapat mengunduh kartu ujian karena status pendaftaran Anda belum terverifikasi oleh admin.
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script>
        // Konfirmasi sebelum mencetak Data Siswa
        const printStudentDataBtn = document.getElementById('printStudentDataBtn');
        if (printStudentDataBtn) {
            printStudentDataBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin mencetak data siswa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Cetak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("user.print") }}?printOption=data_siswa';
                    }
                });
            });
        }

        // Konfirmasi sebelum mencetak Kartu Ujian
        const printExamCardBtn = document.getElementById('printExamCardBtn');
        if (printExamCardBtn) {
            printExamCardBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin mencetak kartu ujian?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Cetak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("user.print") }}?printOption=kartu_ujian';
                    }
                });
            });
        }
    </script>
@endsection
