@extends('layouts.user')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

        <!-- Sambutan Siswa Baru -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-body text-center">
                        <h5 class="font-weight-bold text-primary">Selamat Datang, {{ auth()->user()->username }}!</h5>
                        <p class="mb-0">Halaman ini memberikan akses cepat ke informasi sekolah Anda dan pengumuman penting.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Diri Siswa dan Pengumuman -->
        <div class="row">

            <!-- Data Diri Siswa -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 font-weight-bold">Data Diri Siswa</h6>
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->student)
                            <p><strong>Nama Lengkap:</strong> {{ auth()->user()->student->nama_lengkap }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ auth()->user()->student->jenis_kelamin }}</p>
                            <p><strong>Tempat, Tanggal Lahir:</strong> {{ auth()->user()->student->tempat_lahir }},
                                {{ auth()->user()->student->tanggal_lahir }}</p>
                            <p><strong>NISN:</strong> {{ auth()->user()->student->nisn }}</p>
                            <p><strong>Alamat:</strong> {{ auth()->user()->student->alamat_lengkap }}</p>
                        @else
                            <p class="text-danger">Data diri siswa belum tersedia. Silakan lengkapi data diri Anda di halaman profil.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pengumuman Terbaru -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header bg-info text-white py-3">
                        <h6 class="m-0 font-weight-bold">Pengumuman Terbaru</h6>
                    </div>
                    <div class="card-body">
                        @if ($announcements->isNotEmpty())
                            <div class="list-group">
                                @foreach ($announcements as $announcement)
                                    <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#showModal{{ $announcement->id }}">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-primary">{{ $announcement->judul }}</h5>
                                            <small class="text-muted">{{ $announcement->tanggal_dibuat }}</small>
                                        </div>
                                        <p class="mb-1">{!! \Illuminate\Support\Str::limit($announcement->isi, 100) !!}</p>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Tidak ada pengumuman terbaru saat ini.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Pengumuman -->
    @foreach($announcements as $announcement)
        <div class="modal fade" id="showModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{ $announcement->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="showModalLabel{{ $announcement->id }}">Detail Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>{{ $announcement->judul }}</h4>
                        <p>{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->translatedFormat('d F Y') }}</p>
                        <div>
                            <div>{!! $announcement->isi !!}</div> <!-- Output raw HTML content -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- SweetAlert Pemberitahuan Pendaftaran -->
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
@endsection
