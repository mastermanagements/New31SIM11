-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 04:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aturusaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `u_master_submenu`
--

CREATE TABLE `u_master_submenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_master_menu` int(10) UNSIGNED NOT NULL,
  `kelompok_submenu` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''0=perdagangan, 1=Jasa, 2=Perdagangan & Jasa, 3 = Manufaktur''',
  `jenis_submenu` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''0= submenu utama, 1=submenu tambahan''',
  `nm_submenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `u_master_submenu`
--

INSERT INTO `u_master_submenu` (`id`, `id_master_menu`, `kelompok_submenu`, `jenis_submenu`, `nm_submenu`, `urutan`, `url`, `created_at`, `updated_at`) VALUES
(9, 2, '0', '0', 'Klien/Customer', 9, 'Klien', NULL, NULL),
(10, 2, '0', '0', 'Barang', 10, 'Barang', NULL, NULL),
(11, 2, '0', '0', 'Supplier', 11, 'Supplier', NULL, NULL),
(12, 2, '0', '0', 'Syarat & Ketentuan', 12, '#', NULL, NULL),
(13, 2, '0', '0', 'Investasi', 13, 'Data-Investasi', NULL, NULL),
(22, 6, '0', '0', 'Inventory', 22, 'inventory', NULL, NULL),
(23, 6, '0', '0', 'Pembelian', 23, 'Pembelian', NULL, NULL),
(25, 6, '0', '0', 'Penjualan', 25, 'Penjualan', NULL, NULL),
(26, 6, '0', '0', 'Kasir', 26, 'Kasir', NULL, NULL),
(41, 9, '0', '0', 'Akun', 41, 'Akun', NULL, NULL),
(42, 9, '0', '0', 'Rencana Anggaran Belanja (RAB)', 42, 'RAB', NULL, NULL),
(43, 9, '0', '0', 'Transaksi', 43, 'Transaksi', NULL, NULL),
(44, 9, '0', '0', 'Saldo Awal', 44, 'Saldo-awal', NULL, NULL),
(45, 9, '0', '0', 'Jurnal Umum', 45, 'Jurnal-Umum', NULL, NULL),
(46, 9, '0', '0', 'Jurnal Penyesuaian', 46, 'Jurnal-Penyesuaian', NULL, NULL),
(47, 9, '0', '0', 'Tutup Buku', 47, 'Tutup-Buku', NULL, NULL),
(94, 14, '0', '0', 'Daftar Barang & harga jual', 94, '#', NULL, NULL),
(95, 14, '0', '0', 'Item Barang  Masuk Keluar', 95, '#', NULL, NULL),
(96, 14, '0', '0', 'Stok Barang', 96, 'laporan-stok-barang', NULL, NULL),
(152, 30, '1', '0', 'Klien/Customer', 9, 'Klien', NULL, NULL),
(153, 30, '1', '0', 'Barang', 10, 'Barang', NULL, NULL),
(154, 30, '1', '0', 'Supplier', 11, 'Supplier', NULL, NULL),
(155, 30, '1', '0', 'Syarat & Ketentuan', 12, '#', NULL, NULL),
(156, 34, '2', '0', 'barang', 0, '#', NULL, NULL),
(157, 34, '2', '', 'klien', 0, '#', NULL, NULL),
(158, 36, '3', '', 'produksi', 0, '#', NULL, NULL),
(159, 37, '3', '', 'beli', 0, '#', NULL, NULL),
(160, 31, '1', '0', 'DAftar Layanan', 0, '#', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `u_master_submenu`
--
ALTER TABLE `u_master_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_master_submenu_id_master_menu_foreign` (`id_master_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `u_master_submenu`
--
ALTER TABLE `u_master_submenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
