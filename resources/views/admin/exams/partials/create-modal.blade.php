<div class="modal fade" id="createModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Input Nilai Ujian - {{ $student->nama_lengkap }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.exams.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $student->id }}">
                            <div class="form-group">
                                <label for="nilai">Nilai Ujian</label>
                                <input type="text" class="form-control" name="nilai" required>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan keterangan">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
