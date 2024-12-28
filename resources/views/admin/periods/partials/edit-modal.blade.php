<div class="modal fade" id="editModal{{ $period->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Form untuk mengupdate periode berdasarkan ID -->
            <form action="{{ route('admin.periods.update', $period->id) }}" method="POST" id="edit-form{{ $period->id }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Periode Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_periode">Nama Periode</label>
                        <input type="text" name="nama_periode" id="edit-nama_periode{{ $period->id }}" class="form-control" value="{{ old('nama_periode', $period->nama_periode) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="edit-status{{ $period->id }}" class="form-control" required>
                            <option value="1" {{ $period->status ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$period->status ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="edit-tanggal_mulai{{ $period->id }}" class="form-control" value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($period->tanggal_mulai)->toDateString()) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="edit-tanggal_selesai{{ $period->id }}" class="form-control" value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($period->tanggal_selesai)->toDateString()) }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
