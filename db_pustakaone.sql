-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2026 at 05:58 AM
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
-- Database: `db_pustakaone`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `sinopsis` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun_terbit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `img`, `judul`, `penulis`, `penerbit`, `sinopsis`, `tahun_terbit`) VALUES
(131, '../img/UK-Sapiens-e1486635350531.jpg', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harper', 'Buku ini mengisahkan evolusi Homo sapiens dari spesies primitif menjadi penguasa bumi. Harari mengeksplorasi perkembangan budaya, agama, ekonomi, dan teknologi yang membentuk peradaban modern.', 2015),
(132, '../img/book-cover-To-Kill-a-Mockingbird-many-1961.webp', 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott & Co.', 'Novel ini menceritakan perjuangan seorang pengacara di Alabama yang membela pria Afrika-Amerika yang dituduh memperkosa wanita kulit putih. Ceritanya menyoroti isu rasisme dan ketidakadilan.', 1960),
(133, '1984.jpg', '1984', 'George Orwell', 'Secker & Warburg', 'Sebuah novel dystopia tentang masyarakat di mana pemerintah memantau setiap gerak-gerik warga dan menekan kebebasan berpikir. Orwell menggambarkan bahaya totalitarianisme.', 1949),
(134, '../img/81QuEGw8VPL._AC_UF1000,1000_QL80_.jpg', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Charles Scribner\'s Sons', 'Novel ini berkisah tentang mimpi Amerika dan obsesi Jay Gatsby pada Daisy Buchanan, dengan latar belakang era jazz dan kemewahan di Amerika tahun 1920-an.', 1925),
(135, '../img/_4121.jpg', 'Pride and Prejudice', 'Jane Austen', 'T. Egerton', 'Buku ini mengikuti hubungan Elizabeth Bennet dan Mr. Darcy dalam konteks kelas sosial Inggris abad ke-19. Austen mengeksplorasi tema cinta, harga diri, dan prasangka.', 1813),
(136, '../img/8125BDk3l9L._AC_UF1000,1000_QL80_.jpg', 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', 'Kisah remaja Holden Caulfield yang mencoba memahami dunia dewasa yang ia anggap penuh kepalsuan. Novel ini menangkap kegelisahan dan isolasi remaja.', 1951),
(137, '../img/download (2).jpeg', 'The Hobbit', 'J.R.R. Tolkien', 'George Allen & Unwin', 'Kisah petualangan Bilbo Baggins, hobbit yang ditarik ke dalam misi untuk mencuri harta dari naga Smaug. Novel ini merupakan pendahulu dari seri \"The Lord of the Rings.\"', 1937),
(138, '../img/images.jpeg', 'Moby Dick', 'Herman Melville', 'Harper & Brothers', 'Buku ini bercerita tentang Kapten Ahab yang terobsesi untuk memburu paus putih, Moby Dick. Novel ini adalah refleksi tentang perjuangan manusia melawan alam.', 1851),
(139, '../img/ID_HCO2015MTH12TALC.jpeg', 'The Alchemist', 'Paulo Coelho', 'HarperOne', 'Cerita tentang perjalanan seorang penggembala muda bernama Santiago mencari harta karun yang tersembunyi. Dalam perjalanannya, ia menemukan pelajaran hidup yang mendalam.', 1988),
(153, '../img/9786020332956_Bumi-New-Cover.jpg', 'Bumi', 'Tere Liye', 'Gramedia Pustaka Utama', 'Buku ke-1 Petualangan Raib, Ali dan Seli.**Novel ini adalah naskah awal (asli) dari penulis; tanpa sentuhan editing, layout serta cover dari penerbit, dengan demikian, naskah ini berbeda dengan versi cetak, pun memiliki kelebihan dan kelemahan masing-masing.', 2014),
(154, '../img/no longer human.jpg', 'Tertolak Sebagai Manusia', 'Osamu Dazai', 'KAKATUA', 'Yozo adalah seorang pemuda yang eksentrik dan lain dari kebanyakan manusia di sekitarnya dalam memandang diri dan masyarakat. Dia selalu berusaha menyesuaikan diri dengan siapa pun, menurunkan dirinya sampai pada level mereka, tapi dia malah disalahpahami, diperalat, dan bahkan dikhianati. Dia berperan sebagai seorang badut, karena manusia membuatnya takut bersikap jujur. Seiring berjalannya waktu, dalam memainkan peran badut itu dia terjebak di tengah berbagai pengalaman yang tidak menguntungkan, jatuh pada kebiasaan destruktif yang pada akhirnya semakin membuatnya tidak berdaya.', 1948),
(155, '../img/9789792248616_negeri-5-menara-_cu-cover-baru_.jpg', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 'Novel Negeri 5 Menara bercerita tentang kehidupan 6 santri yang berasal dari 6 daerah yang berbeda di Indonesia, Mereka bersama sama menuntut ilmu di Pondok Madani ponorogo, jawa timur. Setelah sekian tahun masing masing akhirnya berhasil mewujudkan mimpi pribadinya menggapai jendela dunia.', 2009),
(156, '../img/ayat cinta.jpeg', 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 'Republika', 'Ayat-Ayat Cinta adalah novel berbahasa Indonesia karangan Habiburrahman El Shirazy yang diterbitkan pertama kali pada tahun 2004 melalui penerbit Basmala dan Republika.', 2004),
(157, '../img/salmon.jpeg', 'Manusia Setengah Salmon', 'Raditya Dika', 'ON THE SPOT', 'Kumpulan cerita lucu dan refleksi kehidupan sehari-hari yang menghibur sekaligus menggugah hati.', 2011),
(158, '../img/KPBJ.jpg', 'Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'Dee Lestari', 'Truedee Books', 'Sebuah kisah kompleks yang menghubungkan cinta, sains, dan spiritualitas.', 2001),
(160, '../img/Sang_Pemimpi_sampul.jpg', 'Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka', 'Kisah penuh motivasi tentang mimpi besar dua sahabat yang ingin mengubah nasib mereka.', 2006),
(161, '../img/9786020655307_KOMIK_HUJAN_BULAN_JUNI__C-14-1.jpg', 'Hujan Bulan Juni', 'Sapardi Djoko Damono', 'Gramedia Pustaka Utama', 'Kumpulan puisi yang romantis dan penuh keindahan metafora.', 1994),
(162, '../img/1.jpg', 'Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', 'Kisah cinta dan mimpi dua remaja yang dipertemukan oleh seni dan kehidupan.', 2009),
(163, '../img/KPBJ.jpg', 'Crime and Punishment', 'Fyodor Dostoevsky', 'Russian Book', 'Seseorang yang terjebak dalam kasus absurd tanpa akhir', 1940);

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
(99, 131, 15),
(100, 132, 2),
(101, 133, 16),
(102, 134, 17),
(103, 135, 18),
(104, 136, 16),
(105, 137, 19),
(106, 138, 11),
(107, 139, 11),
(114, 153, 19),
(115, 154, 20),
(116, 155, 21),
(117, 156, 22),
(118, 157, 17),
(119, 158, 16),
(121, 160, 21),
(122, 161, 2),
(123, 162, 18),
(124, 163, 20);

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
(11, 'Adventure'),
(12, 'Biologi'),
(13, 'Fisika'),
(14, 'Matematika'),
(15, 'Biografi'),
(16, 'Fiksi Ilmiah'),
(17, 'Tragedi'),
(18, 'Romance'),
(19, 'Fantasy'),
(20, 'Novel'),
(21, 'Fiksi Inspiratif'),
(22, 'Fiksi Religius');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id_koleksi` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koleksi_pribadi`
--

INSERT INTO `koleksi_pribadi` (`id_koleksi`, `user_id`, `buku_id`) VALUES
(90, 40, 132);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `tanggal_peminjaman` datetime DEFAULT NULL,
  `durasi` int NOT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `status_peminjaman` enum('dipinjam','terlambat','pending','dikembalikan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `user_id`, `buku_id`, `tanggal_peminjaman`, `durasi`, `tanggal_pengembalian`, `status_peminjaman`, `tanggal_pengajuan`) VALUES
(82, 40, 132, NULL, 14, NULL, 'pending', '2026-03-27 04:32:20');

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
(9, 'petugas', '$2y$10$CQK/1TVheuAPvdUaDTpLdOHU9xkeSUWgNUYbLVWh142lxqMBI5Umm', 'zefa.hazel01@gmail.com', 'petugas', 'tes', 'petugas'),
(38, 'admin52', '$2y$10$8kH9l23IpahYQbFSvVK.Deu82Yr78VMgG5z/9Om5iosnG/A1DRW0m', 'admin123321@gmail.com', 'ad', 'ad', 'admin'),
(39, 'user', '$2y$10$n0ucp5jhNOp/Vv4fa/yyruxBxpO.wqsMnCthVuRFi7zFHps8ykPg6', 'user@gmail.com', 'user', 'tes', 'user'),
(40, 'hazel', '$2y$10$I3e7fXuAwNQ.Y.VpFY6g..fd5FzDDZ.hdLh8H0eK8epdr6nZ8gld2', 'zefa.hazel01@gmail.com', 'Zefanya Hazel', 'tes', 'user'),
(41, 'admin', '$2y$10$sf1vnkjeNH1VylPz0PFZ4.VoYjpiKPPXjjamimtciR0BfiZSZDkki', 'admin@gmail.com', 'admin', 'tes', 'admin');

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
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `id_kategori_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id_koleksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
