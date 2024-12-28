<!-- Modal Create -->
<div class="modal fade" id="createParentModal" tabindex="-1" role="dialog" aria-labelledby="createParentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createParentModalLabel">Tambah Orang Tua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambah orang tua -->
                <form method="POST" action="{{ route('admin.parents.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="siswa_id" class="form-label">Pilih Siswa</label>
                        <input type="text" class="form-control mb-2" id="siswaSearch" placeholder="Cari siswa..." />
                        <!-- Kolom pencarian -->

                        <!-- Daftar pencarian siswa -->
                        <ul id="searchResults" class="list-group" style="max-height: 200px; overflow-y: auto;"></ul>

                        <!-- Pilihan siswa (tampilkan jika ada hasil pencarian) -->
                        <select name="siswa_id" id="siswa_id" class="form-control" required>
                            <option value="">Pilih Siswa...</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" class="student-option"
                                    {{ ($student->ayah_id && $student->ibu_id) ? 'disabled' : '' }}>
                                    {{ $student->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama"
                            value="{{ old('nama') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_orangtua">Jenis Orang Tua</label>
                        <select class="form-control" name="jenis_orangtua" id="jenis_orangtua" required>
                            <option value="ayah" {{ old('jenis_orangtua') == 'ayah' ? 'selected' : '' }}>Ayah</option>
                            <option value="ibu" {{ old('jenis_orangtua') == 'ibu' ? 'selected' : '' }}>Ibu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            value="{{ old('tempat_lahir') }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            aria-label="Close">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    var students = @json($students); // Data siswa dari backend
    var searchResults = $('#searchResults');

    // Menangani pencarian siswa
    $('#siswaSearch').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase(); // Ambil nilai pencarian

        // Kosongkan hasil pencarian
        searchResults.empty();

        if (searchValue) {
            // Cari siswa yang sesuai dan tampilkan hasil pencarian
            var filteredStudents = students.filter(function(student) {
                return student.nama_lengkap.toLowerCase().indexOf(searchValue) !== -1;
            });

            // Tampilkan hasil pencarian
            filteredStudents.forEach(function(student) {
                var listItem = $('<li>', {
                    class: 'list-group-item',
                    text: student.nama_lengkap,
                    'data-id': student.id
                });

                listItem.on('click', function() {
                    $('#siswaSearch').val(student.nama_lengkap); // Set input dengan nama siswa
                    $('#siswa_id').val(student.id); // Set nilai ID siswa
                    searchResults.empty(); // Hapus hasil pencarian

                    // Cek apakah siswa sudah memiliki orang tua
                    var hasFather = student.ayah_id; // Cek jika sudah ada data ayah
                    var hasMother = student.ibu_id; // Cek jika sudah ada data ibu

                    if (hasFather || hasMother) {
                        // Jika sudah ada salah satu orang tua
                        if (hasFather && !hasMother) {
                            // Hanya ada ayah, izinkan menambahkan ibu
                            $('#createParentModal button[type="submit"]').prop('disabled', false); // Enable button untuk menambahkan ibu
                            Swal.fire({
                                icon: 'info',
                                title: 'Tambah Ibu',
                                text: 'Siswa ini sudah memiliki ayah, silakan tambahkan ibu.',
                                confirmButtonText: 'Tutup'
                            });
                        } else if (hasMother && !hasFather) {
                            // Hanya ada ibu, izinkan menambahkan ayah
                            $('#createParentModal button[type="submit"]').prop('disabled', false); // Enable button untuk menambahkan ayah
                            Swal.fire({
                                icon: 'info',
                                title: 'Tambah Ayah',
                                text: 'Siswa ini sudah memiliki ibu, silakan tambahkan ayah.',
                                confirmButtonText: 'Tutup'
                            });
                        } else {
                            // Jika sudah ada keduanya, nonaktifkan tombol submit dan tampilkan pesan
                            $('#createParentModal button[type="submit"]').prop('disabled', true);

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Siswa ini sudah memiliki orang tua.',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    } else {
                        // Jika tidak ada orang tua, izinkan menambahkan baik ayah atau ibu
                        $('#createParentModal button[type="submit"]').prop('disabled', false);
                    }
                });

                searchResults.append(listItem); // Tambahkan ke daftar hasil pencarian
            });
        }
    });
});

    $('#createParentModal form').submit(function(e) {
        e.preventDefault(); // Mencegah form dikirim langsung

        // Cek apakah ID siswa terisi
        var siswaId = $('#siswa_id').val();
        if (!siswaId) {
            Swal.fire({
                icon: 'error',
                title: 'ID Siswa Tidak Terisi',
                text: 'Pastikan Anda telah memilih siswa sebelum menambahkan orang tua.',
                confirmButtonText: 'Tutup'
            });
            return; // Jangan lanjutkan jika ID tidak ada
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menambahkan orang tua baru untuk siswa ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, kirimkan form
                this.submit();
            }
        });
    });
</script>
