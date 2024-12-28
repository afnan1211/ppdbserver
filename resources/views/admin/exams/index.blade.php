@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Nilai Ujian Siswa</h1>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.exams.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col-12 col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, NISN, atau nomor registrasi"
                    value="{{ request('search') }}" />
            </div>
            <div class="col-12 col-md-2">
                <select name="periode" class="form-control">
                    <option value="">Pilih Periode</option>
                    @foreach ($periods as $period)
                        <option value="{{ $period->id }}"
                            {{ $request->periode == $period->id || (!$request->periode && $period->status == 1) ? 'selected' : '' }}>
                            {{ $period->nama_periode }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Cari</button>
            </div>
        </div>
    </form>

    <!-- Table for displaying students -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Nomor Registrasi</th>
                            <th>Nilai Ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->nama_lengkap }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->nomor_registrasi }}</td>
                                <td>
                                    @if ($student->exams)
                                        {{ $student->exams->nilai }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (!$student->exams)
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#createModal{{ $student->id }}">
                                            <i class="fas fa-plus"></i> Input Nilai
                                        </button>
                                    @else
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editExamModal{{ $student->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $students->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
        </div>
    </div>

    <!-- Modal Input Nilai -->
    @foreach ($students as $student)
        @include('admin.exams.partials.create-modal')
        @include('admin.exams.partials.edit-modal')
    @endforeach
@endsection
