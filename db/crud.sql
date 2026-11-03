-- phpMyAdmin SQL Dump
-- Database: `crud`

CREATE DATABASE IF NOT EXISTS `crud`;
USE `crud`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lomba`
--

CREATE TABLE IF NOT EXISTS `lomba` (
  `id_lomba` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lomba` varchar(50) NOT NULL,
  `tingkat_lomba` varchar(25) NOT NULL,
  `tanggal_lomba` date NOT NULL,
  PRIMARY KEY (`id_lomba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lomba`
--

INSERT INTO `lomba` (`id_lomba`, `nama_lomba`, `tingkat_lomba`, `tanggal_lomba`) VALUES
(1, 'Atletik Lari 100M', 'SMA/SLTA Sederajad', '2026-11-15'),
(2, 'Renang Gaya Bebas', 'SMP/SLTP Sederajad', '2026-11-20'),
(3, 'Bulu Tangkis Tunggal', 'SMA/SLTA Sederajad', '2026-11-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE IF NOT EXISTS `peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peserta` varchar(50) NOT NULL,
  `jekel` varchar(25) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `jenis_lomba` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `jekel`, `sekolah`, `jurusan`, `jenis_lomba`, `no_hp`, `alamat`) VALUES
(1, 'Uci Rahmadani', 'Perempuan', 'SMAN 6 PADANG', 'MIPA 1', 'Bulu Tangkis Tunggal', '081365371204', 'Jl. Banuaran No. 12, Padang'),
(2, 'Hirohito Nozomi', 'Laki-Laki', 'SMAN 1 PAYAKUMBUH', 'MIPA 3', 'Atletik Lari 100M', '082171888225', 'Jl. Sudirman No. 45, Payakumbuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id_sekolah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(50) NOT NULL,
  `tlp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `tlp`, `alamat`) VALUES
(1, 'SMAN 6 PADANG', '0751-71234', 'Jl. Cendana, Banuaran Indah, Padang'),
(2, 'SMAN 1 PAYAKUMBUH', '0752-92134', 'Jl. Sudirman No. 1, Payakumbuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@email.com', 'admin');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
