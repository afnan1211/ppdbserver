                        <div class="modal fade" id="studentModal-{{ $student->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="studentModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="studentModalLabel">Detail Siswa:
                                            {{ $student->nama_lengkap }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nomor Registrasi:</strong> {{ $student->nomor_registrasi }}</p>
                                        <p><strong>Nama Lengkap:</strong> {{ $student->nama_lengkap }}</p>
                                        <p><strong>Jenis Kelamin:</strong> {{ ucfirst($student->jenis_kelamin) }}</p>
                                        <p><strong>Tempat Lahir:</strong> {{ $student->tempat_lahir }}</p>
                                        <p><strong>Tanggal Lahir:</strong> {{ $student->tanggal_lahir }}</p>
                                        <p><strong>NISN:</strong> {{ $student->nisn }}</p>
                                        <p><strong>Alamat Lengkap:</strong> {{ $student->alamat_lengkap }}</p>
                                        <p><strong>Sekolah Asal:</strong> {{ $student->sekolah_asal }}</p>
                                        <p><strong>Alamat Sekolah Asal:</strong> {{ $student->alamat_sekolah_asal }}
                                        </p>
                                        <p><strong>Nomor Telepon:</strong> {{ $student->no_telp }}</p>

                                        <!-- Display Ayah and Ibu -->
                                        <p><strong>Nama Ayah:</strong> {{ $student->ayah->nama ?? 'Tidak Ditemukan' }}
                                        </p>
                                        <p><strong>Nama Ibu:</strong> {{ $student->ibu->nama ?? 'Tidak Ditemukan' }}
                                        </p>

                                        {{-- <form action="{{ route('admin.students.updateStatus', $student->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="status">Update Status:</label>
                                                <select name="status" class="form-control">
                                                    <option value="ditunda"
                                                        {{ $student->registration->status == 'ditunda' ? 'selected' : '' }}>
                                                        Ditunda</option>
                                                    <option value="terdaftar"
                                                        {{ $student->registration->status == 'terdaftar' ? 'selected' : '' }}>
                                                        Terdaftar</option>
                                                    <option value="lulus"
                                                        {{ $student->registration->status == 'lulus' ? 'selected' : '' }}>
                                                        Lulus</option>
                                                    <option value="tidak_lulus"
                                                        {{ $student->registration->status == 'tidak_lulus' ? 'selected' : '' }}>
                                                        Tidak Lulus</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Simpan
                                                Perubahan</button>
                                        </form> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
