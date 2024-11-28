-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2024 at 11:34 PM
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
-- Database: `perpus_usk`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`) VALUES
(33, 'MENGELOLA NYALI UNTUK BERISTRI EMPAT', 'Kai Cenat', 'I SHOW SPEED PRODUCTION', '2024-09-03'),
(35, 'PETUALANGAN KAZUMA MENCARI DRAGON BALL', 'Kai Cenat', 'ON THE SPOT', '2024-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `id_kategori_buku` int NOT NULL,
  `buku_id` int NOT NULL,
  `kategori_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`id_kategori_buku`, `buku_id`, `kategori_id`) VALUES
(13, 33, 2),
(15, 35, 11);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Drama'),
(11, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id_koleksi` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `status_peminjaman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `user_id`, `buku_id`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`) VALUES
(37, 25, 33, '2024-09-12 00:17:08', '2024-09-12 00:24:51', 'tidak aktif'),
(38, 25, 33, '2024-09-12 01:47:33', NULL, 'aktif'),
(39, 25, 35, '2024-09-12 01:48:13', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id_ulasan` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('admin','petugas','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `level`) VALUES
(7, 'hazel123', '$2y$10$9gI3B./3X6/4M3JtEZwZFe/9vlfYwaavQ7qOlt7Fl.C2g9pqNqNOe', 'zefa.hazel01@gmail.com', 'admin', 'adad', 'admin'),
(8, 'admin', '$2y$10$XbQvbCxmyrSsLFms/YBxke8NenMFTzyxAeX2ZE.vjV.mHCgvYZqq2', 'zefa.hazel01@gmail.com', 'hazel', 'admin hazel', 'admin'),
(9, 'petugas', '$2y$10$yNWF/h5kvbqgsU8..MaXVuuripdpYhWWg9uKjJxhLuoHIEf0UYuYy', 'zefa.hazel01@gmail.com', 'awdsad', 'jalanan', 'petugas'),
(16, 'philip', '$2y$10$RaQlKHuHWcvc/oL4ZhzTG.XwmUVoL6CnmVleSy1JGyPsAeOUuDQyu', 'pilip@pilip', 'pilip pilip', 'jalan pilip', 'admin'),
(25, 'pilip', '$2y$10$BsejTo5NGexcfq8vnOxFiet8GmW07QvGQtZFlMEn7FekmL0Nkp5C.', 'dawd@adwd', 'Philip Febrian', 'jalanan', 'user'),
(28, 'hazel', '$2y$10$r5BUiNIrDKWMF.GfnwUimOO8iDPUi5Riim7SpewCPLz9fYO5cjQz6', 'zefa.hazel01@gmail.com', 'admin', 'admin', 'user'),
(29, 'admin123', '$2y$10$6yPIxu1ZFXmCaC.KBrlnc.B3XlUKY6g45CajNeTnHJ.0T6mlTMzUe', 'zefa.hazel01@gmail.com', 'admin', 'jalanan', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`id_kategori_buku`),
  ADD KEY `buku_id` (`buku_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD PRIMARY KEY (`id_koleksi`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `id_kategori_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id_koleksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_buku` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD CONSTRAINT `koleksi_pribadi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksi_pribadi_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD CONSTRAINT `ulasan_buku_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_buku_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
