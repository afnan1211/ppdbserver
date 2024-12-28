<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteUserForm" method="POST" action="{{ route('admin.users.destroy', ['user' => $user->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna ini? Masukkan captcha di bawah ini untuk mengonfirmasi penghapusan.</p>

                    <div class="form-group">
                        <label for="captcha">Masukkan kode CAPTCHA</label>
                        <div id="captcha-container" class="mb-3">
                            {!! captcha_img() !!} <!-- Menampilkan gambar CAPTCHA -->
                        </div>
                        <input type="text" name="captcha" class="form-control" required placeholder="Masukkan kode di atas">
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

<script>
// Ketika modal ditutup, reset CAPTCHA
$('#deleteUserModal').on('hidden.bs.modal', function () {
    resetCaptcha();
});

// Ketika modal dibuka, reset CAPTCHA
$('#deleteUserModal').on('shown.bs.modal', function () {
    resetCaptcha();
});

// Fungsi untuk reset CAPTCHA
function resetCaptcha() {
    fetch("{{ route('admin.captcha.reset') }}") // Memanggil route reset CAPTCHA
        .then(response => response.text())
        .then(data => {
            // Menampilkan gambar CAPTCHA baru
            document.getElementById('captcha-container').innerHTML = data;
        })
        .catch(error => {
            console.error('Error resetting CAPTCHA:', error);
        });

    // Mengosongkan input CAPTCHA
    document.querySelector('input[name="captcha"]').value = '';
}
</script>
