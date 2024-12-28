-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2024 pada 01.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_online_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '2014_10_12_000000_create_users_table', 1),
(37, '2014_10_12_100000_create_password_resets_table', 2),
(38, '2024_11_06_103014_create_periode_table', 3),
(39, '2024_11_06_101129_create_siswa_table', 4),
(40, '2024_11_06_101641_create_orangtua_table', 5),
(41, '2024_11_06_101853_create_dokumen_table', 6),
(42, '2024_11_06_102821_create_pendaftaran_table', 7),
(43, '2024_11_06_103200_create_pengumuman_table', 8),
(44, '2024_11_06_103239_create_ujian_table', 9),
(45, '2024_11_06_130341_create_permission_tables', 10),
(46, '2024_11_12_102921_create_sessions_table', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_dokumen` enum('akta_kelahiran','kartu_keluarga','ijazah_sekolah','foto_diri') NOT NULL,
  `path_dokumen` varchar(255) NOT NULL,
  `siswa_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `jenis_dokumen`, `path_dokumen`, `siswa_id`, `created_at`, `updated_at`) VALUES
(27, 'akta_kelahiran', 'dokumen/Dgbwhsjcazic87MTlfESZxhvDKoC3wDJfvUVMHGn.jpg', 19, '2024-11-15 09:43:09', '2024-11-15 09:43:09'),
(28, 'kartu_keluarga', 'dokumen/pCnFaiHsX3GBHBEu88jAHbQwllKZIqE8iWlxlZCc.jpg', 19, '2024-11-15 09:43:10', '2024-11-15 09:43:10'),
(29, 'ijazah_sekolah', 'dokumen/vAlGQvtZ39FgNUkY25UCCw8BuN8sWAkXo7zc49aP.jpg', 19, '2024-11-15 09:43:10', '2024-11-15 09:43:10'),
(30, 'foto_diri', 'dokumen/AiQkaM7hFhxm6m5aRR5GrHb7DzpSPhLnnvU8Fttp.jpg', 19, '2024-11-15 09:43:10', '2024-11-15 09:43:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_orangtua`
--

CREATE TABLE `tb_orangtua` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_orangtua` enum('ayah','ibu') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `siswa_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_orangtua`
--

INSERT INTO `tb_orangtua` (`id`, `jenis_orangtua`, `nama`, `tempat_lahir`, `tanggal_lahir`, `siswa_id`, `created_at`, `updated_at`) VALUES
(14, 'ayah', 'Asep Dufron', 'Bandung', '1976-12-09', 8, '2024-11-12 03:43:27', '2024-11-12 03:43:27'),
(15, 'ibu', 'Yuni Muraimah', 'Garut', '1976-06-05', 8, '2024-11-12 03:43:27', '2024-11-12 10:48:07'),
(27, 'ayah', 'Agus sutiono', 'Garut', '1987-11-07', 18, '2024-11-15 09:33:26', '2024-11-15 09:33:26'),
(28, 'ibu', 'Yati', 'Karawang', '1988-07-06', 18, '2024-11-15 09:34:17', '2024-11-15 09:34:17'),
(29, 'ayah', 'Dudun', 'Bandung', '1945-08-17', 19, '2024-11-15 09:40:47', '2024-11-15 09:40:47'),
(30, 'ibu', 'Nani', 'Bekasi', '1978-07-15', 19, '2024-11-15 09:40:47', '2024-11-15 09:40:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `siswa_id` int(10) UNSIGNED NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` enum('terdaftar','lulus','tidak_lulus','ditunda') NOT NULL,
  `periode_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id`, `siswa_id`, `tanggal_daftar`, `status`, `periode_id`, `created_at`, `updated_at`) VALUES
