-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2020 at 02:17 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mekp`
--

-- --------------------------------------------------------

--
-- Table structure for table `mekp_access_menu`
--

CREATE TABLE `mekp_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_access_menu`
--

INSERT INTO `mekp_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(5, 2, 3),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_barang`
--

CREATE TABLE `mekp_barang` (
  `id_barang` int(11) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `merk` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `kondisi` int(11) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `thn_pengadaan` int(11) NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_barang`
--

INSERT INTO `mekp_barang` (`id_barang`, `kd_barang`, `nm_barang`, `merk`, `kategori`, `status`, `kondisi`, `jumlah`, `thn_pengadaan`, `catatan`) VALUES
(5, 'M001', 'mouse', 15, 7, 4, 7, 98, 2020, ''),
(6, 'K001', 'Keyboard', 17, 8, 4, 7, 42, 2020, 'ff'),
(7, 'T001', 'monitor', 13, 9, 4, 7, 50, 2020, ''),
(8, 'N001', 'proyektor', 15, 10, 4, 7, 2, 2020, 's');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_barang_keluar`
--

CREATE TABLE `mekp_barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `dari_ke` varchar(20) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `kebutuhan` text NOT NULL,
  `catatan` text,
  `id_perbaikan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_barang_keluar`
--

INSERT INTO `mekp_barang_keluar` (`id_barang_keluar`, `tgl_keluar`, `dari_ke`, `kd_barang`, `jumlah`, `kebutuhan`, `catatan`, `id_perbaikan`) VALUES
(13, '2020-03-10', '1', 'M001', 20, 'ganti', 'good', 22),
(14, '2020-03-10', '1', 'M001', 30, 'ganti', 'nice', 23),
(15, '2020-03-02', '3', 'M001', 12, 'dsf', 'sdfsd', 24),
(16, '2020-03-03', '2', 'K001', 1, 'sdf', 'sdfds', 25);

--
-- Triggers `mekp_barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `mekp_barang_keluar` FOR EACH ROW BEGIN
	UPDATE mekp_barang SET jumlah=jumlah-NEW.jumlah
    WHERE kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sum_barang_after_keluar` BEFORE UPDATE ON `mekp_barang_keluar` FOR EACH ROW UPDATE mekp_barang
    SET jumlah = jumlah + OLD.jumlah
    WHERE kd_barang = NEW.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sum_barang_before_keluar` AFTER UPDATE ON `mekp_barang_keluar` FOR EACH ROW UPDATE mekp_barang 
SET jumlah = jumlah - New.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mekp_barang_masuk`
--

CREATE TABLE `mekp_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `dari_ke` varchar(20) NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_barang_masuk`
--

INSERT INTO `mekp_barang_masuk` (`id_barang_masuk`, `kd_barang`, `jumlah`, `tgl_masuk`, `dari_ke`, `catatan`) VALUES
(68, 'K001', 35, '2020-03-09', 'pinjam', ''),
(72, 'M001', 80, '2020-03-09', 'aaa', 'sdsf'),
(73, 'M001', 70, '2020-03-10', 'beli', ''),
(74, 'T001', 35, '2020-03-18', 'Membeli', ''),
(76, 'N001', 2, '2020-03-19', 'beli', 's'),
(77, 'T001', 15, '2020-03-19', 'dfgdf', 'dfgdfgdf');

--
-- Triggers `mekp_barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `mekp_barang_masuk` FOR EACH ROW BEGIN
	UPDATE mekp_barang SET jumlah=jumlah+NEW.jumlah
    WHERE kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sum_barang_after_masuk` AFTER UPDATE ON `mekp_barang_masuk` FOR EACH ROW BEGIN
  UPDATE mekp_barang
    SET jumlah = jumlah - OLD.jumlah
    WHERE kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sum_barang_before_masuk` BEFORE UPDATE ON `mekp_barang_masuk` FOR EACH ROW UPDATE mekp_barang 
SET jumlah = jumlah + new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mekp_forbi`
--

CREATE TABLE `mekp_forbi` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_forbi`
--

INSERT INTO `mekp_forbi` (`id`, `name`, `url`, `is_active`) VALUES
(1, 'Register', '<?php echo base_url(\'auth/register\');?>', 1),
(2, 'aaaaa', 'ccc', 1),
(4, 'asdas', 'aaaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_kategori`
--

CREATE TABLE `mekp_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_kategori`
--

