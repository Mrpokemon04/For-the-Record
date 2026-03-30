-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mart. 30, 2026 la 02:59 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `for the record!`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(865) NOT NULL,
  `artist` varchar(52) NOT NULL,
  `date` date NOT NULL,
  `genre` varchar(40) NOT NULL,
  `cover` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Eliminarea datelor din tabel `albums`
--

INSERT INTO `albums` (`id`, `name`, `artist`, `date`, `genre`, `cover`) VALUES
(1, 'Agaetis Byrjun', 'Sigur Ros', '1999-06-12', 'post-rock', 'covers/agaetisbyrjun.jpg'),
(2, 'Currents', 'Tame Impala', '2015-07-17', 'psychedelic-pop,synthpop,neo-psychedelia', 'covers/currents.jpg'),
(3, 'Lonerism', 'Tame Impala', '2012-10-05', 'neo-psychedelia,psychedelic-rock', 'covers/lonerism.jpg'),
(4, 'Mezzanine', 'Massive Attack', '1998-04-20', 'trip hop,post-industrial', 'covers/mezzanine.jpg'),
(5, 'Steal This Album!', 'System of a Down', '2002-11-26', 'alternative metal', 'covers/stealthisalbum.jpg'),
(6, 'What\'s Going On', 'Marvin Gaye', '1971-05-21', 'soul', 'covers/whatsgoingon.jpg'),
(7, 'Off the Wall', 'Michael Jackson', '1979-08-10', 'disco', 'covers/offthewall.jpg'),
(8, 'Discovery', 'Daft Punk', '2001-03-13', 'french house', 'covers/discovery.jpg'),
(9, 'Igor', 'Tyler, the Creator', '2019-05-17', 'neo-soul', 'covers/igor.jpg'),
(10, 'Mr. Morale & The Big Steppers', 'Kendrick Lamar', '2022-05-13', 'conscious hip-hop,west coast hip hop', 'covers/mrmorale&thebigsteppers.jpg'),
(11, 'Trans Europa Express', 'Kraftwerk', '1977-03-01', 'electronic,progressive-electronic', 'covers/transeuropaexpress.jpg'),
(12, 'Bonito Generation', 'Kero Kero Bonito', '2016-10-21', 'electropop', 'covers/bonitogeneration.jpg'),
(13, 'Renaissance', 'Beyonce', '2022-07-29', 'dance-pop,house,contemporaryr&b', 'covers/renaissance.jpg'),
(14, 'Revolver', 'The Beatles', '1966-08-05', 'pop rock,psychedelic rock', 'covers/revolver.jpg'),
(15, 'Hit Me Hard and Soft', 'Billie Eilish', '2024-05-17', 'alt-pop', 'covers/hitmehardandsoft.jpg'),
(16, 'The Velvet Underground & Nico', 'The Velvet Underground & Nico', '1967-03-12', 'art rock,experimental rock', 'covers/thevelvetunderground&nico.jpg'),
(17, 'Parachutes', 'Coldplay', '2000-11-07', 'post-britpop,pop rock', 'covers/parachutes.jpg');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `favourite_album`
--

CREATE TABLE `favourite_album` (
  `username` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `lists`
--

CREATE TABLE `lists` (
  `username` varchar(255) NOT NULL,
  `listname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `album_id1` int(11) DEFAULT NULL,
  `album_id2` int(11) DEFAULT NULL,
  `album_id3` int(11) DEFAULT NULL,
  `album_id4` int(11) DEFAULT NULL,
  `album_id5` int(11) DEFAULT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `ratings`
--

CREATE TABLE `ratings` (
  `username` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `review` text DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `displayname` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `favourite_album`
--
ALTER TABLE `favourite_album`
  ADD PRIMARY KEY (`username`,`album_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexuri pentru tabele `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `album_id1` (`album_id1`),
  ADD KEY `album_id2` (`album_id2`),
  ADD KEY `album_id3` (`album_id3`),
  ADD KEY `album_id4` (`album_id4`),
  ADD KEY `album_id5` (`album_id5`),
  ADD KEY `lists_ibfk_1` (`username`);

--
-- Indexuri pentru tabele `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`username`,`album_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pentru tabele `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `favourite_album`
--
ALTER TABLE `favourite_album`
  ADD CONSTRAINT `favourite_album_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `favourite_album_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);

--
-- Constrângeri pentru tabele `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `lists_ibfk_2` FOREIGN KEY (`album_id1`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `lists_ibfk_3` FOREIGN KEY (`album_id2`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `lists_ibfk_4` FOREIGN KEY (`album_id3`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `lists_ibfk_5` FOREIGN KEY (`album_id4`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `lists_ibfk_6` FOREIGN KEY (`album_id5`) REFERENCES `albums` (`id`);

--
-- Constrângeri pentru tabele `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
