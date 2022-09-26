-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2022 at 08:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

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
-- Table structure for table `vendor_master`
--

CREATE TABLE `vendor_master` (
  `vend_id` int(11) NOT NULL,
  `vend_code` varchar(100) DEFAULT NULL,
  `vend_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `credit_day` int(100) DEFAULT NULL,
  `aadr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `pin` int(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gstin` varchar(100) DEFAULT NULL,
  `fassi_no` varchar(80) DEFAULT NULL,
  `aadhar_no` int(100) DEFAULT NULL,
  `pan_no` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `t_user` varchar(110) DEFAULT NULL,
  `t_date` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_master`
--

INSERT INTO `vendor_master` (`vend_id`, `vend_code`, `vend_name`, `type`, `credit_day`, `aadr1`, `addr2`, `city`, `state`, `country`, `pin`, `phone`, `email`, `gstin`, `fassi_no`, `aadhar_no`, `pan_no`, `contact_person`, `status`, `created_by`, `created_date`, `t_user`, `t_date`, `updated_at`, `created_at`) VALUES
(13, '1', 'Laxmi Traders', 'D', 25, 'Shop No 12, Industries', 'M G Road, Bardex', 'Beed', 'MAH', 'IND', 871039, '1234567890', 'abc@gmail.com', '27AJDNO9239FJ1Z9E', 'NHH3ASK39', 2147483647, 'AHSBXTS3NAJ', 'Deepak Jain', 'Y', 'admin', '2022-08-09 12:35:25', 'admin', '2022-08-09 12:35:25', NULL, NULL),
(20, '2', 'Amit Traders', 'M', 45, 'Hand Asjr Tabdp', 'Majsnat Ajsnstaeb', 'Jodhpur', 'RAJ', 'IND', 840193, '87659654311', 'amit@gmail.com', 'NSUSHS6', 'DJDS72SS9', 123332434, 'SDSDS82', 'Sdsd Dsfds', 'Y', 'admin', '2022-08-09 03:43:02', 'admin', '2022-08-09 03:43:02', NULL, NULL),
(21, '3', 'Sm  Pvt Ltd', 'D', 10, 'Bajajnagar', '', 'Aurangabad', 'MAH', 'IND', 0, '', '', '', '', 0, '', '', 'Y', 'admin', '2022-08-10 11:18:44', 'admin', '2022-08-10 11:18:44', NULL, NULL),
(22, '4', 'Gs Enterprises', 'D', 10, 'Bajajnagar', '', 'Aurangabad', 'MAH', 'IND', 431136, '8766981829', '', '27AAPFD6839H1ZX', '', 2147483647, 'AAPFD6839H', 'Vivek ', 'Y', 'admin', '2022-08-10 11:23:26', 'admin', '2022-08-10 11:23:26', NULL, NULL),
(23, '5', 'chiv', 'D', 2, 'dd', 'dd', '124', 'MAH', 'IND', 43112, '22', 'yogeerajborge@gmail.com', 'ddf33', 'dfg345', 2345, NULL, 'tttt', 'Y', 'yogeerajborge@gmail.com', NULL, NULL, NULL, '2022-09-26 12:38:12', '2022-09-26 12:38:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD PRIMARY KEY (`vend_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendor_master`
--
ALTER TABLE `vendor_master`
  MODIFY `vend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
