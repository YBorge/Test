-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221011.4cd6b23007
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 06:17 AM
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
  `batch_no` int(155) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `from_qty` int(100) NOT NULL,
  `to_qty` int(100) NOT NULL,
  `max_qty` int(100) NOT NULL,
  `disc_perc` int(100) NOT NULL,
  `disc_amt` int(100) NOT NULL,
  `fix_rate` int(100) NOT NULL,
  `calc_on` varchar(5) NOT NULL,
  `cust_type_incl` varchar(155) NOT NULL,
  `cust_type_excl` varchar(155) NOT NULL,
  `created_by` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(155) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_scheme_disc`
--

INSERT INTO `item_scheme_disc` (`item_sch_disc_id`, `loc_code`, `promo_code`, `item_code`, `batch_no`, `from_date`, `to_date`, `from_time`, `to_time`, `from_qty`, `to_qty`, `max_qty`, `disc_perc`, `disc_amt`, `fix_rate`, `calc_on`, `cust_type_incl`, `cust_type_excl`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'KMTH', 'FIX', 4, 0, '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 0, 0, 0, 0, 8, 'M', '', '', 'ADMIN', '2022-11-08 05:13:17', 'ADMIN', '2022-11-08 05:13:17'),
(2, 'ALL', 'DISC', 1, 0, '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 0, 0, 2, 0, 0, 'S', '', '', 'ADMIN', '2022-11-08 05:15:02', 'ADMIN', '2022-11-08 05:15:02');

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
  MODIFY `item_sch_disc_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
