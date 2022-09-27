-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 03:07 PM
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
-- Table structure for table `tax_master`
--

CREATE TABLE `tax_master` (
  `tax_id` int(11) NOT NULL,
  `tax_type` varchar(100) DEFAULT NULL,
  `tax_code` int(100) DEFAULT NULL,
  `tax_name` varchar(255) DEFAULT NULL,
  `tax_per` int(100) DEFAULT NULL,
  `tax_indicator` varchar(100) DEFAULT NULL,
  `igst` int(100) DEFAULT NULL,
  `sgst` int(100) DEFAULT NULL,
  `cgst` int(100) DEFAULT NULL,
  `utgst` int(100) DEFAULT NULL,
  `cess` int(100) DEFAULT NULL,
  `cessperpiece` int(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `t_user` varchar(100) DEFAULT NULL,
  `t_date` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_master`
--

INSERT INTO `tax_master` (`tax_id`, `tax_type`, `tax_code`, `tax_name`, `tax_per`, `tax_indicator`, `igst`, `sgst`, `cgst`, `utgst`, `cess`, `cessperpiece`, `status`, `created_by`, `created_date`, `t_user`, `t_date`, `updated_at`, `created_at`) VALUES
(1, 'G', 1, 'GST 0%', 0, '$', 0, 0, 0, 0, 0, 0, 'Y', 'admin', '2022-08-01 04:27:09', 'admin', '2022-08-01 04:27:09', NULL, NULL),
(2, 'G', 2, 'GST 5 %', 5, '@', 5, 2, 2, 2, 0, 0, 'Y', 'admin', '2022-08-01 04:39:09', 'admin', '2022-08-01 04:39:09', NULL, NULL),
(3, 'G', 3, 'GST 12%', 12, '#', 12, 6, 6, 6, 0, 0, 'Y', 'admin', '2022-08-09 08:08:11', 'admin', '2022-08-09 08:08:11', NULL, NULL),
(4, 'G', 4, 'GST 18%', 18, '*', 18, 9, 9, 9, 0, 0, 'Y', 'admin', '2022-08-09 08:11:04', 'admin', '2022-08-09 08:11:04', NULL, NULL),
(5, 'G', 10, 'dfr', 3, '3', 3, 3, 3, 3, 3, 3, 'Y', 'yogeerajborge@gmail.com', NULL, NULL, NULL, '2022-09-27 07:04:18', '2022-09-27 07:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tax_master`
--
ALTER TABLE `tax_master`
  ADD PRIMARY KEY (`tax_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tax_master`
--
ALTER TABLE `tax_master`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
