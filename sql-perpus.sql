-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 02:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `loker_buku` varchar(25) NOT NULL,
  `no_rak` int(11) NOT NULL,
  `no_laci` int(11) NOT NULL,
  `no_boks` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `nama_pengarang` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `gambar_buku` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `loker_buku`, `no_rak`, `no_laci`, `no_boks`, `judul_buku`, `nama_pengarang`, `tahun_terbit`, `penerima`, `penerbit`, `status`, `keterangan`, `gambar_buku`) VALUES
(9, 'Buku Pemrograman', 1, 5, 1, 'Pemograman Web dasar', 'abdul', '2014-01-01', 'C-Perpus', 'pt.angkasa', 'Ada', '', 'Pemrograman Web.jpeg'),
(10, 'Buku Pemrograman', 0, 0, 0, 'Pemograman Web dasar', 'adul', '2030-04-01', 'C-Perpus', 'pt.angkasa jaya karta', 'Ada', 'Senja untuk sholat Magrib', 'Arduino dan Robotik.jpeg'),
(11, 'Buku Novel', 2, 3, 33, 'Cerita Para Sahabat Nabi', 'Senja jinawi', '0000-00-00', 'WPU ', 'pt.angkasa jaya karta', 'Ada', '', 'Arduino dan Robotik.jpeg'),
(12, 'Buku Pembelajaran', 283, 23, 233, 'Jurnal Ilmiah', 'aguss', '0000-00-00', 'perpus', 'agus.cp', 'Ada', '', '#JIHYO Wallpaper  #TWICE #JIHYOWALLPAPERS.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `jumlah`, `keterangan`, `tanggal`) VALUES
(1, 3000, 'Denda keterlambatan pengembalian buku Pemograman Web dasar', '2024-08-28 07:31:07'),
(2, 1000, 'Denda keterlambatan pengembalian buku Jurnal Ilmiah', '2024-09-01 11:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `judul_buku` varchar(50) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `tgl_pinjam` varchar(25) NOT NULL,
  `tgl_kembali` varchar(25) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`judul_buku`, `peminjam`, `tgl_pinjam`, `tgl_kembali`, `lama_pinjam`, `keterangan`, `id`) VALUES
('Pemograman Web dasar', 'agung', '2024-08-28', '2024-08-29', 1, '', 7),
('Pemograman Web dasar', 'anjay', '2024-08-09', '2024-08-29', 1, 'Senja untuk sholat Magrib', 8),
('Pemograman Web dasar', 'agung', '2024-08-15', '2024-08-29', 1, '', 9),
('Jurnal Ilmiah', 'agus', '2024-09-19', '2024-09-27', 8, 'pinjam', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `nama`, `level`, `ket`) VALUES
('admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', 'Rizky', 1, ''),
('agus', 'd41d8cd98f00b204e9800998ecf8427e', 'kyzk23@gmail.com', 'agus', 1, 'admin'),
('User', 'd41d8cd98f00b204e9800998ecf8427e', 'user@gmail.com', 'Cristiano Ronaldo', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