INSERT INTO `mekp_kategori` (`id_kategori`, `nm_kategori`, `catatan`) VALUES
(7, 'Mouse', NULL),
(8, 'Keyboard', NULL),
(9, 'Monitor', NULL),
(10, 'Proyektor', NULL),
(11, 'AC', NULL),
(12, 'Headset', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_kondisi`
--

CREATE TABLE `mekp_kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nm_kondisi` varchar(20) NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_kondisi`
--

INSERT INTO `mekp_kondisi` (`id_kondisi`, `nm_kondisi`, `catatan`) VALUES
(7, 'Baru', NULL),
(8, 'Second', NULL),
(9, 'Pinjam', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_lokasi`
--

CREATE TABLE `mekp_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nm_lokasi` varchar(20) NOT NULL,
  `kapasitas` varchar(80) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_lokasi`
--

INSERT INTO `mekp_lokasi` (`id_lokasi`, `nm_lokasi`, `kapasitas`, `catatan`) VALUES
(1, 'Lab A', '25', ''),
(2, 'Lab C', '26', ''),
(3, 'Lab B', '20', '');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_menu`
--

CREATE TABLE `mekp_menu` (
  `id` int(11) NOT NULL,
  `parents` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_menu`
--

INSERT INTO `mekp_menu` (`id`, `parents`) VALUES
(1, 'Admin'),
(2, 'Settings'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_merk`
--

CREATE TABLE `mekp_merk` (
  `id_merk` int(11) NOT NULL,
  `nm_merk` varchar(20) NOT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_merk`
--

INSERT INTO `mekp_merk` (`id_merk`, `nm_merk`, `catatan`) VALUES
(13, 'LG', NULL),
(14, 'Panasonic', NULL),
(15, 'Asus', NULL),
(16, 'Lenovo', NULL),
(17, 'Logitech', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_perawatan`
--

CREATE TABLE `mekp_perawatan` (
  `id_perawatan` int(11) NOT NULL,
  `nm_perawatan` varchar(30) NOT NULL,
  `tgl_perawatan` date NOT NULL,
  `lokasi` int(11) NOT NULL,
  `lokasi_rinci` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_perawatan`
--

INSERT INTO `mekp_perawatan` (`id_perawatan`, `nm_perawatan`, `tgl_perawatan`, `lokasi`, `lokasi_rinci`, `keterangan`) VALUES
(2, 'test', '2020-03-08', 1, 'meja 15', 'dsaee'),
(3, 'ulang', '2020-03-09', 3, 'meja 21', 'rusak'),
(4, 'teeset2', '2020-03-10', 2, '23', 'rusak');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_perbaikan`
--

CREATE TABLE `mekp_perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `id_perawatan` int(11) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `lokasi` int(11) NOT NULL,
  `kebutuhan` text NOT NULL,
  `kd_barang` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_perbaikan`
--

INSERT INTO `mekp_perbaikan` (`id_perbaikan`, `id_perawatan`, `tgl_perbaikan`, `lokasi`, `kebutuhan`, `kd_barang`, `jumlah`, `hasil`) VALUES
(22, 2, '2020-03-10', 1, 'ganti', 'M001', 20, 'good'),
(23, 2, '2020-03-10', 1, 'ganti', 'M001', 30, 'nice'),
(24, 3, '2020-03-02', 3, 'dsf', 'M001', 12, 'sdfsd'),
(25, 4, '2020-03-03', 2, 'sdf', 'K001', 1, 'sdfds');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_role`
--

CREATE TABLE `mekp_role` (
  `id` int(11) NOT NULL,
  `access` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_role`
--

INSERT INTO `mekp_role` (`id`, `access`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(4, 'testlur');

-- --------------------------------------------------------

--
-- Table structure for table `mekp_status_barang`
--

CREATE TABLE `mekp_status_barang` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(20) NOT NULL,
  `catatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_status_barang`
--

INSERT INTO `mekp_status_barang` (`id_status`, `nm_status`, `catatan`) VALUES
(4, 'Ready', NULL),
(5, 'Pinjaman', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_sub_menu`
--

CREATE TABLE `mekp_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_sub_menu`
--

INSERT INTO `mekp_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'nav-icon fa-fw fas fa-tachometer-alt', 1),
(2, 3, 'Home', 'member', 'nav-icon fa-fw fas fa-home', 1),
(5, 3, 'Data Master', 'member/master', 'nav-icon fa-fw fas fa-book', 1),
(6, 3, 'Data Perawatan', 'member/perawatan', 'nav-icon fa-fw fas fa-tools', 1),
(7, 3, 'Data Laporan', 'member/laporan', 'nav-icon fa-fw fas fa-file-alt', 1),
(9, 2, 'Menu', 'setting', 'nav-icon fa-fw fas fa-folder', 1),
(10, 2, 'Sub Menu', 'setting/submenu', 'nav-icon fa-fw fas fa-folder-open', 1),
(17, 1, 'Access Menu', 'admin/role', 'nav-icon fa-fw fas  fa-user-tie', 1),
(19, 2, 'User', 'setting/user', 'nav-icon fa-fw fas fa-user', 1),
(20, 1, 'Forbidden Menu', 'admin/forbidden', 'nav-icon fa-fw fas fa-ban', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mekp_token`
--

CREATE TABLE `mekp_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mekp_user`
--

CREATE TABLE `mekp_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekp_user`
--

INSERT INTO `mekp_user` (`id`, `username`, `fullname`, `email`, `image`, `password`, `phone`, `address`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'admin', 'aaaaa', 'admin@admin.com', 'avatar04.png', '$2y$10$.WKWO0mjnBVYohOfYtafdux0/Ocjwb6GbPaMmH7ERW4DS8cv9CWDi', '', '', 1, 1, 1582407398),
(3, 'member', 'sssss', 'member@member.com', 'avatar.png', '$2y$10$qD..mHGaPQ.I4mzj5vdtpuuxdRFPXah0jSDX3BONiKqUKAe2ocPAS', '', '', 2, 1, 1582420430),
(4, 'member01', '', 'member01@member.com', 'avatar3.png', '$2y$10$fUWRviW8h3gKvbWMv/6o2OwtVqdQiLYa65YMhWpxA1nUvfp2Ov25W', '', '', 2, 0, 1582518375),
(6, 'member02', '', 'member02@member.com', 'default.jpg', '$2y$10$R6Sar2JI3rEvLPqpv1BzruIYvxmTYhR/D8F9t5PHkJjRYeQW5gFTq', '', '', 2, 1, 1582553301);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mekp_access_menu`
--
ALTER TABLE `mekp_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `mekp_barang`
--
ALTER TABLE `mekp_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kategori` (`kategori`),
  ADD KEY `merk` (`merk`),
  ADD KEY `status` (`status`),
  ADD KEY `kondisi` (`kondisi`);

--
-- Indexes for table `mekp_barang_keluar`
--
ALTER TABLE `mekp_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_perbaikan` (`id_perbaikan`);

--
-- Indexes for table `mekp_barang_masuk`
--
ALTER TABLE `mekp_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `mekp_forbi`
--
ALTER TABLE `mekp_forbi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekp_kategori`
--
ALTER TABLE `mekp_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mekp_kondisi`
--
ALTER TABLE `mekp_kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `mekp_lokasi`
--
ALTER TABLE `mekp_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `mekp_menu`
--
ALTER TABLE `mekp_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekp_merk`
--
ALTER TABLE `mekp_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `mekp_perawatan`
--
ALTER TABLE `mekp_perawatan`
  ADD PRIMARY KEY (`id_perawatan`),
  ADD KEY `lokasi` (`lokasi`);

--
-- Indexes for table `mekp_perbaikan`
--
ALTER TABLE `mekp_perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `id_perawatan` (`id_perawatan`),
  ADD KEY `lokasi` (`lokasi`);

--
-- Indexes for table `mekp_role`
--
ALTER TABLE `mekp_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekp_status_barang`
--
ALTER TABLE `mekp_status_barang`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `mekp_sub_menu`
--
ALTER TABLE `mekp_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `mekp_token`
--
ALTER TABLE `mekp_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekp_user`
--
ALTER TABLE `mekp_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mekp_access_menu`
--
ALTER TABLE `mekp_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mekp_barang`
--
ALTER TABLE `mekp_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mekp_barang_keluar`
--
ALTER TABLE `mekp_barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mekp_barang_masuk`
--
ALTER TABLE `mekp_barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `mekp_forbi`
--
ALTER TABLE `mekp_forbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mekp_kategori`
--
ALTER TABLE `mekp_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mekp_kondisi`
--
ALTER TABLE `mekp_kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mekp_lokasi`
--
ALTER TABLE `mekp_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mekp_menu`
--
ALTER TABLE `mekp_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mekp_merk`
--
ALTER TABLE `mekp_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mekp_perawatan`
--
ALTER TABLE `mekp_perawatan`
  MODIFY `id_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mekp_perbaikan`
--
ALTER TABLE `mekp_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mekp_role`
--
ALTER TABLE `mekp_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mekp_status_barang`
--
ALTER TABLE `mekp_status_barang`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mekp_sub_menu`
--
ALTER TABLE `mekp_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mekp_token`
--
ALTER TABLE `mekp_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mekp_user`
--
ALTER TABLE `mekp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mekp_access_menu`
--
ALTER TABLE `mekp_access_menu`
  ADD CONSTRAINT `mekp_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `mekp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mekp_access_menu_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `mekp_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mekp_barang`
--
ALTER TABLE `mekp_barang`
  ADD CONSTRAINT `mekp_barang_ibfk_1` FOREIGN KEY (`merk`) REFERENCES `mekp_merk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mekp_barang_ibfk_2` FOREIGN KEY (`kategori`) REFERENCES `mekp_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mekp_barang_ibfk_3` FOREIGN KEY (`status`) REFERENCES `mekp_status_barang` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mekp_barang_ibfk_4` FOREIGN KEY (`kondisi`) REFERENCES `mekp_kondisi` (`id_kondisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mekp_perawatan`
--
ALTER TABLE `mekp_perawatan`
  ADD CONSTRAINT `mekp_perawatan_ibfk_1` FOREIGN KEY (`lokasi`) REFERENCES `mekp_lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mekp_perbaikan`
--
ALTER TABLE `mekp_perbaikan`
  ADD CONSTRAINT `mekp_perbaikan_ibfk_1` FOREIGN KEY (`lokasi`) REFERENCES `mekp_lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mekp_sub_menu`
--
ALTER TABLE `mekp_sub_menu`
  ADD CONSTRAINT `mekp_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `mekp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
