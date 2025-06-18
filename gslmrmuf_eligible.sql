-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2025 at 11:29 AM
-- Server version: 10.5.26-MariaDB-cll-lve
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gslmrmuf_eligible`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `id` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`id`, `nama_mapel`, `semester`, `jurusan`) VALUES
(1, 'Pendidikan Jasmani', 1, 1),
(2, 'Pendidikan Rohani', 2, 1),
(3, 'Geografi', 1, 1),
(4, 'Pendidikan Seni Budaya', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id` int(11) NOT NULL,
  `nisn_siswa` varchar(100) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nilai_keterampilan` int(11) NOT NULL,
  `nilai_pengetahuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id`, `nisn_siswa`, `id_mapel`, `nilai_keterampilan`, `nilai_pengetahuan`) VALUES
(12, '11', 1, 12, 15),
(13, '11', 3, 15, 90),
(14, '11', 4, 50, 50),
(15, '11', 2, 15, 80),
(16, '12121', 1, 90, 90),
(17, '12121', 3, 90, 90),
(18, '12121', 4, 90, 90),
(19, '12121', 2, 90, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prestasi_siswa`
--

CREATE TABLE `tbl_prestasi_siswa` (
  `id` int(11) NOT NULL,
  `nisn_siswa` varchar(100) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_prestasi_siswa`
--

INSERT INTO `tbl_prestasi_siswa` (`id`, `nisn_siswa`, `type`, `nama_prestasi`, `tanggal`) VALUES
(12, '12121', 'internasional', 'sempak bola', '2025-05-18'),
(13, '11', 'internasional', 'Juara bertahan', '2025-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` tinyint(4) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `nama_role`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rombongan`
--

CREATE TABLE `tbl_rombongan` (
  `id` int(11) NOT NULL,
  `rombongan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_rombongan`
--

INSERT INTO `tbl_rombongan` (`id`, `rombongan`) VALUES
(1, 'IPA'),
(2, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `namasekolah` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `akreditasi` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `namasekolah`, `alamat`, `akreditasi`, `foto`) VALUES
(1, 'sekolah123', 'bnmbmnbmnbbbmbmbmbxbxbvbvbxccv', 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(11) NOT NULL,
  `namasiswa` varchar(100) DEFAULT NULL,
  `nisn` varchar(100) DEFAULT NULL,
  `jeniskelamin` varchar(20) DEFAULT NULL,
  `jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `namasiswa`, `nisn`, `jeniskelamin`, `jurusan`) VALUES
(13, 'test', '12121', 'Pria', 2),
(14, 'Alkiem', '1231131', 'Perempuan', 2),
(15, 'Natasya', '11', 'Perempuan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_gender` int(11) NOT NULL,
  `id_role` tinyint(4) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama_lengkap`, `email`, `password`, `id_gender`, `id_role`, `is_active`) VALUES
(1, 'Admin', 'admin@localhost.com', '$2y$10$vIfeFoJAkJ8jSARMxYjN7.q006OGXZQEq91k7lEspGTnmdmqsnHfy', 1, 1, 1),
(5, 'user', 'user@localhost.com', '$2y$10$xFmCQLN95ck/Yu.T4jw3Euv71nnoOq2NbrxHCiGI/1NU25igIO30O', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusanMapel` (`jurusan`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nisn_siswa` (`nisn_siswa`),
  ADD KEY `mapelNilai` (`id_mapel`);

--
-- Indexes for table `tbl_prestasi_siswa`
--
ALTER TABLE `tbl_prestasi_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nisn` (`nisn_siswa`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rombongan`
--
ALTER TABLE `tbl_rombongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_prestasi_siswa`
--
ALTER TABLE `tbl_prestasi_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_rombongan`
--
ALTER TABLE `tbl_rombongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD CONSTRAINT `jurusanMapel` FOREIGN KEY (`jurusan`) REFERENCES `tbl_rombongan` (`id`);

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `mapelNilai` FOREIGN KEY (`id_mapel`) REFERENCES `tbl_mapel` (`id`),
  ADD CONSTRAINT `nisn_siswa` FOREIGN KEY (`nisn_siswa`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Constraints for table `tbl_prestasi_siswa`
--
ALTER TABLE `tbl_prestasi_siswa`
  ADD CONSTRAINT `nisn` FOREIGN KEY (`nisn_siswa`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `jurusan` FOREIGN KEY (`jurusan`) REFERENCES `tbl_rombongan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
