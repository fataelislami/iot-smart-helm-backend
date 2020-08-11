-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 Agu 2020 pada 15.04
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart-helm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `suhu`
--

CREATE TABLE `suhu` (
  `id` int(11) NOT NULL,
  `suhu` double NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_wa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suhu`
--

INSERT INTO `suhu` (`id`, `suhu`, `date_time`, `no_wa`) VALUES
(5, 37.5, '2020-08-11 19:07:59', '1923123'),
(6, 37, '2020-08-11 19:47:48', '2147483647'),
(7, 37, '2020-08-11 19:47:51', '2147483647'),
(8, 37, '2020-08-11 19:47:52', '2147483647'),
(9, 37, '2020-08-11 19:47:52', '2147483647'),
(10, 37, '2020-08-11 19:47:53', '2147483647'),
(11, 37, '2020-08-11 19:47:54', '2147483647'),
(12, 38, '2020-08-11 19:47:59', '2147483647'),
(13, 38, '2020-08-11 19:49:28', '81224907778'),
(14, 38, '2020-08-11 19:49:29', '81224907778'),
(15, 39, '2020-08-11 19:49:33', '81224907778'),
(16, 39, '2020-08-11 19:49:34', '81224907778'),
(17, 37, '2020-08-11 19:49:40', '81224907778'),
(18, 37, '2020-08-11 19:49:41', '81224907778');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suhu`
--
ALTER TABLE `suhu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suhu`
--
ALTER TABLE `suhu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
