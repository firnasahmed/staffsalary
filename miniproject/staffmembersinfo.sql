-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 08:47 PM
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
-- Database: `staffmembersinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `festival_advance`
--

CREATE TABLE `festival_advance` (
  `fa_id` int(6) NOT NULL,
  `staff_id` int(6) NOT NULL,
  `fa_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `festival_advance`
--

INSERT INTO `festival_advance` (`fa_id`, `staff_id`, `fa_amount`) VALUES
(5, 1112, 50000),
(6, 1111, 20000),
(7, 4114, 35000),
(8, 2589, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `loan_deduction`
--

CREATE TABLE `loan_deduction` (
  `ld_id` int(11) NOT NULL,
  `staff_id` int(6) NOT NULL,
  `loan_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_deduction`
--

INSERT INTO `loan_deduction` (`ld_id`, `staff_id`, `loan_amount`) VALUES
(3, 1111, 20000),
(4, 4114, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `ot_id` int(4) NOT NULL,
  `staff_id` int(6) NOT NULL,
  `amount` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `month` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`ot_id`, `staff_id`, `amount`, `rate`, `month`) VALUES
(12, 1111, 5000, 2, 6),
(15, 1112, 5000, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `paysheet`
--

CREATE TABLE `paysheet` (
  `reference_id` int(6) NOT NULL,
  `staff_id` int(6) NOT NULL,
  `month` int(2) DEFAULT NULL,
  `final_salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staffmembers`
--

CREATE TABLE `staffmembers` (
  `staff_id` int(6) NOT NULL,
  `staff_name` varchar(20) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone_no` int(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `basic_salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staffmembers`
--

INSERT INTO `staffmembers` (`staff_id`, `staff_name`, `gender`, `address`, `email`, `phone_no`, `dob`, `basic_salary`) VALUES
(1111, 'Smith', 'M', '45/a, Nawala, Nugegoda', 'smith252@gmail.com', 751234567, '2002-05-24', 35000),
(1112, 'Kumari', 'F', '32, Heigh avenue, Colombo 04', 'kumakumari@yahoo.com', 724565282, '1989-03-03', 25000),
(2222, 'Aiswarya', 'F', 'Badulla', 'ai1122@hotmail.com', 774848595, '1998-10-14', 35000),
(2586, 'Kulasekara', 'M', 'Kandy', 'Kula@outlook.com', 11236598, '1990-08-07', 38000),
(2589, 'Aadhithya', 'M', '30, Nallur, Jaffna', 'aadhi.yb@gmail.com', 765959854, '1995-12-31', 38000),
(4114, 'Ahamed', 'M', '87, Polgolla, Kandy', 'ahamedinfo@gmail.com', 770011002, '1998-05-13', 32000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `festival_advance`
--
ALTER TABLE `festival_advance`
  ADD PRIMARY KEY (`fa_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `loan_deduction`
--
ALTER TABLE `loan_deduction`
  ADD PRIMARY KEY (`ld_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`ot_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `paysheet`
--
ALTER TABLE `paysheet`
  ADD PRIMARY KEY (`reference_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staffmembers`
--
ALTER TABLE `staffmembers`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `festival_advance`
--
ALTER TABLE `festival_advance`
  MODIFY `fa_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_deduction`
--
ALTER TABLE `loan_deduction`
  MODIFY `ld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `ot_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `paysheet`
--
ALTER TABLE `paysheet`
  MODIFY `reference_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `festival_advance`
--
ALTER TABLE `festival_advance`
  ADD CONSTRAINT `festival_advance_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffmembers` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `loan_deduction`
--
ALTER TABLE `loan_deduction`
  ADD CONSTRAINT `loan_deduction_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffmembers` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `overtime_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffmembers` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paysheet`
--
ALTER TABLE `paysheet`
  ADD CONSTRAINT `paysheet_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffmembers` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
