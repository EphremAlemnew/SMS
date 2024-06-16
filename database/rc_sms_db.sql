-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 08:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rc_sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `issuedate` text DEFAULT NULL,
  `purdate` text DEFAULT NULL,
  `expdate` text DEFAULT NULL,
  `amount` text NOT NULL,
  `appByManager` tinyint(1) NOT NULL,
  `appByStore` tinyint(1) NOT NULL,
  `Purchased` tinyint(1) NOT NULL,
  `purchaser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `code`, `name`, `description`, `issuedate`, `purdate`, `expdate`, `amount`, `appByManager`, `appByStore`, `Purchased`, `purchaser`) VALUES
(10, 'I-23', 'latop', 'kjsaj', '2024-06-12 19:23:24', '', '', '23', 1, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `purdate` text NOT NULL,
  `expdate` text NOT NULL,
  `reqDate` datetime NOT NULL,
  `amount` text NOT NULL,
  `appByManager` tinyint(1) NOT NULL,
  `appByStore` tinyint(1) NOT NULL,
  `requestedBy` int(11) DEFAULT NULL,
  `appByReq` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `reqDate`, `amount`, `appByManager`, `appByStore`, `requestedBy`, `appByReq`) VALUES
(9, 'I-020', 'Book', 'jk', '23/12/2023', '23/12/2026', '2024-06-12 19:14:44', '10', 1, 1, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `purdate` text NOT NULL,
  `expdate` text NOT NULL,
  `amount` text NOT NULL,
  `reason` text NOT NULL,
  `purby` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `amount`, `reason`, `purby`) VALUES
(3, 'I-09', 'lkds', 'skdjkcn', '23/03/2023', '23/02/2028', '23', 'ljwkejekdl', 'lkwje wjeklj'),
(5, 'I-23', 'Computers', 'kjsaj', '23/12/2023', '23/12/2028', '20', 'what i don\'t now', 'zjhsk');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `purdate` text NOT NULL,
  `expdate` text NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `amount`) VALUES
(11, 'I-020', 'Book', 'jk', '23/12/2023', '23/12/2026', '120'),
(12, 'I-23', 'latop', 'neww', '', '', '23'),
(13, 'I-23', 'latop', 'kjsaj', '2024-06-12 19:03:57', '2025-03-23', '23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `usertype` text NOT NULL,
  `changed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `usertype`, `changed`) VALUES
(4, 'Abel', 'Debebe', 'Abela', 'f1d38fb74d0950372dc2072149e3f6e1', 'Admin', 1),
(6, 'Meselechh', 'Berhanu', 'Meri', 'f8cc95d827bef583b46f2a787acf0b59', 'Storekeeper', 1),
(9, 'Ephrem', 'Alemnew', 'Ephy', 'e346a5376e7771a6c2b8910229a2fd1e', 'Manager', 1),
(10, 'Yonas', 'Teshome', 'yoni', 'dac2b895033499bc3643c1efbd0fc310', 'Purchaser', 1),
(11, 'Nahom', 'Girma', 'Nahom', '851ae232e07601c463fdbbbd2552efda', 'Staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchaser` (`purchaser`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_request` (`requestedBy`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD CONSTRAINT `purchaser` FOREIGN KEY (`purchaser`) REFERENCES `user` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_request` FOREIGN KEY (`requestedBy`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
