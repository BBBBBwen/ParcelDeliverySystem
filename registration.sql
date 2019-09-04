-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2019 at 01:17 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--
CREATE DATABASE IF NOT EXISTS `registration` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `registration`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
-- Creation: Sep 04, 2019 at 03:14 AM
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'abc@123.com', '123', 'ab', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--
-- Creation: Sep 04, 2019 at 07:35 AM
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `id` int(10) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total` int(255) NOT NULL DEFAULT '0',
  `paid` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `email`, `password`, `firstName`, `lastName`, `total`, `paid`) VALUES
(1, 'driver1@abc.com', '123', 'driver', 'A', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parceldetail`
--
-- Creation: Sep 04, 2019 at 06:07 AM
--

DROP TABLE IF EXISTS `parceldetail`;
CREATE TABLE `parceldetail` (
  `id` int(10) NOT NULL,
  `parcelName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senderAddress` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recieverName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recieverAddress` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recieverPhoneNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pickUpDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `endDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parceldetail`
--

INSERT INTO `parceldetail` (`id`, `parcelName`, `senderAddress`, `recieverName`, `recieverAddress`, `recieverPhoneNumber`, `pickUpDate`, `endDate`, `status`) VALUES
(1, 'a', 'a', 'a', 'a', '123', NULL, NULL, 'processing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parceldetail`
--
ALTER TABLE `parceldetail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parceldetail`
--
ALTER TABLE `parceldetail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
