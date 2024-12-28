<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.students.destroy', ['student' => $student->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data siswa <strong>{{ $student->nama_lengkap }}</strong> ?<br>
                    Untuk mengonfirmasi, ketik nama lengkap siswa di bawah ini.</p>

                    <div class="form-group">
                        <label for="confirm-name">Nama Lengkap Siswa</label>
                        <input type="text" name="confirm_name" id="confirm-name-{{ $student->id }}" class="form-control" required placeholder="Ketik nama lengkap siswa">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
