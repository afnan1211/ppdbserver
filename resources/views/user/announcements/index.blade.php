@extends('layouts.user')

@section('title', 'Pengumuman')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container">
        <!-- Search Section -->
        <div class="d-flex justify-content-between mb-3">
            <form method="GET" action="{{ route('user.announcements.index') }}" class="form-inline">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari Pengumuman..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Announcements List -->
        @forelse ($announcements as $announcement)
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title font-weight-bold">{{ $announcement->judul }}</h5>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->translatedFormat('d F Y') }}</p>
                        </p>
                    </div>
                    <p class="card-text">{{ Str::limit(strip_tags($announcement->isi), 200) }}</p>
                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#announcementModal{{ $announcement->id }}">Selengkapnya</button>
                </div>
            </div>
        @empty
            <!-- Message if no announcements found -->
            <div class="alert alert-warning">
                Tidak ada pengumuman yang ditemukan.
            </div>
        @endforelse


        <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $announcements->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
    </div>

    <!-- Include modals only if announcements are present -->
    @if ($announcements->count())
        @include('user.announcements.partials.show-modal')
    @endif

@endsection
