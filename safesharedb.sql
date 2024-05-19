-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 05:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safesharedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admid` int(11) NOT NULL,
  `adUname` varchar(200) NOT NULL,
  `adEmail` varchar(200) NOT NULL,
  `adName` varchar(200) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admid`, `adUname`, `adEmail`, `adName`, `password`) VALUES
(2, 'AD01TEST', 'thksandaru@gmail.com', 'TEST ADMIN', '$2y$10$yXOV.pcJ/frlKEZlpzgdHuoYVRzbp20eCFSsA8Jzh1hlO6up//8S.');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `fileID` int(11) NOT NULL,
  `empId` varchar(200) NOT NULL,
  `fName` varchar(200) NOT NULL,
  `spcNotes` varchar(200) NOT NULL,
  `content` longblob NOT NULL,
  `sender` varchar(200) NOT NULL,
  `iVector` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`fileID`, `empId`, `fName`, `spcNotes`, `content`, `sender`, `iVector`) VALUES
(2, 'EMP28176', 'Test 01', 'this is a test', 0x326b636e397a674f2f4b656c725254557a51594b36773d3d, 'EMP28176', '4ee7111aa2ff2751bede2a194f8fadad');

-- --------------------------------------------------------

--
-- Table structure for table `sysuser`
--

CREATE TABLE `sysuser` (
  `userID` int(100) NOT NULL,
  `empId` varchar(200) NOT NULL,
  `empName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `secretKey` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sysuser`
--

INSERT INTO `sysuser` (`userID`, `empId`, `empName`, `email`, `department`, `age`, `secretKey`, `password`) VALUES
(2, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', 'IT', 23, 'd1942ce47facbd362c0a342b26a76443', '$2y$10$YrjLUU6M2C/me.iRmoe.FuP.HsFhwflYIoBZ.Igs3sKWcOOVQoRyG');

-- --------------------------------------------------------

--
-- Table structure for table `userfiles`
--

CREATE TABLE `userfiles` (
  `fileId` int(11) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `content` longblob NOT NULL,
  `spNotes` varchar(100) NOT NULL,
  `iVector` varchar(512) NOT NULL,
  `empid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userfiles`
--

INSERT INTO `userfiles` (`fileId`, `fileName`, `content`, `spNotes`, `iVector`, `empid`) VALUES
(1, 'TESTTEST', 0x57755a4c324644574c3345394c34426d3347507a42773d3d, 'sdasdsadsadsadas', 'a2ff45affdfd3bc8a6b2751a67178389', 'TEST01');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `logID` int(100) NOT NULL,
  `empId` varchar(200) NOT NULL,
  `empName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dateNtime` datetime NOT NULL,
  `activity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`logID`, `empId`, `empName`, `email`, `dateNtime`, `activity`) VALUES
(1, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:25:50', 'New user profile created.'),
(2, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:27:15', 'User logged in to the system.'),
(3, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:38:16', 'File uploaded to the system.'),
(4, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:38:20', 'File downloaded from the system.'),
(5, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:38:47', 'File downloaded from the system.'),
(6, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:39:03', 'Logged out of the system.'),
(7, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:55:34', 'User logged in to the system.'),
(8, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 16:57:44', 'Logged out of the system.'),
(9, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 17:06:03', 'User logged in to the system.'),
(10, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-17 17:09:00', 'Logged out of the system.'),
(11, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 08:42:46', 'User logged in to the system.'),
(12, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 08:43:08', 'File uploaded to the system.'),
(13, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 08:43:14', 'File deleted from the system.'),
(14, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:17:36', 'User changed the password.'),
(15, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:17:40', 'Logged out of the system.'),
(16, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:18:26', 'User logged in to the system.'),
(17, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:23:26', 'Logged out of the system.'),
(18, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:29:09', 'User logged in to the system.'),
(19, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:39:49', 'User changed the password.'),
(20, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:39:58', 'Logged out of the system.'),
(21, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:42:09', 'User logged in to the system.'),
(22, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:56:21', 'Logged out of the system.'),
(23, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:59:02', 'User logged in to the system.'),
(24, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:59:25', 'User changed the password.'),
(25, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:59:27', 'Logged out of the system.'),
(26, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 09:59:55', 'User logged in to the system.'),
(27, 'EMP28176', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 10:10:47', 'Logged out of the system.'),
(28, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 11:13:44', 'New user profile created.'),
(29, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 11:14:25', 'User logged in to the system.'),
(30, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 11:22:38', 'Logged out of the system.'),
(31, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 11:40:11', 'Failed Login Attempt.'),
(32, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:04:09', 'User logged in to the system.'),
(33, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:20:49', 'File Uploaded to the system.'),
(34, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:23:50', 'File Uploaded to the system.'),
(35, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:26:32', 'File deleted from the system.'),
(36, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:28:36', 'File downloaded from the system.'),
(37, 'TEST01', 'Keshala Sandaru', 'thksandaru@gmail.com', '2024-05-19 16:28:46', 'File downloaded from the system.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileID`);

--
-- Indexes for table `sysuser`
--
ALTER TABLE `sysuser`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userfiles`
--
ALTER TABLE `userfiles`
  ADD PRIMARY KEY (`fileId`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`logID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sysuser`
--
ALTER TABLE `sysuser`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userfiles`
--
ALTER TABLE `userfiles`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `logID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