(4, 8, '2024-11-12', 'lulus', 2, '2024-11-12 03:43:27', '2024-11-12 22:21:43'),
(13, 18, '2024-11-15', 'ditunda', 2, '2024-11-15 09:31:01', '2024-11-15 09:31:01'),
(14, 19, '2024-11-15', 'tidak_lulus', 2, '2024-11-15 09:40:47', '2024-11-15 09:48:51'),
(15, 20, '2024-11-16', 'ditunda', 1, '2024-11-15 17:04:07', '2024-11-15 17:04:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`id`, `slug`, `judul`, `isi`, `tanggal_dibuat`, `status`, `created_at`, `updated_at`) VALUES
(4, 'penerimaan-peserta-didik-baru-smp-darut-tauhid-tambakboyo-tahun-ajaran-20242025', 'Penerimaan Peserta Didik Baru SMP Darut Tauhid Tambakboyo Tahun Ajaran 2024/2025', '<p>Assalamu&rsquo;alaikum Warahmatullahi Wabarakatuh,</p>\r\n\r\n<p>SMP Darut Tauhid Tambakboyo membuka kesempatan bagi putra-putri terbaik untuk bergabung bersama kami pada Tahun Ajaran <strong>2024/2025</strong>. Kami berkomitmen untuk memberikan pendidikan yang unggul dengan pendekatan Islami untuk membentuk generasi yang beriman, bertakwa, dan berakhlakul karimah.</p>\r\n\r\n<h3>Syarat Pendaftaran</h3>\r\n\r\n<ul>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Fotokopi Akta Kelahiran</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Fotokopi Kartu Keluarga</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Fotokopi Ijazah atau Surat Keterangan Lulus (SKL)</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Pas Foto 3x4 sebanyak 4 lembar</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li>Usia maksimal 15 tahun pada bulan Juli 2024</li>\r\n</ul>\r\n\r\n<h3>Jadwal Pendaftaran</h3>\r\n\r\n<p>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"5\">\r\n	<thead>\r\n		<tr>\r\n			<th>Tahap</th>\r\n			<th>Tanggal</th>\r\n			<th>Keterangan</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Pendaftaran Online</td>\r\n			<td>1 Januari 2024 - 31 Maret 2024</td>\r\n			<td>Pendaftaran dilakukan secara online melalui website resmi SMP Darut Tauhid Tambakboyo</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Seleksi Akademik</td>\r\n			<td>5 April 2024</td>\r\n			<td>Peserta akan mengikuti ujian seleksi akademik di kampus SMP Darut Tauhid Tambakboyo</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pengumuman Hasil Seleksi</td>\r\n			<td>10 April 2024</td>\r\n			<td>Hasil seleksi dapat dilihat di website resmi sekolah</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h3>Kontak Informasi</h3>\r\n\r\n<p>Untuk informasi lebih lanjut, silakan menghubungi nomor berikut:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li><strong>Telepon:</strong> (021) 12345678</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li><strong>Email:</strong> info@smpdaruttauhid.sch.id</li>\r\n	<li>&nbsp;&nbsp; &nbsp;</li>\r\n	<li><strong>Website:</strong> <a href=\"http://www.smpdaruttauhid.sch.id\">www.smpdaruttauhid.sch.id</a></li>\r\n</ul>\r\n\r\n<p>Demikian informasi ini kami sampaikan. Semoga Allah memudahkan langkah kita semua dalam menuntut ilmu. Aamiin.</p>\r\n\r\n<p>Wassalamu&rsquo;alaikum Warahmatullahi Wabarakatuh.</p>', '2024-11-15', 1, '2024-11-15 08:22:43', '2024-11-15 09:03:19'),
(5, 'hallo-siswa-smp-baru', 'Hallo siswa smp baru', '<p><em><strong>Hallo semuanya sehat selalu ya siswa smp bla bla, terimakasih</strong></em></p>', '2024-11-15', 0, '2024-11-15 09:36:37', '2024-11-15 09:37:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_periode` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`id`, `nama_periode`, `status`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 'Tahun Pelajaran 2028/2029', 0, '2028-06-04', '2029-06-02', '2024-11-08 11:02:17', '2024-11-11 22:47:13'),
(2, 'Tahun Pelajaran 2025/2026', 1, '2025-06-04', '2026-06-02', '2024-11-08 18:29:48', '2024-11-15 17:14:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `sekolah_asal` varchar(255) DEFAULT NULL,
  `alamat_sekolah_asal` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `nomor_registrasi` varchar(255) DEFAULT NULL,
  `ayah_id` int(10) UNSIGNED DEFAULT NULL,
  `ibu_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `user_id`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nisn`, `alamat_lengkap`, `sekolah_asal`, `alamat_sekolah_asal`, `no_telp`, `nomor_registrasi`, `ayah_id`, `ibu_id`, `created_at`, `updated_at`) VALUES
(8, 42, 'Nurul Ainun', 'Laki-laki', 'Karawang', '2009-12-12', '0056652123', 'Kp. Ciibadak indah', 'SDN Cibadak 03', 'Kp.Jatimekar', '0895898974', '49647916', 14, 15, '2024-11-12 03:43:27', '2024-11-12 22:21:43'),
(18, 58, 'Fahmi Algifari', 'Laki-laki', 'Bandung', '2012-05-04', '0056652124', 'Jl. Ahmad yani', 'SDN 3 Bandung', 'Jl. Jakarta', '0895323232535', '00364260', 27, 28, '2024-11-15 09:31:01', '2024-11-15 17:17:07'),
(19, 59, 'Rival Nugraha', 'Laki-laki', 'Jakarta', '2012-05-16', '501292766', 'Jalan veteran', 'SDN Jakatra 56', 'Jl. Ahmad yani', '08123456789', '82039044', 29, 30, '2024-11-15 09:40:47', '2024-11-15 09:40:47'),
(20, 60, 'Fahmi Algifari', 'Laki-laki', 'Bandung', '2013-07-06', '5012923123', 'JL. Bahureksa No.18 B', 'SDN 15 Selontongan', 'Jl. Selontongan', '08123456789', '03563754', NULL, NULL, '2024-11-15 17:04:07', '2024-11-15 17:04:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `id` int(10) UNSIGNED NOT NULL,
  `siswa_id` int(10) UNSIGNED NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_ujian`
--

INSERT INTO `tb_ujian` (`id`, `siswa_id`, `nilai`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 8, 98.50, 'Semangat ya nilai kamu bagus', '2024-11-12 21:49:29', '2024-11-12 21:56:03'),
(5, 19, 40.00, 'coba lagi', '2024-11-15 09:46:42', '2024-11-15 09:48:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'admin', 'admin@example.com', '$2y$10$jCcda2fg82IPn7GmIHZy.e5ii62xATJqpCyAIF0lKrowTtqaizfoC', 'admin', NULL, '2024-11-06 09:36:12', '2024-11-06 09:36:12', NULL),
(42, 'Nurul Ainun', 'nurul.ainun@example.com', '$2y$10$wkzS94juuEYt4cZ02nmJ3elgjXsu6s8sUTkYBx7j.y2jrkpOkqeLy', 'user', NULL, '2024-11-12 03:43:27', '2024-11-12 03:43:27', NULL),
(58, 'Fahmi Algifari', 'fahmi.algifari@example.com', '$2y$10$.YozcPodu0wAacH/u9ZYguXD/rwmifYX7u5YHYCNxG0VmK1dH5ylS', 'user', NULL, '2024-11-15 09:31:01', '2024-11-15 09:31:01', NULL),
(59, 'Rival Nugraha', 'rival.nugraha@example.com', '$2y$10$d53/hRKE3EFhkBemWza5M.CAQSQX/73U/EtMjIciELtjfJztN3bhG', 'user', NULL, '2024-11-15 09:40:47', '2024-11-15 17:01:21', NULL),
(60, 'Fahmi Algifari', 'fahmi.algifari9553@example.com', '$2y$10$WktS/cX8RApIbXH3voqVhOBAhs3/h8l2yGVapJZ1XDX3SIpQb9yoe', 'user', NULL, '2024-11-15 17:04:07', '2024-11-15 17:04:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_dokumen_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_orangtua_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_pendaftaran_siswa_id_foreign` (`siswa_id`),
  ADD KEY `tb_pendaftaran_periode_id_foreign` (`periode_id`);

--
-- Indeks untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_siswa_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `tb_siswa_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `tb_siswa_nomor_registrasi_unique` (`nomor_registrasi`),
  ADD UNIQUE KEY `ayah_id` (`ayah_id`,`ibu_id`);

--
-- Indeks untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_ujian_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD CONSTRAINT `tb_dokumen_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  ADD CONSTRAINT `tb_orangtua_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD CONSTRAINT `tb_pendaftaran_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `tb_periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_pendaftaran_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD CONSTRAINT `tb_ujian_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
