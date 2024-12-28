@extends('layouts.user')

@section('title', 'Hasil Ujian')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Hasil Ujian</h1>

    @if ($registration)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Status Pendaftaran</h6>
                <span class="badge badge-{{ $registration->status == 'lulus' ? 'success' : ($registration->status == 'tidak_lulus' ? 'danger' : 'warning') }}">
                    {{ ucfirst($registration->status) }}
                </span>
            </div>
            <div class="card-body">
                @if ($registration->status == 'lulus')
                    @if ($exam)
                        <p><strong>Nilai Ujian:</strong> {{ $exam->nilai }}</p>
                        <p><strong>Keterangan:</strong> {{ $exam->keterangan }}</p>
                    @else
                        <p>Nilai ujian belum tersedia. Silakan periksa kembali nanti.</p>
                    @endif
                @elseif ($registration->status == 'tidak_lulus')
                    <p>Maaf, Anda tidak lulus ujian.</p>
                @elseif ($registration->status == 'terdaftar')
                    <p>Nilai ujian Anda belum diinput oleh admin. Silakan periksa kembali nanti.</p>
                @elseif ($registration->status == 'ditunda')
                    <p>Anda tidak dapat mengikuti ujian karena status pendaftaran Anda belum terverifikasi oleh admin.</p>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Anda belum memiliki status pendaftaran yang valid untuk melihat hasil ujian.
        </div>
    @endif
</div>
@endsection
