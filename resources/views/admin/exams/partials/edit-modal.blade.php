<!-- Modal Edit Nilai Ujian -->
<div class="modal fade" id="editExamModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="editExamModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExamModalLabel{{ $student->id }}">Edit Nilai Ujian Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($student->exams)
                <form action="{{ route('admin.exams.update', $student->exams->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="student_name{{ $student->id }}">Nama Siswa</label>
                            <input type="text" class="form-control" id="student_name{{ $student->id }}" value="{{ $student->nama_lengkap }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="nilai{{ $student->id }}">Nilai</label>
                            <input type="text" class="form-control" id="nilai{{ $student->id }}" name="nilai" value="{{ $student->exams->nilai }}" required min="0" max="100">
                        </div>

                        <div class="form-group">
                            <label for="keterangan{{ $student->id }}">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan{{ $student->id }}" name="keterangan" value="{{ $student->exams->keterangan }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            @else
                <div class="modal-body">
                    <p>Data nilai ujian tidak tersedia untuk siswa ini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            @endif
        </div>
    </div>
</div>
