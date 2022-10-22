-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221011.4cd6b23007
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 08:35 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_home` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `category_image`, `is_home`, `status`, `created_by`, `created_at`) VALUES
(1, 'Admin', '#', 0, '1613552454.jpg', 1, 1, 'admin', '2021-02-16 23:41:09'),
(2, 'Masters', '#', 0, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(3, 'Sales', '#', 0, '1613552512.jpg', 1, 1, 'admin', '2021-02-16 22:01:52'),
(4, 'Transactions', '#', 0, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(5, 'Reports', '#', 0, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(6, 'Housekeeping', '#', 0, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(101, 'System Setup', '#', 1, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(102, 'Parameter Master', 'parameters', 101, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(103, 'Common List Master', 'common_list_master', 101, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(104, 'Modules', 'categories', 1, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(105, 'Company Master', 'company_master', 1, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(106, 'Branch Master', 'branch_master', 1, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(201, 'City/ State/ Country', 'city_state_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(202, 'User Master', 'user_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(203, 'User Permission', 'user_access', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(204, 'Item Master', 'item_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(205, 'Category/ Sub-Category Master', 'cate_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(206, 'Manufacturer/Brand Master', 'brand_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(207, 'Tax Master', 'tax_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(208, 'Item Tax Master', 'item_tax_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(209, 'Unit Master', 'unit_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(210, 'HSN Master', 'hsn_master', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(211, 'Payment Detail', '#', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(212, 'Payment Mode', 'payment_master', 211, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(213, 'Payment Incl/Excl Master', 'pmt_incl_excl_master', 211, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(214, 'Customers', '#', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(215, 'Customer Master', 'customer_master', 214, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(216, 'Customer Rate Define', 'cust_rate_master', 214, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(217, 'Suppliers', '#', 2, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(218, 'Vendor Master', 'vendor_master', 217, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(219, 'Supplier Rate Define', 'supp_rate_master', 217, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(301, 'Point-of-Sale (Counter Sale)', 'pointofsale', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(302, 'Sale Return', 'sale_ret', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(303, 'Home Delivery Payment', 'home_delv_pmt', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(304, 'Cash Declaration', 'cash_denomation', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(305, 'Customer Update in POS', 'cust_upd_pos', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(306, 'Sale History', 'sale_hist', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(307, 'Credit Sale', 'credit_sale', 3, '1613553407.jpg', 1, 1, 'admin', '2021-02-16 22:16:47'),
(401, 'Opening Stock', 'open_stock', 4, '1613553509.jpg', 1, 1, 'admin', '2021-02-16 22:18:29'),
(402, 'Stock Adjustment', 'stk_adj', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(403, 'Purchase', '#', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(404, 'Purchase Order', 'pur_order', 403, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(405, 'Inward Gate Entry', 'grn_gate_entry', 403, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(406, 'GRN/Purchase Entry', 'purchase_entry', 403, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(407, 'Purchase Return', 'pur_return', 403, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(408, 'Re-Packaging', '#', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(409, 'Loose to Pack', 'repack_pack_loose', 408, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(410, 'Pack to loose', 'repack_loose_pack', 408, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(411, 'Rate Modify', 'rate_modify', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(412, 'Stock Take', '#', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(413, 'Full Stock Take', 'stk_take_full', 412, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(414, 'Partial Stock Take', 'stk_take_partial', 412, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(415, 'Label Print', 'label_print', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(416, 'Stock Transfer', '#', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(417, 'Stock Out', 'stk_trf_out', 416, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(418, 'Stock IN', 'stk_trf_in', 416, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(419, 'Customer Payment', 'cust_payment', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(420, 'Supplier Payment', 'supp_payment', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(421, 'Others Payment', 'oth_payment', 4, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(501, 'Purchase Register & Summary', 'pur_details', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(502, 'Duplicate Rate', 'multi_rate_item', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(503, 'Daily Sale Report', 'daily_sale', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(504, 'Monthly Sale Comparision', 'mth_sale_compare', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(505, 'Item Sold Report', 'item_sold', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(506, 'Payment-Type Wise Sale Report', 'pmtwise_sale', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(507, 'Branch Transaction Report', 'br_trans_rep', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(508, 'Supplier Wise Stock', 'suppwise_stk', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(509, 'Time-Slot Wise P.O.S. Report', 'timewise_sale', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(510, 'Top N Products Report', 'top_item', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(511, 'Category Mis Report', 'cat_mis', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(512, 'No Sale/Trf Out Report', 'no_sale', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(513, 'Stock-Out Products: Current', 'stk_out_item', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(514, 'Product Wise Saving W.R.T. Mrp Report', 'itemwise_save', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(515, 'Cashier Comparison Report', 'cashier_compare', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(516, 'POS Audit Report', 'pos_audit', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(517, 'Date/Month-Wise Sale And Cl.Stock', 'datewise_sale_currstk', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(518, 'Negative Stock', 'null_item', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(519, 'Cashierwise Datewise Detail Report', 'cashier_datewise_sale', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(520, 'Customer Mix Report', 'cust_mix', 5, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(601, 'Backup', 'sys_backup', 6, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(602, 'Day Open/Close', '#', 6, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(603, 'Day Open', 'day_open', 602, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(604, 'Day Close', 'day_close', 602, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(605, 'Year End Process', '#', 6, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(606, 'New Year Creation', 'new_year_create', 605, NULL, 1, 1, 'admin', '2021-02-16 22:54:40'),
(607, 'Prev Year Data Transfer', 'year_data_post', 605, NULL, 1, 1, 'admin', '2021-02-16 22:54:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
