-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 05:57 AM
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
  `alamat` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'logo_kemenag.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kemenag_kab_kota`
--

INSERT INTO `kemenag_kab_kota` (`id_kemenag_kab_kota`, `username`, `id_kab_kota`, `nama_pimpinan`, `alamat`, `logo`) VALUES
(1, 'kemenag_bukittinggi', 13, '', 'Jl. Bt. Ombilin II No.10, Belakang Balok, Kec. Aur Birugo Tigo Baleh, Kota Bukittinggi, Sumatera Barat 26136', 'logo_kemenag.png');

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
  `tanggal_sk` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_pimpinan` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ppiu`
--

INSERT INTO `ppiu` (`id_ppiu`, `username`, `nama_ppiu`, `id_kab_kota`, `status`, `nomor_sk`, `tanggal_sk`, `alamat`, `nama_pimpinan`, `logo`) VALUES
(1, 'bap_bkt', 'PT. Bonita Anugerah Pratama', 13, 'Pusat', 'No. U.81 Tahun 2020', '2020-03-31', 'Bawah Kantor Dinas Pasar No. 4 Pasar Simpang Aur Bukittinggi Tlp.0752-32520 Fax.0752-32560', NULL, 'default2.png'),
(2, 'ram_bkt', 'PT. Rizkia Amanah Mandiri', 13, 'Pusat', 'No. U. 499 Tahun 2020', '2020-12-06', 'Jl. Soekarno Hatta No. 117 RT 002 RW 003 Kel. Manggis Ganting Kec. Mandiangin Koto Selayan Kota Bukittinggi', NULL, 'default.png'),
(3, 'mftt_agm', 'PT. Mahabbah Family Tour dan Travel', 1, 'Pusat', 'No. 9120005970756 Tahun 2022', '2022-01-27', 'Jalan Lintas Lubuk Basung Bukittinggi Jorong Lubuk Anyir RT/RW 00/00 Kel. Bayua Kec. Tanjung Raya Kab. Agam', NULL, 'default.png'),
(4, 'ahw_pasbar', 'PT. Azra Humaira Wisata', 7, 'Pusat', 'No.410 Tahun 2020', '2020-11-08', 'JI. Jenderal  Sudirman Jorong Simpang Ampek_Lingkuang Aua Kec.Pasaman Kab.Pasaman Barat', NULL, 'default.png'),
(5, 'sih_pdg', 'PT. Sianok Indah Holiday ', 14, 'Pusat', 'No. U.81 Tahun 2020', '2021-08-02', 'Jl. Prof. DR. Hamka No.44 RT.1 RW.2 Kelurahan Air Tawar Barat Kecamatan Padang Utara Kota Padang.', NULL, 'default.png'),
(6, 'ajt_pdg', 'PT.Armindo Jaya Tur', 14, 'Pusat', 'NO.U. 62 Tahun 2020', '2020-03-31', 'Jl. Bandar Purus No.72 Kelurahan Ujung Gurun Kecamatan Padang Barat.', NULL, 'default.png'),
(7, 'pwn_pdg', 'PT. Penjuru Wisata Negeri', 14, 'Pusat', 'No.622 Tahun 2019', '2019-07-02', 'Jl. By PassKM.13 RT.03 RW.05 Kel. Sungai Sapih Kec. Kuranji Kota Padang.', NULL, 'default.png'),
(8, 'bpwaza_pdg', 'PT. BPW Alhaadi Ziarah Andalas', 14, 'Pusat', 'No.U 413 tahun 2020', '2020-11-08', 'Jl. Prof. DR. Hamka No.44 RT.1 RW.2 Kelurahan Parupuak Tabing Kecamatan Koto Tangah Kota Padang.', NULL, 'default.png'),
(9, 'fu_pdg', 'PT.Fahmi Utama ', 14, 'Pusat', 'No. U 355 Tahun 2020', '2020-10-17', 'Jl. Raden Shaleh No.52 RT.004 RW.003 Padang Barat Kota Padang', NULL, 'default.png'),
(10, 'uhi_pdg', 'PT. Udacs Holiday Indonesia', 14, 'Pusat', 'No.444 Tahun 2017', '2017-07-13', 'Jl. Ir Juanda no.79 Komp Hotel Pengeran Beach Padang Kel.Flamboyan Baru Kec. Padang Barat.', NULL, 'default.png'),
(11, 'rb_pdg', 'PT. Rindu Baitullah', 14, 'Pusat', 'No. 51 Tahun 2018', '2018-02-09', 'Jl. Mangga Raya No. 52 RT.06 RW.10 Perumnas Belimbing Kec.Kuranji Kota Padang.', NULL, 'default.png'),
(12, 'tpw_pdg', 'PT. Tridaya Pesona Wisata', 14, 'Pusat', 'No.139 Tahun 218', '2018-03-01', 'Jl. S. Parman No. 90 D Kel. Lolong Belanti Kecamatan Padang Utara Kota Padang', NULL, 'default.png'),
(13, 'cbm_pdg', 'PT. Cordoba Berkah Mandiri', 14, 'Pusat', 'No.U.127 Tahun 2020', '2020-06-15', 'Jl. Kampung Kalawi Barat No.4 RT.002 RW.007 Kel. Lubuk Lintah Kecamatan Kuranji Kota Padang', NULL, 'default.png'),
(14, 'amu_pdg', 'PT. Azhar Mitra Utama', 14, 'Pusat', 'No.U.151 Tahun 2020', '2020-06-15', 'Jl. Sawahan No. 55 Kel. Sawahan Kecamatan Padang Timur', NULL, 'default.png'),
(15, 'oad_pdg', 'PT. Ontiket Amanah Digita', 14, 'Pusat', 'No.U. 315 Tahun 2020', '2020-09-24', 'Jl. Adinegoro No.33 Rt.004 RW.008 Batang Kabung Ganting Kecamatan Koto Tangah Kota Padang.', NULL, 'default.png'),
(16, 'sitt_pdg', 'PT. Sukses Internasional Tour and Travel', 14, 'Pusat', 'No.U.292 Tahun 2020', '2020-09-24', 'Jl. Ir. Juanda No.49 RT.001 RW.004 Kel. Flamboyan Baru Kec. Padang Barat Kota Padang', NULL, 'default.png'),
(17, 'anr_pdg', 'PT. Arabia Nusantara Raya', 14, 'Pusat', 'No.U.450 Tahun 2021', '2021-10-14', 'Jl.Prof.Dr.Hamka  No.139 D Kel. Parupuak Tabing Kec. Koto Tangah Kota Padang.', NULL, 'default.png'),
(18, 'lci_pdg', 'PT. Labbaika Cipta Imani', 14, 'Pusat', 'No.261 Tahun 2018', '2018-05-02', 'Jl.Irian No.2 Kel. Ulak Karang Kec. Padang Utara Kota Padang', NULL, 'default.png'),
(19, 'bsm_pdgpj', 'PT. Bumi Serambi Mekah', 15, 'Pusat', 'No. U. 275 Tahun 2020', '2023-09-07', 'Jl. M. Yamin No.163 Rt 01 Rw 00 Kel.Silaing Atas Kec.Padang Panjang Kota Padang Panjang', NULL, 'default.png'),
(20, 'hbas_slkslt', 'PT. Holiday Bumi Alam Surambi', 11, 'Pusat', '02200075501540001', '2022-04-03', 'Jorong Mantirai Pulakek Koto Baru Kec.Sungai Pagu Kab.Solok Selatan', NULL, 'default.png'),
(21, 'sit_dhr', 'PT. Saudi Islamic Tour', 2, 'Pusat', '10062200283780007', '2022-08-02', 'Jl. Lintas Sumatera Jorong Pasa Pagi Kel.Sungai Rumbai Timur Kec.Sungai Rumbai Kab.Dharmasraya', NULL, 'default.png'),
(22, 'pwn_bkt', 'PT. Penjuru Wisata Negeri', 13, 'Cabang', '259 Tahun 2017', '2017-11-06', 'Jl. H. Miskin RT.03/RW.03 Kel. Campago Ipuh, Kec. Mandiangin Koto Selayan Kota Bukittinggi', NULL, 'default.png'),
(23, 'mtt_bkt', 'PT. Musafir Tour & Travel ', 13, 'Cabang', '144 Tahun 2018', '2018-03-29', 'Jl. Veteran No. 27 RT.002/RW.002 Kel. Puhun Tembok Kec. Mandiangin Koto Selayan, Kota Bukittinggi ', NULL, 'default.png'),
(24, 'rautt_bkt', 'PT. Raka Amal Utama Tours & Travel', 13, 'Cabang', '220 Tahun 2018', '2018-05-22', 'Jl. M. Syafe\'i No. 7 D RT. 03 RW. 01 Kel. Tarok Dipo Kec. Guguk Panjang Kota Bukittinggi', NULL, 'default.png'),
(25, 'set_bkt', 'PT. Sela Express Tour ', 13, 'Cabang', '390 Tahun 2019', '2019-09-26', 'Jl. Hamka No. 25 Kel. Pakan Kurai Kec. Guguk Panjang Kota Bukiitinggi', NULL, 'default.png'),
(26, 'aftt_bkt', 'PT. Al Falah Tour And Travel', 13, 'Cabang', '420 Tahun 2019', '2019-10-21', 'Jl. Syech Ibrahim Musa No. 1 RT. 01 RW. 01 Kel. Aur Tajungkang Tengah Sawah Kec. Guguk Panjang Bukittinggi', NULL, 'default.png');

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
('aftt_bkt', '$2y$10$pneYi2Pfc.CoDM8xek9tRu5rW4/1fKvgB7wml59cF8Nxl6jpHgsPW', 'ppiu'),
('ahw_pasbar', '$2y$10$BXYGxMqdTBqeDtlv7Hgncuc.ZnfRDnOnVGUZAJZQzRqtrXrfKTryq', 'ppiu'),
('ajt_pdg', '$2y$10$M.CiNL0F4wwGnJIxK.TfAeJcdqjADcAZ./ImpiJFZzzGrLOKIlB1u', 'ppiu'),
('amu_pdg', '$2y$10$w.3Gn45F28mR6eYjlGMf5ONtFtRgTo2w.wV..f3OyFrxf5KUDCETy', 'ppiu'),
('anr_pdg', '$2y$10$QfHJJWO8JuqG7okqQ/ijJ.CeHA0J8L/Wj/RGo7SiC4TCimSbeBAp2', 'ppiu'),
('bap_bkt', '$2y$10$r/UG/wB8nv5uXZINlaIlDuQnZEWjCmJ3rqQxNEZEDvFZvwnFD/K0G', 'ppiu'),
('bpwaza_pdg', '$2y$10$5./6RUN2lFr2P59x73ETPOsxkbDUs.xL4HDuam5DJTqDjXkisLZGa', 'ppiu'),
('bsm_pdgpj', '$2y$10$iGWTakFkyAdjfmMMv9UPd.v6DjGcDVyDNfwNQPPLn390Km0d3UNfm', 'ppiu'),
('cbm_pdg', '$2y$10$hOJkKVbeobFY1WJWb79jtOaL0kG0bqA5cK36OrMVlCKVRMwy1OCGG', 'ppiu'),
('fu_pdg', '$2y$10$Bu2hI1d9IKDluv3ZS3zHEuHUU6/IqGQIAmdr6kBCYCwhJKCr0IWqa', 'ppiu'),
('hbas_slkslt', '$2y$10$ZQm7YDf8aYelnospp0QW1uEoTkPq1REmzMx1tMOM14CvbLvzGA30G', 'ppiu'),
('kanwil', '$2y$10$4Atgs7OOtJP/Yrvuup4aZOmHRJsWDkpQgR7wpg1iY3W9ymzSCmOyi', 'kanwil'),
('kemenag_50kota', '$2y$10$InCbX8CldgUad.X4FEZmae8gIe0CTXGLNfVXBImVdVyEUu.wYf6DG', 'kab/kota'),
('kemenag_agam', '$2y$10$VRSlG.Z9HkWCF9xbHFbsOu6n4XxcNWNxdNgp992MtBkspVnjJ4HAW', 'kab/kota'),
('kemenag_bukittinggi', '$2y$10$mvcR4MCT2Z27dkX0aZzJQewa/c4kO4x9jq3qkhZq2A.BrgGH1Rgy2', 'kab/kota'),
('kemenag_dharmasraya', '$2y$10$CZEaZ.z1eL8FLAKkS1DFH.hY/o8cal.BUTrrq1EQdMdJE/Nl70QNe', 'kab/kota'),
('kemenag_mentawai', '$2y$10$vXaCETnUB2zd/qG7/EUkCeGMWh5s9v2twibgmyI5snk.KeqdWb7Ke', 'kab/kota'),
('kemenag_padang', '$2y$10$t80E1.rGa5UgBJkLQyOJO.bNLa3FexluEu5P8xiyBSTEb5TUoCWou', 'kab/kota'),
('kemenag_padangpanjang', '$2y$10$9mjxs1Xxe1QI0DNe4mEdN.qq/cnZ79AcXYfMAiKzMEQIz0ziQy16K', 'kab/kota'),
('kemenag_padangpariaman', '$2y$10$qQwZJWNrZ1UX.B0LycFFFeDhCvAqO.Xs/m6Zcgw9caXCY4PVq.6gK', 'kab/kota'),
('kemenag_pariaman', '$2y$10$vJhLlZoBcSvcjQ0Thmabfe1pUmr7iLIt3zZ5dUiPC81yTo2sBmeAu', 'kab/kota'),
('kemenag_pasaman', '$2y$10$7mY3qGRxXhBvqvVT1DY/NeByn8jia5EfUq4cZf5K41GZIefanbUnK', 'kab/kota'),
('kemenag_pasamanbarat', '$2y$10$dTIu3OcCUk04hs1mCJjRme9Bg648Eb5roFU4DWGY7WvX6k/M.2AF.', 'kab/kota'),
('kemenag_payakumbuh', '$2y$10$FrgGhRa8VIfYz.VBYmgli.DqxTmlHrDg7ZDrS8WsfmMFouRZ7VoEy', 'kab/kota'),
('kemenag_pesisirselatan', '$2y$10$E78SeSsEkLBTcDQZ2sCDO.3r7TnoKCqI3F6gLSFfGwFCrMXldizgO', 'kab/kota'),
('kemenag_sawahlunto', '$2y$10$SYqMemnoWp1qiwhgTc3.o.2kwPqZJu8U8jT35IDx9VYHYJlKckrc2', 'kab/kota'),
('kemenag_sijunjung', '$2y$10$cl5NntEJFnzTWAPddzLEY.aiIdaLv2zzAW9Zl44us6raQ9yIb0AT6', 'kab/kota'),
('kemenag_solok', '$2y$10$rvyoxo3i12k6X/e1vkGVgu5he8IMRlYlug8DFx4c88bhPDN5ZGc..', 'kab/kota'),
('kemenag_solokselatan', '$2y$10$u10ZR9dhN2RxpBnZe.SKsOk8ak/xMvHDXUeJtnU4YsDbP5TYtw0cS', 'kab/kota'),
('kemenag_tanahdatar', '$2y$10$ZkitYBW3PapR/d6VtCJZs.F4.Ev2GqK8Jpf35FSpPzb1oeXVDTHUC', 'kab/kota'),
('lci_pdg', '$2y$10$9B4.NlX/xjgIW2j.nOS6Mec8TiwPhXxR4Y/fiBLiCME4101IGsGn.', 'ppiu'),
('mftt_agm', '$2y$10$fM4OU3QqEuy5Z/zDAFpKLunABsypaT7xowgAYcklN9agkYXBQcfJi', 'ppiu'),
('mtt_bkt', '$2y$10$52bjQQfd3TECltrPXsDNdOn/OoVeP7RZiMY9KCfV6qEj2ioWb1fJu', 'ppiu'),
('oad_pdg', '$2y$10$dwVvKJQtcS33NxBYkhSpbOefvroiQJ/4RAl7LTB57fs/G5Z8YeUCe', 'ppiu'),
('pwn_bkt', '$2y$10$5B2SGPpCXWbHN2kuKAjilui0P4QwEz9bZXlkdKF9B5J5A8xR6IvGi', 'ppiu'),
('pwn_pdg', '$2y$10$PW6Rg35/8UfyTca5JzZz3O6nj12dq95DrHkjkInsxv1r0p1epXZj2', 'ppiu'),
('ram_bkt', '$2y$10$v6PphHv6/LH1IKxy2ecni.wVvHUJhKMdZs495q3oe2BrJUaI1bXd.', 'ppiu'),
('rautt_bkt', '$2y$10$2Y3WGRAAfgdIlsN6LicYO.S65KWkZlYQ8XvgCP9ObF.gw8Zd0INHC', 'ppiu'),
('rb_pdg', '$2y$10$tyVIfZyJQ.vmYvOwuSKi2eQ7HpUVii0kusnfhv5ci2x6LXHdGzgGq', 'ppiu'),
('set_bkt', '$2y$10$l7Zwg7xxkXtfDIeylLMqv.qh7UVKWCzMTy8y4/Z3bPa.v567a7K6S', 'ppiu'),
('sih_pdg', '$2y$10$GvPXxL1inRzHXU3kVes8yekPHG1Man3gI6adLsehsw17/Enjj910G', 'ppiu'),
('sitt_pdg', '$2y$10$2CGm.Y1dT4721Hg66wDwkuka06AAVzqigWYnF28w8rMF9pg288tOS', 'ppiu'),
('sit_dhr', '$2y$10$4qXBd/EVmfUJisUlZgSI.etWhFXschH9H3DQvsosBJd59q8aFLoUe', 'ppiu'),
('tpw_pdg', '$2y$10$8A8CkqSIUvyshgrVpKHW3uVukIK3hKtLTL0Ro0WDZcKqGuG4wjDdC', 'ppiu'),
('uhi_pdg', '$2y$10$oR7NOUWig3MSy8nsCoFL/u3db8Ph0CTNKi3xu9nfqfMnwI96y1pE6', 'ppiu');

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
  MODIFY `id_kemenag_kab_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ppiu`
--
ALTER TABLE `ppiu`
  MODIFY `id_ppiu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
