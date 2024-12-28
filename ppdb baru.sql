-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2024 pada 12.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

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
(29, '', 'dokumen/vAlGQvtZ39FgNUkY25UCCw8BuN8sWAkXo7zc49aP.jpg', 19, '2024-11-15 09:43:10', '2024-11-15 09:43:10'),
(30, '', 'dokumen/AiQkaM7hFhxm6m5aRR5GrHb7DzpSPhLnnvU8Fttp.jpg', 19, '2024-11-15 09:43:10', '2024-11-15 09:43:10'),
(31, 'akta_kelahiran', 'dokumen/fmVqHpSXPAOob33cChEvDRg3lzUiPITticDDsjwt.jpg', 27, '2024-11-24 03:34:23', '2024-11-24 03:34:23'),
(32, 'kartu_keluarga', 'dokumen/LtKif4NbvkNCdwgcTXNmmN2AzyAFvfT0s9DNjjDm.jpg', 27, '2024-11-24 03:34:23', '2024-11-24 03:34:23'),
(33, 'ijazah_sekolah', 'dokumen/n2pZV9Wh8msMHqdHDa9009xYuO2i0tI145SbJCtX.jpg', 27, '2024-11-28 09:48:29', '2024-11-28 09:48:29'),
(34, 'foto_diri', 'dokumen/Xr8clnBzcVbYg7VMcgxokZGd3qdz8TLPYwryZGHx.jpg', 27, '2024-11-28 09:48:29', '2024-11-28 09:48:29'),
(35, 'akta_kelahiran', 'dokumen/d2uQY5GhEtdj7lBPk3XRKidvPDdXWYu5bq5pi8tF.jpg', 28, '2024-12-09 04:41:25', '2024-12-09 04:41:25'),
(36, 'kartu_keluarga', 'dokumen/B2rRgQM1hkNqhofEBTmzqnIsxUpwAj4IhW9pXDbg.jpg', 28, '2024-12-09 04:41:25', '2024-12-09 04:41:25'),
(37, 'ijazah_sekolah', 'dokumen/F3QXx5a6oswfdDvgoAY8YulLDw9qUfd8PHlgkw3L.jpg', 28, '2024-12-09 04:41:25', '2024-12-09 04:41:25'),
(38, 'foto_diri', 'dokumen/NNBoI5YKnXRSg9GuGfUn4onrgn9Ji6SYVq6oCG8L.jpg', 28, '2024-12-09 04:41:25', '2024-12-09 04:41:25'),
(39, 'akta_kelahiran', 'dokumen/mYbVqIFTsPZEvi1hhpaavfgK7yNBQgcoeCDGmEIC.jpg', 29, '2024-12-09 08:34:10', '2024-12-09 08:34:10'),
(40, 'kartu_keluarga', 'dokumen/35ZPSHpOdP1ti3aqZfLKClu7Y0av2YvVFlfL2ujR.jpg', 29, '2024-12-09 08:34:10', '2024-12-09 08:34:10'),
(41, 'ijazah_sekolah', 'dokumen/UrAhE48gs1ceaGmLYmusDNY0uCYE8fq4HD0FbiVJ.jpg', 29, '2024-12-09 08:34:10', '2024-12-09 08:34:10'),
(42, 'foto_diri', 'dokumen/actNjlDX4StAurIoKrgDlcOeLGMtwWbt3JbzMGC3.jpg', 29, '2024-12-09 08:34:10', '2024-12-09 08:34:10');

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
(30, 'ibu', 'Nani', 'Bekasi', '1978-07-15', 19, '2024-11-15 09:40:47', '2024-11-15 09:40:47'),
(31, 'ayah', 'dedi', 'gawok', '1967-02-18', 21, '2024-11-21 01:04:42', '2024-11-21 01:04:42'),
(32, 'ibu', 'siti', 'banjarsati', '1968-12-20', 21, '2024-11-21 01:04:42', '2024-11-21 01:04:42'),
(33, 'ayah', 'dedi', 'gawok', '1967-02-18', 22, '2024-11-21 01:12:19', '2024-11-21 01:12:19'),
(34, 'ibu', 'siti', 'banjarsati', '1968-12-20', 22, '2024-11-21 01:12:19', '2024-11-21 01:12:19'),
(35, 'ayah', 'dedi', 'gawok', '1967-02-18', 23, '2024-11-21 01:30:51', '2024-11-21 01:30:51'),
(36, 'ibu', 'siti', 'banjarsati', '1968-12-20', 23, '2024-11-21 01:30:51', '2024-11-21 01:30:51'),
(37, 'ayah', 'dedi', 'gawok', '1967-02-18', 24, '2024-11-21 01:32:27', '2024-11-21 01:32:27'),
(38, 'ibu', 'siti', 'banjarsati', '1968-12-20', 24, '2024-11-21 01:32:27', '2024-11-21 01:32:27'),
(39, 'ayah', 'dedi', 'gawok', '1967-02-18', 25, '2024-11-21 01:57:08', '2024-11-21 01:57:08'),
(40, 'ibu', 'siti', 'banjarsati', '1968-12-20', 25, '2024-11-21 01:57:08', '2024-11-21 01:57:08'),
(41, 'ayah', 'dedi', 'gawok', '1967-02-18', 26, '2024-11-21 02:18:32', '2024-11-21 02:18:32'),
(42, 'ibu', 'siti', 'banjarsati', '1968-12-20', 26, '2024-11-21 02:18:32', '2024-11-21 02:18:32'),
(43, 'ayah', 'dedi', 'gawok', '1967-02-18', 27, '2024-11-24 03:20:44', '2024-11-24 03:20:44'),
(44, 'ibu', 'siti', 'banjarsati', '1968-12-20', 27, '2024-11-24 03:20:44', '2024-11-24 03:20:44'),
(45, 'ayah', 'apri', 'laweyan', '1967-08-12', 28, '2024-12-01 18:21:18', '2024-12-01 18:21:18'),
(46, 'ibu', 'marlina', 'banjarmasin', '1967-09-12', 28, '2024-12-01 18:21:18', '2024-12-01 18:21:18'),
(47, 'ayah', 'apri', 'laweyan', '1967-08-12', 29, '2024-12-09 07:06:19', '2024-12-09 07:06:19'),
(48, 'ibu', 'marlina', 'banjarmasin', '1967-09-12', 29, '2024-12-09 07:06:19', '2024-12-09 07:06:19');

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
(15, 20, '2024-11-16', 'ditunda', 1, '2024-11-15 17:04:07', '2024-11-15 17:04:07'),
(16, 21, '2024-11-21', 'ditunda', 2, '2024-11-21 01:04:42', '2024-11-21 01:04:42'),
(17, 22, '2024-11-21', 'ditunda', 2, '2024-11-21 01:12:19', '2024-11-21 01:12:19'),
(18, 23, '2024-11-21', 'ditunda', 2, '2024-11-21 01:30:51', '2024-11-21 01:30:51'),
(19, 24, '2024-11-21', 'ditunda', 2, '2024-11-21 01:32:27', '2024-11-21 01:32:27'),
(20, 25, '2024-11-21', 'ditunda', 2, '2024-11-21 01:57:08', '2024-11-21 01:57:08'),
(21, 26, '2024-11-21', 'ditunda', 2, '2024-11-21 02:18:32', '2024-11-21 02:18:32'),
(22, 27, '2024-11-24', 'lulus', 2, '2024-11-24 03:20:44', '2024-11-29 01:48:14'),
(23, 28, '2024-12-02', 'lulus', 2, '2024-12-01 18:21:18', '2024-12-09 06:53:14'),
(24, 29, '2024-12-09', 'terdaftar', 2, '2024-12-09 07:06:19', '2024-12-09 08:34:38');

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
(4, 'penerimaan-peserta-didik-baru-pondok-pesantren-tahfidzul-quran-iphi-surakarta', 'Penerimaan Peserta Didik Baru pondok pesantren tahfidzul qur\'an iphi surakarta', '<p>Untuk memudahkan calon peserta didik baru dalam melakukan pendaftaran, maka kami meyediakan pelayanan pendaftaran peserta didik baru mode online atau daring dengan alur pendaftaran sebagai berikut :</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Mengisi formulir pendaftaran online</li>\r\n	<li>&nbsp;Setelah melakukan pengisian formulir online dan kirim data, Screenshot halaman konfirmasi sebagai bukti pendaftaran</li>\r\n	<li>&nbsp;Melakukan test secara offline</li>\r\n	<li>&nbsp;Menerima pengumuman</li>\r\n	<li>&nbsp;Melakukan daftar ulang</li>\r\n	<li>&nbsp;Masuk kegiatan belajar mengajar</li>\r\n</ul>\r\n\r\n<p>Selain pendaftaran mode online atau daring, kami juga masih melayani pendaftaran offline/luring dengan datang langsung ke sekretariat pendaftaran (pondok pesantren tahfidzul qur&#39;an iphi surakarta).</p>', '2024-11-21', 1, '2024-11-15 08:22:43', '2024-11-21 01:18:31');

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
(20, 60, 'Fahmi Algifari', 'Laki-laki', 'Bandung', '2013-07-06', '5012923123', 'JL. Bahureksa No.18 B', 'SDN 15 Selontongan', 'Jl. Selontongan', '08123456789', '03563754', NULL, NULL, '2024-11-15 17:04:07', '2024-11-15 17:04:07'),
(21, 61, 'baskara', 'Laki-laki', 'gawok', '2006-12-11', '23456789', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '43801562', 31, 32, '2024-11-21 01:04:42', '2024-11-21 01:04:42'),
(22, 62, 'baskaraA', 'Laki-laki', 'gawok', '2006-12-11', '234567891', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '22951479', 33, 34, '2024-11-21 01:12:19', '2024-11-21 01:12:19'),
(23, 63, 'baskaraAaa', 'Laki-laki', 'gawok', '2006-12-11', '2345678912', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '91043136', 35, 36, '2024-11-21 01:30:51', '2024-11-21 01:30:51'),
(24, 64, 'baskaraAaa11', 'Laki-laki', 'gawok', '2006-12-11', '23456789121', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '72993977', 37, 38, '2024-11-21 01:32:27', '2024-11-21 01:32:27'),
(25, 65, 'baskaraAaa1121', 'Laki-laki', 'gawok', '2006-12-11', '234567891212', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '68552443', 39, 40, '2024-11-21 01:57:08', '2024-11-21 01:57:08'),
(26, 66, 'baskaraa11', 'Laki-laki', 'gawok', '2006-12-11', '0123456789', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '43578147', 41, 42, '2024-11-21 02:18:32', '2024-11-21 02:18:32'),
(27, 67, 'baskaraa111', 'Laki-laki', 'gawok', '2006-12-11', '012345678910', 'gawok city', 'sd 1 gawok', 'gawok', '087776655442', '69512854', 43, 44, '2024-11-24 03:20:44', '2024-11-24 03:20:44'),
(28, 68, 'afnan', 'Laki-laki', 'cemani', '2002-11-12', '1234567890', 'ngruki, cemani, sukoharjo', 'sd 1 cemani', 'cemani', '098871234578', '67052875', 45, 46, '2024-12-01 18:21:18', '2024-12-01 18:21:18'),
(29, 69, 'budi', 'Laki-laki', 'cemani', '2002-11-12', '12345678901', 'ngruki, cemani, sukoharjo', 'sd 1 cemani', 'cemani', '0988712345783', '83399609', 47, 48, '2024-12-09 07:06:19', '2024-12-09 07:06:19');

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
(5, 19, 40.00, 'coba lagi', '2024-11-15 09:46:42', '2024-11-15 09:48:51'),
(6, 27, 80.00, 'SELAMAT ANDA DITERIMA', '2024-11-29 01:48:14', '2024-11-29 01:48:14'),
(7, 28, 90.00, 'SELAMAT ANDA DITERIMA', '2024-12-09 06:53:14', '2024-12-09 06:53:14');

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
(5, 'admin', 'admin@gmail.com', '$2a$12$De8Wf4t90QPtpujAfdWQDuk8z/DeLMo9jF2RlwQTIBngfcWk7ISKa', 'admin', NULL, '2024-11-06 09:36:12', '2024-11-06 09:36:12', NULL),
(42, 'Nurul Ainun', 'nurul.ainun@example.com', '$2y$10$wkzS94juuEYt4cZ02nmJ3elgjXsu6s8sUTkYBx7j.y2jrkpOkqeLy', 'user', NULL, '2024-11-12 03:43:27', '2024-11-12 03:43:27', NULL),
(58, 'Fahmi Algifari', 'fahmi.algifari@example.com', '$2y$10$.YozcPodu0wAacH/u9ZYguXD/rwmifYX7u5YHYCNxG0VmK1dH5ylS', 'user', NULL, '2024-11-15 09:31:01', '2024-11-15 09:31:01', NULL),
(59, 'Rival Nugraha', 'rival.nugraha@example.com', '$2y$10$d53/hRKE3EFhkBemWza5M.CAQSQX/73U/EtMjIciELtjfJztN3bhG', 'user', NULL, '2024-11-15 09:40:47', '2024-11-15 17:01:21', NULL),
(60, 'Fahmi Algifari', 'fahmi.algifari9553@example.com', '$2y$10$WktS/cX8RApIbXH3voqVhOBAhs3/h8l2yGVapJZ1XDX3SIpQb9yoe', 'user', NULL, '2024-11-15 17:04:07', '2024-11-15 17:04:07', NULL),
(61, 'baskara', 'baskara@example.com', '$2y$10$KmXUliyE9DkMy3A45FsPY.RAnYSWVuR3MyVxKXlgFum5fcekNdGja', 'user', NULL, '2024-11-21 01:04:42', '2024-11-21 01:04:42', NULL),
(62, 'baskaraA', 'baskaraa@example.com', '$2y$10$v/6ESA4fLNlwCDJlF//yteeivga/FAIaRKCJFGrgl5pisNPp8zlo2', 'user', NULL, '2024-11-21 01:12:19', '2024-11-21 01:12:19', NULL),
(63, 'baskaraAaa', 'baskaraaaa@example.com', '$2y$10$7hA/XzLPthLJH7KBDPb1hOoulrMXl9Qco/9zYXKk1PLema.Akp7YK', 'user', NULL, '2024-11-21 01:30:51', '2024-11-21 01:30:51', NULL),
(64, 'baskaraAaa11', 'baskaraaaa11@example.com', '$2y$10$tM27p9OaOlMutkVG.nUbze2F4P34MxiX2.0RY8bfeGUCP6t0H.HXe', 'user', NULL, '2024-11-21 01:32:27', '2024-11-21 01:32:27', NULL),
(65, 'baskaraAaa1121', 'baskaraaaa1121@gmail.com', '$2y$10$S3TkBmEy154FEYT3tbk9buZqlEd64SQquEW.Ixl42BVhn6uzWrc1C', 'user', NULL, '2024-11-21 01:57:08', '2024-11-21 01:57:08', NULL),
(66, 'baskaraa11', 'baskaraa11@gmail.com', '$2y$10$n8kpsXT./sbVYYdnfbUCeOmUuzu84GzJZ8IqfJD/NgTjMUmDjUdou', 'user', NULL, '2024-11-21 02:18:32', '2024-11-21 02:18:54', NULL),
(67, 'baskaraa111', 'baskaraa111@gmail.com', '$2y$10$BucJymzncYKHY3X.ouRA9erKlEDVMZRBgKQjwC9p73FzbDPtNj1f2', 'user', NULL, '2024-11-24 03:20:44', '2024-11-24 03:25:47', NULL),
(68, 'afnan', 'afnan@gmail.com', '$2y$10$PpeqbdckFKrWvh67twiCUOFNrcqGA1aBQFcqG2DaqRKS6AgGCeL6G', 'user', NULL, '2024-12-01 18:21:18', '2024-12-01 18:21:47', NULL),
(69, 'budi', 'budi@gmail.com', '$2y$10$CX3PRKKTgxAXqprAcmoO9ORe5kqGmCdFIJBQFGQjJBtc8gH4bfes6', 'user', NULL, '2024-12-09 07:06:19', '2024-12-09 08:31:53', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
