<div class="modal fade" id="editModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $announcement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form -->
            <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $announcement->id }}">Edit Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Judul -->
                    <div class="form-group">
                        <label for="judul{{ $announcement->id }}">Judul</label>
                        <input type="text" id="judul{{ $announcement->id }}" name="judul" class="form-control"
                               value="{{ old('judul', $announcement->judul) }}" required>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Konten -->
                    <div class="form-group">
                        <label for="isi{{ $announcement->id }}">Konten</label>
                        <textarea id="isi{{ $announcement->id }}" name="isi" class="form-control ckeditor" rows="5" required>{{ old('isi', $announcement->isi) }}</textarea>
                        @error('isi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Status -->
                    <div class="form-group">
                        <label for="status{{ $announcement->id }}">Status</label>
                        <select id="status{{ $announcement->id }}" name="status" class="form-control">
                            <option value="1" {{ $announcement->status ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$announcement->status ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
