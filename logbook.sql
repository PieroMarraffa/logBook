-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Nov 27, 2021 alle 13:24
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logbook`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `IDadmin` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`IDadmin`, `Email`, `Password`, `Username`) VALUES
(1, 'admin@gmail.com', '$2y$10$ZoGZ3r9rjzKNjfjieyckDeIjiRfNy.NbW1TOcjlMqZrmXZ8pS09SK', 'GerryScotti');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `IDcomment` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL,
  `IDpost` int(10) NOT NULL,
  `Deleted` tinyint(1) DEFAULT NULL,
  `Content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `comment_reported_by_user`
--

CREATE TABLE `comment_reported_by_user` (
  `IDcomment` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `experience`
--

CREATE TABLE `experience` (
  `IDexperience` int(10) NOT NULL,
  `IDpost` int(10) DEFAULT NULL,
  `IDplace` int(10) NOT NULL,
  `StartDay` date NOT NULL,
  `EndDay` date NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `IDimage` int(10) NOT NULL,
  `IDpost` int(10) DEFAULT NULL COMMENT 'se è null,vuol dire che è un immagine di profilo',
  `ImageFile` mediumblob NOT NULL,
  `Size` int(12) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `place`
--

CREATE TABLE `place` (
  `IDplace` int(10) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `Name` varchar(200) NOT NULL,
  `CountryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `IDpost` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Date` datetime NOT NULL,
  `Deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `post_reported_by_user`
--

CREATE TABLE `post_reported_by_user` (
  `IDpost` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `reaction`
--

CREATE TABLE `reaction` (
  `IDreaction` int(10) NOT NULL,
  `IDpost` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL,
  `Reaction` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `IDuser` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Image` int(10) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Reported` tinyint(1) NOT NULL DEFAULT 0,
  `Banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDadmin`);

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`IDcomment`),
  ADD KEY `IDPost` (`IDpost`),
  ADD KEY `IDUser` (`IDuser`);

--
-- Indici per le tabelle `comment_reported_by_user`
--
ALTER TABLE `comment_reported_by_user`
  ADD KEY `IDComment` (`IDcomment`),
  ADD KEY `IDUser` (`IDuser`);

--
-- Indici per le tabelle `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`IDexperience`),
  ADD KEY `experience_ibfk_2` (`IDpost`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`IDimage`),
  ADD KEY `image_ibfk_1` (`IDpost`);

--
-- Indici per le tabelle `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`IDplace`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`IDpost`),
  ADD KEY `post_ibfk_1` (`IDuser`);

--
-- Indici per le tabelle `post_reported_by_user`
--
ALTER TABLE `post_reported_by_user`
  ADD KEY `IDPost` (`IDpost`),
  ADD KEY `IDUser` (`IDuser`);

--
-- Indici per le tabelle `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`IDreaction`),
  ADD KEY `IDPost` (`IDpost`),
  ADD KEY `like_ibfk_2` (`IDuser`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IDuser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `IDadmin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `comment`
--
ALTER TABLE `comment`
  MODIFY `IDcomment` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `experience`
--
ALTER TABLE `experience`
  MODIFY `IDexperience` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT per la tabella `image`
--
ALTER TABLE `image`
  MODIFY `IDimage` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT per la tabella `place`
--
ALTER TABLE `place`
  MODIFY `IDplace` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `IDpost` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT per la tabella `reaction`
--
ALTER TABLE `reaction`
  MODIFY `IDreaction` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `IDuser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_2` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`);

--
-- Limiti per la tabella `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `reaction_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`),
  ADD CONSTRAINT `reaction_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
