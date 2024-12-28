 @foreach($announcements as $announcement)
                    <div class="modal fade" id="showModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{ $announcement->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showModalLabel{{ $announcement->id }}">Detail Pengumuman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4>{{ $announcement->judul }}</h4>
                                    <p>{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->translatedFormat('d F Y') }}</p>
                                    <p><strong>Status:</strong> <span class="badge badge-{{ $announcement->status ? 'success' : 'secondary' }}">
                                        {{ $announcement->status ? 'Aktif' : 'Nonaktif' }}</span>
                                    </p>
                                    <div>
                                        <div>{!! $announcement->isi !!}</div> <!-- Output raw HTML content -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
