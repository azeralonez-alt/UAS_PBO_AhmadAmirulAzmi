-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_ahmadamirulazmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` int NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` int DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Amirul Azmi', '240101', 2, 5000000, 'Mandiri', 'IV', 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', '240102', 2, 6500000, 'Mandiri', 'V', 'Ahmad Subarjo', NULL, NULL, NULL, NULL),
(3, 'Rizky Fauzi', '240103', 4, 4000000, 'Mandiri', 'III', 'Eko Prasetyo', NULL, NULL, NULL, NULL),
(4, 'Dinda Lestari', '240104', 4, 5000000, 'Mandiri', 'IV', 'Faris Setiawan', NULL, NULL, NULL, NULL),
(5, 'Fajar Nugroho', '240105', 6, 7500000, 'Mandiri', 'VI', 'Gani Wijaya', NULL, NULL, NULL, NULL),
(6, 'Amanda Putri', '240106', 6, 4000000, 'Mandiri', 'III', 'Hadi Sucipto', NULL, NULL, NULL, NULL),
(7, 'Bagus Saputra', '240107', 2, 6500000, 'Mandiri', 'V', 'Iwan Kurniawan', NULL, NULL, NULL, NULL),
(8, 'Citra Dewi', '240108', 2, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-001', 700000, NULL, NULL),
(9, 'Dimas Pratama', '240109', 2, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-002', 700000, NULL, NULL),
(10, 'Eka Wahyuni', '240110', 4, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-003', 750000, NULL, NULL),
(11, 'Farhan Yudha', '240111', 4, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-004', 750000, NULL, NULL),
(12, 'Gita Permata', '240112', 6, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-005', 800000, NULL, NULL),
(13, 'Hendra Wijaya', '240113', 6, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-006', 800000, NULL, NULL),
(14, 'Indah Sari', '240114', 2, 0, 'Bidikmisi', NULL, NULL, 'KIP-2026-007', 700000, NULL, NULL),
(15, 'Joko Susilo', '240115', 4, 1500000, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', '3.50'),
(16, 'Kartika Putri', '240116', 4, 2000000, 'Prestasi', NULL, NULL, NULL, NULL, 'PT Adaro Energy', '3.40'),
(17, 'Laksana Tri', '240117', 6, 0, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', '3.60'),
(18, 'Mega Utami', '240118', 6, 1000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan', '3.50'),
(19, 'Nanda Rizki', '240119', 2, 2500000, 'Prestasi', NULL, NULL, NULL, NULL, 'Tanoto Foundation', '3.75'),
(20, 'Oki Dermawan', '240120', 2, 0, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', '3.50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
