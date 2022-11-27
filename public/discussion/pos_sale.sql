-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221120.420485a41b
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 05:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

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
-- Table structure for table `pos_sale`
--

CREATE TABLE `pos_sale` (
  `pos_sale_id` int(155) NOT NULL,
  `loc_code` varchar(255) NOT NULL,
  `v_no` int(255) NOT NULL,
  `v_date` date NOT NULL,
  `mac_id` varchar(255) NOT NULL,
  `inv_type` char(5) NOT NULL DEFAULT 'R',
  `cust_code` int(255) NULL,
  `gl_code` int(255) NULL,
  `gstin` varchar(255) NULL,
  `home_delvy` char(5) NOT NULL DEFAULT 'N',
  `bill_amt` decimal(12,2) NOT NULL,
  `roundoff` decimal(12,2) NOT NULL,
  `recd_amt` decimal(12,2) NOT NULL,
  `ord_id` int(155) NULL,
  `salesman_code` int(100) NULL,
  `token_no` int(100) NULL,
  `session_id` int(100) NOT NULL,
  `comp_code` int(100) NOT NULL,
  `bill_type` char(5) NOT NULL DEFAULT 'O',
  `item_code` int(155) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `bill_qty` int(100) NOT NULL,
  `mrp` decimal(12,3) NOT NULL,
  `cost_rate` decimal(12,3) NOT NULL,
  `sale_rate` decimal(12,3) NOT NULL,
  `item_amt` decimal(12,3) NOT NULL,
  `batch_no` int(255) NOT NULL,
  `promo_item` varchar(155) NULL,
  `item_disc` decimal(12,3) NULL,
  `promo_bill` varchar(155) NULL,
  `bill_disc` decimal(12,3) NULL,
  `manual_disc_user` varchar(155) NULL,
  `manual_disc` decimal(12,3) NULL,
  `free_item` char(5) NULL,
  `oth_chrg_user` varchar(155) NULL,
  `oth_chrg_disc` decimal(12,3) NULL,
  `tax_code` int(100) NOT NULL,
  `tax_amt` decimal(12,3) NULL,
  `net_amt` decimal(12,3) NOT NULL,
  `net_sale_rate` decimal(12,3) NOT NULL,
  `created_by` varchar(155) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pos_sale`
--
ALTER TABLE `pos_sale`
  ADD PRIMARY KEY (`pos_sale_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pos_sale`
--
ALTER TABLE `pos_sale`
  MODIFY `pos_sale_id` int(155) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
