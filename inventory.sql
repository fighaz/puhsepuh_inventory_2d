-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2023 at 09:57 AM
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
(1, 'Spidol', 100, 20, 'Baik', 2, 'Keterangan1', 'Keterangan1', 'gambar1.jpg'),
(2, 'Remote AC', 50, 20, 'Rusak', 2, 'Keterangan2', 'Pak Jadi', 'gambar2.jpg'),
(3, 'Proyektor', 70, 20, 'Baik', 1, 'Keterangan3', 'Keterangan3', 'gambar3.jpg'),
(4, 'Remote Proyektor', 30, 20, 'Baik', 2, 'Keterangan4', 'Mbak Novi', 'gambar4.jpg'),
(5, 'Penghapus', 100, 20, 'Rusak', 2, 'Keterangan5', 'Mas Wowon', 'gambar5.jpg'),
(6, 'Keyboard', 93, 15, 'Baik', 1, 'Keterangan5', 'Mas Wowon', 'gambar6.jpg'),
(9, 'd', 21, 21, 'Baik', 2, 'sad', 'sad', '65717367d8d94.png'),
(10, 'sasdj', 12, 11, 'Baik', 2, 'asdsad', 'asdsad', '6572b85b147ea.png'),
(12, 'sad', 3, 1, 'Baik', 1, 'sdf', 'sdf', '6572c9662b33f.png'),
(13, '[value-2]', 20, 10, '[value-5]', 2, '[value-7]', '[value-8]', '[value-9]');

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
(28, 6, 5, 'sdfds');

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
(2, 'Pembelian', '');

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
(2, 1),
(5, 1),
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
  `perubahan_status` timestamp NOT NULL DEFAULT current_timestamp()
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
(10, 2, 'terlambat', '2023-12-06', '2023-12-14', '2023-12-15 08:49:15'),
(11, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-14', '2023-12-15 08:49:15'),
(12, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-15', '2023-12-15 08:49:15'),
(13, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-15', '2023-12-15 08:49:15'),
(14, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-15 08:49:15'),
(15, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-15 08:49:15'),
(16, 2, 'menunggu_konfirmasi', NULL, NULL, '2023-12-15 08:49:15'),
(17, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-13', '2023-12-15 08:49:15'),
(18, 2, 'menunggu_konfirmasi', NULL, NULL, '2023-12-15 08:49:15'),
(19, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-16', '2023-12-15 08:49:15'),
(20, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-13', '2023-12-15 08:49:15'),
(21, 2, 'menunggu_konfirmasi', '2023-12-13', '2023-12-14', '2023-12-15 08:49:15'),
(22, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-16', '2023-12-15 08:49:15'),
(23, 2, 'menunggu_konfirmasi', '2023-12-14', '2023-12-16', '2023-12-15 08:49:15'),
(24, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(25, 2, 'ditolak', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(26, 2, 'menunggu_konfirmasi', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(27, 2, 'menunggu_diambil', '2023-12-15', '2023-12-20', '2023-12-15 08:49:15'),
(28, 2, 'menunggu_konfirmasi', '2023-12-20', '2023-12-25', '2023-12-15 08:49:15'),
(29, NULL, 'ditolak', NULL, NULL, '2023-12-15 08:49:15'),
(30, 2, 'menunggu_konfirmasi', '2023-12-16', '2023-12-19', '2023-12-15 08:49:15');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `after_update_peminjaman` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    IF NEW.status = 'selesai' OR NEW.status = 'ditolak' THEN
        -- Update the 'tersedia' field in the 'barang' table based on the completed or rejected loan
        UPDATE barang
        SET tersedia = tersedia + (
            SELECT jumlah
            FROM detail_peminjaman
            WHERE id_peminjaman = NEW.id
        )
        WHERE id IN (
            SELECT id_barang
            FROM detail_peminjaman
            WHERE id_peminjaman = NEW.id
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `isChangePassword` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `isChangePassword`) VALUES
(1, 'admin', '$2y$10$46EDYWnooobvaq.K2I5TiOgZwSk3vo4f/OTWqKd1zlf92qh7PT91y', 'admin', 'Admin', NULL),
(2, 'user', '$2y$10$r47QADWCNjdYiezczCs.7Oye.h2CvPeop9gHN53Qe3czZKMQb4wy2', 'user', 'User', NULL),
(5, 'fighaz', '$2y$10$ZCZl1IY6k/41Pfq4njN0aue/3XUCHaUhn/Z5UUehlaIVsIBhoqL0m', 'fighaz', 'User', 1),
(8, 'sofi', '$2y$10$4Fpsb.bZ3pGCIKYvzwF/6.mr5h74dSCF7hGjzHnUgfsB/Pl.Wb2tS', 'sofi', 'User', 0);

-- --------------------------------------------------------

--
-- Structure for view `all_peminjaman`
--
DROP TABLE IF EXISTS `all_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_peminjaman`  AS SELECT `p`.`id` AS `id_peminjaman`, `u`.`nama` AS `nama_peminjam`, group_concat(`b`.`nama` separator ', ') AS `nama_barang`, `p`.`status` AS `status`, `p`.`tanggal_peminjaman` AS `tanggal_peminjaman`, `p`.`tanggal_pengembalian` AS `tanggal_pengembalian` FROM (((`users` `u` join `peminjaman` `p` on(`u`.`id` = `p`.`id_user`)) join `detail_peminjaman` `dp` on(`p`.`id` = `dp`.`id_peminjaman`)) join `barang` `b` on(`dp`.`id_barang` = `b`.`id`)) WHERE `u`.`id` = `p`.`id_user` GROUP BY `p`.`id` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
