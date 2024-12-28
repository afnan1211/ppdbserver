<div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">Detail Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="announcementContent">
                <h4>{{ $announcement->judul }}</h4>
                <p>{{ \Carbon\Carbon::parse($announcement->tanggal_dibuat)->translatedFormat('d F Y') }}</p>
                <div>
                    <div>{!! $announcement->isi !!}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
