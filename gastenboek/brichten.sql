-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 mrt 2024 om 11:36
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gastenboek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `brichten`
--

CREATE TABLE `brichten` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `bricht` text NOT NULL,
  `datumtijd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `brichten`
--

INSERT INTO `brichten` (`id`, `naam`, `bricht`, `datumtijd`) VALUES
(1, 'Alex', 'mooi weer', '2020-04-20'),
(2, 'Max', 'hi, hoe gaat het', '2023-05-16'),
(3, 'ojl;rg', 'ywty43', '0000-00-00'),
(4, 'wissam', 'hallo jij ', '2020-05-20'),
(5, 'faefa', 'sagewg', '0000-00-00'),
(6, 'dfga', 'AEGgaEGE', '2023-01-01'),
(7, 'wissam', 'hallo ', '2020-05-20');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `brichten`
--
ALTER TABLE `brichten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `brichten`
--
ALTER TABLE `brichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
