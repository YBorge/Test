-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 08:52 PM
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
-- Table structure for table `open_stock`
--

CREATE TABLE `open_stock` (
  `ost_id` int(110) NOT NULL,
  `loc_code` varchar(110) DEFAULT NULL,
  `barcode` varchar(150) DEFAULT NULL,
  `item_code` int(150) DEFAULT NULL,
  `qty` decimal(10,3) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `sale_rate` decimal(10,2) DEFAULT NULL,
  `cost_rate` decimal(10,3) DEFAULT NULL,
  `dept_code` varchar(100) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `batch_no` int(100) DEFAULT NULL,
  `doc_type` varchar(110) DEFAULT NULL,
  `comp_code` int(110) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `t_user` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_stock`
--

INSERT INTO `open_stock` (`ost_id`, `loc_code`, `barcode`, `item_code`, `qty`, `mrp`, `sale_rate`, `cost_rate`, `dept_code`, `expiry_date`, `batch_no`, `doc_type`, `comp_code`, `status`, `created_by`, `created_date`, `t_user`, `updated_at`, `created_at`) VALUES
(28, 'KMTH', '1', 1, '55.000', '100.00', '95.00', '70.370', 'SAL', '0000-00-00 00:00:00', -1, 'OB', 1, 'Y', 'admin', '2022-08-10 12:24:27', '', NULL, NULL),
(31, 'KMTH', '1', 1, '3.000', '99.00', '94.05', '69.670', 'SAL', '0000-00-00 00:00:00', -1, 'OB', 1, 'Y', 'admin', '2022-08-13 03:34:53', '', NULL, NULL),
(32, 'KMTH', '1', 1, '2.000', '2.00', '1.90', '1.410', 'SAL', '0000-00-00 00:00:00', -2, 'OB', 1, 'Y', 'admin', '2022-08-13 03:46:47', '', NULL, NULL),
(33, 'KMTH', '1', 1, '5.000', '95.00', '90.25', '66.850', 'SAL', '0000-00-00 00:00:00', -2, 'OB', 1, 'Y', 'admin', '2022-08-13 03:47:46', '', NULL, NULL),
(34, 'KMTH', '1', 1, '10.000', '90.00', '85.50', '63.330', 'SAL', '0000-00-00 00:00:00', -3, 'OB', 1, 'Y', 'admin', '2022-08-13 03:50:24', '', NULL, NULL),
(35, 'KMTH', '41', 4, '60.000', '10.00', '8.20', '6.720', 'SAL', '0000-00-00 00:00:00', -99, 'OB', 1, 'Y', 'admin', '2022-08-13 04:12:28', '', NULL, NULL),
(38, 'KMTH', '41', 4, '15.000', '12.00', '9.84', '8.070', 'SAL', '0000-00-00 00:00:00', -98, 'OB', 1, 'Y', 'admin', '2022-08-13 04:16:08', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `open_stock`
--
ALTER TABLE `open_stock`
  ADD PRIMARY KEY (`ost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `open_stock`
--
ALTER TABLE `open_stock`
  MODIFY `ost_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
