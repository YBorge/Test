-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 07:36 PM
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
-- Table structure for table `temp_stock_details`
--

CREATE TABLE `temp_stock_details` (
  `id` int(11) NOT NULL,
  `t_stock_id` int(11) DEFAULT NULL,
  `t_item_code` int(100) DEFAULT NULL,
  `t_batch_no` int(11) DEFAULT NULL,
  `t_mrp` decimal(10,2) DEFAULT NULL,
  `t_sale_rate` decimal(10,2) DEFAULT NULL,
  `t_sum_bal_qty` decimal(10,2) DEFAULT NULL,
  `t_updatedby` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `t_machine_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `temp_stock_details`
--

INSERT INTO `temp_stock_details` (`id`, `t_stock_id`, `t_item_code`, `t_batch_no`, `t_mrp`, `t_sale_rate`, `t_sum_bal_qty`, `t_updatedby`, `t_machine_name`, `created_at`, `updated_at`) VALUES
(1, 20, 1, -1, '100.00', '95.00', '10.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 04:46:49', '2022-11-13 04:46:49'),
(2, 23, 1, -1, '100.00', '95.00', '3.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 04:46:49', '2022-11-13 04:46:49'),
(3, 24, 1, -2, '2.00', '1.90', '2.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 04:46:49', '2022-11-13 04:46:49'),
(4, 25, 1, -2, '95.00', '90.25', '5.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 04:46:49', '2022-11-13 04:46:49'),
(5, 26, 1, -3, '90.00', '85.50', '10.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 04:46:49', '2022-11-13 04:46:49'),
(6, 27, 4, -99, '10.00', '8.20', '10.00', 'yogeerajborge@gmail.com', 'Yogeeraj-PC', '2022-11-13 05:30:53', '2022-11-13 05:30:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temp_stock_details`
--
ALTER TABLE `temp_stock_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_stock_details`
--
ALTER TABLE `temp_stock_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
