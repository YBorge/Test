-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 02:42 PM
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `category_image`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Man', 'man', 5, '1613552454.jpg', 1, 1, '2021-02-16 22:00:54', '2021-02-16 23:41:09'),
(2, 'Master', '#', 0, '1613553509.jpg', 1, 1, '2021-02-16 22:01:24', '2021-02-16 22:18:29'),
(3, 'Kids', 'kids', 0, '1613552512.jpg', 1, 0, '2021-02-16 22:01:52', '2021-02-16 22:01:52'),
(4, 'Company Master', 'company_master', 2, '1613553407.jpg', 1, 1, '2021-02-16 22:16:07', '2021-02-16 22:16:47'),
(5, 'Shoes', 'shoes', 3, NULL, 0, 0, '2021-02-16 22:54:40', '2021-02-16 22:54:40'),
(7, 'Admin', '#', 0, '1613553509.jpg', 1, 1, '2021-02-16 22:01:24', '2021-02-16 22:18:29'),
(8, 'System Setup', '#', 7, NULL, 1, 1, '2021-02-16 22:54:40', '2021-02-16 22:54:40'),
(9, 'POS ', '#', 0, '1613553509.jpg', 1, 1, '2021-02-16 22:01:24', '2021-02-16 22:18:29'),
(10, 'Point Of Sale', 'pointofsale', 9, '1613553407.jpg', 1, 1, '2021-02-16 22:16:07', '2021-02-16 22:16:47'),
(11, 'Branch Master', 'branch_master', 2, '1613553407.jpg', 1, 1, '2021-02-16 22:16:07', '2021-02-16 22:16:47'),
(12, 'Category / Sub-Category Master', 'cate_master', 2, '1613553407.jpg', 1, 1, '2021-02-16 22:16:07', '2021-02-16 22:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `state_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_code`) VALUES
(1, 'Aalot', 'MDP'),
(2, 'Abdullahpur', 'HMP'),
(3, 'Abohar.', 'PNJ'),
(4, 'Addison Il', 'CHI'),
(5, 'Adelaide', 'SA'),
(6, 'Adilabad', 'ADP'),
(7, 'Adoni', 'ADP'),
(8, 'Adumpur', 'HMP'),
(9, 'Adur', 'KER'),
(10, 'Adwani', 'HMP'),
(11, 'Agartala', 'TRI'),
(12, 'Agatti', 'LAK'),
(13, 'Agra', 'UTP'),
(14, 'Agumbe', 'KRT'),
(15, 'Ahemedabad', 'GUJ'),
(16, 'Ahiri', 'MAH'),
(17, 'Ahmednagar', 'MAH'),
(18, 'Aihole', 'KRT'),
(19, 'Aizawl', 'MIZ'),
(20, 'Ajman', 'UAE'),
(21, 'Ajmer', 'RAJ'),
(22, 'Akaltara', 'CTG'),
(23, 'Akkalkot', 'MAH'),
(24, 'Akola', 'MAH'),
(25, 'Akra', 'HMP'),
(26, 'Aland', 'KRT'),
(27, 'Alangudi', 'TML'),
(28, 'Alappuzha', 'KER'),
(29, 'Alexandria', 'EJ'),
(30, 'Alibag', 'MAH'),
(31, 'Aligarh', 'UTP'),
(32, 'Alipur', 'DEL'),
(33, 'Allahabad', 'UTP'),
(34, 'Almora', 'UTR'),
(35, 'Alpharetta Ga', 'GA'),
(36, 'Aluva', 'KER'),
(37, 'Alwar', 'RAJ'),
(38, 'Amalner', 'MAH'),
(39, 'Ambala', 'HAR'),
(40, 'Ambalapuzha', 'KER'),
(41, 'Ambapara', 'GUJ'),
(42, 'Ambari', 'HMP'),
(43, 'Ambasamudram', 'KER'),
(44, 'Ambernath', 'MAH'),
(45, 'Amdavad', 'GUJ'),
(46, 'Amgaon', 'MAH'),
(47, 'Amravati', 'MAH'),
(48, 'Amreli', 'GUJ'),
(49, 'Amritsar', 'PNJ'),
(50, 'Anand', 'GUJ'),
(51, 'Anantpur', 'ADP'),
(52, 'Anchuthengu', 'KER'),
(53, 'Andro', 'MAN'),
(54, 'Angamali', 'KER'),
(55, 'Angul', 'ORS'),
(56, 'Anjangaon', 'MAH'),
(57, 'Anjar', 'GUJ'),
(58, 'Antsiranana', 'MDG'),
(59, 'Arambol', 'GOA'),
(60, 'Araria', 'BHR'),
(61, 'Araucaria Pr', 'BRA'),
(62, 'Aravakurichi', 'KER'),
(63, 'Aravalli', 'GUJ'),
(64, 'Arni', 'TML'),
(65, 'Arrah', 'BHR'),
(66, 'Aruppukottai', 'TML'),
(67, 'Asangaon', 'MAH'),
(68, 'Ashok Nagar', 'MDP'),
(69, 'Atlanta', 'GA'),
(70, 'Attingal', 'KER'),
(71, 'Auckland', 'ACK'),
(72, 'Aurangabad', 'MAH'),
(73, 'Avanashi', 'KER'),
(74, 'Awang Kasom', 'MAN'),
(75, 'Ayodhya', 'UTP'),
(76, 'Ayur', 'KER'),
(77, 'Azamgarh', 'UTP'),
(78, 'Badami', 'KRT'),
(79, 'Badarpur', 'DEL'),
(80, 'Badlapur', 'MAH'),
(81, 'Badwani', 'MDP'),
(82, 'Bagaha', 'BHR'),
(83, 'Bahea', 'BHR'),
(84, 'Bakkhali', 'WTB'),
(85, 'Balaghat', 'MDP'),
(86, 'Balangir', 'ORS'),
(87, 'Baleswar', 'ORS'),
(88, 'Balod', 'CTG'),
(89, 'Balrampur', 'UTP'),
(90, 'Baltimore', 'MAY'),
(91, 'Banaraji', 'CTG'),
(92, 'Banavasi', 'KRT'),
(93, 'Bandar Abbas', 'IRA'),
(94, 'Bandipur', 'KER'),
(95, 'Banerghatta', 'KRT'),
(96, 'Bangalore', 'KRT'),
(97, 'Bangaram', 'LAK'),
(98, 'Bangkok', 'THA'),
(99, 'Banswara', 'RAJ'),
(100, 'Baragarh', 'ORS'),
(101, 'Barahara', 'BHR'),
(102, 'Barahiya', 'BHR'),
(103, 'Baramati', 'MAH'),
(104, 'Baran', 'RAJ'),
(105, 'Barauli', 'BHR'),
(106, 'Barauni Township', 'BHR'),
(107, 'Barbari', 'JHR'),
(108, 'Barbigha', 'BHR'),
(109, 'Barden', 'GOA'),
(110, 'Bareilly', 'UTP'),
(111, 'Baripada', 'ORS'),
(112, 'Barmer', 'RAJ'),
(113, 'Barnagar', 'MDP'),
(114, 'Barodara', 'GUJ'),
(115, 'Barpeta', 'JHR'),
(116, 'Barshi', 'MAH'),
(117, 'Barwani', 'MDP'),
(118, 'Basava-Kalyan', 'KRT'),
(119, 'Basna', 'CTG'),
(120, 'Bastar', 'CTG'),
(121, 'Batu Pahat', 'JOH'),
(122, 'Bauda', 'ORS'),
(123, 'Bavla', 'GUJ'),
(124, 'Beed', 'MAH'),
(125, 'Begusari', 'BHR'),
(126, 'Behiang', 'MAN'),
(127, 'Beirut', 'LEB'),
(128, 'Belapur', 'MAH'),
(129, 'Belgaum', 'KRT'),
(130, 'Bellary', 'KRT'),
(131, 'Bellevue', 'DLW'),
(132, 'Belur', 'KRT'),
(133, 'Betul', 'MDP'),
(134, 'Bhachau', 'GUJ'),
(135, 'Bhadohi', 'UTP'),
(136, 'Bhagalpur', 'BHR'),
(137, 'Bhalgamda', 'GUJ'),
(138, 'Bhandara', 'MAH'),
(139, 'Bhandpur', 'KRT'),
(140, 'Bharatpur', 'RAJ'),
(141, 'Bharuch', 'GUJ'),
(142, 'Bhatinda', 'PNJ'),
(143, 'Bhatkal', 'KRT'),
(144, 'Bhatpara', 'CTG'),
(145, 'Bhavanipatna', 'ORS'),
(146, 'Bhavnagar', 'GUJ'),
(147, 'Bhigwan', 'MAH'),
(148, 'Bhikangaon', 'MDP'),
(149, 'Bhilai', 'CTG'),
(150, 'Bhilwara', 'RAJ'),
(151, 'Bhind', 'MDP'),
(152, 'Bhivpuri', 'MAH'),
(153, 'Bhiwandi', 'MAH'),
(154, 'Bhiwani', 'HAR'),
(155, 'Bhiwapur', 'MAH'),
(156, 'Bhoganipur', 'UTP'),
(157, 'Bhoj', 'GUJ'),
(158, 'Bhokardan', 'MAH'),
(159, 'Bhongaon', 'UTP'),
(160, 'Bhopal', 'MDP'),
(161, 'Bhor', 'MAH'),
(162, 'Bhuj', 'GUJ'),
(163, 'Bicholin', 'GOA'),
(164, 'Bid', 'MAH'),
(165, 'Bidar', 'KRT'),
(166, 'Bijapur', 'KRT'),
(167, 'Bikaner', 'RAJ'),
(168, 'Bilaspur', 'HMP'),
(169, 'Bishnupur', 'MAN'),
(170, 'Bishwananath', 'JHR'),
(171, 'Bodh Gaya', 'BHR'),
(172, 'Bodinayakannur', 'KER'),
(173, 'Bodri', 'CTG'),
(174, 'Bokajan', 'JHR'),
(175, 'Bokaro', 'JHR'),
(176, 'Borsad', 'GUJ'),
(177, 'Brisbane', 'BRI'),
(178, 'Brunei Darussalam', 'MUK'),
(179, 'Bulandshahar', 'UTP'),
(180, 'Buldhana', 'MAH'),
(181, 'Bundi', 'RAJ'),
(182, 'Burdhwan', 'WTB'),
(183, 'Campos De Julio', 'BRA'),
(184, 'Cancona', 'GOA'),
(185, 'Carouge', 'ZUR'),
(186, 'Casablanca', 'MOR'),
(187, 'Chail', 'HMP'),
(188, 'Chailbasa', 'JHR'),
(189, 'Chakan', 'MAH'),
(190, 'Chakpi Karong', 'MAN'),
(191, 'Challakere', 'KRT'),
(192, 'Chamba', 'HMP'),
(193, 'Champaran', 'CTG'),
(194, 'Champhai', 'MIZ'),
(195, 'Chamrajnagar', 'KER'),
(196, 'Chandel', 'MAN'),
(197, 'Chandigarh', 'HAR'),
(198, 'Chandisar', 'GUJ'),
(199, 'Chandrapur', 'MAH'),
(200, 'Chapel Hill', 'NOC'),
(201, 'Chatra', 'JHR'),
(202, 'Chatrapur', 'ORS'),
(203, 'Chavara', 'KER'),
(204, 'Chenganachery', 'KER'),
(205, 'Chengannur', 'KER'),
(206, 'Chennai', 'TML'),
(207, 'Cherapunjee ', 'MEG'),
(208, 'Cherpoli - Shahapur', 'MAH'),
(209, 'Chhapi', 'GUJ'),
(210, 'Chhapra', 'BHR'),
(211, 'Chhatarpur', 'MDP'),
(212, 'Chhindwara', 'MDP'),
(213, 'Chicago', 'LL'),
(214, 'Chidambaram', 'TML'),
(215, 'Chikhli', 'GUJ'),
(216, 'Chikmagadur', 'KRT'),
(217, 'Chirmiri', 'CTG'),
(218, 'Chitradurga', 'KRT'),
(219, 'Chittaurgarh', 'RAJ'),
(220, 'Chittorgarh', 'RAJ'),
(221, 'Chorwad', 'GUJ'),
(222, 'Churachandpur', 'MAN'),
(223, 'Churu', 'RAJ'),
(224, 'Coimbtore', 'TML'),
(225, 'Colombo', 'SRL'),
(226, 'Conakry', 'GUI'),
(227, 'Coonoor', 'TML'),
(228, 'Corbett National Park', 'UTR'),
(229, 'Cotonou', 'BE'),
(230, 'Cuchch', 'GUJ'),
(231, 'Cuddapah', 'ADP'),
(232, 'Currin Avenue', 'CLF'),
(233, 'Cuttack', 'ORS'),
(234, 'Dabra', 'MDP'),
(235, 'Dadra', 'DNH'),
(236, 'Dahod', 'GUJ'),
(237, 'Dahte Wada', 'CTG'),
(238, 'Dakar', 'DAK'),
(239, 'Dakor', 'GUJ'),
(240, 'Dalhousie', 'HMP'),
(241, 'Daman', 'GUJ'),
(242, 'Daman Diu', 'DNH'),
(243, 'Damoh', 'MDP'),
(244, 'Dandeli', 'KRT'),
(245, 'Dandenong', 'VIC'),
(246, 'Darjeeling', 'WTB'),
(247, 'Dasarahonsahalli', 'KRT'),
(248, 'Datia', 'MDP'),
(249, 'Daund', 'MAH'),
(250, 'Dausa', 'RAJ'),
(251, 'Davangere', 'KRT'),
(252, 'Deesa', 'GUJ'),
(253, 'Dehli', 'DEL'),
(254, 'Dehradun', 'UTR'),
(255, 'Delhi', 'DEL'),
(256, 'Demai', 'GUJ'),
(257, 'Deogarh', 'ORS'),
(258, 'Deori', 'MAH'),
(259, 'Devghar', 'JHR'),
(260, 'Devikulam', 'KER'),
(261, 'Devlali', 'MAH'),
(262, 'Dewas', 'MDP'),
(263, 'Dhadgaon', 'MAH'),
(264, 'Dhamtari', 'CTG'),
(265, 'Dhanbad', 'JHR'),
(266, 'Dhandhuka', 'GUJ'),
(267, 'Dhar', 'MDP'),
(268, 'Dharamsala', 'HMP'),
(269, 'Dharapuram', 'KER'),
(270, 'Dhareshwar', 'MDP'),
(271, 'Dharmapuri', 'KER'),
(272, 'Dharni', 'MAH'),
(273, 'Dharuhera', 'HAR'),
(274, 'Dharwar', 'KRT'),
(275, 'Dhenkanal', 'ORS'),
(276, 'Dhikala ', 'UTR'),
(277, 'Dholka', 'GUJ'),
(278, 'Dhori- Bhuj', 'GUJ'),
(279, 'Dhule', 'MAH'),
(280, 'Digha', 'WTB'),
(281, 'Dighadiya - Vid', 'GUJ'),
(282, 'Dindori', 'MDP'),
(283, 'Dindugal', 'KER'),
(284, 'Diu', 'GUJ'),
(285, 'Djibouti', 'DJI'),
(286, 'Dodoma', 'DOD'),
(287, 'Doha Qatar', 'QAT'),
(288, 'Dombivali', 'MAH'),
(289, 'Dona Paula', 'GOA'),
(290, 'Dondaicha', 'MAH'),
(291, 'Dooars', 'WTB'),
(292, 'Drass', 'JMK'),
(293, 'Dubai', 'UAE'),
(294, 'Dudhai', 'GUJ'),
(295, 'Dungapur', 'RAJ'),
(296, 'Durg', 'CTG'),
(297, 'Dwarka', 'GUJ'),
(298, 'East Nimar', 'MDP'),
(299, 'Edison', 'NJ'),
(300, 'Elura', 'ADP'),
(301, 'Etawah', 'UTP'),
(302, 'Ettumanur', 'KER'),
(303, 'Faisalabad', 'FAI'),
(304, 'Faizabad', 'UTP'),
(305, 'Faridabad', 'HAR'),
(306, 'Faridkot', 'PNJ'),
(307, 'Fatehgarh', 'PNJ'),
(308, 'Fatehpur', 'UTP'),
(309, 'Fatenabad', 'HAR'),
(310, 'Felixstowe', 'UK'),
(311, 'Firozpur', 'PNJ'),
(312, 'Fremont', 'CLF'),
(313, 'Fujairh', 'UAE'),
(314, 'Gadag', 'KRT'),
(315, 'Gadchiroli', 'MAH'),
(316, 'Gadhinglaj', 'MAH'),
(317, 'Gajraula', 'UTP'),
(318, 'Gandai', 'CTG'),
(319, 'Gandhidham', 'GUJ'),
(320, 'Gandhinagar', 'GUJ'),
(321, 'Gangakher', 'MAH'),
(322, 'Ganganagar', 'RAJ'),
(323, 'Gangapur', 'RAJ'),
(324, 'Gangavathi', 'KRT'),
(325, 'Gangtok', 'SIK'),
(326, 'Gargoti', 'MAH'),
(327, 'Garhwa', 'JHR'),
(328, 'Gaya', 'BHR'),
(329, 'Genoa', ''),
(330, 'Ghangaria', 'UTR'),
(331, 'Gharghoda', 'CTG'),
(332, 'Ghaziabad', 'UTP'),
(333, 'Ghod', 'MAH'),
(334, 'Ghoti', 'MAH'),
(335, 'Giridih', 'JHR'),
(336, 'Girraween', 'NSW'),
(337, 'Godavari', 'ADP'),
(338, 'Godda', 'JHR'),
(339, 'Godhra', 'GUJ'),
(340, 'Gogaon', 'CTG'),
(341, 'Gonda', 'UTP'),
(342, 'Gondal', 'GUJ'),
(343, 'Gondia', 'MAH'),
(344, 'Gondla', 'MAH'),
(345, 'Gorakhpur', 'UTP'),
(346, 'Goregaon', 'MAH'),
(347, 'Gudalur', 'KER'),
(348, 'Gulbarga', 'KRT'),
(349, 'Gulbargah', 'KRT'),
(350, 'Gulmarg', 'JMK'),
(351, 'Gumla', 'JHR'),
(352, 'Guna', 'MDP'),
(353, 'Gundalupet', 'KER'),
(354, 'Guntar', 'ADP'),
(355, 'Gurgaon', 'HAR'),
(356, 'Gurugram', 'HAR'),
(357, 'Guruvayur', 'KER'),
(358, 'Gwalior', 'MDP'),
(359, 'Gyalshing ', 'SIK'),
(360, 'Hadgaon', 'MAH'),
(361, 'Haldupurao', 'UTR'),
(362, 'Haldwani', 'UTR'),
(363, 'Halebid', 'KRT'),
(364, 'Halvad', 'GUJ'),
(365, 'Hamirpur', 'HMP'),
(366, 'Hampi', 'KRT'),
(367, 'Hansi', 'HAR'),
(368, 'Hanumangarh', 'RAJ'),
(369, 'Harda', 'MDP'),
(370, 'Haridwar', 'UTR'),
(371, 'Haripad', 'KER'),
(372, 'Hasan', 'KRT'),
(373, 'Hathras', 'UTP'),
(374, 'Haveri', 'KRT'),
(375, 'Hazaribaug', 'JHR'),
(376, 'Henglep', 'MAN'),
(377, 'Himmat', 'GUJ'),
(378, 'Himmat Nagar', 'GUJ'),
(379, 'Hindaun', 'RAJ'),
(380, 'Hingoli', 'MAH'),
(381, 'Hirapar', 'GUJ'),
(382, 'Hiriyur', 'KRT'),
(383, 'Hisar', 'HAR'),
(384, 'Hissar', 'HAR'),
(385, 'Hongenakkal', 'TML'),
(386, 'Honkong', 'HON'),
(387, 'Hooghly', 'WTB'),
(388, 'Hosdurg', 'KER'),
(389, 'Hoshangabad', 'MDP'),
(390, 'Hosiarpur', 'PNJ'),
(391, 'Hospet', 'KRT'),
(392, 'Houston', 'TX'),
(393, 'Howrah', 'WTB'),
(394, 'Hubli', 'KRT'),
(395, 'Humnabad', 'KRT'),
(396, 'Hundung', 'MAN'),
(397, 'Hydrabad', 'TLG'),
(398, 'Hydrabad_Pak', 'PAK'),
(399, 'Idar', 'GUJ'),
(400, 'Igatpuri', 'MAH'),
(401, 'Ilford', 'UK'),
(402, 'Indore', 'MDP'),
(403, 'Istanbul', 'TUR'),
(404, 'Jabalpur', 'MDP'),
(405, 'Ja-Ela', 'SRL'),
(406, 'Jagalpur', 'CTG'),
(407, 'Jagatsinghpur', 'ORS'),
(408, 'Jaipur', 'RAJ'),
(409, 'Jaisalmer', 'RAJ'),
(410, 'Jakarta', 'ORS'),
(411, 'Jalalabad', 'UTP'),
(412, 'Jalandhar', 'PNJ'),
(413, 'Jalgaon', 'MAH'),
(414, 'Jalna', 'MAH'),
(415, 'Jalor', 'RAJ'),
(416, 'Jammalamadugu', 'ADP'),
(417, 'Jammu', 'JMK'),
(418, 'Jamnagar', 'GUJ'),
(419, 'Jamshedpur', 'JHR'),
(420, 'Janjgir', 'CTG'),
(421, 'Jaora', 'MDP'),
(422, 'Jawhar', 'MAH'),
(423, 'Jeddah', 'SAU'),
(424, 'Jessami', 'MAN'),
(425, 'Jhabua', 'MDP'),
(426, 'Jhajjar', 'HAR'),
(427, 'Jhalawar', 'RAJ'),
(428, 'Jhansi', 'UTP'),
(429, 'Jharsuguda', 'ORS'),
(430, 'Jhunjhunun', 'RAJ'),
(431, 'Jind', 'HAR'),
(432, 'Jodhpur', 'RAJ'),
(433, 'Jogeshwari', 'MAH'),
(434, 'Jogipet', 'ADP'),
(435, 'Johnnesburg', 'SUA'),
(436, 'Joshimath', 'UTR'),
(437, 'Joshpur Nagar', 'CTG'),
(438, 'Jowai', 'MEG'),
(439, 'Juba', 'JUB'),
(440, 'Junagadh', 'GUJ'),
(441, 'Kachchh', 'GUJ'),
(442, 'Kachhauna', 'UTP'),
(443, 'Kadaiyanallur', 'KER'),
(444, 'Kadapa', 'ADP'),
(445, 'Kadmat', 'LAK'),
(446, 'Kaewar', 'KRT'),
(447, 'Kaij', 'MAH'),
(448, 'Kaina', 'MAN'),
(449, 'Kaithal', 'HAR'),
(450, 'Kakarva', 'GUJ'),
(451, 'Kakching', 'MAN'),
(452, 'Kakching Khunow', 'MAN'),
(453, 'Kalaburagi', 'KRT'),
(454, 'Kalakkadu', 'KER'),
(455, 'Kalesar', 'HAR'),
(456, 'Kalimpong', 'WTB'),
(457, 'Kallar', 'KER'),
(458, 'Kalliyanapandal', 'KER'),
(459, 'Kalpeni', 'LAK'),
(460, 'Kalpetta', 'KER'),
(461, 'Kalupur', 'GUJ'),
(462, 'Kalur', 'KRT'),
(463, 'Kalwa', 'MAH'),
(464, 'Kalyan', 'MAH'),
(465, 'Kambam', 'KER'),
(466, 'Kambi', 'MAN'),
(467, 'Kamjong', 'MAN'),
(468, 'Kampala', 'UG'),
(469, 'Kamrej', 'GUJ'),
(470, 'Kanchipuram', 'TML'),
(471, 'Kandhar', 'KAN'),
(472, 'Kandukur', 'ADP'),
(473, 'Kangayam', 'KER'),
(474, 'Kangpokpi', 'MAN'),
(475, 'Kangr Valley', 'HMP'),
(476, 'Kanhmun', 'MIZ'),
(477, 'Kanniyakumari', 'KER'),
(478, 'Kannur', 'KER'),
(479, 'Kanpur', 'UTP'),
(480, 'Kansari', 'GUJ'),
(481, 'Kanyakumari', 'TML'),
(482, 'Kapurthala', 'PNJ'),
(483, 'Karachi', 'PAK'),
(484, 'Karad', 'MAH'),
(485, 'Karaikal', 'TML'),
(486, 'Karaikudi', 'TML'),
(487, 'Karala', 'DEL'),
(488, 'Karauli', 'RAJ'),
(489, 'Kargil', 'JMK'),
(490, 'Kargol', 'MDP'),
(491, 'Karhi', 'MDP'),
(492, 'Karimnagar', 'ADP'),
(493, 'Karjat', 'MAH'),
(494, 'Karmala', 'MAH'),
(495, 'Karnal', 'HAR'),
(496, 'Karol Bagh', 'DEL'),
(497, 'Kartoum', 'KTO'),
(498, 'Karur', 'KER'),
(499, 'Kasargod', 'KER'),
(500, 'Kasauli', 'HMP'),
(501, 'Kasauni', 'UTP'),
(502, 'Kasom Khullen', 'MAN'),
(503, 'Kasong', 'MAN'),
(504, 'Katang', 'MAN'),
(505, 'Katni', 'MDP'),
(506, 'Kavaratti', 'LAK'),
(507, 'Kayamkulam', 'KER'),
(508, 'Keibul Lamjao', 'MAN'),
(509, 'Kendujhargarh', 'ORS'),
(510, 'Keshod', 'GUJ'),
(511, 'Khachrod', 'MDP'),
(512, 'Khajjair', 'HMP'),
(513, 'Khalapur', 'MAH'),
(514, 'Khalilabad', 'UTP'),
(515, 'Khambhat', 'GUJ'),
(516, 'Khangkhul Cove', 'MAN'),
(517, 'Khar', 'MAH'),
(518, 'Kharghar', 'MAH'),
(519, 'Khargon', 'MDP'),
(520, 'Kharsia', 'CTG'),
(521, 'Kharsundi', 'MAH'),
(522, 'Khed', 'MAH'),
(523, 'Kheda', 'GUJ'),
(524, 'Khommom', 'ADP'),
(525, 'Khonghompat', 'MAN'),
(526, 'Khongiom', 'MAN'),
(527, 'Khonoma', 'NAG'),
(528, 'Khopoli', 'MAH'),
(529, 'Khoupum Valley', 'MAN'),
(530, 'Khudengthabi', 'MAN'),
(531, 'Kinnaur', 'HMP'),
(532, 'Kirkee', 'MAH'),
(533, 'Kishanganj', 'BHR'),
(534, 'Kochi', 'KER'),
(535, 'Kodaikanal', 'TML'),
(536, 'Kodarma', 'JHR'),
(537, 'Kohima', 'NAG'),
(538, 'Kolam', 'KER'),
(539, 'Kolar', 'KRT'),
(540, 'Kolasib', 'MIZ'),
(541, 'Kolhapur', 'MAH'),
(542, 'Kolkata', 'WTB'),
(543, 'Kollencode', 'KER'),
(544, 'Kondapaka', 'ADP'),
(545, 'Kopargaon', 'MAH'),
(546, 'Koppal', 'KRT'),
(547, 'Koraput', 'ORS'),
(548, 'Kosi', 'UTP'),
(549, 'Kota', 'RAJ'),
(550, 'Kotamangalam', 'KER'),
(551, 'Kothaguder', 'ADP'),
(552, 'Kottarkara', 'KER'),
(553, 'Kottayam', 'KER'),
(554, 'Kovilpatti', 'KER'),
(555, 'Koyaram', 'KER'),
(556, 'Kozhencherri', 'KER'),
(557, 'Kozhikode', 'KER'),
(558, 'Krishtwar', 'JMK'),
(559, 'Kuchaman', 'RAJ'),
(560, 'Kuchesar', 'UTP'),
(561, 'Kudal', 'MAH'),
(562, 'Kufri', 'HMP'),
(563, 'Kukshi', 'MDP'),
(564, 'Kullanchavadi', 'TML'),
(565, 'Kullu Manali', 'HMP'),
(566, 'Kumbhraj', 'MDP'),
(567, 'Kumily', 'KER'),
(568, 'Kunkuri', 'CTG'),
(569, 'Kurkhera', 'MAH'),
(570, 'Kurnool', 'ADP'),
(571, 'Kurud', 'CTG'),
(572, 'Kurukshetra', 'HAR'),
(573, 'Kushinagar', 'UTP'),
(574, 'Kutch', 'GUJ'),
(575, 'Kuttlam', 'KER'),
(576, 'Kuttyadi', 'KER'),
(577, 'Kuwait', 'KUW'),
(578, 'Kuzithurai', 'KER'),
(579, 'Kwakta', 'MAN'),
(580, 'Ladakh', 'JMK'),
(581, 'Lahore', 'PAK'),
(582, 'Lahori Gate', 'DEL'),
(583, 'Latur', 'MAH'),
(584, 'Lawngtlai', 'MIZ'),
(585, 'Laxmeshwaer', 'KRT'),
(586, 'Le Havre', 'FRA'),
(587, 'Leh', 'JMK'),
(588, 'Leicester', 'UK'),
(589, 'Lepakshi', 'ADP'),
(590, 'Lirupur', 'TML'),
(591, 'Lisbon', 'LIS'),
(592, 'Litan', 'MAN'),
(593, 'Lohardaga', 'JHR'),
(594, 'Longwood', 'FLO'),
(595, 'Lormi', 'CTG'),
(596, 'Lubumbashi', 'CG'),
(597, 'Lucknow', 'UTP'),
(598, 'Ludhiana', 'PNJ'),
(599, 'Ludwa', 'GUJ'),
(600, 'Luhar', 'GUJ'),
(601, 'Lungle', 'MIZ'),
(602, 'Lusaka', 'ZAM'),
(603, 'Madikeri', 'KER'),
(604, 'Madurai', 'TML'),
(605, 'Magadna', 'BHR'),
(606, 'Mahaboobnagar', 'ADP'),
(607, 'Mahabudnagar', 'ADP'),
(608, 'Mahad', 'MAH'),
(609, 'Mahagaon', 'MAH'),
(610, 'Mahendragarh', 'HAR'),
(611, 'Maheshwar', 'MDP'),
(612, 'Mahidpur', 'MDP'),
(613, 'Majalgaon', 'MAH'),
(614, 'Majigam', 'GUJ'),
(615, 'Malappuram', 'KER'),
(616, 'Malkangiri', 'ORS'),
(617, 'Malkapur', 'MAH'),
(618, 'Malsiras', 'MAH'),
(619, 'Malwa', 'MDP'),
(620, 'Mamallapuram', 'TML'),
(621, 'Mamit', 'MIZ'),
(622, 'Manama', 'BH'),
(623, 'Mandalay Region', 'MYA'),
(624, 'Mandi', 'HMP'),
(625, 'Mandla', 'MDP'),
(626, 'Mandsaur', 'MDP'),
(627, 'Mandvi', 'GUJ'),
(628, 'Mandya', 'KRT'),
(629, 'Mangalore', 'KRT'),
(630, 'Mangan', 'SIK'),
(631, 'Mannarakkad', 'KER'),
(632, 'Mansa', 'PNJ'),
(633, 'Mapasa', 'GOA'),
(634, 'Maram', 'MAN'),
(635, 'Marcara', 'KRT'),
(636, 'Mardan', 'PAK'),
(637, 'Margao', 'GOA'),
(638, 'Marpara', 'MIZ'),
(639, 'Masinaguri', 'TML'),
(640, 'Mathura', 'UTP'),
(641, 'Mattanur', 'KER'),
(642, 'Mauritius', 'UK'),
(643, 'Mayang Imphal', 'MAN'),
(644, 'Mayiladuthurai', 'TML'),
(645, 'Meerut', 'UTP'),
(646, 'Mehakar', 'MAH'),
(647, 'Mehsana', 'GUJ'),
(648, 'Melbourne', 'VIC'),
(649, 'Melilla Spain', 'MEL'),
(650, 'Mersin', 'OPE'),
(651, 'Merta', 'RAJ'),
(652, 'Mesa', 'ARZ'),
(653, 'Metra', 'RAJ'),
(654, 'Mettupalaim', 'KER'),
(655, 'Mettupalayam', 'TML'),
(656, 'Mettur', 'KER'),
(657, 'Mewat', 'HAR'),
(658, 'Minicoy', 'LAK'),
(659, 'Minnakkal', 'TML'),
(660, 'Mirzapur', 'UTP'),
(661, 'Modasa', 'GUJ'),
(662, 'Moga', 'PNJ'),
(663, 'Moirang', 'MAN'),
(664, 'Mokochung', 'NAG'),
(665, 'Mombasa', 'KEN'),
(666, 'Moo', 'MAN'),
(667, 'Moradabad', 'UTP'),
(668, 'Morbi', 'GUJ'),
(669, 'Moreh', 'MAN'),
(670, 'Morena', 'MDP'),
(671, 'Mormugoa', 'GOA'),
(672, 'Morni', 'HAR'),
(673, 'Morsi', 'MAH'),
(674, 'Mouritius', 'POL'),
(675, 'Mudumalai', 'TML'),
(676, 'Muktsar', 'PNJ'),
(677, 'Mulund', 'MAH'),
(678, 'Mumbai', 'MAH'),
(679, 'Mundra', 'GUJ'),
(680, 'Munnar', 'KER'),
(681, 'Muscat', 'OMN'),
(682, 'Mussoorie', 'UTR'),
(683, 'Muvattupuzha', 'KER'),
(684, 'Muzaffarnagar', 'UTP'),
(685, 'Muzaffarpur', 'BHR'),
(686, 'Mysore', 'KRT'),
(687, 'Nabarangapur', 'ORS'),
(688, 'Nadiad', 'GUJ'),
(689, 'Nagarhole', 'KRT'),
(690, 'Nagari Khulen', 'MAN'),
(691, 'Nagarjuna Konda', 'ADP'),
(692, 'Nagarjuna Sagar', 'ADP'),
(693, 'Nagaur', 'RAJ'),
(694, 'Nagercoil', 'TML'),
(695, 'Nagpur', 'MAH'),
(696, 'Nahan', 'HMP'),
(697, 'Nainital', 'UTR'),
(698, 'Nairobi', 'KEN'),
(699, 'Nalagarh', 'HMP'),
(700, 'Nalanda', 'BHR'),
(701, 'Nalgonda', 'ADP'),
(702, 'Namakkal', 'TML'),
(703, 'Nambol Waithoy', 'MAN'),
(704, 'Namchi', 'SIK'),
(705, 'Nanded', 'MAH'),
(706, 'Nandgaon', 'MAH'),
(707, 'Nandurbar', 'MAH'),
(708, 'Nanguneri', 'KER'),
(709, 'Nanjangud', 'KER'),
(710, 'Naranamangalam', 'TML'),
(711, 'Narela', 'DEL'),
(712, 'Nargund', 'KRT'),
(713, 'Narol', 'GUJ'),
(714, 'Narsimhapur', 'MDP'),
(715, 'Nashik', 'MAH'),
(716, 'Navi Mumbai', 'MAH'),
(717, 'Navsari', 'GUJ'),
(718, 'Nawanshshar', 'PNJ'),
(719, 'Nayagarh', 'ORS'),
(720, 'Nazareth', 'KER'),
(721, 'Nedumangadu', 'KER'),
(722, 'Neemach', 'MDP'),
(723, 'Nellore', 'ADP'),
(724, 'New Brunswick Ave', 'EBR'),
(725, 'New Delhi', 'DEL'),
(726, 'New Tusem', 'MAN'),
(727, 'New York', 'NJ'),
(728, 'Newark', 'CLF'),
(729, 'Neyyattinkara', 'KER'),
(730, 'Ngopa', 'MIZ'),
(731, 'Nimach', 'MDP'),
(732, 'Nimbahera', 'RAJ'),
(733, 'Ningthoukhong', 'MAN'),
(734, 'Nizamabad', 'ADP'),
(735, 'Noida', 'UTP'),
(736, 'None', 'MAN'),
(737, 'Nongdom', 'MAN'),
(738, 'Northampton', 'UK'),
(739, 'Nuaparha', 'ORS'),
(740, 'Nungba', 'MAN'),
(741, 'Obispo Ave', 'CLF'),
(742, 'Omalur', 'KER'),
(743, 'Ongole', 'ADP'),
(744, 'Ontario', 'TOR'),
(745, 'Ooty', 'TML'),
(746, 'Osaka-Fu', 'OSK'),
(747, 'Osmanabad', 'MAH'),
(748, 'Pachora', 'MAH'),
(749, 'Padagiri', 'KER'),
(750, 'Padmanabhapuram', 'KER'),
(751, 'Pahalgam', 'JMK'),
(752, 'Painavu', 'KER'),
(753, 'Palakkad', 'KER'),
(754, 'Palamau', 'BHR'),
(755, 'Palampur', 'HMP'),
(756, 'Palamu', 'JHR'),
(757, 'Palani', 'KER'),
(758, 'Palarivattom', 'KER'),
(759, 'Palayankotai', 'KER'),
(760, 'Palel', 'MAN'),
(761, 'Palghar', 'MAH'),
(762, 'Pali', 'RAJ'),
(763, 'Palladam', 'KER'),
(764, 'Panaji', 'GOA'),
(765, 'Panakudi', 'KER'),
(766, 'Panchkula', 'HAR'),
(767, 'Panchmahal', 'GUJ'),
(768, 'Pandariya', 'CTG'),
(769, 'Panipat', 'HAR'),
(770, 'Panna', 'MDP'),
(771, 'Panthawada', 'GUJ'),
(772, 'Panvel', 'MAH'),
(773, 'Paomata', 'MAN'),
(774, 'Paralekhemundi', 'ORS'),
(775, 'Paravur', 'KER'),
(776, 'Parawanoo', 'HMP'),
(777, 'Parbhani', 'MAH'),
(778, 'Parbung', 'MAN'),
(779, 'Parva', 'MIZ'),
(780, 'Patan', 'GUJ'),
(781, 'Pathan Kot', 'HMP'),
(782, 'Pathanamthitta', 'KER'),
(783, 'Pathanapuram', 'KER'),
(784, 'Pathankot', 'PNJ'),
(785, 'Patiala', 'PNJ'),
(786, 'Patna', 'BHR'),
(787, 'Patnitop', 'JMK'),
(788, 'Pattadakal', 'KRT'),
(789, 'Pattiputra', 'BHR'),
(790, 'Pedum Padam', 'JMK'),
(791, 'Peermade', 'KER'),
(792, 'Pehowa', 'HAR'),
(793, 'Pen', 'MAH'),
(794, 'Penang', 'MAL'),
(795, 'Pendra', 'CTG'),
(796, 'Pengei', 'MAN'),
(797, 'Penjaringan', 'JAK'),
(798, 'Perak', 'MAL'),
(799, 'Pernem', 'GOA'),
(800, 'Perumpavur', 'KER'),
(801, 'Petalinh Jaya', 'SEL'),
(802, 'Phubala', 'MAN'),
(803, 'Phulabani', 'ORS'),
(804, 'Phungyar', 'MAN'),
(805, 'Pinjar', 'HAR'),
(806, 'Pithora', 'CTG'),
(807, 'Pithoragarh', 'UTP'),
(808, 'Plympton', 'UK'),
(809, 'Polachi', 'KER'),
(810, 'Ponda', 'GOA'),
(811, 'Ponnani', 'KER'),
(812, 'Porbandar', 'GUJ'),
(813, 'Port Louis', 'POR'),
(814, 'Pragpur', 'HMP'),
(815, 'Pratapgad', 'RAJ'),
(816, 'Pudhadhari Mata', 'CTG'),
(817, 'Puliangudi', 'KER'),
(818, 'Punalur', 'KER'),
(819, 'Pune', 'MAH'),
(820, 'Punjur', 'KER'),
(821, 'Puri', 'ORS'),
(822, 'Puttaparthi', 'ADP'),
(823, 'Puttur', 'KER'),
(824, 'Puvar', 'KER'),
(825, 'Qandar', 'QAN'),
(826, 'Qatar', 'DOH'),
(827, 'Quepem', 'GOA'),
(828, 'Quetta', 'PAK'),
(829, 'Quilandi', 'KER'),
(830, 'Rahaway', 'NJ'),
(831, 'Raichur', 'KRT'),
(832, 'Raigad', 'MAH'),
(833, 'Raigarh', 'CTG'),
(834, 'Raipur', 'CTG'),
(835, 'Raisen', 'MDP'),
(836, 'Raj Gamar', 'CTG'),
(837, 'Raj Samand', 'RAJ'),
(838, 'Rajapalayam', 'TML'),
(839, 'Rajgarh', 'MDP'),
(840, 'Rajim', 'CTG'),
(841, 'Rajkot', 'GUJ'),
(842, 'Rajpur', 'GUJ'),
(843, 'Rajpura', 'MAH'),
(844, 'Ramanagaram', 'KRT'),
(845, 'Rameswaram', 'TML'),
(846, 'Ramgarh ', 'UTR'),
(847, 'Rampur', 'UTP'),
(848, 'Ranchi', 'JHR'),
(849, 'Rangdum', 'JMK'),
(850, 'Rathuabad', 'UTR'),
(851, 'Ratlam', 'MDP'),
(852, 'Ratnagiri', 'MAH'),
(853, 'Rawalpindi', 'PAK'),
(854, 'Rayagada', 'ORS'),
(855, 'Rewa', 'MDP'),
(856, 'Rewari', 'HAR'),
(857, 'Rhidzong', 'JMK'),
(858, 'Rhotan Pass', 'HMP'),
(859, 'Riche Terre', 'POR'),
(860, 'Rishikesh', 'UTR'),
(861, 'Riyadh', 'SAU'),
(862, 'Rohtak', 'HAR'),
(863, 'Ropar', 'PNJ'),
(864, 'Rudrapur', 'UTP'),
(865, 'Rumtek', 'SIK'),
(866, 'Rupshu', 'JMK'),
(867, 'Sabarimala', 'KER'),
(868, 'Sagar', 'KRT'),
(869, 'Saharanpur', 'UTP'),
(870, 'Sahibganj', 'JHR'),
(871, 'Saiha', 'MIZ'),
(872, 'Saikul', 'MAN'),
(873, 'Sakti', 'CTG'),
(874, 'Salcete', 'GOA'),
(875, 'Salem', 'TML'),
(876, 'Samepur Badli', 'DEL'),
(877, 'San Jose', 'CLF'),
(878, 'Sandhila', 'UTP'),
(879, 'Sangli', 'MAH'),
(880, 'Sangmner', 'MAH'),
(881, 'Sangole', 'MAH'),
(882, 'Sangrur', 'PNJ'),
(883, 'Sanguaem', 'GOA'),
(884, 'Sani', 'JMK'),
(885, 'Sankarankovil', 'KER'),
(886, 'Santhal Pargana', 'JHR'),
(887, 'Saranath', 'UTP'),
(888, 'Sarangarh', 'CTG'),
(889, 'Sarasvati', 'UTP'),
(890, 'Sargodha', 'PAK'),
(891, 'Sasaran', 'BHR'),
(892, 'Satana', 'MAH'),
(893, 'Satara', 'MAH'),
(894, 'Satari', 'GOA'),
(895, 'Satna', 'MDP'),
(896, 'Saurashtra', 'GUJ'),
(897, 'Savanur', 'KRT'),
(898, 'Sawas Madhopur', 'RAJ'),
(899, 'Seattle', 'WAS'),
(900, 'Sehore', 'MDP'),
(901, 'Sekmain', 'MAN'),
(902, 'Sekmoi', 'MAN'),
(903, 'Selangor', 'MAL'),
(904, 'Senapati', 'MAN'),
(905, 'Sendhva', 'MDP'),
(906, 'Sendra', 'MAN'),
(907, 'Seoni', 'MDP'),
(908, 'Serchhip', 'MIZ'),
(909, 'Shahad', 'MAH'),
(910, 'Shahapur', 'MAH'),
(911, 'Shahdol', 'MDP'),
(912, 'Shahjahnpur', 'UTP'),
(913, 'Shahpur', 'GUJ'),
(914, 'Shajapur', 'MDP'),
(915, 'Shankarampet', 'ADP'),
(916, 'Shantiniketan', 'WTB'),
(917, 'Sharjah', 'UAE'),
(918, 'Sheoganj', 'RAJ'),
(919, 'Sheopur', 'MDP'),
(920, 'Shihori', 'GUJ'),
(921, 'Shikra', 'GUJ'),
(922, 'Shillong', 'MEG'),
(923, 'Shimla', 'HMP'),
(924, 'Shimoga', 'KRT'),
(925, 'Shinjuku', 'TOK'),
(926, 'Shirpur', 'MAH'),
(927, 'Shivasamudra', 'KRT'),
(928, 'Shivpuri', 'MDP'),
(929, 'Shravanabelagola', 'KRT'),
(930, 'Shuaiba', 'KUW'),
(931, 'Shuwaikh', 'KUW'),
(932, 'Siddipet', 'TLG'),
(933, 'Sidhi', 'MDP'),
(934, 'Sidhpur', 'GUJ'),
(935, 'Sikandara', 'UTP'),
(936, 'Sikar', 'RAJ'),
(937, 'Sikri', 'UTP'),
(938, 'Siliguri', 'WTB'),
(939, 'Silvassa', 'DNH'),
(940, 'Simga', 'CTG'),
(941, 'Singapore', 'SIN'),
(942, 'Singhat', 'MAN'),
(943, 'Sinnar', 'MAH'),
(944, 'Sirancha', 'MAH'),
(945, 'Sirohi', 'RAJ'),
(946, 'Siroi', 'MAN'),
(947, 'Sironcha', 'MAH'),
(948, 'Sirpur', 'CTG'),
(949, 'Sirsa', 'HAR'),
(950, 'Sirsi', 'KRT'),
(951, 'Sivakasi', 'KER'),
(952, 'Sivasamudram', 'KER'),
(953, 'Sohar', 'OMN'),
(954, 'Sohna', 'HAR'),
(955, 'Sokhad', 'GUJ'),
(956, 'Solan', 'HMP'),
(957, 'Solapur', 'MAH'),
(958, 'Somnathpur', 'KRT'),
(959, 'Sonapur', 'ORS'),
(960, 'Sonipat', 'HAR'),
(961, 'Sonmarg', 'JMK'),
(962, 'Sousse', 'NO'),
(963, 'Spitok', 'JMK'),
(964, 'Srikakalam', 'ADP'),
(965, 'Srinagar', 'JMK'),
(966, 'Sringeri', 'KRT'),
(967, 'Srirangapatna', 'KRT'),
(968, 'Srivaikuntam', 'KER'),
(969, 'Stockholm', 'SWE'),
(970, 'Stongde', 'JMK'),
(971, 'Sugnu', 'MAN'),
(972, 'Sukhpar - Bhuj', 'GUJ'),
(973, 'Sultanate', 'OMN'),
(974, 'Sultanpur', 'UTP'),
(975, 'Surajkhand', 'HAR'),
(976, 'Surajpur', 'CTG'),
(977, 'Surat', 'GUJ'),
(978, 'Surendranagar', 'GUJ'),
(979, 'Swami Malai', 'TML'),
(980, 'Switzerland', 'ZUR'),
(981, 'Sydney', 'NSW'),
(982, 'Tahadula Dam', 'CTG'),
(983, 'Talacauveri', 'KRT'),
(984, 'Talod', 'GUJ'),
(985, 'Tamatave', 'TOA'),
(986, 'Tambati', 'MAH'),
(987, 'Tamei', 'MAN'),
(988, 'Tamenglong', 'MAN'),
(989, 'Tanambao', 'MDG'),
(990, 'Tangutur', 'ADP'),
(991, 'Tanzania', 'DOD'),
(992, 'Tarapur', 'GUJ'),
(993, 'Tengnoupal', 'MAN'),
(994, 'Teni', 'KER'),
(995, 'Tenkasi', 'KER'),
(996, 'Tenmala', 'KER'),
(997, 'Thalassery', 'KER'),
(998, 'Thane', 'MAH'),
(999, 'Thanjavur', 'TML'),
(1000, 'Thanlon', 'MAN'),
(1001, 'Tharad', 'GUJ'),
(1002, 'Thekkadi', 'KER'),
(1003, 'Thiruvalla', 'KER'),
(1004, 'Thoubal', 'MAN'),
(1005, 'Thrissur', 'KER'),
(1006, 'Tikamgarh', 'MDP'),
(1007, 'Tilbury', 'UK'),
(1008, 'Timphal', 'MAN'),
(1009, 'Tipaimukh', 'MAN'),
(1010, 'Tiruchchendur', 'KER'),
(1011, 'Tiruchengodu', 'KER'),
(1012, 'Tiruchirappalli', 'TML'),
(1013, 'Tirumangalam', 'KER'),
(1014, 'Tirunelveli', 'KER'),
(1015, 'Tirupati', 'ADP'),
(1016, 'Tisaiyanvilai', 'KER'),
(1017, 'Titwala', 'MAH'),
(1018, 'Toamasina', 'MDG'),
(1019, 'Tonk', 'RAJ'),
(1020, 'Toronto', 'CAN'),
(1021, 'Tousem', 'MAN'),
(1022, 'Tulear', 'MDG'),
(1023, 'Tumkur', 'KRT'),
(1024, 'Tumsar', 'MAH'),
(1025, 'Tura', 'MEG'),
(1026, 'Turkmenistan', 'IR'),
(1027, 'Tuticorin', 'KER'),
(1028, 'Udaipur', 'RAJ'),
(1029, 'Udgir', 'MAH'),
(1030, 'Udumalaippettai', 'KER'),
(1031, 'Udupi', 'KRT'),
(1032, 'Uha', 'HMP'),
(1033, 'Ujjain', 'MDP'),
(1034, 'Ukhrule', 'MAN'),
(1035, 'Ulhas Nagar', 'MAH'),
(1036, 'Umargam', 'GUJ'),
(1037, 'Umaria', 'MDP'),
(1038, 'Umbergaon', 'GUJ'),
(1039, 'Umm Qasr', 'IRK'),
(1040, 'Umreth', 'GUJ'),
(1041, 'Unja', 'GUJ'),
(1042, 'Unjha', 'GUJ'),
(1043, 'Upanga', 'TAN'),
(1044, 'Upleta', 'GUJ'),
(1045, 'Uppugundur', 'ADP'),
(1046, 'Uran', 'MAH'),
(1047, 'Usmanabad', 'MAH'),
(1048, 'Uthamapalayam', 'KER'),
(1049, 'Uttarkashi', 'UTR'),
(1050, 'Vadakara', 'KER'),
(1051, 'Vadodara', 'GUJ'),
(1052, 'Vaikom', 'KER'),
(1053, 'Vairengte', 'MIZ'),
(1054, 'Vaisali', 'BHR'),
(1055, 'Valliyur', 'KER'),
(1056, 'Valsad', 'GUJ'),
(1057, 'Vanakaner', 'GUJ'),
(1058, 'Vanlaipha', 'MIZ'),
(1059, 'Vapi', 'GUJ'),
(1060, 'Varanasi', 'UTP'),
(1061, 'Varkala', 'KER'),
(1062, 'Vasai', 'MAH'),
(1063, 'Vasco Da Gama', 'GOA'),
(1064, 'Vashakhapatnam', 'ADP'),
(1065, 'Vashi', 'MAH'),
(1066, 'Veseitlang', 'MIZ'),
(1067, 'Vidisha', 'MDP'),
(1068, 'Vijapur', 'GUJ'),
(1069, 'Vijayawada', 'ADP'),
(1070, 'Virar', 'MAH'),
(1071, 'Virarajendrapet', 'KER'),
(1072, 'Virudunagar', 'KER'),
(1073, 'Vishnupur', 'WTB'),
(1074, 'Visnagar', 'GUJ'),
(1075, 'Vrindavan', 'UTP'),
(1076, 'Vyara', 'GUJ'),
(1077, 'Warangal', 'KRT'),
(1078, 'Waraseoni', 'MDP'),
(1079, 'Wardha', 'MAH'),
(1080, 'Warora', 'MAH'),
(1081, 'Washim', 'MAH'),
(1082, 'Washinton', 'WAS'),
(1083, 'West Nimar', 'MDP'),
(1084, 'Woodridge Il', 'SUI'),
(1085, 'Worangat', 'ADP'),
(1086, 'Yadgir', 'KRT'),
(1087, 'Yamunanagar', 'HAR'),
(1088, 'Yavatmal', 'MAH'),
(1089, 'Yercaud', 'TML'),
(1090, 'Yernakulam', 'KER'),
(1091, 'Yetapalli', 'MAH'),
(1092, 'Yongon', 'MYA'),
(1093, 'Zangla', 'JMK'),
(1094, 'Zanskar', 'JMK'),
(1095, 'Zongkhul', 'JMK');

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
(44, 'COMP_TYPE', 'PVT', 'Private', '5', 'Y', '0', 'ADMIN', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `comp_id` int(11) NOT NULL,
  `comp_code` int(100) NOT NULL,
  `comp_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `addr3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `std_code` int(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(150) DEFAULT NULL,
  `gstin` varchar(150) DEFAULT NULL,
  `fassano` varchar(150) DEFAULT NULL,
  `cinno` varchar(150) DEFAULT NULL,
  `panno` varchar(150) DEFAULT NULL,
  `tanno` varchar(150) DEFAULT NULL,
  `lsttinpinno` varchar(100) DEFAULT NULL,
  `cstno` varchar(150) DEFAULT NULL,
  `coregnno` varchar(150) DEFAULT NULL,
  `coregndate` datetime DEFAULT NULL,
  `druglicno` varchar(150) DEFAULT NULL,
  `importexport` varchar(150) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `t_user` varchar(100) DEFAULT NULL,
  `t_date` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`comp_id`, `comp_code`, `comp_name`, `type`, `addr1`, `addr2`, `addr3`, `city`, `state`, `country`, `std_code`, `phone`, `mobile`, `gstin`, `fassano`, `cinno`, `panno`, `tanno`, `lsttinpinno`, `cstno`, `coregnno`, `coregndate`, `druglicno`, `importexport`, `status`, `created_by`, `created_date`, `t_user`, `t_date`, `updated_at`, `created_at`) VALUES
(1, 1, 'Peacock Soft-tech Solution', 'PVTLTD', '6, Mall Plaza,Near Pawar Hospital', 'Karjat Road, Subhash Nagar', 'Badlapur East', '998', 'MAH', 'IND', 22, '2715846', '8879320334', '27ATDPG8101C1Z9', '123456', '78922000', 'ATDPG8101C', '9514236', '6541201', '65214018', '875120349', '2022-07-01 00:00:00', '137514209', '654102479', 'Y', 'admin', '2022-08-05 03:54:20', 'admin', '2022-08-05 03:54:20', NULL, NULL),
(2, 2, 'Peacock Infotech', 'PVTLTD', '6, Mall Plaza,Near Pawar Hospital', 'Karjat Road, Subhash Nagar', 'Badlapur East', '133', 'MDP', 'IND', 2355, '233527', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', 'Y', 'admin', '2022-08-13 11:54:33', 'admin', '2022-08-13 11:54:33', NULL, NULL),
(13, 41, 'Sicher Infotech', 'PVTLTD', 'Chiplun', 'Chiplun', 'Chiplun', '852', 'MAH', 'IND', 2355, '233527', '9420964141', '96255SSS', '96521114', '5233666', '59871222', '3201555', '2015588', '96521000', '951lll', '2022-08-04 00:00:00', '202222', '9652100', 'Y', 'admin', '2022-08-15 10:08:28', 'admin', '2022-08-15 10:08:28', NULL, NULL),
(14, 85, 'Parth ', 'PVTLTD', 'Chp', 'Chip', '', '6', 'ADP', 'IND', 0, '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', 'Y', 'admin', '2022-08-15 10:50:41', 'admin', '2022-08-15 10:50:41', NULL, NULL),
(18, 33, 'thiry three', 'PROP', 'ttt', NULL, 'tt', '11', 'TRI', 'IND', 555, '9921509424', '958658885555', '5886699', '58666', '58966', 'fsdfsd8858', '8595fgd', 'dg', '15588', '58965', '2022-09-06 00:00:00', '455', 'fggg', '1', 'yogeerajborge@gmail.com', '2022-09-06 00:00:00', '', '2022-09-06 00:00:00', '2022-09-06 06:31:57', '2022-09-06 06:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `currency_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_code`, `country_name`, `currency_code`) VALUES
(1, 'AFG', 'Afghanistan', 'USD'),
(2, 'AFR', 'Africa', 'USD'),
(3, 'AGN', 'Argentina', 'USD'),
(4, 'AUS', 'Australia', 'USD'),
(5, 'BEN', 'Benin', 'USD'),
(6, 'BH', 'Bahrain', 'USD'),
(7, 'BRA', 'Brazil', 'USD'),
(8, 'BRU', 'Brunei', 'USD'),
(9, 'CAN', 'Canada', 'USD'),
(10, 'CHI', 'China', 'USD'),
(11, 'DJI', 'Djibouti', 'USD'),
(12, 'EJP', 'Egypt', 'GBP'),
(13, 'ENG', 'England', 'GBP'),
(14, 'FRA', 'France', 'USD'),
(15, 'GHA', 'Ghana', 'USD'),
(16, 'HON', 'Honkong', 'USD'),
(17, 'IND', 'India', 'INR'),
(18, 'IOS', 'Indonesia', 'USD'),
(19, 'IR', 'Iran', 'USD'),
(20, 'IRA', 'Iran', 'USD'),
(21, 'IRK', 'Iraq', 'USD'),
(22, 'ITL', 'Italy', 'USD'),
(23, 'JAP', 'Japan', 'USD'),
(24, 'KEN', 'Kenya', 'USD'),
(25, 'KUW', 'Kuwait', 'USD'),
(26, 'LEB', 'Lebanon', 'USD'),
(27, 'MAD', 'Madagascar', 'USD'),
(28, 'MAL', 'Malaysia', 'USD'),
(29, 'MAU', 'Mauritius', 'USD'),
(30, 'MDG', 'Madagascar', 'USD'),
(31, 'MG', 'Madagascar', 'USD'),
(32, 'MOR', 'Morocco', 'USD'),
(33, 'MOZ', 'Mozambique', 'USD'),
(34, 'MYA', 'Myanmar', 'USD'),
(35, 'MYN', 'Myanmar', 'USD'),
(36, 'NY', 'New York', 'USD'),
(37, 'NZ', 'Newzealand', 'USD'),
(38, 'OMN', 'Sultanate Of Oman', 'USD'),
(39, 'OSK', 'Osaka-Fu', 'INR'),
(40, 'PAK', 'Pakistan', 'USD'),
(41, 'POR', 'Portugal', 'USD'),
(42, 'QAT', 'Qatar', 'USD'),
(43, 'RUS', 'Russia', 'USD'),
(44, 'SAU', 'Saudi Arabia', 'USD'),
(45, 'SDN', 'Sudan', 'USD'),
(46, 'SEN', 'Senegal', 'USD'),
(47, 'SIE', 'Siera Leone', 'USD'),
(48, 'SOU', 'Southeast Asia', 'USD'),
(49, 'SRL', 'Shri Lanka', 'USD'),
(50, 'SUA', 'South Africa', 'USD'),
(51, 'SUD', 'South Sudan', 'USD'),
(52, 'SWE', 'Sweden', 'USD'),
(53, 'SWZ', 'Switzerland', 'USD'),
(54, 'TAI', 'Taiwan', 'USD'),
(55, 'TAN', 'Tanzania', 'USD'),
(56, 'THA', 'Thailand', 'USD'),
(57, 'TUN', 'Tunisia', 'USD'),
(58, 'TUR', 'Turkey', 'USD'),
(59, 'UAE', 'United Arab Emirates', 'USD'),
(60, 'UG', 'Uganda', 'USD'),
(61, 'UK', 'United Kingdom', 'USD'),
(62, 'UKR', 'Ukraine', 'USD'),
(63, 'USA', 'United States Of America', 'USD'),
(64, 'UZB', 'Uzbekistan', 'USD'),
(65, 'ZAM', 'Zambia', 'KWACHA');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `loc_id` int(110) NOT NULL,
  `loc_code` varchar(255) DEFAULT NULL,
  `loc_no` int(110) DEFAULT NULL,
  `loc_name` varchar(100) DEFAULT NULL,
  `comp_code` int(100) DEFAULT NULL,
  `status` varchar(110) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `state_code` varchar(50) DEFAULT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `gstin` varchar(100) DEFAULT NULL,
  `bank_code` varchar(50) DEFAULT NULL,
  `bankacno` varchar(255) DEFAULT NULL,
  `created_by` varchar(150) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `t_user` varchar(150) DEFAULT NULL,
  `t_date` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`loc_id`, `loc_code`, `loc_no`, `loc_name`, `comp_code`, `status`, `addr1`, `addr2`, `city`, `pin`, `phone_no`, `state_code`, `country_code`, `gstin`, `bank_code`, `bankacno`, `created_by`, `created_date`, `t_user`, `t_date`, `updated_at`, `created_at`) VALUES
(1, 'KMTH', 1, 'kamothe', NULL, '1', 'add1', 'add2', '3', '431133', '022533', 'PNJ', 'IND', '8555', 'sbi', '20555', 'yogeerajborge@gmail.com', NULL, NULL, NULL, '2022-09-07 07:13:21', '2022-09-07 07:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(500) DEFAULT NULL,
  `menu_route` varchar(500) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `menu_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `menu_route`, `menu_order`, `is_active`, `menu_parent`) VALUES
(1, 'Master', '#', 1, 1, 0),
(2, 'Company Master', 'company_master', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `param_id` int(11) NOT NULL,
  `param_code` varchar(100) NOT NULL,
  `param_value` varchar(255) NOT NULL,
  `param_desc` varchar(255) NOT NULL,
  `data_type` char(10) NOT NULL,
  `t_user` varchar(100) NOT NULL,
  `t_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`param_id`, `param_code`, `param_value`, `param_desc`, `data_type`, `t_user`, `t_date`) VALUES
(1, 'USE_CAT_SEQ', 'Y', 'USE CATEGORY SQUENCE', 'C', 'admin', '0000-00-00 00:00:00'),
(2, 'USE_SUB_CAT_SEQ', 'Y', 'USE SUB CATEGORY SQUENCE', 'C', 'admin', '0000-00-00 00:00:00'),
(3, 'APP_SRV_MULTI_BR', 'N', 'APPLICATION SERVER MULTI BRANCHES(Y/N)', 'C', 'admin', '0000-00-00 00:00:00'),
(4, 'APP_ST_DATE', '01-01-2020', 'APPLICATION START DATE', 'D', 'admin', '0000-00-00 00:00:00'),
(5, 'USE_ITEM_CODE_SEQ', 'Y', 'Use Item Code Auto Sequence', 'C', 'admin', '2022-08-07 20:03:10'),
(6, 'USE_VENDOR_SEQ', 'Y', 'Use Vendor Code Auto Sequence', 'C', 'admin', '2022-08-07 22:26:10'),
(7, 'USE_CUSTOMER_SEQ', 'Y', 'Use Customer Code Auto Sequence', 'C', 'admin', '2022-08-07 22:26:10'),
(8, 'USE_MANUFACT_SEQ', 'Y', 'Use Manufacturer Code Auto Sequence', 'C', 'admin', '2022-08-08 07:53:32'),
(9, 'USE_BRAND_SEQ', 'Y', 'Use Brand Code Auto Sequence', 'C', 'admin', '2022-08-08 07:53:32'),
(10, 'USE_PMT_SEQ', 'Y', 'Use Payment Code Auto Sequence', 'C', 'admin', '2022-08-08 18:21:10'),
(11, 'APP_SRV_MULTI_COMP', 'N', 'Application Server Multi Companies(Y/N)', 'C', 'Admin', '2022-08-13 08:07:38'),
(12, 'DEF_COMP', '1', 'Default Company', 'I', 'Admin', '2022-08-13 08:07:38'),
(13, 'DEF_LOC', 'KMTH', 'Default Location', 'C', 'Admin', '2022-08-13 08:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_code` varchar(100) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `state_type` varchar(100) NOT NULL,
  `gst_state_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_code`, `state_name`, `country_code`, `state_type`, `gst_state_code`) VALUES
(1, '0', 'All State', 'IND', 'STATE', '0'),
(2, 'ACK', 'Auckland', 'NZ', 'STATE', '0'),
(3, 'ADN', 'Andhrapradesh(New)', 'IND', 'STATE', '37'),
(4, 'ADP', 'Andhra Pradesh', 'IND', 'STATE', '28'),
(5, 'AFR', 'Melilla, Spain', 'AFR', 'STATE', '0'),
(6, 'ANN', 'Andaman And Nicobar Islands', 'IND', 'UT', '35'),
(7, 'ARP', 'Arunachal Pradesh', 'IND', 'STATE', '12'),
(8, 'ARZ', 'Arizona', 'USA', 'STATE', '0'),
(9, 'ASM', 'Assam', 'IND', 'STATE', '18'),
(10, 'ATL', 'Atlanta', 'USA', 'STATE', '0'),
(11, 'BE', 'Benin', 'BEN', 'STATE', '0'),
(12, 'BH', 'Bahrain', 'BH', 'STATE', '0'),
(13, 'BHR', 'Bihar', 'IND', 'STATE', '10'),
(14, 'BRA', 'Barzil', 'BRA', 'STATE', '0'),
(15, 'BRI', 'Brisbane', 'AUS', 'STATE', '0'),
(16, 'BRU', 'Brunei', 'ASI', 'STATE', '0'),
(17, 'CAN', 'Canada', 'CAN', 'STATE', '0'),
(18, 'CG', 'Democractic Republic Of Congo', 'AFR', 'STATE', '0'),
(19, 'CHG', 'Chandigarha', 'IND', 'UT', '4'),
(20, 'CHI', 'Chicago', 'USA', 'STATE', '0'),
(21, 'CHW', 'Changwat', 'THA', 'STATE', '0'),
(22, 'CLF', 'Celifornia', 'USA', 'STATE', '0'),
(23, 'CTG', 'Chhattisgarh', 'IND', 'STATE', '22'),
(24, 'DAK', 'Dakar', 'SEN', 'STATE', '0'),
(25, 'DDU', 'Daman And Diu', 'IND', 'UT', '25'),
(26, 'DEL', 'N.C.T. Of Delhi', 'IND', 'UT', '7'),
(27, 'DJI', 'Djibouti', 'DJI', 'STATE', '0'),
(28, 'DLW', 'Delaware', 'USA', 'STATE', '0'),
(29, 'DNH', 'Dadara And Nagar Haveli', 'IND', 'UT', '26'),
(30, 'DOD', 'Dodama', 'TAN', 'STATE', '0'),
(31, 'DOH', 'Doha', 'QAT', 'STATE', '0'),
(32, 'EBR', 'East Brunswick', 'USA', 'STATE', '0'),
(33, 'EDO', 'Benin', 'AFR', 'STATE', '0'),
(34, 'EJ', 'Egypt', 'EJP', 'STATE', '0'),
(35, 'FAI', 'Faisalabad', 'PAK', 'STATE', '0'),
(36, 'FLO', 'Florida', 'USA', 'STATE', '0'),
(37, 'FRA', 'France', 'FRA', 'STATE', '0'),
(38, 'FRE', 'Freetown', 'SIE', 'STATE', '0'),
(39, 'GA', 'Georgia', 'USA', 'STATE', '0'),
(40, 'GOA', 'Goa', 'IND', 'STATE', '30'),
(41, 'GUI', 'Guinee', 'AFR', 'STATE', '0'),
(42, 'GUJ', 'Gujarat', 'IND', 'STATE', '24'),
(43, 'HAR', 'Haryana', 'IND', 'STATE', '6'),
(44, 'HMP', 'Himachal Pradesh', 'IND', 'STATE', '2'),
(45, 'HON', 'Honkon', 'CHI', 'STATE', '0'),
(46, 'HOU', 'Houston', 'USA', 'STATE', '0'),
(47, 'IR', 'Iran', 'IR', 'STATE', '0'),
(48, 'IRA', 'Iran', 'IRA', 'STATE', '0'),
(49, 'IRK', 'Iraq', 'IRK', 'STATE', '0'),
(50, 'ITL', 'Italy', 'ITL', 'STATE', '0'),
(51, 'JAK', 'Jakarta', 'IOS', 'STATE', '0'),
(52, 'JHR', 'Jharkhand', 'IND', 'STATE', '20'),
(53, 'JMK', 'Jammu And Kashmir', 'IND', 'STATE', '1'),
(54, 'JOH', 'Johar', 'PAK', 'STATE', '0'),
(55, 'JUB', 'Juba', 'SUD', 'STATE', '0'),
(56, 'KAN', 'Kandhar', 'AFG', 'STATE', '0'),
(57, 'KAR', 'Karachi', 'PAK', 'STATE', '0'),
(58, 'KEN', 'Kenya', 'KEN', 'STATE', '0'),
(59, 'KER', 'Kerala', 'IND', 'STATE', '32'),
(60, 'KRT', 'Karnataka', 'IND', 'STATE', '29'),
(61, 'KTO', 'Kartoum', 'SDN', 'STATE', '0'),
(62, 'KUW', 'Kuwait', 'KUW', 'STATE', '0'),
(63, 'LAK', 'Lakshadweep', 'IND', 'UT', '31'),
(64, 'LEB', 'Lebanon', 'LEB', 'STATE', '0'),
(65, 'LIS', 'Lisbon', 'POR', 'STATE', '0'),
(66, 'LL', 'Illinois', 'USA', 'STATE', '0'),
(67, 'MAH', 'Maharashtra', 'IND', 'STATE', '27'),
(68, 'MAL', 'Malaysia', 'MAL', 'STATE', '0'),
(69, 'MAN', 'Manipur', 'IND', 'STATE', '14'),
(70, 'MAY', 'Maryland', 'USA', 'STATE', '0'),
(71, 'MDG', 'Madagascar', 'MDG', 'STATE', '0'),
(72, 'MDP', 'Madhya Pradesh', 'IND', 'STATE', '23'),
(73, 'MEG', 'Meghalaya', 'IND', 'STATE', '17'),
(74, 'MEL', 'Melilla', 'AFR', 'STATE', '0'),
(75, 'MIZ', 'Mizoram', 'IND', 'STATE', '15'),
(76, 'MOR', 'Morocco', 'MOR', 'STATE', '0'),
(77, 'MUK', 'Mukim Kilanas', 'BRU', 'STATE', '0'),
(78, 'MYA', 'Myanmar', 'MYN', 'STATE', '0'),
(79, 'NAG', 'Nagaland', 'IND', 'STATE', '13'),
(80, 'NJ', 'New Jersey', 'USA', 'STATE', '0'),
(81, 'NO', 'North Africa', 'TUN', 'STATE', '0'),
(82, 'NOC', 'North Carolina', 'USA', 'STATE', '0'),
(83, 'NSW', 'Nsw', 'AUS', 'STATE', '0'),
(84, 'OMN', 'Sultanate Of Oman', 'OMN', 'STATE', '0'),
(85, 'OPE', 'Opera', 'TUR', 'STATE', '0'),
(86, 'ORS', 'Orissa', 'IND', 'STATE', '21'),
(87, 'OSK', 'Osaka', 'JAP', 'STATE', '0'),
(88, 'PAK', 'Pakistan', 'PAK', 'STATE', '0'),
(89, 'PDY', 'Puduchery', 'IND', 'UT', '34'),
(90, 'PNJ', 'Punjab', 'IND', 'STATE', '3'),
(91, 'POL', 'Port Louis', 'AFR', 'STATE', '0'),
(92, 'POR', 'Port Louis', 'MAU', 'STATE', '0'),
(93, 'QAN', 'Qandar', 'AFG', 'STATE', '0'),
(94, 'QAT', 'Qatar', 'QAT', 'STATE', '0'),
(95, 'RAJ', 'Rajasthan', 'IND', 'STATE', '8'),
(96, 'SA', 'South Astralia', 'AUS', 'STATE', '0'),
(97, 'SAU', 'Saudi Arabia', 'SAU', 'STATE', '0'),
(98, 'SEL', 'Selangor', 'MAL', 'STATE', '0'),
(99, 'SIK', 'Sikkim', 'IND', 'STATE', '11'),
(100, 'SIN', 'Singapore', 'MAL', 'STATE', '0'),
(101, 'SRL', 'Srilanka', 'SRL', 'STATE', '0'),
(102, 'SUA', 'South Africa', 'SUA', 'STATE', '0'),
(103, 'SUI', 'Suits', 'USA', 'STATE', '0'),
(104, 'SWE', 'Sweden', 'SWE', 'STATE', '0'),
(105, 'TAN', 'Tanzania', 'TAN', 'STATE', '0'),
(106, 'THA', 'Thailand', 'THA', 'STATE', '0'),
(107, 'TLG', 'Telangana', 'IND', 'STATE', '36'),
(108, 'TML', 'Tamil Nadu', 'IND', 'STATE', '33'),
(109, 'TOA', 'Toamasina', 'MG', 'STATE', '0'),
(110, 'TOK', 'Tokyo', 'JAP', 'STATE', '0'),
(111, 'TOR', 'Toronto', 'CAN', 'STATE', '0'),
(112, 'TRI', 'Tripura', 'IND', 'STATE', '16'),
(113, 'TUR', 'Turkey', 'TUR', 'STATE', '0'),
(114, 'TX', 'Texas', 'USA', 'STATE', '0'),
(115, 'UAE', 'United Arab Emirates', 'UAE', 'STATE', ''),
(116, 'UG', 'Uganda', 'UG', 'STATE', '0'),
(117, 'UK', 'United Kingdom', 'UK', 'STATE', '0'),
(118, 'UTK', 'Uttarakhand', 'IND', 'STATE', '5'),
(119, 'UTP', 'Uttar Pradesh', 'IND', 'STATE', '9'),
(120, 'UTR', 'Uttaranchal', 'IND', 'STATE', ''),
(121, 'VIC', 'Victoria', 'AUS', 'STATE', '0'),
(122, 'WAS', 'Washinton', 'USA', 'STATE', '0'),
(123, 'WTB', 'West Bengal', 'IND', 'STATE', '19'),
(124, 'ZAM', 'Zambia', 'ZAM', 'STATE', '0'),
(125, 'ZUR', 'Zurich', 'SWZ', 'STATE', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yogeeraj Borge', 'yogeerajborge@gmail.com', NULL, '$2y$10$9ggw9t7nXBXZIrT4lRpdnenWMJgjfjpOklc.razN1XDg64uHZyahe', NULL, '2022-08-22 03:42:00', '2022-08-22 03:42:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `common_list_master`
--
ALTER TABLE `common_list_master`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `location_master`
--
ALTER TABLE `location_master`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`param_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1096;

--
-- AUTO_INCREMENT for table `common_list_master`
--
ALTER TABLE `common_list_master`
  MODIFY `list_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `loc_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `param_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
