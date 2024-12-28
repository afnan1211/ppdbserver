<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Ujian</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .card { border: 1px solid #333; padding: 20px; border-radius: 10px; max-width: 500px; margin: 20px auto; background: #f9f9f9; }
        h1 { text-align: center; color: #333; }
        .details { margin-top: 15px; }
        .details p { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Kartu Ujian</h1>
        <div class="details">
            <p><strong>Nama Sekolah:</strong> SMP Darut Tauhid Tambakboyo</p>
            <p><strong>Nomor Registrasi:</strong> {{ $student->nomor_registrasi }}</p>
            <p><strong>Nama Siswa:</strong> {{ $student->nama_lengkap }}</p>
            <p><strong>Periode:</strong> {{ $student->registration->period->nama_periode ?? 'Tidak Diketahui' }}</p>
        </div>
    </div>
</body>
</html>
