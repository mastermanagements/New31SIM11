-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Feb 2021 pada 20.02
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_agenda_harian`
--

CREATE TABLE `a_agenda_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_agenda` date NOT NULL,
  `id_jobdesc` int(10) UNSIGNED DEFAULT NULL,
  `id_target_bulanan` int(10) UNSIGNED DEFAULT NULL,
  `agenda` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_arsip`
--

CREATE TABLE `a_arsip` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenis_arsip` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_arsip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_ba_kemajuan`
--

CREATE TABLE `a_ba_kemajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `isi_bak` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_bakem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_ba_kemajuan`
--

INSERT INTO `a_ba_kemajuan` (`id`, `id_spk`, `isi_bak`, `file_bakem`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Coret Coret Tentang Makanan</p>', '5caeb18adf1bd1554952586.zip', '5caeb18ae01921554952586.zip', 2, 1, '2019-04-10 16:59:19', '2019-04-10 19:16:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_ba_pemeriksaan`
--

CREATE TABLE `a_ba_pemeriksaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `isi_bapem` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_bapem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_ba_pemeriksaan`
--

INSERT INTO `a_ba_pemeriksaan` (`id`, `id_spk`, `isi_bapem`, `file_bapem`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>asdfg</p>', NULL, '', 2, 1, '2019-04-08 22:13:18', '2019-04-08 22:13:18'),
(3, 1, '<p>asdfghj&nbsp; as ada</p>', '5cad661eee4f61554867742.zip', '5cad661eef3851554867742.zip', 2, 1, '2019-04-09 19:42:22', '2019-04-09 19:42:22'),
(4, 1, '<p>sdfghjk</p>', '5cad9658eb0271554880088.zip', '5cad9658ece4f1554880088.zip', 2, 1, '2019-04-09 23:08:08', '2019-04-09 23:08:08'),
(5, 1, '<p>asdas&nbsp;</p>', '5cad967bdc3da1554880123.zip', '5cad967bdd9281554880123.zip', 2, 1, '2019-04-09 23:08:43', '2019-04-09 23:08:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_ba_penyelesaian`
--

CREATE TABLE `a_ba_penyelesaian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `isi_bapeny` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_bapeny` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_ba_penyelesaian`
--

INSERT INTO `a_ba_penyelesaian` (`id`, `id_spk`, `isi_bapeny`, `file_bapeny`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, '<p>asdfgh Kor</p>', '', '', 2, 1, '2019-04-12 20:00:40', '2019-04-12 20:00:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_ba_serops`
--

CREATE TABLE `a_ba_serops` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `isi_serops` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_serops` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_ba_serops`
--

INSERT INTO `a_ba_serops` (`id`, `id_spk`, `isi_serops`, `file_serops`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, '<p>sdfgdf sdv</p>', '5cb3ee95c69341555295893.zip', '5cb3ee95c76fa1555295893.zip', 2, 1, '2019-04-14 18:38:13', '2019-04-14 18:38:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_ba_sertim`
--

CREATE TABLE `a_ba_sertim` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `isi_basertim` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_basertim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_ba_sertim`
--

INSERT INTO `a_ba_sertim` (`id`, `id_spk`, `isi_basertim`, `file_basertim`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Akame Ga Kill</p>', '5cb155ecf198a1555125740.zip', '5cb155ecf2a531555125740.zip', 2, 1, '2019-04-12 19:03:46', '2019-04-12 19:22:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_jenis_arsip`
--

CREATE TABLE `a_jenis_arsip` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_arsip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_jenis_arsip`
--

INSERT INTO `a_jenis_arsip` (`id`, `jenis_arsip`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 'SOP', 2, 1, '2019-04-05 18:34:00', '2019-04-05 18:34:00'),
(3, 'Peraturan Perusahaan', 2, 1, '2019-04-05 18:34:20', '2019-04-05 18:34:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_jenis_proposal`
--

CREATE TABLE `a_jenis_proposal` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_proposal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_jenis_proposal`
--

INSERT INTO `a_jenis_proposal` (`id`, `jenis_proposal`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Proposal penawaran pemeriliharaan', 2, 1, '2019-04-01 22:32:14', '2019-04-03 17:54:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_jenis_rapat`
--

CREATE TABLE `a_jenis_rapat` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_rapat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_jenis_rapat`
--

INSERT INTO `a_jenis_rapat` (`id`, `jenis_rapat`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'Rapat Harian', 2, '2019-04-19 19:12:43', '2019-04-19 19:31:06'),
(3, 'Rapat Mingguan Depan', 2, '2019-04-19 21:08:14', '2019-04-19 21:48:54'),
(5, 'asdfghhj', 2, '2019-04-19 22:00:36', '2019-04-19 22:00:36'),
(6, 'dfhgj', 2, '2019-04-19 22:00:41', '2019-04-19 22:00:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_jenis_surat`
--

CREATE TABLE `a_jenis_surat` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_surat_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_jenis_surat`
--

INSERT INTO `a_jenis_surat` (`id`, `jenis_surat_keluar`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Surat Penawaran', 2, 1, '2019-03-31 19:14:49', '2019-03-31 19:14:49'),
(3, 'Surat Pemberitahuan', 2, 1, '2019-03-31 19:44:11', '2019-03-31 19:44:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_klien`
--

CREATE TABLE `a_klien` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_klien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teleg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twiter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nm_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_klien` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sdk` int(11) DEFAULT 0,
  `id_penanda_sdk` int(11) DEFAULT 0,
  `tambahan_sdk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) UNSIGNED NOT NULL,
  `id_karyawan` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_klien`
--

INSERT INTO `a_klien` (`id`, `nm_klien`, `alamat`, `pekerjaan`, `hp`, `wa`, `email`, `teleg`, `ig`, `fb`, `twiter`, `nm_perusahaan`, `alamat_perusahaan`, `telp_perusahaan`, `jabatan`, `jenis_klien`, `id_sdk`, `id_penanda_sdk`, `tambahan_sdk`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Vandiansyah', 'Jln. Budi Utomo Lrg. Sepakat. Gang.4, No.189,', 'Developer', '082199219950', '082199219950', 'lastfandiansyah@gmail.com', NULL, NULL, NULL, NULL, 'Sumber Info Media', 'alskdja', '234567', 'ds', '0', 0, 0, NULL, 2, 1, '2019-03-28 18:39:12', '2019-03-28 19:15:51'),
(3, 'Ardan', 'Jln. Andonuahu', 'Teknisi', '089293849283', NULL, NULL, NULL, NULL, NULL, NULL, 'Sumber Info Media', 'Jln.', '234567', NULL, '0', 0, 0, NULL, 2, 1, '2019-03-28 18:50:19', '2019-03-28 19:16:22'),
(4, 'Ismail', 'Jln. Ahmad', 'Teknisi', '089293849283', '082199219950', NULL, NULL, NULL, NULL, NULL, 'Sumber Info Media', 'asd', '234567', NULL, '0', 0, 0, NULL, 2, 1, '2019-03-28 18:50:54', '2019-03-28 18:50:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_misi_p`
--

CREATE TABLE `a_misi_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_misi_p`
--

INSERT INTO `a_misi_p` (`id`, `misi`, `id_perusahaan`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, '<ul>\r\n	<li>Membuat aplikasi yang inovatif dan responsif</li>\r\n	<li>Membuat aplikasi yang inovatif dan responsif</li>\r\n</ul>', 2, 13, '2019-03-04 22:47:03', '2019-03-04 22:47:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_model_bisnis`
--

CREATE TABLE `a_model_bisnis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_mb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sasaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_model_bisnis`
--

INSERT INTO `a_model_bisnis` (`id`, `nm_mb`, `sasaran`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'AQUO', '<p>AQUO</p>', 2, 1, '2019-03-21 22:18:02', '2019-03-21 22:30:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_pengumuman`
--

CREATE TABLE `a_pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `isi_p` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_peralatan`
--

CREATE TABLE `a_peralatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_alat` int(11) NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thn_buat` year(4) DEFAULT NULL,
  `tgl_beli` date NOT NULL,
  `kondisi_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_kepemilikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_proposal`
--

CREATE TABLE `a_proposal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenis_prop` int(10) UNSIGNED NOT NULL,
  `judul_prop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_prop` date NOT NULL,
  `ditujukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_prop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_prop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_prop` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_proposal`
--

INSERT INTO `a_proposal` (`id`, `id_jenis_prop`, `judul_prop`, `tgl_prop`, `ditujukan`, `file_prop`, `cover_prop`, `status_prop`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Etiketing', '2019-04-24', 'asdf', '1554431931.rar', '1554427035_coverProposal.jpg', '1', 2, 1, '2019-04-03 18:42:10', '2019-05-04 16:57:00'),
(2, 1, 'Simper', '2019-04-24', 'asdf', NULL, '1557017843_coverProposal.jpg', '1', 2, 1, '2019-04-03 19:29:40', '2019-05-04 16:57:23'),
(3, 1, 'RKA', '2019-04-25', 'asdf', NULL, NULL, '1', 2, 1, '2019-04-03 19:29:52', '2019-04-04 21:58:05'),
(4, 1, 'LRA sdhaskdhakjsdhakjsdhaksdhkas dhkjas dajsd haj dhajsd hakjsdh aksjdh akjsdh akjsdh akjsd hkjads', '2019-04-26', 'asdf', NULL, NULL, '0', 2, 1, '2019-04-03 19:30:04', '2019-04-03 19:50:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_rapat`
--

CREATE TABLE `a_rapat` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ub` int(10) UNSIGNED NOT NULL,
  `tgl_rapat` date NOT NULL,
  `pilihan_rapat` enum('Masukan','Solusi','Kesimpulan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_rapat`
--

INSERT INTO `a_rapat` (`id`, `id_ub`, `tgl_rapat`, `pilihan_rapat`, `keterangan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-04-02', 'Masukan', 'Coba masakan', 2, 1, '2019-04-21 19:51:08', '2019-04-21 19:51:08'),
(7, 1, '2019-04-02', 'Kesimpulan', 'asdas dad', 2, 2, '2019-04-22 17:51:58', '2019-04-22 17:51:58'),
(8, 12, '2019-04-03', 'Masukan', 'sdfs', 2, 1, '2019-04-22 18:49:41', '2019-04-22 18:49:41'),
(9, 14, '2019-05-10', 'Masukan', 'Kalau Bisa Buka puasa bersama anak yatim', 2, 1, '2019-05-30 19:40:19', '2019-05-30 19:40:19'),
(10, 14, '2019-05-10', 'Solusi', 'Baik, Kita akan buka puasa bersama anak yatim dari panti asuhan x', 2, 1, '2019-05-30 19:41:13', '2019-05-30 19:41:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_spk`
--

CREATE TABLE `a_spk` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_spk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_spk` date NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `nm_spk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_kab` int(10) UNSIGNED NOT NULL,
  `file_kotrak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_scan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_spk`
--

INSERT INTO `a_spk` (`id`, `no_spk`, `tgl_spk`, `id_klien`, `nm_spk`, `tgl_mulai`, `tgl_selesai`, `alamat`, `id_prov`, `id_kab`, `file_kotrak`, `file_scan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '10238/kasjhdk/mj/OLSLS', '2019-04-24', 3, 'Jalan Jalan Saja', '2019-04-01', '2019-04-30', 'sdfghj', 1, 2, '5caaeb70066201554705264.zip', '5caaec5693ed31554705494.zip', 2, 1, '2019-04-07 18:52:33', '2019-04-07 22:38:14'),
(2, 'Liasl/0293/923002/2019', '2019-05-20', 3, 'Internet Gratis', '2019-05-15', '2019-05-31', 'asdfg', 1, 1, NULL, NULL, 2, 1, '2019-05-01 17:32:48', '2019-05-01 17:32:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_surat_keluar`
--

CREATE TABLE `a_surat_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_surat` int(10) UNSIGNED NOT NULL,
  `isi_surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_surat` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `scan_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_surat_keluar`
--

INSERT INTO `a_surat_keluar` (`id`, `jenis_surat`, `isi_surat`, `status_surat`, `scan_file`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(4, 3, '<p>asdfgh sdfghjs sdgfhnm</p>', '1', '1554169662_surat_masuk.jpg', 2, 1, '2019-04-01 17:15:20', '2019-04-01 18:21:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_surat_masuk`
--

CREATE TABLE `a_surat_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_surat_masuk` date NOT NULL,
  `hal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ditujukan` int(10) UNSIGNED NOT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_usulan_brifing`
--

CREATE TABLE `a_usulan_brifing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenis_rapat` int(10) UNSIGNED NOT NULL,
  `tgl_usulan_brif` date NOT NULL,
  `materi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_divisi` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_usulan_brifing`
--

INSERT INTO `a_usulan_brifing` (`id`, `id_jenis_rapat`, `tgl_usulan_brif`, `materi`, `id_divisi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-04-02', 'ada', 1, 2, 1, '2019-04-21 17:37:20', '2019-04-21 17:37:20'),
(10, 1, '2019-04-02', 'Coba Masukan data', 1, 2, 1, '2019-04-21 19:43:33', '2019-04-21 19:43:33'),
(11, 1, '2019-04-02', 'asad', 1, 2, 1, '2019-04-22 00:29:45', '2019-04-22 00:29:45'),
(12, 1, '2019-04-03', 'Coba', 1, 2, 1, '2019-04-22 18:49:26', '2019-04-22 18:49:26'),
(13, 1, '2019-04-30', 'Buka puasa bersama', 1, 2, 1, '2019-05-30 19:38:03', '2019-05-30 19:38:03'),
(14, 1, '2019-05-10', 'Buka puasa bersama Lagi lagi', 1, 2, 1, '2019-05-30 19:38:44', '2019-05-30 19:38:44'),
(15, 1, '2019-07-02', 'asda', 3, 2, 1, '2019-07-31 00:24:51', '2019-07-31 00:24:51'),
(16, 1, '2019-07-02', 'dsdd', 3, 2, 1, '2019-07-31 00:24:59', '2019-07-31 00:24:59'),
(17, 1, '2019-07-02', 'dsdd', 3, 2, 1, '2019-07-31 00:24:59', '2019-07-31 00:24:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `a_visi_p`
--

CREATE TABLE `a_visi_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `a_visi_p`
--

INSERT INTO `a_visi_p` (`id`, `visi`, `id_perusahaan`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, '<p>Membangun aplikasi yang nyaman dan fleksibel dalam segala keadaan</p>', 2, 13, '2019-03-04 21:57:30', '2019-03-04 21:58:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_alokasi_gaji`
--

CREATE TABLE `g_alokasi_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn` year(4) NOT NULL,
  `persen` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_alokasi_gaji`
--

INSERT INTO `g_alokasi_gaji` (`id`, `thn`, `persen`, `jumlah`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 15, 100000, 2, 1, '2019-07-05 18:11:48', '2019-07-05 18:22:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_bonus_gaji`
--

CREATE TABLE `g_bonus_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_slip` int(10) UNSIGNED NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama_bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `besaran_bonus` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_bonus_gaji`
--

INSERT INTO `g_bonus_gaji` (`id`, `id_ky`, `id_slip`, `id_proyek`, `id_kelas`, `nama_bonus`, `besaran_bonus`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 'dr_proyek', 1200000, 2, 1, '2019-07-27 05:31:22', '2019-07-27 05:31:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_bonus_proyek`
--

CREATE TABLE `g_bonus_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tim_proyek` int(10) UNSIGNED NOT NULL,
  `nilai_apt` int(11) NOT NULL,
  `id_kelas_proyek` int(10) UNSIGNED NOT NULL,
  `besar_tunjangan` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_bonus_proyek`
--

INSERT INTO `g_bonus_proyek` (`id`, `id_tim_proyek`, `nilai_apt`, `id_kelas_proyek`, `besar_tunjangan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 4, 800000, 1, 1200000, 2, 1, '2019-07-23 18:34:44', '2019-07-23 19:23:04'),
(2, 4, 800000, 2, 1000000, 2, 1, '2019-07-23 18:34:44', '2019-07-23 19:23:04'),
(3, 4, 800000, 3, 800000, 2, 1, '2019-07-23 18:34:44', '2019-07-23 19:23:04'),
(4, 5, 600000, 1, 900000, 2, 1, '2019-07-23 19:24:34', '2019-07-23 19:24:34'),
(5, 5, 600000, 2, 750000, 2, 1, '2019-07-23 19:24:34', '2019-07-23 19:24:34'),
(6, 5, 600000, 3, 600000, 2, 1, '2019-07-23 19:24:34', '2019-07-23 19:24:34'),
(7, 6, 500000, 1, 750000, 2, 1, '2019-07-23 19:24:46', '2019-07-23 19:24:46'),
(8, 6, 500000, 2, 625000, 2, 1, '2019-07-23 19:24:46', '2019-07-23 19:24:46'),
(9, 6, 500000, 3, 500000, 2, 1, '2019-07-23 19:24:46', '2019-07-23 19:24:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_cf`
--

CREATE TABLE `g_cf` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `faktor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_cf`
--

INSERT INTO `g_cf` (`id`, `id_jabatan`, `faktor`, `bobot`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Keterampilan', 0, 2, 1, '2019-07-05 19:23:29', '2019-07-08 18:48:29'),
(4, 1, 'Usaha', 0, 2, 1, '2019-07-08 18:49:02', '2019-07-10 18:11:50'),
(5, 1, 'Tanggung Jawab', 0, 2, 1, '2019-07-08 18:49:17', '2019-07-08 18:49:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_content_cf`
--

CREATE TABLE `g_content_cf` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pokok` int(10) UNSIGNED NOT NULL,
  `kolom_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_cf` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot_content_cf` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_content_cf`
--

INSERT INTO `g_content_cf` (`id`, `id_pokok`, `kolom_content`, `content_cf`, `bobot_content_cf`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Persayaratan Pendidikan', 'Pekerjaan memerlukan keterampilan yang tidak terlalu kompleks', '13,27,40,53,67', 2, 1, '2019-07-08 23:10:55', '2019-07-08 23:10:55'),
(2, 1, 'Persayaratan Pendidikan', 'Pekerjaan memerlukan keterampilan yang secara normal dapat diperokeh melaui pendidikan sekol', '27,40,53,67,80', 2, 1, '2019-07-09 00:00:40', '2019-07-09 00:00:40'),
(3, 1, 'Persayaratan Pendidikan', 'Pekerjaan memerlukan pengetahuan mengenai konsep dan dasar dasar bidang teknikal dengan spesialisasi tertentu, yang secara normal bisa diperolleh dari pendidikan akademi, sekolah tinggi , kursus kejuaran atau training keterampilan dasar\r\n\r\nPHP, Jquery, Mysql', '40,53,67,80,93', 2, 1, '2019-07-09 16:49:12', '2019-07-09 16:49:12'),
(4, 1, 'Persayaratan Pendidikan', 'Memerlukan tingkat profesionalisme dan pengetahuan yang mendalam untuk suatu bidang khusus tertentu, pekerjaan melibatkan penerapan yang intensid fari berbagai metode memalui pendidikan tingkat sarjana/SU, dan melalui training bersertifikat tingkat lanjut', '53,67,80,93,107', 2, 1, '2019-07-09 19:03:50', '2019-07-09 19:03:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_daftar_gaji`
--

CREATE TABLE `g_daftar_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `priode` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `besar_gaji` int(11) NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_daftar_gaji`
--

INSERT INTO `g_daftar_gaji` (`id`, `priode`, `id_ky`, `besar_gaji`, `ket`, `status_aktif`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2018, 1, 1500000, 'Gaji Awal', '0', 2, 1, '2019-07-17 00:40:55', '2019-07-17 19:00:25'),
(3, 2019, 1, 1500000, 'Dikenakan potongan  1%, dikarenakan kinerja kurang baik', '1', 2, 1, '2019-07-17 18:17:16', '2019-07-17 19:00:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_grade`
--

CREATE TABLE `g_grade` (
  `id` int(10) UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_min` int(11) DEFAULT NULL,
  `poin_max` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_grade`
--

INSERT INTO `g_grade` (`id`, `grade`, `poin_min`, `poin_max`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '1. Grader Senior', 770, 900, 2, 1, '2019-07-14 19:46:31', '2019-07-15 17:27:10'),
(7, '2. Manager Senior', 640, 770, 2, 1, '2019-07-14 21:42:36', '2019-07-15 17:27:44'),
(8, '3. Manager', 590, 640, 2, 1, '2019-07-14 21:42:45', '2019-07-15 17:28:54'),
(9, '4. Supervisor Senior', 450, 580, 2, 1, '2019-07-14 21:43:03', '2019-07-15 17:29:20'),
(10, '5. Supervisor', 370, 450, 2, 1, '2019-07-14 21:43:10', '2019-07-15 17:29:48'),
(11, '6.Staf', 191, 370, 2, 1, '2019-07-14 21:43:19', '2019-07-15 17:30:29'),
(12, '7. Staf Junior', 0, 191, 2, 1, '2019-07-14 21:43:31', '2019-07-15 17:31:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_item_ccf`
--

CREATE TABLE `g_item_ccf` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pccf` int(10) UNSIGNED NOT NULL,
  `item_ccf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_item_ccf`
--

INSERT INTO `g_item_ccf` (`id`, `id_pccf`, `item_ccf`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '0-2 tahun', 2, 1, '2019-07-08 17:13:18', '2019-07-08 22:13:43'),
(3, 1, '3-5 tahun', 2, 1, '2019-07-08 22:13:53', '2019-07-08 22:13:53'),
(4, 1, '6-10 tahun', 2, 1, '2019-07-08 22:14:02', '2019-07-08 22:14:02'),
(5, 1, '11-15 tahun', 2, 1, '2019-07-08 22:14:09', '2019-07-08 22:14:09'),
(6, 1, 'lebih dari 16 tahun', 2, 1, '2019-07-08 22:14:20', '2019-07-08 22:14:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_item_tunjangan`
--

CREATE TABLE `g_item_tunjangan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_tunjangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_item_tunjangan`
--

INSERT INTO `g_item_tunjangan` (`id`, `nm_tunjangan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Tunjangan Istri', 2, 1, '2019-07-21 19:56:11', '2019-07-21 19:56:11'),
(2, 'Tunjangan Anak', 2, 1, '2019-07-21 21:27:23', '2019-07-21 21:27:23'),
(4, 'Tunjangan Kesehatan', 2, 1, '2019-07-21 21:36:30', '2019-07-21 21:36:30'),
(5, 'Uang Makan', 2, 1, '2019-07-24 19:13:37', '2019-07-24 19:13:37'),
(6, 'Uang Transport', 2, 1, '2019-07-24 19:13:44', '2019-07-24 19:13:44'),
(7, 'Uang Kehadiran', 2, 1, '2019-07-24 19:13:50', '2019-07-24 19:13:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_kelas_proyek`
--

CREATE TABLE `g_kelas_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persen_besar_proyek` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_kelas_proyek`
--

INSERT INTO `g_kelas_proyek` (`id`, `nm_kelas`, `keterangan`, `persen_besar_proyek`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Kelas A', 'Bla Bla Bal', 150, 2, 1, '2019-07-22 22:36:34', '2019-07-23 19:21:41'),
(2, 'Kelas B', 'Bla Bla Blas', 125, 2, 1, '2019-07-22 22:46:00', '2019-07-23 19:22:09'),
(3, 'Kelas C', 'Bla Bla Bla', 100, 2, 1, '2019-07-22 22:46:23', '2019-07-23 19:22:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_klasifikasi_gaji`
--

CREATE TABLE `g_klasifikasi_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `klasifikas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_klasifikasi_gaji`
--

INSERT INTO `g_klasifikasi_gaji` (`id`, `klasifikas`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'A(0-3 Y)', 2, 1, '2019-07-14 17:47:59', '2019-07-14 18:08:24'),
(2, 'B(4-6 Y)', 2, 1, '2019-07-14 17:48:39', '2019-07-14 17:48:39'),
(3, 'C(7-9 Y)', 2, 1, '2019-07-14 17:49:08', '2019-07-14 17:49:08'),
(5, 'D(>9Y)', 2, 1, '2019-07-14 18:11:04', '2019-07-14 18:11:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_lembur`
--

CREATE TABLE `g_lembur` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_slip` int(10) UNSIGNED NOT NULL,
  `jum_lembur` int(11) NOT NULL,
  `jum_besaran_lembur` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_lembur`
--

INSERT INTO `g_lembur` (`id`, `id_ky`, `id_slip`, `jum_lembur`, `jum_besaran_lembur`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 15, 150000, 2, 1, '2019-07-25 18:40:38', '2019-07-25 18:40:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_pokok_cff`
--

CREATE TABLE `g_pokok_cff` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_pokok_ccf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_sub_cf` int(11) DEFAULT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_pokok_cff`
--

INSERT INTO `g_pokok_cff` (`id`, `nm_pokok_ccf`, `id_perusahaan`, `id_sub_cf`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Persyaratan Pengalaman Kerja', 2, 1, 1, '2019-07-07 23:17:32', '2019-07-08 19:15:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_potongan_tambahan`
--

CREATE TABLE `g_potongan_tambahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_slip` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_potongan` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_potongan_tambahan`
--

INSERT INTO `g_potongan_tambahan` (`id`, `id_ky`, `id_slip`, `keterangan`, `jumlah_potongan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Biaya Makan', 20000, 2, 1, '2019-07-25 22:30:12', '2019-07-25 22:30:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_skala_gaji`
--

CREATE TABLE `g_skala_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `id_klasifikasi` int(10) UNSIGNED NOT NULL,
  `besaran_gaji` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_skala_gaji`
--

INSERT INTO `g_skala_gaji` (`id`, `id_jabatan`, `id_klasifikasi`, `besaran_gaji`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12000000, 2, 1, '2019-07-15 18:56:52', '2019-07-15 18:56:52'),
(2, 1, 2, 14500000, 2, 1, '2019-07-15 18:56:52', '2019-07-15 19:23:07'),
(3, 1, 3, 17000000, 2, 1, '2019-07-15 18:56:52', '2019-07-15 18:56:52'),
(4, 1, 5, 20000000, 2, 1, '2019-07-15 18:56:52', '2019-07-15 18:56:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_skala_tunjangan`
--

CREATE TABLE `g_skala_tunjangan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `id_item_tunjangan` int(10) UNSIGNED NOT NULL,
  `status_tunjangan` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `besar_tunjangan` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_skala_tunjangan`
--

INSERT INTO `g_skala_tunjangan` (`id`, `id_jabatan`, `id_item_tunjangan`, `status_tunjangan`, `besar_tunjangan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 12000000, 2, 1, '2019-07-21 22:10:45', '2019-07-24 19:12:08'),
(2, 1, 2, '1', 1000000, 2, 1, '2019-07-21 22:16:19', '2019-07-24 19:12:12'),
(3, 1, 4, '1', 1850000, 2, 1, '2019-07-21 22:16:29', '2019-07-24 21:45:37'),
(4, 1, 5, '0', 15000, 2, 1, '2019-07-24 19:14:08', '2019-07-24 19:14:08'),
(5, 1, 6, '0', 200000, 2, 1, '2019-07-24 19:14:18', '2019-07-24 19:14:18'),
(6, 1, 7, '0', 200000, 2, 1, '2019-07-24 19:14:27', '2019-07-24 19:14:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_skor_posisi_cf`
--

CREATE TABLE `g_skor_posisi_cf` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sub_cf` int(10) UNSIGNED NOT NULL,
  `skor_sub_cf` int(11) DEFAULT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_skor_posisi_cf`
--

INSERT INTO `g_skor_posisi_cf` (`id`, `id_sub_cf`, `skor_sub_cf`, `id_jabatan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(5, 7, 64, 2, 2, 1, '2019-07-10 22:49:21', '2019-07-11 18:39:14'),
(6, 3, 113, 1, 2, 1, '2019-07-10 22:49:21', '2019-07-10 22:49:21'),
(7, 4, 69, 1, 2, 1, '2019-07-10 22:49:21', '2019-07-10 22:49:21'),
(8, 6, 16, 2, 2, 1, '2019-07-11 18:18:29', '2019-07-11 18:18:29'),
(10, 5, 120, 2, 2, 1, '2019-07-11 18:20:03', '2019-07-11 18:20:20'),
(11, 1, 120, 1, 2, 1, '2019-07-11 18:21:59', '2019-07-11 18:21:59'),
(12, 1, 120, 2, 2, 1, '2019-07-11 19:02:39', '2019-07-11 19:02:39'),
(13, 5, 120, 1, 2, 1, '2019-07-11 19:03:20', '2019-07-11 19:03:20'),
(14, 6, 32, 1, 2, 1, '2019-07-11 19:03:20', '2019-07-11 19:03:20'),
(15, 7, 80, 1, 2, 1, '2019-07-11 19:03:20', '2019-07-11 21:47:18'),
(16, 10, 100, 1, 2, 1, '2019-07-11 19:05:20', '2019-07-11 21:47:18'),
(17, 8, 150, 1, 2, 1, '2019-07-11 19:09:07', '2019-07-11 21:47:18'),
(18, 9, 100, 1, 2, 1, '2019-07-11 19:09:07', '2019-07-11 21:47:18'),
(19, 3, 133, 2, 2, 1, '2019-07-14 16:50:44', '2019-07-14 16:50:44'),
(20, 4, 69, 2, 2, 1, '2019-07-14 16:50:44', '2019-07-14 16:50:44'),
(21, 8, 150, 2, 2, 1, '2019-07-14 16:50:44', '2019-07-14 16:50:44'),
(22, 9, 100, 2, 2, 1, '2019-07-14 16:50:45', '2019-07-14 16:50:45'),
(23, 10, 87, 2, 2, 1, '2019-07-14 16:50:45', '2019-07-14 16:50:45'),
(24, 1, 107, 3, 2, 1, '2019-07-14 16:51:24', '2019-07-14 16:51:24'),
(25, 3, 113, 3, 2, 1, '2019-07-14 16:51:24', '2019-07-14 16:51:24'),
(26, 4, 57, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(27, 5, 100, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(28, 6, 48, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(29, 7, 64, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(30, 8, 125, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(31, 9, 100, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25'),
(32, 10, 50, 3, 2, 1, '2019-07-14 16:51:25', '2019-07-14 16:51:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_slip_gaji`
--

CREATE TABLE `g_slip_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `periode` date NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_slip_gaji`
--

INSERT INTO `g_slip_gaji` (`id`, `id_ky`, `periode`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, '2019-07-01', 2, 1, '2019-07-25 17:32:48', '2019-07-25 17:32:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_sub_cf`
--

CREATE TABLE `g_sub_cf` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cf` int(10) UNSIGNED NOT NULL,
  `sub_faktor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `definisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot_subcf` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_sub_cf`
--

INSERT INTO `g_sub_cf` (`id`, `id_cf`, `sub_faktor`, `definisi`, `bobot_subcf`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teknis', 'Sub Faktor ini berhububgan dengan tingakan pendidikan dan keterampilan yang diperlukan untuk melaksanakan suatu pekerjaan secara memuaska', 12, 2, 1, '2019-07-07 18:51:22', '2019-07-08 18:50:48'),
(3, 1, 'Majerial', 'Sub Faktor ini berhububgan dengan tingakan pendidikan dan keterampilan yang diperlukan untuk melaksanakan suatu pekerjaan secara memuaska', 15, 2, 1, '2019-07-07 19:12:53', '2019-07-09 17:08:49'),
(4, 1, 'Interpersonal', 'Sub Faktor ini berhububgan dengan tingakan pendidikan dan keterampilan yang diperlukan untuk melaksanakan suatu pekerjaan secara memuaska', 8, 2, 1, '2019-07-08 18:51:40', '2019-07-08 18:51:40'),
(5, 4, 'Pikiran', 'Bla Bla Bla', 14, 2, 1, '2019-07-10 18:59:08', '2019-07-10 18:59:08'),
(6, 4, 'Fisik', 'Bla Bla Bla', 8, 2, 1, '2019-07-10 18:59:31', '2019-07-10 18:59:31'),
(7, 4, 'Tekanan Waktu', 'Bla Bla Bla', 8, 2, 1, '2019-07-10 18:59:51', '2019-07-10 18:59:51'),
(8, 5, 'Hasil Kerja', 'Bla Bla Bla', 15, 2, 1, '2019-07-10 19:00:56', '2019-07-10 19:00:56'),
(9, 5, 'Aset', 'Bla Bla Bla', 10, 2, 1, '2019-07-10 19:01:10', '2019-07-10 19:01:10'),
(10, 5, 'Bawahan', 'Bla Bla Bla', 10, 2, 1, '2019-07-10 19:01:34', '2019-07-10 19:01:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_tambahan_gaji`
--

CREATE TABLE `g_tambahan_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_slip` int(10) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_uang` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_tambahan_gaji`
--

INSERT INTO `g_tambahan_gaji` (`id`, `id_ky`, `id_slip`, `keterangan`, `jumlah_uang`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Uang Lelah', 500000, 2, 1, '2019-07-25 19:28:51', '2019-07-25 19:28:51'),
(3, 1, 2, 'Intensif', 200000, 2, 1, '2019-07-25 19:29:04', '2019-07-25 19:29:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_tunjangan_gaji`
--

CREATE TABLE `g_tunjangan_gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_skala_tunjangan` int(11) DEFAULT NULL,
  `status_aktif` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `g_tunjangan_gaji`
--

INSERT INTO `g_tunjangan_gaji` (`id`, `periode`, `id_ky`, `id_skala_tunjangan`, `status_aktif`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(8, 2019, 1, 1, '1', 2, 1, '2019-07-22 21:43:57', '2019-07-24 18:55:11'),
(9, 2019, 1, 2, '1', 2, 1, '2019-07-22 21:43:57', '2019-07-24 18:55:14'),
(10, 2019, 1, 3, '1', 2, 1, '2019-07-22 21:43:57', '2019-07-24 19:52:02'),
(11, 2019, 1, 4, '1', 2, 1, '2019-07-24 19:15:56', '2019-07-24 19:52:13'),
(12, 2019, 1, 5, '1', 2, 1, '2019-07-24 19:15:56', '2019-07-24 19:52:17'),
(13, 2019, 1, 6, '1', 2, 1, '2019-07-24 19:15:56', '2019-07-24 19:52:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_absensi`
--

CREATE TABLE `h_absensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(11) DEFAULT NULL,
  `periode` date NOT NULL,
  `normal_hari` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `terlambat_masuk` int(11) DEFAULT NULL,
  `tidak_absen_m` int(11) NOT NULL,
  `tidak_absen_p` int(11) NOT NULL,
  `jum_izin` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_absensi`
--

INSERT INTO `h_absensi` (`id`, `id_ky`, `periode`, `normal_hari`, `hadir`, `terlambat_masuk`, `tidak_absen_m`, `tidak_absen_p`, `jum_izin`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-01', 22, 2, 20, 3, 2, 3, 2, 1, '2019-07-17 22:55:37', '2019-07-28 18:37:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_aku`
--

CREATE TABLE `h_aku` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `nm_aku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_aku`
--

INSERT INTO `h_aku` (`id`, `id_jabatan`, `nm_aku`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Rekrutmen', 2, 1, '2019-06-24 18:14:18', '2019-07-16 18:30:12'),
(2, 2, 'Server', 2, 1, '2019-07-16 19:03:06', '2019-07-16 19:03:06'),
(3, 2, 'HR Cost', 2, 1, '2019-07-16 19:20:30', '2019-07-16 19:20:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_alamat_asal`
--

CREATE TABLE `h_alamat_asal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(11) UNSIGNED NOT NULL,
  `alamat_asal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_kab` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_alamat_asal`
--

INSERT INTO `h_alamat_asal` (`id`, `id_ky`, `alamat_asal`, `id_prov`, `id_kab`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jln. Ahad Yani Lrg. Ilmiah Gang:IV no.198', 1, 2, 2, 1, '2019-03-25 19:55:25', '2019-03-25 19:55:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_alamat_sek`
--

CREATE TABLE `h_alamat_sek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(11) UNSIGNED NOT NULL,
  `alamat_sek` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_kab` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_alamat_sek`
--

INSERT INTO `h_alamat_sek` (`id`, `id_ky`, `alamat_sek`, `id_prov`, `id_kab`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jln. Budi Utomo, Lrg. Ilmiah', 1, 1, 2, 1, '2019-03-25 22:24:57', '2019-03-25 22:24:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_aspek_pa`
--

CREATE TABLE `h_aspek_pa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_aspek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_aspek_pa`
--

INSERT INTO `h_aspek_pa` (`id`, `nm_aspek`, `bobot`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Aspek Kebanggaan', 60, 2, 1, '2019-06-19 19:08:21', '2019-06-19 19:33:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_cuti`
--

CREATE TABLE `h_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `periode` year(4) NOT NULL,
  `id_setting_cuti` int(10) UNSIGNED NOT NULL,
  `max_suci` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_cuti`
--

INSERT INTO `h_cuti` (`id`, `id_ky`, `periode`, `id_setting_cuti`, `max_suci`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 2019, 1, 11, 2, 1, '2019-06-12 22:18:17', '2019-06-12 22:36:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_email_k`
--

CREATE TABLE `h_email_k` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `nm_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_email_k`
--

INSERT INTO `h_email_k` (`id`, `id_ky`, `nm_email`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Google@gmail.com', 2, 1, '2019-03-27 17:41:58', '2019-03-27 17:41:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_hasil_tes`
--

CREATE TABLE `h_hasil_tes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lamaran_p` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_hasil_tes`
--

INSERT INTO `h_hasil_tes` (`id`, `id_lamaran_p`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 3, '<p>- Sudah pernah mengerjakan&nbsp;</p>', 2, 1, '2019-05-26 19:22:46', '2019-05-26 19:22:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_hp_create`
--

CREATE TABLE `h_hp_create` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_hp_create`
--

INSERT INTO `h_hp_create` (`id`, `id_ky`, `hp`, `status_hp`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '082199219950', 'Wa, Telgram,', 2, 1, '2019-03-27 18:43:39', '2019-03-27 18:43:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_item_keahlian`
--

CREATE TABLE `h_item_keahlian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan_p` int(10) UNSIGNED NOT NULL,
  `item_tes_keahlian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_item_keahlian`
--

INSERT INTO `h_item_keahlian` (`id`, `id_jabatan_p`, `item_tes_keahlian`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 2, 'HyperText Markup Language (HTML)', 2, 13, NULL, NULL),
(3, 3, 'PHP ', 2, 13, NULL, NULL),
(4, 3, 'Konten', 2, 1, '2019-05-20 17:50:13', '2019-05-20 17:50:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_item_kmanaherial`
--

CREATE TABLE `h_item_kmanaherial` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_m` int(10) UNSIGNED NOT NULL,
  `item_kompetensi_m` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_item_kmanaherial`
--

INSERT INTO `h_item_kmanaherial` (`id`, `id_kompetensi_m`, `item_kompetensi_m`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Losda', 2, 1, '2019-07-01 18:46:29', '2019-07-01 18:48:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_item_teknis`
--

CREATE TABLE `h_item_teknis` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_teknis` int(10) UNSIGNED NOT NULL,
  `item_kompetensi_t` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_item_teknis`
--

INSERT INTO `h_item_teknis` (`id`, `id_kompetensi_teknis`, `item_kompetensi_t`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Glass', 2, 1, '2019-07-04 18:16:36', '2019-07-04 18:29:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_item_wawancara`
--

CREATE TABLE `h_item_wawancara` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_wawancara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_item_wawancara`
--

INSERT INTO `h_item_wawancara` (`id`, `item_wawancara`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Coba ubah', 2, 1, '2019-05-19 21:40:07', '2019-05-19 21:47:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jabatan_ky`
--

CREATE TABLE `h_jabatan_ky` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_jabatan_p` int(10) UNSIGNED NOT NULL,
  `mulai_menjabat` date NOT NULL,
  `selesai_menjabat` date NOT NULL,
  `status_jabatan` enum('aktif','non aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_jabatan_ky`
--

INSERT INTO `h_jabatan_ky` (`id`, `id_ky`, `id_jabatan_p`, `mulai_menjabat`, `selesai_menjabat`, `status_jabatan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-07-01', '2019-07-31', '', 2, 1, '2019-07-22 18:47:42', '2019-07-22 18:50:51'),
(3, 2, 2, '2019-07-01', '2019-07-31', '', 2, 1, '2019-07-22 18:51:17', '2019-07-22 18:51:17'),
(4, 3, 3, '2019-07-01', '2019-07-31', '', 2, 1, '2019-07-22 18:51:30', '2019-07-22 18:51:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jenis_kompetensi`
--

CREATE TABLE `h_jenis_kompetensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_kompetensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_jenis_kompetensi`
--

INSERT INTO `h_jenis_kompetensi` (`id`, `nm_kompetensi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'dsfghj', 2, 1, '2019-06-30 19:52:08', '2019-06-30 19:52:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jenis_kontrak`
--

CREATE TABLE `h_jenis_kontrak` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_jenis_kontrak`
--

INSERT INTO `h_jenis_kontrak` (`id`, `jenis_kontrak`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Bulanan 6', 2, 1, '2019-05-28 17:57:45', '2019-05-28 18:29:33'),
(2, 'Bulanan 12', 2, 1, '2019-05-28 18:29:47', '2019-05-28 18:29:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jenis_kpi`
--

CREATE TABLE `h_jenis_kpi` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_kpi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_jenis_kpi`
--

INSERT INTO `h_jenis_kpi` (`id`, `jenis_kpi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Min', 2, 1, '2019-06-24 18:14:36', '2019-07-16 18:02:14'),
(2, 'Max', 2, 1, '2019-07-16 18:02:20', '2019-07-16 18:02:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_jenis_psikotes`
--

CREATE TABLE `h_jenis_psikotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_psikotes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_jenis_psikotes`
--

INSERT INTO `h_jenis_psikotes` (`id`, `jenis_psikotes`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 'Gambar', 2, 1, '2019-05-19 19:47:58', '2019-05-19 19:47:58'),
(3, 'Angka', 2, 1, '2019-05-19 19:48:04', '2019-05-19 19:48:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kalender_kerja`
--

CREATE TABLE `h_kalender_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `event` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kalender_kerja`
--

INSERT INTO `h_kalender_kerja` (`id`, `event`, `tgl_mulai`, `tgl_akhir`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Cuti Lebaran', '2019-05-01', '2019-06-28', 2, 1, '2019-06-11 21:42:18', '2019-06-11 22:26:21'),
(2, 'Musiara dirumahku', '2019-06-29', '2019-06-29', 2, 1, '2019-06-11 21:57:37', '2019-06-11 22:26:30'),
(3, 'Tidak Ada', '2019-06-30', '2019-06-30', 2, 1, '2019-06-11 21:57:53', '2019-06-11 22:26:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_karyawan`
--

CREATE TABLE `h_karyawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ky` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kel` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kerja` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cu_vitae` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nm_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gol_darah` enum('-','A','B','O','AB') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `pend_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_user_ukm` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_karyawan`
--

INSERT INTO `h_karyawan` (`id`, `nik`, `nama_ky`, `password`, `tmp_lahir`, `tgl_lahir`, `jenis_kel`, `agama`, `status_kerja`, `no_ktp`, `file_ktp`, `pas_foto`, `cu_vitae`, `nm_bank`, `no_rek`, `gol_darah`, `pend_akhir`, `program_studi`, `pt`, `id_perusahaan`, `tgl_masuk`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, '7788990099', 'Ismail', '$2y$10$Oo4pxPxquzXlX/o3Tbfg/uVhfCFDY7V5n.OPENQPIxacuxSDUAlsO', 'kendari', '2019-03-28', '1', 'Islam', '0', '123344334567899', '1552355553-ktp.png', '1552355553_Pfoto.png', '1552355553-cv.png', 'asd', '233', 'AB', 'S1', 'Teknik Informatika', 'Universitas Halu Oleo', 2, '2019-03-28', 13, '2019-03-10 22:30:50', '2019-03-25 18:31:22'),
(2, '0238402', 'Aqua', '$2y$10$PSx/b6YTyJ9u4GmOsb/6/uX4mzHVHH/kncK.MJUMHV9uqhPAUMTF6', 'kasd', '2019-03-27', '1', 'Islam', '0', '82937492837', '1553312160-ktp.png', '1553312160_Pfoto.png', '1553312160-cv.png', 'kjashd', '928374', 'B', NULL, NULL, NULL, 2, '2019-03-27', 13, '2019-03-22 19:36:00', '2019-03-22 19:36:00'),
(3, '02938429', 'Kyt', '$2y$10$P1C3ngh2K6RkCUM8I3q.hu9Y8v0IZ1GmJFPa8ATtnB7oVu2K5kE22', 'kasd', '2019-03-28', '1', 'Islam', '0', '238472342234', '1553312232-ktp.png', '1553312232_Pfoto.png', '1553312232-cv.png', 'kjashd', '928374', 'AB', NULL, NULL, NULL, 2, '2019-03-28', 13, '2019-03-22 19:37:12', '2019-03-22 19:37:12'),
(4, '32342342', 'Kyt', '$2y$10$NLuoXlJJ2nMKfI.2PEG3d.cKOXV2Cdmz1K4qicnSI0FTeeemzetnC', 'kendari', '2019-04-30', '1', 'Islam', '0', '2345678904', '1557803710-ktp.jpeg', '1557803710-Pfoto.jpg', '1557803710-cv.jpg', 'ddf', 'fg', 'A', NULL, NULL, NULL, 2, '2019-04-30', 13, '2019-04-10 18:36:23', '2019-05-13 19:15:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_karyawan_pelatihan`
--

CREATE TABLE `h_karyawan_pelatihan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_rencana_pel` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_karyawan_pelatihan`
--

INSERT INTO `h_karyawan_pelatihan` (`id`, `id_ky`, `id_rencana_pel`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, '2019-06-18 18:25:09', '2019-06-18 18:25:09'),
(3, 2, 1, 2, 1, '2019-06-18 18:32:48', '2019-06-18 18:32:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_keluarga_ky`
--

CREATE TABLE `h_keluarga_ky` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `nm_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_a` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `nm_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_i` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `jum_saudara` int(11) NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `cp_darurat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_darurat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_keluarga_ky`
--

INSERT INTO `h_keluarga_ky` (`id`, `id_ky`, `nm_ayah`, `status_a`, `nm_ibu`, `status_i`, `jum_saudara`, `anak_ke`, `cp_darurat`, `telp_darurat`, `file_kk`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ahmad Dahlan', '0', 'Ziraya', '0', 4, 2, '0812121212', '0812121212', '1553667568_SKK.png', 2, 1, '2019-03-26 16:00:00', '2019-03-26 22:19:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kompensasi_kinerja`
--

CREATE TABLE `h_kompensasi_kinerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `nilai_total_kinerja` int(11) NOT NULL,
  `kenaikan_gaji` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kompensasi_kinerja`
--

INSERT INTO `h_kompensasi_kinerja` (`id`, `nilai_total_kinerja`, `kenaikan_gaji`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 10, 20, 2, 1, '2019-07-02 19:55:25', '2019-07-02 21:50:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kompetensi_majerial`
--

CREATE TABLE `h_kompetensi_majerial` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_m` int(10) UNSIGNED NOT NULL,
  `nm_kompetensi_m` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kompetensi_majerial`
--

INSERT INTO `h_kompetensi_majerial` (`id`, `id_kompetensi_m`, `nm_kompetensi_m`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Majerial 2', 2, 1, '2019-06-30 22:16:23', '2019-06-30 22:24:50'),
(2, 1, 'Hujan', 2, 1, '2019-07-01 18:35:42', '2019-07-01 18:35:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kompetensi_teknis`
--

CREATE TABLE `h_kompetensi_teknis` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenis_kompetensi` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `nm_kompetensi_t` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kompetensi_teknis`
--

INSERT INTO `h_kompetensi_teknis` (`id`, `id_jenis_kompetensi`, `id_jabatan`, `nm_kompetensi_t`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Kolsas', 2, 1, '2019-07-01 19:51:18', '2019-07-01 21:55:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kontrak_kerja`
--

CREATE TABLE `h_kontrak_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_jenis_kontrak` int(10) UNSIGNED NOT NULL,
  `no_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kontrak_kerja`
--

INSERT INTO `h_kontrak_kerja` (`id`, `id_ky`, `id_jenis_kontrak`, `no_kontrak`, `tgl_mulai`, `tgl_selesai`, `ket`, `file_kontrak`, `scan_kontrak`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '128/SA/SSD/2019', '2019-05-28', '2019-06-27', '<p>dad</p>', '1560133979-kontrakKerja-.zip', '1560134218-kontrakKerja-.zip', 2, 1, '2019-06-09 17:17:25', '2019-06-09 18:36:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kpi`
--

CREATE TABLE `h_kpi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_aku` int(10) UNSIGNED NOT NULL,
  `nm_kpi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot_kpi` int(11) NOT NULL,
  `targat_kpi` int(255) NOT NULL,
  `id_satuan_kpi` int(10) UNSIGNED NOT NULL,
  `id_jenis_kpi` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kpi`
--

INSERT INTO `h_kpi` (`id`, `id_aku`, `nm_kpi`, `bobot_kpi`, `targat_kpi`, `id_satuan_kpi`, `id_jenis_kpi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, '% Jumlah Kebutuhan pegawai baru yang dapat dipenuhi tepat waktu', 15, 100, 1, 1, 2, 1, '2019-06-24 19:05:41', '2019-07-16 18:31:03'),
(3, 1, 'Rata-rata skor evaluasi karyawan baru setelah 3 bulan massa percobaan', 15, 80, 2, 2, 2, 1, '2019-06-24 19:30:56', '2019-07-16 18:32:08'),
(4, 2, 'Server Down Perhari', 10, 2, 3, 1, 2, 1, '2019-07-16 19:08:10', '2019-07-16 19:08:10'),
(5, 3, 'Rasio HR COST terhadap total cost', 10, 6, 1, 1, 2, 1, '2019-07-16 19:21:12', '2019-07-16 19:21:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_kpi_karyawan`
--

CREATE TABLE `h_kpi_karyawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_aku` int(10) UNSIGNED NOT NULL,
  `id_kpi` int(10) UNSIGNED NOT NULL,
  `realisasi_kpi` int(11) NOT NULL,
  `skor_kpi` int(11) NOT NULL,
  `skor_akhir` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_kpi_karyawan`
--

INSERT INTO `h_kpi_karyawan` (`id`, `year`, `id_ky`, `id_aku`, `id_kpi`, `realisasi_kpi`, `skor_kpi`, `skor_akhir`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 1, 1, 1, 90, 90, 14, 2, 1, '2019-07-16 18:25:01', '2019-07-16 18:25:01'),
(2, 2019, 1, 1, 3, 82, 102, 15, 2, 1, '2019-07-16 18:33:06', '2019-07-16 18:33:06'),
(4, 2019, 1, 2, 4, 1, 200, 20, 2, 1, '2019-07-16 19:16:35', '2019-07-16 19:16:35'),
(5, 2019, 2, 3, 5, 6, 100, 10, 2, 1, '2019-07-16 19:21:35', '2019-07-16 19:21:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_lamaran_pek`
--

CREATE TABLE `h_lamaran_pek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_loker` int(11) UNSIGNED NOT NULL,
  `nm_pel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_lamaran` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_masuk` date NOT NULL,
  `berkas_lamaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) UNSIGNED NOT NULL,
  `id_karyawan` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_lamaran_pek`
--

INSERT INTO `h_lamaran_pek` (`id`, `id_loker`, `nm_pel`, `posisi`, `jenis_lamaran`, `tgl_masuk`, `berkas_lamaran`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, 1, 'Printer', 'Teknisi', '1', '2019-05-29', '5cdcc2bbca8f61557971643.zip', 2, 1, '2019-05-15 17:54:03', '2019-05-15 17:54:03'),
(4, 1, 'Mouse', 'Teknisi', '1', '2019-05-30', '5cdccb005aaa21557973760.zip', 2, 1, '2019-05-15 18:29:20', '2019-05-15 18:29:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_log_diary`
--

CREATE TABLE `h_log_diary` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_log_diary` date NOT NULL,
  `key_moment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_log_diary`
--

INSERT INTO `h_log_diary` (`id`, `tgl_log_diary`, `key_moment`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '2019-07-12', 'asdasss', 2, 1, '2019-07-02 23:02:32', '2019-07-02 23:15:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_loker`
--

CREATE TABLE `h_loker` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_loker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jumlah_pelamar` int(11) NOT NULL,
  `file_loker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_loker`
--

INSERT INTO `h_loker` (`id`, `nm_loker`, `detail`, `tgl_buka`, `tgl_selesai`, `jumlah_pelamar`, `file_loker`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Penjaga Lautan', '<p>Vertically centering objects should be one of the easiest parts of your design experience. More often than not, however, you spend hours trying to align images or text boxes to fit with others on a page. It&rsquo;s enough to drive even the best web designers mad.</p><p>Previously, you had to acquaint yourself with Flexbox and create a number of custom classes to accomplish the simple task of centering elements vertically.</p><p>Luckily, there&rsquo;s a cure. The latest release of&nbsp;<a target=\"_blank\" href=\"https://v4-alpha.getbootstrap.com/\">Bootstrap</a>&nbsp;come with default classes to make vertically centering your content considerably easier.</p><p>It&rsquo;s minimal code with maximum smiles. In fact, we used it throughout our new Solodev website, and our developers were considerably happier about website elements aligning how they wanted. (Happy days abounded in the office, for sure.)</p><p>Here&rsquo;s the HTML requiredto vertically align your own website and center your good web design vibes:</p><p>For a basic example, you may want to have a section with an image displayed and one column and some text displayed in another column. By default, both elements will align to the top edge of the section which can appear odd. Ideally, you would want the text to be vertically aligned inline with the center of the image. This standard section that has vertically aligned text can be created with the markup below:</p>', '2019-05-02', '2019-05-23', 2, '1557884747_fileLoker.jpg', 2, 1, '2019-05-14 16:36:44', '2019-05-14 18:45:20'),
(2, 'Backend Programmer', '<p>Pernahkah kamu mendengar atau melihat perusahaan yang membuka lowongan kerja untuk&nbsp;<em>front-end developer</em>,&nbsp;<em>back-end developer</em>, atau&nbsp;<em>full-stack developer</em>? Apakah artinya istilah-istilah tersebut?</p><p>Seiring perkembangan teknologi,&nbsp;<em>web</em>&nbsp;telah berkembang menjadi lebih kompleks. Ini membuat&nbsp;<em>developer</em>&nbsp;juga menjadi lebih terspesialisasi. Artinya, seorang&nbsp;<em>developer</em>&nbsp;tidak harus melakukan keseluruhan proses membangun&nbsp;<em>web</em>&nbsp;lagi, tetapi fokus pada bagian tertentu saja, entah itu salah satu bahasa pemograman,&nbsp;<em>framework</em>, atau bagian teknikal lainnya.</p>', '2019-05-29', '2019-05-31', 2, '1558506064_fileLoker.jpg', 2, 1, '2019-05-21 22:20:42', '2019-05-21 22:21:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_periode_kerja`
--

CREATE TABLE `h_periode_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `mulai_kerja` date NOT NULL,
  `selesai_kerja` date NOT NULL,
  `alasan_selesai` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_potongan_absen`
--

CREATE TABLE `h_potongan_absen` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_absensi` int(11) NOT NULL,
  `id_potongan_tetap` int(11) NOT NULL,
  `periode` date DEFAULT NULL,
  `jumlah_item_p` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_potongan_absen`
--

INSERT INTO `h_potongan_absen` (`id`, `id_absensi`, `id_potongan_tetap`, `periode`, `jumlah_item_p`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-07-01', 2, 2, 1, '2019-07-18 23:14:55', '2019-07-28 17:43:55'),
(2, 1, 1, '2019-06-01', 1, 2, 1, '2019-07-28 17:45:13', '2019-07-28 17:45:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_potongan_tetap`
--

CREATE TABLE `h_potongan_tetap` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_potongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_potongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_potongan` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `besar_potongan` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_potongan_tetap`
--

INSERT INTO `h_potongan_tetap` (`id`, `nm_potongan`, `satuan_potongan`, `status_potongan`, `besar_potongan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Terlambat hadir', 'Hari', '0', 20000, 2, 1, '2019-07-18 18:12:55', '2019-07-18 18:29:38'),
(2, 'Tidak absen masuk', 'Hari', '0', 10000, 2, 1, '2019-07-28 17:06:23', '2019-07-28 17:06:23'),
(3, 'Tidak absen pulang', 'Hari', '0', 10000, 2, 1, '2019-07-28 17:06:42', '2019-07-28 17:06:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_predikat_penilaian`
--

CREATE TABLE `h_predikat_penilaian` (
  `id` int(10) UNSIGNED NOT NULL,
  `skor_awal` int(11) NOT NULL,
  `skor_akhir` int(11) NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kenaikan` int(11) NOT NULL,
  `fasilitas_lain` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_predikat_penilaian`
--

INSERT INTO `h_predikat_penilaian` (`id`, `skor_awal`, `skor_akhir`, `predikat`, `kenaikan`, `fasilitas_lain`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 90, 100, 'Istimewa', 5, NULL, 2, 1, '2019-07-16 21:16:25', '2019-07-16 21:16:25'),
(2, 80, 89, 'Baik', 4, NULL, 2, 1, '2019-07-16 21:20:51', '2019-07-16 21:28:16'),
(3, 70, 79, 'Cukup', 3, NULL, 2, 1, '2019-07-16 21:21:17', '2019-07-16 21:21:17'),
(4, 60, 69, 'Kurang', 0, NULL, 2, 1, '2019-07-16 21:22:06', '2019-07-16 21:22:06'),
(6, 50, 59, 'Jelek', -1, NULL, 2, 1, '2019-07-16 21:30:19', '2019-07-16 21:30:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_psikotes`
--

CREATE TABLE `h_psikotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lamaran_p` int(10) UNSIGNED NOT NULL,
  `tgl_tes` date NOT NULL,
  `id_jenis_psikotes` int(10) UNSIGNED NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_psikotes`
--

INSERT INTO `h_psikotes` (`id`, `id_lamaran_p`, `tgl_tes`, `id_jenis_psikotes`, `nilai_akhir`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 3, '2019-05-15', 3, 89, 2, 1, '2019-05-21 19:35:00', '2019-05-21 19:50:22'),
(2, 4, '2019-05-30', 2, 90, 2, 1, '2019-05-21 22:05:03', '2019-05-21 22:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_rencana_pelatihan`
--

CREATE TABLE `h_rencana_pelatihan` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn_anggaran` year(4) NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pelatihan` date NOT NULL,
  `biaya` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_rencana_pelatihan`
--

INSERT INTO `h_rencana_pelatihan` (`id`, `thn_anggaran`, `tema`, `tgl_pelatihan`, `biaya`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 'Data Pelatihan Mysql Dan System Security', '2019-06-27', 500000, 2, 1, '2019-06-17 18:59:44', '2019-06-17 19:31:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_request_cuti`
--

CREATE TABLE `h_request_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_req` date NOT NULL,
  `jenis_izin` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Cuti, 1=izin, 2=sakit',
  `id_cuti` int(11) DEFAULT NULL,
  `lama_request` int(11) NOT NULL,
  `upprove` enum('0','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=masih diproses, 1=tidak disetujui, 2=disetujui',
  `atasan` int(10) UNSIGNED NOT NULL,
  `surat_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_request_cuti`
--

INSERT INTO `h_request_cuti` (`id`, `tgl_req`, `jenis_izin`, `id_cuti`, `lama_request`, `upprove`, `atasan`, `surat_keterangan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '2019-06-01', '0', 1, 7, '0', 2, '5d070281439381560740481.jpg', 2, 1, '2019-06-13 19:23:05', '2019-06-16 19:01:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_satuan_kpi`
--

CREATE TABLE `h_satuan_kpi` (
  `id` int(10) UNSIGNED NOT NULL,
  `satuan_kpi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_satuan_kpi`
--

INSERT INTO `h_satuan_kpi` (`id`, `satuan_kpi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '%', 2, 1, '2019-06-23 17:57:13', '2019-07-16 19:06:21'),
(2, 'Jam', 2, 1, '2019-06-24 18:14:29', '2019-07-16 19:06:29'),
(3, 'Hari', 2, 1, '2019-07-16 19:07:37', '2019-07-16 19:07:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_seleksi_berkas`
--

CREATE TABLE `h_seleksi_berkas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lamaran_p` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_seleksi_berkas`
--

INSERT INTO `h_seleksi_berkas` (`id`, `id_lamaran_p`, `ket`, `hasil`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 3, '<p>bsdf sdf</p>', '1', 2, 1, '2019-05-16 18:31:07', '2019-05-20 21:54:30'),
(2, 4, '<p>wedgfhh</p>', '1', 2, 1, '2019-05-20 21:59:03', '2019-05-20 21:59:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_setting_cuti`
--

CREATE TABLE `h_setting_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengurang_cuti` int(11) NOT NULL DEFAULT 0,
  `akumulasi_cuti` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_setting_cuti`
--

INSERT INTO `h_setting_cuti` (`id`, `nm_cuti`, `pengurang_cuti`, `akumulasi_cuti`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Cuti Menikah', 1, 0, 2, 1, '2019-06-12 19:01:08', '2019-06-12 19:31:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_sop`
--

CREATE TABLE `h_sop` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_sop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_sop` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_tenaga_ahli`
--

CREATE TABLE `h_tenaga_ahli` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `lembaga_sertifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_registrasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ditetapkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_penetapan` date NOT NULL,
  `masa_berlaku` int(11) NOT NULL,
  `asosiosi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi_proyek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_tenaga_ahli`
--

INSERT INTO `h_tenaga_ahli` (`id`, `id_ky`, `lembaga_sertifikasi`, `no_sertifikat`, `klasifikasi`, `no_registrasi`, `ditetapkan`, `tgl_penetapan`, `masa_berlaku`, `asosiosi`, `no_anggota`, `posisi_proyek`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Coba Ini', 'alsj', 'lasjd', 'a', 'a', '2019-06-21', 3, '34', '1', 'CTE', 2, 1, '2019-06-10 19:16:28', '2019-06-10 19:45:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_tes_keahlian`
--

CREATE TABLE `h_tes_keahlian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lamaran_p` int(10) UNSIGNED NOT NULL,
  `id_item_tes_keahlian` int(10) UNSIGNED NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_tes_keahlian`
--

INSERT INTO `h_tes_keahlian` (`id`, `id_lamaran_p`, `id_item_tes_keahlian`, `nilai_akhir`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 80, 'Berkah', 2, 1, '2019-05-23 18:12:29', '2019-05-23 18:26:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_tes_kmanajerial`
--

CREATE TABLE `h_tes_kmanajerial` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn_tes_km` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_m` int(10) UNSIGNED NOT NULL,
  `id_item_km` int(10) UNSIGNED NOT NULL,
  `nilai_km1` int(11) NOT NULL,
  `nilai_km2` int(11) NOT NULL,
  `nilai_km3` int(11) NOT NULL,
  `nilai_km4` int(11) NOT NULL,
  `nilai_km5` int(11) NOT NULL,
  `skor_akhir_km` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_tes_kteknis`
--

CREATE TABLE `h_tes_kteknis` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn_tes_kt` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_t` int(10) UNSIGNED NOT NULL,
  `id_item_kt` int(10) UNSIGNED NOT NULL,
  `nilai_kt` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_tes_kteknis`
--

INSERT INTO `h_tes_kteknis` (`id`, `thn_tes_kt`, `id_ky`, `id_kompetensi_t`, `id_item_kt`, `nilai_kt`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 1, 1, 1, 40, 2, 1, '2019-07-04 19:00:58', '2019-07-04 19:11:27'),
(2, 2019, 2, 1, 1, 34, 2, 1, '2019-07-04 22:38:07', '2019-07-04 22:38:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_tes_manajerial`
--

CREATE TABLE `h_tes_manajerial` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn_tes_km` year(4) NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_kompetensi_m` int(10) UNSIGNED NOT NULL,
  `id_item_km` int(10) UNSIGNED NOT NULL,
  `nilai_km` int(25) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_tes_manajerial`
--

INSERT INTO `h_tes_manajerial` (`id`, `thn_tes_km`, `id_ky`, `id_kompetensi_m`, `id_item_km`, `nilai_km`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 1, 1, 1, 102, 2, 1, '2019-07-03 17:43:28', '2019-07-03 17:43:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `h_wawancara`
--

CREATE TABLE `h_wawancara` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lamaran_p` int(10) UNSIGNED NOT NULL,
  `tgl_wawancara` date NOT NULL,
  `id_item_wawancara` int(10) UNSIGNED NOT NULL,
  `nilai_akhir` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `h_wawancara`
--

INSERT INTO `h_wawancara` (`id`, `id_lamaran_p`, `tgl_wawancara`, `id_item_wawancara`, `nilai_akhir`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 3, '2019-05-23', 1, 70, 'asdad', 2, 1, '2019-05-22 21:46:37', '2019-05-22 21:46:37'),
(3, 3, '2019-05-23', 1, 80, 'asd', 2, 1, '2019-05-22 21:46:48', '2019-05-22 21:46:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_akad`
--

CREATE TABLE `i_akad` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_akad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_akad`
--

INSERT INTO `i_akad` (`id`, `nm_file`, `file_akad`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 'Akad 1', '5d57f596527091566045590.zip', 2, 1, '2019-08-17 04:39:50', '2019-08-17 04:39:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_bentuk_investor`
--

CREATE TABLE `i_bentuk_investor` (
  `id` int(10) UNSIGNED NOT NULL,
  `bentuk_investasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_bentuk_investor`
--

INSERT INTO `i_bentuk_investor` (`id`, `bentuk_investasi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Keahlian', 2, 1, '2019-07-31 17:40:25', '2019-07-31 17:51:56'),
(3, 'Uang', 2, 1, '2019-07-31 17:54:51', '2019-07-31 17:54:51'),
(4, 'Jual', 2, 1, '2019-08-06 17:59:33', '2019-08-06 17:59:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_bulan_dividen_s`
--

CREATE TABLE `i_bulan_dividen_s` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn_dividen` year(4) NOT NULL,
  `bln_dividen` date NOT NULL,
  `laba_rugi` bigint(20) NOT NULL,
  `alokasi_kas` bigint(20) NOT NULL,
  `net_kas` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_bulan_dividen_s`
--

INSERT INTO `i_bulan_dividen_s` (`id`, `thn_dividen`, `bln_dividen`, `laba_rugi`, `alokasi_kas`, `net_kas`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, 2018, '2019-08-12', 10000, 5000, 5000, 2, 1, '2019-08-11 22:16:37', '2019-08-11 22:16:37'),
(4, 2017, '2019-08-13', 500000, 200000, 300000, 2, 1, '2019-08-12 19:00:05', '2019-08-12 19:00:05'),
(5, 2019, '2019-01-28', 25000000, 12500000, 12500000, 2, 1, '2019-08-28 00:11:29', '2019-08-28 00:11:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_daftar_investasi`
--

CREATE TABLE `i_daftar_investasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_invest` date NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `id_investor` int(10) UNSIGNED NOT NULL,
  `id_bentuk_invest` int(10) UNSIGNED NOT NULL,
  `jumlah_saham` decimal(12,2) DEFAULT NULL,
  `jumlah_investasi` decimal(12,2) NOT NULL,
  `persentase` decimal(12,2) DEFAULT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_daftar_investasi`
--

INSERT INTO `i_daftar_investasi` (`id`, `tgl_invest`, `id_periode_invest`, `id_investor`, `id_bentuk_invest`, `jumlah_saham`, `jumlah_investasi`, `persentase`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(5, '2019-08-01', 3, 3, 1, '50.00', '50000000.00', '50.00', NULL, 2, 1, '2019-08-04 22:23:13', '2019-08-04 22:23:13'),
(6, '2019-08-02', 3, 4, 3, '50.00', '50000000.00', '50.00', NULL, 2, 1, '2019-08-04 22:23:39', '2019-08-04 22:23:39'),
(22, '2019-09-01', 4, 3, 1, '50.00', '50000000.00', '45.45', 'Kealian', 2, 1, '2019-08-07 18:05:54', '2019-08-07 18:05:54'),
(23, '2019-09-01', 4, 4, 3, '50.00', '50000000.00', '45.45', 'Uang', 2, 1, '2019-08-07 18:06:31', '2019-08-07 18:06:31'),
(24, '2019-09-01', 4, 5, 1, '10.00', '9090909.09', '9.09', 'Keahlian', 2, 1, '2019-08-07 18:07:00', '2019-08-07 18:07:00'),
(25, '2019-10-01', 5, 6, 3, '27.50', '2000000000.00', '20.00', 'Uang Tunai', 2, 1, '2019-08-07 19:04:13', '2019-08-07 19:04:13'),
(28, '2019-10-01', 5, 3, 1, '50.00', '50000000.00', '36.36', NULL, 2, 1, '2019-08-07 19:06:20', '2019-08-07 19:06:20'),
(29, '2019-10-01', 5, 5, 1, '10.00', '9090909.09', '7.27', NULL, 2, 1, '2019-08-07 19:06:51', '2019-08-07 19:06:51'),
(39, '2019-11-01', 5, 4, 1, '20.00', '20000000.00', '14.55', 'Dijual', 2, 1, '2019-08-12 17:04:12', '2019-08-12 17:04:12'),
(40, '2019-11-01', 5, 7, 1, '30.00', '2181818181.82', '21.82', 'Dibeli', 2, 1, '2019-08-12 17:04:12', '2019-08-12 17:04:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_data_investor`
--

CREATE TABLE `i_data_investor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_investor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kel` enum('Pria','Wanita','-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_perkawinan` enum('Belum Kawin','Sudah Kawin','Janda','Duda') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Kawin',
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pas_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nm_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pend_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kantor_cabang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_data_investor`
--

INSERT INTO `i_data_investor` (`id`, `nik`, `nm_investor`, `password`, `tmp_lahir`, `tgl_lahir`, `jenis_kel`, `agama`, `status_perkawinan`, `pekerjaan`, `file_ktp`, `pas_photo`, `nm_bank`, `no_rek`, `pend_akhir`, `no_rek_bank`, `kantor_cabang`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, '717419921238', 'Mouse', '123456', 'Kendari', '2019-07-03', 'Pria', 'Kristen Protestan', 'Sudah Kawin', NULL, '5d41341c9b16d1564554268.jpg', '5d414cff9181b1564560639.jpg', NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-07-30 19:54:15', '2019-07-31 00:10:39'),
(4, '712381923911', 'Boby', '123456', 'Kendari', '2019-08-12', 'Pria', 'Islam', 'Sudah Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-08-02 20:48:44', '2019-08-02 20:48:44'),
(5, '7125235462462', 'cecep', '123456', 'Kendari', '2019-08-12', 'Pria', 'Islam', 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-08-02 20:49:26', '2019-08-02 20:49:26'),
(6, '3945394753974593', 'dadang', '123456', 'kendari', '2019-08-22', 'Pria', 'Islam', 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-08-06 17:58:09', '2019-08-06 17:58:09'),
(7, '3945394753974595', 'eko', '123456', 'kendari', '2019-08-01', 'Pria', 'Islam', 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-08-06 17:59:07', '2019-08-06 17:59:07'),
(8, '39453947539745998', 'SI Meja', '123456', 'kendari', '2019-08-29', 'Pria', 'Islam', 'Belum Kawin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-08-16 14:59:11', '2019-08-16 14:59:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_deviden_bulan_m`
--

CREATE TABLE `i_deviden_bulan_m` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `thn_dividen` year(4) NOT NULL,
  `bln_dividen` int(11) NOT NULL,
  `laba_rugi` bigint(20) NOT NULL,
  `alokasi_kas` bigint(20) NOT NULL,
  `net_kas` bigint(20) NOT NULL,
  `nisbah_pelaksana` bigint(20) DEFAULT NULL,
  `nisbah_pemodal` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_deviden_bulan_m`
--

INSERT INTO `i_deviden_bulan_m` (`id`, `id_periode_invest`, `thn_dividen`, `bln_dividen`, `laba_rugi`, `alokasi_kas`, `net_kas`, `nisbah_pelaksana`, `nisbah_pemodal`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 5, 2018, 8, 1000000, 500000, 500000, 200000, 300000, 2, 1, '2019-08-19 18:41:48', '2019-08-19 18:41:48'),
(10, 5, 2019, 1, 25000000, 12500000, 12500000, 7500000, 5000000, 2, 1, '2019-08-26 18:15:47', '2019-08-26 18:39:36'),
(11, 5, 2019, 2, 30000000, 15000000, 15000000, 9000000, 6000000, 2, 1, '2019-08-28 02:20:18', '2019-08-28 02:20:18'),
(15, 5, 2019, 3, -10000000, 0, -10000000, -6000000, -4000000, 2, 1, '2019-08-28 02:31:58', '2019-08-28 02:35:16'),
(16, 5, 2019, 4, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:32:46', '2019-08-28 02:32:46'),
(17, 5, 2019, 5, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:33:09', '2019-08-28 02:33:09'),
(18, 5, 2019, 6, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:33:21', '2019-08-28 02:33:21'),
(19, 5, 2019, 7, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:33:36', '2019-08-28 02:33:36'),
(21, 5, 2019, 8, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:35:55', '2019-08-28 02:35:55'),
(22, 5, 2019, 9, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:36:17', '2019-08-28 02:36:17'),
(23, 5, 2019, 10, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:36:29', '2019-08-28 02:36:29'),
(24, 5, 2019, 11, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:36:46', '2019-08-28 02:36:46'),
(25, 5, 2019, 12, 5000000, 2500000, 2500000, 1500000, 1000000, 2, 1, '2019-08-28 02:37:19', '2019-08-28 02:37:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_dividen_investor`
--

CREATE TABLE `i_dividen_investor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_daftar_investor` int(10) UNSIGNED NOT NULL,
  `id_bulan_dividen` int(10) UNSIGNED NOT NULL,
  `besar_dividen` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_dividen_investor`
--

INSERT INTO `i_dividen_investor` (`id`, `id_daftar_investor`, `id_bulan_dividen`, `besar_dividen`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(4, 3, 3, 181800, 2, 1, '2019-08-22 22:46:30', '2019-08-22 22:46:30'),
(6, 3, 5, 4545000, 2, 1, '2019-08-28 00:20:56', '2019-08-28 00:20:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_dividen_pelaksana`
--

CREATE TABLE `i_dividen_pelaksana` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pelaksana` int(10) UNSIGNED NOT NULL,
  `id_bulan_dividen` int(10) UNSIGNED NOT NULL,
  `besar_dividen` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_dividen_pelaksana`
--

INSERT INTO `i_dividen_pelaksana` (`id`, `id_pelaksana`, `id_bulan_dividen`, `besar_dividen`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(7, 5, 10, 3000000, 2, 1, '2019-08-26 18:39:51', '2019-08-26 18:39:51'),
(8, 6, 10, 4500000, 2, 1, '2019-08-26 22:11:39', '2019-08-26 22:11:39'),
(9, 5, 11, 3600000, 2, 1, '2019-08-28 02:40:35', '2019-08-28 02:40:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_dividen_pemodal`
--

CREATE TABLE `i_dividen_pemodal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pemodal` int(10) UNSIGNED NOT NULL,
  `id_bulan_dividen` int(10) UNSIGNED NOT NULL,
  `besar_dividen` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_dividen_pemodal`
--

INSERT INTO `i_dividen_pemodal` (`id`, `id_pemodal`, `id_bulan_dividen`, `besar_dividen`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(4, 1, 10, 1250000, 2, 1, '2019-08-26 18:41:55', '2019-08-26 18:41:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_investor_jual_saham`
--

CREATE TABLE `i_investor_jual_saham` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_jual_s` date NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `id_investor_penjual` int(10) UNSIGNED NOT NULL,
  `lembar_saham_penjual` decimal(12,2) NOT NULL,
  `jumlah_dijual` decimal(12,2) NOT NULL,
  `id_investor_pembeli` int(10) UNSIGNED NOT NULL,
  `sisa_saham_dijual` decimal(12,2) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_investor_jual_saham`
--

INSERT INTO `i_investor_jual_saham` (`id`, `tgl_jual_s`, `id_periode_invest`, `id_investor_penjual`, `lembar_saham_penjual`, `jumlah_dijual`, `id_investor_pembeli`, `sisa_saham_dijual`, `id_perusahaan`, `id_karyawan`, `updated_at`, `created_at`) VALUES
(4, '2019-11-01', 5, 4, '50.00', '30.00', 7, '20.00', 2, 1, '2019-08-12 17:04:12', '2019-08-12 17:04:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_jual_saham_perusahaan`
--

CREATE TABLE `i_jual_saham_perusahaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `jumlah_persen_saham` decimal(12,2) NOT NULL,
  `jumlah_saham_terbit` decimal(12,2) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_jual_saham_perusahaan`
--

INSERT INTO `i_jual_saham_perusahaan` (`id`, `id_periode_invest`, `jumlah_persen_saham`, `jumlah_saham_terbit`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, 4, '10.00', '10.00', 2, 1, '2019-08-07 17:58:37', '2019-08-07 17:58:37'),
(4, 5, '25.00', '27.50', 2, 1, '2019-08-07 19:01:30', '2019-08-07 19:01:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_nisbah`
--

CREATE TABLE `i_nisbah` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `pelaksana` decimal(12,0) NOT NULL,
  `pemodal` decimal(12,0) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_nisbah`
--

INSERT INTO `i_nisbah` (`id`, `id_periode_invest`, `pelaksana`, `pemodal`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 5, '60', '40', 2, 1, '2019-08-18 18:24:33', '2019-08-26 18:13:54'),
(2, 4, '50', '50', 2, 1, '2019-08-19 18:43:32', '2019-08-19 18:43:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_pelaksana`
--

CREATE TABLE `i_pelaksana` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `id_bentuk_invest` int(10) UNSIGNED NOT NULL,
  `persen_saham` decimal(12,2) NOT NULL DEFAULT 0.00,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_pelaksana`
--

INSERT INTO `i_pelaksana` (`id`, `id_ky`, `id_periode_invest`, `id_bentuk_invest`, `persen_saham`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(5, 1, 5, 1, '40.00', 2, 1, '2019-08-15 22:23:17', '2019-08-26 22:09:03'),
(6, 2, 5, 1, '60.00', 2, 1, '2019-08-26 22:10:27', '2019-08-26 22:10:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_pemodal`
--

CREATE TABLE `i_pemodal` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_invest` date NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `id_investor` int(10) UNSIGNED NOT NULL,
  `id_bentuk_invest` int(10) UNSIGNED NOT NULL,
  `persen_saham` decimal(12,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_pemodal`
--

INSERT INTO `i_pemodal` (`id`, `tgl_invest`, `id_periode_invest`, `id_investor`, `id_bentuk_invest`, `persen_saham`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '2019-08-27', 5, 8, 4, '25.00', 2, 1, '2019-08-16 15:16:12', '2019-08-26 18:36:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_periode_investasi`
--

CREATE TABLE `i_periode_investasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode_ke` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vesting_periode` int(11) NOT NULL,
  `nilai_valuasi` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_periode_investasi`
--

INSERT INTO `i_periode_investasi` (`id`, `periode_ke`, `nm_periode`, `vesting_periode`, `nilai_valuasi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, 'I', 'seed round, angel round/ investor, seri A Round, Seri B Round', 2, 100000000, 2, 1, '2019-08-02 00:13:43', '2019-08-02 00:13:43'),
(4, 'II', 'Seed capital, angel investor, Venture Capital, Mezzanine Financing', 2, 100000000, 2, 1, '2019-08-04 22:34:43', '2019-08-04 22:34:43'),
(5, 'III', 'Test', 2, 10000000000, 2, 1, '2019-08-06 18:02:59', '2019-08-06 18:02:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_persen_kas`
--

CREATE TABLE `i_persen_kas` (
  `id` int(10) UNSIGNED NOT NULL,
  `thn` year(4) NOT NULL,
  `persen_kas` int(100) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_persen_kas`
--

INSERT INTO `i_persen_kas` (`id`, `thn`, `persen_kas`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 2018, 50, 2, 1, '2019-08-11 19:14:31', '2019-08-11 19:14:31'),
(3, 2019, 50, 2, 1, '2019-08-11 19:15:20', '2019-08-26 17:53:34'),
(4, 2017, 40, 2, 1, '2019-08-12 18:59:46', '2019-08-12 18:59:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_saham_perdana`
--

CREATE TABLE `i_saham_perdana` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periode_invest` int(10) UNSIGNED NOT NULL,
  `lembar_saham_perdana` decimal(12,2) NOT NULL,
  `nilai_saham` decimal(12,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_saham_perdana`
--

INSERT INTO `i_saham_perdana` (`id`, `id_periode_invest`, `lembar_saham_perdana`, `nilai_saham`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(7, 3, '100.00', '1000000.00', 2, 1, '2019-08-02 00:13:57', '2019-08-02 00:13:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `i_saham_real`
--

CREATE TABLE `i_saham_real` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periode_saham` int(10) UNSIGNED NOT NULL,
  `jum_saham` decimal(12,2) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non aktif',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `i_saham_real`
--

INSERT INTO `i_saham_real` (`id`, `id_periode_saham`, `jum_saham`, `satuan`, `status`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(3, 3, '100.00', 'lembar', 'non aktif', 2, 1, '2019-08-02 00:13:58', '2019-08-12 22:24:31'),
(9, 4, '110.00', 'lembar', 'non aktif', 2, 1, '2019-08-07 17:58:37', '2019-08-12 22:24:31'),
(10, 5, '137.50', 'lembar', 'aktif', 2, 1, '2019-08-07 19:01:30', '2019-08-12 22:24:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_akun_aktif_ukm`
--

CREATE TABLE `k_akun_aktif_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sub_akun` int(11) DEFAULT NULL,
  `id_subsub_akun` int(11) DEFAULT 0,
  `kode_akun_aktif` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_akun_aktif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_alur_kas` enum('-','0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=tidak masuk alur kas, 1=masuk alur kas',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `posisi_saldo` enum('D','K') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_akun_aktif_ukm`
--

INSERT INTO `k_akun_aktif_ukm` (`id`, `id_sub_akun`, `id_subsub_akun`, `kode_akun_aktif`, `nm_akun_aktif`, `status_alur_kas`, `id_perusahaan`, `id_karyawan`, `posisi_saldo`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '1-1000', 'Aktiva Lancar', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(2, 1, 1, '1-1001', 'Kas', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(3, 1, 2, '1-1002', 'Kas Bank Muamalat', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(4, 1, 3, '1-1003', 'Kas BNI Syariah', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(5, 1, 4, '1-1004', 'Kas BRI Syariah', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(6, 1, 5, '1-1005', 'Kas Bank Syariah Mandiri', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(7, 1, 6, '1-1006', 'Kas Bank Mega Syariah', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(8, 1, 7, '1-1007', 'Kas BCA Syariah', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(9, 1, 8, '1-1008', 'Kas BTPN', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(10, 1, 9, '1-1009', 'Kas BNI', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(11, 1, 10, '1-1010', 'Kas BRI ', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(12, 1, 11, '1-1011', 'Kas Bank Mandiri', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(13, 1, 12, '1-1012', 'Kas BTN', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(14, 1, 13, '1-1013', 'Kas BPD', '-', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(15, 1, 14, '1-1014', 'Persediaan', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(16, 1, 15, '1-1015', 'Persediaan barang dagang', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(17, 1, 16, '1-1016', 'persediaan barang baku', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(18, 1, 17, '1-1017', 'persediaan Barang dalam proses', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(19, 1, 18, '1-1018', 'Persediaan Barang Jadi', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(20, 1, 19, '1-1019', 'Persediaan Bahan Penolong', '1', 2, 1, 'D', '2019-10-21 00:24:43', '2019-10-21 00:24:43'),
(21, 1, 20, '1-1020', 'Persediaan Lain Lain', '1', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(22, 1, 21, '1-1021', 'piutang dagang/usaha', '1', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(23, 1, 22, '1-1022', 'piutang kartu kredit', '-', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(24, 1, 23, '1-1023', 'piutang karyawan', '-', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(25, 1, 24, '1-1024', 'piutang wesel/wesel Tagih', '-', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(26, 1, 25, '1-1025', 'Cadangan Kerugian Piutang Tak Tertagih', '-', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(27, 1, 26, '1-1026', 'Perlengkapan', '-', 2, 1, 'D', '2019-10-21 00:24:44', '2019-10-21 00:24:44'),
(28, 1, 27, '1-1027', 'Biaya di bayar di muka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(29, 1, 28, '1-1028', 'Pengeluaran di bayar di muka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(30, 1, 29, '1-1029', 'Sewa dibayar dimuka', '1', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(31, 1, 30, '1-1030', 'Asuransi di bayar di muka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(32, 1, 31, '1-1031', 'Iklan di bayar dimuka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(33, 1, 32, '1-1032', 'Gaji dibayar dimuka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(34, 1, 33, '1-1033', 'Pajak di bayar dimuka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(35, 1, 34, '1-1034', 'Bunga di bayar dimuka', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(36, 1, 35, '1-1035', 'Pajak masukan/PPN Masukan', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(37, 1, 36, '1-1036', 'Pajak masukan belum diterima', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(38, 2, 0, '1-2000', 'Aktiva Tetap', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(39, 2, 37, '1-2001', 'Tanah', '1', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(40, 2, 38, '1-2002', 'Gedung', '1', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(41, 2, 39, '1-2003', 'Peralatan', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(42, 2, 40, '1-2004', 'Kendaraan', '1', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(43, 2, 41, '1-2005', 'Mesin ', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(44, 2, 42, '1-2006', 'Akumulasi penyusutan gedung', '1', 2, 1, 'K', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(45, 2, 43, '1-2007', 'Akumulasi penyusutan peralatan', '1', 2, 1, 'K', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(46, 2, 44, '1-2008', 'Akumulasi penyusutan kendaraan', '1', 2, 1, 'K', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(47, 2, 45, '1-2009', 'Akumulasi mesin', '1', 2, 1, 'K', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(48, 2, 46, '1-2010', 'Investasi', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(49, 2, 47, '1-2011', 'Deposito', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(50, 2, 48, '1-2012', 'Piutang pajak ', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(51, 2, 49, '1-2013', 'Kepemilikan Saham/obligasi', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(52, 3, 0, '1-3000', 'Aktiva Tetap Tidak Berwujud', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(53, 3, 50, '1-3001', 'Hak Paten', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(54, 3, 51, '1-3002', 'Hak Cipta', '-', 2, 1, 'D', '2019-10-21 00:24:45', '2019-10-21 00:24:45'),
(55, 3, 52, '1-3003', 'Merk Dagang', '-', 2, 1, 'D', '2019-10-21 00:24:46', '2019-10-21 00:24:46'),
(56, 3, 53, '1-3004', 'Good Will', '-', 2, 1, 'D', '2019-10-21 00:24:46', '2019-10-21 00:24:46'),
(57, 3, 54, '1-3005', 'Hak sewa', '-', 2, 1, 'D', '2019-10-21 00:24:46', '2019-10-21 00:24:46'),
(58, 3, 55, '1-3006', 'Franchise', '-', 2, 1, 'D', '2019-10-21 00:24:46', '2019-10-21 00:24:46'),
(59, 3, 56, '1-3007', 'Leasehold', '-', 2, 1, 'D', '2019-10-21 00:24:46', '2019-10-21 00:24:46'),
(60, 4, 0, '2-1000', 'Hutang Lancar', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:42:59'),
(61, 4, 57, '2-1001', 'Hutang Dagang/Usaha', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(62, 4, 58, '2-1002', 'Hutang  kartu kredit', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(63, 4, 59, '2-1003', 'Hutang konsinyasi', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(64, 4, 60, '2-1004', 'Wesel bayar', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(65, 4, 61, '2-1005', 'Hutang gaji', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(66, 4, 62, '2-1006', 'Hutang Bonus', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(67, 4, 63, '2-1007', 'Hutang PPH 21', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(68, 4, 64, '2-1008', 'Hutang Hadiah', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(69, 4, 65, '2-1009', 'Hutang Garansi', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(70, 4, 66, '2-1010', 'hutang sewa', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(71, 4, 67, '2-1011', 'Hutang Beban (Biaya yang harus di bayar)', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(72, 4, 68, '2-1012', 'Penerimaan uang muka', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(73, 4, 69, '2-1013', 'Sewa di terima di muka', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(74, 4, 70, '2-1014', 'Pendapatan di terima di muka', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(75, 4, 71, '2-1015', 'PPN Keluaran/Pajak Keluaran', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:00'),
(76, 4, 72, '2-1016', 'Hutang pajak/PPN', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(77, 4, 73, '2-1017', 'Pajak keluaran belum terbit', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(78, 4, 74, '2-1018', 'Hutang Dividen', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(79, 5, 0, '2-2000', 'Hutang Jangka Panjang', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(80, 5, 75, '2-2001', 'Hutang Bank', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(81, 5, 76, '2-2002', 'HUTANG BRI', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(82, 5, 77, '2-2003', 'HUTANG  BNI', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(83, 5, 78, '2-2004', 'HUTANG BANK Muamalat', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(84, 5, 79, '2-2005', 'HUTANG  BRI Syariah', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(85, 5, 80, '2-2006', 'Hutang Koperasi', '-', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(86, 5, 81, '2-2007', 'Hutang Hipotik', '0', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(87, 5, 82, '2-2008', 'Hutang Obligasi', '1', 2, 1, 'K', '2019-10-21 00:24:46', '2020-10-19 01:43:01'),
(88, 6, 0, '3-0001', 'Modal Usaha', '1', 2, 1, 'K', '2019-10-21 00:24:47', '2020-10-19 01:43:01'),
(89, 7, 0, '3-0002', 'Modal Saham', '1', 2, 1, 'K', '2019-10-21 00:24:47', '2020-10-19 01:43:01'),
(90, 8, 0, '3-0003', 'Disagio Saham', '-', 2, 1, 'K', '2019-10-21 00:24:47', '2020-10-19 01:43:01'),
(91, 9, 0, '3-0004', 'Prive', '1', 2, 1, 'D', '2019-10-21 00:24:48', '2019-10-21 00:24:48'),
(92, 10, 0, '3-0005', 'Dividen', '-', 2, 1, 'D', '2019-10-21 00:24:48', '2019-10-21 00:24:48'),
(93, 11, 0, '3-0006', 'laba di tahan / Saldo laba', '-', 2, 1, 'K', '2019-10-21 00:24:49', '2020-10-19 01:43:01'),
(94, 12, 0, '3-0007', 'Laba di tahan Tahun Berjalan', '-', 2, 1, 'K', '2019-10-21 00:24:49', '2020-10-19 01:43:02'),
(95, 13, 0, '3-0008', 'Ikhtisar Laba Rugi', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(96, 14, 0, '3-0009', 'Saldo penyeimbang (historical balance)', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(97, 15, 0, '4-0001', 'Pendapatan Jasa', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(98, 16, 0, '4-0002', 'pendapatan dagang', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(99, 17, 0, '4-0003', 'pendapatan jual (penjualan)', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(100, 18, 0, '4-0004', 'Return Penjualan', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(101, 19, 0, '4-0005', 'Potongan Penjualan', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(102, 20, 0, '4-0006', 'Biaya angkut penjualan', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(103, 21, 0, '5-0001', 'Harga Pokok Penjualan (HPP)', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(104, 22, 0, '5-0002', 'Pembelian', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(105, 23, 0, '5-0003', 'Biaya angkut pembelian', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(106, 24, 0, '5-0004', 'return pembelian', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(107, 25, 0, '5-0005', 'Pengaturan stok', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(108, 26, 0, '5-0006', 'potongan pembelian', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(109, 27, 0, '5-0007', 'Pengurangan harga/diskon', '-', 2, 1, 'K', '2019-10-21 00:24:50', '2020-10-19 01:43:02'),
(110, 28, 0, '6-1000', 'Biaya Gaji ', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(111, 28, 83, '6-1001', 'Biaya gaji karyawan', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(112, 28, 84, '6-1002', 'Biaya Gaji Freelancer', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(113, 28, 85, '6-1003', 'biaya gaji tenaga ahli', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(114, 28, 86, '6-1004', 'biaya honor', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(115, 28, 87, '6-1005', 'Biaya Bonus & insentif', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(116, 29, 0, '6-2000', 'Biaya Pemasaran', '-', 2, 1, 'D', '2019-10-21 00:24:50', '2019-10-21 00:24:50'),
(117, 29, 88, '6-2001', 'Biaya Iklan', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(118, 29, 89, '6-2002', 'Biaya iklan koran', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(119, 29, 90, '6-2003', 'Biaya iklan radio', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(120, 29, 91, '6-2004', 'Biaya You Tube ads', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(121, 29, 92, '6-2005', 'Biaya  IG ads', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(122, 29, 93, '6-2006', 'Biaya  FB ads', '-', 2, 1, 'D', '2019-10-21 00:24:51', '2019-10-21 00:24:51'),
(123, 29, 94, '6-2007', 'Biaya  google ads', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(124, 30, 0, '6-3000', 'Biaya Operasional', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(125, 30, 95, '6-3001', 'biaya listrik', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(126, 30, 96, '6-3002', 'biaya internet', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(127, 30, 97, '6-3003', 'biaya air', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(128, 30, 98, '6-3004', 'biaya gas', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(129, 30, 99, '6-3005', 'biaya telepon', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(130, 30, 100, '6-3006', 'biaya keamanan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(131, 30, 101, '6-3007', 'biaya kebersihan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(132, 30, 102, '6-3008', 'biaya makan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(133, 30, 103, '6-3009', 'biaya perjalanan dinas', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(134, 30, 104, '6-3010', 'Biaya asuransi (BPJS)', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(135, 30, 105, '6-3011', 'biaya medis', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(136, 30, 106, '6-3012', 'biaya kirim', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(137, 30, 107, '6-3013', 'biaya transportasi  dan BBM', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(138, 30, 108, '6-3014', 'biaya cetak & penggandaan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(139, 30, 109, '6-3015', 'biaya ATK dan foto copy', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(140, 30, 110, '6-3016', 'biaya service dan pemeliharaan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(141, 30, 111, '6-3017', 'Biaya Perlengkapan kantor', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(142, 30, 112, '6-3018', 'Biaya Penyusutan Gedung', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(143, 30, 113, '6-3019', 'Biaya penyusutan kendaraan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(144, 30, 114, '6-3020', 'Biaya penyusutan peralatan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(145, 30, 115, '6-3021', 'Biaya penyusutan mesin', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(146, 30, 116, '6-3022', 'biaya sewa kendaraan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(147, 30, 117, '6-3023', 'biaya perawatan kendaraan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(148, 30, 118, '6-3024', 'Biaya Sewa Toko', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(149, 30, 119, '6-3025', 'Biaya Kerugian Piutang Tak Tertagih', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(150, 31, 0, '7-0001', 'Pendapatan Bunga', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(151, 32, 0, '7-0002', 'Pendapatan Deposito', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(152, 33, 0, '7-0003', 'pendapatan sewa', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(153, 34, 0, '7-0004', 'pendapatan dividen saham', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(154, 35, 0, '7-0005', 'laba atas selisih kurs', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(155, 36, 0, '8-0001', 'Biaya Bunga', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(156, 37, 0, '8-0002', 'Biaya Denda', '-', 2, 1, 'K', '2019-10-21 00:24:52', '2020-10-19 01:43:02'),
(157, 38, 0, '8-0003', 'Biaya Pajak Penghasilan', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(158, 39, 0, '8-0004', 'Biaya administrasi Bank', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52'),
(159, 40, 0, '8-0005', 'Rugi selisih kurs', '-', 2, 1, 'D', '2019-10-21 00:24:52', '2019-10-21 00:24:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_akun_ukm`
--

CREATE TABLE `k_akun_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_akun` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `posisi_saldo` enum('D','K') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_m_akun` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_akun_ukm`
--

INSERT INTO `k_akun_ukm` (`id`, `kode_akun`, `nm_akun`, `id_perusahaan`, `id_karyawan`, `posisi_saldo`, `created_at`, `updated_at`, `id_m_akun`) VALUES
(1, '1-0000', 'Aktiva', 2, 1, 'D', '2019-10-21 00:12:16', '2019-10-21 00:12:16', 1),
(2, '2-0000', 'Hutang', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18', 2),
(3, '3-0000', 'Modal', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19', 3),
(4, '4-0000', 'Pendapatan', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19', 4),
(5, '5-0000', 'HPP', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19', 5),
(6, '6-0000', 'Biaya', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19', 6),
(7, '7-0000', 'Pendapatan Lain', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20', 7),
(8, '8-0000', 'Biaya Lain', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_investor`
--

CREATE TABLE `k_investor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_investor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_kab` int(10) UNSIGNED NOT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jum_saham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_ahli_waris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_aw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_aw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_investor`
--

INSERT INTO `k_investor` (`id`, `nm_investor`, `no_ktp`, `password`, `alamat`, `id_prov`, `id_kab`, `hp`, `wa`, `jum_saham`, `file_ktp`, `nm_ahli_waris`, `no_hp_aw`, `alamat_aw`, `id_perusahaan`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, 'Ardan', '123344334567899', '$2y$10$TCp13ugdCoLhzepoa8tTBOqwA3qXDkh2bH43u4wrQq.tIWnt8nEbO', 'asdfg', 1, 1, '2342', '3456', '12', '1552373039-IKtp.png', 'Ardano', '123121241', 'asdasda', 2, 13, '2019-03-11 22:18:08', '2019-03-11 22:43:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_jurnal`
--

CREATE TABLE `k_jurnal` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_jurnal` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Saldo Awal, 1= Jurnal Umum, 2= Jurnal Penyesuaian',
  `tgl_jurnal` date NOT NULL,
  `id_ket_transaksi` int(10) UNSIGNED NOT NULL,
  `id_akun_aktif` int(12) DEFAULT NULL,
  `no_transaksi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debet_kredit` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=debet, 1=kredit',
  `jumlah_transaksi` decimal(12,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_jurnal`
--

INSERT INTO `k_jurnal` (`id`, `jenis_jurnal`, `tgl_jurnal`, `id_ket_transaksi`, `id_akun_aktif`, `no_transaksi`, `ket`, `debet_kredit`, `jumlah_transaksi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '0', '2020-03-01', 4, 2, '1', '', '0', '30000000.00', 2, 1, '2020-10-08 00:57:56', '2020-10-08 00:57:56'),
(2, '0', '2020-03-01', 4, 88, '1', '', '1', '30000000.00', 2, 1, '2020-10-08 00:57:56', '2020-10-08 00:57:56'),
(3, '1', '2020-04-01', 5, 148, '2', '', '0', '8000000.00', 2, 1, '2020-10-08 00:58:37', '2020-10-08 00:58:37'),
(4, '1', '2020-04-01', 5, 2, '2', '', '1', '8000000.00', 2, 1, '2020-10-08 00:58:37', '2020-10-08 00:58:37'),
(5, '1', '2020-05-01', 6, 2, '3', '', '0', '40000000.00', 2, 1, '2020-10-08 00:59:23', '2020-10-08 00:59:23'),
(6, '1', '2020-05-01', 6, 82, '3', '', '1', '40000000.00', 2, 1, '2020-10-08 00:59:23', '2020-10-08 00:59:23'),
(7, '1', '2020-05-02', 7, 41, '4', '', '0', '40000000.00', 2, 1, '2020-10-11 23:38:16', '2020-10-11 23:38:16'),
(8, '1', '2020-05-02', 7, 2, '4', '', '1', '40000000.00', 2, 1, '2020-10-11 23:38:16', '2020-10-11 23:38:16'),
(9, '1', '2020-05-04', 8, 15, '5', '', '0', '5000000.00', 2, 1, '2020-10-11 23:39:25', '2020-10-11 23:39:25'),
(10, '1', '2020-05-04', 8, 61, '5', '', '1', '5000000.00', 2, 1, '2020-10-11 23:39:25', '2020-10-11 23:39:25'),
(11, '1', '2020-05-15', 9, 61, '6', '', '0', '5000000.00', 2, 1, '2020-10-11 23:40:54', '2020-10-11 23:40:54'),
(12, '1', '2020-05-15', 9, 2, '6', '', '1', '5000000.00', 2, 1, '2020-10-11 23:40:54', '2020-10-11 23:40:54'),
(13, '1', '2020-05-18', 10, 15, '7', '', '0', '3000000.00', 2, 1, '2020-10-11 23:44:47', '2020-10-11 23:44:47'),
(14, '1', '2020-05-18', 10, 2, '7', '', '1', '3000000.00', 2, 1, '2020-10-11 23:44:48', '2020-10-11 23:44:48'),
(15, '1', '2020-05-28', 11, 140, '8', '', '0', '2000000.00', 2, 1, '2020-10-11 23:46:10', '2020-10-11 23:46:10'),
(16, '1', '2020-05-28', 11, 15, '8', '', '1', '2000000.00', 2, 1, '2020-10-11 23:46:11', '2020-10-11 23:46:11'),
(17, '1', '2020-06-10', 12, 2, '9', '', '0', '35000000.00', 2, 1, '2020-10-11 23:54:03', '2020-10-11 23:54:03'),
(18, '1', '2020-06-10', 12, 97, '9', '', '1', '35000000.00', 2, 1, '2020-10-11 23:54:03', '2020-10-11 23:54:03'),
(19, '1', '2020-11-09', 13, 91, '10', '', '0', '10000000.00', 2, 1, '2020-10-11 23:55:03', '2020-10-11 23:55:03'),
(20, '1', '2020-11-09', 13, 2, '10', '', '1', '10000000.00', 2, 1, '2020-10-11 23:55:03', '2020-10-11 23:55:03'),
(27, '2', '2020-12-31', 14, 30, '11', '', '0', '2000000.00', 2, 1, '2020-10-21 01:15:42', '2020-10-21 01:15:42'),
(28, '2', '2020-12-31', 14, 148, '11', '', '1', '2000000.00', 2, 1, '2020-10-21 01:15:43', '2020-10-21 01:15:43'),
(29, '2', '2020-12-31', 15, 155, '12', '', '0', '5333333.33', 2, 1, '2020-10-21 01:16:37', '2020-10-21 01:16:37'),
(30, '2', '2020-12-31', 15, 80, '12', '', '1', '5333333.33', 2, 1, '2020-10-21 01:16:37', '2020-10-21 01:16:37'),
(31, '2', '2020-12-31', 16, 144, '13', '', '0', '2666666.77', 2, 1, '2020-10-21 01:17:42', '2020-10-21 01:17:42'),
(32, '2', '2020-12-31', 16, 45, '13', '', '1', '2666666.77', 2, 1, '2020-10-21 01:17:42', '2020-10-21 01:17:42'),
(78, '0', '2021-01-01', 18, 2, 'SA-RKP-2020', '', '1', '39000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(79, '0', '2021-01-01', 18, 15, 'SA-RKP-2020', '', '1', '6000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(80, '0', '2021-01-01', 18, 30, 'SA-RKP-2020', '', '0', '2000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(81, '0', '2021-01-01', 18, 41, 'SA-RKP-2020', '', '0', '40000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(82, '0', '2021-01-01', 18, 45, 'SA-RKP-2020', '', '1', '-2666666.77', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(83, '0', '2021-01-01', 18, 61, 'SA-RKP-2020', '', '0', '0.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(84, '0', '2021-01-01', 18, 80, 'SA-RKP-2020', '', '1', '5333333.33', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(85, '0', '2021-01-01', 18, 82, 'SA-RKP-2020', '', '1', '40000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(86, '0', '2021-01-01', 18, 88, 'SA-RKP-2020', '', '1', '30000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(87, '0', '2021-01-01', 18, 91, 'SA-RKP-2020', '', '0', '-10000000.00', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18'),
(88, '0', '2021-01-01', 18, 94, 'SA-RKP-2020', '', '1', '18999999.90', 2, 1, '2020-12-11 01:12:18', '2020-12-11 01:12:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_ket_transaksi`
--

CREATE TABLE `k_ket_transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_transaksi` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_ket_transaksi`
--

INSERT INTO `k_ket_transaksi` (`id`, `nm_transaksi`, `jenis_transaksi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(4, 'Setoran Modal', '0', 2, 1, '2020-10-06 02:35:33', '2020-10-06 02:35:33'),
(5, 'Biaya Sewa', '0', 2, 1, '2020-10-06 02:36:51', '2020-10-06 02:36:51'),
(6, 'Hutang Bank Ke Bank BNI', '0', 2, 1, '2020-10-06 02:38:49', '2020-10-06 02:38:49'),
(7, 'Peralatan bengkel dari toko elektronik', '0', 2, 1, '2020-10-06 02:40:04', '2020-10-06 02:40:04'),
(8, 'Pembelian suku cadang komponen', '0', 2, 1, '2020-10-06 02:41:26', '2020-10-06 02:41:26'),
(9, 'pembayaran hutang ke toko elektronik', '0', 2, 1, '2020-10-06 02:42:58', '2020-10-06 02:42:58'),
(10, 'Pembelian suku cadang komponen', '0', 2, 1, '2020-10-06 02:43:47', '2020-10-06 02:43:47'),
(11, 'penggunaan suku cadang', '0', 2, 1, '2020-10-06 02:48:16', '2020-10-06 02:48:16'),
(12, 'Pendapatan cara perbaikan selevisi', '0', 2, 1, '2020-10-06 02:49:48', '2020-10-06 02:49:48'),
(13, 'Penarikan dana tunai pemilik', '0', 2, 1, '2020-10-06 02:50:30', '2020-10-06 02:50:30'),
(14, 'Sewa Tempat Selama Setahun', '0', 2, 1, '2020-10-21 00:23:35', '2020-10-21 00:23:35'),
(15, 'Pinjam Bank dengan bunga 20% selama setahun', '0', 2, 1, '2020-10-21 00:32:13', '2020-10-21 00:32:13'),
(16, 'Beli peralatan sebagai aset', '0', 2, 1, '2020-10-21 00:42:23', '2020-10-21 00:42:23'),
(18, 'Saldo Awal Dari Periode 2020', '0', 2, 1, '2020-12-09 06:45:54', '2020-12-09 06:45:54'),
(19, 'tes', '0', 2, 1, '2020-12-21 00:31:59', '2020-12-21 00:31:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_laba_rugi_ditahan_tahun_berhalan`
--

CREATE TABLE `k_laba_rugi_ditahan_tahun_berhalan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jumlah_laba_tahun_berjalan` bigint(20) NOT NULL DEFAULT 0,
  `id_sub_akun` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_master_akun`
--

CREATE TABLE `k_master_akun` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_m_akun` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_m_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_master_akun`
--

INSERT INTO `k_master_akun` (`id`, `kode_m_akun`, `nm_m_akun`, `created_at`, `updated_at`) VALUES
(1, '1-0000', 'Aktiva', NULL, NULL),
(2, '2-0000', 'Hutang', NULL, NULL),
(3, '3-0000', 'Modal', NULL, NULL),
(4, '4-0000', 'Pendapatan', NULL, NULL),
(5, '5-0000', 'HPP', NULL, NULL),
(6, '6-0000', 'Biaya', NULL, NULL),
(7, '7-0000', 'Pendapatan Lain', NULL, NULL),
(8, '8-0000', 'Biaya Lain', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_master_subsub_akun`
--

CREATE TABLE `k_master_subsub_akun` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_m_sub_akun` int(11) NOT NULL,
  `kode_m_subsub_akun` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_m_subsub_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_alur_kas` enum('-','0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=tidak masuk alur kas, 1=masuk alur kas',
  `off_on` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=akun non aktif, 1=akun aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_master_subsub_akun`
--

INSERT INTO `k_master_subsub_akun` (`id`, `id_m_sub_akun`, `kode_m_subsub_akun`, `nm_m_subsub_akun`, `status_alur_kas`, `off_on`, `created_at`, `updated_at`) VALUES
(1, 1, '1-1001', 'Kas', '-', '1', NULL, NULL),
(2, 1, '1-1002', 'Kas Bank Muamalat', '-', '1', NULL, NULL),
(3, 1, '1-1003', 'Kas BNI Syariah', '-', '1', NULL, NULL),
(4, 1, '1-1004', 'Kas BRI Syariah', '-', '1', NULL, NULL),
(5, 1, '1-1005', 'Kas Bank Syariah Mandiri', '-', '1', NULL, NULL),
(6, 1, '1-1006', 'Kas Bank Mega Syariah', '-', '1', NULL, NULL),
(7, 1, '1-1007', 'Kas BCA Syariah', '-', '1', NULL, NULL),
(8, 1, '1-1008', 'Kas BTPN', '-', '1', NULL, NULL),
(9, 1, '1-1009', 'Kas BNI', '-', '1', NULL, NULL),
(10, 1, '1-1010', 'Kas BRI ', '-', '1', NULL, NULL),
(11, 1, '1-1011', 'Kas Bank Mandiri', '-', '1', NULL, NULL),
(12, 1, '1-1012', 'Kas BTN', '-', '1', NULL, NULL),
(13, 1, '1-1013', 'Kas BPD', '-', '1', NULL, NULL),
(14, 1, '1-1014', 'Persediaan', '-', '1', NULL, NULL),
(15, 1, '1-1015', 'Persediaan barang dagang', '-', '1', NULL, NULL),
(16, 1, '1-1016', 'persediaan barang baku', '-', '1', NULL, NULL),
(17, 1, '1-1017', 'persediaan Barang dalam proses', '-', '1', NULL, NULL),
(18, 1, '1-1018', 'Persediaan Barang Jadi', '-', '1', NULL, NULL),
(19, 1, '1-1019', 'Persediaan Bahan Penolong', '-', '1', NULL, NULL),
(20, 1, '1-1020', 'Persediaan Lain Lain', '-', '1', NULL, NULL),
(21, 1, '1-1021', 'piutang dagang/usaha', '-', '1', NULL, NULL),
(22, 1, '1-1022', 'piutang kartu kredit', '-', '1', NULL, NULL),
(23, 1, '1-1023', 'piutang karyawan', '-', '1', NULL, NULL),
(24, 1, '1-1024', 'piutang wesel/wesel Tagih', '-', '1', NULL, NULL),
(25, 1, '1-1025', 'Cadangan Kerugian Piutang Tak Tertagih', '-', '1', NULL, NULL),
(26, 1, '1-1026', 'Perlengkapan', '-', '1', NULL, NULL),
(27, 1, '1-1027', 'Biaya di bayar di muka', '-', '1', NULL, NULL),
(28, 1, '1-1028', 'Pengeluaran di bayar di muka', '-', '1', NULL, NULL),
(29, 1, '1-1029', 'Sewa dibayar dimuka', '-', '1', NULL, NULL),
(30, 1, '1-1030', 'Asuransi di bayar di muka', '-', '1', NULL, NULL),
(31, 1, '1-1031', 'Iklan di bayar dimuka', '-', '1', NULL, NULL),
(32, 1, '1-1032', 'Gaji dibayar dimuka', '-', '1', NULL, NULL),
(33, 1, '1-1033', 'Pajak di bayar dimuka', '-', '1', NULL, NULL),
(34, 1, '1-1034', 'Bunga di bayar dimuka', '-', '1', NULL, NULL),
(35, 1, '1-1035', 'Pajak masukan/PPN Masukan', '-', '1', NULL, NULL),
(36, 1, '1-1036', 'Pajak masukan belum diterima', '-', '1', NULL, NULL),
(37, 2, '1-2001', 'Tanah', '-', '', NULL, NULL),
(38, 2, '1-2002', 'Gedung', '-', '1', NULL, NULL),
(39, 2, '1-2003', 'Peralatan', '-', '1', NULL, NULL),
(40, 2, '1-2004', 'Kendaraan', '-', '1', NULL, NULL),
(41, 2, '1-2005', 'Mesin ', '-', '1', NULL, NULL),
(42, 2, '1-2006', 'Akumulasi penyusutan gedung', '1', '1', NULL, NULL),
(43, 2, '1-2007', 'Akumulasi penyusutan peralatan', '1', '1', NULL, NULL),
(44, 2, '1-2008', 'Akumulasi penyusutan kendaraan', '1', '1', NULL, NULL),
(45, 2, '1-2009', 'Akumulasi mesin', '-', '1', NULL, NULL),
(46, 2, '1-2010', 'Investasi', '-', '1', NULL, NULL),
(47, 2, '1-2011', 'Deposito', '-', '1', NULL, NULL),
(48, 2, '1-2012', 'Piutang pajak ', '-', '1', NULL, NULL),
(49, 2, '1-2013', 'Kepemilikan Saham/obligasi', '-', '1', NULL, NULL),
(50, 3, '1-3001', 'Hak Paten', '-', '1', NULL, NULL),
(51, 3, '1-3002', 'Hak Cipta', '-', '1', NULL, NULL),
(52, 3, '1-3003', 'Merk Dagang', '-', '1', NULL, NULL),
(53, 3, '1-3004', 'Good Will', '-', '1', NULL, NULL),
(54, 3, '1-3005', 'Hak sewa', '-', '1', NULL, NULL),
(55, 3, '1-3006', 'Franchise', '-', '1', NULL, NULL),
(56, 3, '1-3007', 'Leasehold', '-', '1', NULL, NULL),
(57, 4, '2-1001', 'Hutang Dagang/Usaha', '-', '1', NULL, NULL),
(58, 4, '2-1002', 'Hutang  kartu kredit', '-', '1', NULL, NULL),
(59, 4, '2-1003', 'Hutang konsinyasi', '-', '1', NULL, NULL),
(60, 4, '2-1004', 'Wesel bayar', '-', '1', NULL, NULL),
(61, 4, '2-1005', 'Hutang gaji', '-', '1', NULL, NULL),
(62, 4, '2-1006', 'Hutang Bonus', '-', '1', NULL, NULL),
(63, 4, '2-1007', 'Hutang PPH 21', '-', '1', NULL, NULL),
(64, 4, '2-1008', 'Hutang Hadiah', '-', '1', NULL, NULL),
(65, 4, '2-1009', 'Hutang Garansi', '-', '1', NULL, NULL),
(66, 4, '2-1010', 'hutang sewa', '-', '1', NULL, NULL),
(67, 4, '2-1011', 'Hutang Beban (Biaya yang harus di bayar)', '-', '1', NULL, NULL),
(68, 4, '2-1012', 'Penerimaan uang muka', '-', '1', NULL, NULL),
(69, 4, '2-1013', 'Sewa di terima di muka', '-', '1', NULL, NULL),
(70, 4, '2-1014', 'Pendapatan di terima di muka', '-', '1', NULL, NULL),
(71, 4, '2-1015', 'PPN Keluaran/Pajak Keluaran', '-', '1', NULL, NULL),
(72, 4, '2-1016', 'Hutang pajak/PPN', '-', '1', NULL, NULL),
(73, 4, '2-1017', 'Pajak keluaran belum terbit', '-', '1', NULL, NULL),
(74, 4, '2-1018', 'Hutang Dividen', '-', '1', NULL, NULL),
(75, 5, '2-2001', 'Hutang Bank', '-', '1', NULL, NULL),
(76, 5, '2-2002', 'HUTANG BRI', '-', '1', NULL, NULL),
(77, 5, '2-2003', 'HUTANG  BNI', '-', '1', NULL, NULL),
(78, 5, '2-2004', 'HUTANG BANK Muamalat', '-', '1', NULL, NULL),
(79, 5, '2-2005', 'HUTANG  BRI Syariah', '-', '1', NULL, NULL),
(80, 5, '2-2006', 'Hutang Koperasi', '-', '1', NULL, NULL),
(81, 5, '2-2007', 'Hutang Hipotik', '-', '1', NULL, NULL),
(82, 5, '2-2008', 'Hutang Obligasi', '-', '1', NULL, NULL),
(83, 28, '6-1001', 'Biaya gaji karyawan', '-', '1', NULL, NULL),
(84, 28, '6-1002', 'Biaya Gaji Freelancer', '-', '1', NULL, NULL),
(85, 28, '6-1003', 'biaya gaji tenaga ahli', '-', '1', NULL, NULL),
(86, 28, '6-1004', 'biaya honor', '-', '1', NULL, NULL),
(87, 28, '6-1005', 'Biaya Bonus & insentif', '-', '1', NULL, NULL),
(88, 29, '6-2001', 'Biaya Iklan', '-', '1', NULL, NULL),
(89, 29, '6-2002', 'Biaya iklan koran', '-', '1', NULL, NULL),
(90, 29, '6-2003', 'Biaya iklan radio', '-', '1', NULL, NULL),
(91, 29, '6-2004', 'Biaya You Tube ads', '-', '1', NULL, NULL),
(92, 29, '6-2005', 'Biaya  IG ads', '-', '1', NULL, NULL),
(93, 29, '6-2006', 'Biaya  FB ads', '-', '1', NULL, NULL),
(94, 29, '6-2007', 'Biaya  google ads', '-', '1', NULL, NULL),
(95, 30, '6-3001', 'biaya listrik', '-', '1', NULL, NULL),
(96, 30, '6-3002', 'biaya internet', '-', '1', NULL, NULL),
(97, 30, '6-3003', 'biaya air', '-', '1', NULL, NULL),
(98, 30, '6-3004', 'biaya gas', '-', '1', NULL, NULL),
(99, 30, '6-3005', 'biaya telepon', '-', '1', NULL, NULL),
(100, 30, '6-3006', 'biaya keamanan', '-', '1', NULL, NULL),
(101, 30, '6-3007', 'biaya kebersihan', '-', '1', NULL, NULL),
(102, 30, '6-3008', 'biaya makan', '-', '1', NULL, NULL),
(103, 30, '6-3009', 'biaya perjalanan dinas', '-', '1', NULL, NULL),
(104, 30, '6-3010', 'Biaya asuransi (BPJS)', '-', '1', NULL, NULL),
(105, 30, '6-3011', 'biaya medis', '-', '1', NULL, NULL),
(106, 30, '6-3012', 'biaya kirim', '-', '1', NULL, NULL),
(107, 30, '6-3013', 'biaya transportasi  dan BBM', '-', '1', NULL, NULL),
(108, 30, '6-3014', 'biaya cetak & penggandaan', '-', '1', NULL, NULL),
(109, 30, '6-3015', 'biaya ATK dan foto copy', '-', '1', NULL, NULL),
(110, 30, '6-3016', 'biaya service dan pemeliharaan', '-', '1', NULL, NULL),
(111, 30, '6-3017', 'Biaya Perlengkapan kantor', '-', '1', NULL, NULL),
(112, 30, '6-3018', 'Biaya Penyusutan Gedung', '-', '1', NULL, NULL),
(113, 30, '6-3019', 'Biaya penyusutan kendaraan', '-', '1', NULL, NULL),
(114, 30, '6-3020', 'Biaya penyusutan peralatan', '-', '1', NULL, NULL),
(115, 30, '6-3021', 'Biaya penyusutan mesin', '-', '1', NULL, NULL),
(116, 30, '6-3022', 'biaya sewa kendaraan', '-', '1', NULL, NULL),
(117, 30, '6-3023', 'biaya perawatan kendaraan', '-', '1', NULL, NULL),
(118, 30, '6-3024', 'Biaya Sewa Toko', '-', '1', NULL, NULL),
(119, 30, '6-3025', 'Biaya Kerugian Piutang Tak Tertagih', '-', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_master_sub_akun`
--

CREATE TABLE `k_master_sub_akun` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_m_akun` int(11) NOT NULL,
  `kode_m_sub_akun` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_m_sub_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_on` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=akun non aktif, 1=akun aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_master_sub_akun`
--

INSERT INTO `k_master_sub_akun` (`id`, `id_m_akun`, `kode_m_sub_akun`, `nm_m_sub_akun`, `off_on`, `created_at`, `updated_at`) VALUES
(1, 1, '1-1000', 'Aktiva Lancar', '1', NULL, NULL),
(2, 1, '1-2000', 'Aktiva Tetap', '1', NULL, NULL),
(3, 1, '1-3000', 'Aktiva Tetap Tidak Berwujud', '1', NULL, NULL),
(4, 2, '2-1000', 'Hutang Lancar', '1', NULL, NULL),
(5, 2, '2-2000', 'Hutang Jangka Panjang', '1', NULL, NULL),
(6, 3, '3-0001', 'Modal Usaha', '1', NULL, NULL),
(7, 3, '3-0002', 'Modal Saham', '1', NULL, NULL),
(8, 3, '3-0003', 'Disagio Saham', '1', NULL, NULL),
(9, 3, '3-0004', 'Prive', '1', NULL, NULL),
(10, 3, '3-0005', 'Dividen', '1', NULL, NULL),
(11, 3, '3-0006', 'laba di tahan / Saldo laba', '1', NULL, NULL),
(12, 3, '3-0007', 'Laba di tahan Tahun Berjalan', '1', NULL, NULL),
(13, 3, '3-0008', 'Ikhtisar Laba Rugi', '1', NULL, NULL),
(14, 3, '3-0009', 'Saldo penyeimbang (historical balance)', '1', NULL, NULL),
(15, 4, '4-0001', 'Pendapatan Jasa', '1', NULL, NULL),
(16, 4, '4-0002', 'pendapatan dagang', '1', NULL, NULL),
(17, 4, '4-0003', 'pendapatan jual (penjualan)', '1', NULL, NULL),
(18, 4, '4-0004', 'Return Penjualan', '1', NULL, NULL),
(19, 4, '4-0005', 'Potongan Penjualan', '1', NULL, NULL),
(20, 4, '4-0006', 'Biaya angkut penjualan', '1', NULL, NULL),
(21, 5, '5-0001', 'Harga Pokok Penjualan (HPP)', '1', NULL, NULL),
(22, 5, '5-0002', 'Pembelian', '1', NULL, NULL),
(23, 5, '5-0003', 'Biaya angkut pembelian', '1', NULL, NULL),
(24, 5, '5-0004', 'return pembelian', '1', NULL, NULL),
(25, 5, '5-0005', 'Pengaturan stok', '1', NULL, NULL),
(26, 5, '5-0006', 'potongan pembelian', '1', NULL, NULL),
(27, 5, '5-0007', 'Pengurangan harga/diskon', '1', NULL, NULL),
(28, 6, '6-1000', 'Biaya Gaji ', '1', NULL, NULL),
(29, 6, '6-2000', 'Biaya Pemasaran', '1', NULL, NULL),
(30, 6, '6-3000', 'Biaya Operasional', '1', NULL, NULL),
(31, 7, '7-0001', 'Pendapatan Bunga', '1', NULL, NULL),
(32, 7, '7-0002', 'Pendapatan Deposito', '1', NULL, NULL),
(33, 7, '7-0003', 'pendapatan sewa', '1', NULL, NULL),
(34, 7, '7-0004', 'pendapatan dividen saham', '1', NULL, NULL),
(35, 7, '7-0005', 'laba atas selisih kurs', '1', NULL, NULL),
(36, 8, '8-0001', 'Biaya Bunga', '1', NULL, NULL),
(37, 8, '8-0002', 'Biaya Denda', '1', NULL, NULL),
(38, 8, '8-0003', 'Biaya Pajak Penghasilan', '1', NULL, NULL),
(39, 8, '8-0004', 'Biaya administrasi Bank', '1', NULL, NULL),
(40, 8, '8-0005', 'Rugi selisih kurs', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_posisi_saldo`
--

CREATE TABLE `k_posisi_saldo` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_akun` int(10) UNSIGNED NOT NULL,
  `id_sub_akun` int(10) UNSIGNED NOT NULL,
  `id_sub_sub_akun` int(10) UNSIGNED NOT NULL,
  `posisi_saldo` enum('d','k') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_rencana_pend_barang`
--

CREATE TABLE `k_rencana_pend_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `target_brg_terjual` int(11) NOT NULL,
  `target_klien_beli` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_rencana_pend_jasa`
--

CREATE TABLE `k_rencana_pend_jasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jasa` int(10) UNSIGNED NOT NULL,
  `target_jasa_terjual` int(11) NOT NULL,
  `target_klien_beli` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_rencana_pengeluaran`
--

CREATE TABLE `k_rencana_pengeluaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_subsub_akun` int(10) UNSIGNED NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_saldo_awal`
--

CREATE TABLE `k_saldo_awal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_akun_aktif` int(10) UNSIGNED NOT NULL,
  `jumlah_saldo_awal` bigint(20) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_subsub_akun_ukm`
--

CREATE TABLE `k_subsub_akun_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sub_akun_ukm` int(10) UNSIGNED NOT NULL,
  `id_sub_sub_master_akun` int(12) DEFAULT 0,
  `kode_subsub_akun` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_subsub_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_alur_kas` enum('-','0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=tidak masuk alur kas, 1=masuk alur kas',
  `off_on` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=akun non aktif, 1=akun aktif',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `posisi_saldo` enum('D','K') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_subsub_akun_ukm`
--

INSERT INTO `k_subsub_akun_ukm` (`id`, `id_sub_akun_ukm`, `id_sub_sub_master_akun`, `kode_subsub_akun`, `nm_subsub_akun`, `status_alur_kas`, `off_on`, `id_perusahaan`, `id_karyawan`, `posisi_saldo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1-1001', 'Kas', '-', '1', 2, 1, 'D', '2019-10-21 00:12:16', '2019-10-21 00:12:16'),
(2, 1, 2, '1-1002', 'Kas Bank Muamalat', '-', '1', 2, 1, 'D', '2019-10-21 00:12:16', '2019-10-21 00:12:16'),
(3, 1, 3, '1-1003', 'Kas BNI Syariah', '-', '1', 2, 1, 'D', '2019-10-21 00:12:16', '2019-10-21 00:12:16'),
(4, 1, 4, '1-1004', 'Kas BRI Syariah', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(5, 1, 5, '1-1005', 'Kas Bank Syariah Mandiri', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(6, 1, 6, '1-1006', 'Kas Bank Mega Syariah', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(7, 1, 7, '1-1007', 'Kas BCA Syariah', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(8, 1, 8, '1-1008', 'Kas BTPN', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(9, 1, 9, '1-1009', 'Kas BNI', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(10, 1, 10, '1-1010', 'Kas BRI ', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(11, 1, 11, '1-1011', 'Kas Bank Mandiri', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(12, 1, 12, '1-1012', 'Kas BTN', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(13, 1, 13, '1-1013', 'Kas BPD', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(14, 1, 14, '1-1014', 'Persediaan', '1', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(15, 1, 15, '1-1015', 'Persediaan barang dagang', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(16, 1, 16, '1-1016', 'persediaan barang baku', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(17, 1, 17, '1-1017', 'persediaan Barang dalam proses', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(18, 1, 18, '1-1018', 'Persediaan Barang Jadi', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(19, 1, 19, '1-1019', 'Persediaan Bahan Penolong', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(20, 1, 20, '1-1020', 'Persediaan Lain Lain', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(21, 1, 21, '1-1021', 'piutang dagang/usaha', '1', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(22, 1, 22, '1-1022', 'piutang kartu kredit', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(23, 1, 23, '1-1023', 'piutang karyawan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(24, 1, 24, '1-1024', 'piutang wesel/wesel Tagih', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(25, 1, 25, '1-1025', 'Cadangan Kerugian Piutang Tak Tertagih', '-', '1', 2, 1, 'K', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(26, 1, 26, '1-1026', 'Perlengkapan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(27, 1, 27, '1-1027', 'Biaya di bayar di muka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(28, 1, 28, '1-1028', 'Pengeluaran di bayar di muka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(29, 1, 29, '1-1029', 'Sewa dibayar dimuka', '1', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(30, 1, 30, '1-1030', 'Asuransi di bayar di muka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(31, 1, 31, '1-1031', 'Iklan di bayar dimuka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(32, 1, 32, '1-1032', 'Gaji dibayar dimuka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:17', '2019-10-21 00:12:17'),
(33, 1, 33, '1-1033', 'Pajak di bayar dimuka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(34, 1, 34, '1-1034', 'Bunga di bayar dimuka', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(35, 1, 35, '1-1035', 'Pajak masukan/PPN Masukan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(36, 1, 36, '1-1036', 'Pajak masukan belum diterima', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(37, 2, 37, '1-2001', 'Tanah', '1', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(38, 2, 38, '1-2002', 'Gedung', '1', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(39, 2, 39, '1-2003', 'Peralatan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(40, 2, 40, '1-2004', 'Kendaraan', '1', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(41, 2, 41, '1-2005', 'Mesin ', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(42, 2, 42, '1-2006', 'Akumulasi penyusutan gedung', '1', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(43, 2, 43, '1-2007', 'Akumulasi penyusutan peralatan', '1', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(44, 2, 44, '1-2008', 'Akumulasi penyusutan kendaraan', '1', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(45, 2, 45, '1-2009', 'Akumulasi mesin', '1', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(46, 2, 46, '1-2010', 'Investasi', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(47, 2, 47, '1-2011', 'Deposito', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(48, 2, 48, '1-2012', 'Piutang pajak ', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(49, 2, 49, '1-2013', 'Kepemilikan Saham/obligasi', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(50, 3, 50, '1-3001', 'Hak Paten', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(51, 3, 51, '1-3002', 'Hak Cipta', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(52, 3, 52, '1-3003', 'Merk Dagang', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(53, 3, 53, '1-3004', 'Good Will', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(54, 3, 54, '1-3005', 'Hak sewa', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(55, 3, 55, '1-3006', 'Franchise', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(56, 3, 56, '1-3007', 'Leasehold', '-', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(57, 4, 57, '2-1001', 'Hutang Dagang/Usaha', '1', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(58, 4, 58, '2-1002', 'Hutang  kartu kredit', '-', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(59, 4, 59, '2-1003', 'Hutang konsinyasi', '-', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(60, 4, 60, '2-1004', 'Wesel bayar', '-', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(61, 4, 61, '2-1005', 'Hutang gaji', '-', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(62, 4, 62, '2-1006', 'Hutang Bonus', '-', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(63, 4, 63, '2-1007', 'Hutang PPH 21', '1', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(64, 4, 64, '2-1008', 'Hutang Hadiah', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(65, 4, 65, '2-1009', 'Hutang Garansi', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(66, 4, 66, '2-1010', 'hutang sewa', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(67, 4, 67, '2-1011', 'Hutang Beban (Biaya yang harus di bayar)', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(68, 4, 68, '2-1012', 'Penerimaan uang muka', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(69, 4, 69, '2-1013', 'Sewa di terima di muka', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(70, 4, 70, '2-1014', 'Pendapatan di terima di muka', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(71, 4, 71, '2-1015', 'PPN Keluaran/Pajak Keluaran', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(72, 4, 72, '2-1016', 'Hutang pajak/PPN', '1', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(73, 4, 73, '2-1017', 'Pajak keluaran belum terbit', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(74, 4, 74, '2-1018', 'Hutang Dividen', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(75, 5, 75, '2-2001', 'Hutang Bank', '1', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(76, 5, 76, '2-2002', 'HUTANG BRI', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(77, 5, 77, '2-2003', 'HUTANG  BNI', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(78, 5, 78, '2-2004', 'HUTANG BANK Muamalat', '1', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(79, 5, 79, '2-2005', 'HUTANG  BRI Syariah', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(80, 5, 80, '2-2006', 'Hutang Koperasi', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(81, 5, 81, '2-2007', 'Hutang Hipotik', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(82, 5, 82, '2-2008', 'Hutang Obligasi', '-', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(83, 28, 83, '6-1001', 'Biaya gaji karyawan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(84, 28, 84, '6-1002', 'Biaya Gaji Freelancer', '-', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(85, 28, 85, '6-1003', 'biaya gaji tenaga ahli', '-', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(86, 28, 86, '6-1004', 'biaya honor', '-', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(87, 28, 87, '6-1005', 'Biaya Bonus & insentif', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(88, 29, 88, '6-2001', 'Biaya Iklan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(89, 29, 89, '6-2002', 'Biaya iklan koran', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(90, 29, 90, '6-2003', 'Biaya iklan radio', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(91, 29, 91, '6-2004', 'Biaya You Tube ads', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(92, 29, 92, '6-2005', 'Biaya  IG ads', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(93, 29, 93, '6-2006', 'Biaya  FB ads', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(94, 29, 94, '6-2007', 'Biaya  google ads', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(95, 30, 95, '6-3001', 'biaya listrik', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(96, 30, 96, '6-3002', 'biaya internet', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(97, 30, 97, '6-3003', 'biaya air', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(98, 30, 98, '6-3004', 'biaya gas', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(99, 30, 99, '6-3005', 'biaya telepon', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(100, 30, 100, '6-3006', 'biaya keamanan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(101, 30, 101, '6-3007', 'biaya kebersihan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(102, 30, 102, '6-3008', 'biaya makan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(103, 30, 103, '6-3009', 'biaya perjalanan dinas', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(104, 30, 104, '6-3010', 'Biaya asuransi (BPJS)', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(105, 30, 105, '6-3011', 'biaya medis', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(106, 30, 106, '6-3012', 'biaya kirim', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(107, 30, 107, '6-3013', 'biaya transportasi  dan BBM', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(108, 30, 108, '6-3014', 'biaya cetak & penggandaan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(109, 30, 109, '6-3015', 'biaya ATK dan foto copy', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(110, 30, 110, '6-3016', 'biaya service dan pemeliharaan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(111, 30, 111, '6-3017', 'Biaya Perlengkapan kantor', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(112, 30, 112, '6-3018', 'Biaya Penyusutan Gedung', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(113, 30, 113, '6-3019', 'Biaya penyusutan kendaraan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(114, 30, 114, '6-3020', 'Biaya penyusutan peralatan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(115, 30, 115, '6-3021', 'Biaya penyusutan mesin', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(116, 30, 116, '6-3022', 'biaya sewa kendaraan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(117, 30, 117, '6-3023', 'biaya perawatan kendaraan', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(118, 30, 118, '6-3024', 'Biaya Sewa Toko', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(119, 30, 119, '6-3025', 'Biaya Kerugian Piutang Tak Tertagih', '-', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_sub_akun_ukm`
--

CREATE TABLE `k_sub_akun_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_akun_ukm` int(10) UNSIGNED NOT NULL,
  `id_m_sub_akun` int(12) DEFAULT 0,
  `kode_sub_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_sub_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_on` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=akun non aktif, 1=akun aktif',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `posisi_saldo` enum('D','K') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_sub_akun_ukm`
--

INSERT INTO `k_sub_akun_ukm` (`id`, `id_akun_ukm`, `id_m_sub_akun`, `kode_sub_akun`, `nm_sub_akun`, `off_on`, `id_perusahaan`, `id_karyawan`, `posisi_saldo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1-1000', 'Aktiva Lancar', '1', 2, 1, 'D', '2019-10-21 00:12:16', '2019-10-21 00:12:16'),
(2, 1, 2, '1-2000', 'Aktiva Tetap', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(3, 1, 3, '1-3000', 'Aktiva Tetap Tidak Berwujud', '1', 2, 1, 'D', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(4, 2, 4, '2-1000', 'Hutang Lancar', '1', 2, 1, 'K', '2019-10-21 00:12:18', '2019-10-21 00:12:18'),
(5, 2, 5, '2-2000', 'Hutang Jangka Panjang', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(6, 3, 6, '3-0001', 'Modal Usaha', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(7, 3, 7, '3-0002', 'Modal Saham', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(8, 3, 8, '3-0003', 'Disagio Saham', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(9, 3, 9, '3-0004', 'Prive', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(10, 3, 10, '3-0005', 'Dividen', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(11, 3, 11, '3-0006', 'laba di tahan / Saldo laba', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(12, 3, 12, '3-0007', 'Laba di tahan Tahun Berjalan', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(13, 3, 13, '3-0008', 'Ikhtisar Laba Rugi', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(14, 3, 14, '3-0009', 'Saldo penyeimbang (historical balance)', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(15, 4, 15, '4-0001', 'Pendapatan Jasa', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(16, 4, 16, '4-0002', 'pendapatan dagang', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(17, 4, 17, '4-0003', 'pendapatan jual (penjualan)', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(18, 4, 18, '4-0004', 'Return Penjualan', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(19, 4, 19, '4-0005', 'Potongan Penjualan', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(20, 4, 20, '4-0006', 'Biaya angkut penjualan', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(21, 5, 21, '5-0001', 'Harga Pokok Penjualan (HPP)', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(22, 5, 22, '5-0002', 'Pembelian', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(23, 5, 23, '5-0003', 'Biaya angkut pembelian', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(24, 5, 24, '5-0004', 'return pembelian', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(25, 5, 25, '5-0005', 'Pengaturan stok', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(26, 5, 26, '5-0006', 'potongan pembelian', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(27, 5, 27, '5-0007', 'Pengurangan harga/diskon', '1', 2, 1, 'K', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(28, 6, 28, '6-1000', 'Biaya Gaji ', '1', 2, 1, 'D', '2019-10-21 00:12:19', '2019-10-21 00:12:19'),
(29, 6, 29, '6-2000', 'Biaya Pemasaran', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(30, 6, 30, '6-3000', 'Biaya Operasional', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(31, 7, 31, '7-0001', 'Pendapatan Bunga', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(32, 7, 32, '7-0002', 'Pendapatan Deposito', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(33, 7, 33, '7-0003', 'pendapatan sewa', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(34, 7, 34, '7-0004', 'pendapatan dividen saham', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(35, 7, 35, '7-0005', 'laba atas selisih kurs', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(36, 8, 36, '8-0001', 'Biaya Bunga', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(37, 8, 37, '8-0002', 'Biaya Denda', '1', 2, 1, 'K', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(38, 8, 38, '8-0003', 'Biaya Pajak Penghasilan', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(39, 8, 39, '8-0004', 'Biaya administrasi Bank', '1', 2, 1, 'D', '2019-10-21 00:12:20', '2019-10-21 00:12:20'),
(40, 8, 40, '8-0005', 'Rugi selisih kurs', '1', 2, 1, 'D', '2019-10-21 00:12:21', '2019-10-21 00:12:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_tahun_buku`
--

CREATE TABLE `k_tahun_buku` (
  `id` int(10) UNSIGNED NOT NULL,
  `bln_buku` int(11) NOT NULL,
  `thn_buku` year(4) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=tidak aktif, 1=aktif',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_tahun_buku`
--

INSERT INTO `k_tahun_buku` (`id`, `bln_buku`, `thn_buku`, `status`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(4, 12, 2020, '1', 2, 1, '2020-12-15 01:45:50', '2020-12-15 02:21:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_transaksi`
--

CREATE TABLE `k_transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ket_transaksi` int(10) UNSIGNED NOT NULL,
  `jenis_transaksi` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Penerimaan, 1: Pengeluaran',
  `id_akun_aktif` int(10) UNSIGNED NOT NULL,
  `posisi_akun` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Debet, 1: Kredit',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `k_transaksi`
--

INSERT INTO `k_transaksi` (`id`, `id_ket_transaksi`, `jenis_transaksi`, `id_akun_aktif`, `posisi_akun`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(9, 4, '0', 2, '0', 2, 1, '2020-10-06 02:35:33', '2020-10-06 02:35:33'),
(10, 4, '0', 88, '1', 2, 1, '2020-10-06 02:35:33', '2020-10-06 02:35:33'),
(11, 5, '0', 148, '0', 2, 1, '2020-10-06 02:36:51', '2020-10-06 02:36:51'),
(12, 5, '0', 2, '1', 2, 1, '2020-10-06 02:36:51', '2020-10-06 02:36:51'),
(13, 6, '0', 2, '0', 2, 1, '2020-10-06 02:38:49', '2020-10-06 02:38:49'),
(14, 6, '0', 82, '1', 2, 1, '2020-10-06 02:38:49', '2020-10-06 02:38:49'),
(15, 7, '0', 41, '0', 2, 1, '2020-10-06 02:40:04', '2020-10-06 02:40:04'),
(16, 7, '0', 2, '1', 2, 1, '2020-10-06 02:40:04', '2020-10-06 02:40:04'),
(17, 8, '0', 15, '0', 2, 1, '2020-10-06 02:41:26', '2020-10-06 02:41:26'),
(18, 8, '0', 61, '1', 2, 1, '2020-10-06 02:41:26', '2020-10-06 02:41:26'),
(19, 9, '0', 61, '0', 2, 1, '2020-10-06 02:42:58', '2020-10-06 02:42:58'),
(20, 9, '0', 2, '1', 2, 1, '2020-10-06 02:42:58', '2020-10-06 02:42:58'),
(21, 10, '0', 15, '0', 2, 1, '2020-10-06 02:43:47', '2020-10-06 02:43:47'),
(22, 10, '0', 2, '1', 2, 1, '2020-10-06 02:43:47', '2020-10-06 02:43:47'),
(23, 11, '0', 140, '0', 2, 1, '2020-10-06 02:48:16', '2020-10-06 02:48:16'),
(24, 11, '0', 15, '1', 2, 1, '2020-10-06 02:48:16', '2020-10-06 02:48:16'),
(25, 12, '0', 2, '0', 2, 1, '2020-10-06 02:49:48', '2020-10-06 02:49:48'),
(26, 12, '0', 97, '1', 2, 1, '2020-10-06 02:49:48', '2020-10-06 02:49:48'),
(27, 13, '0', 91, '0', 2, 1, '2020-10-06 02:50:30', '2020-10-06 02:50:30'),
(28, 13, '0', 2, '1', 2, 1, '2020-10-06 02:50:30', '2020-10-06 02:50:30'),
(29, 14, '0', 30, '0', 2, 1, '2020-10-21 00:23:35', '2020-10-21 00:23:35'),
(30, 14, '0', 148, '1', 2, 1, '2020-10-21 00:23:35', '2020-10-21 00:23:35'),
(31, 15, '0', 155, '0', 2, 1, '2020-10-21 00:32:14', '2020-10-21 00:32:14'),
(32, 15, '0', 80, '1', 2, 1, '2020-10-21 00:32:14', '2020-10-21 00:32:14'),
(33, 16, '0', 144, '0', 2, 1, '2020-10-21 00:42:23', '2020-10-21 00:42:23'),
(34, 16, '0', 45, '1', 2, 1, '2020-10-21 00:42:23', '2020-10-21 00:42:23'),
(35, 19, '0', 1, '0', 2, 1, '2020-12-21 00:31:59', '2020-12-21 00:31:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_02_26_013834_create_u_user_ukm', 1),
(2, '2019_02_26_015758_create_u_perusahaan', 2),
(4, '2019_02_26_024417_create_u_menu', 4),
(5, '2019_02_26_030129_create_u_master_submenu', 4),
(6, '2019_02_26_030617_create_relation_menu_sub_menu', 5),
(7, '2019_02_26_031449_create_menu_ukm', 6),
(8, '2019_02_26_031640_create_submenu_ukm', 6),
(9, '2019_02_26_032102_create_relation_menu_ukm', 7),
(10, '2019_02_26_032434_create_relation_submenu_ukm', 7),
(11, '2019_02_26_033753_create_u_menu_karyawan', 8),
(12, '2019_02_26_035959_create_h_karyawan', 9),
(13, '2019_02_26_034603_create_relation_menu_karyawan', 10),
(17, '2019_02_26_063405_create_provinsi', 13),
(19, '2019_02_26_063507_create_kab', 14),
(20, '2019_02_26_063626_create_relation_kabupaten', 15),
(21, '2019_02_26_060918_create_relation_h_hrd', 16),
(22, '2019_02_26_062518_create_k_investor', 17),
(23, '2019_02_26_064242_create_relasi_k_investor', 18),
(24, '2019_02_26_021501_table_relasi_ukm_perusahaan', 19),
(25, '2019_02_27_012738_create_u_akta', 20),
(26, '2019_02_27_013553_create_relation_u_akta', 21),
(27, '2019_02_27_014916_create_u_ijin_usaha', 22),
(28, '2019_02_27_015816_create_relasi_ijin_usaha', 23),
(29, '2019_02_27_020647_create_a_model_bisnis', 24),
(30, '2019_02_27_020939_create_relasi_a_model_bisnis', 25),
(31, '2019_02_27_021133_create_a_visi_p', 26),
(32, '2019_02_27_021628_create_relasi_a_visi_p', 27),
(33, '2019_02_27_021821_create_a_misi_p', 28),
(34, '2019_02_27_022203_create_relasi_a_misi_p', 29),
(36, '2019_02_27_023623_create_a_bagian_p', 30),
(37, '2019_02_27_024141_create_relasi_u_bagian_p', 31),
(38, '2019_02_27_024249_create_u_devisi_p', 32),
(39, '2019_02_27_024612_create_relasi_u_devisi_p', 33),
(41, '2019_02_27_025206_create_u_jabatan_p', 34),
(42, '2019_02_27_025735_create_relation_jabatan_p', 35),
(43, '2019_02_27_030312_create_u_job_desc', 36),
(44, '2019_02_27_030610_create_relasi_job_decs', 37),
(45, '2019_02_27_030808_create_u_swot', 38),
(46, '2019_02_27_031027_create_relasi_u_swot', 39),
(47, '2019_02_27_031317_create_u_strategi_jpg', 40),
(48, '2019_02_27_031609_create_relasi_strategi_jpg', 41),
(49, '2019_02_27_031816_create_u_strategi_jpd', 42),
(50, '2019_02_27_032128_create_relatsi_stategi_jpd', 43),
(51, '2019_02_27_070536_create_u_profil_user', 44),
(53, '2019_03_23_013925_create_struktur_perusahaan', 46),
(54, '2019_03_18_030813_create_relation_menu_investor', 47),
(55, '2019_03_23_014554_create_relation_struktur_perusahaan', 47),
(56, '2019_03_25_062232_create_h_alamat_asal', 48),
(57, '2019_03_26_010417_create_alamat_sekarang', 48),
(58, '2019_03_26_010550_create_relation_h_alamat_asal', 49),
(59, '2019_03_26_010610_create_relation_h_alamat_sek', 49),
(60, '2019_03_27_010548_create_h_keluarga_ky', 50),
(61, '2019_03_27_011023_create_relation_h_keluarga_ky', 51),
(62, '2019_03_28_011631_create_h_email_k', 52),
(63, '2019_03_28_011837_create_relation_h_email_k', 53),
(64, '2019_03_28_021411_create_h_hp_ky', 54),
(65, '2019_03_28_021644_create_relation_h_hp_ky', 55),
(66, '2019_03_29_013008_create_a_klien', 56),
(67, '2019_03_29_061547_create_a_surat_masuk', 57),
(68, '2019_03_29_061900_create_relation_surat_masuk', 58),
(69, '2019_04_01_023316_create_a_jenis_surat', 59),
(70, '2019_04_01_035046_create_a_surat_keluar', 60),
(71, '2019_04_01_035413_create_relation_a_surat_keluar', 61),
(72, '2019_04_02_022723_create_a_jenis_proposal', 62),
(73, '2019_04_02_024548_create_a_proposal', 63),
(74, '2019_04_02_031639_create_relation_a_proposal', 64),
(75, '2019_04_06_011511_create_a_jenis_arsip', 65),
(76, '2019_04_06_030058_create_a_arsip', 66),
(77, '2019_04_06_030359_create_relation_a_arsip', 67),
(78, '2019_04_08_010458_create_a_spk', 68),
(79, '2019_04_08_011444_create_relation_a_spk', 69),
(80, '2019_04_09_011037_create_a_ba_pemeriksaan', 70),
(81, '2019_04_10_031846_create_a_ba_kemajuan', 71),
(82, '2019_04_10_062817_create_relation_a_ba_kemajuan', 72),
(83, '2019_04_12_015249_create_a_ba_penyelesaian', 73),
(84, '2019_04_12_015656_create_a_relation_ba_penyelesaian', 74),
(85, '2019_04_13_014744_create_a_ba_sertim', 75),
(86, '2019_04_13_015003_create_relation_a_ba_sertim', 76),
(87, '2019_04_15_014751_create_a_ba_serops', 77),
(88, '2019_04_15_015229_create_relation_a_ba_serops', 78),
(91, '2019_04_12_024828_create_a_peralatan', 81),
(92, '2019_04_15_012051_add_satuan_to_a_peralatan', 81),
(93, '2019_04_20_014722_create_jenis_rapat', 81),
(94, '2019_04_15_062528_create_a_usulan_brifing', 82),
(95, '2019_04_12_030756_create_relasi_peralatan', 83),
(96, '2019_04_15_063014_create_relation_a_usulan_brifing', 83),
(97, '2019_04_22_010845_create_brifing_rapat', 84),
(98, '2019_04_22_011626_create_relation_brifing', 85),
(99, '2019_04_23_033425_create_p_kategori_produk', 86),
(100, '2019_04_23_033706_create_p_subkategori_produk', 87),
(101, '2019_04_23_034054_create_p_subkategori_produk', 88),
(102, '2019_04_23_034247_create_p_subsubkategori_produk', 89),
(103, '2019_04_23_034436_create_p_subsubkategori_produk', 90),
(104, '2019_04_23_062544_create_p_jasa', 91),
(105, '2019_04_23_063353_create_relation_p_jasa', 92),
(106, '2019_04_24_060551_create_p_barang', 93),
(107, '2019_04_24_061257_create_relation_p_barang', 94),
(108, '2019_04_25_060312_create_p_supplier', 95),
(109, '2019_04_26_005549_create_p_jual_jasa', 96),
(110, '2019_04_26_010108_create_relation_p_jual_jasa', 97),
(111, '2019_04_26_024806_create_p_beli_barang', 98),
(112, '2019_04_26_025051_create_relation_p_beli_barang', 99),
(113, '2019_04_30_010458_create_p_jual_barang', 100),
(114, '2019_04_30_010822_create_relation_p_jual_barang', 101),
(115, '2019_04_30_060701_create_p_proyek', 102),
(116, '2019_04_30_061106_create_relation_p_proyek', 103),
(117, '2019_05_02_024821_create_p_tim_proyek', 104),
(118, '2019_05_02_030119_create_relation_p_tim_proyek', 105),
(119, '2019_05_04_020007_create_p_task_proyek', 106),
(120, '2019_05_04_020559_create_p_task_proyek', 107),
(121, '2019_05_04_053739_create_p_jadwal_proyek', 108),
(122, '2019_05_04_054811_create_relation_p_jadwal_proyek', 109),
(123, '2019_05_08_033256_create_p_progress_proyek', 110),
(124, '2019_05_08_033701_create_relation_progress_proyek', 111),
(125, '2019_05_09_011608_create_p_jenis_p', 112),
(126, '2019_05_09_012046_create_p_pemeliharaan', 113),
(127, '2019_05_09_012843_create_relation_p_pemeliharaan', 114),
(128, '2019_05_10_010441_create_p_progress_pemeliharaan', 115),
(129, '2019_05_10_011351_create_relation_p_progress_pemeliharaan', 116),
(130, '2019_05_14_050150_create_h_loker', 117),
(131, '2019_05_15_030826_create_h_lamaran_pek', 118),
(132, '2019_05_16_021132_create_h_seleksi_berkas', 119),
(133, '2019_05_17_054334_create_h_psikotes', 120),
(134, '2019_05_17_060147_create_h_jenis_psikotes', 121),
(135, '2019_05_17_060122_create_relation_h_psikotes', 122),
(136, '2019_05_20_051643_create_h_item_wawancara', 123),
(137, '2019_05_20_060243_create_h_item_keahlian', 124),
(138, '2019_05_23_014309_create_h_wawancara', 125),
(139, '2019_05_24_012944_create_h_tes_keahlian', 126),
(140, '2019_05_27_025501_create_h_hasil_tes', 127),
(141, '2019_05_28_020539_create_h_jenis_kontrak', 128),
(142, '2019_05_28_021223_create_h_kontrak_kerja', 129),
(143, '2019_06_10_031713_create_h_tenaga_ahli', 130),
(144, '2019_06_10_032535_create_h_tenaga_ahli', 131),
(145, '2019_06_11_061057_create_h_periode_kerja', 132),
(146, '2019_06_12_050959_create_h_kalender_kerja', 133),
(147, '2019_06_13_024138_create_h_setting_cuti', 134),
(148, '2019_06_13_053943_create_h_cuti', 135),
(149, '2019_06_14_012942_create_h_request_cuti', 136),
(150, '2019_06_17_034616_create_h_sop', 137),
(151, '2019_05_17_031030_create_h_jabatan_ky', 138),
(152, '2019_06_18_024305_create_h_rencana_pelatihan', 138),
(154, '2019_05_17_032006_create_relation_h_jabatan_ky', 140),
(155, '2019_06_19_015529_create_relasi_h_karyawan_pelatihan', 141),
(156, '2019_06_19_015242_create_h_karyawan_pelatihan', 142),
(157, '2019_06_20_015710_create_h_aspek_pa', 143),
(158, '2019_06_21_022314_create_h_aku', 144),
(159, '2019_06_24_014209_create_satuan_kpi', 145),
(160, '2019_06_24_022915_create_h_jenis_kpi', 146),
(161, '2019_06_24_054051_create_h_kpi', 147),
(162, '2019_06_24_054701_create_relati_h_kpi', 148),
(163, '2019_06_27_062234_create_h_kpi_karyawan', 149),
(164, '2019_06_27_062609_create_relation_h_kpi_karyawan', 150),
(165, '2019_07_01_025644_create_h_tes_kmanajerial', 151),
(166, '2019_07_01_032622_create_h_jenis_kompetensi', 152),
(167, '2019_07_01_060533_create_h_kompetensi_majerial', 153),
(168, '2019_07_02_022342_create_h_item_kmanajerial', 154),
(169, '2019_07_02_033946_create_h_kompetensi_teknis', 155),
(170, '2019_07_03_015623_create_h_tes_manajerial', 156),
(171, '2019_07_03_033419_create_h_kompensasi_kinerja', 157),
(172, '2019_07_03_064654_create_h_log_diary', 158),
(173, '2019_07_05_013201_create_h_item_teknis', 159),
(174, '2019_07_05_024358_create_tes_h_kteknis', 160),
(175, '2019_07_06_020125_create_g_alokasi_gaji', 161),
(176, '2019_07_06_025810_create_g_cf', 162),
(177, '2019_07_08_023713_create_g_sub_cf', 163),
(178, '2019_07_08_065232_create_g_pokok_cff', 164),
(179, '2019_07_09_010501_create_g_item_ccf', 165),
(180, '2019_07_09_023218_create_g_content_cf', 166),
(181, '2019_03_18_030515_create_u_menu_investor', 167),
(182, '2019_04_04_193802_add_web_to_u_perusahaan', 168),
(183, '2019_04_22_004503_create_u_target_tahunan', 169),
(184, '2019_04_22_004526_create_u_target_bulanan', 169),
(185, '2019_05_06_065204_create_u_strategi_tahunan', 169),
(186, '2019_05_06_074607_create_u_strategi_bulanan', 169),
(187, '2019_05_13_063103_create_u_target_jp', 169),
(188, '2019_05_16_003941_create_u_strategi_jp', 169),
(189, '2019_07_11_061701_create_g_skor_posisi_cf', 170),
(190, '2019_07_15_013311_create_g_klasifikasi_gaji', 171),
(191, '2019_07_15_031127_create_g_grade', 172),
(192, '2019_07_16_024115_create_g_skala_gaji', 173),
(193, '2019_07_17_034504_create_h_predikat_penilaian', 174),
(194, '2019_07_17_074141_create_g_daftar_gaji', 175),
(195, '2019_07_18_055839_create_h_absensi', 176),
(196, '2019_07_19_013754_create_h_potongan_tetap', 177),
(197, '2019_07_19_031156_create_h_potongan_absen', 178),
(198, '2019_07_20_004550_g_tunjangan_gaji', 179),
(199, '2019_07_20_005427_create_g_tunjangan_gaji', 180),
(200, '2019_07_22_034222_create_item_tunjangan', 181),
(201, '2019_07_22_055915_create_g_skala_tunjangan', 182),
(202, '2019_07_23_062859_create_g_kelas_proyek', 183),
(203, '2019_07_24_020745_create_g_bonus_proyek', 184),
(204, '2019_07_25_063734_create_slip_gaji', 185),
(205, '2019_07_26_015731_create_g_bonus', 186),
(206, '2019_07_26_030109_create_g_tambahan_gaji', 187),
(207, '2019_07_26_055324_create_g_potongan_tambahan', 188),
(208, '2019_07_27_114240_create_g_bonus_gaji', 189),
(209, '2019_07_31_014226_create_i_data_investor', 190),
(210, '2019_08_01_011959_create_i_bentuk_investor', 191),
(211, '2019_08_01_020959_create_i_periode_investasi', 192),
(212, '2019_08_01_055850_create_i_saham_perdana', 193),
(213, '2019_08_01_063240_create_i_saham_real', 194),
(214, '2019_08_02_065953_create_i_daftar_investasi', 195),
(215, '2019_08_06_030855_create_jual_saham_perusahaan', 196),
(216, '2019_08_08_071334_create_i_investor_jual_saham', 197),
(217, '2019_08_12_004707_create_i_bulan_dividen_s', 198),
(218, '2019_08_12_023318_create_i_persen_kas', 199),
(219, '2019_08_13_063314_create_i_dividen_investor', 200),
(220, '2019_08_16_014205_create_i_pelaksana', 201),
(221, '2019_08_16_064829_create_i_pemodal', 202),
(222, '2019_08_17_115352_create_i_akad', 203),
(223, '2019_08_19_012435_create_i_nisbah', 204),
(224, '2019_08_19_053552_create_i_deviden_bulan_m', 205),
(225, '2019_08_21_010900_create_i_dividen_pelaksana', 206),
(226, '2019_08_21_063601_create_i_dividen_pemodal', 207),
(227, '2019_06_10_061938_create_k_rencana_pend_barang', 208),
(228, '2019_06_10_062639_create_k_rencana_pend_jasa', 208),
(229, '2019_07_03_082750_create_k_rencana_pengeluaran', 208),
(230, '2019_08_26_134723_create_k_master_akun', 208),
(231, '2019_08_26_134753_create_k_master_sub_akun', 208),
(232, '2019_08_26_134811_create_k_master_subsub_akun', 208),
(233, '2019_08_26_135410_create_k_tahun_buku', 208),
(234, '2019_08_26_135431_create_k_saldo_awal', 208),
(235, '2019_08_26_135451_create_k_transaksi', 208),
(236, '2019_08_26_135508_create_k_jurnal', 208),
(237, '2019_08_29_094105_create_k_akun_ukm', 208),
(238, '2019_08_29_094145_create_k_sub_akun_ukm', 208),
(239, '2019_08_29_094217_create_k_subsub_akun_ukm', 208),
(240, '2019_08_29_094555_create_k_akun_aktif_ukm', 208),
(241, '2019_09_05_132250_create_k_ket_transaksi', 209),
(242, '2019_10_14_191638_create_daftar_laba_rugi_ditahan_tahun_berajalan', 210),
(243, '2019_04_16_033756_create_a_pengumuman', 211),
(244, '2019_05_17_014710_create_a_agenda_harian', 211),
(245, '2019_06_17_061944_add_jenis_klien_to_a_klien', 212),
(246, '2019_07_13_071517_add_field_to_klien', 212),
(247, '2019_07_14_025832_create_m_segmenting', 213),
(248, '2019_07_14_025937_create_m_sub_segmenting', 213),
(249, '2019_07_14_031635_create_m_subsub_segmenting', 213),
(250, '2019_07_14_031734_create_m_content_segmenting', 213),
(251, '2019_07_14_031752_create_m_hasil_segmenting', 213),
(252, '2019_07_14_054014_create_m_history_klien', 213),
(253, '2019_07_14_054207_create_m_sumber_data_klien', 213),
(254, '2019_07_15_015910_create_m_penanda_sdk', 213),
(255, '2019_07_19_084858_create_m_pola_targeting', 213),
(256, '2019_07_19_085153_create_m_kriteria_targeting', 213),
(257, '2019_07_19_101640_create_m_pertanyaan_targeting', 213),
(258, '2019_07_27_141227_create_m_rencana_marketing', 213),
(259, '2019_07_27_141418_create_m_media_marketing', 213),
(260, '2019_08_02_124459_create_m_pelaksanaan_marketing', 213),
(261, '2019_08_03_155213_create_m_targeting', 213),
(262, '2019_08_03_155654_create_m_jawaban_targeting', 213),
(263, '2019_08_03_160020_create_m_positioning_marketing', 213),
(264, '2019_08_03_160622_create_m_positioning_perusahaan', 213),
(265, '2019_08_03_161224_create_m_submedia_marketing', 213),
(266, '2019_08_03_161455_create_m_rm_produk', 213),
(267, '2019_08_03_161656_create_m_rm_sasaran', 213),
(268, '2019_08_03_161840_create_m_rm_fase', 213),
(269, '2019_08_03_162408_create_m_rm_stp', 213),
(270, '2019_08_03_162550_create_m_content_marketing', 213),
(271, '2019_08_03_162955_create_m_keg_marketing', 213),
(272, '2019_08_09_075212_create_m_respon_attract', 213),
(273, '2019_08_09_075325_create_m_respon_convert', 213),
(274, '2019_08_09_152909_create_m_keg_marketing_harian', 213),
(275, '2019_08_13_103028_create_m_respon_leads', 213),
(276, '2019_08_13_105251_create_m_closing', 213),
(277, '2019_08_13_124738_create_m_status_closing', 213),
(278, '2019_08_18_085402_create_m_delight', 213),
(279, '2019_08_18_085530_create_m_respon_delight', 213),
(280, '2019_08_19_125803_create_m_kriteria_evaluasi', 213),
(281, '2019_08_19_130121_create_m_indikator_evaluasi', 213),
(282, '2019_08_19_130141_create_m_solusi_evaluasi', 213),
(283, '2019_08_19_130311_create_m_evaluasi_marketing', 213),
(284, '2019_05_24_063113_create_p_rincian_tugas', 213),
(285, '2019_11_19_091227_create_satuan_barang', 214),
(286, '2020_10_13_092356_k_posisi_saldo', 215),
(287, '2020_12_21_100739_revi_tbl_barang', 216),
(288, '2020_12_22_082308_p_harga_jual_satuan', 217),
(291, '2020_12_23_084700_p_harga_jual_baseon_jumlah', 218),
(292, '2020_12_29_085955_tbl_p_konversi_barang', 219),
(293, '2020_12_29_122339_tbl_p_history_konversi_barang', 220),
(294, '2021_01_05_084048_tbl_p_stok_awal', 221),
(295, '2021_01_06_095239_tbl_p_item_masuk_keluar', 222),
(296, '2021_01_11_102039_tbl_p_stok_opname', 223),
(297, '2021_01_11_151705_tbl_m_promo', 224),
(298, '2021_01_12_085423_tbl_m_detail_promo', 225),
(299, '2021_01_12_115918_tbl_p_tawar_beli', 226),
(300, '2021_01_12_132043_tbl_p_detail_tb', 227),
(301, '2021_01_15_124714_tbl_po', 228),
(302, '2021_01_19_095033_tbl_detail_po', 229),
(303, '2021_02_04_000552_p_order', 230),
(304, '2021_02_05_000747_p_detail_order', 231);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_closing`
--

CREATE TABLE `m_closing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_content_marketing`
--

CREATE TABLE `m_content_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_submedia_marketing` int(11) DEFAULT NULL,
  `content_marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_content_segmenting`
--

CREATE TABLE `m_content_segmenting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_subsub_segmenting` int(11) DEFAULT 0,
  `content_segmenting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_marketing` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_delight`
--

CREATE TABLE `m_delight` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `tool_delight` enum('Email','Telp','WA','Messengger','Telegram','Meet up') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_delight` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_detail_promo`
--

CREATE TABLE `m_detail_promo` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_promo` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED DEFAULT NULL,
  `id_jasa` int(10) UNSIGNED DEFAULT NULL,
  `hpp` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `diskon` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `minimum_beli` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `m_detail_promo`
--

INSERT INTO `m_detail_promo` (`id`, `id_promo`, `id_barang`, `id_jasa`, `hpp`, `diskon`, `minimum_beli`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, '0.00', 10, 2, 2, '2021-01-12 02:00:23', '2021-01-12 02:17:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_evaluasi_marketing`
--

CREATE TABLE `m_evaluasi_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kriteria_evaluasi` int(10) UNSIGNED NOT NULL,
  `dimensi` enum('Realtime','Audience','Acquisition','Behavior','Conversions') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_indikator_evaluasi` int(10) UNSIGNED NOT NULL,
  `jenis_content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_solusi_evaluasi` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_hasil_segmenting`
--

CREATE TABLE `m_hasil_segmenting` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `id_content_segmenting` int(10) UNSIGNED NOT NULL,
  `hasil_segmenting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_history_klien`
--

CREATE TABLE `m_history_klien` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `jenis_klien` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_history` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_indikator_evaluasi`
--

CREATE TABLE `m_indikator_evaluasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `indikator_evaluasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_jawaban_targeting`
--

CREATE TABLE `m_jawaban_targeting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_targeting` int(10) UNSIGNED NOT NULL,
  `id_pertanyaan_targeting` int(10) UNSIGNED NOT NULL,
  `jawaban_kriteria` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_keg_marketing`
--

CREATE TABLE `m_keg_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_content_marketing` int(10) UNSIGNED NOT NULL,
  `jenis_keg_marketing` enum('Persiapan','Pelaksanaan','Review','Publish') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keg_marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_keg_marketing_harian`
--

CREATE TABLE `m_keg_marketing_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pel_m` int(10) UNSIGNED NOT NULL,
  `id_keg_marketing` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kriteria_evaluasi`
--

CREATE TABLE `m_kriteria_evaluasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `kriteria_evaluasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kriteria_targeting`
--

CREATE TABLE `m_kriteria_targeting` (
  `id` int(10) UNSIGNED NOT NULL,
  `kriteria_utama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_kriteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_media_marketing`
--

CREATE TABLE `m_media_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_media` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=konvensional marketing',
  `media_marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pelaksanaan_marketing`
--

CREATE TABLE `m_pelaksanaan_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_rm_fase` int(10) UNSIGNED NOT NULL,
  `jenis_keg_marketing` enum('Persiapan','Review','Publish') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema_content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_penanda_sdk`
--

CREATE TABLE `m_penanda_sdk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sdk` int(10) UNSIGNED NOT NULL,
  `penanda` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pertanyaan_targeting`
--

CREATE TABLE `m_pertanyaan_targeting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kriteria_targeting` int(10) UNSIGNED NOT NULL,
  `pertanyaan_kriteria` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pola_targeting`
--

CREATE TABLE `m_pola_targeting` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_pola_targeting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `positif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `negatif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_positioning_marketing`
--

CREATE TABLE `m_positioning_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `posisi_perusahaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_positioning_perusahaan`
--

CREATE TABLE `m_positioning_perusahaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kompetitor` int(10) UNSIGNED NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `plus_produk_k` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_produk_k` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `minus_produk_k` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi_k` int(10) UNSIGNED NOT NULL,
  `plus_produk_p` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_produk_p` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `minus_produk_p` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi_p` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_promo`
--

CREATE TABLE `m_promo` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_promo` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=promo barang, 1=promo jasa',
  `nama_promo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `syarat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas_promo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_berlaku` date NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `m_promo`
--

INSERT INTO `m_promo` (`id`, `jenis_promo`, `nama_promo`, `syarat`, `fasilitas_promo`, `tgl_dibuat`, `tgl_berlaku`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(2, '0', 'Akhir Tahun', 'asdfgasda', 'Terlalu', '2021-01-01', '2021-01-29', 2, '2021-01-11 08:07:06', '2021-01-11 08:32:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rencana_marketing`
--

CREATE TABLE `m_rencana_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_on` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=marketing off line',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_respon_attract`
--

CREATE TABLE `m_respon_attract` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pel_m` int(10) UNSIGNED NOT NULL,
  `jum_like` int(11) NOT NULL DEFAULT 0,
  `jum_comment` int(11) NOT NULL DEFAULT 0,
  `jum_share` int(11) NOT NULL DEFAULT 0,
  `jum_follower` int(11) NOT NULL DEFAULT 0,
  `ket` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_respon_convert`
--

CREATE TABLE `m_respon_convert` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pel_m` int(10) UNSIGNED NOT NULL,
  `jum_email` int(11) NOT NULL DEFAULT 0,
  `jum_wa` int(11) NOT NULL DEFAULT 0,
  `jum_teleg` int(11) NOT NULL DEFAULT 0,
  `ket` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_respon_delight`
--

CREATE TABLE `m_respon_delight` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_delight` int(10) UNSIGNED NOT NULL,
  `respon_klien` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_respon_leads`
--

CREATE TABLE `m_respon_leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pel_m` int(10) UNSIGNED NOT NULL,
  `jum_like` int(11) NOT NULL DEFAULT 0,
  `jum_comment` int(11) NOT NULL DEFAULT 0,
  `jum_share` int(11) NOT NULL DEFAULT 0,
  `jum_follower` int(11) NOT NULL DEFAULT 0,
  `ket` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rm_fase`
--

CREATE TABLE `m_rm_fase` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_rm` int(10) UNSIGNED NOT NULL,
  `tgl_rencana_terbit` date NOT NULL,
  `fase_marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `id_media_marketing` int(10) UNSIGNED NOT NULL,
  `id_submedia_marketing` int(11) DEFAULT NULL,
  `id_content_marketing` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rm_produk`
--

CREATE TABLE `m_rm_produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_rm_fase` int(10) UNSIGNED NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rm_sasaran`
--

CREATE TABLE `m_rm_sasaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_rm_fase` int(10) UNSIGNED NOT NULL,
  `sasaran_klien` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rm_stp`
--

CREATE TABLE `m_rm_stp` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_rm` int(10) UNSIGNED NOT NULL,
  `id_targeting` int(10) UNSIGNED NOT NULL,
  `id_positioning` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_segmenting`
--

CREATE TABLE `m_segmenting` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_segmenting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_solusi_evaluasi`
--

CREATE TABLE `m_solusi_evaluasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `solusi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_status_closing`
--

CREATE TABLE `m_status_closing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_closing` int(10) UNSIGNED NOT NULL,
  `tool_closing` enum('Email','Telp','WA','Messengger','Telegram','Meet up') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_closing` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `respon_klien` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_akhir` enum('Deal','No deal','Follow Up','No Respond') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `status_closing` enum('Open','Close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_submedia_marketing`
--

CREATE TABLE `m_submedia_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_media_marketing` int(10) UNSIGNED NOT NULL,
  `submedia_marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_subsub_segmenting`
--

CREATE TABLE `m_subsub_segmenting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sub_segmenting` int(10) UNSIGNED NOT NULL,
  `item_subsub_segmenting` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sub_segmenting`
--

CREATE TABLE `m_sub_segmenting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_segmenting` int(10) UNSIGNED NOT NULL,
  `item_sub_segmenting` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sumber_data_klien`
--

CREATE TABLE `m_sumber_data_klien` (
  `id` int(10) UNSIGNED NOT NULL,
  `sumber_data` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=off line,1=on line',
  `sumber_media` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_targeting`
--

CREATE TABLE `m_targeting` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_hasil_segmenting` int(10) UNSIGNED NOT NULL,
  `id_pola_targeting` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_barang`
--

CREATE TABLE `p_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kategori_produk` int(10) UNSIGNED NOT NULL,
  `id_subkategori_produk` int(11) NOT NULL DEFAULT 0,
  `id_subsubkategori_produk` int(11) NOT NULL DEFAULT 0,
  `kd_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nm_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `spec_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok_minimum` int(255) NOT NULL DEFAULT 0,
  `hpp` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok_akhir` decimal(12,2) NOT NULL,
  `metode_jual` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=berdasarkan satu harga, 1 = berdasarkan jumlah beli',
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_barang`
--

INSERT INTO `p_barang` (`id`, `id_kategori_produk`, `id_subkategori_produk`, `id_subsubkategori_produk`, `kd_barang`, `barcode`, `nm_barang`, `id_satuan`, `spec_barang`, `desc_barang`, `no_rak`, `stok_minimum`, `hpp`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`, `stok_akhir`, `metode_jual`, `gambar`) VALUES
(1, 1, 0, 0, '1231412', '1231214', 'Indomie', 1, '<p>CPUCeleron Dual Core , Core i3 , Core i5 , Pentium Dual Core</p><p>Model ProsesorCore i3, Core i5, Pentium Dual Core Intel Celeron 2957U processor Intel Pentium 3558U processor 4th Generation Intel Core i3-4030U processor 4th Generation Intel Core i3-4005U processor 4th Generation Intel Core i5-4210U processor</p><p>Kecepatan Prosesorup to 2.7 GHz</p><p>Model GPUIntel HD Graphics 4000 Intel HD Graphics 4400 NVIDIA GeForce 820M</p>', '<p>TipeTipe LaptopNotebook</p><p>Spesifikasi DasarCPUCeleron Dual Core , Core i3 , Core i5 , Pentium Dual Core</p><p>Model ProsesorCore i3, Core i5, Pentium Dual Core Intel Celeron 2957U processor Intel Pentium 3558U processor 4th Generation Intel Core i3-4030U processor 4th Generation Intel Core i3-4005U processor 4th Generation Intel Core i5-4210U processor</p><p>Kecepatan Prosesorup to 2.7 GHz</p><p>Model GPUIntel HD Graphics 4000 Intel HD Graphics 4400 NVIDIA GeForce 820M</p><p>Memori &amp; PenyimpananRAM2GB , 4GB , 8GB</p><p>Tipe MemoriDDR3</p><p>Tipe PenyimpananHDD</p><p>HDD500GB , 1TB</p><p>Drive OptikalBuilt-in DVD+/-RW</p><p>LayarUkuran Layar14inches LED Backlit Display with Truelife and HD resolution, LED Backlit Display with Truelife and HD resolution</p><p>Resolusi1366x768</p><p>KonektifitasKonektifitasHDMI , USB2.0 , USB3.0 , Bluetooth , Card Reader , Camera</p><p>SoftwareOSWindows 8 , Linux , Ubuntu , DOS</p><p>OS VerUBUNTU, Windows 8.1, Windows 8.1 Pro, Windows 8.1 Single Language, Linux</p><p>UkuranDimensiNon-Touch Screen Height: 1.0&rdquo; (25.4mm) / 13.6&rdquo; (346mm) / 9.7&rdquo; (246mm) Touch Screen Height: 1.0&rdquo; (26.6mm) / 13.6&rdquo; (346mm) / 9.7&rdquo; (246mm)</p><p>BeratNon-Touch Screen:Starting at 4.9lbs (2.2 Kg), Touch Screen; Starting at 5.1lbs (2.3 Kg)</p>', '1', 2, 50000, 2, 1, '2019-04-24 17:50:47', '2021-01-11 03:40:58', '5.00', '0', ''),
(2, 2, 0, 0, 'Remot TV', 'alksjdald', 'Remot TV', 1, '<p>adsdfghj</p>', '<p>sadfghh</p>', '2', 1, 40000, 2, 1, '2020-12-21 03:17:12', '2020-12-29 00:22:19', '19.00', '1', ''),
(4, 1, 0, 0, '1231412', '1231214', 'Indomie', 1, '<p>CPUCeleron Dual Core , Core i3 , Core i5 , Pentium Dual Core</p><p>Model ProsesorCore i3, Core i5, Pentium Dual Core Intel Celeron 2957U processor Intel Pentium 3558U processor 4th Generation Intel Core i3-4030U processor 4th Generation Intel Core i3-4005U processor 4th Generation Intel Core i5-4210U processor</p><p>Kecepatan Prosesorup to 2.7 GHz</p><p>Model GPUIntel HD Graphics 4000 Intel HD Graphics 4400 NVIDIA GeForce 820M</p>', '<p>TipeTipe LaptopNotebook</p><p>Spesifikasi DasarCPUCeleron Dual Core , Core i3 , Core i5 , Pentium Dual Core</p><p>Model ProsesorCore i3, Core i5, Pentium Dual Core Intel Celeron 2957U processor Intel Pentium 3558U processor 4th Generation Intel Core i3-4030U processor 4th Generation Intel Core i3-4005U processor 4th Generation Intel Core i5-4210U processor</p><p>Kecepatan Prosesorup to 2.7 GHz</p><p>Model GPUIntel HD Graphics 4000 Intel HD Graphics 4400 NVIDIA GeForce 820M</p><p>Memori &amp; PenyimpananRAM2GB , 4GB , 8GB</p><p>Tipe MemoriDDR3</p><p>Tipe PenyimpananHDD</p><p>HDD500GB , 1TB</p><p>Drive OptikalBuilt-in DVD+/-RW</p><p>LayarUkuran Layar14inches LED Backlit Display with Truelife and HD resolution, LED Backlit Display with Truelife and HD resolution</p><p>Resolusi1366x768</p><p>KonektifitasKonektifitasHDMI , USB2.0 , USB3.0 , Bluetooth , Card Reader , Camera</p><p>SoftwareOSWindows 8 , Linux , Ubuntu , DOS</p><p>OS VerUBUNTU, Windows 8.1, Windows 8.1 Pro, Windows 8.1 Single Language, Linux</p><p>UkuranDimensiNon-Touch Screen Height: 1.0&rdquo; (25.4mm) / 13.6&rdquo; (346mm) / 9.7&rdquo; (246mm) Touch Screen Height: 1.0&rdquo; (26.6mm) / 13.6&rdquo; (346mm) / 9.7&rdquo; (246mm)</p><p>BeratNon-Touch Screen:Starting at 4.9lbs (2.2 Kg), Touch Screen; Starting at 5.1lbs (2.3 Kg)</p>', '-', 2, 50000, 3, 1, '2020-12-30 03:18:55', '2020-12-30 03:21:16', '0.00', '0', ''),
(5, 2, 0, 0, 'Remot TV', 'alksjdald', 'Remot TV', 1, '<p>adsdfghj</p>', '<p>sadfghh</p>', '-', 1, 40000, 3, 1, '2020-12-30 03:18:55', '2020-12-30 03:21:16', '0.00', '0', ''),
(6, 3, 0, 0, '12425345', '1231214', 'Indomie', 5, '<p>asdfghjk</p>', '<p>sdfghjkl</p>', '-', 2, 5000, 3, 1, '2020-12-30 03:18:55', '2020-12-30 03:21:16', '0.00', '0', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_beli_barang`
--

CREATE TABLE `p_beli_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_faktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_beli` date NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_suplier` int(10) UNSIGNED NOT NULL,
  `jumlah_barang` int(10) UNSIGNED NOT NULL,
  `harga_beli` decimal(12,2) UNSIGNED NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_beli_barang`
--

INSERT INTO `p_beli_barang` (`id`, `no_order`, `no_faktur`, `tgl_beli`, `id_barang`, `id_suplier`, `jumlah_barang`, `harga_beli`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '', NULL, '2019-04-03', 1, 1, 3, '6000000.00', 2, 1, '2019-04-28 19:23:19', '2019-04-28 19:37:11'),
(2, '29052019/UD. Kalam Hidup/1', NULL, '2019-05-29', 1, 1, 12, '2000.00', 2, 1, '2019-05-12 18:09:00', '2019-05-12 18:09:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_detail_order`
--

CREATE TABLE `p_detail_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_order` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `hpp` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `diskon_item` int(11) NOT NULL,
  `jumlah_harga` decimal(12,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_detail_order`
--

INSERT INTO `p_detail_order` (`id`, `id_order`, `id_barang`, `hpp`, `jumlah_beli`, `diskon_item`, `jumlah_harga`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 720000, 8, 0, '5760000.00', 2, '2021-02-05 06:03:41', '2021-02-05 06:03:41'),
(2, 2, 7, 67500, 5, 0, '337500.00', 2, '2021-02-05 06:03:41', '2021-02-05 06:03:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_detail_po`
--

CREATE TABLE `p_detail_po` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_po` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `hpp` int(10) UNSIGNED NOT NULL,
  `jumlah_beli` int(10) UNSIGNED NOT NULL,
  `diskon_item` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `jumlah_harga` decimal(12,2) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_detail_po`
--

INSERT INTO `p_detail_po` (`id`, `id_po`, `id_barang`, `hpp`, `jumlah_beli`, `diskon_item`, `jumlah_harga`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 100000, 6, '0.10', '540000.00', 2, '2021-01-19 02:32:23', '2021-01-19 02:48:35'),
(6, 16, 1, 100000, 8, '0.10', '720000.00', 2, '2021-02-04 03:46:32', '2021-02-04 03:52:16'),
(7, 16, 2, 15000, 5, '0.10', '67500.00', 2, '2021-02-04 03:46:32', '2021-02-04 03:52:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_detail_tb`
--

CREATE TABLE `p_detail_tb` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tawar` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `hpp_baru` decimal(8,2) UNSIGNED NOT NULL,
  `jumlah_beli` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_detail_tb`
--

INSERT INTO `p_detail_tb` (`id`, `id_tawar`, `id_barang`, `hpp_baru`, `jumlah_beli`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '100000.00', 8, 2, '2021-01-20 02:55:17', '2021-01-20 02:55:17'),
(4, 2, 2, '15000.00', 5, 2, '2021-02-03 02:59:59', '2021-02-03 02:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_harga_jual_baseon_jumlah`
--

CREATE TABLE `p_harga_jual_baseon_jumlah` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `jumlah_maks_brg` int(10) UNSIGNED NOT NULL,
  `harga_jual` decimal(8,2) NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_harga_jual_baseon_jumlah`
--

INSERT INTO `p_harga_jual_baseon_jumlah` (`id`, `id_barang`, `jumlah_maks_brg`, `harga_jual`, `id_karyawan`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(14, 2, 2, '10000.00', 1, 2, '2020-12-23 03:28:12', '2020-12-31 00:56:23'),
(15, 2, 2, '0.00', 1, 2, '2020-12-23 03:28:12', '2020-12-23 03:28:12'),
(16, 2, 2, '0.00', 1, 2, '2020-12-23 03:28:12', '2020-12-23 03:28:17'),
(17, 2, 2, '0.00', 1, 2, '2020-12-23 03:28:17', '2020-12-23 03:28:17'),
(18, 2, 30, '20000.00', 1, 2, '2020-12-23 03:28:17', '2020-12-28 01:14:48'),
(21, 2, 2, '44444.00', 1, 2, '2020-12-28 02:16:30', '2020-12-28 02:16:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_harga_jual_satuan`
--

CREATE TABLE `p_harga_jual_satuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `harga_jual` decimal(8,2) NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_harga_jual_satuan`
--

INSERT INTO `p_harga_jual_satuan` (`id`, `id_barang`, `harga_jual`, `id_karyawan`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(8, 2, '40400.00', 1, 2, '2020-12-22 03:25:39', '2020-12-28 01:49:32'),
(9, 1, '51000.00', 1, 2, '2020-12-28 01:34:01', '2020-12-31 00:56:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_history_konversi_brg`
--

CREATE TABLE `p_history_konversi_brg` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_konversi_brg` int(10) UNSIGNED NOT NULL,
  `tgl_konversi` date NOT NULL,
  `jum_brg_dikonversi` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_item_masuk_keluar`
--

CREATE TABLE `p_item_masuk_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_item` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: item masuk, 1:item keluar',
  `tgl` date NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_brg` decimal(8,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_item_masuk_keluar`
--

INSERT INTO `p_item_masuk_keluar` (`id`, `jenis_item`, `tgl`, `id_barang`, `ket`, `jumlah_brg`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, '0', '2021-01-06', 1, 'dfgj', '10.00', 2, '2021-01-06 03:51:26', '2021-01-06 04:06:53'),
(2, '1', '2021-01-08', 1, 'asda', '5.00', 2, '2021-01-07 00:31:02', '2021-01-07 00:31:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_jadwal_proyek`
--

CREATE TABLE `p_jadwal_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_task_p` int(10) UNSIGNED NOT NULL,
  `id_rincian_p` int(10) UNSIGNED NOT NULL,
  `durasi` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_jadwal_proyek`
--

INSERT INTO `p_jadwal_proyek` (`id`, `id_task_p`, `id_rincian_p`, `durasi`, `tgl_mulai`, `tgl_selesai`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 2, '2019-05-06', '2019-05-10', 2, 1, '2019-05-06 19:37:19', '2019-05-06 19:37:19'),
(10, 2, 2, 4, '2019-05-07', '2019-05-08', 2, 1, '2019-05-06 19:56:28', '2019-05-06 19:56:28'),
(11, 2, 3, 16, '2019-05-31', '2019-05-31', 2, 1, '2019-05-06 21:12:46', '2019-05-06 21:12:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_jasa`
--

CREATE TABLE `p_jasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kategori_produk` int(10) UNSIGNED NOT NULL,
  `id_subkategori_produk` int(11) DEFAULT 0,
  `id_subsubkategori_produk` int(11) DEFAULT 0,
  `nm_jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jasa` decimal(12,2) NOT NULL,
  `rincian_jasa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_jasa`
--

INSERT INTO `p_jasa` (`id`, `id_kategori_produk`, `id_subkategori_produk`, `id_subsubkategori_produk`, `nm_jasa`, `harga_jasa`, `rincian_jasa`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Servis Hardis', '300000.00', '<p>Biaya perbaikan murah</p>\r\n\r\n<p>cepat pengerjaan nya</p>\r\n\r\n<p>langsung diantar ke tujuan jika barang sudah selesai diservis</p>', 2, 1, '2019-04-23 18:51:14', '2019-04-23 19:23:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_jenis_pem`
--

CREATE TABLE `p_jenis_pem` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_pem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_jenis_pem`
--

INSERT INTO `p_jenis_pem` (`id`, `jenis_pem`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Jaringan Wifi', 2, 1, '2019-05-08 18:22:44', '2019-05-08 18:37:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_jual_barang`
--

CREATE TABLE `p_jual_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_jual` date NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_jual_barang`
--

INSERT INTO `p_jual_barang` (`id`, `no_invoice`, `tgl_jual`, `id_barang`, `id_klien`, `jumlah_barang`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '', '1970-01-01', 1, 4, 2, 2, 1, '2019-04-29 19:35:46', '2019-04-29 19:35:46'),
(5, '', '2019-04-05', 1, 3, 2, 2, 1, '2019-04-29 19:45:22', '2019-04-29 19:45:22'),
(12, '31052019/SIM/3', '2019-05-31', 1, 1, 1, 2, 1, '2019-05-12 18:42:03', '2019-05-12 18:42:03'),
(13, '31052019/SIM/4', '2019-05-31', 1, 1, 2, 2, 1, '2019-05-12 18:42:03', '2019-05-12 18:42:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_jual_jasa`
--

CREATE TABLE `p_jual_jasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jasa` int(10) UNSIGNED NOT NULL,
  `id_klien` int(10) UNSIGNED NOT NULL,
  `detail_pesanan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` decimal(8,2) NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_jual_jasa`
--

INSERT INTO `p_jual_jasa` (`id`, `id_jasa`, `id_klien`, `detail_pesanan`, `harga_jual`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '<p>ROG Phone menggunakan 2.5D dan 3D-curved Gorilla Glass 6 yang dibuat secara presisi dengan diamond-cut highlights serta copper detailing yang membuatnya sebagai salah satu smartphone paling tangguh. Rangka smartphone ini menggunakan metal frame yang dirancang sedemikian rupa sehingga tahan air dan mengantongi sertifikasi IPX4 splash resistant. Smartphone ini memastikan game bermain tanpa hambatan, tanpa lag, dan tanpa delay lantaran memiliki respon yang tinggi. Dukungan SoC Snapdragon 845 Speed-Binned serta GPU Adreno 630 membuat ROG phone tampil sebagai gaming powerhouse dengan performa grafis luar biasa. ROG Phone juga mampu menghadirkan framerate tinggi serta stabil tanpa lag sedikit pun, bahkan ketika digunakan terus menerus. Untuk mendukung performa komputasinya, ASUS juga menanamkan konektivitas premium di smartphone ini, yaitu Cat 18 LTE serta 802.11ad gigabit-class Wi-Fi yang super kencang.<br /><br />Baca selengkapnya di&nbsp;<a href=\"https://tirto.id/\">Tirto.id</a>&nbsp;dengan judul &quot;Harga dan Spesifikasi Asus ROG Phone yang Dirilis di Indonesia&quot;,&nbsp;<a href=\"https://tirto.id/harga-dan-spesifikasi-asus-rog-phone-yang-dirilis-di-indonesia-dbHL\">https://tirto.id/harga-dan-spesifikasi-asus-rog-phone-yang-dirilis-di-indonesia-dbHL</a>.&nbsp;<br /><br />Follow kami di Instagram:&nbsp;<a href=\"https://instagram.com/tirtoid\">tirtoid</a>&nbsp;| Twitter:&nbsp;<a href=\"https://twitter.com/tirtoid\">tirto.id</a></p>', '20000.00', 2, 1, '2019-04-25 17:47:41', '2019-04-25 18:22:12'),
(2, 1, 4, '<p>Untuk menghadirkan kemampuan penuh ROG Phone, hadir fitur X Mode. Cukup satu kali tekan, X Mode secara otomatis akan mengosongkan memori dan mengalokasikannya untuk bermain game. X Mode juga akan mencegah berbagai aplikasi yang rakus daya dan memori untuk aktif. ROG Phone sudah dilengkapi dengan sistem audio yang sangat immersive, menggunakan ultra-powerful front-facing stereo speaker yang dikontrol oleh amplifier khusus sehingga bisa menghasilkan suara kencang yang minim distorsi.&nbsp;<br /><br />Baca selengkapnya di&nbsp;<a href=\"https://tirto.id/\">Tirto.id</a>&nbsp;dengan judul &quot;Harga dan Spesifikasi Asus ROG Phone yang Dirilis di Indonesia&quot;,&nbsp;<a href=\"https://tirto.id/harga-dan-spesifikasi-asus-rog-phone-yang-dirilis-di-indonesia-dbHL\">https://tirto.id/harga-dan-spesifikasi-asus-rog-phone-yang-dirilis-di-indonesia-dbHL</a>.&nbsp;<br /><br />Follow kami di Instagram:&nbsp;<a href=\"https://instagram.com/tirtoid\">tirtoid</a>&nbsp;| Twitter:&nbsp;<a href=\"https://twitter.com/tirtoid\">tirto.id</a></p>', '3555.00', 2, 1, '2019-04-25 18:24:36', '2019-04-25 18:24:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_kategori_produk`
--

CREATE TABLE `p_kategori_produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_kategori_p` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_kategori_produk`
--

INSERT INTO `p_kategori_produk` (`id`, `nm_kategori_p`, `created_at`, `updated_at`) VALUES
(1, 'Komputer & Laptop', '2019-04-22 16:00:00', '2019-04-22 16:00:00'),
(2, 'Travel', '2019-04-22 16:00:00', '2019-04-22 16:00:00'),
(3, 'Barang Digital', '2019-04-22 16:00:00', '2019-04-22 16:00:00'),
(4, 'Fasion', '2019-04-22 16:00:00', '2019-04-22 16:00:00'),
(5, 'Furniture & Decor', '2019-04-22 16:00:00', '2019-04-22 16:00:00'),
(6, 'healts & beauty', '2019-03-12 16:00:00', '2019-03-12 16:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_konversi_barang`
--

CREATE TABLE `p_konversi_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_barang_asal` int(10) UNSIGNED NOT NULL,
  `id_barang_tujuan` int(10) UNSIGNED NOT NULL,
  `jumlah_konversi_satuan` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_order`
--

CREATE TABLE `p_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_po` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tgl_order` date NOT NULL,
  `no_order` int(11) DEFAULT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `tgl_tiba` date NOT NULL,
  `diskon_tambahan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pajak` int(11) NOT NULL DEFAULT 0,
  `dp_po` decimal(12,2) NOT NULL DEFAULT 0.00,
  `bayar` decimal(12,2) NOT NULL DEFAULT 0.00,
  `kurang_bayar` decimal(12,2) NOT NULL DEFAULT 0.00,
  `metode_bayar` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=tunai,1 = kredit/hutang/cicil',
  `tgl_jatuh_tempo` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `ongkir` decimal(12,2) NOT NULL DEFAULT 0.00,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_order`
--

INSERT INTO `p_order` (`id`, `id_po`, `tgl_order`, `no_order`, `id_supplier`, `tgl_tiba`, `diskon_tambahan`, `pajak`, `dp_po`, `bayar`, `kurang_bayar`, `metode_bayar`, `tgl_jatuh_tempo`, `expired_date`, `ongkir`, `ket`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(2, 16, '2021-02-01', 1, 1, '2021-02-05', 0, 0, '0.00', '0.00', '0.00', '0', NULL, NULL, '0.00', NULL, 2, '2021-02-05 04:30:04', '2021-02-05 04:30:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_pemeliharaan`
--

CREATE TABLE `p_pemeliharaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jasa` int(10) UNSIGNED NOT NULL,
  `id_jenis_pem` int(10) UNSIGNED NOT NULL,
  `nm_pemeliharaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jangka_waktu` int(11) NOT NULL,
  `biaya_pem` decimal(12,2) NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_pemeliharaan`
--

INSERT INTO `p_pemeliharaan` (`id`, `id_jasa`, `id_jenis_pem`, `nm_pemeliharaan`, `jangka_waktu`, `biaya_pem`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'fdghhd', 23456, '23456.00', '<p>sdfghj</p>', 2, 1, '2019-05-08 21:50:04', '2019-05-08 21:50:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_progress_proyek`
--

CREATE TABLE `p_progress_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jadwal_proyek` int(10) UNSIGNED NOT NULL,
  `tgl_dikerjakan` date NOT NULL,
  `masalah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rincian_pekerjaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_progress_proyek`
--

INSERT INTO `p_progress_proyek` (`id`, `id_jadwal_proyek`, `tgl_dikerjakan`, `masalah`, `solusi`, `rincian_pekerjaan`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 9, '2019-05-21', '<p>asdfg</p>', '<p>asdasda</p>', '<p>asdasd</p>', 2, 1, '2019-05-09 17:10:31', '2019-05-09 17:10:31'),
(2, 9, '2019-05-31', '<p>aasdfgh</p>', '<p>asds</p>', '<p>asdasd</p>', 2, 1, '2019-05-09 17:10:48', '2019-05-09 17:10:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_progres_pemeliharaan`
--

CREATE TABLE `p_progres_pemeliharaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_dikerjakan` date NOT NULL,
  `id_pemeliharaan` int(10) UNSIGNED NOT NULL,
  `masalah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rincian_pekerjaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_progres_pemeliharaan`
--

INSERT INTO `p_progres_pemeliharaan` (`id`, `tgl_dikerjakan`, `id_pemeliharaan`, `masalah`, `solusi`, `rincian_pekerjaan`, `ket`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '2019-05-01', 2, '<p>ghjhasaaaaaaaaaaaaaaaaa</p>', '<p>asdfgh</p>', '<p>asdfg</p>', NULL, 2, 1, '2019-05-09 18:30:26', '2019-05-09 18:48:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_proyek`
--

CREATE TABLE `p_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_proyek` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_spk` int(10) UNSIGNED NOT NULL,
  `jangka_waktu` int(11) NOT NULL,
  `rincian_proyek` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_proyek`
--

INSERT INTO `p_proyek` (`id`, `jenis_proyek`, `id_spk`, `jangka_waktu`, `rincian_proyek`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, '0', 2, 30, '<p>Manajemen proyek adalah suatu penerapan ilmu pengetahuan, keahlian dan juga ketrampilan, cara teknis yang terbaik serta dengan sumber daya yang terbatas untuk mencapai sasaran atau tujuan yang sudah ditentukan agar mendapatkan hasil yang optimal dalam hal kinerja, waktu, mutu dan keselamatan kerja.</p><p>Definisi manajemen proyek yang lainnya adalah suatu kegiatan merencanakan, mengorganisasikan, mengarahkan, mengawasi serta mengendalikan sumber daya organisasi perusahaan guna mencapai tujuan tertentu dalam waktu tertentu dengan sumber daya tertentu.&nbsp;<strong>Baca juga tentang:</strong>&nbsp;<a href=\"http://www.pengertianku.net/2014/10/pengertian-manajemen-dan-menurut-para-ahli-dilengkapi-fungsinya.html\">Pengertian manajemen dan menurut para ahli dilengkapi dengan fungsinya</a>.</p>', 2, 1, '2019-05-01 18:05:36', '2019-05-01 18:24:44'),
(2, '1', 1, 60, '<p>asdfghjk fdfghjk sdfghj</p>', 2, 1, '2019-05-02 17:32:56', '2019-05-02 17:32:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_rincian_tugas`
--

CREATE TABLE `p_rincian_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_task_p` int(11) UNSIGNED NOT NULL,
  `rincian_tugas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_rincian_tugas`
--

INSERT INTO `p_rincian_tugas` (`id`, `id_task_p`, `rincian_tugas`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makan Sop Sapi', 2, 1, '2019-05-03 19:32:55', '2019-05-03 19:41:07'),
(2, 2, 'lasdjalsdjal', 2, 1, '2019-05-05 19:29:20', '2019-05-05 19:29:20'),
(3, 2, ',jdlaksjdla', 2, 1, '2019-05-05 19:29:28', '2019-05-05 19:29:28'),
(4, 3, 'asdasda', 2, 1, '2019-05-06 17:31:20', '2019-05-06 17:31:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_satuan_brg`
--

CREATE TABLE `p_satuan_brg` (
  `id` int(10) UNSIGNED NOT NULL,
  `satuan_brg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_satuan_brg`
--

INSERT INTO `p_satuan_brg` (`id`, `satuan_brg`, `created_at`, `updated_at`) VALUES
(1, 'Dos', NULL, NULL),
(2, 'Rim', NULL, NULL),
(3, 'Lembar', NULL, NULL),
(4, 'Blok', NULL, NULL),
(5, 'pcs', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_stok_awal`
--

CREATE TABLE `p_stok_awal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `jumlah_brg` decimal(8,2) NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_stok_awal`
--

INSERT INTO `p_stok_awal` (`id`, `id_barang`, `id_perusahaan`, `jumlah_brg`, `expired_date`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '100.00', '2021-01-06', '2021-01-06 01:31:17', '2021-01-06 01:40:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_stok_opname`
--

CREATE TABLE `p_stok_opname` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `tgl_so` date NOT NULL,
  `stok_akhir` decimal(8,2) NOT NULL,
  `bukti_fisik` decimal(8,2) NOT NULL,
  `selisih` decimal(8,2) NOT NULL,
  `petugas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_stok_opname`
--

INSERT INTO `p_stok_opname` (`id`, `id_barang`, `tgl_so`, `stok_akhir`, `bukti_fisik`, `selisih`, `petugas`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(3, 1, '2021-01-11', '13.00', '5.00', '8.00', 'furax', 2, '2021-01-11 03:16:18', '2021-01-11 03:40:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_subkategori_produk`
--

CREATE TABLE `p_subkategori_produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kategori_produk` int(10) UNSIGNED NOT NULL,
  `nm_subkategori_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_subkategori_produk`
--

INSERT INTO `p_subkategori_produk` (`id`, `id_kategori_produk`, `nm_subkategori_produk`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop', NULL, NULL),
(2, 1, 'Hardisk', NULL, NULL),
(3, 3, 'Kamera', NULL, NULL),
(4, 3, 'Televisi', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_subsubkategori_produk`
--

CREATE TABLE `p_subsubkategori_produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_subkategori_produk` int(10) UNSIGNED NOT NULL,
  `nm_subsub_kategori_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_subsubkategori_produk`
--

INSERT INTO `p_subsubkategori_produk` (`id`, `id_subkategori_produk`, `nm_subsub_kategori_produk`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sandisk 260', NULL, NULL),
(2, 2, 'Seagete', NULL, NULL),
(3, 3, 'Cannon', NULL, NULL),
(4, 3, 'Nikon', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_supplier`
--

CREATE TABLE `p_supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_suplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_suplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_suplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp_suplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_suplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_supplier`
--

INSERT INTO `p_supplier` (`id`, `nama_suplier`, `cp_suplier`, `telp_suplier`, `hp_suplier`, `wa_suplier`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'UD. Kalam Hidup', '08129929912', '08129929912', '08129929912', '08129929912', 2, 1, '2019-04-24 22:34:01', '2019-04-24 22:42:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_task_proyek`
--

CREATE TABLE `p_task_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_proyek` int(11) UNSIGNED NOT NULL,
  `nama_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_task_proyek`
--

INSERT INTO `p_task_proyek` (`id`, `id_proyek`, `nama_tugas`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makan Jeruk', 2, 1, '2019-05-03 18:58:04', '2019-05-03 19:10:07'),
(2, 2, 'asda', 2, 1, '2019-05-05 19:23:58', '2019-05-05 19:23:58'),
(3, 2, 'Test Tingkat 2', 2, 1, '2019-05-06 17:31:11', '2019-05-06 17:31:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_tawar_beli`
--

CREATE TABLE `p_tawar_beli` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_tawar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tawar` date NOT NULL,
  `tgl_berlaku` date NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_tawar_beli`
--

INSERT INTO `p_tawar_beli` (`id`, `no_tawar`, `tgl_tawar`, `tgl_berlaku`, `tgl_kirim`, `id_supplier`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(2, '111', '2021-01-20', '2021-01-21', NULL, 1, 2, '2021-01-20 02:55:02', '2021-01-20 02:55:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_tim_proyek`
--

CREATE TABLE `p_tim_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_proyek` int(10) UNSIGNED NOT NULL,
  `id_ky` int(10) UNSIGNED NOT NULL,
  `jabatan_proyek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `p_tim_proyek`
--

INSERT INTO `p_tim_proyek` (`id`, `id_proyek`, `id_ky`, `jabatan_proyek`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Front End', 2, 1, '2019-05-02 18:25:45', '2019-05-02 18:25:45'),
(3, 2, 1, 'Asisten Programer', 2, 1, '2019-05-02 18:43:54', '2019-05-02 18:43:54'),
(4, 1, 1, 'Design Front End', 2, 1, '2019-07-22 23:14:39', '2019-07-22 23:14:39'),
(5, 1, 2, 'Backend Programer', 2, 1, '2019-07-22 23:14:49', '2019-07-22 23:14:49'),
(6, 1, 3, 'Sistem Analis', 2, 1, '2019-07-22 23:15:00', '2019-07-22 23:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_perusahaan`
--

CREATE TABLE `struktur_perusahaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentId` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `struktur_perusahaan`
--

INSERT INTO `struktur_perusahaan` (`id`, `parentId`, `id_karyawan`, `id_jabatan`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'null', 1, 1, 2, '2019-03-22 19:33:50', '2019-03-22 19:33:50'),
(2, '1', 2, 2, 2, '2019-03-22 19:39:46', '2019-03-22 19:39:46'),
(4, '1', 3, 3, 2, '2019-03-24 17:23:26', '2019-03-24 17:23:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_p_po`
--

CREATE TABLE `tbl_p_po` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tawar_beli` int(11) DEFAULT NULL,
  `tgl_po` date NOT NULL,
  `no_po` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_krm` date NOT NULL,
  `diskon_tambahan` int(11) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `dp_po` decimal(8,2) NOT NULL DEFAULT 0.00,
  `kurang_bayar` decimal(12,2) NOT NULL DEFAULT 0.00,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_po` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=open, 1=close',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_p_po`
--

INSERT INTO `tbl_p_po` (`id`, `id_tawar_beli`, `tgl_po`, `no_po`, `id_supplier`, `tgl_krm`, `diskon_tambahan`, `pajak`, `dp_po`, `kurang_bayar`, `ket`, `status_po`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 0, '2021-01-19', 'asdasd', 1, '2021-01-19', 20, 0, '20.00', '5000.00', NULL, '0', 2, '2021-01-19 01:11:57', '2021-02-04 03:55:56'),
(16, 2, '2021-02-03', 'asdasd/alksjd/asdad', 1, '2021-02-04', 10, 0, '50000.00', '0.00', NULL, '0', 2, '2021-02-04 03:23:20', '2021-02-04 04:09:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_akta`
--

CREATE TABLE `u_akta` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_akta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_akta` date NOT NULL,
  `notaris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bentuk_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_akta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_akta`
--

INSERT INTO `u_akta` (`id`, `no_akta`, `tgl_akta`, `notaris`, `bentuk_usaha`, `no_rak`, `file_akta`, `id_perusahaan`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, '19128739', '2019-03-27', 'Ahmad Dahlan', 'CV', '34', '1551839094.zip', 2, 13, '2019-03-05 18:24:55', '2019-03-05 18:24:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_bagian_p`
--

CREATE TABLE `u_bagian_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_bagian_p`
--

INSERT INTO `u_bagian_p` (`id`, `nm_bagian`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 'Administrasi', 2, 1, NULL, NULL),
(3, 'Bendaharas', 2, 1, '2019-03-19 22:58:30', '2019-03-20 18:02:04'),
(4, 'HRD', 2, 1, '2019-03-20 19:17:34', '2019-03-20 19:17:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_devisi_p`
--

CREATE TABLE `u_devisi_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bagian_p` int(10) UNSIGNED NOT NULL,
  `nm_devisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_devisi_p`
--

INSERT INTO `u_devisi_p` (`id`, `id_bagian_p`, `nm_devisi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', 2, 1, NULL, '2019-03-20 22:09:42'),
(2, 1, 'B', 2, 1, NULL, NULL),
(3, 3, 'D', 2, 1, NULL, NULL),
(4, 3, 'Z', 2, 1, '2019-04-17 19:21:04', '2019-04-17 19:21:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_ijin_usaha`
--

CREATE TABLE `u_ijin_usaha` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_ijin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ijin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berlaku` date NOT NULL,
  `kualifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_pemberi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_iu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int(11) UNSIGNED NOT NULL,
  `id_user_ukm` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_ijin_usaha`
--

INSERT INTO `u_ijin_usaha` (`id`, `nm_ijin`, `no_ijin`, `berlaku`, `kualifikasi`, `instansi_pemberi`, `klasifikasi`, `file_iu`, `no_rak`, `id_perusahaan`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(1, 'Ijin Mendirikan Stan Makan', '12312', '2019-03-26', 'asdf', 'asdfg', 'asdfg', '1552026434.png', NULL, 2, 13, '2019-03-07 22:27:14', '2019-03-07 22:27:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_jabatan_p`
--

CREATE TABLE `u_jabatan_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `level_jabatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_jabatan_p`
--

INSERT INTO `u_jabatan_p` (`id`, `nm_jabatan`, `id_perusahaan`, `id_user_ukm`, `level_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Pimpinan', 2, 13, 0, '2019-03-07 19:44:04', '2019-03-07 22:18:27'),
(2, 'CTO', 2, 13, 2, '2019-03-22 19:39:09', '2019-03-22 19:39:09'),
(3, 'CCO', 2, 13, 3, '2019-03-22 19:39:21', '2019-03-22 19:39:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_job_desc`
--

CREATE TABLE `u_job_desc` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jabatan_p` int(11) UNSIGNED NOT NULL,
  `job_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_job_desc`
--

INSERT INTO `u_job_desc` (`id`, `id_jabatan_p`, `job_desc`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, '<p>BERSDFRSDS</p>', 2, 1, '2019-03-24 18:25:16', '2019-03-24 18:48:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_kabupaten`
--

CREATE TABLE `u_kabupaten` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_provinsi` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_kabupaten`
--

INSERT INTO `u_kabupaten` (`id`, `nama_kabupaten`, `id_provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Kolaka', 1, NULL, NULL),
(2, 'Kendari', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_master_menu`
--

CREATE TABLE `u_master_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_master_menu`
--

INSERT INTO `u_master_menu` (`id`, `nm_menu`, `created_at`, `updated_at`) VALUES
(2, 'Perusahaan', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(3, 'Administrasi', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(4, 'Produk', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(5, 'Marketing', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(6, 'Keuangan', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(7, 'HRD', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(8, 'Penggajian', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(9, 'Laporan', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(10, 'Investor', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(11, 'Kepemilikan Saham', NULL, NULL),
(12, 'Mudharabah & Syirkah', NULL, NULL),
(17, 'Tambahan', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(18, 'Donasi', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(19, 'Panduan', '2019-03-12 16:00:00', '2019-03-12 16:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_master_submenu`
--

CREATE TABLE `u_master_submenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_master_menu` int(10) UNSIGNED NOT NULL,
  `nm_submenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_master_submenu`
--

INSERT INTO `u_master_submenu` (`id`, `id_master_menu`, `nm_submenu`, `url`, `created_at`, `updated_at`) VALUES
(1, 2, 'SWOT', 'Swot', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(2, 2, 'Strategi Jangka Panjang', 'Strategi-Jangka-Panjang', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(3, 2, 'Strategi Jangka Pendek', 'Strategi-Jangka-Pendek', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(4, 2, 'Model Bisnis', 'Model-Bisnis', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(5, 2, 'Struktur Perusahaan', 'Struktur-Perusahaan', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(6, 2, 'Job Desc', 'Job-Desc', '2019-03-12 16:00:00', '2019-03-12 16:00:00'),
(7, 3, 'Klien', 'Klien', NULL, NULL),
(8, 3, 'Surat', 'Surat', NULL, NULL),
(9, 3, 'Proposal', 'Proposal', NULL, NULL),
(10, 3, 'Arsip', 'Arsip', NULL, NULL),
(11, 3, 'SPK/Kontrak', 'SPK-Kontrak', NULL, NULL),
(12, 3, 'BA Pemeriksaan', 'BA-Pemeriksaan', NULL, NULL),
(13, 3, 'BA-Kemajuan', 'BA-Kemajuan', '2019-04-09 16:00:00', '2019-04-09 16:00:00'),
(14, 3, 'BA Penyelesaian', 'BA-Penyelesaian', NULL, NULL),
(15, 3, 'BA Serah Terima', 'BA-Serah-Terima', NULL, NULL),
(16, 3, 'BA Serah Terima Operasional', 'BA-Serah-Terima-Operasional', NULL, NULL),
(17, 3, 'Inventarisasi Peralatan', '', NULL, NULL),
(18, 3, 'Agenda Harian', '', NULL, NULL),
(19, 3, 'Brifing', 'Brifing', NULL, NULL),
(20, 3, 'Pengumuman', '', NULL, NULL),
(21, 4, 'Barang', 'Barang', NULL, NULL),
(22, 4, 'Supplier', 'Supplier', NULL, NULL),
(23, 4, 'Pembelian', 'Pembelian', NULL, NULL),
(24, 4, 'Penjualan', 'Penjualan', NULL, NULL),
(25, 4, 'Jasa', 'Jasa', NULL, NULL),
(26, 4, 'Jual Jasa', 'Jual-Jasa', NULL, NULL),
(27, 4, 'Proyek', 'Proyek', NULL, NULL),
(28, 4, 'Tim Produksi', 'Tim-Produksi', NULL, NULL),
(29, 4, 'Jadwal Proyek', 'Jadwal-Proyek', NULL, NULL),
(30, 4, 'Progress Proyek', 'Progress-Proyek', NULL, NULL),
(31, 4, 'Pemeliharaan', 'Pemeliharaan', NULL, NULL),
(32, 4, 'Progres Pemeliharaan', 'Progres-Pemeliharaan', NULL, NULL),
(33, 5, 'Klien', '', NULL, NULL),
(34, 5, 'Rencana Marketing', '', NULL, NULL),
(35, 5, 'Calon Klien', '', NULL, NULL),
(36, 5, 'Realisasi Marketing', '', NULL, NULL),
(37, 5, 'Pemeliharaan Marketing', '', NULL, NULL),
(38, 6, 'Rencana Pendapatan', '', NULL, NULL),
(39, 6, 'Saldo Awal', '', NULL, NULL),
(40, 6, 'Akun', 'Akun', NULL, NULL),
(41, 6, 'Transaksi', 'Transaksi', NULL, NULL),
(42, 6, 'Saldo Awal', 'Saldo-awal', NULL, NULL),
(44, 6, 'Jurnal Umum', 'Jurnal-Umum', NULL, NULL),
(45, 6, 'Jurnal Penyesuaian', 'Jurnal-Penyesuaian', NULL, NULL),
(49, 7, 'Karyawan', 'Karyawan', NULL, NULL),
(50, 7, 'Rekruitmen/loker', 'Rekruitmen', NULL, NULL),
(51, 7, 'Lamaran Pekerjaan', 'Lamaran-Pekerjaan', NULL, NULL),
(52, 7, 'Seleksi', 'Seleksi', NULL, NULL),
(53, 7, 'Kontrak Kerja', 'Kontrak-Kerja', NULL, NULL),
(54, 7, 'Jabatan', '', NULL, NULL),
(55, 7, 'Syarat Jabatan', '', NULL, NULL),
(56, 7, 'Tenaga Ahli', 'Tenaga-ahli', NULL, NULL),
(57, 7, 'Periode Kerja', 'Periode-Kerja', NULL, NULL),
(58, 7, 'Absensi', '', NULL, NULL),
(59, 7, 'Career Development', '', NULL, NULL),
(60, 7, 'SOP', 'SOP', NULL, NULL),
(61, 7, 'Cuti', 'Cuti', NULL, NULL),
(62, 7, 'Izin', '', NULL, NULL),
(63, 2, 'Bagian', 'Bagian', NULL, NULL),
(64, 2, 'Divisi', 'Divisi', NULL, NULL),
(65, 7, 'Tes', 'Tes', NULL, NULL),
(66, 7, 'Kelender Kerja', 'Kelender-Kerja', NULL, NULL),
(67, 7, 'Rencana Pelatihan', 'Rencana-Pelatihan', NULL, NULL),
(68, 7, 'Buku Penilaian', 'Buku-Penilaian', NULL, NULL),
(69, 7, 'Kompensasi Kinerja', 'Kompensasi-Kinerja', NULL, NULL),
(70, 7, 'Log Diary', 'Log-Diary', NULL, NULL),
(71, 8, 'Alokasi Gaji', 'Alokasi-Gaji', NULL, NULL),
(72, 8, 'Compansable factors (CF)', 'Compansable-factors', NULL, NULL),
(73, 8, 'Sub Compansable factors', 'Sub-Compansable-factors', NULL, NULL),
(74, 8, 'Content CF', 'Content-CF', NULL, NULL),
(75, 8, 'Daftar Gaji', 'Daftar-gaji', NULL, NULL),
(76, 7, 'Absensi', 'Absensi', NULL, NULL),
(77, 7, 'Potongan Tetap', 'Potongan-tetap', NULL, NULL),
(78, 7, 'Potongan Absen', 'Potongan-absen', NULL, NULL),
(79, 8, 'Tunjangan Gaji', 'Tunjangan-gaji', NULL, NULL),
(80, 10, 'Data Investor', 'Data-Investor', NULL, NULL),
(82, 10, 'Bentuk Investor', 'Bentuk-Investor', NULL, NULL),
(83, 11, 'Periode Investasi', 'Periode-Investasi', NULL, NULL),
(84, 11, 'Saham', 'Saham', NULL, NULL),
(85, 11, 'Data Investasi', 'Data-Investasi', NULL, NULL),
(86, 11, 'Jual Saham', 'Jual-Saham', NULL, NULL),
(87, 11, 'Persen Kas', 'Persen-kas', NULL, NULL),
(88, 11, 'Dividen', 'Dividen', NULL, NULL),
(89, 12, 'Pelaku Investasi', 'Pelaku-Investasi', NULL, NULL),
(90, 12, 'Akad', 'Akad', NULL, NULL),
(91, 12, 'Nisbah (bagi hasil)', 'Nisbah', NULL, NULL),
(94, 12, 'Nisbah Per Pemodal', '#', NULL, NULL),
(95, 12, 'Nisbah Per Pelaksana', '#', NULL, NULL),
(96, 6, 'Daftar Jurnal', 'Daftar-Jurnal', NULL, NULL),
(97, 6, 'Laporan', 'Laporan-keuangan', NULL, NULL),
(98, 6, 'Tahun Buku', 'tahun-buku', '2020-12-14 16:00:00', '2020-11-14 16:00:00'),
(99, 4, 'Inventory', 'inventory', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_menu_investor`
--

CREATE TABLE `u_menu_investor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_menu_ukm` int(10) UNSIGNED NOT NULL,
  `id_submenu_ukm` int(10) UNSIGNED NOT NULL,
  `id_investor` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `status_akses` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_menu_investor`
--

INSERT INTO `u_menu_investor` (`id`, `id_menu_ukm`, `id_submenu_ukm`, `id_investor`, `id_user_ukm`, `status_akses`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(2, 8, 9, 1, 13, '0', 2, '2019-03-17 19:30:41', '2019-03-17 19:30:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_menu_karyawan`
--

CREATE TABLE `u_menu_karyawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_menu_ukm` int(10) UNSIGNED NOT NULL,
  `id_submenu_ukm` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(11) UNSIGNED NOT NULL,
  `status_akses` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_menu_karyawan`
--

INSERT INTO `u_menu_karyawan` (`id`, `id_menu_ukm`, `id_submenu_ukm`, `id_karyawan`, `id_user_ukm`, `status_akses`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(16, 9, 22, 1, 13, '0', 2, '2019-03-28 17:27:04', '2019-03-28 17:27:04'),
(17, 9, 25, 1, 13, '0', 2, '2019-03-28 17:27:39', '2019-03-28 17:27:39'),
(18, 9, 26, 1, 13, '0', 2, '2019-03-28 17:27:51', '2019-03-28 17:27:51'),
(19, 9, 27, 1, 13, '0', 2, '2019-04-05 17:18:52', '2019-04-05 17:18:52'),
(20, 9, 28, 1, 13, '0', 2, '2019-04-05 17:18:55', '2019-04-05 17:18:55'),
(21, 9, 29, 1, 13, '0', 2, '2019-04-08 16:54:23', '2019-04-08 16:54:23'),
(22, 9, 30, 1, 13, '0', 2, '2019-04-08 16:54:24', '2019-04-08 16:54:24'),
(23, 9, 31, 1, 13, '0', 2, '2019-04-11 18:03:11', '2019-04-11 18:03:11'),
(24, 9, 32, 1, 13, '0', 2, '2019-04-11 18:03:11', '2019-04-11 18:03:11'),
(25, 9, 33, 1, 13, '0', 2, '2019-04-11 18:03:15', '2019-04-11 18:03:15'),
(26, 9, 36, 1, 13, '0', 2, '2019-04-14 22:05:07', '2019-04-14 22:05:07'),
(27, 9, 37, 1, 13, '0', 2, '2019-04-14 22:05:08', '2019-04-14 22:05:08'),
(29, 13, 38, 1, 13, '0', 2, '2019-04-22 19:31:50', '2019-04-22 19:31:50'),
(30, 13, 39, 1, 13, '0', 2, '2019-04-23 17:03:19', '2019-04-23 17:03:19'),
(31, 13, 40, 1, 13, '0', 2, '2019-04-24 19:54:20', '2019-04-24 19:54:20'),
(32, 13, 41, 1, 13, '0', 2, '2019-04-25 17:07:22', '2019-04-25 17:07:22'),
(33, 13, 42, 1, 13, '0', 2, '2019-04-28 18:31:12', '2019-04-28 18:31:12'),
(34, 13, 43, 1, 13, '0', 2, '2019-04-28 18:31:12', '2019-04-28 18:31:12'),
(35, 13, 44, 1, 13, '0', 2, '2019-05-01 17:08:15', '2019-05-01 17:08:15'),
(36, 13, 45, 1, 13, '0', 2, '2019-05-01 21:52:25', '2019-05-01 21:52:25'),
(37, 13, 46, 1, 13, '0', 2, '2019-05-03 17:53:29', '2019-05-03 17:53:29'),
(38, 13, 47, 1, 13, '0', 2, '2019-05-07 18:19:53', '2019-05-07 18:19:53'),
(39, 13, 48, 1, 13, '0', 2, '2019-05-08 16:55:53', '2019-05-08 16:55:53'),
(40, 13, 49, 1, 13, '0', 2, '2019-05-08 16:55:53', '2019-05-08 16:55:53'),
(41, 12, 50, 1, 13, '0', 2, '2019-05-13 17:00:08', '2019-05-13 17:00:08'),
(43, 12, 51, 1, 13, '0', 2, '2019-05-13 21:17:33', '2019-05-13 21:17:33'),
(44, 12, 52, 1, 13, '0', 2, '2019-05-13 21:17:35', '2019-05-13 21:17:35'),
(45, 12, 53, 1, 13, '0', 2, '2019-05-13 21:17:41', '2019-05-13 21:17:41'),
(46, 12, 54, 1, 13, '0', 2, '2019-05-16 19:14:11', '2019-05-16 19:14:11'),
(47, 12, 55, 1, 13, '0', 2, '2019-05-27 17:37:10', '2019-05-27 17:37:10'),
(48, 12, 56, 1, 13, '0', 2, '2019-06-09 22:09:55', '2019-06-09 22:09:55'),
(49, 12, 57, 1, 13, '0', 2, '2019-06-10 23:01:21', '2019-06-10 23:01:21'),
(50, 12, 58, 1, 13, '0', 2, '2019-06-11 18:19:56', '2019-06-11 18:19:56'),
(51, 12, 59, 1, 13, '0', 2, '2019-06-12 17:44:46', '2019-06-12 17:44:46'),
(52, 12, 60, 1, 13, '0', 2, '2019-06-16 19:29:49', '2019-06-16 19:29:49'),
(53, 12, 61, 1, 13, '0', 2, '2019-06-17 17:09:55', '2019-06-17 17:09:55'),
(54, 12, 62, 1, 13, '0', 2, '2019-06-18 19:22:25', '2019-06-18 19:22:25'),
(55, 8, 24, 1, 13, '0', 2, '2019-07-02 19:13:05', '2019-07-02 19:13:05'),
(56, 8, 23, 1, 13, '0', 2, '2019-07-02 19:13:05', '2019-07-02 19:13:05'),
(57, 8, 19, 1, 13, '0', 2, '2019-07-02 19:13:06', '2019-07-02 19:13:06'),
(58, 8, 18, 1, 13, '0', 2, '2019-07-02 19:13:06', '2019-07-02 19:13:06'),
(59, 8, 17, 1, 13, '0', 2, '2019-07-02 19:13:07', '2019-07-02 19:13:07'),
(60, 8, 16, 1, 13, '0', 2, '2019-07-02 19:13:07', '2019-07-02 19:13:07'),
(61, 8, 10, 1, 13, '0', 2, '2019-07-02 19:13:07', '2019-07-02 19:13:07'),
(62, 8, 9, 1, 13, '0', 2, '2019-07-02 19:13:08', '2019-07-02 19:13:08'),
(63, 12, 63, 1, 13, '0', 2, '2019-07-02 19:13:11', '2019-07-02 19:13:11'),
(64, 12, 64, 1, 13, '0', 2, '2019-07-02 22:24:18', '2019-07-02 22:24:18'),
(65, 14, 81, 1, 13, '0', 2, '2019-07-05 17:25:38', '2019-07-05 17:25:38'),
(66, 14, 82, 1, 13, '0', 2, '2019-07-05 17:26:03', '2019-07-05 17:26:03'),
(67, 14, 83, 1, 13, '0', 2, '2019-07-07 17:35:31', '2019-07-07 17:35:31'),
(68, 14, 84, 1, 13, '0', 2, '2019-07-07 22:13:51', '2019-07-07 22:13:51'),
(69, 14, 85, 1, 13, '0', 2, '2019-07-16 23:04:52', '2019-07-16 23:04:52'),
(70, 12, 86, 1, 13, '0', 2, '2019-07-17 21:50:18', '2019-07-17 21:50:18'),
(71, 12, 87, 1, 13, '0', 2, '2019-07-18 16:51:52', '2019-07-18 16:51:52'),
(72, 12, 88, 1, 13, '0', 2, '2019-07-18 19:02:46', '2019-07-18 19:02:46'),
(73, 14, 89, 1, 13, '0', 2, '2019-07-19 16:16:10', '2019-07-19 16:16:10'),
(90, 15, 90, 1, 13, '0', 2, '2019-08-14 19:44:32', '2019-08-14 19:44:32'),
(91, 15, 91, 1, 13, '0', 2, '2019-08-14 19:44:32', '2019-08-14 19:44:32'),
(92, 16, 92, 1, 13, '0', 2, '2019-08-14 19:44:34', '2019-08-14 19:44:34'),
(93, 16, 93, 1, 13, '0', 2, '2019-08-14 19:44:34', '2019-08-14 19:44:34'),
(94, 16, 94, 1, 13, '0', 2, '2019-08-14 19:44:35', '2019-08-14 19:44:35'),
(95, 16, 95, 1, 13, '0', 2, '2019-08-14 19:44:36', '2019-08-14 19:44:36'),
(96, 16, 96, 1, 13, '0', 2, '2019-08-14 19:44:36', '2019-08-14 19:44:36'),
(97, 16, 97, 1, 13, '0', 2, '2019-08-14 19:44:37', '2019-08-14 19:44:37'),
(98, 17, 98, 1, 13, '0', 2, '2019-08-14 19:51:18', '2019-08-14 19:51:18'),
(99, 17, 99, 1, 13, '0', 2, '2019-08-14 19:51:19', '2019-08-14 19:51:19'),
(100, 17, 100, 1, 13, '0', 2, '2019-08-14 19:51:19', '2019-08-14 19:51:19'),
(103, 17, 101, 1, 13, '0', 2, '2019-08-18 17:10:55', '2019-08-18 17:10:55'),
(104, 17, 102, 1, 13, '0', 2, '2019-08-18 17:10:56', '2019-08-18 17:10:56'),
(105, 11, 103, 1, 13, '0', 2, '2019-09-01 23:44:10', '2019-09-01 23:44:10'),
(106, 11, 104, 1, 13, '0', 2, '2019-09-04 05:11:05', '2019-09-04 05:11:05'),
(107, 11, 105, 1, 13, '0', 2, '2019-09-12 00:33:41', '2019-09-12 00:33:41'),
(108, 11, 106, 1, 13, '0', 2, '2019-09-16 01:14:44', '2019-09-16 01:14:44'),
(109, 11, 107, 1, 13, '0', 2, '2019-09-16 01:14:45', '2019-09-16 01:14:45'),
(110, 11, 108, 1, 13, '0', 2, '2019-09-16 01:14:45', '2019-09-16 01:14:45'),
(111, 11, 109, 1, 13, '0', 2, '2019-09-16 02:31:39', '2019-09-16 02:31:39'),
(112, 11, 110, 1, 13, '0', 2, '2020-12-15 00:14:56', '2020-12-15 00:14:56'),
(113, 13, 111, 1, 13, '0', 2, '2021-01-04 01:42:08', '2021-01-04 01:42:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_menu_ukm`
--

CREATE TABLE `u_menu_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_master_menu` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_menu_ukm`
--

INSERT INTO `u_menu_ukm` (`id`, `id_master_menu`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(8, 2, 2, '2019-03-14 17:08:32', '2019-03-14 17:08:32'),
(9, 3, 2, '2019-03-14 18:26:01', '2019-03-14 18:26:01'),
(10, 5, 2, '2019-03-14 18:26:08', '2019-03-14 18:26:08'),
(11, 6, 2, '2019-03-14 18:26:09', '2019-03-14 18:26:09'),
(12, 7, 2, '2019-03-14 18:26:11', '2019-03-14 18:26:11'),
(13, 4, 2, '2019-04-22 19:31:38', '2019-04-22 19:31:38'),
(14, 8, 2, '2019-07-05 16:00:38', '2019-07-05 16:00:38'),
(15, 10, 2, '2019-07-30 17:17:23', '2019-07-30 17:17:23'),
(16, 11, 2, NULL, NULL),
(17, 12, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_perusahaan`
--

CREATE TABLE `u_perusahaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan_usaha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_kab` int(10) UNSIGNED NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teleg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_perusahaan`
--

INSERT INTO `u_perusahaan` (`id`, `nm_usaha`, `singkatan_usaha`, `alamat`, `id_prov`, `id_kab`, `kode_pos`, `telp`, `hp`, `wa`, `teleg`, `email`, `jenis_usaha`, `web`, `logo`, `id_user_ukm`, `created_at`, `updated_at`) VALUES
(2, 'CV. Sumber Info Media', 'SIM', 'Jl. Pangeran Antasari', 1, 2, '5335', NULL, NULL, NULL, NULL, 'sumberindomedia@gmail.com', '2', 'sumberinfomedia.com', '1557714979.png', 13, '2019-03-04 18:02:44', '2019-05-12 18:36:19'),
(3, 'CV. MAJU SEJAHTERAH', '', 'lasjdl', 1, 1, '234354', '234', '234', '234', '234', 'andi5583@yahoo.com', '2', 'http://www.majusejahtera.com', NULL, 13, '2019-03-17 22:20:10', '2019-03-17 22:20:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_profil`
--

CREATE TABLE `u_profil` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user_ukm` int(10) UNSIGNED NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` int(10) UNSIGNED NOT NULL,
  `kab_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_profil`
--

INSERT INTO `u_profil` (`id`, `id_user_ukm`, `telp`, `hp`, `wa`, `telegram`, `foto`, `provinsi_id`, `kab_id`, `created_at`, `updated_at`) VALUES
(1, 13, '023840', '2342', '2342', '3456', '1551663105.png', 1, 1, '2019-03-03 17:26:49', '2019-03-03 17:31:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_provinsi`
--

CREATE TABLE `u_provinsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_provinsi`
--

INSERT INTO `u_provinsi` (`id`, `nama_provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Sulawesi Tenggara', NULL, NULL),
(2, 'Sulawesi selatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_strategi_bulanan`
--

CREATE TABLE `u_strategi_bulanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_stahunan` int(10) UNSIGNED NOT NULL,
  `id_target_bulanan` int(10) UNSIGNED NOT NULL,
  `isi_sbulanan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_strategi_jp`
--

CREATE TABLE `u_strategi_jp` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tjp` int(10) UNSIGNED NOT NULL,
  `isi_sjp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_strategi_jpd`
--

CREATE TABLE `u_strategi_jpd` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sjpg` int(10) UNSIGNED NOT NULL,
  `id_bagian_p` int(10) UNSIGNED NOT NULL,
  `id_divisi_p` int(10) UNSIGNED NOT NULL,
  `periode` year(4) NOT NULL,
  `isi_spjd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_strategi_jpd`
--

INSERT INTO `u_strategi_jpd` (`id`, `id_sjpg`, `id_bagian_p`, `id_divisi_p`, `periode`, `isi_spjd`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 2017, '<ul>\r\n	<li>asdasd</li>\r\n	<li>as</li>\r\n	<li>da</li>\r\n	<li>sd</li>\r\n</ul>', 2, 1, '2019-03-21 16:00:00', '2019-03-21 19:27:32'),
(2, 2, 3, 2, 2017, '<ul>\r\n<li> Selesaikan Apa Saja </li>\r\n</ul>', 2, 1, '2019-03-21 16:00:00', '2019-03-21 16:00:00'),
(3, 2, 1, 1, 2018, 'asd', 2, 1, '2019-03-07 16:00:00', '2019-03-27 16:00:00'),
(4, 2, 3, 3, 2017, '<ul>\r\n	<li>as</li>\r\n	<li>da</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n	<li>s</li>\r\n	<li>da</li>\r\n	<li>asd</li>\r\n</ul>', 2, 1, '2019-03-21 18:57:24', '2019-03-21 18:57:50'),
(5, 2, 1, 1, 2019, '<p>asdjlkjasdk a dkas djklas jdlaksd jkals jd</p>', 2, 1, '2019-03-21 18:59:02', '2019-03-21 18:59:02'),
(6, 2, 1, 1, 2020, '<p>dlakjsdaksdjaklsjdlkasjd askd aksd jasda</p>', 2, 1, '2019-03-21 18:59:32', '2019-03-21 18:59:32'),
(7, 2, 1, 1, 2021, '<p>daksjhdakjshdjkashdkjahdjahs djaks dakjsd</p>', 2, 1, '2019-03-21 18:59:47', '2019-03-21 18:59:47'),
(8, 2, 1, 1, 2022, '<ul>\r\n	<li>aslkdjaslkdjaskld aks dasd</li>\r\n	<li>dasd</li>\r\n	<li>a</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n</ul>', 2, 1, '2019-03-21 19:00:14', '2019-03-21 19:00:14'),
(9, 2, 3, 3, 2023, '<p>askjkdhajkshdjkasd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>as</p>\r\n\r\n<p>d</p>\r\n\r\n<p>as</p>\r\n\r\n<p>d</p>\r\n\r\n<p>as</p>\r\n\r\n<p>d</p>\r\n\r\n<p>ad</p>', 2, 1, '2019-03-21 19:00:40', '2019-03-21 19:00:40'),
(10, 2, 1, 1, 2024, '<p>adasdadadasdad</p>', 2, 1, '2019-03-21 19:01:07', '2019-03-21 19:02:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_strategi_jpg`
--

CREATE TABLE `u_strategi_jpg` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode` int(11) NOT NULL,
  `isi_sjpg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_strategi_jpg`
--

INSERT INTO `u_strategi_jpg` (`id`, `periode`, `isi_sjpg`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(2, 5, '<ul>\r\n	<li>Selesakan Aplikasi Master Management Deadline Bulan 8</li>\r\n	<li>Pelajari bahan&quot; untuk mengelasaikan project</li>\r\n</ul>', 2, 1, '2019-03-19 19:47:30', '2019-03-19 19:47:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_strategi_tahunan`
--

CREATE TABLE `u_strategi_tahunan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sjp` int(10) UNSIGNED NOT NULL,
  `id_target_tahunan` int(10) UNSIGNED NOT NULL,
  `isi_stahunan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_submenu_ukm`
--

CREATE TABLE `u_submenu_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_menu_ukm` int(10) UNSIGNED NOT NULL,
  `id_master_submenu` int(10) UNSIGNED NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_submenu_ukm`
--

INSERT INTO `u_submenu_ukm` (`id`, `id_menu_ukm`, `id_master_submenu`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(9, 8, 1, 2, '2019-03-14 17:08:32', '2019-03-14 17:08:32'),
(10, 8, 3, 2, '2019-03-14 17:08:41', '2019-03-14 17:08:41'),
(16, 8, 2, 2, '2019-03-14 19:30:22', '2019-03-14 19:30:22'),
(17, 8, 4, 2, '2019-03-14 22:20:20', '2019-03-14 22:20:20'),
(18, 8, 5, 2, '2019-03-14 22:20:20', '2019-03-14 22:20:20'),
(19, 8, 6, 2, '2019-03-14 22:20:21', '2019-03-14 22:20:21'),
(21, 10, 33, 2, '2019-03-14 23:01:59', '2019-03-14 23:01:59'),
(22, 9, 7, 2, '2019-03-14 23:02:14', '2019-03-14 23:02:14'),
(23, 8, 63, 2, '2019-03-19 21:36:45', '2019-03-19 21:36:45'),
(24, 8, 64, 2, '2019-03-19 21:36:46', '2019-03-19 21:36:46'),
(25, 9, 8, 2, '2019-03-28 17:27:21', '2019-03-28 17:27:21'),
(26, 9, 9, 2, '2019-03-28 17:27:21', '2019-03-28 17:27:21'),
(27, 9, 10, 2, '2019-03-28 17:27:22', '2019-03-28 17:27:22'),
(28, 9, 11, 2, '2019-03-28 17:27:23', '2019-03-28 17:27:23'),
(29, 9, 12, 2, '2019-03-28 17:27:23', '2019-03-28 17:27:23'),
(30, 9, 13, 2, '2019-03-28 17:27:24', '2019-03-28 17:27:24'),
(31, 9, 14, 2, '2019-03-28 17:27:25', '2019-03-28 17:27:25'),
(32, 9, 15, 2, '2019-03-28 17:27:26', '2019-03-28 17:27:26'),
(33, 9, 16, 2, '2019-03-28 17:27:27', '2019-03-28 17:27:27'),
(34, 9, 17, 2, '2019-03-28 17:27:28', '2019-03-28 17:27:28'),
(35, 9, 18, 2, '2019-03-28 17:27:29', '2019-03-28 17:27:29'),
(36, 9, 19, 2, '2019-03-28 17:27:30', '2019-03-28 17:27:30'),
(37, 9, 20, 2, '2019-03-28 17:27:30', '2019-03-28 17:27:30'),
(38, 13, 21, 2, '2019-04-22 19:31:38', '2019-04-22 19:31:38'),
(39, 13, 25, 2, '2019-04-23 17:03:06', '2019-04-23 17:03:06'),
(40, 13, 22, 2, '2019-04-24 19:54:12', '2019-04-24 19:54:12'),
(41, 13, 26, 2, '2019-04-25 17:07:13', '2019-04-25 17:07:13'),
(42, 13, 23, 2, '2019-04-28 18:29:56', '2019-04-28 18:29:56'),
(43, 13, 24, 2, '2019-04-28 18:30:01', '2019-04-28 18:30:01'),
(44, 13, 27, 2, '2019-05-01 17:07:48', '2019-05-01 17:07:48'),
(45, 13, 28, 2, '2019-05-01 21:52:14', '2019-05-01 21:52:14'),
(46, 13, 29, 2, '2019-05-03 17:53:19', '2019-05-03 17:53:19'),
(47, 13, 30, 2, '2019-05-07 18:19:31', '2019-05-07 18:19:31'),
(48, 13, 31, 2, '2019-05-08 16:55:34', '2019-05-08 16:55:34'),
(49, 13, 32, 2, '2019-05-08 16:55:35', '2019-05-08 16:55:35'),
(50, 12, 49, 2, '2019-05-13 16:59:53', '2019-05-13 16:59:53'),
(51, 12, 50, 2, '2019-05-13 16:59:54', '2019-05-13 16:59:54'),
(52, 12, 51, 2, '2019-05-13 16:59:54', '2019-05-13 16:59:54'),
(53, 12, 52, 2, '2019-05-13 16:59:56', '2019-05-13 16:59:56'),
(54, 12, 65, 2, '2019-05-16 19:14:00', '2019-05-16 19:14:00'),
(55, 12, 53, 2, '2019-05-27 17:37:01', '2019-05-27 17:37:01'),
(56, 12, 56, 2, '2019-06-09 22:09:39', '2019-06-09 22:09:39'),
(57, 12, 57, 2, '2019-06-10 23:01:12', '2019-06-10 23:01:12'),
(58, 12, 66, 2, '2019-06-11 18:19:48', '2019-06-11 18:19:48'),
(59, 12, 61, 2, '2019-06-12 17:44:35', '2019-06-12 17:44:35'),
(60, 12, 60, 2, '2019-06-16 19:26:34', '2019-06-16 19:26:34'),
(61, 12, 67, 2, '2019-06-17 17:09:46', '2019-06-17 17:09:46'),
(62, 12, 68, 2, '2019-06-18 19:22:15', '2019-06-18 19:22:15'),
(63, 12, 69, 2, '2019-07-02 19:12:48', '2019-07-02 19:12:48'),
(64, 12, 70, 2, '2019-07-02 22:24:04', '2019-07-02 22:24:04'),
(81, 14, 71, 2, '2019-07-05 17:23:33', '2019-07-05 17:23:33'),
(82, 14, 72, 2, '2019-07-05 17:25:15', '2019-07-05 17:25:15'),
(83, 14, 73, 2, '2019-07-05 17:25:19', '2019-07-05 17:25:19'),
(84, 14, 74, 2, '2019-07-07 22:13:42', '2019-07-07 22:13:42'),
(85, 14, 75, 2, '2019-07-16 23:04:38', '2019-07-16 23:04:38'),
(86, 12, 76, 2, '2019-07-17 21:50:07', '2019-07-17 21:50:07'),
(87, 12, 77, 2, '2019-07-18 16:51:39', '2019-07-18 16:51:39'),
(88, 12, 78, 2, '2019-07-18 19:02:35', '2019-07-18 19:02:35'),
(89, 14, 79, 2, '2019-07-19 16:15:57', '2019-07-19 16:15:57'),
(90, 15, 80, 2, '2019-07-30 17:17:23', '2019-07-30 17:17:23'),
(91, 15, 82, 2, '2019-07-30 17:17:24', '2019-07-30 17:17:24'),
(92, 16, 83, 2, '2019-07-30 17:17:24', '2019-07-30 17:17:24'),
(93, 16, 84, 2, '2019-07-31 19:00:59', '2019-07-31 19:00:59'),
(94, 16, 85, 2, '2019-08-01 17:50:44', '2019-08-01 17:50:44'),
(95, 16, 86, 2, '2019-08-05 19:05:43', '2019-08-05 19:05:43'),
(96, 16, 87, 2, '2019-08-11 16:41:24', '2019-08-11 16:41:24'),
(97, 16, 88, 2, '2019-08-11 18:16:59', '2019-08-11 18:16:59'),
(98, 17, 89, 2, '2019-08-14 19:51:06', '2019-08-14 19:51:06'),
(99, 17, 90, 2, '2019-08-14 19:51:06', '2019-08-14 19:51:06'),
(100, 17, 91, 2, '2019-08-14 19:51:07', '2019-08-14 19:51:07'),
(101, 17, 94, 2, '2019-08-14 19:51:08', '2019-08-14 19:51:08'),
(102, 17, 95, 2, '2019-08-14 19:51:08', '2019-08-14 19:51:08'),
(103, 11, 40, 2, '2019-09-01 23:43:56', '2019-09-01 23:43:56'),
(104, 11, 41, 2, '2019-09-04 05:10:22', '2019-09-04 05:10:22'),
(105, 11, 96, 2, '2019-09-12 00:33:31', '2019-09-12 00:33:31'),
(106, 11, 42, 2, '2019-09-16 01:14:24', '2019-09-16 01:14:24'),
(107, 11, 44, 2, '2019-09-16 01:14:24', '2019-09-16 01:14:24'),
(108, 11, 45, 2, '2019-09-16 01:14:25', '2019-09-16 01:14:25'),
(109, 11, 97, 2, '2019-09-16 02:31:25', '2019-09-16 02:31:25'),
(110, 11, 98, 2, '2020-12-15 00:13:37', '2020-12-15 00:13:37'),
(111, 13, 99, 2, '2021-01-04 01:41:17', '2021-01-04 01:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_swot`
--

CREATE TABLE `u_swot` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_swot` year(4) NOT NULL,
  `kategori_swot` enum('strenght','weakness','opportunity','threats') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_swot`
--

INSERT INTO `u_swot` (`id`, `tahun_swot`, `kategori_swot`, `Isi`, `id_perusahaan`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2019, 'strenght', '<p>dasdasdad&nbsp;</p>', 2, 1, '2019-03-19 17:28:53', '2019-08-25 17:56:20'),
(2, 2019, 'weakness', '<ul>\r\n	<li>asdasjdalsd</li>\r\n	<li>asdas</li>\r\n	<li>da</li>\r\n	<li>sda</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n</ul>', 2, 1, '2019-03-19 17:41:42', '2019-03-19 17:41:42'),
(3, 2019, 'opportunity', '<ul>\r\n	<li>lasjdasjklas</li>\r\n	<li>da</li>\r\n	<li>sda</li>\r\n	<li>s</li>\r\n	<li>da</li>\r\n	<li>sd</li>\r\n	<li>a</li>\r\n	<li>sd</li>\r\n</ul>', 2, 1, '2019-03-19 17:42:11', '2019-03-19 17:42:11'),
(4, 2019, 'threats', '<ul>\r\n	<li>klajsdlaksjdlasd</li>\r\n	<li>asd</li>\r\n	<li>as</li>\r\n	<li>d</li>\r\n	<li>as</li>\r\n	<li>d</li>\r\n	<li>as</li>\r\n	<li>d</li>\r\n	<li>a</li>\r\n</ul>', 2, 1, '2019-03-19 17:42:29', '2019-03-19 17:42:29'),
(5, 2018, 'strenght', '<ul>\r\n	<li>lksjdlasjd</li>\r\n	<li>asjdalsd</li>\r\n	<li>asdlaksd</li>\r\n	<li>asdlas</li>\r\n	<li>asda</li>\r\n</ul>', 2, 1, '2019-03-19 18:17:27', '2019-03-19 18:17:27'),
(7, 2019, 'strenght', '<p>asda</p>', 2, 1, '2019-08-25 17:23:57', '2019-08-25 17:23:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_target_bulanan`
--

CREATE TABLE `u_target_bulanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_target_tahunan` int(10) UNSIGNED NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_bulanan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_target_jp`
--

CREATE TABLE `u_target_jp` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_tjp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` int(11) NOT NULL,
  `thn_mulai` year(4) NOT NULL,
  `thn_selesai` year(4) NOT NULL,
  `isi_tjp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_target_tahunan`
--

CREATE TABLE `u_target_tahunan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tjp` int(10) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `id_bagian_p` int(10) UNSIGNED NOT NULL,
  `id_divisi_p` int(10) UNSIGNED NOT NULL,
  `id_jabatan_p` int(10) UNSIGNED NOT NULL,
  `target_tahunan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `u_user_ukm`
--

CREATE TABLE `u_user_ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_verifikasi` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `u_user_ukm`
--

INSERT INTO `u_user_ukm` (`id`, `nama`, `email`, `password`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(5, 'Ardan', 'ardannakrantau@gmail.com', '$2y$10$dVysQvY5p6DBj.1Dy7ih2Oqf5t5keVS3T5rk9cvQ6nCAYicuRrlX.', '0', '2019-02-27 21:23:00', '2019-02-27 21:23:00'),
(6, 'Amad', 'Amad@gmail.com', '$2y$10$Ww8wlQckyMRtUv3o9U0H2.b7uU.V3COSu0PtzNfLST60smuCUQ1V.', '0', '2019-02-27 21:25:09', '2019-02-27 21:25:09'),
(7, 'Akmal', 'Akmal@gmail.con', '$2y$10$/hwPe9wI6hnq.ku8jJNJ7edamLqb1cN1EPy3Bb.yrJOyTrjnbejKO', '1', '2019-02-27 21:26:34', '2019-02-27 21:26:34'),
(13, 'Fandiansyah', 'lastfandiansyah@gmail.com', '$2y$10$wkWNxzvi0xE11H97rNJmOee23lohYWiWQeXWF4MCCVF1kr6gxaKAi', '1', '2019-02-27 23:46:56', '2019-03-03 17:31:45'),
(14, 'Herman', 'herman@gmail.com', '$2y$10$qDamueEX/F7Cf3woP54BY.phtUImB7YUmqX.aglil8W3dWjUmDOza', '1', '2019-03-08 19:39:45', '2019-03-08 19:40:28'),
(15, 'Ardan', 'ardan@gmail.com', '$2y$10$2yDTP7IU2DOLAh9GHoc04exr1SBMnD8SqteOs73QCpFyLhu4sitMi', '1', '2019-04-01 23:47:58', '2019-04-01 23:48:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `a_agenda_harian`
--
ALTER TABLE `a_agenda_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_arsip`
--
ALTER TABLE `a_arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_arsip_id_jenis_arsip_foreign` (`id_jenis_arsip`);

--
-- Indeks untuk tabel `a_ba_kemajuan`
--
ALTER TABLE `a_ba_kemajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_ba_kemajuan_id_spk_foreign` (`id_spk`);

--
-- Indeks untuk tabel `a_ba_pemeriksaan`
--
ALTER TABLE `a_ba_pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_ba_penyelesaian`
--
ALTER TABLE `a_ba_penyelesaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_ba_penyelesaian_id_spk_foreign` (`id_spk`),
  ADD KEY `a_ba_penyelesaian_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_ba_penyelesaian_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_ba_serops`
--
ALTER TABLE `a_ba_serops`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_ba_sertim`
--
ALTER TABLE `a_ba_sertim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_ba_sertim_id_spk_foreign` (`id_spk`),
  ADD KEY `a_ba_sertim_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_ba_sertim_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_jenis_arsip`
--
ALTER TABLE `a_jenis_arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_jenis_proposal`
--
ALTER TABLE `a_jenis_proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_jenis_rapat`
--
ALTER TABLE `a_jenis_rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_jenis_surat`
--
ALTER TABLE `a_jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_klien`
--
ALTER TABLE `a_klien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_misi_p`
--
ALTER TABLE `a_misi_p`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_misi_p_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_misi_p_id_karyawan_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `a_model_bisnis`
--
ALTER TABLE `a_model_bisnis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_model_bisnis_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_model_bisnis_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_pengumuman`
--
ALTER TABLE `a_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `a_peralatan`
--
ALTER TABLE `a_peralatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_peralatan_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_peralatan_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_proposal`
--
ALTER TABLE `a_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_proposal_id_jenis_prop_foreign` (`id_jenis_prop`);

--
-- Indeks untuk tabel `a_rapat`
--
ALTER TABLE `a_rapat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_rapat_id_ub_foreign` (`id_ub`);

--
-- Indeks untuk tabel `a_spk`
--
ALTER TABLE `a_spk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_spk_id_klien_foreign` (`id_klien`),
  ADD KEY `a_spk_id_prov_foreign` (`id_prov`),
  ADD KEY `a_spk_id_kab_foreign` (`id_kab`),
  ADD KEY `a_spk_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_spk_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_surat_keluar`
--
ALTER TABLE `a_surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_surat_keluar_jenis_surat_foreign` (`jenis_surat`),
  ADD KEY `a_surat_keluar_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_surat_keluar_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_surat_masuk`
--
ALTER TABLE `a_surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_surat_masuk_ditujukan_foreign` (`ditujukan`);

--
-- Indeks untuk tabel `a_usulan_brifing`
--
ALTER TABLE `a_usulan_brifing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_usulan_brifing_id_divisi_foreign` (`id_divisi`),
  ADD KEY `a_usulan_brifing_id_jenis_rapat_foreign` (`id_jenis_rapat`),
  ADD KEY `a_usulan_brifing_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_usulan_brifing_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `a_visi_p`
--
ALTER TABLE `a_visi_p`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_visi_p_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `a_visi_p_id_karyawan_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `g_alokasi_gaji`
--
ALTER TABLE `g_alokasi_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_bonus_gaji`
--
ALTER TABLE `g_bonus_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_bonus_proyek`
--
ALTER TABLE `g_bonus_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_cf`
--
ALTER TABLE `g_cf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_content_cf`
--
ALTER TABLE `g_content_cf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_daftar_gaji`
--
ALTER TABLE `g_daftar_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_grade`
--
ALTER TABLE `g_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_item_ccf`
--
ALTER TABLE `g_item_ccf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_item_tunjangan`
--
ALTER TABLE `g_item_tunjangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_kelas_proyek`
--
ALTER TABLE `g_kelas_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_klasifikasi_gaji`
--
ALTER TABLE `g_klasifikasi_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_lembur`
--
ALTER TABLE `g_lembur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_pokok_cff`
--
ALTER TABLE `g_pokok_cff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_potongan_tambahan`
--
ALTER TABLE `g_potongan_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_skala_gaji`
--
ALTER TABLE `g_skala_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_skala_tunjangan`
--
ALTER TABLE `g_skala_tunjangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_skor_posisi_cf`
--
ALTER TABLE `g_skor_posisi_cf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_slip_gaji`
--
ALTER TABLE `g_slip_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_sub_cf`
--
ALTER TABLE `g_sub_cf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_tambahan_gaji`
--
ALTER TABLE `g_tambahan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_tunjangan_gaji`
--
ALTER TABLE `g_tunjangan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_absensi`
--
ALTER TABLE `h_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_aku`
--
ALTER TABLE `h_aku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_alamat_asal`
--
ALTER TABLE `h_alamat_asal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_alamat_asal_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_alamat_sek`
--
ALTER TABLE `h_alamat_sek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_alamat_sek_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_aspek_pa`
--
ALTER TABLE `h_aspek_pa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_cuti`
--
ALTER TABLE `h_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_email_k`
--
ALTER TABLE `h_email_k`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_email_k_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_hasil_tes`
--
ALTER TABLE `h_hasil_tes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_hp_create`
--
ALTER TABLE `h_hp_create`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_hp_create_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_item_keahlian`
--
ALTER TABLE `h_item_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_item_kmanaherial`
--
ALTER TABLE `h_item_kmanaherial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_item_teknis`
--
ALTER TABLE `h_item_teknis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_item_wawancara`
--
ALTER TABLE `h_item_wawancara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_jabatan_ky`
--
ALTER TABLE `h_jabatan_ky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_jabatan_ky_id_ky_foreign` (`id_ky`),
  ADD KEY `h_jabatan_ky_id_jabatan_p_foreign` (`id_jabatan_p`),
  ADD KEY `h_jabatan_ky_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `h_jabatan_ky_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `h_jenis_kompetensi`
--
ALTER TABLE `h_jenis_kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_jenis_kontrak`
--
ALTER TABLE `h_jenis_kontrak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_jenis_kpi`
--
ALTER TABLE `h_jenis_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_jenis_psikotes`
--
ALTER TABLE `h_jenis_psikotes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_kalender_kerja`
--
ALTER TABLE `h_kalender_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_karyawan`
--
ALTER TABLE `h_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_karyawan_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `id_user_ukm` (`id_user_ukm`);

--
-- Indeks untuk tabel `h_karyawan_pelatihan`
--
ALTER TABLE `h_karyawan_pelatihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_karyawan_pelatihan_id_ky_foreign` (`id_ky`),
  ADD KEY `h_karyawan_pelatihan_id_rencana_pel_foreign` (`id_rencana_pel`);

--
-- Indeks untuk tabel `h_keluarga_ky`
--
ALTER TABLE `h_keluarga_ky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_keluarga_ky_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_kompensasi_kinerja`
--
ALTER TABLE `h_kompensasi_kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_kompetensi_majerial`
--
ALTER TABLE `h_kompetensi_majerial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_kompetensi_teknis`
--
ALTER TABLE `h_kompetensi_teknis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_kontrak_kerja`
--
ALTER TABLE `h_kontrak_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_kpi`
--
ALTER TABLE `h_kpi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_kpi_id_aku_foreign` (`id_aku`),
  ADD KEY `h_kpi_id_satuan_kpi_foreign` (`id_satuan_kpi`),
  ADD KEY `h_kpi_id_jenis_kpi_foreign` (`id_jenis_kpi`);

--
-- Indeks untuk tabel `h_kpi_karyawan`
--
ALTER TABLE `h_kpi_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_kpi_karyawan_id_ky_foreign` (`id_ky`),
  ADD KEY `h_kpi_karyawan_id_aku_foreign` (`id_aku`),
  ADD KEY `h_kpi_karyawan_id_kpi_foreign` (`id_kpi`);

--
-- Indeks untuk tabel `h_lamaran_pek`
--
ALTER TABLE `h_lamaran_pek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_log_diary`
--
ALTER TABLE `h_log_diary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_loker`
--
ALTER TABLE `h_loker`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_periode_kerja`
--
ALTER TABLE `h_periode_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_potongan_absen`
--
ALTER TABLE `h_potongan_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_potongan_tetap`
--
ALTER TABLE `h_potongan_tetap`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_predikat_penilaian`
--
ALTER TABLE `h_predikat_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_psikotes`
--
ALTER TABLE `h_psikotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_psikotes_id_jenis_psikotes_foreign` (`id_jenis_psikotes`);

--
-- Indeks untuk tabel `h_rencana_pelatihan`
--
ALTER TABLE `h_rencana_pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_request_cuti`
--
ALTER TABLE `h_request_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_satuan_kpi`
--
ALTER TABLE `h_satuan_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_seleksi_berkas`
--
ALTER TABLE `h_seleksi_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_setting_cuti`
--
ALTER TABLE `h_setting_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_sop`
--
ALTER TABLE `h_sop`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_tenaga_ahli`
--
ALTER TABLE `h_tenaga_ahli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_tenaga_ahli_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `h_tes_keahlian`
--
ALTER TABLE `h_tes_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_tes_kmanajerial`
--
ALTER TABLE `h_tes_kmanajerial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_tes_kteknis`
--
ALTER TABLE `h_tes_kteknis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_tes_manajerial`
--
ALTER TABLE `h_tes_manajerial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `h_wawancara`
--
ALTER TABLE `h_wawancara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_akad`
--
ALTER TABLE `i_akad`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_bentuk_investor`
--
ALTER TABLE `i_bentuk_investor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_bulan_dividen_s`
--
ALTER TABLE `i_bulan_dividen_s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_daftar_investasi`
--
ALTER TABLE `i_daftar_investasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_data_investor`
--
ALTER TABLE `i_data_investor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_deviden_bulan_m`
--
ALTER TABLE `i_deviden_bulan_m`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_dividen_investor`
--
ALTER TABLE `i_dividen_investor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_dividen_pelaksana`
--
ALTER TABLE `i_dividen_pelaksana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_dividen_pemodal`
--
ALTER TABLE `i_dividen_pemodal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_investor_jual_saham`
--
ALTER TABLE `i_investor_jual_saham`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_jual_saham_perusahaan`
--
ALTER TABLE `i_jual_saham_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_nisbah`
--
ALTER TABLE `i_nisbah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_pelaksana`
--
ALTER TABLE `i_pelaksana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_pemodal`
--
ALTER TABLE `i_pemodal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_periode_investasi`
--
ALTER TABLE `i_periode_investasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_persen_kas`
--
ALTER TABLE `i_persen_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_saham_perdana`
--
ALTER TABLE `i_saham_perdana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `i_saham_real`
--
ALTER TABLE `i_saham_real`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_akun_aktif_ukm`
--
ALTER TABLE `k_akun_aktif_ukm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_akun_ukm`
--
ALTER TABLE `k_akun_ukm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_investor`
--
ALTER TABLE `k_investor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_investor_id_prov_foreign` (`id_prov`),
  ADD KEY `k_investor_id_kab_foreign` (`id_kab`),
  ADD KEY `k_investor_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `id_user_ukm` (`id_user_ukm`);

--
-- Indeks untuk tabel `k_jurnal`
--
ALTER TABLE `k_jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ket_transaksi` (`id_ket_transaksi`);

--
-- Indeks untuk tabel `k_ket_transaksi`
--
ALTER TABLE `k_ket_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_laba_rugi_ditahan_tahun_berhalan`
--
ALTER TABLE `k_laba_rugi_ditahan_tahun_berhalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_master_akun`
--
ALTER TABLE `k_master_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_master_subsub_akun`
--
ALTER TABLE `k_master_subsub_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_master_sub_akun`
--
ALTER TABLE `k_master_sub_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_posisi_saldo`
--
ALTER TABLE `k_posisi_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_rencana_pend_barang`
--
ALTER TABLE `k_rencana_pend_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_rencana_pend_jasa`
--
ALTER TABLE `k_rencana_pend_jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_rencana_pengeluaran`
--
ALTER TABLE `k_rencana_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_saldo_awal`
--
ALTER TABLE `k_saldo_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_subsub_akun_ukm`
--
ALTER TABLE `k_subsub_akun_ukm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_sub_akun_ukm`
--
ALTER TABLE `k_sub_akun_ukm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_tahun_buku`
--
ALTER TABLE `k_tahun_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `k_transaksi`
--
ALTER TABLE `k_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ket_transaksi` (`id_ket_transaksi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_closing`
--
ALTER TABLE `m_closing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_content_marketing`
--
ALTER TABLE `m_content_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_content_segmenting`
--
ALTER TABLE `m_content_segmenting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_delight`
--
ALTER TABLE `m_delight`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_detail_promo`
--
ALTER TABLE `m_detail_promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_detail_promo_id_promo_foreign` (`id_promo`),
  ADD KEY `m_detail_promo_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `m_evaluasi_marketing`
--
ALTER TABLE `m_evaluasi_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_hasil_segmenting`
--
ALTER TABLE `m_hasil_segmenting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_history_klien`
--
ALTER TABLE `m_history_klien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_indikator_evaluasi`
--
ALTER TABLE `m_indikator_evaluasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_jawaban_targeting`
--
ALTER TABLE `m_jawaban_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_keg_marketing`
--
ALTER TABLE `m_keg_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_keg_marketing_harian`
--
ALTER TABLE `m_keg_marketing_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_kriteria_evaluasi`
--
ALTER TABLE `m_kriteria_evaluasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_kriteria_targeting`
--
ALTER TABLE `m_kriteria_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_media_marketing`
--
ALTER TABLE `m_media_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_pelaksanaan_marketing`
--
ALTER TABLE `m_pelaksanaan_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_penanda_sdk`
--
ALTER TABLE `m_penanda_sdk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_pertanyaan_targeting`
--
ALTER TABLE `m_pertanyaan_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_pola_targeting`
--
ALTER TABLE `m_pola_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_positioning_marketing`
--
ALTER TABLE `m_positioning_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_positioning_perusahaan`
--
ALTER TABLE `m_positioning_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_promo`
--
ALTER TABLE `m_promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_promo_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `m_rencana_marketing`
--
ALTER TABLE `m_rencana_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_respon_attract`
--
ALTER TABLE `m_respon_attract`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_respon_convert`
--
ALTER TABLE `m_respon_convert`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_respon_delight`
--
ALTER TABLE `m_respon_delight`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_respon_leads`
--
ALTER TABLE `m_respon_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rm_fase`
--
ALTER TABLE `m_rm_fase`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rm_produk`
--
ALTER TABLE `m_rm_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rm_sasaran`
--
ALTER TABLE `m_rm_sasaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rm_stp`
--
ALTER TABLE `m_rm_stp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_segmenting`
--
ALTER TABLE `m_segmenting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_solusi_evaluasi`
--
ALTER TABLE `m_solusi_evaluasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_status_closing`
--
ALTER TABLE `m_status_closing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_submedia_marketing`
--
ALTER TABLE `m_submedia_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_subsub_segmenting`
--
ALTER TABLE `m_subsub_segmenting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_sub_segmenting`
--
ALTER TABLE `m_sub_segmenting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_sumber_data_klien`
--
ALTER TABLE `m_sumber_data_klien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_targeting`
--
ALTER TABLE `m_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_barang`
--
ALTER TABLE `p_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_barang_id_kategori_produk_foreign` (`id_kategori_produk`);

--
-- Indeks untuk tabel `p_beli_barang`
--
ALTER TABLE `p_beli_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_beli_barang_id_barang_foreign` (`id_barang`),
  ADD KEY `p_beli_barang_id_suplier_foreign` (`id_suplier`);

--
-- Indeks untuk tabel `p_detail_order`
--
ALTER TABLE `p_detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_detail_order_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_detail_po`
--
ALTER TABLE `p_detail_po`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_detail_po_id_po_foreign` (`id_po`),
  ADD KEY `p_detail_po_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_detail_tb`
--
ALTER TABLE `p_detail_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_detail_tb_id_barang_foreign` (`id_barang`),
  ADD KEY `p_detail_tb_id_tawar_foreign` (`id_tawar`),
  ADD KEY `p_detail_tb_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_harga_jual_baseon_jumlah`
--
ALTER TABLE `p_harga_jual_baseon_jumlah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_harga_jual_baseon_jumlah_id_barang_foreign` (`id_barang`),
  ADD KEY `p_harga_jual_baseon_jumlah_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_harga_jual_satuan`
--
ALTER TABLE `p_harga_jual_satuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_harga_jual_satuan_id_barang_foreign` (`id_barang`),
  ADD KEY `p_harga_jual_satuan_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_history_konversi_brg`
--
ALTER TABLE `p_history_konversi_brg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_history_konversi_brg_id_konversi_brg_foreign` (`id_konversi_brg`),
  ADD KEY `p_history_konversi_brg_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_item_masuk_keluar`
--
ALTER TABLE `p_item_masuk_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_item_masuk_keluar_id_barang_foreign` (`id_barang`),
  ADD KEY `p_item_masuk_keluar_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_jadwal_proyek`
--
ALTER TABLE `p_jadwal_proyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_jadwal_proyek_id_task_p_foreign` (`id_task_p`),
  ADD KEY `p_jadwal_proyek_id_rincian_p_foreign` (`id_rincian_p`);

--
-- Indeks untuk tabel `p_jasa`
--
ALTER TABLE `p_jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_jasa_id_kategori_produk_foreign` (`id_kategori_produk`);

--
-- Indeks untuk tabel `p_jenis_pem`
--
ALTER TABLE `p_jenis_pem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_jual_barang`
--
ALTER TABLE `p_jual_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_jual_barang_id_barang_foreign` (`id_barang`),
  ADD KEY `p_jual_barang_id_klien_foreign` (`id_klien`);

--
-- Indeks untuk tabel `p_jual_jasa`
--
ALTER TABLE `p_jual_jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_jual_jasa_id_jasa_foreign` (`id_jasa`),
  ADD KEY `p_jual_jasa_id_klien_foreign` (`id_klien`);

--
-- Indeks untuk tabel `p_kategori_produk`
--
ALTER TABLE `p_kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_konversi_barang`
--
ALTER TABLE `p_konversi_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_konversi_barang_id_barang_asal_foreign` (`id_barang_asal`),
  ADD KEY `p_konversi_barang_id_barang_tujuan_foreign` (`id_barang_tujuan`),
  ADD KEY `p_konversi_barang_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_order`
--
ALTER TABLE `p_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_order_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_pemeliharaan`
--
ALTER TABLE `p_pemeliharaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_pemeliharaan_id_jenis_pem_foreign` (`id_jenis_pem`),
  ADD KEY `p_pemeliharaan_id_jual_jasa_foreign` (`id_jasa`);

--
-- Indeks untuk tabel `p_progress_proyek`
--
ALTER TABLE `p_progress_proyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_progress_proyek_id_jadwal_proyek_foreign` (`id_jadwal_proyek`);

--
-- Indeks untuk tabel `p_progres_pemeliharaan`
--
ALTER TABLE `p_progres_pemeliharaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_progres_pemeliharaan_id_pemeliharaan_foreign` (`id_pemeliharaan`);

--
-- Indeks untuk tabel `p_proyek`
--
ALTER TABLE `p_proyek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_spk` (`id_spk`);

--
-- Indeks untuk tabel `p_rincian_tugas`
--
ALTER TABLE `p_rincian_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_satuan_brg`
--
ALTER TABLE `p_satuan_brg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_stok_awal`
--
ALTER TABLE `p_stok_awal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_stok_awal_id_barang_foreign` (`id_barang`),
  ADD KEY `p_stok_awal_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_stok_opname`
--
ALTER TABLE `p_stok_opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_stok_opname_id_barang_foreign` (`id_barang`),
  ADD KEY `p_stok_opname_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `p_subkategori_produk`
--
ALTER TABLE `p_subkategori_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_subkategori_produk_id_kategori_produk_foreign` (`id_kategori_produk`);

--
-- Indeks untuk tabel `p_subsubkategori_produk`
--
ALTER TABLE `p_subsubkategori_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_subsubkategori_produk_id_subkategori_produk_foreign` (`id_subkategori_produk`);

--
-- Indeks untuk tabel `p_supplier`
--
ALTER TABLE `p_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_task_proyek`
--
ALTER TABLE `p_task_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `p_tawar_beli`
--
ALTER TABLE `p_tawar_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_tawar_beli_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `p_tawar_beli_id_supplier_foreign` (`id_supplier`);

--
-- Indeks untuk tabel `p_tim_proyek`
--
ALTER TABLE `p_tim_proyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_tim_proyek_id_proyek_foreign` (`id_proyek`),
  ADD KEY `p_tim_proyek_id_ky_foreign` (`id_ky`);

--
-- Indeks untuk tabel `struktur_perusahaan`
--
ALTER TABLE `struktur_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `struktur_perusahaan_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `struktur_perusahaan_id_jabatan_foreign` (`id_jabatan`),
  ADD KEY `struktur_perusahaan_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `tbl_p_po`
--
ALTER TABLE `tbl_p_po`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_p_po_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `u_akta`
--
ALTER TABLE `u_akta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_akta_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_akta_id_karyawan_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_bagian_p`
--
ALTER TABLE `u_bagian_p`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_bagian_p_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_bagian_p_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_devisi_p`
--
ALTER TABLE `u_devisi_p`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_devisi_p_id_bagian_p_foreign` (`id_bagian_p`),
  ADD KEY `u_devisi_p_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_devisi_p_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_ijin_usaha`
--
ALTER TABLE `u_ijin_usaha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_ijin_usaha_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_ijin_usaha_id_karyawan_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_jabatan_p`
--
ALTER TABLE `u_jabatan_p`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_jabatan_p_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_jabatan_p_id_karyawan_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_job_desc`
--
ALTER TABLE `u_job_desc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_job_desc_id_jabatan_p_foreign` (`id_jabatan_p`),
  ADD KEY `u_job_desc_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_job_desc_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_kabupaten`
--
ALTER TABLE `u_kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_kabupaten_id_provinsi_foreign` (`id_provinsi`);

--
-- Indeks untuk tabel `u_master_menu`
--
ALTER TABLE `u_master_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_master_submenu`
--
ALTER TABLE `u_master_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_master_submenu_id_master_menu_foreign` (`id_master_menu`);

--
-- Indeks untuk tabel `u_menu_investor`
--
ALTER TABLE `u_menu_investor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_menu_investor_id_menu_ukm_foreign` (`id_menu_ukm`),
  ADD KEY `u_menu_investor_id_submenu_ukm_foreign` (`id_submenu_ukm`),
  ADD KEY `u_menu_investor_id_user_ukm_foreign` (`id_user_ukm`),
  ADD KEY `u_menu_investor_id_investor_foreign` (`id_investor`);

--
-- Indeks untuk tabel `u_menu_karyawan`
--
ALTER TABLE `u_menu_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_menu_karyawan_id_menu_ukm_foreign` (`id_menu_ukm`),
  ADD KEY `u_menu_karyawan_id_submenu_ukm_foreign` (`id_submenu_ukm`),
  ADD KEY `u_menu_karyawan_id_karyawan_foreign` (`id_karyawan`),
  ADD KEY `u_menu_karyawan_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `id_user_ukm` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_menu_ukm`
--
ALTER TABLE `u_menu_ukm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_menu_ukm_id_master_menu_foreign` (`id_master_menu`),
  ADD KEY `u_menu_ukm_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `u_perusahaan`
--
ALTER TABLE `u_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_perusahaan_id_prov_foreign` (`id_prov`),
  ADD KEY `u_perusahaan_id_kab_foreign` (`id_kab`),
  ADD KEY `u_perusahaan_id_user_ukm_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_profil`
--
ALTER TABLE `u_profil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_profil_id_user_ukm_foreign` (`id_user_ukm`);

--
-- Indeks untuk tabel `u_provinsi`
--
ALTER TABLE `u_provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_strategi_bulanan`
--
ALTER TABLE `u_strategi_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_strategi_jp`
--
ALTER TABLE `u_strategi_jp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_strategi_jpd`
--
ALTER TABLE `u_strategi_jpd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_strategi_jpd_id_sjpg_foreign` (`id_sjpg`),
  ADD KEY `u_strategi_jpd_id_bagian_p_foreign` (`id_bagian_p`),
  ADD KEY `u_strategi_jpd_id_divisi_p_foreign` (`id_divisi_p`),
  ADD KEY `u_strategi_jpd_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_strategi_jpd_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_strategi_jpg`
--
ALTER TABLE `u_strategi_jpg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_strategi_jpg_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_strategi_jpg_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_strategi_tahunan`
--
ALTER TABLE `u_strategi_tahunan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_submenu_ukm`
--
ALTER TABLE `u_submenu_ukm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_submenu_ukm_id_menu_foreign` (`id_menu_ukm`),
  ADD KEY `u_submenu_ukm_id_master_submenu_foreign` (`id_master_submenu`),
  ADD KEY `u_submenu_ukm_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indeks untuk tabel `u_swot`
--
ALTER TABLE `u_swot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_swot_id_perusahaan_foreign` (`id_perusahaan`),
  ADD KEY `u_swot_id_karyawan_foreign` (`id_karyawan`);

--
-- Indeks untuk tabel `u_target_bulanan`
--
ALTER TABLE `u_target_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_target_jp`
--
ALTER TABLE `u_target_jp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_target_tahunan`
--
ALTER TABLE `u_target_tahunan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `u_user_ukm`
--
ALTER TABLE `u_user_ukm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_ukm_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `a_agenda_harian`
--
ALTER TABLE `a_agenda_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `a_arsip`
--
ALTER TABLE `a_arsip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `a_ba_kemajuan`
--
ALTER TABLE `a_ba_kemajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_ba_pemeriksaan`
--
ALTER TABLE `a_ba_pemeriksaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `a_ba_penyelesaian`
--
ALTER TABLE `a_ba_penyelesaian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `a_ba_serops`
--
ALTER TABLE `a_ba_serops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `a_ba_sertim`
--
ALTER TABLE `a_ba_sertim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_jenis_arsip`
--
ALTER TABLE `a_jenis_arsip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `a_jenis_proposal`
--
ALTER TABLE `a_jenis_proposal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_jenis_rapat`
--
ALTER TABLE `a_jenis_rapat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `a_jenis_surat`
--
ALTER TABLE `a_jenis_surat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `a_klien`
--
ALTER TABLE `a_klien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `a_misi_p`
--
ALTER TABLE `a_misi_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_model_bisnis`
--
ALTER TABLE `a_model_bisnis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `a_pengumuman`
--
ALTER TABLE `a_pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `a_peralatan`
--
ALTER TABLE `a_peralatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `a_proposal`
--
ALTER TABLE `a_proposal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `a_rapat`
--
ALTER TABLE `a_rapat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `a_spk`
--
ALTER TABLE `a_spk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `a_surat_keluar`
--
ALTER TABLE `a_surat_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `a_surat_masuk`
--
ALTER TABLE `a_surat_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `a_usulan_brifing`
--
ALTER TABLE `a_usulan_brifing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `a_visi_p`
--
ALTER TABLE `a_visi_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `g_alokasi_gaji`
--
ALTER TABLE `g_alokasi_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `g_bonus_gaji`
--
ALTER TABLE `g_bonus_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `g_bonus_proyek`
--
ALTER TABLE `g_bonus_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `g_cf`
--
ALTER TABLE `g_cf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `g_content_cf`
--
ALTER TABLE `g_content_cf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `g_daftar_gaji`
--
ALTER TABLE `g_daftar_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `g_grade`
--
ALTER TABLE `g_grade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `g_item_ccf`
--
ALTER TABLE `g_item_ccf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `g_item_tunjangan`
--
ALTER TABLE `g_item_tunjangan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `g_kelas_proyek`
--
ALTER TABLE `g_kelas_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `g_klasifikasi_gaji`
--
ALTER TABLE `g_klasifikasi_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `g_lembur`
--
ALTER TABLE `g_lembur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `g_pokok_cff`
--
ALTER TABLE `g_pokok_cff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `g_potongan_tambahan`
--
ALTER TABLE `g_potongan_tambahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `g_skala_gaji`
--
ALTER TABLE `g_skala_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `g_skala_tunjangan`
--
ALTER TABLE `g_skala_tunjangan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `g_skor_posisi_cf`
--
ALTER TABLE `g_skor_posisi_cf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `g_slip_gaji`
--
ALTER TABLE `g_slip_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `g_sub_cf`
--
ALTER TABLE `g_sub_cf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `g_tambahan_gaji`
--
ALTER TABLE `g_tambahan_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `g_tunjangan_gaji`
--
ALTER TABLE `g_tunjangan_gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `h_absensi`
--
ALTER TABLE `h_absensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_aku`
--
ALTER TABLE `h_aku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_alamat_asal`
--
ALTER TABLE `h_alamat_asal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_alamat_sek`
--
ALTER TABLE `h_alamat_sek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_aspek_pa`
--
ALTER TABLE `h_aspek_pa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_cuti`
--
ALTER TABLE `h_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_email_k`
--
ALTER TABLE `h_email_k`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_hasil_tes`
--
ALTER TABLE `h_hasil_tes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_hp_create`
--
ALTER TABLE `h_hp_create`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_item_keahlian`
--
ALTER TABLE `h_item_keahlian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `h_item_kmanaherial`
--
ALTER TABLE `h_item_kmanaherial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_item_teknis`
--
ALTER TABLE `h_item_teknis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_item_wawancara`
--
ALTER TABLE `h_item_wawancara`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_jabatan_ky`
--
ALTER TABLE `h_jabatan_ky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `h_jenis_kompetensi`
--
ALTER TABLE `h_jenis_kompetensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_jenis_kontrak`
--
ALTER TABLE `h_jenis_kontrak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_jenis_kpi`
--
ALTER TABLE `h_jenis_kpi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_jenis_psikotes`
--
ALTER TABLE `h_jenis_psikotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_kalender_kerja`
--
ALTER TABLE `h_kalender_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_karyawan`
--
ALTER TABLE `h_karyawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `h_karyawan_pelatihan`
--
ALTER TABLE `h_karyawan_pelatihan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_keluarga_ky`
--
ALTER TABLE `h_keluarga_ky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_kompensasi_kinerja`
--
ALTER TABLE `h_kompensasi_kinerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_kompetensi_majerial`
--
ALTER TABLE `h_kompetensi_majerial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_kompetensi_teknis`
--
ALTER TABLE `h_kompetensi_teknis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_kontrak_kerja`
--
ALTER TABLE `h_kontrak_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_kpi`
--
ALTER TABLE `h_kpi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `h_kpi_karyawan`
--
ALTER TABLE `h_kpi_karyawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `h_lamaran_pek`
--
ALTER TABLE `h_lamaran_pek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `h_log_diary`
--
ALTER TABLE `h_log_diary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_loker`
--
ALTER TABLE `h_loker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_periode_kerja`
--
ALTER TABLE `h_periode_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `h_potongan_absen`
--
ALTER TABLE `h_potongan_absen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_potongan_tetap`
--
ALTER TABLE `h_potongan_tetap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_predikat_penilaian`
--
ALTER TABLE `h_predikat_penilaian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `h_psikotes`
--
ALTER TABLE `h_psikotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_rencana_pelatihan`
--
ALTER TABLE `h_rencana_pelatihan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_request_cuti`
--
ALTER TABLE `h_request_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_satuan_kpi`
--
ALTER TABLE `h_satuan_kpi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `h_seleksi_berkas`
--
ALTER TABLE `h_seleksi_berkas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_setting_cuti`
--
ALTER TABLE `h_setting_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_sop`
--
ALTER TABLE `h_sop`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `h_tenaga_ahli`
--
ALTER TABLE `h_tenaga_ahli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_tes_keahlian`
--
ALTER TABLE `h_tes_keahlian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_tes_kmanajerial`
--
ALTER TABLE `h_tes_kmanajerial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `h_tes_kteknis`
--
ALTER TABLE `h_tes_kteknis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `h_tes_manajerial`
--
ALTER TABLE `h_tes_manajerial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `h_wawancara`
--
ALTER TABLE `h_wawancara`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `i_akad`
--
ALTER TABLE `i_akad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `i_bentuk_investor`
--
ALTER TABLE `i_bentuk_investor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `i_bulan_dividen_s`
--
ALTER TABLE `i_bulan_dividen_s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `i_daftar_investasi`
--
ALTER TABLE `i_daftar_investasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `i_data_investor`
--
ALTER TABLE `i_data_investor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `i_deviden_bulan_m`
--
ALTER TABLE `i_deviden_bulan_m`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `i_dividen_investor`
--
ALTER TABLE `i_dividen_investor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `i_dividen_pelaksana`
--
ALTER TABLE `i_dividen_pelaksana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `i_dividen_pemodal`
--
ALTER TABLE `i_dividen_pemodal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `i_investor_jual_saham`
--
ALTER TABLE `i_investor_jual_saham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `i_jual_saham_perusahaan`
--
ALTER TABLE `i_jual_saham_perusahaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `i_nisbah`
--
ALTER TABLE `i_nisbah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `i_pelaksana`
--
ALTER TABLE `i_pelaksana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `i_pemodal`
--
ALTER TABLE `i_pemodal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `i_periode_investasi`
--
ALTER TABLE `i_periode_investasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `i_persen_kas`
--
ALTER TABLE `i_persen_kas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `i_saham_perdana`
--
ALTER TABLE `i_saham_perdana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `i_saham_real`
--
ALTER TABLE `i_saham_real`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `k_akun_aktif_ukm`
--
ALTER TABLE `k_akun_aktif_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT untuk tabel `k_akun_ukm`
--
ALTER TABLE `k_akun_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `k_investor`
--
ALTER TABLE `k_investor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `k_jurnal`
--
ALTER TABLE `k_jurnal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `k_ket_transaksi`
--
ALTER TABLE `k_ket_transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `k_laba_rugi_ditahan_tahun_berhalan`
--
ALTER TABLE `k_laba_rugi_ditahan_tahun_berhalan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_master_akun`
--
ALTER TABLE `k_master_akun`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `k_master_subsub_akun`
--
ALTER TABLE `k_master_subsub_akun`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `k_master_sub_akun`
--
ALTER TABLE `k_master_sub_akun`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `k_posisi_saldo`
--
ALTER TABLE `k_posisi_saldo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_rencana_pend_barang`
--
ALTER TABLE `k_rencana_pend_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_rencana_pend_jasa`
--
ALTER TABLE `k_rencana_pend_jasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_rencana_pengeluaran`
--
ALTER TABLE `k_rencana_pengeluaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_saldo_awal`
--
ALTER TABLE `k_saldo_awal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `k_subsub_akun_ukm`
--
ALTER TABLE `k_subsub_akun_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `k_sub_akun_ukm`
--
ALTER TABLE `k_sub_akun_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `k_tahun_buku`
--
ALTER TABLE `k_tahun_buku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `k_transaksi`
--
ALTER TABLE `k_transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT untuk tabel `m_closing`
--
ALTER TABLE `m_closing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_content_marketing`
--
ALTER TABLE `m_content_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_content_segmenting`
--
ALTER TABLE `m_content_segmenting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_delight`
--
ALTER TABLE `m_delight`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_detail_promo`
--
ALTER TABLE `m_detail_promo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_evaluasi_marketing`
--
ALTER TABLE `m_evaluasi_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_hasil_segmenting`
--
ALTER TABLE `m_hasil_segmenting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_history_klien`
--
ALTER TABLE `m_history_klien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_indikator_evaluasi`
--
ALTER TABLE `m_indikator_evaluasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_jawaban_targeting`
--
ALTER TABLE `m_jawaban_targeting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_keg_marketing`
--
ALTER TABLE `m_keg_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_keg_marketing_harian`
--
ALTER TABLE `m_keg_marketing_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_kriteria_evaluasi`
--
ALTER TABLE `m_kriteria_evaluasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_kriteria_targeting`
--
ALTER TABLE `m_kriteria_targeting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_media_marketing`
--
ALTER TABLE `m_media_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_pelaksanaan_marketing`
--
ALTER TABLE `m_pelaksanaan_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_penanda_sdk`
--
ALTER TABLE `m_penanda_sdk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_pertanyaan_targeting`
--
ALTER TABLE `m_pertanyaan_targeting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_pola_targeting`
--
ALTER TABLE `m_pola_targeting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_positioning_marketing`
--
ALTER TABLE `m_positioning_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_positioning_perusahaan`
--
ALTER TABLE `m_positioning_perusahaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_promo`
--
ALTER TABLE `m_promo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_rencana_marketing`
--
ALTER TABLE `m_rencana_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_respon_attract`
--
ALTER TABLE `m_respon_attract`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_respon_convert`
--
ALTER TABLE `m_respon_convert`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_respon_delight`
--
ALTER TABLE `m_respon_delight`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_respon_leads`
--
ALTER TABLE `m_respon_leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_rm_fase`
--
ALTER TABLE `m_rm_fase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_rm_produk`
--
ALTER TABLE `m_rm_produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_rm_sasaran`
--
ALTER TABLE `m_rm_sasaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_rm_stp`
--
ALTER TABLE `m_rm_stp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_segmenting`
--
ALTER TABLE `m_segmenting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_solusi_evaluasi`
--
ALTER TABLE `m_solusi_evaluasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_status_closing`
--
ALTER TABLE `m_status_closing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_submedia_marketing`
--
ALTER TABLE `m_submedia_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_subsub_segmenting`
--
ALTER TABLE `m_subsub_segmenting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_sub_segmenting`
--
ALTER TABLE `m_sub_segmenting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_sumber_data_klien`
--
ALTER TABLE `m_sumber_data_klien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_targeting`
--
ALTER TABLE `m_targeting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `p_barang`
--
ALTER TABLE `p_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `p_beli_barang`
--
ALTER TABLE `p_beli_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_detail_order`
--
ALTER TABLE `p_detail_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_detail_po`
--
ALTER TABLE `p_detail_po`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `p_detail_tb`
--
ALTER TABLE `p_detail_tb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `p_harga_jual_baseon_jumlah`
--
ALTER TABLE `p_harga_jual_baseon_jumlah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `p_harga_jual_satuan`
--
ALTER TABLE `p_harga_jual_satuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `p_history_konversi_brg`
--
ALTER TABLE `p_history_konversi_brg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `p_item_masuk_keluar`
--
ALTER TABLE `p_item_masuk_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_jadwal_proyek`
--
ALTER TABLE `p_jadwal_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `p_jasa`
--
ALTER TABLE `p_jasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `p_jenis_pem`
--
ALTER TABLE `p_jenis_pem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `p_jual_barang`
--
ALTER TABLE `p_jual_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `p_jual_jasa`
--
ALTER TABLE `p_jual_jasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_kategori_produk`
--
ALTER TABLE `p_kategori_produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `p_konversi_barang`
--
ALTER TABLE `p_konversi_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `p_order`
--
ALTER TABLE `p_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_pemeliharaan`
--
ALTER TABLE `p_pemeliharaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_progress_proyek`
--
ALTER TABLE `p_progress_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_progres_pemeliharaan`
--
ALTER TABLE `p_progres_pemeliharaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `p_proyek`
--
ALTER TABLE `p_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_rincian_tugas`
--
ALTER TABLE `p_rincian_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `p_satuan_brg`
--
ALTER TABLE `p_satuan_brg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `p_stok_awal`
--
ALTER TABLE `p_stok_awal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_stok_opname`
--
ALTER TABLE `p_stok_opname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `p_subkategori_produk`
--
ALTER TABLE `p_subkategori_produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `p_subsubkategori_produk`
--
ALTER TABLE `p_subsubkategori_produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `p_supplier`
--
ALTER TABLE `p_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `p_task_proyek`
--
ALTER TABLE `p_task_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `p_tawar_beli`
--
ALTER TABLE `p_tawar_beli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `p_tim_proyek`
--
ALTER TABLE `p_tim_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `struktur_perusahaan`
--
ALTER TABLE `struktur_perusahaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_p_po`
--
ALTER TABLE `tbl_p_po`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `u_akta`
--
ALTER TABLE `u_akta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `u_bagian_p`
--
ALTER TABLE `u_bagian_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `u_devisi_p`
--
ALTER TABLE `u_devisi_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `u_ijin_usaha`
--
ALTER TABLE `u_ijin_usaha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `u_jabatan_p`
--
ALTER TABLE `u_jabatan_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `u_job_desc`
--
ALTER TABLE `u_job_desc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `u_kabupaten`
--
ALTER TABLE `u_kabupaten`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `u_master_menu`
--
ALTER TABLE `u_master_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `u_master_submenu`
--
ALTER TABLE `u_master_submenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `u_menu_investor`
--
ALTER TABLE `u_menu_investor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `u_menu_karyawan`
--
ALTER TABLE `u_menu_karyawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `u_menu_ukm`
--
ALTER TABLE `u_menu_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `u_perusahaan`
--
ALTER TABLE `u_perusahaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `u_profil`
--
ALTER TABLE `u_profil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `u_provinsi`
--
ALTER TABLE `u_provinsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `u_strategi_bulanan`
--
ALTER TABLE `u_strategi_bulanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_strategi_jp`
--
ALTER TABLE `u_strategi_jp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_strategi_jpd`
--
ALTER TABLE `u_strategi_jpd`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `u_strategi_jpg`
--
ALTER TABLE `u_strategi_jpg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `u_strategi_tahunan`
--
ALTER TABLE `u_strategi_tahunan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_submenu_ukm`
--
ALTER TABLE `u_submenu_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `u_swot`
--
ALTER TABLE `u_swot`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `u_target_bulanan`
--
ALTER TABLE `u_target_bulanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_target_jp`
--
ALTER TABLE `u_target_jp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_target_tahunan`
--
ALTER TABLE `u_target_tahunan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `u_user_ukm`
--
ALTER TABLE `u_user_ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `a_arsip`
--
ALTER TABLE `a_arsip`
  ADD CONSTRAINT `a_arsip_id_jenis_arsip_foreign` FOREIGN KEY (`id_jenis_arsip`) REFERENCES `a_jenis_arsip` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_ba_kemajuan`
--
ALTER TABLE `a_ba_kemajuan`
  ADD CONSTRAINT `a_ba_kemajuan_id_spk_foreign` FOREIGN KEY (`id_spk`) REFERENCES `a_spk` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_ba_penyelesaian`
--
ALTER TABLE `a_ba_penyelesaian`
  ADD CONSTRAINT `a_ba_penyelesaian_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_ba_penyelesaian_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `a_ba_penyelesaian_id_spk_foreign` FOREIGN KEY (`id_spk`) REFERENCES `a_spk` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_ba_sertim`
--
ALTER TABLE `a_ba_sertim`
  ADD CONSTRAINT `a_ba_sertim_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_ba_sertim_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `a_ba_sertim_id_spk_foreign` FOREIGN KEY (`id_spk`) REFERENCES `a_spk` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_misi_p`
--
ALTER TABLE `a_misi_p`
  ADD CONSTRAINT `a_misi_p_id_karyawan_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `a_misi_p_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_model_bisnis`
--
ALTER TABLE `a_model_bisnis`
  ADD CONSTRAINT `a_model_bisnis_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_model_bisnis_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_peralatan`
--
ALTER TABLE `a_peralatan`
  ADD CONSTRAINT `a_peralatan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_peralatan_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_proposal`
--
ALTER TABLE `a_proposal`
  ADD CONSTRAINT `a_proposal_id_jenis_prop_foreign` FOREIGN KEY (`id_jenis_prop`) REFERENCES `a_jenis_proposal` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_rapat`
--
ALTER TABLE `a_rapat`
  ADD CONSTRAINT `a_rapat_id_ub_foreign` FOREIGN KEY (`id_ub`) REFERENCES `a_usulan_brifing` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_spk`
--
ALTER TABLE `a_spk`
  ADD CONSTRAINT `a_spk_id_kab_foreign` FOREIGN KEY (`id_kab`) REFERENCES `u_kabupaten` (`id`),
  ADD CONSTRAINT `a_spk_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_spk_id_klien_foreign` FOREIGN KEY (`id_klien`) REFERENCES `a_klien` (`id`),
  ADD CONSTRAINT `a_spk_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `a_spk_id_prov_foreign` FOREIGN KEY (`id_prov`) REFERENCES `u_provinsi` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_surat_keluar`
--
ALTER TABLE `a_surat_keluar`
  ADD CONSTRAINT `a_surat_keluar_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_surat_keluar_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `a_surat_keluar_jenis_surat_foreign` FOREIGN KEY (`jenis_surat`) REFERENCES `a_jenis_surat` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_surat_masuk`
--
ALTER TABLE `a_surat_masuk`
  ADD CONSTRAINT `a_surat_masuk_ditujukan_foreign` FOREIGN KEY (`ditujukan`) REFERENCES `u_jabatan_p` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_usulan_brifing`
--
ALTER TABLE `a_usulan_brifing`
  ADD CONSTRAINT `a_usulan_brifing_id_divisi_foreign` FOREIGN KEY (`id_divisi`) REFERENCES `u_devisi_p` (`id`),
  ADD CONSTRAINT `a_usulan_brifing_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `a_usulan_brifing_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `a_visi_p`
--
ALTER TABLE `a_visi_p`
  ADD CONSTRAINT `a_visi_p_id_karyawan_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `a_visi_p_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_alamat_asal`
--
ALTER TABLE `h_alamat_asal`
  ADD CONSTRAINT `h_alamat_asal_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_alamat_sek`
--
ALTER TABLE `h_alamat_sek`
  ADD CONSTRAINT `h_alamat_sek_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_email_k`
--
ALTER TABLE `h_email_k`
  ADD CONSTRAINT `h_email_k_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_hp_create`
--
ALTER TABLE `h_hp_create`
  ADD CONSTRAINT `h_hp_create_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_jabatan_ky`
--
ALTER TABLE `h_jabatan_ky`
  ADD CONSTRAINT `h_jabatan_ky_id_jabatan_p_foreign` FOREIGN KEY (`id_jabatan_p`) REFERENCES `u_jabatan_p` (`id`),
  ADD CONSTRAINT `h_jabatan_ky_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `h_jabatan_ky_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `h_jabatan_ky_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_karyawan`
--
ALTER TABLE `h_karyawan`
  ADD CONSTRAINT `h_karyawan_ibfk_1` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `h_karyawan_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_karyawan_pelatihan`
--
ALTER TABLE `h_karyawan_pelatihan`
  ADD CONSTRAINT `h_karyawan_pelatihan_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `h_karyawan_pelatihan_id_rencana_pel_foreign` FOREIGN KEY (`id_rencana_pel`) REFERENCES `h_rencana_pelatihan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_keluarga_ky`
--
ALTER TABLE `h_keluarga_ky`
  ADD CONSTRAINT `h_keluarga_ky_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_kpi`
--
ALTER TABLE `h_kpi`
  ADD CONSTRAINT `h_kpi_id_aku_foreign` FOREIGN KEY (`id_aku`) REFERENCES `h_aku` (`id`),
  ADD CONSTRAINT `h_kpi_id_jenis_kpi_foreign` FOREIGN KEY (`id_jenis_kpi`) REFERENCES `h_jenis_kpi` (`id`),
  ADD CONSTRAINT `h_kpi_id_satuan_kpi_foreign` FOREIGN KEY (`id_satuan_kpi`) REFERENCES `h_satuan_kpi` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_kpi_karyawan`
--
ALTER TABLE `h_kpi_karyawan`
  ADD CONSTRAINT `h_kpi_karyawan_id_aku_foreign` FOREIGN KEY (`id_aku`) REFERENCES `h_aku` (`id`),
  ADD CONSTRAINT `h_kpi_karyawan_id_kpi_foreign` FOREIGN KEY (`id_kpi`) REFERENCES `h_kpi` (`id`),
  ADD CONSTRAINT `h_kpi_karyawan_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_psikotes`
--
ALTER TABLE `h_psikotes`
  ADD CONSTRAINT `h_psikotes_id_jenis_psikotes_foreign` FOREIGN KEY (`id_jenis_psikotes`) REFERENCES `h_jenis_psikotes` (`id`);

--
-- Ketidakleluasaan untuk tabel `h_tenaga_ahli`
--
ALTER TABLE `h_tenaga_ahli`
  ADD CONSTRAINT `h_tenaga_ahli_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`);

--
-- Ketidakleluasaan untuk tabel `k_investor`
--
ALTER TABLE `k_investor`
  ADD CONSTRAINT `k_investor_ibfk_1` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `k_investor_id_kab_foreign` FOREIGN KEY (`id_kab`) REFERENCES `u_kabupaten` (`id`),
  ADD CONSTRAINT `k_investor_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `k_investor_id_prov_foreign` FOREIGN KEY (`id_prov`) REFERENCES `u_provinsi` (`id`);

--
-- Ketidakleluasaan untuk tabel `k_jurnal`
--
ALTER TABLE `k_jurnal`
  ADD CONSTRAINT `k_jurnal_ibfk_1` FOREIGN KEY (`id_ket_transaksi`) REFERENCES `k_ket_transaksi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `k_transaksi`
--
ALTER TABLE `k_transaksi`
  ADD CONSTRAINT `k_transaksi_ibfk_1` FOREIGN KEY (`id_ket_transaksi`) REFERENCES `k_ket_transaksi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_detail_promo`
--
ALTER TABLE `m_detail_promo`
  ADD CONSTRAINT `m_detail_promo_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_detail_promo_id_promo_foreign` FOREIGN KEY (`id_promo`) REFERENCES `m_promo` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_promo`
--
ALTER TABLE `m_promo`
  ADD CONSTRAINT `m_promo_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_barang`
--
ALTER TABLE `p_barang`
  ADD CONSTRAINT `p_barang_id_kategori_produk_foreign` FOREIGN KEY (`id_kategori_produk`) REFERENCES `p_kategori_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_beli_barang`
--
ALTER TABLE `p_beli_barang`
  ADD CONSTRAINT `p_beli_barang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`),
  ADD CONSTRAINT `p_beli_barang_id_suplier_foreign` FOREIGN KEY (`id_suplier`) REFERENCES `p_supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_detail_order`
--
ALTER TABLE `p_detail_order`
  ADD CONSTRAINT `p_detail_order_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_detail_po`
--
ALTER TABLE `p_detail_po`
  ADD CONSTRAINT `p_detail_po_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_detail_po_id_po_foreign` FOREIGN KEY (`id_po`) REFERENCES `tbl_p_po` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_detail_tb`
--
ALTER TABLE `p_detail_tb`
  ADD CONSTRAINT `p_detail_tb_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_detail_tb_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_detail_tb_id_tawar_foreign` FOREIGN KEY (`id_tawar`) REFERENCES `p_tawar_beli` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_harga_jual_baseon_jumlah`
--
ALTER TABLE `p_harga_jual_baseon_jumlah`
  ADD CONSTRAINT `p_harga_jual_baseon_jumlah_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_harga_jual_baseon_jumlah_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_harga_jual_satuan`
--
ALTER TABLE `p_harga_jual_satuan`
  ADD CONSTRAINT `p_harga_jual_satuan_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_harga_jual_satuan_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_history_konversi_brg`
--
ALTER TABLE `p_history_konversi_brg`
  ADD CONSTRAINT `p_history_konversi_brg_id_konversi_brg_foreign` FOREIGN KEY (`id_konversi_brg`) REFERENCES `p_konversi_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_history_konversi_brg_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_item_masuk_keluar`
--
ALTER TABLE `p_item_masuk_keluar`
  ADD CONSTRAINT `p_item_masuk_keluar_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_item_masuk_keluar_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_jadwal_proyek`
--
ALTER TABLE `p_jadwal_proyek`
  ADD CONSTRAINT `p_jadwal_proyek_id_rincian_p_foreign` FOREIGN KEY (`id_rincian_p`) REFERENCES `p_rincian_tugas` (`id`),
  ADD CONSTRAINT `p_jadwal_proyek_id_task_p_foreign` FOREIGN KEY (`id_task_p`) REFERENCES `p_task_proyek` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_jasa`
--
ALTER TABLE `p_jasa`
  ADD CONSTRAINT `p_jasa_id_kategori_produk_foreign` FOREIGN KEY (`id_kategori_produk`) REFERENCES `p_kategori_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_jual_barang`
--
ALTER TABLE `p_jual_barang`
  ADD CONSTRAINT `p_jual_barang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`),
  ADD CONSTRAINT `p_jual_barang_id_klien_foreign` FOREIGN KEY (`id_klien`) REFERENCES `a_klien` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_jual_jasa`
--
ALTER TABLE `p_jual_jasa`
  ADD CONSTRAINT `p_jual_jasa_id_jasa_foreign` FOREIGN KEY (`id_jasa`) REFERENCES `p_jasa` (`id`),
  ADD CONSTRAINT `p_jual_jasa_id_klien_foreign` FOREIGN KEY (`id_klien`) REFERENCES `a_klien` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_konversi_barang`
--
ALTER TABLE `p_konversi_barang`
  ADD CONSTRAINT `p_konversi_barang_id_barang_asal_foreign` FOREIGN KEY (`id_barang_asal`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_konversi_barang_id_barang_tujuan_foreign` FOREIGN KEY (`id_barang_tujuan`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_konversi_barang_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_order`
--
ALTER TABLE `p_order`
  ADD CONSTRAINT `p_order_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_pemeliharaan`
--
ALTER TABLE `p_pemeliharaan`
  ADD CONSTRAINT `p_pemeliharaan_id_jenis_pem_foreign` FOREIGN KEY (`id_jenis_pem`) REFERENCES `p_jenis_pem` (`id`),
  ADD CONSTRAINT `p_pemeliharaan_id_jual_jasa_foreign` FOREIGN KEY (`id_jasa`) REFERENCES `p_jasa` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_progress_proyek`
--
ALTER TABLE `p_progress_proyek`
  ADD CONSTRAINT `p_progress_proyek_id_jadwal_proyek_foreign` FOREIGN KEY (`id_jadwal_proyek`) REFERENCES `p_jadwal_proyek` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_progres_pemeliharaan`
--
ALTER TABLE `p_progres_pemeliharaan`
  ADD CONSTRAINT `p_progres_pemeliharaan_id_pemeliharaan_foreign` FOREIGN KEY (`id_pemeliharaan`) REFERENCES `p_pemeliharaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_proyek`
--
ALTER TABLE `p_proyek`
  ADD CONSTRAINT `p_proyek_id_spk_foreign` FOREIGN KEY (`id_spk`) REFERENCES `a_spk` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_stok_awal`
--
ALTER TABLE `p_stok_awal`
  ADD CONSTRAINT `p_stok_awal_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_stok_awal_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_stok_opname`
--
ALTER TABLE `p_stok_opname`
  ADD CONSTRAINT `p_stok_opname_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `p_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_stok_opname_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_subkategori_produk`
--
ALTER TABLE `p_subkategori_produk`
  ADD CONSTRAINT `p_subkategori_produk_id_kategori_produk_foreign` FOREIGN KEY (`id_kategori_produk`) REFERENCES `p_kategori_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_subsubkategori_produk`
--
ALTER TABLE `p_subsubkategori_produk`
  ADD CONSTRAINT `p_subsubkategori_produk_id_subkategori_produk_foreign` FOREIGN KEY (`id_subkategori_produk`) REFERENCES `p_subkategori_produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `p_tawar_beli`
--
ALTER TABLE `p_tawar_beli`
  ADD CONSTRAINT `p_tawar_beli_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p_tawar_beli_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `p_supplier` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `p_tim_proyek`
--
ALTER TABLE `p_tim_proyek`
  ADD CONSTRAINT `p_tim_proyek_id_ky_foreign` FOREIGN KEY (`id_ky`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `p_tim_proyek_id_proyek_foreign` FOREIGN KEY (`id_proyek`) REFERENCES `p_proyek` (`id`);

--
-- Ketidakleluasaan untuk tabel `struktur_perusahaan`
--
ALTER TABLE `struktur_perusahaan`
  ADD CONSTRAINT `struktur_perusahaan_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `u_jabatan_p` (`id`),
  ADD CONSTRAINT `struktur_perusahaan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `struktur_perusahaan_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_p_po`
--
ALTER TABLE `tbl_p_po`
  ADD CONSTRAINT `tbl_p_po_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `u_akta`
--
ALTER TABLE `u_akta`
  ADD CONSTRAINT `u_akta_id_karyawan_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `u_akta_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_bagian_p`
--
ALTER TABLE `u_bagian_p`
  ADD CONSTRAINT `u_bagian_p_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_bagian_p_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_devisi_p`
--
ALTER TABLE `u_devisi_p`
  ADD CONSTRAINT `u_devisi_p_id_bagian_p_foreign` FOREIGN KEY (`id_bagian_p`) REFERENCES `u_bagian_p` (`id`),
  ADD CONSTRAINT `u_devisi_p_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_devisi_p_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_ijin_usaha`
--
ALTER TABLE `u_ijin_usaha`
  ADD CONSTRAINT `u_ijin_usaha_id_karyawan_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `u_ijin_usaha_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_jabatan_p`
--
ALTER TABLE `u_jabatan_p`
  ADD CONSTRAINT `u_jabatan_p_id_karyawan_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `u_jabatan_p_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_job_desc`
--
ALTER TABLE `u_job_desc`
  ADD CONSTRAINT `u_job_desc_id_jabatan_p_foreign` FOREIGN KEY (`id_jabatan_p`) REFERENCES `u_jabatan_p` (`id`),
  ADD CONSTRAINT `u_job_desc_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_job_desc_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_kabupaten`
--
ALTER TABLE `u_kabupaten`
  ADD CONSTRAINT `u_kabupaten_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `u_provinsi` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_master_submenu`
--
ALTER TABLE `u_master_submenu`
  ADD CONSTRAINT `u_master_submenu_ibfk_1` FOREIGN KEY (`id_master_menu`) REFERENCES `u_master_menu` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_menu_investor`
--
ALTER TABLE `u_menu_investor`
  ADD CONSTRAINT `u_menu_investor_id_investor_foreign` FOREIGN KEY (`id_investor`) REFERENCES `k_investor` (`id`),
  ADD CONSTRAINT `u_menu_investor_id_menu_ukm_foreign` FOREIGN KEY (`id_menu_ukm`) REFERENCES `u_menu_ukm` (`id`),
  ADD CONSTRAINT `u_menu_investor_id_submenu_ukm_foreign` FOREIGN KEY (`id_submenu_ukm`) REFERENCES `u_submenu_ukm` (`id`),
  ADD CONSTRAINT `u_menu_investor_id_user_ukm_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_menu_karyawan`
--
ALTER TABLE `u_menu_karyawan`
  ADD CONSTRAINT `u_menu_karyawan_ibfk_1` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`),
  ADD CONSTRAINT `u_menu_karyawan_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_menu_karyawan_id_menu_ukm_foreign` FOREIGN KEY (`id_menu_ukm`) REFERENCES `u_menu_ukm` (`id`),
  ADD CONSTRAINT `u_menu_karyawan_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `u_menu_karyawan_id_submenu_ukm_foreign` FOREIGN KEY (`id_submenu_ukm`) REFERENCES `u_submenu_ukm` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_menu_ukm`
--
ALTER TABLE `u_menu_ukm`
  ADD CONSTRAINT `u_menu_ukm_id_master_menu_foreign` FOREIGN KEY (`id_master_menu`) REFERENCES `u_master_menu` (`id`),
  ADD CONSTRAINT `u_menu_ukm_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_perusahaan`
--
ALTER TABLE `u_perusahaan`
  ADD CONSTRAINT `u_perusahaan_id_kab_foreign` FOREIGN KEY (`id_kab`) REFERENCES `u_kabupaten` (`id`),
  ADD CONSTRAINT `u_perusahaan_id_prov_foreign` FOREIGN KEY (`id_prov`) REFERENCES `u_provinsi` (`id`),
  ADD CONSTRAINT `u_perusahaan_id_user_ukm_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_profil`
--
ALTER TABLE `u_profil`
  ADD CONSTRAINT `u_profil_id_user_ukm_foreign` FOREIGN KEY (`id_user_ukm`) REFERENCES `u_user_ukm` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_strategi_jpd`
--
ALTER TABLE `u_strategi_jpd`
  ADD CONSTRAINT `u_strategi_jpd_id_bagian_p_foreign` FOREIGN KEY (`id_bagian_p`) REFERENCES `u_bagian_p` (`id`),
  ADD CONSTRAINT `u_strategi_jpd_id_divisi_p_foreign` FOREIGN KEY (`id_divisi_p`) REFERENCES `u_devisi_p` (`id`),
  ADD CONSTRAINT `u_strategi_jpd_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_strategi_jpd_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`),
  ADD CONSTRAINT `u_strategi_jpd_id_sjpg_foreign` FOREIGN KEY (`id_sjpg`) REFERENCES `u_strategi_jpg` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_strategi_jpg`
--
ALTER TABLE `u_strategi_jpg`
  ADD CONSTRAINT `u_strategi_jpg_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_strategi_jpg_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);

--
-- Ketidakleluasaan untuk tabel `u_swot`
--
ALTER TABLE `u_swot`
  ADD CONSTRAINT `u_swot_id_karyawan_foreign` FOREIGN KEY (`id_karyawan`) REFERENCES `h_karyawan` (`id`),
  ADD CONSTRAINT `u_swot_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `u_perusahaan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
