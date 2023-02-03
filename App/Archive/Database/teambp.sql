-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 08:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teambp`
--

-- --------------------------------------------------------

--
-- Table structure for table `mb_accountinfo`
--

CREATE TABLE `mb_accountinfo` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DateCreated` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`DateCreated`)),
  `LastSignedIn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`LastSignedIn`)),
  `TermsAndConditions` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mb_competencyinfo`
--

CREATE TABLE `mb_competencyinfo` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `EducationLevel` varchar(50) NOT NULL,
  `EducationBackground` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`EducationBackground`)),
  `EmploymentHistory` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`EmploymentHistory`)),
  `Skills` varchar(500) DEFAULT NULL,
  `TalentsAndHobbies` varchar(500) DEFAULT NULL,
  `CVUpload` varchar(50) DEFAULT NULL,
  `Projects` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Projects`)),
  `Bio` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mb_contactinfo`
--

CREATE TABLE `mb_contactinfo` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `County` varchar(50) NOT NULL,
  `SubCounty` varchar(50) NOT NULL,
  `Area` varchar(50) NOT NULL,
  `City` varchar(50) DEFAULT NULL,
  `NationalId` int(11) NOT NULL,
  `PhoneNumber` varchar(30) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mb_personalinfo`
--

CREATE TABLE `mb_personalinfo` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `MaritalStatus` varchar(50) NOT NULL,
  `Occupation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Contains members personal information';

-- --------------------------------------------------------

--
-- Table structure for table `mb_securityinfo`
--

CREATE TABLE `mb_securityinfo` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `SecurityQuestions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`SecurityQuestions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mb_accountinfo`
--
ALTER TABLE `mb_accountinfo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `mb_competencyinfo`
--
ALTER TABLE `mb_competencyinfo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`);

--
-- Indexes for table `mb_contactinfo`
--
ALTER TABLE `mb_contactinfo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`),
  ADD UNIQUE KEY `NationalId` (`NationalId`),
  ADD UNIQUE KEY `EmailAddress` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Indexes for table `mb_personalinfo`
--
ALTER TABLE `mb_personalinfo`
  ADD PRIMARY KEY (`Id`,`UserId`),
  ADD UNIQUE KEY `UserId` (`UserId`);

--
-- Indexes for table `mb_securityinfo`
--
ALTER TABLE `mb_securityinfo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mb_accountinfo`
--
ALTER TABLE `mb_accountinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mb_competencyinfo`
--
ALTER TABLE `mb_competencyinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mb_contactinfo`
--
ALTER TABLE `mb_contactinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mb_personalinfo`
--
ALTER TABLE `mb_personalinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mb_securityinfo`
--
ALTER TABLE `mb_securityinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mb_accountinfo`
--
ALTER TABLE `mb_accountinfo`
  ADD CONSTRAINT `mb_accountinfo_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `mb_personalinfo` (`UserId`);

--
-- Constraints for table `mb_competencyinfo`
--
ALTER TABLE `mb_competencyinfo`
  ADD CONSTRAINT `mb_competencyinfo_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `mb_personalinfo` (`UserId`);

--
-- Constraints for table `mb_contactinfo`
--
ALTER TABLE `mb_contactinfo`
  ADD CONSTRAINT `mb_contactinfo_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `mb_personalinfo` (`UserId`);

--
-- Constraints for table `mb_securityinfo`
--
ALTER TABLE `mb_securityinfo`
  ADD CONSTRAINT `mb_securityinfo_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `mb_personalinfo` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
