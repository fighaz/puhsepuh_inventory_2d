-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2023 at 04:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_peminjaman`
-- (See below for the actual view)
--
CREATE TABLE `all_peminjaman` (
`id_peminjaman` int(11)
,`nama_peminjam` varchar(255)
,`nama_barang` mediumtext
,`status` enum('dipinjam','terlambat','selesai','ditolak','menunggu_konfirmasi','menunggu_diambil')
,`tanggal_peminjaman` date
,`tanggal_pengembalian` date
);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tersedia` int(11) NOT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `asal` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `maintainer` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jumlah`, `tersedia`, `kondisi`, `asal`, `keterangan`, `maintainer`, `gambar`) VALUES
(1, 'Spidol', 100, 31, 'Baik', 2, 'Keterangan1', 'Keterangan1', '65841464e3627.jpg'),
(2, 'Remote AC', 50, 30, 'Rusak', 2, 'Keterangan2', 'Pak Jadi', '658414aaf14ce.jpg'),
(3, 'Proyektor', 70, 20, 'Baik', 1, 'Keterangan3', 'Keterangan3', '65841fb291cba.jpg'),
(4, 'Remote Proyektor', 30, 20, 'Baik', 2, 'Keterangan4', 'Mbak Novi', '65841fc71ae04.jpg'),
(5, 'Penghapus', 100, 20, 'Rusak', 2, 'Keterangan5', 'Mas Wowon', '65841fdd8c9ff.png'),
(6, 'Keyboard', 93, 15, 'Baik', 1, 'Keterangan5', 'Mas Wowon', '65841ffd3bcaa.jpg'),
(14, 'headphone ', 20, 10, 'Baik', 2, 'Keterangan', 'Mas Wowon', '6584204b9d646.jpg'),
(15, 'Printer', 20, 20, 'Baik', 2, 'Keterangan', 'Mbak Novi', '6584209c46606.jpeg'),
(16, 'Kabel hdmi', 20, 20, 'Baik', 2, 'Keterangan', 'Mas Wowon', '658420d2db961.jpg'),
(17, 'Microphone', 30, 30, 'Baik', 2, 'Keterangan', 'Mas Wowon', '658446ec72178.jpeg'),
(18, 'Mouse', 100, 100, 'Baik', 2, 'Keterangan', 'Mas Wowon', '658421460adb7.jpg'),
(19, 'Kabel Olor', 20, 20, 'Baik', 2, 'Keterangan', 'Mas Wowon', '658421833e91d.jpg'),
(20, 'Speaker', 20, 20, 'Baik', 2, 'Keterangan', 'Mas Wowon', '65842ae45bc54.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_peminjaman`, `id_barang`, `jumlah`, `keterangan`) VALUES
(1, 1, 2, ''),
(1, 4, 5, ''),
(2, 3, 1, ''),
(3, 5, 2, ''),
(4, 4, 1, ''),
(5, 2, 3, ''),
(6, 1, 4, ''),
(7, 2, 2, ''),
(8, 3, 1, ''),
(9, 5, 2, ''),
(25, 1, 1, 'fd'),
(26, 1, 1, 'ssdas'),
(26, 6, 1, 'asdsad'),
(27, 1, 1, 'dsfsdf'),
(27, 6, 1, 'sdfsdfsfd'),
(28, 1, 5, 'sdfsdf'),
(28, 6, 5, 'sdfds'),
(31, 1, 5, ''),
(31, 2, 5, ''),
(32, 1, 5, ''),
(32, 2, 5, ''),
(33, 1, 1, ''),
(34, 2, 5, ''),
(34, 3, 5, ''),
(35, 2, 5, ''),
(35, 3, 5, ''),
(36, 1, 1, ''),
(36, 2, 5, ''),
(37, 2, 10, ''),
(37, 3, 10, ''),
(38, 2, 10, ''),
(38, 3, 10, '');

