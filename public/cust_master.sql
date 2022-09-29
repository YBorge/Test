-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 03:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventary_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cust_master`
--

CREATE TABLE `cust_master` (
  `cust_id` int(11) NOT NULL,
  `cust_code` int(100) DEFAULT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `gender` char(5) DEFAULT NULL,
  `cust_addr1` varchar(255) DEFAULT NULL,
  `cust_addr2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(100) DEFAULT NULL,
  `Mobile` bigint(11) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `pan` varchar(155) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `cust_type` varchar(155) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `points` int(155) DEFAULT NULL,
  `ref_cust_code` int(155) DEFAULT NULL,
  `cr_limit` int(155) DEFAULT NULL,
  `cr_overdue_days` int(155) DEFAULT NULL,
  `status` char(5) NOT NULL DEFAULT 'Y',
  `created_by` varchar(155) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` varchar(155) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_master`
--

INSERT INTO `cust_master` (`cust_id`, `cust_code`, `cust_name`, `gender`, `cust_addr1`, `cust_addr2`, `city`, `state`, `country`, `pincode`, `Mobile`, `email`, `aadhar_no`, `pan`, `gstin`, `birth_date`, `join_date`, `cust_type`, `barcode`, `points`, `ref_cust_code`, `cr_limit`, `cr_overdue_days`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Mayur Gawade', 'M', 'B/12, Ritu World, Barrage Road,', 'Badlapur West', '12', 'LAK', 'IND', 421503, 887932033, 'gawademayu@gmail.com', '661237120827', 'ADRPG8101C', '27ADRPG8101C19Z', '1986-10-28', '2022-07-01', 'R', '887921033401234', 100, 1, 5000, 30, 'Y', 'admin', '2022-09-29 06:50:54', 'admin', '2022-09-28 11:48:58'),
(2, 2, 'Yogeeraj', 'M', 'mum', 'mum', '12', 'LAK', 'IND', 400028, 9921509424, 'yogeerajborge@gmail.com', '12546973', 'cegpb9577H', 'dfrgt5285', '2022-08-22', '2022-09-29', 'R', '12456', NULL, 1, 1, 1, 'Y', 'yogeerajborge@gmail.com', '2022-09-29 01:19:58', NULL, '2022-09-29 01:19:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cust_master`
--
ALTER TABLE `cust_master`
  ADD PRIMARY KEY (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cust_master`
--
ALTER TABLE `cust_master`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
