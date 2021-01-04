-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Jan 2021 um 15:50
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `happyplace`
--
CREATE DATABASE IF NOT EXISTS `happyplace` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `happyplace`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_lernende`
--

DROP TABLE IF EXISTS `tbl_lernende`;
CREATE TABLE `tbl_lernende` (
  `id` int(11) NOT NULL,
  `Vorname` varchar(45) DEFAULT NULL,
  `Nachname` varchar(45) DEFAULT NULL,
  `fk_m` int(11) NOT NULL,
  `fk_o` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_marker`
--

DROP TABLE IF EXISTS `tbl_marker`;
CREATE TABLE `tbl_marker` (
  `id` int(11) NOT NULL,
  `Farbe` varchar(45) DEFAULT NULL,
  `icon` geometry DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_orte`
--

DROP TABLE IF EXISTS `tbl_orte`;
CREATE TABLE `tbl_orte` (
  `id` int(11) NOT NULL,
  `PLZ` varchar(45) DEFAULT NULL,
  `Ortname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_lernende`
--
ALTER TABLE `tbl_lernende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_lernende_tbl_marker_idx` (`fk_m`),
  ADD KEY `fk_tbl_lernende_tbl_orte1_idx` (`fk_o`);

--
-- Indizes für die Tabelle `tbl_marker`
--
ALTER TABLE `tbl_marker`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tbl_orte`
--
ALTER TABLE `tbl_orte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_lernende`
--
ALTER TABLE `tbl_lernende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_marker`
--
ALTER TABLE `tbl_marker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_orte`
--
ALTER TABLE `tbl_orte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_lernende`
--
ALTER TABLE `tbl_lernende`
  ADD CONSTRAINT `fk_tbl_lernende_tbl_marker` FOREIGN KEY (`fk_m`) REFERENCES `tbl_marker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_lernende_tbl_orte1` FOREIGN KEY (`fk_o`) REFERENCES `tbl_orte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