--
-- Triggers `detail_peminjaman`
--
DELIMITER $$
CREATE TRIGGER `after_insert_detail_peminjaman` AFTER INSERT ON `detail_peminjaman` FOR EACH ROW BEGIN
    -- Update the 'tersedia' field in the 'barang' table
    UPDATE barang
    SET tersedia = tersedia - NEW.jumlah
    WHERE id = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_detail_peminjaman` AFTER UPDATE ON `detail_peminjaman` FOR EACH ROW BEGIN
    -- Calculate the difference in quantity
    DECLARE selisih INT;
    SET selisih = NEW.jumlah - OLD.jumlah;

    -- Update 'tersedia' field in 'barang' table based on the quantity difference
    IF selisih > 0 THEN
        -- If the new quantity is greater than the old quantity, reduce 'tersedia'
        UPDATE barang
        SET tersedia = tersedia - selisih
        WHERE id = NEW.id_barang;
    ELSE
        -- If the new quantity is less than or equal to the old quantity, increase 'tersedia'
        UPDATE barang
        SET tersedia = tersedia + ABS(selisih)
        WHERE id = NEW.id_barang;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `keterangan`) VALUES
(1, 'Hibah', ''),
(2, 'Pembelian', ''),
(3, 'Kerja Sama', '');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_user`, `id_barang`) VALUES
(5, 1),
(1, 2),
(1, 3),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` enum('dipinjam','terlambat','selesai','ditolak','menunggu_konfirmasi','menunggu_diambil') DEFAULT 'menunggu_konfirmasi',
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `perubahan_status` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_user`, `status`, `tanggal_peminjaman`, `tanggal_pengembalian`, `perubahan_status`) VALUES
(1, 2, 'dipinjam', '2023-11-27', '2023-12-05', '2023-12-15 08:49:15'),
(2, 2, 'dipinjam', '2023-11-28', '2023-12-06', '2023-12-15 08:49:15'),
(3, 2, 'terlambat', '2023-11-29', '2023-12-07', '2023-12-15 08:49:15'),
(4, 2, 'selesai', '2023-11-30', '2023-12-08', '2023-12-15 08:49:15'),
(5, 2, 'ditolak', '2023-12-01', '2023-12-09', '2023-12-15 08:49:15'),
(6, 2, 'ditolak', '2023-12-02', '2023-12-10', '2023-12-15 08:49:15'),
(7, 2, 'dipinjam', '2023-12-03', '2023-12-11', '2023-12-15 08:49:15'),
(8, 2, 'selesai', '2023-12-04', '2023-12-12', '2023-12-15 08:49:15'),
(9, 2, 'ditolak', '2023-12-05', '2023-12-13', '2023-12-15 08:49:15'),
(25, 2, 'ditolak', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(26, 2, 'selesai', '2023-12-15', '2023-12-20', '2023-12-20 13:03:37'),
(27, 2, 'menunggu_diambil', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(28, 2, 'selesai', '2023-12-20', '2023-12-25', '2023-12-20 12:52:22'),
(31, 2, 'ditolak', '2023-12-22', '2023-12-23', '2023-12-20 11:32:20'),
(32, 1, 'ditolak', '2023-12-22', '2023-12-23', '2023-12-20 11:33:04'),
(33, 1, 'ditolak', '2023-12-21', '2023-12-21', '2023-12-20 12:20:51'),
(34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:14:45'),
(35, 2, 'selesai', '2023-12-21', '2023-12-21', '2023-12-20 13:56:45'),
(36, 1, 'ditolak', '2023-12-28', '2023-12-29', '2023-12-20 13:58:39'),
(37, 10, 'selesai', '2023-12-22', '2023-12-23', '2023-12-21 11:37:29'),
(38, 10, 'selesai', '2023-12-22', '2023-12-23', '2023-12-21 11:40:09');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `log_peminjaman_after_delete` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO peminjaman_log (activity, peminjaman_id, id_user, status, tanggal_peminjaman, tanggal_pengembalian, timestamp)
    VALUES ('DELETE', OLD.id, OLD.id_user, OLD.status, OLD.tanggal_peminjaman, OLD.tanggal_pengembalian, CURRENT_TIMESTAMP);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_peminjaman_after_insert` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO peminjaman_log (activity, peminjaman_id, id_user, status, tanggal_peminjaman, tanggal_pengembalian, timestamp)
    VALUES ('INSERT', NEW.id, NEW.id_user, NEW.status, NEW.tanggal_peminjaman, NEW.tanggal_pengembalian, CURRENT_TIMESTAMP);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_peminjaman_after_update` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO peminjaman_log (activity, peminjaman_id, id_user, status, tanggal_peminjaman, tanggal_pengembalian, timestamp)
    VALUES ('UPDATE', NEW.id, NEW.id_user, NEW.status, NEW.tanggal_peminjaman, NEW.tanggal_pengembalian, CURRENT_TIMESTAMP);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_log`
--

CREATE TABLE `peminjaman_log` (
  `log_id` int(11) NOT NULL,
  `activity` varchar(10) DEFAULT NULL,
  `peminjaman_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_log`
--

INSERT INTO `peminjaman_log` (`log_id`, `activity`, `peminjaman_id`, `id_user`, `status`, `tanggal_peminjaman`, `tanggal_pengembalian`, `timestamp`) VALUES
(1, 'INSERT', 33, 1, 'menunggu_konfirmasi', '2023-12-21', '2023-12-21', '2023-12-20 12:20:39'),
(2, 'UPDATE', 33, 1, 'ditolak', '2023-12-21', '2023-12-21', '2023-12-20 12:20:51'),
(3, 'UPDATE', 33, 1, 'ditolak', '2023-12-21', '2023-12-21', '2023-12-20 12:20:51'),
(5, 'INSERT', 34, 1, 'menunggu_konfirmasi', '2023-12-21', '2023-12-23', '2023-12-20 12:51:26'),
(6, 'UPDATE', 28, 2, 'selesai', '2023-12-20', '2023-12-25', '2023-12-20 12:52:22'),
(7, 'UPDATE', 26, 2, 'selesai', '2023-12-15', '2023-12-20', '2023-12-20 13:03:13'),
(8, 'UPDATE', 26, 2, 'selesai', '2023-12-15', '2023-12-20', '2023-12-20 13:03:37'),
(9, 'UPDATE', 34, 1, 'menunggu_diambil', '2023-12-21', '2023-12-23', '2023-12-20 13:04:01'),
(10, 'UPDATE', 34, 1, 'menunggu_diambil', '2023-12-21', '2023-12-23', '2023-12-20 13:04:01'),
(11, 'UPDATE', 34, 1, 'dipinjam', '2023-12-21', '2023-12-23', '2023-12-20 13:04:22'),
(12, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:04:27'),
(13, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:04:51'),
(14, 'UPDATE', 34, 1, 'dipinjam', '2023-12-21', '2023-12-23', '2023-12-20 13:09:30'),
(15, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:09:42'),
(16, 'UPDATE', 34, 1, 'dipinjam', '2023-12-21', '2023-12-23', '2023-12-20 13:11:29'),
(17, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:11:45'),
(18, 'UPDATE', 34, 1, 'dipinjam', '2023-12-21', '2023-12-23', '2023-12-20 13:12:49'),
(19, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:13:00'),
(20, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:13:54'),
(21, 'UPDATE', 34, 1, 'selesai', '2023-12-21', '2023-12-23', '2023-12-20 13:14:45'),
(22, 'INSERT', 35, 2, 'menunggu_konfirmasi', '2023-12-21', '2023-12-21', '2023-12-20 13:56:06'),
(23, 'UPDATE', 35, 2, 'menunggu_diambil', '2023-12-21', '2023-12-21', '2023-12-20 13:56:34'),
(24, 'UPDATE', 35, 2, 'menunggu_diambil', '2023-12-21', '2023-12-21', '2023-12-20 13:56:34'),
(25, 'UPDATE', 35, 2, 'dipinjam', '2023-12-21', '2023-12-21', '2023-12-20 13:56:42'),
(26, 'UPDATE', 35, 2, 'selesai', '2023-12-21', '2023-12-21', '2023-12-20 13:56:45'),
(27, 'INSERT', 36, 1, 'menunggu_konfirmasi', '2023-12-28', '2023-12-29', '2023-12-20 13:58:30'),
(28, 'UPDATE', 36, 1, 'ditolak', '2023-12-28', '2023-12-29', '2023-12-20 13:58:39'),
(29, 'INSERT', 37, 10, 'menunggu_konfirmasi', '2023-12-22', '2023-12-23', '2023-12-21 11:33:57'),
(30, 'UPDATE', 37, 10, 'menunggu_diambil', '2023-12-22', '2023-12-23', '2023-12-21 11:34:27'),
(31, 'UPDATE', 37, 10, 'menunggu_diambil', '2023-12-22', '2023-12-23', '2023-12-21 11:34:27'),
(32, 'UPDATE', 37, 10, 'dipinjam', '2023-12-22', '2023-12-23', '2023-12-21 11:37:23'),
(33, 'UPDATE', 37, 10, 'selesai', '2023-12-22', '2023-12-23', '2023-12-21 11:37:29'),
(34, 'INSERT', 38, 10, 'menunggu_konfirmasi', '2023-12-22', '2023-12-23', '2023-12-21 11:39:19'),
(35, 'UPDATE', 38, 10, 'menunggu_diambil', '2023-12-22', '2023-12-23', '2023-12-21 11:39:47'),
(36, 'UPDATE', 38, 10, 'menunggu_diambil', '2023-12-22', '2023-12-23', '2023-12-21 11:39:47'),
(37, 'UPDATE', 38, 10, 'dipinjam', '2023-12-22', '2023-12-23', '2023-12-21 11:40:04'),
(38, 'UPDATE', 38, 10, 'selesai', '2023-12-22', '2023-12-23', '2023-12-21 11:40:09'),
(39, 'UPDATE', 30, 2, 'ditolak', '2023-12-16', '2023-12-19', '2023-12-21 14:36:43'),
(40, 'DELETE', 29, NULL, 'ditolak', NULL, NULL, '2023-12-21 14:54:02'),
(41, 'DELETE', 10, 2, 'selesai', '2023-12-06', '2023-12-14', '2023-12-21 15:06:12'),
(42, 'DELETE', 11, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-14', '2023-12-21 15:06:58'),
(43, 'DELETE', 12, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-15', '2023-12-21 15:07:01'),
(44, 'DELETE', 13, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-15', '2023-12-21 15:07:23'),
(45, 'DELETE', 14, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-21 15:07:27'),
(46, 'DELETE', 15, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-21 15:07:30'),
(47, 'DELETE', 16, 2, 'menunggu_konfirmasi', NULL, NULL, '2023-12-21 15:07:34'),
(48, 'DELETE', 17, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-13', '2023-12-21 15:07:37'),
(49, 'DELETE', 18, 2, 'ditolak', NULL, NULL, '2023-12-21 15:07:40'),
(50, 'DELETE', 19, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-16', '2023-12-21 15:07:56'),
(51, 'DELETE', 20, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-13', '2023-12-21 15:07:59'),
(52, 'DELETE', 21, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-21 15:08:07'),
(53, 'DELETE', 22, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-16', '2023-12-21 15:08:10'),
(54, 'DELETE', 23, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-16', '2023-12-21 15:08:18'),
(55, 'DELETE', 24, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-20', '2023-12-21 15:08:24'),
(56, 'DELETE', 30, 2, 'ditolak', '2023-12-16', '2023-12-19', '2023-12-21 15:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `notelp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `isChangePassword` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `notelp`, `email`, `role`, `isChangePassword`) VALUES
(1, 'admin', '$2y$10$46EDYWnooobvaq.K2I5TiOgZwSk3vo4f/OTWqKd1zlf92qh7PT91y', 'admin', '', '', 'Admin', NULL),
(2, 'user', '$2y$10$pEbmSoC82qRpj5GmEAIWfu9tzaIZ7u4TwcLsKDE29UXexVO77fC0m', 'user', '3225425', 'user', 'User', NULL),
(5, 'fighaz', '$2y$10$IexOL7vP.f2ZIw2beCf4Tu5JgYuluMZhOz181qJRXeMT2WEa0ouFe', 'fighaz', '492348', 'fighaz', 'User', 1),
(8, 'sofi', '$2y$10$4Fpsb.bZ3pGCIKYvzwF/6.mr5h74dSCF7hGjzHnUgfsB/Pl.Wb2tS', 'sofi', '', '', 'User', 0),
(9, 'saya', '$2y$10$voaQFbygV3zNbyl63jnsj.9Op3nDrQ6.tViPC9ooDUN//NoXUgu.a', 'saya', '24442', 'saya', 'User', 0),
(10, '2241720026', '$2y$10$cXCU8bk9ZNZn6qGkUDvFweWlisNTjXRKPzLkChEAmwvPlPg5gx67y', 'SOFISUGIHARTO ZAINI', '0812829812', 'gmail.com', 'User', 1);

-- --------------------------------------------------------

--
-- Structure for view `all_peminjaman`
--
DROP TABLE IF EXISTS `all_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_peminjaman`  AS SELECT `p`.`id` AS `id_peminjaman`, `u`.`nama` AS `nama_peminjam`, group_concat(`b`.`nama` separator ', ') AS `nama_barang`, `p`.`status` AS `status`, `p`.`tanggal_peminjaman` AS `tanggal_peminjaman`, `p`.`tanggal_pengembalian` AS `tanggal_pengembalian` FROM (((`users` `u` join `peminjaman` `p` on(`u`.`id` = `p`.`id_user`)) join `detail_peminjaman` `dp` on(`p`.`id` = `dp`.`id_peminjaman`)) join `barang` `b` on(`dp`.`id_barang` = `b`.`id`)) WHERE `u`.`id` = `p`.`id_user` GROUP BY `p`.`id``id`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asal_barang_FK` (`asal`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_barang`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `peminjaman_log`
--
ALTER TABLE `peminjaman_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `peminjaman_log`
--
ALTER TABLE `peminjaman_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `asal_barang_FK` FOREIGN KEY (`asal`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id`),
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
