@extends('layouts.user')

@section('title', 'Biodata Siswa')

@section('content')
    <div class="container-fluid">
        <!-- Notifikasi Error / Success -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif

        <!-- Biodata Siswa -->
        @if (auth()->user()->student)
            @php
                $student = auth()->user()->student;
                $father = $student->ayah ?? null;
                $mother = $student->ibu ?? null;
                $documents = $student->documents ?? collect();
                $registration = $student->registration;
                $registrationStatus = $registration->status ?? 'Tidak Diketahui';
                $periodName = $registration->nama_periode ?? 'Tidak Diketahui';
            @endphp

            <!-- Mulai Form dengan Collapse -->
            <div class="accordion" id="accordionExample">

                <!-- Form Edit Biodata Siswa -->
                <form action="{{ route('user.biodata.update') }}" method="POST">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header" id="headingBiodata">
                            <h5 class="mb-0">
                                <!-- Tombol Collapse untuk Form Biodata -->
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseBiodata" aria-expanded="false" aria-controls="collapseBiodata">
                                    Edit Biodata Siswa
                                    <i class="fas fa-plus ml-2" id="iconBiodata"></i> <!-- Ikon plus -->
                                </button>
                            </h5>
                        </div>
                        <div id="collapseBiodata" class="collapse" aria-labelledby="headingBiodata"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                @foreach (['nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'nisn', 'alamat_lengkap', 'sekolah_asal', 'alamat_sekolah_asal','no_telp',] as $field)
                                    <div class="form-group">
                                        <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                        <input type="text" name="{{ $field }}" id="{{ $field }}"
                                            class="form-control mb-3" placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}"
                                            value="{{ $student->$field }}" disabled>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control mb-3"
                                        value="{{ $student->tanggal_lahir }}" disabled>
                                </div>

                                <button type="button" class="btn btn-primary" id="editBiodataBtn" onclick="enableEdit('Biodata')">Edit</button>
                                <button type="button" class="btn btn-secondary" id="closeBiodataBtn" onclick="disableEdit('Biodata')" disabled>Tutup</button>
                                <button type="submit" class="btn btn-success" id="saveBiodataBtn" disabled>Simpan Biodata</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Edit Data Orang Tua -->
                <form action="{{ route('user.biodata.updateParents') }}" method="POST">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header" id="headingParents">
                            <h5 class="mb-0">
                                <!-- Tombol Collapse untuk Form Orang Tua -->
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseParents" aria-expanded="false" aria-controls="collapseParents">
                                    Edit Data Orang Tua
                                    <i class="fas fa-plus ml-2" id="iconParents"></i> <!-- Ikon plus -->
                                </button>
                            </h5>
                        </div>
                        <div id="collapseParents" class="collapse" aria-labelledby="headingParents"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!-- Data Ayah -->
                                <hr class="sidebar-divider">
                                <h5>Ayah</h5>
                                @foreach (['nama', 'tempat_lahir', 'tanggal_lahir'] as $field)
                                    <div class="form-group">
                                        <label for="ayah_{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                        <input type="text" name="ayah_{{ $field }}" id="ayah_{{ $field }}"
                                            class="form-control mb-3"
                                            placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}"
                                            value="{{ $father->$field ?? '' }}" disabled>
                                    </div>
                                @endforeach

                                <!-- Data Ibu -->
                                <hr class="sidebar-divider">
                                <h5>Ibu</h5>
                                @foreach (['nama', 'tempat_lahir', 'tanggal_lahir'] as $field)
                                    <div class="form-group">
                                        <label for="ibu_{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                        <input type="text" name="ibu_{{ $field }}" id="ibu_{{ $field }}"
                                            class="form-control mb-3"
                                            placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}"
                                            value="{{ $mother->$field ?? '' }}" disabled>
                                    </div>
                                @endforeach

                                <button type="button" class="btn btn-primary" id="editParentsBtn" onclick="enableEdit('Parents')">Edit</button>
                                <button type="button" class="btn btn-secondary" id="closeParentsBtn" onclick="disableEdit('Parents')" disabled>Tutup</button>
                                <button type="submit" class="btn btn-success" id="saveParentsBtn" disabled>Simpan Data Orang Tua</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Upload Dokumen -->
                <form action="{{ route('user.biodata.uploadDocuments') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header" id="headingDocuments">
                            <h5 class="mb-0">
                                <!-- Tombol Collapse untuk Form Upload Dokumen -->
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseDocuments" aria-expanded="false"
                                    aria-controls="collapseDocuments">
                                    Upload Dokumen Siswa
                                    <i class="fas fa-plus ml-2" id="iconDocuments"></i> <!-- Ikon plus -->
                                </button>
                            </h5>
                        </div>
                        <div id="collapseDocuments" class="collapse" aria-labelledby="headingDocuments"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <span class="mb-3 text-sm text-bold">*Silahkan Upload dengan format PDF, PNG, dan JPEG dengan ukuran maksimal 1 MB</sp>
                                @foreach (['akta_kelahiran', 'kartu_keluarga', 'ijazah sekolah terakhir', 'foto diri'] as $docType)
                                    <div class="mb-3">
                                        <label for="{{ $docType }}">{{ ucfirst(str_replace('_', ' ', $docType)) }}</label>

                                        <!-- Input File, Hide If Document Exists -->
                                        @if ($documents->where('jenis_dokumen', $docType)->isEmpty())

                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="{{ $docType }}"
                                                        class="custom-file-input" id="{{ $docType }}" disabled>
                                                    <label class="custom-file-label" for="{{ $docType }}">Pilih Dokumen</label>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Show Document Info if already exists -->
                                            <div class="d-flex align-items-center">
                                                <a href="{{ Storage::url($documents->where('jenis_dokumen', $docType)->first()->path_dokumen) }}"
                                                    class="btn btn-info btn-sm" target="_blank">
                                                    Lihat Dokumen
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm ml-2"
                                                    onclick="deleteDocument('{{ $docType }}')">
                                                    Hapus Dokumen
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach

                                <button type="button" class="btn btn-primary" id="editDocumentsBtn" onclick="enableEdit('Documents')">Edit</button>
                                <button type="button" class="btn btn-secondary" id="closeDocumentsBtn" onclick="disableEdit('Documents')" disabled>Tutup</button>
                                <button type="submit" class="btn btn-success" id="saveDocumentsBtn" disabled>Upload Dokumen</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div> <!-- End Accordion -->
        @else
            <p class="text-muted">Biodata siswa tidak ditemukan. Pastikan Anda telah mendaftar dan memiliki data siswa yang
                lengkap.</p>
        @endif
    </div>
    <script>
        function deleteDocument(docType) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Dokumen ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('user.biodata.deleteDocument') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            docType: docType,
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Dihapus!', 'Dokumen berhasil dihapus.', 'success');
                                location.reload();
                            } else {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus dokumen.','error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus dokumen.', 'error');
                        }
                    });
                }
            });
        }

        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', function() {
                let fileName = this.files[0] ? this.files[0].name : 'Pilih Dokumen';
                this.nextElementSibling.innerText = fileName;
            });
        });

        // Menambahkan fungsionalitas untuk plus dan minus
        $('#accordionExample').on('show.bs.collapse', function (e) {
            var targetId = e.target.id;
            $('#' + targetId).prev().find('i').removeClass('fa-plus').addClass('fa-minus');
        });

        $('#accordionExample').on('hide.bs.collapse', function (e) {
            var targetId = e.target.id;
            $('#' + targetId).prev().find('i').removeClass('fa-minus').addClass('fa-plus');
        });

        // Function to enable and disable form fields
        function enableEdit(formType) {
            $('#' + 'collapse' + formType).find('input').prop('disabled', false);
            $('#' + 'save' + formType + 'Btn').prop('disabled', false);
            $('#' + 'close' + formType + 'Btn').prop('disabled', false);
            $('#' + 'edit' + formType + 'Btn').prop('disabled', true);
        }

        function disableEdit(formType) {
            $('#' + 'collapse' + formType).find('input').prop('disabled', true);
            $('#' + 'save' + formType + 'Btn').prop('disabled', true);
            $('#' + 'close' + formType + 'Btn').prop('disabled', true);
            $('#' + 'edit' + formType + 'Btn').prop('disabled', false);
        }
    </script>
@endsection
