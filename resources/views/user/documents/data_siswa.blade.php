<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .card { border: 1px solid #ddd; padding: 20px; border-radius: 10px; max-width: 600px; margin: 20px auto; }
        h1 { text-align: center; color: #333; }
        .data-section { margin-bottom: 20px; }
        .data-section h2 { border-bottom: 1px solid #ddd; padding-bottom: 5px; }
        .data-section p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Data Siswa</h1>
        <div class="data-section">
            <h2>Data Pribadi</h2>
            <p><strong>Nama:</strong> {{ $student->nama_lengkap }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $student->jenis_kelamin }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</p>
            <p><strong>NISN:</strong> {{ $student->nisn }}</p>
            <p><strong>Alamat:</strong> {{ $student->alamat_lengkap }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $student->no_telp }}</p>
            <p><strong>Sekolah Asal:</strong> {{ $student->sekolah_asal }}</p>
        </div>
        <div class="data-section">
            <h2>Data Orang Tua</h2>
            <h3>Ayah</h3>
            <p><strong>Nama:</strong> {{ $father->nama }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $father->tempat_lahir }}, {{ $father->tanggal_lahir }}</p>

            <h3>Ibu</h3>
            <p><strong>Nama:</strong> {{ $mother->nama }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $mother->tempat_lahir }}, {{ $mother->tanggal_lahir }}</p>
        </div>
    </div>
</body>
</html>
