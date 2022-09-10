-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 06:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coachId` int(11) NOT NULL,
  `coachname` varchar(20) DEFAULT NULL,
  `coachrating` double DEFAULT NULL,
  `coachcountry` int(11) DEFAULT NULL,
  `coachcost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coachId`, `coachname`, `coachrating`, `coachcountry`, `coachcost`) VALUES
(1, 'coach1', 100, 1, 10000),
(2, 'coach2', 50, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryId` int(11) NOT NULL,
  `countryname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryname`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `cputeams`
--

CREATE TABLE `cputeams` (
  `teamId` int(11) NOT NULL,
  `teamname` varchar(20) DEFAULT NULL,
  `teamdifficulty` int(11) DEFAULT NULL,
  `shooter1` int(11) DEFAULT NULL,
  `shooter2` int(11) DEFAULT NULL,
  `shooter3` int(11) DEFAULT NULL,
  `goalie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cputeams`
--

INSERT INTO `cputeams` (`teamId`, `teamname`, `teamdifficulty`, `shooter1`, `shooter2`, `shooter3`, `goalie`) VALUES
(1, 'Team1', 1, 3, 6, 12, 4),
(2, 'Team2', 2, 1, 3, 12, 4),
(3, 'Team3', 3, 1, 2, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `goalie`
--

CREATE TABLE `goalie` (
  `playerId` int(11) NOT NULL,
  `playername` varchar(20) DEFAULT NULL,
  `playerrating` double DEFAULT NULL,
  `playerscore` double DEFAULT NULL,
  `playercost` double DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `GamePlayed` date DEFAULT NULL,
  `result` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerId` int(11) NOT NULL,
  `playername` varchar(20) DEFAULT NULL,
  `playerrating` double DEFAULT NULL,
  `playerscore` double DEFAULT NULL,
  `playercountry` int(11) DEFAULT NULL,
  `playercost` double DEFAULT NULL,
  `playertype` int(11) DEFAULT NULL,
  `playerimage` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerId`, `playername`, `playerrating`, `playerscore`, `playercountry`, `playercost`, `playertype`, `playerimage`) VALUES
(1, 'Messi', 10, 100, 1, 10000, 1, 'messi.jpg'),
(2, 'Ronaldo', 10, 100, 1, 10000, 1, 'ronaldo.jpg'),
(3, 'Sunil Chetri', 8, 86, 1, 5000, 1, 'Sunil.jpg'),
(4, 'De Gea', 10, 100, 1, 10000, 2, 'degea.jpg'),
(5, 'Suarez', 9, 89, 1, 9000, 1, 'suarez.jpg'),
(6, 'Mbappe', 8.7, 86, 1, 8000, 1, 'mbappe.jpg'),
(12, 'prashant', 6, 1, 1, 100, 1, 'johndoe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `scorecard`
--

CREATE TABLE `scorecard` (
  `cardId` int(11) NOT NULL,
  `matchId` int(11) DEFAULT NULL,
  `userGoals` int(11) DEFAULT NULL,
  `CPUGoals` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shooter`
--

CREATE TABLE `shooter` (
  `playerId` int(11) NOT NULL,
  `playername` varchar(20) DEFAULT NULL,
  `playerrating` double DEFAULT NULL,
  `playerscore` double DEFAULT NULL,
  `playercost` double DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shooter`
--

INSERT INTO `shooter` (`playerId`, `playername`, `playerrating`, `playerscore`, `playercost`, `countryId`) VALUES
(1, 'Messi', 10, 100, 10000, 1),
(3, 'Ronaldo', 10, 100, 10000, 1),
(5, 'p', 5, 50, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `typeId` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeId`, `type`) VALUES
(1, 'shooter'),
(2, 'goalie'),
(3, 'coach');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `wallet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `wallet`) VALUES
(1, 'prashant', '1', 64000),
(2, 'prashanth', '2', 1000),
(6, 'om', 'om', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `userplayers`
--

CREATE TABLE `userplayers` (
  `userId` int(11) DEFAULT NULL,
  `playerId` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userplayers`
--

INSERT INTO `userplayers` (`userId`, `playerId`, `type`) VALUES
(1, 1, '1'),
(1, 3, '1'),
(1, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `userteams`
--

CREATE TABLE `userteams` (
  `userId` int(11) NOT NULL,
  `teamname` varchar(20) DEFAULT NULL,
  `shooter1` int(11) DEFAULT NULL,
  `shooter2` int(11) DEFAULT NULL,
  `shooter3` int(11) DEFAULT NULL,
  `goalie` int(11) DEFAULT NULL,
  `coach` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userteams`
--

INSERT INTO `userteams` (`userId`, `teamname`, `shooter1`, `shooter2`, `shooter3`, `goalie`, `coach`) VALUES
(1, 'Prashant', 1, 2, 3, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coachId`),
  ADD KEY `coachcountry` (`coachcountry`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `cputeams`
--
ALTER TABLE `cputeams`
  ADD PRIMARY KEY (`teamId`),
  ADD KEY `shooter1` (`shooter1`),
  ADD KEY `shooter2` (`shooter2`),
  ADD KEY `shooter3` (`shooter3`),
  ADD KEY `goalie` (`goalie`);

--
-- Indexes for table `goalie`
--
ALTER TABLE `goalie`
  ADD PRIMARY KEY (`playerId`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `teamId` (`teamId`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`playerId`),
  ADD KEY `playercountry` (`playercountry`),
  ADD KEY `playertype` (`playertype`);

--
-- Indexes for table `scorecard`
--
ALTER TABLE `scorecard`
  ADD PRIMARY KEY (`cardId`),
  ADD KEY `matchId` (`matchId`);

--
-- Indexes for table `shooter`
--
ALTER TABLE `shooter`
  ADD PRIMARY KEY (`playerId`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `userplayers`
--
ALTER TABLE `userplayers`
  ADD KEY `userId` (`userId`),
  ADD KEY `playerId` (`playerId`);

--
-- Indexes for table `userteams`
--
ALTER TABLE `userteams`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `shooter1` (`shooter1`),
  ADD KEY `shooter2` (`shooter2`),
  ADD KEY `shooter3` (`shooter3`),
  ADD KEY `goalie` (`goalie`),
  ADD KEY `coach` (`coach`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coachId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cputeams`
--
ALTER TABLE `cputeams`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goalie`
--
ALTER TABLE `goalie`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scorecard`
--
ALTER TABLE `scorecard`
  MODIFY `cardId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shooter`
--
ALTER TABLE `shooter`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `typeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach`
--
ALTER TABLE `coach`
  ADD CONSTRAINT `coach_ibfk_1` FOREIGN KEY (`coachcountry`) REFERENCES `country` (`countryId`);

--
-- Constraints for table `cputeams`
--
ALTER TABLE `cputeams`
  ADD CONSTRAINT `cputeams_ibfk_1` FOREIGN KEY (`shooter1`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `cputeams_ibfk_2` FOREIGN KEY (`shooter2`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `cputeams_ibfk_3` FOREIGN KEY (`shooter3`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `cputeams_ibfk_4` FOREIGN KEY (`goalie`) REFERENCES `player` (`playerId`);

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`teamId`) REFERENCES `cputeams` (`teamId`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`playercountry`) REFERENCES `country` (`countryId`),
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`playertype`) REFERENCES `type` (`typeId`);

--
-- Constraints for table `scorecard`
--
ALTER TABLE `scorecard`
  ADD CONSTRAINT `scorecard_ibfk_1` FOREIGN KEY (`matchId`) REFERENCES `matches` (`matchId`);

--
-- Constraints for table `userplayers`
--
ALTER TABLE `userplayers`
  ADD CONSTRAINT `userplayers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `userplayers_ibfk_2` FOREIGN KEY (`playerId`) REFERENCES `player` (`playerId`);

--
-- Constraints for table `userteams`
--
ALTER TABLE `userteams`
  ADD CONSTRAINT `userteams_ibfk_1` FOREIGN KEY (`shooter1`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `userteams_ibfk_2` FOREIGN KEY (`shooter2`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `userteams_ibfk_3` FOREIGN KEY (`shooter3`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `userteams_ibfk_4` FOREIGN KEY (`goalie`) REFERENCES `player` (`playerId`),
  ADD CONSTRAINT `userteams_ibfk_5` FOREIGN KEY (`coach`) REFERENCES `coach` (`coachId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
