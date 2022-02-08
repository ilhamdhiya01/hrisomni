-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2022 at 05:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrisomni`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `no_cuti` varchar(20) NOT NULL,
  `id_nama` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `keperluan` text NOT NULL,
  `lama` int(200) NOT NULL,
  `ket_lama` varchar(20) NOT NULL,
  `mulai` date NOT NULL,
  `sampai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `no_cuti`, `id_nama`, `id_divisi`, `keperluan`, `lama`, `ket_lama`, `mulai`, `sampai`) VALUES
(3, '', 1, 7, 'cuti', 1, 'Hari', '2021-12-28', '2021-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `data_k`
--

CREATE TABLE `data_k` (
  `id_nama` int(11) NOT NULL,
  `no_nama` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tempat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` int(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_k`
--

INSERT INTO `data_k` (`id_nama`, `no_nama`, `nama`, `tgl_masuk`, `tempat`, `tgl_lahir`, `jk`, `alamat`, `nohp`, `email`) VALUES
(1, '', 'Ihmatull Muthmainnah', '2017-07-10', 'Semarang', '1998-07-23', 'P', 'Jl. Sri Rejeki Utara IV no 15 RT 003 RW 001, Kel Kalibanteng Kidul, Kec Semarang Barat', 896688126, 'e.ihmatull@gmail.com'),
(2, '', 'Samuel Vittorio Rivaldo', '2017-12-02', 'Jakarta', '1999-09-10', 'L', 'Jl. Udowo Barat I no 29, Kel Bulu Lor, Kec Semarang Utara', 82242193, 'samuelvittorior@hotm'),
(3, '', 'agus', '2020-06-17', 'Semarang', '1993-10-07', 'L', ' adafa', 8722689, 'vina@gmail.com'),
(5, '', 'Nafa', '2021-01-04', 'Demak', '2007-01-29', 'P', 'ktryrytfk', 8722689, 'ema@gmail.com'),
(6, '', 'Dita mawar', '2016-02-15', 'Semarang', '1998-07-08', 'P', 'jl pedurungan', 8765422, 'dita@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `no_divisi` varchar(20) NOT NULL,
  `divisi_d` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `no_divisi`, `divisi_d`) VALUES
(7, 'D001', 'AR'),
(8, 'D002', 'LOG'),
(11, 'D003', 'MANAGER');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `no_user` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_nama` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `level` int(20) NOT NULL COMMENT '1 : admin, 2 : staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_user`, `username`, `password`, `id_nama`, `id_divisi`, `level`) VALUES
(13, 'U001', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 7, 1),
(14, 'U002', 'rio', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, 8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD UNIQUE KEY `no_cuti` (`no_cuti`),
  ADD KEY `id_divisi` (`id_divisi`),
  ADD KEY `cuti_ibfk_2` (`id_nama`);

--
-- Indexes for table `data_k`
--
ALTER TABLE `data_k`
  ADD PRIMARY KEY (`id_nama`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD UNIQUE KEY `no_divisi` (`no_divisi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `no_user` (`no_user`),
  ADD KEY `id_nama` (`id_nama`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_k`
--
ALTER TABLE `data_k`
  MODIFY `id_nama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`),
  ADD CONSTRAINT `cuti_ibfk_2` FOREIGN KEY (`id_nama`) REFERENCES `data_k` (`id_nama`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_nama`) REFERENCES `data_k` (`id_nama`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
