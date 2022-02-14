-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Erstellungszeit: 04. Sep 2021 um 20:46
-- Server-Version: 5.7.33-log
-- PHP-Version: 7.0.33-0+deb9u11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `patienten`
--

CREATE TABLE `patienten` (
  `vorname` text CHARACTER SET utf8 NOT NULL,
  `nachname` text CHARACTER SET utf8 NOT NULL,
  `geburtsdatum` date NOT NULL,
  `adresse` text CHARACTER SET utf8 NOT NULL,
  `telefon` text CHARACTER SET utf8 NOT NULL,
  `erkrankungen` text CHARACTER SET utf8 NOT NULL,
  `medis` text CHARACTER SET utf8 NOT NULL,
  `medisgenug` text CHARACTER SET utf8 NOT NULL,
  `material` text CHARACTER SET utf8 NOT NULL,
  `TMittel` text CHARACTER SET utf8 NOT NULL,
  `eingang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ort` text CHARACTER SET utf8 NOT NULL,
  `bemerkungen` text CHARACTER SET utf8 NOT NULL,
  `mobility` text CHARACTER SET utf8 NOT NULL,
  `ID` int(11) NOT NULL,
  `ausgang` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anwesend` boolean NOT NULL DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `patienten`
--
ALTER TABLE `patienten`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `patienten`
--
ALTER TABLE `patienten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;