<div class="modal fade" id="editModal-{{ $parent->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel-{{ $parent->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{ $parent->id }}">
                    <span>Edit Orang Tua: {{ $parent->nama }}</span><br>
                    <small class="text-muted">Orang tua dari
                        <small class="text-muted">{{ $parent->student->nama_lengkap ?? 'Tidak Ditemukan' }}</small>
                    </small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.parents.update', $parent->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $parent->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_orangtua">Jenis Orang Tua</label>
                        <select name="jenis_orangtua"
                            class="form-control @error('jenis_orangtua') is-invalid @enderror">
                            <option value="ayah"
                                {{ old('jenis_orangtua', $parent->jenis_orangtua) == 'ayah' ? 'selected' : '' }}>Ayah
                            </option>
                            <option value="ibu"
                                {{ old('jenis_orangtua', $parent->jenis_orangtua) == 'ibu' ? 'selected' : '' }}>Ibu
                            </option>
                        </select>
                        @error('jenis_orangtua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $parent->tanggal_lahir) }}">
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $parent->tempat_lahir) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
