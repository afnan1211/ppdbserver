@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Verifikasi Dokumen Siswa</h1>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('admin.documents.index') }}" class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-md-5 mb-2">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari NISN, Nama, atau No. Registrasi" value="{{ request('search') }}">
                </div>
                <div class="col-md-4 mb-2">
                    <select name="period_id" class="form-control">
                        <option value="">Pilih Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}" {{ $periodId == $period->id ? 'selected' : '' }}>
                                {{ $period->nama_periode }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>

        <!-- Tabel Verifikasi Dokumen -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa dengan Status "Ditunda"</h6>
            </div>
            <div class="card-body">
                @if ($students->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>No. Registrasi</th>
                                    <th>Status Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                        <td>{{ $student->nisn }}</td>
                                        <td>{{ $student->nama_lengkap }}</td>
                                        <td>{{ $student->nomor_registrasi }}</td>
                                        <td>
                                            <span class="badge badge-warning">{{ $student->registration->status }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.documents.verify', $student->id) }}"
                                                method="POST" class="d-inline" id="verifyForm_{{ $student->id }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success verify-button"
                                                    data-id="{{ $student->id }}">Verifikasi</button>
                                            </form>
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#documentPreviewModal"
                                                data-documents="{{ $student->documents->toJson() }}">
                                                Lihat Dokumen
                                            </button>
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
                @else
                    <p class="text-center">Tidak ada data siswa dengan status "Ditunda".</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Include modal partial for document preview -->
    @include('admin.documents.partials.document_preview_modal')

    <script>
        // SweetAlert2 Script for Verification Confirmation
        document.querySelectorAll('.verify-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const studentId = this.dataset.id;
                const form = document.getElementById('verifyForm_' + studentId);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat mengembalikan aksi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Verifikasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.btn-info').forEach(button => {
            button.addEventListener('click', function() {
                const documents = JSON.parse(this.dataset.documents);

                let content = '';
                for (const document of documents) {
                    content += `
                        <div class="document-preview">
                            <h5>${document.jenis_dokumen.replace(/_/g, ' ').toUpperCase()}</h5>
                            <a href="{{ asset('storage/${document.path_dokumen}') }}" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                        </div>
                    `;
                }

                // Menyuntikkan konten ke dalam modal
                document.getElementById('documentContent').innerHTML = content;

                // Menampilkan modal
                $('#documentPreviewModal').modal('show');
            });
        });
    </script>

@endsection
