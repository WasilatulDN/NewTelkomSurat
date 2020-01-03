-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2020 pada 08.23
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

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

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(18, 'lutfi', '$2y$12$VVJxTVd6L2lLU3pXSy9RVOpmgLHz.7md.M9V05mNLDBSvzckb8c3S'),
(19, 'kp', '$2y$12$bFdFNHB0UW5FM1NHTE10e.UiyTtR21sp7ICrQWOIT6Y.StRILPW5W'),
(20, 'mami', '$2y$12$ZElyNzBsa1ZFQUZKOXZGQuOYmvf31m3dL01Dcbep.HQsFmaD0GqKi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_surat`
--

CREATE TABLE `nomor_surat` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nama_surat` varchar(200) DEFAULT NULL,
  `jenis_surat` varchar(15) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_pengupload` varchar(200) DEFAULT NULL,
  `file` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_surat`
--

INSERT INTO `nomor_surat` (`id`, `name`, `nama_surat`, `jenis_surat`, `nomor`, `no_surat`, `tanggal`, `nama_pengupload`, `file`) VALUES
(1, 'Lut', 'fiyanti33@gmail.com', '0000', 0, NULL, NULL, NULL, NULL),
(2, 'Maho', 'maho@gmail.com', 'Hindu', 0, NULL, NULL, NULL, NULL),
(3, 'kuku', 'kaka', 'Islam', 0, NULL, NULL, NULL, NULL),
(4, 'adin', 'Kakaka', 'Hindu', 0, NULL, NULL, NULL, NULL),
(5, 'kaak', 'kaak', 'YN000', 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
