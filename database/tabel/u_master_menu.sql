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
-- Table structure for table `u_master_menu`
--

CREATE TABLE `u_master_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelompok_menu` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''0=perdagangan, 1=Jasa, 2=Perdagangan & Jasa, 3 = Manufaktur''',
  `jenis_menu` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0=menu utama, 1= menu tambahan''',
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nm_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `u_master_menu`
--

INSERT INTO `u_master_menu` (`id`, `kelompok_menu`, `jenis_menu`, `icon`, `nm_menu`, `created_at`, `updated_at`) VALUES
(2, '0', '0', 'master.png', 'Data Master', NULL, NULL),
(6, '0', '0', 'dagang.png', 'Perdagangan', NULL, NULL),
(9, '0', '0', 'uang.png', 'Keuangan', NULL, NULL),
(14, '0', '0', 'report.png', 'Laporan', NULL, NULL),
(30, '1', '0', 'master.png', 'Data Master', NULL, NULL),
(31, '1', '0', 'service.png', 'Jasa', NULL, NULL),
(32, '1', '0', 'uang.png', 'Keuangan', NULL, NULL),
(33, '1', '0', 'report.png', 'Laporan', NULL, NULL),
(34, '2', '0', NULL, 'Data Master', NULL, NULL),
(35, '2', '0', NULL, 'Perdagangan', NULL, NULL),
(36, '3', '0', '', 'Manufaktur', NULL, NULL),
(37, '3', '0', NULL, 'Perdagangan', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `u_master_menu`
--
ALTER TABLE `u_master_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `u_master_menu`
--
ALTER TABLE `u_master_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
