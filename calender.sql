-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2023 pada 16.43
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calender`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `username` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `jam` int(50) DEFAULT NULL,
  `menit` int(50) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`username`, `id`, `nama_kegiatan`, `tgl_mulai`, `tgl_selesai`, `level`, `jam`, `menit`, `lokasi`, `gambar`) VALUES
('kevinchristian', 1, 'P3DM', '2023-06-07', '2023-06-08', 'Penting', 9, 11, 'UKDW', 'th (6).jpg'),
('kevinchristian', 2, 'sfas', '2023-06-07', '2023-06-08', 'Biasa', 1, 1, 'UKDW', 'th (3).jpg'),
('kevinchristian', 3, 'sfas', '2023-06-07', '2023-06-08', 'Biasa', 1, 1, 'UKDW', 'th (3).jpg'),
('kevinchristian', 4, 'fasf', '2023-06-08', '2023-06-23', 'Biasa', 23, 23, 'dsfas', NULL),
('geraldj', 5, 'fsaf', '2023-06-08', '2023-06-09', 'Biasa', 9, 14, 'UKDW', 'th (2).jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs`
--

CREATE TABLE `mhs` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mhs`
--

INSERT INTO `mhs` (`username`, `password`, `nama`) VALUES
('geraldj', '71210799', 'Gerald'),
('kevinchristian', '71210797', 'Kevin Christian');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `mhs` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
