-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221120.420485a41b
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 07:44 AM
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
-- Table structure for table `item_scheme_disc`
--

CREATE TABLE `item_scheme_disc` (
  `item_sch_disc_id` int(150) NOT NULL,
  `loc_code` varchar(150) NOT NULL,
  `promo_code` varchar(100) NOT NULL,
  `item_code` int(100) NOT NULL,
  `batch_no` int(155) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `from_qty` decimal(10,3) DEFAULT NULL,
  `to_qty` decimal(10,3) DEFAULT NULL,
  `max_qty` decimal(10,3) DEFAULT NULL,
  `disc_perc` decimal(10,2) DEFAULT NULL,
  `disc_amt` decimal(10,2) DEFAULT NULL,
  `fix_rate` decimal(10,2) DEFAULT NULL,
  `calc_on` varchar(5) NOT NULL,
  `cust_type_incl` varchar(155) DEFAULT NULL,
  `cust_type_excl` varchar(155) DEFAULT NULL,
  `created_by` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(155) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_scheme_disc`
--

INSERT INTO `item_scheme_disc` (`item_sch_disc_id`, `loc_code`, `promo_code`, `item_code`, `batch_no`, `from_date`, `to_date`, `from_time`, `to_time`, `from_qty`, `to_qty`, `max_qty`, `disc_perc`, `disc_amt`, `fix_rate`, `calc_on`, `cust_type_incl`, `cust_type_excl`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'KMTH', 'F', 4, 0, '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0.000, 0.000, 0.000, 0.00, 0.00, 8.00, 'M', '', '', 'ADMIN', '2022-11-08 05:13:17', 'ADMIN', '2022-11-08 05:13:17'),
(2, 'KMTH', 'P', 1, 0, '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0.000, 0.000, 0.000, 2.00, 0.00, 0.00, 'S', '', '', 'ADMIN', '2022-11-08 05:15:02', 'ADMIN', '2022-11-08 05:15:02'),
(3, 'KMTH', 'F', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3.00, NULL, NULL, 'S', 'R', 'G', 'yogeerajborge@gmail.com', '2022-11-14 12:55:19', 'yogeerajborge@gmail.com', '2022-11-14 12:55:19'),
(4, 'KMTH', 'A', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80.00, NULL, 'S', 'G', NULL, 'yogeerajborge@gmail.com', '2022-11-14 13:20:03', 'yogeerajborge@gmail.com', '2022-11-14 13:20:03'),
(5, 'KMTH', 'F', 10, NULL, '2022-11-01', '2022-11-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70.00, 'S', NULL, NULL, 'yogeerajborge@gmail.com', '2022-11-20 02:03:42', 'yogeerajborge@gmail.com', '2022-11-20 02:03:42'),
(6, 'KMTH', 'F', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.00, 'S', NULL, NULL, 'yogeerajborge@gmail.com', '2022-11-21 09:44:24', 'yogeerajborge@gmail.com', '2022-11-21 09:44:24'),
(7, 'KMTH', 'F', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.00, 'S', NULL, NULL, 'yogeerajborge@gmail.com', '2022-11-21 09:44:24', 'yogeerajborge@gmail.com', '2022-11-21 09:44:24'),
(8, 'KMTH', 'F', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.00, 'S', NULL, NULL, 'yogeerajborge@gmail.com', '2022-11-21 09:44:57', 'yogeerajborge@gmail.com', '2022-11-21 09:44:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_scheme_disc`
--
ALTER TABLE `item_scheme_disc`
  ADD PRIMARY KEY (`item_sch_disc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_scheme_disc`
--
ALTER TABLE `item_scheme_disc`
  MODIFY `item_sch_disc_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
