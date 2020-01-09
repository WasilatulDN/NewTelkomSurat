-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Waktu pembuatan: 08 Jan 2020 pada 10.00
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11
=======
-- Generation Time: Jan 07, 2020 at 12:26 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1
>>>>>>> master

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kptelkomsurat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `nama_surat` varchar(500) DEFAULT NULL,
  `kode_surat` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_surat`
--

CREATE TABLE `nomor_surat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nama_surat` varchar(200) DEFAULT NULL,
  `jenis_surat` varchar(15) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `huruf` int(11) DEFAULT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_pengupload` varchar(200) DEFAULT NULL,
  `pengecekan` int(11) DEFAULT NULL,
  `file` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_surat`
--

INSERT INTO `nomor_surat` (`id`, `id_user`, `name`, `nama_surat`, `jenis_surat`, `nomor`, `no_surat`, `tanggal`, `nama_pengupload`, `pengecekan`, `file`) VALUES
(8, 0, 'Dika', 'Surat Permohonan Pengadaan', '4', 1, 'TEL.1/YN000/R5W-5M470000/2020', '2020-01-03', 'sisa', NULL, 'TEL1.jpg'),
(9, 0, 'Fiya', 'Surat untuk ITS', '2', 16, 'TEL.16/YN000/R5W-5M470000/2020', '2020-01-06', 'aku', 1, 'TEL16.jpg'),
(10, 0, 'Dani', 'Surat Rekap', '4', 2, 'TEL.2/YN000/R5W-5M470000/2020', '2020-01-03', 'aku', NULL, 'TEL2.jpg'),
(11, 0, 'lutfiy', 'suratt dinas', '2', 6, 'TEL.6/YN000/R5W-5M470000/2020', '2020-01-04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>> master

--
-- AUTO_INCREMENT untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
