@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container-fluid">
        <!-- Judul Dashboard -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

        <!-- Statistik -->
        <div class="row">
            <!-- Total Siswa Terdaftar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Siswa Terdaftar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siswa yang Mengikuti Ujian -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Siswa Mengikuti Ujian
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studentsWithExams }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siswa Terdaftar di Periode Aktif -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Siswa Terdaftar (Periode
                                    Aktif)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studentsInActivePeriod }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Statistik Siswa -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Siswa Berdasarkan Periode</h6>
            </div>
            <div class="card-body">
                <canvas id="studentsChart"></canvas>
            </div>
        </div>

        <!-- Pengumuman Terbaru -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengumuman Terbaru</h6>
            </div>
            <div class="card-body">
                @forelse($latestAnnouncements as $announcement)
                    <div class="mb-3">
                        <h5>{{ $announcement->judul }}</h5>
                        <p class="text-muted">{{ $announcement->tanggal_dibuat }}</p>
                        <p>{!! Str::limit($announcement->isi, 100) !!}</p> <!-- Menampilkan HTML dalam isi -->
                        <!-- Tombol untuk membuka modal -->
                        <button class="btn btn-primary" data-toggle="modal" data-target="#showModal{{ $announcement->id }}">
                            Lihat Detail
                        </button>
                    </div>
                    <hr>
                @empty
                    <p class="text-muted">Tidak ada pengumuman terbaru.</p>
                @endforelse
            </div>
        </div>

        <!-- Modals untuk Pengumuman -->
        @foreach($latestAnnouncements as $announcement)
            <div class="modal fade" id="showModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{ $announcement->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel{{ $announcement->id }}">Detail Pengumuman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>{{ $announcement->judul }}</h4>
                            <p>{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->translatedFormat('d F Y') }}</p>
                            <p><strong>Status:</strong> <span class="badge badge-{{ $announcement->status ? 'success' : 'secondary' }}">
                                {{ $announcement->status ? 'Aktif' : 'Nonaktif' }}</span>
                            </p>
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

        <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('studentsChart').getContext('2d');
            const studentsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: @json($chartData['data']),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
