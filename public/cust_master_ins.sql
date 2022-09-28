-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 01:55 PM
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
-- Database: `inventory_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cust_master`
--

CREATE TABLE `cust_master` (
  `cust_id` int(11) NOT NULL,
  `cust_code` int(100) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `gender` char(5),
  `cust_addr1` varchar(255) NOT NULL,
  `cust_addr2` varchar(255),
  `city` varchar(255) NOT NULL,
  `state` varchar(255),
  `country` varchar(255),
  `pincode` int(100),
  `Mobile` int(255),
  `email` varchar(155),
  `aadhar_no` varchar(255),
  `pan` varchar(155),
  `gstin` varchar(255),
  `birth_date` date,
  `join_date` date,
  `cust_type` varchar(155) NOT NULL,
  `barcode` varchar(255),
  `points` int(155),
  `ref_cust_code` int(155),
  `cr_limit` int(155),
  `cr_overdue_days` int(155),
  `status` char(5) NOT NULL DEFAULT 'Y',
  `created_by` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(155) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_master`
--

INSERT INTO `cust_master` (`cust_id`, `cust_code`, `cust_name`, `gender`, `cust_addr1`, `cust_addr2`, `city`, `state`, `country`, `pincode`, `Mobile`, `email`, `aadhar_no`, `pan`, `gstin`, `birth_date`, `join_date`, `cust_type`, `barcode`, `points`, `ref_cust_code`, `cr_limit`, `cr_overdue_days`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Mayur Gawade', 'M', 'B/12, Ritu World, Barrage Road,', 'Badlapur West', 'Thane', 'MAH', 'IND', 421503, 887932033, 'gawademayu@gmail.com', '661237120827', 'ADRPG8101C', '27ADRPG8101C19Z', '1986-10-28', '2022-07-01', 'Regular', '887921033401234', 100, 1, 5000, 30, 'Y', 'admin', '2022-09-28 11:51:20', 'admin', '2022-09-28 11:48:58');

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
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
