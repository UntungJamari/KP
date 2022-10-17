-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2022 at 09:02 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengawasan_umrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `kab_kota`
--

CREATE TABLE `kab_kota` (
  `id_kab_kota` int(11) NOT NULL,
  `nama_kab_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kab_kota`
--

INSERT INTO `kab_kota` (`id_kab_kota`, `nama_kab_kota`) VALUES
(1, 'Kabupaten Agam'),
(2, 'Kabupaten Dharmasraya'),
(3, 'Kabupaten Kepulauan Mentawai'),
(4, 'Kabupaten Lima Puluh Kota'),
(5, 'Kabupaten Padang Pariaman'),
(6, 'Kabupaten Pasaman'),
(7, 'Kabupaten Pasaman Barat'),
(8, 'Kabupaten Pesisir Selatan'),
(9, 'Kabupaten Sijunjung'),
(10, 'Kabupaten Solok'),
(11, 'Kabupaten Solok Selatan'),
(12, 'Kabupaten Tanah Datar'),
(13, 'Kota Bukittinggi'),
(14, 'Kota Padang'),
(15, 'Kota Padang Panjang'),
(16, 'Kota Pariaman'),
(17, 'Kota Payakumbuh'),
(18, 'Kota Sawahlunto'),
(19, 'Kota Solok');

-- --------------------------------------------------------

--
-- Table structure for table `kemenag_kab_kota`
--

CREATE TABLE `kemenag_kab_kota` (
  `id_kemenag_kab_kota` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_kab_kota` int(11) NOT NULL,
  `nama_pimpinan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ppiu`
--

CREATE TABLE `ppiu` (
  `id_ppiu` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_ppiu` varchar(255) NOT NULL,
  `id_kab_kota` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nomor_sk` varchar(255) NOT NULL,
  `tanggal_sk` varchar(255) NOT NULL,
  `alamat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('bap_bkt', '$2y$10$r/UG/wB8nv5uXZINlaIlDuQnZEWjCmJ3rqQxNEZEDvFZvwnFD/K0G', 'ppiu'),
('kanwil', '$2y$10$4Atgs7OOtJP/Yrvuup4aZOmHRJsWDkpQgR7wpg1iY3W9ymzSCmOyi', 'kanwil'),
('kemenag_pyk', '$2y$10$FrgGhRa8VIfYz.VBYmgli.DqxTmlHrDg7ZDrS8WsfmMFouRZ7VoEy', 'kab/kota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kab_kota`
--
ALTER TABLE `kab_kota`
  ADD PRIMARY KEY (`id_kab_kota`);

--
-- Indexes for table `kemenag_kab_kota`
--
ALTER TABLE `kemenag_kab_kota`
  ADD PRIMARY KEY (`id_kemenag_kab_kota`),
  ADD KEY `username` (`username`),
  ADD KEY `id_kab_kota` (`id_kab_kota`);

--
-- Indexes for table `ppiu`
--
ALTER TABLE `ppiu`
  ADD PRIMARY KEY (`id_ppiu`),
  ADD KEY `id_kab_kota` (`id_kab_kota`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kab_kota`
--
ALTER TABLE `kab_kota`
  MODIFY `id_kab_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kemenag_kab_kota`
--
ALTER TABLE `kemenag_kab_kota`
  MODIFY `id_kemenag_kab_kota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppiu`
--
ALTER TABLE `ppiu`
  MODIFY `id_ppiu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kemenag_kab_kota`
--
ALTER TABLE `kemenag_kab_kota`
  ADD CONSTRAINT `kemenag_kab_kota_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kemenag_kab_kota_ibfk_2` FOREIGN KEY (`id_kab_kota`) REFERENCES `kab_kota` (`id_kab_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ppiu`
--
ALTER TABLE `ppiu`
  ADD CONSTRAINT `ppiu_ibfk_1` FOREIGN KEY (`id_kab_kota`) REFERENCES `kab_kota` (`id_kab_kota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ppiu_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
