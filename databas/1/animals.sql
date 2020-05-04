-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 04 maj 2020 kl 11:23
-- Serverversion: 10.4.8-MariaDB
-- PHP-version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `zoo`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `specimens` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumpning av Data i tabell `animals`
--

INSERT INTO `animals` (`id`, `name`, `category`, `specimens`) VALUES
(1, 'Elefant', 'däggdjur', 2),
(2, 'Myrslok', 'däggdjur', 3),
(3, 'Myskanka', 'fågel', 127),
(4, 'Tanganyikaciklid', 'fisk', 900),
(5, 'Komodovaran', 'reptil', 4),
(6, 'Blåval', 'däggdjur', 1),
(7, 'Vombat', 'däggdjur', 12),
(8, 'Kapybara', 'däggdjur', 17),
(9, 'Skata', 'fågel', 2),
(10, 'Ekoxe', 'insekt', 2),
(11, 'Träbock', 'insekt', 11),
(12, 'Kammussla', 'blötdjur', 4),
(13, 'Mört', 'fisk', 12);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
