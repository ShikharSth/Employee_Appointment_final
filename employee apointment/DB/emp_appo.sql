-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2024 at 03:17 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_appo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL DEFAULT 'Admin',
  `admin_role` varchar(20) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_role`, `admin_pass`) VALUES
(1, 'Super Admin', 'Super Admin', 'supadmin'),
(2, 'Admin1', 'Admin', '1admin1pas');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_phone` varchar(11) NOT NULL,
  `emp_role` varchar(50) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_department` varchar(50) NOT NULL,
  `emp_pass` varchar(50) NOT NULL,
  `emp_presence` int(11) NOT NULL DEFAULT 0,
  `emp_availability` int(11) NOT NULL DEFAULT 0,
  `appointment_time` datetime DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`emp_id`, `emp_name`, `emp_phone`, `emp_role`, `emp_address`, `emp_department`, `emp_pass`, `emp_presence`, `emp_availability`, `appointment_time`, `valid_until`) VALUES
(3, 'Rec1', '1133224411', 'receptionist', 'KTM', 'Reception', 'rec1', 1, 1, '2024-12-19 14:45:58', '2024-12-19 15:00:58'),
(4, 'emp1', '2233441188', 'employee', 'BKT', 'Production', 'emp1', 0, 0, NULL, NULL),
(5, 'emp2', '1188996522', 'employee', 'KTM', 'Sales', 'emp2', 0, 1, NULL, NULL),
(6, 'rec2', '1133772255', 'receptionist', 'BKT', 'Reception', 'rec2', 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
