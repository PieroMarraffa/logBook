-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 13, 2021 alle 19:17
-- Versione del server: 10.4.18-MariaDB
-- Versione PHP: 8.0.3

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
  `Password` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`IDadmin`, `Email`, `Password`, `Username`) VALUES
(1, 'mistersuperduperadmin@gmail.com', 'Sonoinvincibile!0499', 'GerryScotti');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `IDcomment` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL,
  `IDpost` int(10) NOT NULL,
  `Deleted` tinyint(1) NOT NULL,
  `Content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`IDcomment`, `IDuser`, `IDpost`, `Deleted`, `Content`) VALUES
(1, 1, 1, 0, 'Che bel poooost'),
(2, 2, 2, 0, 'Che bel poooost'),
(3, 3, 2, 0, 'Sei Brutto'),
(4, 3, 1, 1, 'Fai skf'),
(5, 5, 8, 0, 'Tanto lo so cosa avete fatto... :)'),
(6, 1, 5, 0, 'Sarà meraviglioso');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment_reported_by_user`
--

CREATE TABLE `comment_reported_by_user` (
  `IDcomment` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comment_reported_by_user`
--

INSERT INTO `comment_reported_by_user` (`IDcomment`, `IDuser`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `experience`
--

CREATE TABLE `experience` (
  `IDexperience` int(10) NOT NULL,
  `IDtravel` int(10) DEFAULT NULL,
  `IDplace` int(10) NOT NULL,
  `StartDay` date NOT NULL,
  `EndDay` date NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `experience`
--

INSERT INTO `experience` (`IDexperience`, `IDtravel`, `IDplace`, `StartDay`, `EndDay`, `Title`, `Description`) VALUES
(1, 1, 4, '2021-09-01', '2021-09-01', 'Visita al Colosseo', 'Era rotto'),
(2, 1, 5, '2021-09-01', '2021-09-02', 'Notte al Central Hotel', 'Era Bello'),
(3, 1, 5, '2021-09-02', '2021-09-02', 'Pranzo sul Lungotevere', 'Era Buono'),
(4, 2, 6, '2016-07-27', '2016-08-08', 'Viaggio Studio in collage', 'Era Divertente'),
(5, 2, 6, '2016-08-01', '2016-08-01', 'Visita a Dublino', 'Era Bella'),
(6, 3, 8, '2021-09-09', '2021-09-10', 'Visita alla Sagrada Famiglia', 'Era Incompiuta'),
(7, 4, 9, '2021-09-17', '2021-09-17', 'Sagra Del Cioccolato', 'Era Buono'),
(8, 5, 11, '2021-09-17', '2021-09-23', 'Road Trip Pugliese', 'Bella compagnia'),
(9, 5, 12, '2021-09-24', '2021-09-24', 'Tappa a Napoli', 'Era Molto Buona'),
(10, 6, 7, '2019-12-27', '2019-12-27', 'Ritiro Macchinetta', 'Era Costosa'),
(11, 7, 1, '2019-09-13', '2019-09-13', 'Volo Ryanair', 'Era Pauroso'),
(12, 7, 1, '2019-09-15', '2019-09-15', 'Visita al Louvre', 'Era Meraviglioso'),
(13, 8, 10, '2021-08-03', '2021-09-04', 'Notte con KJ', 'Era Movimentata');

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `IDimage` int(10) NOT NULL,
  `IDtravel` int(10) NOT NULL,
  `ImageFile` blob NOT NULL,
  `Width` int(10) NOT NULL,
  `Height` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `place`
--

CREATE TABLE `place` (
  `IDplace` int(10) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `place`
--

INSERT INTO `place` (`IDplace`, `Latitude`, `Longitude`, `Category`, `Name`) VALUES
(1, 0, 0, 'città', 'Parigi'),
(2, 42, 13, 'città', 'L\'Aquila'),
(3, 1, 53, 'città', 'Londra'),
(4, 31, 41, 'meta turistica', 'Colosseo'),
(5, 55, 121, 'città', 'Roma'),
(6, 502, 1049, 'nazione', 'Irlanda'),
(7, 521, 41, 'meta turistica', 'grotte di Frasassi'),
(8, 52, 531, 'città', 'Barcellona'),
(9, 124, 213, 'città', 'Perugia'),
(10, 632, 365, 'città', 'Giulianova'),
(11, 243, 54, 'regione', 'Puglia'),
(12, 54, 421, 'città', 'Napoli');

-- --------------------------------------------------------

--
-- Struttura della tabella `place_to_post`
--

CREATE TABLE `place_to_post` (
  `IDplace` int(10) NOT NULL,
  `IDpost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `place_to_post`
--

INSERT INTO `place_to_post` (`IDplace`, `IDpost`) VALUES
(4, 1),
(5, 1),
(6, 2),
(8, 3),
(9, 4),
(11, 5),
(12, 5),
(7, 6),
(1, 7),
(10, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `place_to_user`
--

CREATE TABLE `place_to_user` (
  `IDplace` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `place_to_user`
--

INSERT INTO `place_to_user` (`IDplace`, `IDuser`) VALUES
(6, 1),
(4, 2),
(5, 2),
(11, 3),
(12, 3),
(1, 4),
(7, 4),
(10, 4),
(9, 5),
(8, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `IDpost` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  `Deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`IDpost`, `IDuser`, `Title`, `Date`, `Deleted`) VALUES
(1, 2, 'viaggio a roma', '2021-09-12 01:30:16', 0),
(2, 1, 'viaggio in Irlanda', '2021-09-12 01:33:15', 0),
(3, 5, 'viaggio a Barcellona', '2021-09-12 01:33:44', 0),
(4, 5, 'viaggio a Perugia', '2021-09-12 01:34:35', 1),
(5, 3, 'road trip in Puglia', '2021-09-12 01:34:58', 0),
(6, 4, 'dritti a frasassi', '2021-09-12 01:35:34', 0),
(7, 4, 'viaggio a Parigi', '2021-09-12 01:36:25', 0),
(8, 4, 'notte a Giulianova', '2021-09-12 01:36:51', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `post_reported_by_user`
--

CREATE TABLE `post_reported_by_user` (
  `IDpost` int(10) NOT NULL,
  `IDuser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `post_reported_by_user`
--

INSERT INTO `post_reported_by_user` (`IDpost`, `IDuser`) VALUES
(4, 2),
(8, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `reaction`
--

CREATE TABLE `reaction` (
  `IDreaction` int(10) NOT NULL,
  `IDpost` int(11) NOT NULL,
  `IDprofile` int(11) NOT NULL,
  `Reaction` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `reaction`
--

INSERT INTO `reaction` (`IDreaction`, `IDpost`, `IDprofile`, `Reaction`) VALUES
(1, 1, 5, '1'),
(2, 1, 1, '-1');

-- --------------------------------------------------------

--
-- Struttura della tabella `travel`
--

CREATE TABLE `travel` (
  `IDtravel` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `IDpost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `travel`
--

INSERT INTO `travel` (`IDtravel`, `Title`, `IDpost`) VALUES
(1, 'viaggio a roma', 1),
(2, 'viaggio in Irlanda', 2),
(3, 'viaggio in Spagna', 3),
(4, 'viaggio a Perugia', 4),
(5, 'road trip in Puglia ', 5),
(6, 'dritti a frasassi', 6),
(7, 'viaggio a Parigi', 7),
(8, 'notte a giulianova', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `IDuser` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Image` varchar(500) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`IDuser`, `Email`, `Password`, `Name`, `Description`, `Image`, `UserName`, `Banned`) VALUES
(1, 'pieromarraffa@gmail.com', 'Pippo', 'Piero', 'Davvero una bella persona', 'immagine/bella/ciao/ciao', 'marphino99', 0),
(2, 'gabrielegiusti@gmail.com', 'Gabriele', 'Gabriele', 'Davvero una persona cattiva', 'immagine/brutta/brutta/miao', 'SuperG', 0),
(3, 'silviamastracci@gmail.com', 'Silvia', 'Silvia', 'Davvero una persona bellina bellina', 'immagine/bellinaa/bellina/miao', 'Sissipessa', 0),
(4, 'federicoraschiatore@gmail.com', 'Federico', 'Federico', 'Davvero una persona che lascia indietro gli amici... kattiv', 'immagine/brutt/e/kattiv', 'MaurizioCostanzo00', 0),
(5, 'giuliacancello@gmail.com', 'Giulia', 'Giulia', 'davvero una persona che non sa fare una carbonara all\'altezza', 'immagine/cicca/guanciale/tressette', 'Zuly99', 0);

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
  ADD KEY `experience_ibfk_2` (`IDtravel`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`IDimage`),
  ADD KEY `image_ibfk_1` (`IDtravel`);

--
-- Indici per le tabelle `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`IDplace`);

--
-- Indici per le tabelle `place_to_post`
--
ALTER TABLE `place_to_post`
  ADD KEY `place_to_post_ibfk_1` (`IDplace`),
  ADD KEY `place_to_post_ibfk_2` (`IDpost`);

--
-- Indici per le tabelle `place_to_user`
--
ALTER TABLE `place_to_user`
  ADD KEY `place_to_profile_ibfk_1` (`IDuser`),
  ADD KEY `place_to_user_ibfk_2` (`IDplace`);

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
  ADD KEY `like_ibfk_2` (`IDprofile`);

--
-- Indici per le tabelle `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`IDtravel`),
  ADD KEY `IDPost` (`IDpost`);

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
  MODIFY `IDcomment` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `experience`
--
ALTER TABLE `experience`
  MODIFY `IDexperience` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `image`
--
ALTER TABLE `image`
  MODIFY `IDimage` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `place`
--
ALTER TABLE `place`
  MODIFY `IDplace` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `IDpost` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `reaction`
--
ALTER TABLE `reaction`
  MODIFY `IDreaction` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `travel`
--
ALTER TABLE `travel`
  MODIFY `IDtravel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `IDuser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Limiti per la tabella `comment_reported_by_user`
--
ALTER TABLE `comment_reported_by_user`
  ADD CONSTRAINT `comment_reported_by_user_ibfk_1` FOREIGN KEY (`IDcomment`) REFERENCES `comment` (`IDcomment`),
  ADD CONSTRAINT `comment_reported_by_user_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_2` FOREIGN KEY (`IDtravel`) REFERENCES `travel` (`IDtravel`);

--
-- Limiti per la tabella `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`IDtravel`) REFERENCES `travel` (`IDtravel`);

--
-- Limiti per la tabella `place_to_post`
--
ALTER TABLE `place_to_post`
  ADD CONSTRAINT `place_to_post_ibfk_1` FOREIGN KEY (`IDplace`) REFERENCES `place` (`IDplace`),
  ADD CONSTRAINT `place_to_post_ibfk_2` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`);

--
-- Limiti per la tabella `place_to_user`
--
ALTER TABLE `place_to_user`
  ADD CONSTRAINT `place_to_user_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`),
  ADD CONSTRAINT `place_to_user_ibfk_2` FOREIGN KEY (`IDplace`) REFERENCES `place` (`IDplace`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `post_reported_by_user`
--
ALTER TABLE `post_reported_by_user`
  ADD CONSTRAINT `post_reported_by_user_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`),
  ADD CONSTRAINT `post_reported_by_user_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `reaction_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`),
  ADD CONSTRAINT `reaction_ibfk_2` FOREIGN KEY (`IDprofile`) REFERENCES `user` (`IDuser`);

--
-- Limiti per la tabella `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `travel_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `post` (`IDpost`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
