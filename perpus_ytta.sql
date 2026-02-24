-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2026 pada 14.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_ytta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`) VALUES
(1, 'Admin', '123', 'Sasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(6) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nis`, `nama_anggota`, `username`, `password`, `kelas`) VALUES
(1, '0809', 'Rasya Putra Pratama', 'erzy', '456', 'XII SIJA'),
(3, '0601', 'Stanley Adam Al - Fajri', 'Gulingtelor', '123', 'XII SIJA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(6) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `status` enum('tersedia','tidak') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `status`, `gambar`) VALUES
(4, 'Kita adalah Jokowi', 'Cho Koi Wee', 'PT. Sawit Sejahtera', '2010', 'tersedia', '1771060161_WhatsApp Image 2026-02-14 at 3.52.44 PM.jpeg'),
(5, 'Are you listening?', 'Tillie Walden', 'PT. YTTA aja', '2017', 'tersedia', '1771060257_WhatsApp Image 2026-02-14 at 3.52.43 PM (1).jpeg'),
(10, 'Atomic Habbits', 'James Clear', 'PT. International', '2020', '', '1771076613_WhatsApp Image 2026-02-14 at 3.52.43 PM.jpeg'),
(11, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'Penguin Classics', '1999', 'tersedia', '1771079400_WhatsApp Image 2026-02-14 at 9.27.38 PM.jpeg'),
(13, 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott & Co.', '1960', 'tersedia', '1771080393_WhatsApp Image 2026-02-14 at 9.46.21 PM.jpeg'),
(15, '1984', 'George Orwell', 'Secker & Warburg', '1949', 'tersedia', '1771080237_WhatsApp Image 2026-02-14 at 9.43.40 PM.jpeg'),
(16, 'The Hobbit', 'J.R.R. Tolkien', 'George Allen & Unwin', '1937', 'tersedia', '1771080203_WhatsApp Image 2026-02-14 at 9.43.09 PM.jpeg'),
(17, 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', '1951', 'tersedia', '1771080169_WhatsApp Image 2026-02-14 at 9.42.36 PM.jpeg'),
(18, 'Pride and Prejudice', 'Jane Austen', 'T. Egerton', '0000', 'tersedia', '1771080135_WhatsApp Image 2026-02-14 at 9.41.53 PM.jpeg'),
(20, 'The Alchemist', 'Paulo Coelho', 'HarperTorch', '1988', 'tersedia', '1771080046_WhatsApp Image 2026-02-14 at 9.40.33 PM.jpeg'),
(21, 'The Hunger Games', 'Suzanne Collins', 'Scholastic Press', '2008', 'tersedia', '1771080009_WhatsApp Image 2026-02-14 at 9.39.54 PM.jpeg'),
(22, 'The Fault in Our Stars', 'John Green', 'Dutton Books', '2012', 'tersedia', '1771079973_WhatsApp Image 2026-02-14 at 9.39.05 PM.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(6) NOT NULL,
  `id_anggota` int(50) NOT NULL,
  `id_buku` int(50) NOT NULL,
  `tgl_pinjam` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `tgl_kembali` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status_transaksi` enum('Peminjaman','Pengembalian') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_anggota`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status_transaksi`) VALUES
(1, 1, 1, '2026-02-14 13:30:00.000000', '2026-02-14 13:30:48.000000', 'Pengembalian'),
(3, 1, 1, '2026-02-14 13:39:13.000000', '2026-02-14 15:38:50.000000', 'Pengembalian'),
(18, 3, 15, '2026-02-15 08:55:00.000000', '2026-02-15 14:56:04.000000', 'Pengembalian'),
(19, 1, 11, '2026-02-15 08:55:00.000000', '2026-02-15 14:55:42.000000', 'Pengembalian'),
(20, 3, 18, '2026-02-15 08:55:00.000000', '2026-02-15 14:56:11.000000', 'Pengembalian'),
(21, 1, 10, '2026-02-15 08:56:00.000000', '2026-02-15 14:56:18.668906', 'Peminjaman');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
