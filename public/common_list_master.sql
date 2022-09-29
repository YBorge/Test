-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 03:25 PM
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
-- Table structure for table `common_list_master`
--

CREATE TABLE `common_list_master` (
  `list_id` int(110) NOT NULL,
  `list_code` varchar(255) NOT NULL,
  `list_value` varchar(255) NOT NULL,
  `list_desc` varchar(100) NOT NULL,
  `order_by` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `loc_code` varchar(100) NOT NULL,
  `tuser` varchar(110) NOT NULL,
  `tdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `common_list_master`
--

INSERT INTO `common_list_master` (`list_id`, `list_code`, `list_value`, `list_desc`, `order_by`, `status`, `loc_code`, `tuser`, `tdate`) VALUES
(1, 'CUST_GROUP', 'Regular', 'Regular', '1', 'Y', 'na', 'ADMIN', '0000-00-00 00:00:00'),
(2, 'SUPP_TYPE', 'D', 'Direct Supp', '1', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(3, 'SUPP_TYPE', 'M', 'Manufacturer', '2', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(4, 'CAT_TYPE', 'Food', 'Food', '1', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(5, 'CAT_TYPE', 'Non-Food', 'Non-Food', '2', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(6, 'CAT_TYPE', 'Medicine', 'Medicine', '3', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(7, 'CAT_TYPE', 'Cloth', 'Cloth', '4', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(8, 'UNIT', 'KG', 'Kilogram', '1', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(9, 'UNIT', 'GM', 'Grams', '2', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(10, 'UNIT', 'LT', 'Litre', '3', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(11, 'UNIT', 'ML', 'Mili Liter', '4', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(12, 'UNIT', 'NO', 'Numbers', '5', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(13, 'COMP_TYPE', 'PROP', 'Proprietorship', '1', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(14, 'COMP_TYPE', 'PTNR', 'Partnership', '2', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(15, 'COMP_TYPE', 'PVTLTD', 'Private Limited', '3', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(16, 'COMP_TYPE', 'LTD', 'Limited', '4', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(17, 'USER_ROLE', 'Accts.Assistant', 'Accts.Assistant', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(18, 'USER_ROLE', 'Accts.Executive', 'Accts.Executive', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(19, 'USER_ROLE', 'Accts.Manager', 'Accts.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(20, 'USER_ROLE', 'Asst.Manager', 'Asst.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(21, 'USER_ROLE', 'Ast.Manager/Hd.Cashr', 'Ast.Manager/Hd.Cashr', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(22, 'USER_ROLE', 'Auditor', 'Auditor', '1', 'Y', '0', '', '0000-00-00 00:00:00'),
(23, 'USER_ROLE', 'Br.Manager', 'Br.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(24, 'USER_ROLE', 'Ca', 'Ca', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(25, 'USER_ROLE', 'Cashier', 'Cashier', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(26, 'USER_ROLE', 'Cashier/Acc', 'Cashier/Acc', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(27, 'USER_ROLE', 'Cashier/Inv', 'Cashier/Inv', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(28, 'USER_ROLE', 'Checker', 'Checker', '1', 'Y', '0', '', '0000-00-00 00:00:00'),
(29, 'USER_ROLE', 'Clu.Manager', 'Clu.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(30, 'USER_ROLE', 'Delivery Boy', 'Delivery Boy', '1', 'Y', '0', '', '0000-00-00 00:00:00'),
(31, 'USER_ROLE', 'Dept.Assistant', 'Dept.Assistant', '0', 'Y', '0', '', '0000-00-00 00:00:00'),
(32, 'USER_ROLE', 'Head Cashier', 'Head Cashier', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(33, 'USER_ROLE', 'Helper', 'Helper', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(34, 'USER_ROLE', 'Hod.Marketting', 'Hod.Marketting', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(35, 'USER_ROLE', 'Inv.Branch', 'Inv.Branch', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(36, 'USER_ROLE', 'Inv.Clerk', 'Inv.Clerk', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(37, 'USER_ROLE', 'Inv.Who', 'Inv.Who', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(38, 'USER_ROLE', 'It.Admin', 'It.Admin', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(39, 'USER_ROLE', 'It.Edp', 'It.Edp', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(40, 'USER_ROLE', 'Mat.Manager', 'Mat.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(41, 'USER_ROLE', 'Pur.Manager', 'Pur.Manager', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(42, 'USER_ROLE', 'Rwadmin', 'Rwadmin', '', 'Y', '0', '', '0000-00-00 00:00:00'),
(43, 'USER_ROLE', 'Wh_Picker', 'Wh_Picker', '1', 'Y', '0', '', '0000-00-00 00:00:00'),
(44, 'COMP_TYPE', 'PVT', 'Private', '5', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(45, 'CUST_TYPE', 'R', 'Regular', '1', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(46, 'CUST_TYPE', 'F', 'Family', '2', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00'),
(47, 'CUST_TYPE', 'G', 'Gold', '3', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_list_master`
--
ALTER TABLE `common_list_master`
  ADD PRIMARY KEY (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_list_master`
--
ALTER TABLE `common_list_master`
  MODIFY `list_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
