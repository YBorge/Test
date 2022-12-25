-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 06:58 PM
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
-- Table structure for table `pointofsale`
--

CREATE TABLE `pointofsale` (
  `p_id` int(11) NOT NULL,
  `loc_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `comp_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `v_no` int(11) DEFAULT NULL,
  `v_date` timestamp NULL DEFAULT NULL,
  `mac_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `inv_type` varchar(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Tax (T)/Retail (R) \r\nTax (T)/Retail(R)',
  `cust_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `gl_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE latin1_general_ci DEFAULT 'N',
  `home_delvy` varchar(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Y - Yes, N-No',
  `ord_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `salesman_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `token_no` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bill_type` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `manual_disc_user` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `manual_disc_perc` decimal(10,2) DEFAULT NULL,
  `oth_chrg_user` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `oth_chrg_perc` decimal(10,2) DEFAULT NULL,
  `net_bill_amt` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(10,2) DEFAULT NULL,
  `net_sale_amt` decimal(10,2) DEFAULT NULL,
  `item_amt` decimal(10,2) DEFAULT NULL,
  `item_disc` decimal(10,2) DEFAULT NULL,
  `bill_disc` decimal(10,2) DEFAULT NULL,
  `manual_disc_amt` decimal(10,2) DEFAULT NULL,
  `oth_chrg_amt` decimal(10,2) DEFAULT NULL,
  `pmt_chrg` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pointofsale`
--
ALTER TABLE `pointofsale`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pointofsale`
--
ALTER TABLE `pointofsale`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
