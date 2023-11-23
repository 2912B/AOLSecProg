-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Nov 2023 pada 13.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aolsecprog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `library`
--

CREATE TABLE `library` (
  `Book_ID` int(11) NOT NULL,
  `Judul` varchar(100) NOT NULL,
  `Tahun_Terbit` varchar(50) NOT NULL,
  `Genre` varchar(50) NOT NULL,
  `Jumlah_Halaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `library`
--

INSERT INTO `library` (`Book_ID`, `Judul`, `Tahun_Terbit`, `Genre`, `Jumlah_Halaman`) VALUES
(1, 'Harry Potter', '2000', 'Fantasy', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempt`
--

CREATE TABLE `login_attempt` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `time_login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`User_ID`, `Username`, `Email`, `Password`, `Role`) VALUES
(1, 'administrator', 'admin@gmail.com', '$2y$10$1Y0uD4fEmhHGcEv75gOwD.ZcWW28Fo3jVbMjyevp/4.z7Rc89AFIa', 'admin'),
(2, 'benny123', 'benny@gmail.com', '$2y$10$8wMp0y.gzHhdo02Pv.65kO91RF6cR5/fYqO92wAjuMWNPVarjcJbi', 'user'),
(3, 'justin123', 'justin@gmail.com', '$2y$10$amWGAD3YiaTGPfVtnnppLOKAv2FyyQWjpG4b9WFySifooSHGEvehe', 'user'),
(4, 'hellossss', 'hellossss@gmail.com', '$2y$10$h0w3FIIwAcZNN0VoOuLqyuodPjRjc3wz5xKEBNy.VavdDeJaMqsK2', 'user'),
(5, 'bianceeee', 'biance@gmail.com', '$2y$10$F37Wynr.Heu0RTeeAQ.yJu8J3bdmK3GsPINPlIpAJuvfFz6KRJtyW', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indeks untuk tabel `login_attempt`
--
ALTER TABLE `login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `library`
--
ALTER TABLE `library`
  MODIFY `Book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `login_attempt`
--
ALTER TABLE `login_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
