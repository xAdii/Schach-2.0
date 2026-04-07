-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Apr 2026 um 13:32
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `schach_20`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boards`
--

CREATE TABLE `boards` (
  `ID` int(11) NOT NULL,
  `playerWhiteID` int(11) NOT NULL,
  `playerBlackID` int(11) NOT NULL,
  `state` varchar(30) NOT NULL DEFAULT 'alive',
  `turn` varchar(30) NOT NULL DEFAULT 'white',
  `shopID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `position_y` int(1) NOT NULL,
  `position_x` int(1) NOT NULL,
  `beschreibung` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pieces`
--

CREATE TABLE `pieces` (
  `ID` int(11) NOT NULL,
  `boardID` int(11) NOT NULL,
  `type` varchar(8) NOT NULL,
  `color` varchar(8) NOT NULL,
  `position_y` int(1) NOT NULL,
  `position_x` int(1) NOT NULL,
  `has_moved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shop`
--

CREATE TABLE `shop` (
  `ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopinventory`
--

CREATE TABLE `shopinventory` (
  `ID` int(8) NOT NULL,
  `shopID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `name`, `password`) VALUES
(6, 'test', '$2y$10$gR89HaqSqDs0RaW/TYieduMX5un/AwHwbwfNddhZytBNkAIwmDWHK'),
(7, 'root', '$2y$10$GT8SMNt4hFO5lbmjIFUqHeV89DozZZcU8Ppq3pHZ28gbMqdIAbR16');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `playerWhiteID` (`playerWhiteID`),
  ADD KEY `playerBlackID` (`playerBlackID`),
  ADD KEY `shopID` (`shopID`);

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `boardID` (`boardID`);

--
-- Indizes für die Tabelle `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `shopinventory`
--
ALTER TABLE `shopinventory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `shopID` (`shopID`), 
  ADD KEY `itemID` (`itemID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `boards`
--
ALTER TABLE `boards`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pieces`
--
ALTER TABLE `pieces`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT für Tabelle `shop`
--
ALTER TABLE `shop`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `shopinventory`
--
ALTER TABLE `shopinventory`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `playerBlackID` FOREIGN KEY (`playerBlackID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playerWhiteID` FOREIGN KEY (`playerWhiteID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopID` FOREIGN KEY (`shopID`) REFERENCES `shop` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pieces`
--
ALTER TABLE `pieces`
  ADD CONSTRAINT `boardID` FOREIGN KEY (`boardID`) REFERENCES `boards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- das hier wurde selbst eingefügt, da ich es in SQL nicht fand

ALTER TABLE `shopinventory`
  ADD CONSTRAINT `shopID` FOREIGN KEY (`shopID`) REFERENCES `shop` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemID` FOREIGN KEY (`itemID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
