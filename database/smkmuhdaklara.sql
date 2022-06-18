-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2022 at 05:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkmuhdaklara_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblkaryawan`
--

CREATE TABLE `tblkaryawan` (
  `karyawanId` int(11) NOT NULL,
  `usercode` varchar(8) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `createdBy` varchar(8) DEFAULT NULL,
  `createddate` datetime DEFAULT curdate(),
  `updatedBy` varchar(8) DEFAULT NULL,
  `updateddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblkaryawan`
--

INSERT INTO `tblkaryawan` (`karyawanId`, `usercode`, `nama`, `jenis_kelamin`, `createdBy`, `createddate`, `updatedBy`, `updateddate`) VALUES
(1, 'KR001', 'Rudi Hermawan', 'P', NULL, '2022-02-03 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsystem`
--

CREATE TABLE `tblsystem` (
  `id` int(11) NOT NULL,
  `systemType` varchar(50) NOT NULL,
  `systemCode` varchar(10) NOT NULL,
  `systemDesc` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsystem`
--

INSERT INTO `tblsystem` (`id`, `systemType`, `systemCode`, `systemDesc`, `created_by`, `created_dt`, `updated_by`, `updated_dt`) VALUES
(1, 'dropdown_jenis_tabungan', 'TU', 'Tabungan Umum', 'system', '2022-02-05 00:00:00', NULL, NULL),
(2, 'dropdown_jenis_tabungan', 'TS', 'Tabungan Siswa', 'system', '2022-02-05 00:00:00', NULL, NULL),
(3, 'dropdown_jenis_tabungan', 'TG', 'Tabungan Guru', 'system', '2022-02-05 00:00:00', NULL, NULL),
(4, 'dropdown_jenis_kelamin', 'M', 'Laki-Laki', 'system', '2022-02-05 00:00:00', NULL, NULL),
(5, 'dropdown_jenis_kelamin', 'F', 'Perempuan', 'system', '2022-02-05 00:00:00', NULL, NULL),
(6, 'dropdown_sandi', '1', 'Penyetoran', 'system', '2022-03-13 00:00:00', NULL, NULL),
(7, 'dropdown_sandi', '2', 'Pengambilan', 'system', '2022-03-13 00:00:00', NULL, NULL),
(8, 'dropdown_sandi', '3', 'Pemindah Bukuan Kredit', 'system', '2022-03-13 00:00:00', NULL, NULL),
(9, 'dropdown_sandi', '4', 'Pemindah Bukuan Debet', 'system', '2022-03-13 00:00:00', NULL, NULL),
(10, 'dropdown_sandi', '5', 'Bunga', 'system', '2022-03-13 00:00:00', NULL, NULL),
(11, 'dropdown_sandi', '6', 'Koreksi', 'system', '2022-03-16 00:00:00', NULL, NULL),
(12, 'dropdown_sandi', '7', 'Pemindah bukuan', 'system', '2022-03-16 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `usercode` varchar(8) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(3) NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedBy` varchar(50) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `usercode`, `username`, `password`, `role`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(1, 'KR001', 'admin', 'admin', 'adm', 'admin', '2022-01-30 00:00:00', NULL, NULL),
(2, 'KR002', 'admin2', 'admin2', 'adm', 'admin', '2022-01-30 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TB_M_NASABAH`
--

CREATE TABLE `TB_M_NASABAH` (
  `id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_tabungan` varchar(10) NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tanggal_masuk` int(11) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TB_M_NASABAH`
--

INSERT INTO `TB_M_NASABAH` (`id`, `nis`, `nama`, `jenis_tabungan`, `nomor_rekening`, `alamat`, `jenis_kelamin`, `tanggal_masuk`, `created_by`, `created_dt`, `updated_by`, `updated_dt`) VALUES
(21, 'TU0001', 'rudi ', 'TU', 123456678, 'Kebondalem', 'M', 2019, 'Rudi Hermawan', '2022-02-05 08:28:23', 'Rudi Hermawan', '2022-02-06 12:20:22'),
(22, 'TU0002', 'Bagas Baskara', 'TU', 303000022020, 'klaten selatan', 'M', 2020, 'Rudi Hermawan', '2022-02-05 12:39:53', NULL, NULL),
(23, '10201234', 'Widya astuti', 'TS', 303012342020, 'wedi klaten', 'F', 2020, 'Rudi Hermawan', '2022-02-05 12:40:52', NULL, NULL),
(24, 'TG0002', 'Damar riswanto', 'TG', 303000022005, 'prambanan', 'M', 2005, 'Rudi Hermawan', '2022-02-05 12:43:18', NULL, NULL),
(25, 'TG0003', 'Dias Prabasari', 'TG', 303000032000, 'bayat', 'F', 2000, 'Rudi Hermawan', '2022-02-05 12:45:15', NULL, NULL),
(26, '121201001', 'rahmawati', 'TS', 303010012021, 'bayat', 'F', 2021, 'Rudi Hermawan', '2022-02-05 12:51:23', 'Rudi Hermawan', '2022-02-06 11:45:21'),
(30, 'TU0003', 'Andi Malaria', 'TU', 303000032010, 'dolon', 'F', 2010, 'Rudi Hermawan', '2022-02-06 10:58:03', 'Rudi Hermawan', '2022-02-06 12:06:34'),
(33, 'TU0004', 'maryanto', 'TU', 303000042001, 'paseban bayat klaten', 'M', 2001, 'Rudi Hermawan', '2022-02-07 07:19:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `nomor_rekening` bigint(20) NOT NULL,
  `nis` varchar(6) DEFAULT NULL,
  `debit` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL,
  `saldo` decimal(10,0) DEFAULT NULL,
  `sandi` varchar(6) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `nomor_rekening`, `nis`, `debit`, `kredit`, `saldo`, `sandi`, `created_by`, `created_dt`, `updated_by`, `updated_dt`) VALUES
(1, 303000022020, 'TU0002', '0', '80000', '80000', '1', 'Rudi Hermawan', '2022-03-16 12:28:30', NULL, NULL),
(2, 303000022020, 'TU0002', '0', '150000', '230000', '1', 'Rudi Hermawan', '2022-03-16 12:52:34', NULL, NULL),
(3, 303000022020, 'TU0002', '50000', '0', '180000', '2', 'Rudi Hermawan', '2022-03-16 12:55:42', NULL, NULL),
(4, 303000022020, 'TU0002', '0', '100000', '280000', '1', 'Rudi Hermawan', '2022-03-16 12:59:06', NULL, NULL),
(5, 303000022020, 'TU0002', '0', '50000', '330000', '1', 'Rudi Hermawan', '2022-03-16 13:02:17', NULL, NULL),
(6, 303000042001, 'TU0004', '0', '100000', '100000', '1', 'Rudi Hermawan', '2022-03-21 00:09:24', NULL, NULL),
(7, 303000042001, 'TU0004', '0', '100000', '200000', '1', 'Rudi Hermawan', '2022-03-21 00:09:27', NULL, NULL),
(8, 303010012021, '121201', '0', '100000', '100000', '1', 'Rudi Hermawan', '2022-03-21 00:10:08', NULL, NULL),
(9, 303000032010, 'TU0003', '0', '100000', '100000', '1', 'Rudi Hermawan', '2022-03-21 00:10:37', NULL, NULL),
(10, 303000032010, 'TU0003', '0', '100000', '200000', '1', 'Rudi Hermawan', '2022-03-21 00:10:37', NULL, NULL),
(11, 303000032010, 'TU0003', '50000', '0', '150000', '2', 'Rudi Hermawan', '2022-03-21 00:11:49', NULL, NULL),
(12, 303000042001, 'TU0004', '50000', '0', '150000', '2', 'Rudi Hermawan', '2022-03-21 00:12:21', NULL, NULL),
(13, 303000032000, 'TG0003', '0', '100000', '100000', '1', 'Rudi Hermawan', '2022-03-21 00:41:02', NULL, NULL),
(14, 303000022005, 'TG0002', '0', '100000', '100000', '1', 'Rudi Hermawan', '2022-03-21 00:44:33', NULL, NULL),
(15, 303000022005, 'TG0002', '0', '50000', '150000', '1', 'Rudi Hermawan', '2022-03-28 05:41:56', NULL, NULL),
(16, 303000022020, 'TU0002', '150000', '0', '180000', '2', 'Rudi Hermawan', '2022-03-28 06:02:09', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  ADD PRIMARY KEY (`karyawanId`);

--
-- Indexes for table `tblsystem`
--
ALTER TABLE `tblsystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `TB_M_NASABAH`
--
ALTER TABLE `TB_M_NASABAH`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  MODIFY `karyawanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsystem`
--
ALTER TABLE `tblsystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TB_M_NASABAH`
--
ALTER TABLE `TB_M_NASABAH`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;