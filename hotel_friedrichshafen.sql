-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2024 um 18:34
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotel_friedrichshafen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kontaktdaten`
--

CREATE TABLE `tbl_kontaktdaten` (
  `user_id` int(11) NOT NULL,
  `user_anrede` varchar(50) CHARACTER SET utf32 NOT NULL,
  `user_vorname` varchar(50) CHARACTER SET utf32 NOT NULL,
  `user_nachname` varchar(50) CHARACTER SET utf32 NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf32 NOT NULL,
  `user_benutzername` varchar(50) CHARACTER SET utf32 NOT NULL,
  `user_passwort` varchar(255) CHARACTER SET utf32 NOT NULL,
  `user_status` varchar(50) NOT NULL DEFAULT 'aktiv'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tbl_kontaktdaten`
--

INSERT INTO `tbl_kontaktdaten` (`user_id`, `user_anrede`, `user_vorname`, `user_nachname`, `user_email`, `user_benutzername`, `user_passwort`, `user_status`) VALUES
(67, 'Herr', 'admin', 'admin', 'johannes1.seidl@gmx.at', 'admin', '$2y$10$J4iImPnQjRAR6lP6/hyePOJbGai0BoA0ITGJxeFS0fiz0DiyebRJy', 'Aktiv'),
(68, 'Frau', 'Petra', 'Martini', 'johannes1.seidl@gmx.at', 'Peter123', '$2y$10$fQs25RlFpx6ZsZlfZzxvWeQNA0KNePwSjnVjSeU9mPvXPci7YETVO', 'Aktiv'),
(69, 'Herr', 'Sonja', 'Seidl', 'seidl.sonja@gmx.at', 'Ende', '$2y$10$Bn7zgeXOdJjqdPAI37PKg.z6dt6LOILhmAkhEa7YHp7Y2oC97YA/G', 'Aktiv'),
(71, 'Frau', 'test', 'test', 'johannes1.seidl@gmx.at', 'AktiverBenutzer', '$2y$10$HX34Df1YUysKGvkmeSKtG.W7x090A53NZyvnihL34oqtlFh6aUCsy', 'Aktiv'),
(72, 'Frau', 'Paula', 'Brot', 'johannes1.seidl@gmx.at', 'Paula1', '$2y$10$m/WfA2j6sMYiLB4wO51VPOZwA3jzx7dtnMa0C5i8Ti9GdbmefLhku', 'Aktiv'),
(73, 'Herr', 'Lukas', 'Rieger', 'johannes1.seidl@gmx.at', 'Lukas789', '$2y$10$qeIxen0MujxyE3Hjzc55W.0I28Y.cTm7PfZcbKHH59fzUYz9uxtOO', 'Aktiv'),
(74, 'Herr', 'Johannes', 'Seidl', 'johannes1.seidl@gmx.at', 'ppp111', '$2y$10$h.tP6ILupCEWg0DeGE4oJuIZMfDpaTFlzCqpweZwfGduMfTbn0PI6', 'Inaktiv'),
(75, 'Frau', 'Johannes', 'Seidl', 'johannes1.seidl@gmx.at', 'Martin123', '$2y$10$Hfiv4kT8e.rQm6Nutqun2eHcMN6NxY3BBgyBdAJkljJRbbJ7Qp.yy', 'Aktiv');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `news_image` varchar(50) NOT NULL,
  `news_text` varchar(1000) NOT NULL,
  `news_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_reservierungen`
--

CREATE TABLE `tbl_reservierungen` (
  `reserv_nummer` int(11) NOT NULL,
  `reserv_zimmer_nummer` int(50) NOT NULL,
  `reserv_parkplatz` varchar(10) NOT NULL,
  `reserv_breakfast` varchar(10) NOT NULL,
  `reserv_haustiere` varchar(10) NOT NULL,
  `reserv_fernseher` varchar(10) NOT NULL,
  `reserv_datumAn` date NOT NULL,
  `reserv_datumAb` date NOT NULL,
  `reserv_zeitpunkt` datetime NOT NULL,
  `reserv_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tbl_reservierungen`
--

INSERT INTO `tbl_reservierungen` (`reserv_nummer`, `reserv_zimmer_nummer`, `reserv_parkplatz`, `reserv_breakfast`, `reserv_haustiere`, `reserv_fernseher`, `reserv_datumAn`, `reserv_datumAb`, `reserv_zeitpunkt`, `reserv_id`) VALUES
(34, 3, 'Ja', 'Ja', 'Ja', 'Ja', '2023-01-01', '2023-02-01', '2023-12-02 01:41:30', 69),
(37, 1, 'Ja', 'Nein', 'Nein', 'Ja', '2023-01-01', '2023-02-01', '2023-12-05 19:46:31', 69);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_zimmer`
--

CREATE TABLE `tbl_zimmer` (
  `zimmer_nummer` int(50) NOT NULL,
  `zimmer_preis` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Daten für Tabelle `tbl_zimmer`
--

INSERT INTO `tbl_zimmer` (`zimmer_nummer`, `zimmer_preis`) VALUES
(1, 200),
(2, 250),
(3, 300),
(4, 400);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_kontaktdaten`
--
ALTER TABLE `tbl_kontaktdaten`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indizes für die Tabelle `tbl_reservierungen`
--
ALTER TABLE `tbl_reservierungen`
  ADD PRIMARY KEY (`reserv_nummer`),
  ADD KEY `reserv_id` (`reserv_id`);

--
-- Indizes für die Tabelle `tbl_zimmer`
--
ALTER TABLE `tbl_zimmer`
  ADD PRIMARY KEY (`zimmer_nummer`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_kontaktdaten`
--
ALTER TABLE `tbl_kontaktdaten`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT für Tabelle `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `tbl_reservierungen`
--
ALTER TABLE `tbl_reservierungen`
  MODIFY `reserv_nummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `tbl_zimmer`
--
ALTER TABLE `tbl_zimmer`
  MODIFY `zimmer_nummer` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_reservierungen`
--
ALTER TABLE `tbl_reservierungen`
  ADD CONSTRAINT `tbl_reservierungen_ibfk_1` FOREIGN KEY (`reserv_id`) REFERENCES `tbl_kontaktdaten` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
