-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2019 at 03:52 PM
-- Server version: 8.0.17
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdsData`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `parcelID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL,
  `parcelName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiverName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `receiverAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `receiverPhone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `parcelStatus` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `parcelID`, `customerID`, `parcelName`, `receiverName`, `receiverAddress`, `receiverPhone`, `parcelStatus`) VALUES
(1, 'sample', 2, 'Dummy', 'Dummy Test', 'Test 123', '123123', 1),
(2, '20190916080718-2', 2, 'test1', 'r1', 'r r r r', '123123', 1),
(3, '20190916080849-2', 2, 'test1a', 'r2', 'b  b b b b b', '123123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactNo` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `address`, `contactNo`) VALUES
(2, 'testa', 'testb', 'testc', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastKnowPosition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `firstName`, `lastName`, `lastKnowPosition`, `status`) VALUES
(15, 'Driver Test', 'Test', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `parcelID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`parcelID`, `remark`, `customerID`) VALUES
('20190916080718-2', 'Testing ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `parcelID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoiceID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL,
  `costAmount` decimal(10,0) NOT NULL DEFAULT '0',
  `gstAmount` decimal(10,0) NOT NULL DEFAULT '0',
  `deliveryAmount` decimal(10,0) NOT NULL DEFAULT '0',
  `settle` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`parcelID`, `invoiceID`, `customerID`, `costAmount`, `gstAmount`, `deliveryAmount`, `settle`) VALUES
('20190916080718-2', '1122334455', 2, '100', '10', '20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcel_location`
--

CREATE TABLE `parcel_location` (
  `parcelID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parcel_location`
--

INSERT INTO `parcel_location` (`parcelID`, `info`, `location`) VALUES
('20190916080718-2', 'Picked Up', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_status`
--

CREATE TABLE `parcel_status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parcel_status`
--

INSERT INTO `parcel_status` (`id`, `status`) VALUES
(1, 'pending'),
(2, 'picked up'),
(3, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `invoiceID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cardName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cardNum` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cardExp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cardCVV` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`invoiceID`, `cardName`, `cardNum`, `cardExp`, `cardCVV`) VALUES
('1122334455', 'qweqwe', '123123213213', '1111', '111');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `parcelID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customerID` int(11) NOT NULL,
  `driverID` int(11) NOT NULL,
  `pickedDate` timestamp NULL DEFAULT NULL,
  `deliveredDate` timestamp NULL DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`parcelID`, `customerID`, `driverID`, `pickedDate`, `deliveredDate`) VALUES
('20190916080718-2', 2, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_customer` tinyint(1) NOT NULL DEFAULT '1',
  `is_driver` tinyint(1) NOT NULL DEFAULT '0',
  `is_manager` int(11) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_customer`, `is_driver`, `is_manager`, `is_admin`) VALUES
(2, 'test@test.com', '$2y$10$RjjFtMrMIGFsvELT6qZDFuGe6ehAe3/Kxmjnj7rMJichQsG0cBDXG', 1, 0, 0, 0),
(15, 'driver@t.com', '$2y$10$RjjFtMrMIGFsvELT6qZDFuGe6ehAe3/Kxmjnj7rMJichQsG0cBDXG', 0, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD KEY `id` (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_status`
--
ALTER TABLE `parcel_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parcel_status`
--
ALTER TABLE `parcel_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
