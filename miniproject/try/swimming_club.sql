-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 03:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swimming_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coach_name` text NOT NULL,
  `coach_phonenumber` text NOT NULL,
  `coach_address` text NOT NULL,
  `coach_email` text NOT NULL,
  `coach_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coach_name`, `coach_phonenumber`, `coach_address`, `coach_email`, `coach_id`) VALUES
('1', 'sf', 'sf', 'sf', 1),
('fg', '343434', 'df', 'sf', 2),
('fg', '75675', 't7', 'r67', 3),
('tert', '3434343', 'rt', 'rt', 4),
('sgfdgfdg', '343434', 'rf', 'rt', 5),
('uyuyu', '676767', 'fgu', '68fh', 6);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` text NOT NULL,
  `member_phonenumber` text NOT NULL,
  `member_address` text NOT NULL,
  `member_gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_phonenumber`, `member_address`, `member_gender`) VALUES
(1, 'rt', 'rrt', 'rt', 'r'),
(2, 'fwf', '6888', 'f', 'Male'),
(3, 'rsrgsd', '4343', 'wet', 'Femal');

-- --------------------------------------------------------

--
-- Table structure for table `swimmingschedule`
--

CREATE TABLE `swimmingschedule` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `total_hours` int(11) NOT NULL,
  `IsPaid` int(11) DEFAULT NULL,
  `Piad_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `swimmingschedule`
--

INSERT INTO `swimmingschedule` (`id`, `member_id`, `coach_id`, `start_date`, `end_date`, `total_hours`, `IsPaid`, `Piad_Date`) VALUES
(6, 1, 0, '2020-01-01 01:00:00', '2020-01-01 01:30:00', 30, 1, '2020-02-15 20:18:49'),
(7, 1, 2, '2020-01-01 01:00:00', '2020-01-02 02:30:00', 1530, 1, '2020-02-15 20:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', '2020-02-10 21:46:09'),
(2, 'sabith', 'nipuni', '2020-03-04 02:23:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_id`) USING BTREE;

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `swimmingschedule`
--
ALTER TABLE `swimmingschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `swimmingschedule`
--
ALTER TABLE `swimmingschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
