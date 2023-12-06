-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2023 at 02:16 AM
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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `maintainer` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jumlah`, `kondisi`, `asal`, `keterangan`, `maintainer`, `gambar`) VALUES
(1, 'Spidol', 100, 'Baik', 'Pembelian', 'Keterangan1', 'Pak Jadi', 'gambar1.jpg'),
(2, 'Remote AC', 50, 'Rusak', 'Pembelian', 'Keterangan2', 'Pak Jadi', 'gambar2.jpg'),
(3, 'Proyektor', 70, 'Baik', 'Hibah', 'Keterangan3', 'Mas Wowon', 'gambar3.jpg'),
(4, 'Remote Proyektor', 30, 'Baik', 'Pembelian', 'Keterangan4', 'Mbak Novi', 'gambar4.jpg'),
(5, 'Penghapus', 100, 'Rusak', 'Pembelian', 'Keterangan5', 'Mas Wowon', 'gambar5.jpg'),
(6, 'Keyboard', 93, 'Baik', 'Hibah', 'Keterangan5', 'Mas Wowon', 'gambar6.jpg'),
(7, 'Mouse', 157, 'Cukup', 'Pembelian', 'Keterangan5', 'Mbak Novi', 'gambar7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_peminjaman`, `id_barang`, `jumlah`) VALUES
(1, 1, 2),
(2, 3, 1),
(3, 5, 2),
(4, 4, 1),
(5, 2, 3),
(6, 1, 4),
(7, 2, 2),
(8, 3, 1),
(9, 5, 2),
(10, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` enum('menunggu','dipinjam','terlambat','selesai','ditolak') DEFAULT 'menunggu',
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_user`, `status`, `keterangan`, `tanggal_peminjaman`, `tanggal_pengembalian`) VALUES
(1, 2, 'menunggu', 'Peminjaman laptop untuk keperluan praktikum', '2023-11-27', '2023-12-05'),
(2, 2, 'dipinjam', 'Peminjaman proyektor untuk presentasi', '2023-11-28', '2023-12-06'),
(3, 2, 'terlambat', 'Peminjaman mouse untuk kegiatan seminar', '2023-11-29', '2023-12-07'),
(4, 2, 'selesai', 'Peminjaman penghapus untuk kelas', '2023-11-30', '2023-12-08'),
(5, 2, 'ditolak', 'Peminjaman remote AC yang rusak', '2023-12-01', '2023-12-09'),
(6, 2, 'menunggu', 'Peminjaman keyboard untuk kegiatan workshop', '2023-12-02', '2023-12-10'),
(7, 2, 'dipinjam', 'Peminjaman spidol untuk keperluan kuliah', '2023-12-03', '2023-12-11'),
(8, 2, 'selesai', 'Peminjaman remote proyektor', '2023-12-04', '2023-12-12'),
(9, 2, 'ditolak', 'Peminjaman penghapus yang rusak', '2023-12-05', '2023-12-13'),
(10, 2, 'terlambat', 'Peminjaman mouse untuk kegiatan pelatihan', '2023-12-06', '2023-12-14');

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
(2, 'user', '$2y$10$r47QADWCNjdYiezczCs.7Oye.h2CvPeop9gHN53Qe3czZKMQb4wy2', 'user', 'User', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_barang` (`id_barang`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id`),
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
