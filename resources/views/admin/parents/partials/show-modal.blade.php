<div class="modal fade" id="showModal-{{ $parent->id }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Detail Orang Tua - {{ $parent->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jenis_orangtua">Jenis Orang Tua</label>
                    <input type="text" class="form-control" value="{{ $parent->jenis_orangtua }}" disabled>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ $parent->tanggal_lahir }}" disabled>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" value="{{ $parent->tempat_lahir }}" disabled>
                </div>
                <div class="form-group">
                    <label for="siswa">Orang tua dari</label>
                    <input type="text" class="form-control" value="{{ $parent->student->nama_lengkap ?? 'Tidak Ditemukan' }}"
                        disabled>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
