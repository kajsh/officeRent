-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 04:18 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officerental`
--

-- --------------------------------------------------------

--
-- Table structure for table `renteekyc`
--

CREATE TABLE `renteekyc` (
  `id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `ProofType` varchar(50) NOT NULL,
  `IdNo` int(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Dob` date NOT NULL,
  `Contact` int(20) NOT NULL,
  `UploadFile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `renteekyc`
--

INSERT INTO `renteekyc` (`id`, `UserId`, `FName`, `LName`, `ProofType`, `IdNo`, `Address`, `Dob`, `Contact`, `UploadFile`) VALUES
(6, NULL, 'kajol', 'shamdasani', 'PAN', 123, '153 sobha ivory', '2020-01-31', 2147483647, '5e9b0c0fb71ae7.62765819.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `renteekyc`
--
ALTER TABLE `renteekyc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `renteekyc`
--
ALTER TABLE `renteekyc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `renteekyc`
--
ALTER TABLE `renteekyc`
  ADD CONSTRAINT `renteekyc_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
