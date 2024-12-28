<div class="modal fade" id="documentPreviewModal" tabindex="-1" role="dialog" aria-labelledby="documentPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentPreviewModalLabel">Pratinjau Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="documentContent">
                <!-- Menampilkan dokumen akan diisi di sini -->
            </div>
        </div>
    </div>
</div>

<script>
    // Menangani klik pada tombol "Lihat Dokumen"
    $('#documentPreviewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var documents = button.data('documents'); // Mendapatkan data dokumen dari atribut data-documents

        var documentContent = '';
        documents.forEach(function(doc) {
            var docUrl = "{{ asset('storage/') }}/" + doc.path_dokumen;
            var docType = doc.jenis_dokumen.replace('_', ' ').toUpperCase();

            documentContent += `
                <div class="document-preview">
                    <h5>${docType}</h5>
                    <a href="${docUrl}" class="btn btn-info btn-sm" target="_blank">Lihat Dokumen</a>
                </div>
            `;
        });

        // Mengisi modal dengan dokumen yang ditemukan
        $('#documentContent').html(documentContent);
    });
</script>
