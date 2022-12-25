-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 06:59 PM
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
-- Table structure for table `pointofsalepayment`
--

CREATE TABLE `pointofsalepayment` (
  `id` int(11) NOT NULL,
  `loc_code` varchar(255) NOT NULL,
  `comp_code` varchar(100) DEFAULT NULL,
  `v_no` int(255) NOT NULL,
  `v_date` datetime DEFAULT NULL,
  `mac_id` varchar(255) DEFAULT NULL,
  `pmt_code` int(100) NOT NULL,
  `ref_amt` decimal(10,2) DEFAULT NULL,
  `pmt_chrg` decimal(12,3) NOT NULL,
  `pmt_amt` decimal(12,3) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pointofsalepayment`
--
ALTER TABLE `pointofsalepayment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pointofsalepayment`
--
ALTER TABLE `pointofsalepayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
