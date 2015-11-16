-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2015 at 03:35 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `walartpharma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `simbanic_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_ci_sessions`
--

INSERT INTO `simbanic_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('c499e0c153cd13c8d1cdd79f41360669', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/201001', 1447165186, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:7:"GUJ0009";s:11:"customer_id";s:7:"GUJ0009";s:5:"email";s:0:"";s:7:"user_id";s:3:"262";s:14:"old_last_login";s:10:"1447156241";}'),
('5aa2675aa602cefc6c61246cb91c81de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/201001', 1447162661, ''),
('0f4285fbe1f8470fff01fe320a28051c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/201001', 1447162661, '');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_customer`
--

CREATE TABLE IF NOT EXISTS `simbanic_customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `sponsor_id` varchar(50) NOT NULL,
  `tree_id` int(11) NOT NULL,
  `customer_type` enum('doctor','medical_store') NOT NULL DEFAULT 'doctor',
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `home_address` text NOT NULL,
  `work_address` text NOT NULL,
  `home_street1` varchar(255) NOT NULL,
  `home_street2` varchar(255) NOT NULL,
  `home_state` varchar(50) NOT NULL,
  `home_district` varchar(50) NOT NULL,
  `home_taluka` varchar(50) NOT NULL,
  `home_city` varchar(50) NOT NULL,
  `home_area` varchar(50) NOT NULL,
  `refer_to` varchar(255) NOT NULL,
  `marriage_anni` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `pancard_no` varchar(100) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `nominee` varchar(255) NOT NULL,
  `nominee_relation` varchar(100) NOT NULL,
  `nominee_dob` varchar(255) NOT NULL,
  `income` varchar(100) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `related_medical` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_customer`
--

INSERT INTO `simbanic_customer` (`id`, `user_id`, `created_by`, `customer_id`, `sponsor_id`, `tree_id`, `customer_type`, `full_name`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `mobile_no`, `gender`, `dob`, `home_address`, `work_address`, `home_street1`, `home_street2`, `home_state`, `home_district`, `home_taluka`, `home_city`, `home_area`, `refer_to`, `marriage_anni`, `designation`, `pancard_no`, `blood_group`, `nominee`, `nominee_relation`, `nominee_dob`, `income`, `payment`, `bank_name`, `account_no`, `ifsc_code`, `related_medical`, `date_created`, `date_modified`, `deleted`) VALUES
(52, 1, 1, 'GUJ0001', '0', 0, 'doctor', 'Hardik Panseriya', '', '', '', '', 'panseriya', '9724563176', 'male', '1992-02-17', 'Ahmedabad', 'Ahmedabad', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', 'Hardik', 'N/A', 'Developer', '123456', 'N/A', 'N/A', 'N/A', '2015-08-12', '2', '', 'state bank', '12345678901', 'SBIN0060434', '', '2015-08-12 17:50:16', '2015-08-12 18:00:27', '0'),
(64, 258, 1, 'GUJ0005', 'GUJ0001', 1, 'medical_store', 'YOGESHBHAI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-02', 'ABC', 'ABC', '', '', 'gujarat', 'ahmedabad', '', '', 'daskroi', 'AA', '16-09-2015', 'VO', 'AAAAAAA', 'A+', 'AAA', 'AAA', '2015-09-14', '1000000', '', 'AAA', '123456', '12345', '', '2015-09-11 11:41:46', '2015-09-11 11:41:46', '0'),
(65, 259, 1, 'GUJ0006', 'GUJ0001', 1, 'doctor', 'JIGISHA ', '', '', '', '', 'PASSWORD', '1234567890', 'female', '2015-09-10', 'AAA', 'AAA', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '17-09-2015', 'HOUSEWIFE', 'AAAAA', 'A+', 'AAA', 'AAA', '', '', '', 'AAA', 'AAA', 'AAAA', '', '2015-09-11 14:44:46', '2015-09-11 14:44:46', '0'),
(66, 260, 1, 'GUJ0007', 'GUJ0006', 2, 'doctor', 'DR KANTILAL BHABHAR', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-16', 'AAAA', 'AAAA', '', '', 'gujarat', 'ahmedabad', '', '', 'daskroi', '', '17-09-2015', 'AAA', 'AAAAAAA', 'AAAA', 'AAAAA', 'AAAA', '', '', '', 'AAAA', 'fghjgdghdfgds', 'AAAAA', '298,262', '2015-09-11 14:50:43', '2015-10-19 17:17:00', '0'),
(67, 261, 1, 'GUJ0008', 'GUJ0006', 2, 'medical_store', 'NARSHIBHAI DHANERA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-08', 'AAAAAAAA', 'AAAAAA', '', '', 'gujarat', 'ahmedabad', '', '', 'daskroi', '', '08-09-2015', 'STOKIST', 'AAAA', 'AAA', 'AAAA', 'AAA', '', '', '', 'AAAA', 'ABHAY54433', 'AAA', '', '2015-09-11 14:54:38', '2015-10-20 17:32:38', '0'),
(68, 262, 1, 'GUJ0009', 'GUJ0006', 2, 'medical_store', 'JAYESHBHAI SOLANKI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-17', 'AA', 'AA', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '11-09-2015', 'STOKIST', 'AAA', 'AA', 'AAAA', 'AAA', '', '', '', 'AAA', 'AAA', 'AAA', '', '2015-09-11 14:59:12', '2015-09-11 14:59:31', '0'),
(69, 263, 1, 'GUJ0010', 'GUJ0006', 2, 'medical_store', 'HARIBHAI DAHIMA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-11', 'AA', 'AAA', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '11-09-2015', 'AA', 'AAA', 'AAA', 'AAA', 'AAA', '', '', '', 'AAAA', 'AAA', 'AAA', '', '2015-09-11 15:00:55', '2015-09-11 15:00:55', '0'),
(72, 266, 1, 'GUJ0011', 'GUJ0006', 2, 'doctor', 'JAYDIPBHAI MORI', '', '', '', '', '12345', '9724563175', 'male', '2015-09-11', 'Ahmedabad', 'Ahmedabad', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '11-09-2015', 'N/A', '123456', 'N/A', 'N/A', 'N/A', '', '', '', 'state bank', '12345678901', 'SBIN0060434', '297,262,298', '2015-09-11 17:55:10', '2015-10-26 09:59:16', '0'),
(73, 267, 1, 'GUJ0012', 'GUJ0007', 3, 'doctor', 'BHARAT RATHOD', '', '', '', '', '123456', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A11111111111111', 'A', '298,262,261', '2015-09-12 14:42:28', '2015-10-20 14:41:52', '0'),
(74, 268, 1, 'GUJ0013', 'GUJ0012', 4, 'doctor', 'MOMIN SIR', '', '', '', '', '123456', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A1111111111111', 'A', '298,297,262,261', '2015-09-12 15:01:52', '2015-10-20 14:40:06', '0'),
(75, 269, 1, 'GUJ0014', 'GUJ0012', 4, 'doctor', 'HITENDRA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A1111111111111111111', 'A', '263,297,261', '2015-09-12 15:04:37', '2015-10-20 16:12:20', '0'),
(76, 270, 1, 'GUJ0015', 'GUJ0012', 4, 'doctor', 'VIKRAMBHAI', '', '', '', '', '12345', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'AA', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A1111111111111111111', 'A', '297,262,258,261', '2015-09-12 15:06:18', '2015-10-20 15:43:43', '0'),
(77, 271, 1, 'GUJ0016', 'GUJ0012', 4, 'doctor', 'VIKRAMBHAI SUIGAM', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-12 15:07:52', '2015-09-12 15:07:52', '0'),
(78, 272, 1, 'GUJ0017', 'GUJ0013', 5, 'doctor', 'B.G KAG', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'Afghgdtgsdrgsrfs', 'A', '298,263', '2015-09-12 15:08:58', '2015-10-19 18:33:56', '0'),
(79, 273, 1, 'GUJ0018', 'GUJ0013', 5, 'doctor', 'UMESHBHAI LAKHANI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'Afghgdtgsdrgsrfs', 'A', '298,262', '2015-09-12 15:09:56', '2015-10-20 18:55:21', '0'),
(80, 274, 1, 'GUJ0019', 'GUJ0013', 5, 'doctor', 'PADHAR', '', '', '', '', 'PASSWORD', '9724563175', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'Afghgdtgsdrgsrfs', 'A', '298,297,263,262', '2015-09-12 15:10:57', '2015-10-21 18:49:13', '0'),
(81, 275, 1, 'GUJ0020', 'GUJ0013', 5, 'doctor', 'NAGARALI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-12 15:16:27', '2015-09-12 15:16:27', '0'),
(82, 276, 1, 'GUJ0021', 'GUJ0013', 5, 'doctor', 'MOGNOJIYA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'Alalalalalalalala', 'A', '263,258,298,261', '2015-09-12 15:17:18', '2015-10-28 08:52:50', '0'),
(83, 277, 1, 'GUJ0022', 'GUJ0017', 6, 'doctor', 'JETHABHAI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'AAA', 'A', 'A', 'A', 'A', '', '', '', 'A', 'Aaaaaaaaaaaa', 'A', '298,302,263', '2015-09-12 17:16:27', '2015-10-28 09:01:52', '0'),
(84, 278, 1, 'GUJ0023', 'GUJ0017', 6, 'doctor', 'N J PATEL', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A1111111111111111111', 'A', '298,263,261,297', '2015-09-12 17:19:11', '2015-10-28 09:07:08', '0'),
(85, 279, 1, 'GUJ0024', 'GUJ0017', 6, 'doctor', 'R D PATEL', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A1111111111111111111', 'AA', '263,261,298', '2015-09-12 17:20:38', '2015-10-28 09:10:53', '0'),
(86, 280, 1, 'GUJ0025', 'GUJ0018', 6, 'doctor', 'MANSAJI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-12', 'Abhay', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '12-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'AA', 'A', 'A', '', '2015-09-12 17:22:56', '2015-09-13 14:43:08', '0'),
(87, 281, 1, 'GUJ0026', 'GUJ0018', 6, 'doctor', 'LAKHNI DR', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-02', 'AAA', 'AA', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'S', 'S', 'SS', 'S', 'S', '', '', '', 'S', 'S', 'S', '', '2015-09-15 09:01:15', '2015-09-15 09:01:15', '0'),
(88, 282, 1, 'GUJ0027', 'GUJ0021', 6, 'doctor', 'NAGAR ALI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'anand', '', '', 'anand1', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', '12324555788', 'A', '298,263', '2015-09-15 09:02:24', '2015-10-19 10:01:37', '0'),
(89, 283, 1, 'GUJ0028', 'GUJ0014', 5, 'doctor', 'PRAJAPATI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:04:30', '2015-09-15 09:04:30', '0'),
(90, 284, 1, 'GUJ0029', 'GUJ0015', 5, 'doctor', 'VANRAJ PAN', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:06:05', '2015-09-15 09:06:05', '0'),
(91, 285, 1, 'GUJ0030', 'GUJ0008', 3, 'doctor', 'DAYABHAI', '', '', '', '', 'PASSWORD', '1234568090', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:08:07', '2015-09-15 09:08:07', '0'),
(92, 286, 1, 'GUJ0031', 'GUJ0009', 3, 'doctor', 'KB VALA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'anand', '', '', 'anand1', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:09:16', '2015-09-15 09:09:16', '0'),
(93, 287, 1, 'GUJ0032', 'GUJ0009', 3, 'doctor', 'CHOTHANI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:10:10', '2015-09-15 09:10:10', '0'),
(94, 288, 1, 'GUJ0033', 'GUJ0009', 3, 'doctor', 'R B SOLANKI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:11:07', '2015-09-15 09:11:07', '0'),
(95, 289, 1, 'GUJ0034', 'GUJ0032', 4, 'doctor', 'KUNADIYA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:13:20', '2015-09-15 09:13:20', '0'),
(96, 290, 1, 'GUJ0035', 'GUJ0031', 4, 'doctor', 'PATAT', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:14:14', '2015-09-15 09:14:14', '0'),
(97, 291, 1, 'GUJ0036', 'GUJ0033', 4, 'doctor', 'KACHOT', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'anand', '', '', 'anand1', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:18:14', '2015-09-15 09:18:14', '0'),
(98, 292, 1, 'GUJ0037', 'GUJ0010', 3, 'doctor', 'DAHIMA', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A\n', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:19:33', '2015-09-15 09:19:33', '0'),
(99, 293, 1, 'GUJ0038', 'GUJ0037', 4, 'doctor', 'MANUBHAI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:23:05', '2015-09-15 09:23:05', '0'),
(100, 294, 1, 'GUJ0039', 'GUJ0011', 3, 'doctor', 'SOLANKI', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:26:51', '2015-09-15 09:26:51', '0'),
(101, 295, 1, 'GUJ0040', 'GUJ0039', 4, 'doctor', 'BABUBHAI CHAUDHARY', '', '', '', '', 'PASSWORD', '1234567890', 'male', '2015-09-15', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '15-09-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'A', 'A', '', '2015-09-15 09:28:06', '2015-09-15 09:28:06', '0'),
(102, 296, 1, 'GUJ0041', 'GUJ0038', 5, 'doctor', 'BHARATSINH', '', '', '', '', '123456', '1234567890', 'male', '2015-10-01', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'A', 'AAAAAAAA', 'A', 'A', 'A', '', '', '', 'A', '1234567890', 'A', '', '2015-10-03 15:49:10', '2015-10-05 10:15:56', '0'),
(103, 297, 1, 'GUJ0042', 'GUJ0040', 5, 'medical_store', 'MUKESHBHAI HADIYA', '', '', '', '', '12345', '1234567890', 'male', '2015-10-01', 'AAA', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', 'AAAAAAAAAAAA', 'A', '', '2015-10-06 15:29:41', '2015-10-06 15:32:30', '0'),
(104, 298, 1, 'GUJ0043', 'GUJ0037', 4, 'medical_store', 'MADHAV MED', '', '', '', '', '12345', '1234567890', 'male', '2015-10-01', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', '123456789', 'A', '', '2015-10-06 15:35:11', '2015-10-06 15:35:11', '0'),
(105, 299, 1, 'GUJ0044', 'GUJ0035', 5, 'doctor', 'ASHOKBHAI HADIYA', '', '', '', '', 'PASSWORD', '1111111111', 'male', '2015-10-01', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '07-10-2015', 'A', 'DFDGDGFGGF', 'AA', 'AAA', 'ASSS', '', '', '', '12212121221211', 'ABHAY54433', '12345', '298,262', '2015-10-06 15:47:55', '2015-10-10 13:23:59', '0'),
(106, 300, 1, 'GUJ0045', 'GUJ0041', 6, 'doctor', 'BHANBHAI', '', '', '', '', 'PASSWORD', '9724563175', 'male', '2015-10-09', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'A', 'AA', 'A', 'A', 'Q', '', '', '', 'A', 'ABHAY01234', 'A', '262,258,302', '2015-10-10 18:10:09', '2015-10-26 16:55:14', '0'),
(107, 301, 1, 'GUJ0046', 'GUJ0034', 5, 'doctor', 'Dr Aryan N Ramani', '', '', '', '', 'PASSWORD', '9724154433', 'male', '1984-10-12', 'C57 VIKRAMADITYA SOC., OPP BAJARANG DAS ASHARAM ', 'SAME', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'LI', 'AKDPR6480L', 'B+', 'JIGISHA RAMANI', 'MOTHER', '', '', '', 'IDBI', '1280104000015701', 'IDBIK000021', '297,262,263,298', '2015-10-25 12:39:19', '2015-10-26 16:46:22', '0'),
(108, 302, 1, 'GUJ0047', 'GUJ0030', 4, 'medical_store', 'HARSHAD RAMANI', '', '', '', '', 'PASSWORD', '7623872700', 'male', '2015-10-01', 'C57 VIKRAMADITYA SOC', 'SAME', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '01-10-2015', 'AI', 'AJAJAJAJA', 'JA', 'AJA', 'AJ', '', '', '', 'SBI', '32123768545', 'GHGH', '', '2015-10-25 12:44:40', '2015-10-25 12:44:40', '0'),
(109, 303, 1, 'GUJ0048', 'GUJ0046', 6, 'doctor', 'JIGU RAMANI', '', '', '', '', 'PASSWORD', '7383366639', 'female', '2015-10-01', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '08-10-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', '1280104000015701', 'A', '297,261,262', '2015-10-28 15:16:57', '2015-10-28 15:16:57', '0'),
(110, 304, 1, 'GUJ0049', 'GUJ0009', 3, 'doctor', 'BABUBHAI RAMANI', '', '', '', '', 'PASSWORD', '7623872700', 'male', '2015-10-28', 'A', 'A', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', '', '28-10-2015', 'A', 'A', 'A', 'A', 'A', '', '', '', 'A', '32123701234', 'A', '297,302,262', '2015-10-28 15:20:20', '2015-10-28 15:20:20', '0'),
(111, 305, 1, 'GUJ0050', 'GUJ0032', 4, 'doctor', 'Dr.Vipul R. Patel', '', '', '', '', '5763', '9714966227', 'male', '2015-11-01', 'Himmatnagar', 'at Himatnagar', '', '', 'gujarat', 'sabarkantha', '', '', 'himmatnagar', '', '12-11-2015', 'AI', 'CCTPP9898L', 'A', 'DHARA', 'WIFE', '', '', '', 'ICICI', '118301505763', 'AAAA', '262,302,297', '2015-11-06 13:54:34', '2015-11-06 13:54:34', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `sponsor_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `home_address` text NOT NULL,
  `work_address` text NOT NULL,
  `home_street1` varchar(255) NOT NULL,
  `home_street2` varchar(255) NOT NULL,
  `home_state` varchar(50) NOT NULL,
  `home_district` varchar(50) NOT NULL,
  `home_taluka` varchar(50) NOT NULL,
  `home_city` varchar(50) NOT NULL,
  `home_area` varchar(50) NOT NULL,
  `refer_to` varchar(255) NOT NULL,
  `marriage_anni` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `pancard_no` varchar(100) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `nominee` varchar(255) NOT NULL,
  `nominee_relation` varchar(100) NOT NULL,
  `nominee_dob` varchar(255) NOT NULL,
  `income` varchar(100) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `transportation` varchar(255) NOT NULL,
  `transportation_2` varchar(255) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `dl_no` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_person_mobile_no` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot`
--

INSERT INTO `simbanic_depot` (`id`, `user_id`, `created_by`, `customer_id`, `sponsor_id`, `full_name`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `mobile_no`, `gender`, `dob`, `home_address`, `work_address`, `home_street1`, `home_street2`, `home_state`, `home_district`, `home_taluka`, `home_city`, `home_area`, `refer_to`, `marriage_anni`, `designation`, `pancard_no`, `blood_group`, `nominee`, `nominee_relation`, `nominee_dob`, `income`, `payment`, `bank_name`, `account_no`, `ifsc_code`, `transportation`, `transportation_2`, `tin_no`, `dl_no`, `contact_person`, `contact_person_mobile_no`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 255, 1, 'GUJ0002D', '', 'ABHAY RAMANI', '', '', '', '', 'PASSWORD', '9724154433', 'male', '1984-10-12', 'C57 VIKRAMADITYA SOC, HIRAWADI AHMEDABAD', '401 DEVRAJ MALL', '', '', 'gujarat', 'ahmedabad', '', '', 'bapunagar', 'SELF', '22-11-2010', 'PHARMACISDT', 'AKDPR6480L', 'B +', 'JIGISHABEN RAMANI', 'WIFE', '1988-09-22', '1000000', '', 'IDBI BANK', '1280104000015701', 'IDBK0001', 'SAIKRUPA TRANSPORT', '', '252125412452', 'GJ01210122', 'ABHAY RAMANI', '', '2015-09-10 13:53:06', '2015-09-10 13:53:06', '0'),
(2, 256, 1, 'GUJ0003D', '', 'VIPULKUMAR RAMEHBHAI PATEL', '', '', '', '', 'PASSWORD', '9714966227', 'male', '1987-04-19', 'B-3, RAJ BASERA BANGLOWS, MAHAVIRNAGAR, KAKAROL, HIMMATNAGAR', 'HIMMAT NAGAR', '', '', 'gujarat', 'anand', '', '', 'anand1', 'SELF', '19-11-2013', 'PHARMACIST', 'APPL3827', 'O+ve', 'DHARABEN', 'WIFE', '1986-09-25', '1000000', '', 'ICICI', '118301505763', 'ICIC00517', 'DIPAK ROAD WAY, AHMEDABAD', '', '124569', '123456', 'VIPUL R PATEL', '9714966227', '2015-09-10 13:58:09', '2015-09-13 21:53:50', '0'),
(3, 257, 1, 'GUJ0004D', '', 'RAVI BHESANIYA', '', '', '', '', 'password', '8128943424', 'male', '2015-09-10', 'at talalal', 'at talala', '', '', 'gujarat', 'surat', '', '', 'surat1', 'aa', '16-09-2015', 'aa', 'aaaaaa', 'B+', 'CHANDUBHAI', 'FATHER', '2015-09-12', '100000', '', 'SBI', '1213212131321', 'SSSDSSS', 'DIPAK ROAD WAYS', '', '123456', '123456', 'RAVI', '', '2015-09-10 14:05:41', '2015-09-10 14:05:41', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_invoice`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_invoice` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `depot_order_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_prefix` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `transportation_name` varchar(255) NOT NULL,
  `lr_no` varchar(255) NOT NULL,
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot_invoice`
--

INSERT INTO `simbanic_depot_invoice` (`id`, `created_by`, `depot_id`, `depot_order_id`, `invoice_no`, `invoice_prefix`, `comment`, `total`, `transportation_name`, `lr_no`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 255, 1, '1', 'INV-2015', '', '41250', 'HARI OM TRANSP', '1111', '2015-10-08 11:09:40', '2015-10-08 11:06:13', '2015-10-08 11:06:13', '0'),
(2, 1, 255, 2, '2', 'INV-2015', 'ALLMIN 100 KG J AAVYU CHE', '412200', 'hari om ', '11111', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(3, 1, 257, 3, '1', 'INV-2015', '', '196600', '', '', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(4, 1, 255, 4, '3', 'INV-2015', '', '6950', '', '', NULL, '2015-10-10 18:55:12', '2015-10-10 18:55:12', '0'),
(5, 1, 255, 7, '4', 'INV-2015', '', '206100', '', '', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(6, 1, 255, 8, '5', 'INV-2015', '', '195700', '', '', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_invoice_product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `depot_order_id` int(11) NOT NULL,
  `depot_invoice_id` int(11) NOT NULL,
  `depot_order_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `depot_quantity` varchar(255) NOT NULL,
  `order_quantity` varchar(255) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_status` enum('0','1') NOT NULL DEFAULT '0',
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot_invoice_product`
--

INSERT INTO `simbanic_depot_invoice_product` (`id`, `created_by`, `depot_id`, `depot_order_id`, `depot_invoice_id`, `depot_order_product_id`, `product_id`, `stock_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `depot_quantity`, `order_quantity`, `batch_no`, `expiry_date`, `stock_status`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 255, 1, 1, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '50', '50', 'AFS-001', '2015-10-08', '0', '2015-10-08 11:09:40', '2015-10-08 11:06:13', '2015-10-08 11:06:13', '1'),
(2, 1, 255, 1, 1, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '50', '50', 'AF1-001', '2017-10-08', '0', '2015-10-08 11:09:40', '2015-10-08 11:06:13', '2015-10-08 11:06:13', '1'),
(3, 1, 255, 1, 1, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '50', '50', 'AF5-001', '2017-10-08', '0', '2015-10-08 11:09:40', '2015-10-08 11:06:13', '2015-10-08 11:06:13', '0'),
(4, 1, 255, 2, 2, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '00', 'AF5-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(5, 1, 255, 2, 2, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '100', 'AF5-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(6, 1, 255, 2, 2, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '50', 'AF5-003', '2017-10-10', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(7, 1, 255, 2, 2, 0, 3, 8, 'ALLMIN FORTE', '1', 'kg', '130', '180', '200', '100', 'AF1-003', '2015-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '1'),
(8, 1, 255, 2, 2, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '200', '50', 'AF1-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(9, 1, 255, 2, 2, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '200', '50', 'AF1-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(10, 1, 255, 2, 2, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '200', '100', 'AFS-001', '2015-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(11, 1, 255, 2, 2, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '200', '100', 'AFS-001', '2017-10-05', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(12, 1, 255, 2, 2, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '200', '100', 'CS5-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(13, 1, 255, 2, 2, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '200', '100', 'CS5-002', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(14, 1, 255, 2, 2, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '200', '100', 'CSS-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(15, 1, 255, 2, 2, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '200', '100', 'CSS-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(16, 1, 255, 2, 2, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '200', '100', 'CS1-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(17, 1, 255, 2, 2, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '200', '100', 'CS1-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(18, 1, 255, 2, 2, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '200', '100', 'GS1-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(19, 1, 255, 2, 2, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '200', '100', 'GS1-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(20, 1, 255, 2, 2, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '200', '100', 'GS6-001', '2017-10-08', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(21, 1, 255, 2, 2, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '200', '100', 'GS6-002', '2017-10-09', '0', '2015-10-08 13:26:16', '2015-10-08 11:27:35', '2015-10-08 11:27:35', '0'),
(22, 1, 257, 3, 3, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '100', '50', 'AFS-001', '2017-10-05', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(23, 1, 257, 3, 3, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '50', 'AF1-002', '2017-10-09', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(24, 1, 257, 3, 3, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '100', 'AF5-003', '2017-10-10', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(25, 1, 257, 3, 3, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '100', '100', 'CS5-002', '2017-10-08', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(26, 1, 257, 3, 3, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '100', '100', 'CS1-002', '2017-10-09', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(27, 1, 257, 3, 3, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '100', 'CSS-002', '2017-10-09', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(28, 1, 257, 3, 3, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '100', '100', 'GS1-002', '2017-10-09', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(29, 1, 257, 3, 3, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '100', '100', 'GS6-002', '2017-10-09', '0', '2015-10-08 18:42:21', '2015-10-08 12:39:45', '2015-10-08 12:39:45', '0'),
(30, 1, 255, 4, 4, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-001', '2017-10-08', '0', NULL, '2015-10-10 18:55:12', '2015-10-10 18:55:12', '1'),
(31, 1, 255, 4, 4, 0, 1, 21, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-002', '2017-10-10', '0', NULL, '2015-10-10 18:55:12', '2015-10-10 18:55:12', '1'),
(32, 1, 255, 7, 5, 0, 1, 21, 'ALLMIN FORTE', '400', 'gm', '60', '100', '100', '100', 'AFS-002', '2017-10-10', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(33, 1, 255, 7, 5, 0, 3, 8, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '100', 'AF1-003', '2015-10-08', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(34, 1, 255, 7, 5, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '50', 'AF5-001', '2017-10-08', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(35, 1, 255, 7, 5, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '50', 'AF5-003', '2017-10-10', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(36, 1, 255, 7, 5, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '100', '100', 'CS5-002', '2017-10-08', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(37, 1, 255, 7, 5, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '100', '100', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(38, 1, 255, 7, 5, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '100', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(39, 1, 255, 7, 5, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '100', '100', 'GS1-002', '2017-10-09', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(40, 1, 255, 7, 5, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '100', '100', 'GS6-002', '2017-10-09', '0', '2015-10-22 12:43:33', '2015-10-22 12:42:34', '2015-10-22 12:42:34', '0'),
(41, 1, 255, 8, 6, 0, 1, 23, 'ALLMIN FORTE', '400', 'gm', '60', '100', '500', '100', 'afs-009', '2020-11-18', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(42, 1, 255, 8, 6, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '20', 'AF1-001', '2017-10-08', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(43, 1, 255, 8, 6, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '100', 'AF5-003', '2017-10-10', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(44, 1, 255, 8, 6, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '600', '100', 'CS5-002', '2017-10-08', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(45, 1, 255, 8, 6, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '400', '100', 'CS1-002', '2017-10-09', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(46, 1, 255, 8, 6, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '100', 'CSS-002', '2017-10-09', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(47, 1, 255, 8, 6, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '500', '100', 'GS1-002', '2017-10-09', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0'),
(48, 1, 255, 8, 6, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '300', '100', 'GS6-002', '2017-10-09', '0', '2015-11-07 20:04:19', '2015-11-07 20:04:12', '2015-11-07 20:04:12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_order`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_order` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Complete') NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot_order`
--

INSERT INTO `simbanic_depot_order` (`id`, `created_by`, `comment`, `total`, `status`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 255, '', '63750', 'Complete', '2015-10-08 11:04:12', '2015-10-08 11:04:12', '0'),
(2, 255, '', '412200', 'Complete', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(3, 257, '', '206100', 'Complete', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(4, 255, '', '6950', 'Complete', '2015-10-10 18:54:33', '2015-10-10 18:54:33', '0'),
(5, 256, '', '206100', 'Processing', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(6, 256, '', '1900', 'Processing', '2015-10-14 12:57:50', '2015-10-14 12:57:50', '0'),
(7, 255, '', '206100', 'Complete', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(8, 255, '', '700000', 'Complete', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_order_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_order_product` (
  `id` int(11) NOT NULL,
  `depot_order_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot_order_product`
--

INSERT INTO `simbanic_depot_order_product` (`id`, `depot_order_id`, `created_by`, `product_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `quantity`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '50', '2015-10-08 11:04:12', '2015-10-08 11:04:12', '0'),
(2, 1, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '50', '2015-10-08 11:04:12', '2015-10-08 11:04:12', '0'),
(3, 1, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '50', '2015-10-08 11:04:12', '2015-10-08 11:04:12', '0'),
(4, 1, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '50', '2015-10-08 11:04:12', '2015-10-08 11:04:12', '0'),
(37, 2, 1, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(38, 2, 1, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(39, 2, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(40, 2, 1, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(41, 2, 1, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(42, 2, 1, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(43, 2, 1, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(44, 2, 1, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '200', '2015-10-08 11:16:08', '2015-10-08 11:16:08', '0'),
(45, 3, 257, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(46, 3, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(47, 3, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(48, 3, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(49, 3, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(50, 3, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(51, 3, 257, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(52, 3, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '100', '2015-10-08 12:26:23', '2015-10-08 12:26:23', '0'),
(53, 4, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-10 18:54:33', '2015-10-10 18:54:33', '0'),
(54, 4, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-10 18:54:33', '2015-10-10 18:54:33', '0'),
(55, 5, 256, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(56, 5, 256, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(57, 5, 256, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(58, 5, 256, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(59, 5, 256, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(60, 5, 256, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(61, 5, 256, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(62, 5, 256, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '100', '2015-10-12 21:58:42', '2015-10-12 21:58:42', '0'),
(63, 6, 256, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '2015-10-14 12:57:50', '2015-10-14 12:57:50', '0'),
(64, 6, 256, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-14 12:57:50', '2015-10-14 12:57:50', '0'),
(65, 7, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(66, 7, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(67, 7, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(68, 7, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(69, 7, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(70, 7, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(71, 7, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(72, 7, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '100', '2015-10-22 12:40:55', '2015-10-22 12:40:55', '0'),
(73, 8, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '500', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(74, 8, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '100', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(75, 8, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '200', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(76, 8, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '600', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(77, 8, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '400', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(78, 8, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '100', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(79, 8, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '500', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0'),
(80, 8, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '300', '2015-11-07 20:03:06', '2015-11-07 20:03:06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_payment`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_payment` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `method` varchar(100) NOT NULL,
  `cash_type` varchar(255) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `cheque_no` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `transfer_id` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `confirm_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `date_pending` datetime NOT NULL,
  `date_done` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_depot_payment`
--

INSERT INTO `simbanic_depot_payment` (`id`, `created_by`, `depot_id`, `created_at`, `amount`, `method`, `cash_type`, `receipt_no`, `cheque_no`, `bank_name`, `bank_branch`, `transfer_id`, `date`, `confirm_date`, `remark`, `status`, `date_pending`, `date_done`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 255, 'admin', '100000', 'Cheque', 'cash_on_hand', '', '12345', 'SBI', 'THARAD', '', '2015-10-08', '2015-10-08', 'vipulbhai ne cheque aapyo', 'Done', '2015-10-08 15:10:45', '2015-10-12 15:13:02', '2015-10-12 15:13:02', '2015-10-12 15:13:02', '0'),
(2, 1, 257, 'admin', '100000', 'Cash', 'cash_on_hand', '11', '', '', '', '', '2015-10-10', '2015-11-03', 'AA', 'Done', '2015-10-10 18:44:57', '2015-10-10 18:45:10', '2015-10-10 18:45:10', '2015-10-10 18:45:10', '0'),
(3, 1, 255, 'admin', '100000', 'Cash', 'cash_on_hand', '1111', '', '', '', '', '2015-10-12', '2015-10-12', 'bbbbb', 'Done', '2015-10-12 15:12:05', '2015-10-12 15:12:52', '2015-10-12 15:12:52', '2015-10-12 15:12:52', '0'),
(4, 1, 255, 'admin', '100000', 'Cash', 'cash_on_hand', '11111', '', '', '', '', '2015-11-07', '2015-11-07', '', 'Done', '2015-11-06 11:49:23', '2015-11-06 11:49:42', '2015-11-06 11:49:42', '2015-11-06 11:49:42', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_group`
--

CREATE TABLE IF NOT EXISTS `simbanic_group` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `simbanic_group`
--

INSERT INTO `simbanic_group` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'customer', 'General Doctor'),
(4, 'depot', 'Depot'),
(5, 'pharma', 'Pharmaceutical');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_login_attempt`
--

CREATE TABLE IF NOT EXISTS `simbanic_login_attempt` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_otc_prescription`
--

CREATE TABLE IF NOT EXISTS `simbanic_otc_prescription` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_otc_prescription`
--

INSERT INTO `simbanic_otc_prescription` (`id`, `created_by`, `customer_name`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 262, 'test', '2015-11-02 09:05:29', '2015-11-02 09:05:29', '2015-11-02 09:05:29', 0),
(2, 262, 'patel', '2015-11-02 09:06:50', '2015-11-02 09:06:50', '2015-11-02 09:06:50', 0),
(3, 262, 'panseriya', '2015-11-02 09:23:17', '2015-11-02 09:23:17', '2015-11-02 09:23:17', 0),
(4, 262, '', '2015-11-02 10:28:00', '2015-11-02 10:28:00', '2015-11-02 10:28:00', 0),
(5, 261, 'mansaji', '2015-11-02 14:24:41', '2015-11-02 14:24:41', '2015-11-02 14:24:41', 0),
(6, 261, '', '2015-11-02 14:26:17', '2015-11-02 14:26:17', '2015-11-02 14:26:17', 0),
(7, 261, 'mafabhai', '2015-11-02 14:33:46', '2015-11-02 14:33:46', '2015-11-02 14:33:46', 0),
(8, 298, '', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(9, 263, '', '2015-11-02 14:49:59', '2015-11-02 14:49:59', '2015-11-02 14:49:59', 0),
(10, 297, '', '2015-11-02 15:04:14', '2015-11-02 15:04:14', '2015-11-02 15:04:14', 0),
(11, 297, '', '2015-11-02 15:04:33', '2015-11-02 15:04:33', '2015-11-02 15:04:33', 0),
(12, 263, '', '2015-11-02 16:00:03', '2015-11-02 16:00:03', '2015-11-02 16:00:03', 0),
(13, 262, '', '2015-11-06 14:27:50', '2015-11-06 14:27:50', '2015-11-06 14:27:50', 0),
(14, 298, '', '2015-11-06 14:44:13', '2015-11-06 14:44:13', '2015-11-06 14:44:13', 0),
(15, 297, '', '2015-11-06 15:17:50', '2015-11-06 15:17:50', '2015-11-06 15:17:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_otc_prescription_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_otc_prescription_product` (
  `id` int(11) NOT NULL,
  `otc_prescription_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_otc_prescription_product`
--

INSERT INTO `simbanic_otc_prescription_product` (`id`, `otc_prescription_id`, `created_by`, `product_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `quantity`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 262, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-02 09:05:29', '2015-11-02 09:05:29', '2015-11-02 09:05:29', 0),
(2, 1, 262, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 09:05:29', '2015-11-02 09:05:29', '2015-11-02 09:05:29', 0),
(3, 2, 262, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-02 09:06:50', '2015-11-02 09:06:50', '2015-11-02 09:06:50', 0),
(4, 3, 262, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '0', '2015-11-02 09:23:17', '2015-11-02 09:23:17', '2015-11-02 09:23:17', 0),
(5, 3, 262, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 09:23:17', '2015-11-02 09:23:17', '2015-11-02 09:23:17', 0),
(6, 4, 262, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-02 10:28:00', '2015-11-02 10:28:00', '2015-11-02 10:28:00', 0),
(7, 5, 261, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '2', '2015-11-02 14:24:41', '2015-11-02 14:24:41', '2015-11-02 14:24:41', 0),
(8, 5, 261, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 14:24:41', '2015-11-02 14:24:41', '2015-11-02 14:24:41', 0),
(9, 6, 261, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-02 14:26:17', '2015-11-02 14:26:17', '2015-11-02 14:26:17', 0),
(10, 6, 261, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '2', '2015-11-02 14:26:17', '2015-11-02 14:26:17', '2015-11-02 14:26:17', 0),
(11, 7, 261, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '13', '2015-11-02 14:33:46', '2015-11-02 14:33:46', '2015-11-02 14:33:46', 0),
(12, 8, 298, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(13, 8, 298, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(14, 8, 298, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(15, 8, 298, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(16, 8, 298, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(17, 8, 298, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(18, 8, 298, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(19, 8, 298, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '2015-11-02 14:45:01', '2015-11-02 14:45:01', '2015-11-02 14:45:01', 0),
(20, 9, 263, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '2', '2015-11-02 14:49:59', '2015-11-02 14:49:59', '2015-11-02 14:49:59', 0),
(21, 9, 263, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '2015-11-02 14:49:59', '2015-11-02 14:49:59', '2015-11-02 14:49:59', 0),
(22, 10, 297, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '2', '2015-11-02 15:04:14', '2015-11-02 15:04:14', '2015-11-02 15:04:14', 0),
(23, 10, 297, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '2', '2015-11-02 15:04:14', '2015-11-02 15:04:14', '2015-11-02 15:04:14', 0),
(24, 11, 297, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '3', '2015-11-02 15:04:33', '2015-11-02 15:04:33', '2015-11-02 15:04:33', 0),
(25, 11, 297, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '3', '2015-11-02 15:04:33', '2015-11-02 15:04:33', '2015-11-02 15:04:33', 0),
(26, 12, 263, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-02 16:00:03', '2015-11-02 16:00:03', '2015-11-02 16:00:03', 0),
(27, 12, 263, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-11-02 16:00:03', '2015-11-02 16:00:03', '2015-11-02 16:00:03', 0),
(28, 12, 263, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-11-02 16:00:03', '2015-11-02 16:00:03', '2015-11-02 16:00:03', 0),
(29, 13, 262, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '2015-11-06 14:27:50', '2015-11-06 14:27:50', '2015-11-06 14:27:50', 0),
(30, 13, 262, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '2015-11-06 14:27:50', '2015-11-06 14:27:50', '2015-11-06 14:27:50', 0),
(31, 14, 298, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '2015-11-06 14:44:13', '2015-11-06 14:44:13', '2015-11-06 14:44:13', 0),
(32, 14, 298, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '2015-11-06 14:44:13', '2015-11-06 14:44:13', '2015-11-06 14:44:13', 0),
(33, 14, 298, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '2015-11-06 14:44:13', '2015-11-06 14:44:13', '2015-11-06 14:44:13', 0),
(34, 15, 297, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-06 15:17:50', '2015-11-06 15:17:50', '2015-11-06 15:17:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_pharma`
--

CREATE TABLE IF NOT EXISTS `simbanic_pharma` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `sponsor_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `home_address` text NOT NULL,
  `work_address` text NOT NULL,
  `home_street1` varchar(255) NOT NULL,
  `home_street2` varchar(255) NOT NULL,
  `home_state` varchar(50) NOT NULL,
  `home_district` varchar(50) NOT NULL,
  `home_taluka` varchar(50) NOT NULL,
  `home_city` varchar(50) NOT NULL,
  `home_area` varchar(50) NOT NULL,
  `refer_to` varchar(255) NOT NULL,
  `marriage_anni` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `pancard_no` varchar(100) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `nominee` varchar(255) NOT NULL,
  `nominee_relation` varchar(100) NOT NULL,
  `nominee_dob` varchar(255) NOT NULL,
  `income` varchar(100) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `transportation` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `completed_by` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `sms_status` enum('0','1') NOT NULL DEFAULT '0',
  `date_confirm` datetime NOT NULL,
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_prescription`
--

INSERT INTO `simbanic_prescription` (`id`, `created_by`, `completed_by`, `code`, `mobile_no`, `detail`, `sms_status`, `date_confirm`, `sync_datetime`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 266, 298, '862791', '9724154433', 'hhhhh', '1', '2015-11-02 14:46:13', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(2, 268, 261, '100135', '9724154433', '', '1', '2015-11-02 14:29:42', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(3, 272, 263, '312087', '7623872700', '', '1', '2015-11-02 14:55:25', '2015-11-02 14:52:02', '2015-11-02 13:47:30', '2015-11-02 14:52:02', '0'),
(4, 301, 297, '345781', '7623872700', '', '1', '2015-11-02 15:02:31', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(5, 303, 0, '023763', '9724154433', '', '1', '0000-00-00 00:00:00', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '0'),
(6, 304, 302, '601780', '7623872700', '', '1', '2015-11-02 15:10:40', '2015-11-02 13:53:33', '2015-11-02 13:53:33', '2015-11-02 13:53:33', '0'),
(7, 266, 298, '313743', '7623872700', 'oooo', '1', '2015-11-02 17:22:48', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(8, 268, 262, '836245', '9724154433', '', '1', '2015-11-02 18:03:57', '2015-11-02 17:13:25', '2015-11-02 16:48:24', '2015-11-02 17:13:25', '0'),
(9, 304, 262, '337338', '7623872700', '', '1', '2015-11-02 18:14:15', '2015-11-02 18:12:31', '2015-11-02 16:53:11', '2015-11-02 18:12:31', '0'),
(10, 303, 0, '578477', '9724154433', '', '1', '0000-00-00 00:00:00', '2015-11-02 16:56:22', '2015-11-02 16:56:22', '2015-11-02 16:56:22', '0'),
(11, 301, 297, '072936', '7623872700', '', '1', '2015-11-02 18:21:49', '2015-11-02 17:16:24', '2015-11-02 17:04:47', '2015-11-02 17:16:24', '0'),
(12, 266, 262, '943428', '9724154433', 'exapaer', '1', '2015-11-06 14:22:04', '2015-11-06 12:18:13', '2015-11-06 12:18:13', '2015-11-06 12:18:13', '0'),
(13, 267, 298, '949495', '7623872700', '', '1', '2015-11-06 14:42:19', '2015-11-06 14:04:45', '2015-11-06 12:23:33', '2015-11-06 14:04:45', '0'),
(14, 268, 261, '593567', '7383366639', '', '1', '2015-11-06 15:04:39', '2015-11-06 14:05:31', '2015-11-06 12:33:12', '2015-11-06 14:05:31', '0'),
(15, 269, 297, '422428', '97149662277', '', '1', '2015-11-06 15:16:54', '2015-11-06 14:07:21', '2015-11-06 12:41:00', '2015-11-06 14:07:21', '0'),
(16, 301, 263, '179405', '7383366639', '', '1', '2015-11-06 15:31:59', '2015-11-06 13:16:16', '2015-11-06 13:16:16', '2015-11-06 13:16:16', '0'),
(17, 304, 262, '767274', '7623872700', '', '1', '2015-11-06 15:24:03', '2015-11-06 14:09:51', '2015-11-06 13:17:16', '2015-11-06 14:09:51', '0'),
(18, 303, 262, '248652', '7623872700', '', '1', '2015-11-06 15:47:59', '2015-11-06 13:22:39', '2015-11-06 13:22:39', '2015-11-06 13:22:39', '0'),
(19, 270, 0, '195053', '9724154433', '', '1', '0000-00-00 00:00:00', '2015-11-06 13:24:23', '2015-11-06 13:24:23', '2015-11-06 13:24:23', '0'),
(20, 303, 0, '195925', '97149662278', '', '1', '0000-00-00 00:00:00', '2015-11-06 13:39:37', '2015-11-06 13:26:43', '2015-11-06 13:39:37', '0'),
(21, 303, 0, '574733', '97149662271', '', '1', '0000-00-00 00:00:00', '2015-11-06 13:29:38', '2015-11-06 13:29:38', '2015-11-06 13:29:38', '0'),
(22, 303, 0, '511647', '1', '', '1', '0000-00-00 00:00:00', '2015-11-06 13:38:52', '2015-11-06 13:38:52', '2015-11-06 13:38:52', '0'),
(23, 266, 262, '029768', '9724154433', '', '1', '2015-11-06 14:36:29', '2015-11-06 14:36:01', '2015-11-06 14:36:01', '2015-11-06 14:36:01', '0'),
(24, 266, 262, '264587', '9714966227', '', '1', '2015-11-06 16:11:33', '2015-11-06 16:10:02', '2015-11-06 16:10:02', '2015-11-06 16:10:02', '0'),
(25, 266, 0, '890092', '9724154433', 'tes', '1', '0000-00-00 00:00:00', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '0'),
(26, 266, 0, '053955', '9724154433', 'est', '1', '0000-00-00 00:00:00', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '0'),
(27, 266, 262, '331384', '9724563175', 'test', '1', '2015-11-06 23:34:12', '2015-11-06 23:32:44', '2015-11-06 23:32:44', '2015-11-06 23:32:44', '0'),
(28, 266, 262, '884636', '9724154433', 'Test', '1', '2015-11-06 23:42:04', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '0'),
(29, 266, 262, '929043', '9979560494', 'Test', '1', '2015-11-06 23:48:41', '2015-11-06 23:48:41', '2015-11-06 23:47:28', '2015-11-06 23:47:28', '0'),
(30, 272, 263, '672506', '7623872700', 'test', '1', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '2015-11-06 23:51:55', '2015-11-06 23:51:55', '0'),
(31, 268, 262, '778450', '9724154433', '', '1', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_invoice_product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `retailer_quantity` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_prescription_invoice_product`
--

INSERT INTO `simbanic_prescription_invoice_product` (`id`, `created_by`, `retailer_id`, `prescription_id`, `product_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `quantity`, `retailer_quantity`, `date_confirm`, `sync_datetime`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 261, 268, 2, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '0'),
(2, 261, 268, 2, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '0'),
(3, 261, 268, 2, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '0'),
(4, 261, 268, 2, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '1', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '2015-11-02 14:29:42', '0'),
(5, 298, 266, 1, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '0'),
(6, 298, 266, 1, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '0'),
(7, 298, 266, 1, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '2015-11-02 14:46:13', '0'),
(8, 263, 272, 3, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '0'),
(9, 263, 272, 3, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '1', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '0'),
(10, 263, 272, 3, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '0'),
(11, 263, 272, 3, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '2015-11-02 14:55:25', '0'),
(12, 297, 301, 4, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '0', '1', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '0'),
(13, 297, 301, 4, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '0', '1', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '0'),
(14, 297, 301, 4, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '0'),
(15, 297, 301, 4, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '0'),
(16, 297, 301, 4, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '0', '1', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '2015-11-02 15:02:31', '0'),
(17, 302, 304, 6, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '0', '1', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '0'),
(18, 302, 304, 6, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '0', '2', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '0'),
(19, 302, 304, 6, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '0', '1', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '2015-11-02 15:10:40', '0'),
(20, 298, 266, 7, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '0'),
(21, 298, 266, 7, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '0'),
(22, 298, 266, 7, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '2015-11-02 17:22:48', '0'),
(23, 262, 268, 8, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '0'),
(24, 262, 268, 8, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '0'),
(25, 262, 268, 8, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '0'),
(26, 262, 268, 8, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '0', '0', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '2015-11-02 18:03:57', '0'),
(27, 262, 304, 9, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '0', '2', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '0'),
(28, 262, 304, 9, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '3', '3', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '0'),
(29, 262, 304, 9, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '3', '3', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '0'),
(30, 262, 304, 9, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '2015-11-02 18:14:15', '0'),
(31, 297, 301, 11, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '0', '1', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '0'),
(32, 297, 301, 11, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '0'),
(33, 297, 301, 11, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '0', '2', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '2015-11-02 18:21:49', '0'),
(34, 262, 266, 12, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '0'),
(35, 262, 266, 12, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '2', '2', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '0'),
(36, 262, 266, 12, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '2015-11-06 14:22:04', '0'),
(37, 262, 266, 23, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '2', '2', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '0'),
(38, 262, 266, 23, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '2', '2', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '2015-11-06 14:36:29', '0'),
(39, 298, 267, 13, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '0'),
(40, 298, 267, 13, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '5', '5', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '2015-11-06 14:42:19', '0'),
(41, 261, 268, 14, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '5', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '0'),
(42, 261, 268, 14, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '0'),
(43, 261, 268, 14, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '2', '2', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '2015-11-06 15:04:39', '0'),
(44, 297, 269, 15, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '0', '', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '0'),
(45, 297, 269, 15, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '1', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '2015-11-06 15:16:54', '0'),
(46, 262, 304, 17, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '9', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '0'),
(47, 262, 304, 17, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '15', '10', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '2015-11-06 15:24:03', '0'),
(48, 263, 301, 16, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '0', '1', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '0'),
(49, 263, 301, 16, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '0'),
(50, 263, 301, 16, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '2', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '2015-11-06 15:31:59', '0'),
(51, 262, 303, 18, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '0', '1', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '0'),
(52, 262, 303, 18, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '0', '1', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '2015-11-06 15:47:59', '0'),
(53, 262, 266, 24, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(54, 262, 266, 24, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(55, 262, 266, 24, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(56, 262, 266, 24, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(57, 262, 266, 24, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(58, 262, 266, 24, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(59, 262, 266, 24, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(60, 262, 266, 24, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '0', '1', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '2015-11-06 16:11:33', '0'),
(61, 262, 266, 27, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '1', '2015-11-06 23:34:12', '2015-11-06 23:34:12', '2015-11-06 23:34:12', '2015-11-06 23:34:12', '0'),
(62, 262, 266, 28, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-06 23:42:04', '2015-11-06 23:42:04', '2015-11-06 23:42:04', '2015-11-06 23:42:04', '0'),
(63, 262, 266, 29, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '1', '2015-11-06 23:48:41', '2015-11-06 23:48:41', '2015-11-06 23:48:41', '2015-11-06 23:48:41', '0'),
(64, 263, 272, 30, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '0'),
(65, 263, 272, 30, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '1', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '2015-11-06 23:53:10', '0'),
(66, 262, 268, 31, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '1', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '0'),
(67, 262, 268, 31, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '1', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '2015-11-07 00:00:03', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_medical_store`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_medical_store` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `completed_by` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `sync_status` enum('0','1') NOT NULL DEFAULT '0',
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_prescription_medical_store`
--

INSERT INTO `simbanic_prescription_medical_store` (`id`, `created_by`, `completed_by`, `prescription_id`, `user_id`, `full_name`, `date_confirm`, `sync_status`, `sync_datetime`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 266, 298, 1, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(2, 266, 298, 1, 298, 'MADHAV MED', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(3, 266, 298, 1, 297, 'MUKESHBHAI HADIYA', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(4, 268, 261, 2, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(5, 268, 261, 2, 297, 'MUKESHBHAI HADIYA', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(6, 268, 261, 2, 261, 'NARSHIBHAI DHANERA', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(7, 268, 261, 2, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 14:29:42', '0', '2015-11-02 13:45:19', '2015-11-02 13:45:19', '2015-11-02 13:45:19', '0'),
(8, 268, 261, 2, 297, 'MUKESHBHAI HADIYA', '2015-11-02 14:29:42', '0', '2015-11-02 13:45:19', '2015-11-02 13:45:19', '2015-11-02 13:45:19', '0'),
(9, 268, 261, 2, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 14:29:42', '0', '2015-11-02 13:45:20', '2015-11-02 13:45:20', '2015-11-02 13:45:20', '0'),
(10, 272, 263, 3, 263, 'HARIBHAI DAHIMA', '2015-11-02 14:55:25', '0', '2015-11-02 13:47:31', '2015-11-02 13:47:31', '2015-11-02 13:47:31', '0'),
(11, 272, 263, 3, 298, 'MADHAV MED', '2015-11-02 14:55:25', '0', '2015-11-02 13:47:31', '2015-11-02 13:47:31', '2015-11-02 13:47:31', '0'),
(12, 301, 297, 4, 263, 'HARIBHAI DAHIMA', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(13, 301, 297, 4, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(14, 301, 297, 4, 297, 'MUKESHBHAI HADIYA', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(15, 301, 297, 4, 263, 'HARIBHAI DAHIMA', '2015-11-02 15:02:31', '0', '2015-11-02 13:50:03', '2015-11-02 13:50:03', '2015-11-02 13:50:03', '0'),
(16, 301, 297, 4, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 15:02:31', '0', '2015-11-02 13:50:03', '2015-11-02 13:50:03', '2015-11-02 13:50:03', '0'),
(17, 301, 297, 4, 263, 'HARIBHAI DAHIMA', '2015-11-02 15:02:31', '0', '2015-11-02 13:50:05', '2015-11-02 13:50:05', '2015-11-02 13:50:05', '0'),
(18, 303, 0, 5, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '0'),
(19, 303, 0, 5, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '0'),
(20, 303, 0, 5, 261, 'NARSHIBHAI DHANERA', '0000-00-00 00:00:00', '0', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '0'),
(21, 303, 0, 5, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-02 13:52:13', '2015-11-02 13:52:13', '2015-11-02 13:52:13', '0'),
(22, 303, 0, 5, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-02 13:52:13', '2015-11-02 13:52:13', '2015-11-02 13:52:13', '0'),
(23, 304, 302, 6, 302, 'HARSHAD RAMANI', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(24, 304, 302, 6, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(25, 304, 302, 6, 297, 'MUKESHBHAI HADIYA', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(26, 304, 302, 6, 302, 'HARSHAD RAMANI', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:49', '2015-11-02 13:53:49', '2015-11-02 13:53:49', '0'),
(27, 304, 302, 6, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:49', '2015-11-02 13:53:49', '2015-11-02 13:53:49', '0'),
(28, 266, 298, 7, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(29, 266, 298, 7, 298, 'MADHAV MED', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(30, 266, 298, 7, 297, 'MUKESHBHAI HADIYA', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(31, 268, 262, 8, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 18:03:57', '0', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '0'),
(32, 268, 262, 8, 297, 'MUKESHBHAI HADIYA', '2015-11-02 18:03:57', '0', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '0'),
(33, 268, 262, 8, 261, 'NARSHIBHAI DHANERA', '2015-11-02 18:03:57', '0', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '2015-11-02 16:48:24', '0'),
(34, 304, 262, 9, 302, 'HARSHAD RAMANI', '2015-11-02 18:14:15', '0', '2015-11-02 16:53:11', '2015-11-02 16:53:11', '2015-11-02 16:53:11', '0'),
(35, 304, 262, 9, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 18:14:15', '0', '2015-11-02 16:53:11', '2015-11-02 16:53:11', '2015-11-02 16:53:11', '0'),
(36, 303, 0, 10, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '0'),
(37, 303, 0, 10, 261, 'NARSHIBHAI DHANERA', '0000-00-00 00:00:00', '0', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '0'),
(38, 301, 297, 11, 263, 'HARIBHAI DAHIMA', '2015-11-02 18:21:49', '0', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '0'),
(39, 301, 297, 11, 262, 'JAYESHBHAI SOLANKI', '2015-11-02 18:21:49', '0', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '0'),
(40, 301, 297, 11, 297, 'MUKESHBHAI HADIYA', '2015-11-02 18:21:49', '0', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '2015-11-02 17:04:47', '0'),
(41, 266, 262, 12, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(42, 266, 262, 12, 298, 'MADHAV MED', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(43, 266, 262, 12, 297, 'MUKESHBHAI HADIYA', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(44, 267, 298, 13, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 14:42:19', '0', '2015-11-06 12:23:43', '2015-11-06 12:23:43', '2015-11-06 12:23:43', '0'),
(45, 267, 298, 13, 298, 'MADHAV MED', '2015-11-06 14:42:19', '0', '2015-11-06 12:23:43', '2015-11-06 12:23:43', '2015-11-06 12:23:43', '0'),
(46, 268, 261, 14, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 15:04:39', '0', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '0'),
(47, 268, 261, 14, 298, 'MADHAV MED', '2015-11-06 15:04:39', '0', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '0'),
(48, 268, 261, 14, 261, 'NARSHIBHAI DHANERA', '2015-11-06 15:04:39', '0', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '2015-11-06 12:33:21', '0'),
(49, 269, 297, 15, 297, 'MUKESHBHAI HADIYA', '2015-11-06 15:16:54', '0', '2015-11-06 12:41:02', '2015-11-06 12:41:02', '2015-11-06 12:41:02', '0'),
(50, 269, 297, 15, 261, 'NARSHIBHAI DHANERA', '2015-11-06 15:16:54', '0', '2015-11-06 12:41:02', '2015-11-06 12:41:02', '2015-11-06 12:41:02', '0'),
(51, 301, 263, 16, 263, 'HARIBHAI DAHIMA', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(52, 301, 263, 16, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(53, 301, 263, 16, 297, 'MUKESHBHAI HADIYA', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(54, 304, 262, 17, 302, 'HARSHAD RAMANI', '2015-11-06 15:24:03', '0', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '0'),
(55, 304, 262, 17, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 15:24:03', '0', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '0'),
(56, 304, 262, 17, 297, 'MUKESHBHAI HADIYA', '2015-11-06 15:24:03', '0', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '2015-11-06 13:17:19', '0'),
(57, 303, 262, 18, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 15:47:59', '0', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '0'),
(58, 303, 262, 18, 297, 'MUKESHBHAI HADIYA', '2015-11-06 15:47:59', '0', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '0'),
(59, 270, 0, 19, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(60, 270, 0, 19, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(61, 270, 0, 19, 261, 'NARSHIBHAI DHANERA', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(62, 303, 0, 20, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '0'),
(63, 303, 0, 20, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '0'),
(64, 303, 0, 20, 261, 'NARSHIBHAI DHANERA', '0000-00-00 00:00:00', '0', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '2015-11-06 13:26:44', '0'),
(65, 303, 0, 0, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '0'),
(66, 303, 0, 0, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '0'),
(67, 303, 0, 0, 261, 'NARSHIBHAI DHANERA', '0000-00-00 00:00:00', '0', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '2015-11-06 13:29:39', '0'),
(68, 303, 0, 0, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 13:38:54', '2015-11-06 13:38:54', '2015-11-06 13:38:54', '0'),
(69, 266, 262, 23, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 14:36:29', '0', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '0'),
(70, 266, 262, 23, 298, 'MADHAV MED', '2015-11-06 14:36:29', '0', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '0'),
(71, 266, 262, 23, 297, 'MUKESHBHAI HADIYA', '2015-11-06 14:36:29', '0', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '0'),
(72, 266, 262, 24, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(73, 266, 0, 25, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '0'),
(74, 266, 0, 25, 298, 'MADHAV MED', '0000-00-00 00:00:00', '0', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '0'),
(75, 266, 0, 25, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '0'),
(76, 266, 0, 26, 262, 'JAYESHBHAI SOLANKI', '0000-00-00 00:00:00', '0', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '0'),
(77, 266, 0, 26, 298, 'MADHAV MED', '0000-00-00 00:00:00', '0', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '0'),
(78, 266, 0, 26, 297, 'MUKESHBHAI HADIYA', '0000-00-00 00:00:00', '0', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '0'),
(79, 266, 262, 27, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 23:34:12', '0', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '0'),
(80, 266, 262, 27, 298, 'MADHAV MED', '2015-11-06 23:34:12', '0', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '0'),
(81, 266, 262, 27, 297, 'MUKESHBHAI HADIYA', '2015-11-06 23:34:12', '0', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '0'),
(82, 266, 262, 28, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 23:42:04', '0', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '0'),
(83, 266, 262, 28, 298, 'MADHAV MED', '2015-11-06 23:42:04', '0', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '0'),
(84, 266, 262, 28, 297, 'MUKESHBHAI HADIYA', '2015-11-06 23:42:04', '0', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '0'),
(85, 266, 262, 29, 262, 'JAYESHBHAI SOLANKI', '2015-11-06 23:48:41', '0', '2015-11-06 23:48:41', '2015-11-06 23:47:28', '2015-11-06 23:47:28', '0'),
(86, 266, 262, 29, 298, 'MADHAV MED', '2015-11-06 23:48:41', '0', '2015-11-06 23:48:41', '2015-11-06 23:47:28', '2015-11-06 23:47:28', '0'),
(87, 266, 262, 29, 297, 'MUKESHBHAI HADIYA', '2015-11-06 23:48:41', '0', '2015-11-06 23:48:41', '2015-11-06 23:47:28', '2015-11-06 23:47:28', '0'),
(88, 272, 263, 30, 263, 'HARIBHAI DAHIMA', '2015-11-06 23:53:10', '0', '2015-11-06 23:53:10', '2015-11-06 23:51:55', '2015-11-06 23:51:55', '0'),
(89, 272, 263, 30, 298, 'MADHAV MED', '2015-11-06 23:53:10', '0', '2015-11-06 23:53:10', '2015-11-06 23:51:55', '2015-11-06 23:51:55', '0'),
(90, 268, 262, 31, 262, 'JAYESHBHAI SOLANKI', '2015-11-07 00:00:03', '0', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0'),
(91, 268, 262, 31, 297, 'MUKESHBHAI HADIYA', '2015-11-07 00:00:03', '0', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0'),
(92, 268, 262, 31, 261, 'NARSHIBHAI DHANERA', '2015-11-07 00:00:03', '0', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `completed_by` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `sync_status` enum('0','1') NOT NULL DEFAULT '0',
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_prescription_product`
--

INSERT INTO `simbanic_prescription_product` (`id`, `created_by`, `completed_by`, `prescription_id`, `product_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `quantity`, `date_confirm`, `sync_status`, `sync_datetime`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 266, 298, 1, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(2, 266, 298, 1, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(3, 266, 298, 1, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 14:46:13', '0', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '2015-11-02 13:40:54', '0'),
(4, 268, 261, 2, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(5, 268, 261, 2, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(6, 268, 261, 2, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(7, 268, 261, 2, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '2015-11-02 14:29:42', '0', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '2015-11-02 13:44:54', '0'),
(8, 272, 263, 3, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 14:55:25', '0', '2015-11-02 14:52:02', '2015-11-02 13:47:31', '2015-11-02 14:52:02', '0'),
(9, 272, 263, 3, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '2015-11-02 14:55:25', '0', '2015-11-02 14:52:02', '2015-11-02 13:47:31', '2015-11-02 14:52:02', '0'),
(10, 301, 297, 4, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(11, 301, 297, 4, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(12, 301, 297, 4, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(13, 301, 297, 4, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(14, 301, 297, 4, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 15:02:31', '0', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '2015-11-02 13:49:34', '0'),
(15, 303, 0, 5, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '0000-00-00 00:00:00', '0', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '2015-11-02 13:51:48', '0'),
(16, 304, 302, 6, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(17, 304, 302, 6, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '2', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(18, 304, 302, 6, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 15:10:40', '0', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '2015-11-02 13:53:34', '0'),
(19, 272, 263, 3, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-02 14:55:25', '0', '2015-11-02 14:52:02', '2015-11-02 14:52:02', '2015-11-02 14:52:02', '0'),
(20, 272, 263, 3, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 14:55:25', '0', '2015-11-02 14:52:02', '2015-11-02 14:52:02', '2015-11-02 14:52:02', '0'),
(21, 266, 298, 7, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(22, 266, 298, 7, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(23, 266, 298, 7, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 17:22:48', '0', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '2015-11-02 16:45:15', '0'),
(24, 268, 262, 8, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-02 18:03:57', '0', '2015-11-02 17:13:25', '2015-11-02 16:48:24', '2015-11-02 17:13:25', '0'),
(25, 268, 262, 8, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-02 18:03:57', '0', '2015-11-02 17:13:25', '2015-11-02 16:48:24', '2015-11-02 17:13:25', '0'),
(26, 268, 262, 8, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-02 18:03:57', '0', '2015-11-02 17:13:25', '2015-11-02 16:48:24', '2015-11-02 17:13:25', '0'),
(27, 268, 262, 8, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '0', '2015-11-02 18:03:57', '0', '2015-11-02 17:13:25', '2015-11-02 16:48:24', '2015-11-02 17:13:25', '0'),
(28, 304, 262, 9, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '2', '2015-11-02 18:14:15', '0', '2015-11-02 18:12:32', '2015-11-02 16:53:11', '2015-11-02 18:12:32', '0'),
(29, 304, 262, 9, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '3', '2015-11-02 18:14:15', '0', '2015-11-02 18:12:32', '2015-11-02 16:53:11', '2015-11-02 18:12:32', '0'),
(30, 304, 262, 9, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '3', '2015-11-02 18:14:15', '0', '2015-11-02 18:12:32', '2015-11-02 16:53:11', '2015-11-02 18:12:32', '0'),
(31, 303, 0, 10, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '0'),
(32, 303, 0, 10, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '0000-00-00 00:00:00', '0', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '0'),
(33, 303, 0, 10, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '2015-11-02 16:56:23', '0'),
(34, 301, 297, 11, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-02 18:21:49', '0', '2015-11-02 17:16:24', '2015-11-02 17:04:47', '2015-11-02 17:16:24', '0'),
(35, 301, 297, 11, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-02 18:21:49', '0', '2015-11-02 17:16:24', '2015-11-02 17:04:47', '2015-11-02 17:16:24', '0'),
(36, 301, 297, 11, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '2', '2015-11-02 18:21:49', '0', '2015-11-02 17:16:24', '2015-11-02 17:04:47', '2015-11-02 17:16:24', '0'),
(37, 304, 262, 9, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-02 18:14:15', '0', '2015-11-02 18:12:32', '2015-11-02 18:12:32', '2015-11-02 18:12:32', '0'),
(38, 266, 262, 12, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(39, 266, 262, 12, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '2', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(40, 266, 262, 12, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-06 14:22:04', '0', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '2015-11-06 12:18:14', '0'),
(41, 267, 298, 13, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-06 14:42:19', '0', '2015-11-06 14:04:46', '2015-11-06 12:23:43', '2015-11-06 14:04:46', '0'),
(42, 267, 298, 13, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '5', '2015-11-06 14:42:19', '0', '2015-11-06 14:04:46', '2015-11-06 12:23:43', '2015-11-06 14:04:46', '0'),
(43, 268, 261, 14, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '2015-11-06 15:04:39', '0', '2015-11-06 14:05:33', '2015-11-06 12:33:21', '2015-11-06 14:05:33', '0'),
(44, 268, 261, 14, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-06 15:04:39', '0', '2015-11-06 14:05:33', '2015-11-06 12:33:21', '2015-11-06 14:05:33', '0'),
(45, 268, 261, 14, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '2', '2015-11-06 15:04:39', '0', '2015-11-06 14:05:33', '2015-11-06 12:33:21', '2015-11-06 14:05:33', '0'),
(46, 269, 297, 15, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '', '2015-11-06 15:16:54', '0', '2015-11-06 14:07:22', '2015-11-06 12:41:02', '2015-11-06 14:07:22', '0'),
(47, 269, 297, 15, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '2015-11-06 15:16:54', '0', '2015-11-06 14:07:22', '2015-11-06 12:41:02', '2015-11-06 14:07:22', '0'),
(48, 301, 263, 16, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(49, 301, 263, 16, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(50, 301, 263, 16, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '2', '2015-11-06 15:31:59', '0', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '2015-11-06 13:16:18', '0'),
(51, 304, 262, 17, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '9', '2015-11-06 15:24:03', '0', '2015-11-06 14:09:54', '2015-11-06 13:17:19', '2015-11-06 14:09:54', '0'),
(52, 304, 262, 17, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-11-06 15:24:03', '0', '2015-11-06 14:09:54', '2015-11-06 13:17:19', '2015-11-06 14:09:54', '0'),
(53, 303, 262, 18, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-06 15:47:59', '0', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '0'),
(54, 303, 262, 18, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '2015-11-06 15:47:59', '0', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '2015-11-06 13:22:42', '0'),
(55, 270, 0, 19, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(56, 270, 0, 19, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(57, 270, 0, 19, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(58, 270, 0, 19, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '2015-11-06 13:24:24', '0'),
(59, 303, 0, 20, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:26:44', '2015-11-06 13:39:38', '0'),
(60, 303, 0, 20, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:26:44', '2015-11-06 13:39:38', '0'),
(61, 303, 0, 20, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:26:44', '2015-11-06 13:39:38', '0'),
(62, 303, 0, 0, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:29:39', '2015-11-06 13:39:38', '0'),
(63, 303, 0, 0, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:36:40', '2015-11-06 13:39:38', '0'),
(64, 303, 0, 0, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:38:54', '2015-11-06 13:39:38', '0'),
(65, 303, 0, 0, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '0000-00-00 00:00:00', '0', '2015-11-06 13:39:38', '2015-11-06 13:38:54', '2015-11-06 13:39:38', '0'),
(66, 266, 262, 23, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '2', '2015-11-06 14:36:29', '0', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '0'),
(67, 266, 262, 23, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '2', '2015-11-06 14:36:29', '0', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '2015-11-06 14:36:03', '0'),
(68, 266, 262, 24, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(69, 266, 262, 24, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(70, 266, 262, 24, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(71, 266, 262, 24, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(72, 266, 262, 24, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(73, 266, 262, 24, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(74, 266, 262, 24, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(75, 266, 262, 24, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '2015-11-06 16:11:33', '0', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '2015-11-06 16:10:04', '0'),
(76, 266, 0, 25, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '0000-00-00 00:00:00', '0', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '2015-11-06 23:25:29', '0'),
(77, 266, 0, 26, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '1', '0000-00-00 00:00:00', '0', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '2015-11-06 23:28:36', '0'),
(78, 266, 262, 27, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '1', '2015-11-06 23:34:12', '0', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '2015-11-06 23:32:45', '0'),
(79, 266, 262, 28, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-06 23:42:04', '0', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '2015-11-06 23:37:22', '0'),
(80, 266, 262, 29, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '1', '2015-11-06 23:48:41', '0', '2015-11-06 23:48:41', '2015-11-06 23:47:28', '2015-11-06 23:47:28', '0'),
(81, 272, 263, 30, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-11-06 23:53:10', '0', '2015-11-06 23:53:10', '2015-11-06 23:51:55', '2015-11-06 23:51:55', '0'),
(82, 272, 263, 30, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '1', '2015-11-06 23:53:10', '0', '2015-11-06 23:53:10', '2015-11-06 23:51:55', '2015-11-06 23:51:55', '0'),
(83, 268, 262, 31, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '1', '2015-11-07 00:00:03', '0', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0'),
(84, 268, 262, 31, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '1', '2015-11-07 00:00:03', '0', '2015-11-07 00:00:03', '2015-11-06 23:56:34', '2015-11-06 23:56:34', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_seen`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_seen` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `seen_by` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_prescription_seen`
--

INSERT INTO `simbanic_prescription_seen` (`id`, `created_by`, `seen_by`, `prescription_id`, `sync_datetime`, `date_created`) VALUES
(1, 268, 262, 2, '2015-11-02 14:02:01', '2015-11-02 14:02:01'),
(2, 301, 262, 4, '2015-11-02 14:03:05', '2015-11-02 14:03:05'),
(3, 304, 297, 6, '2015-11-02 14:04:48', '2015-11-02 14:04:48'),
(4, 303, 297, 5, '2015-11-02 14:05:18', '2015-11-02 14:05:18'),
(5, 268, 261, 2, '2015-11-02 14:28:43', '2015-11-02 14:28:43'),
(6, 266, 297, 1, '2015-11-02 14:36:41', '2015-11-02 14:36:41'),
(7, 266, 262, 1, '2015-11-02 14:38:59', '2015-11-02 14:38:59'),
(8, 266, 298, 1, '2015-11-02 14:43:57', '2015-11-02 14:43:57'),
(9, 272, 263, 3, '2015-11-02 14:50:43', '2015-11-02 14:50:43'),
(10, 301, 297, 4, '2015-11-02 15:01:12', '2015-11-02 15:01:12'),
(11, 304, 302, 6, '2015-11-02 15:10:09', '2015-11-02 15:10:09'),
(12, 266, 262, 7, '2015-11-02 17:19:50', '2015-11-02 17:19:50'),
(13, 266, 297, 7, '2015-11-02 17:20:44', '2015-11-02 17:20:44'),
(14, 266, 298, 7, '2015-11-02 17:22:37', '2015-11-02 17:22:37'),
(15, 268, 262, 8, '2015-11-02 18:03:12', '2015-11-02 18:03:12'),
(16, 304, 262, 9, '2015-11-02 18:10:48', '2015-11-02 18:10:48'),
(17, 301, 297, 11, '2015-11-02 18:21:20', '2015-11-02 18:21:20'),
(18, 303, 261, 10, '2015-11-02 18:26:58', '2015-11-02 18:26:58'),
(19, 266, 297, 12, '2015-11-06 14:18:53', '2015-11-06 14:18:53'),
(20, 266, 298, 12, '2015-11-06 14:20:53', '2015-11-06 14:20:53'),
(21, 266, 262, 12, '2015-11-06 14:21:29', '2015-11-06 14:21:29'),
(22, 266, 262, 23, '2015-11-06 14:36:13', '2015-11-06 14:36:13'),
(23, 267, 298, 13, '2015-11-06 14:42:02', '2015-11-06 14:42:02'),
(24, 268, 261, 14, '2015-11-06 15:04:31', '2015-11-06 15:04:31'),
(25, 269, 261, 15, '2015-11-06 15:13:29', '2015-11-06 15:13:29'),
(26, 269, 297, 15, '2015-11-06 15:15:18', '2015-11-06 15:15:18'),
(27, 304, 297, 17, '2015-11-06 15:22:13', '2015-11-06 15:22:13'),
(28, 304, 262, 17, '2015-11-06 15:22:57', '2015-11-06 15:22:57'),
(29, 301, 263, 16, '2015-11-06 15:31:24', '2015-11-06 15:31:24'),
(30, 303, 262, 18, '2015-11-06 15:47:49', '2015-11-06 15:47:49'),
(31, 266, 262, 24, '2015-11-06 16:10:29', '2015-11-06 16:10:29'),
(32, 266, 262, 27, '2015-11-06 23:33:55', '2015-11-06 23:33:55'),
(33, 266, 262, 28, '2015-11-06 23:41:34', '2015-11-06 23:41:34'),
(34, 266, 262, 29, '2015-11-06 23:48:15', '2015-11-06 23:48:15'),
(35, 272, 263, 30, '2015-11-06 23:52:44', '2015-11-06 23:52:44'),
(36, 268, 262, 31, '2015-11-06 23:58:13', '2015-11-06 23:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `st` varchar(50) NOT NULL,
  `gst` varchar(50) NOT NULL,
  `octr` varchar(50) NOT NULL,
  `excise` varchar(100) NOT NULL,
  `remark` text NOT NULL,
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_product`
--

INSERT INTO `simbanic_product` (`id`, `created_by`, `name`, `packing_size`, `unit`, `price`, `mrp`, `vat`, `cst`, `st`, `gst`, `octr`, `excise`, `remark`, `sync_datetime`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 13:56:04', '2015-10-03 13:05:46', '0'),
(2, 1, 'CATTLE SODA', '5', 'kg', '450', '600', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 13:56:43', '2015-09-27 17:07:07', '0'),
(3, 1, 'ALLMIN FORTE', '1', 'kg', '130', '180', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 16:57:15', '2015-09-27 16:57:56', '0'),
(4, 1, 'ALLMIN FORTE', '5', 'kg', '635', '890', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 17:00:23', '2015-09-27 17:00:23', '0'),
(5, 1, 'CATTLE SODA', '1', 'kg', '90', '116', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 17:01:03', '2015-09-27 17:01:03', '0'),
(6, 1, 'CATTLE SODA', '400', 'gm', '40', '65', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 17:01:33', '2015-09-27 17:01:33', '0'),
(7, 1, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 17:02:11', '2015-09-27 17:02:11', '0'),
(8, 1, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-09-27 17:03:01', '2015-09-27 17:03:01', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_invoice`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_invoice` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `retailer_order_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_prefix` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `transportation_name` varchar(255) NOT NULL,
  `lr_no` varchar(255) NOT NULL,
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_retailer_invoice`
--

INSERT INTO `simbanic_retailer_invoice` (`id`, `created_by`, `retailer_id`, `retailer_order_id`, `invoice_no`, `invoice_prefix`, `comment`, `total`, `transportation_name`, `lr_no`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 255, 267, 1, '1', '', '', '20610', '', '', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(2, 255, 285, 2, '1', '', '', '10305', '', '', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(3, 255, 286, 3, '1', '', '', '51525', '', '', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(4, 255, 288, 4, '1', '', '', '30915', '', '', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(5, 255, 298, 5, '1', '', '', '51525', '', '', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(6, 255, 295, 6, '1', '', '', '41160', '', '', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(7, 257, 290, 7, '1', '', '', '13440', '', '', '2015-10-08 19:27:33', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(8, 257, 289, 8, '1', '', '', '28100', '', '', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(9, 257, 291, 9, '1', '', '', '15720', '', '', '2015-10-08 19:16:51', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(10, 257, 296, 10, '1', '', '', '16380', '', '', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(11, 257, 297, 11, '1', '', '', '13000', '', '', '2015-10-08 19:18:48', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(12, 255, 272, 12, '1', '', '', '19310', '', '', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(13, 255, 274, 13, '1', '', '', '23636', '', '', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(14, 255, 273, 14, '1', '', '', '14950', '', '', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(15, 255, 284, 15, '1', '', '', '9660', '', '', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(16, 255, 272, 16, '2', '', '', '11750', '', '', '2015-10-08 22:32:28', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(17, 255, 274, 17, '2', '', '', '1175', '', '', '2015-10-08 22:35:45', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(18, 255, 273, 18, '2', '', '', '1900', '', '', '2015-10-08 22:36:32', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(19, 255, 268, 19, '1', '', '', '11960', '', '', '2015-10-08 22:34:26', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(20, 255, 291, 20, '2', '', '', '4310', '', '', '2015-10-08 23:09:02', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(21, 255, 262, 21, '1', '', '', '12910', '', '', '2015-10-08 23:04:39', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(22, 255, 261, 22, '1', '', '', '5750', '', '', '2015-10-22 12:28:37', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(23, 255, 277, 23, '1', '', '', '17410', '', '', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(24, 255, 278, 24, '1', '', '', '9900', '', '', '2015-10-08 23:38:54', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(25, 255, 272, 25, '3', '', '', '17410', '', '', '2015-10-08 23:44:20', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(26, 255, 272, 26, '4', '', '', '4950', '', '', '2015-10-08 23:39:39', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(27, 255, 291, 27, '3', '', '', '7590', '', '', '2015-10-08 23:48:57', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(28, 255, 290, 28, '2', '', '', '13250', '', '', '2015-10-08 23:48:01', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(29, 255, 268, 29, '2', '', '', '16544', '', '', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(30, 257, 272, 30, '5', '', '', '10850', '', '', NULL, '2015-10-10 18:57:08', '2015-10-10 18:57:08', '0'),
(31, 257, 272, 31, '6', '', '', '10850', '', '', '2015-10-10 18:59:24', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(32, 257, 262, 32, '2', '', '', '18800', '', '', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(33, 257, 261, 33, '2', '', '', '36080', '', '', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(34, 255, 263, 34, '1', '', '', '61830', '', '', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(35, 255, 298, 35, '2', '', '', '61830', '', '', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(36, 255, 267, 36, '2', '', '', '11430', '', '', '2015-11-06 14:59:02', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(37, 255, 272, 37, '7', '', '', '10850', '', '', '2015-11-07 00:05:42', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(38, 255, 272, 38, '8', '', '', '14025', '', '', '2015-11-07 00:07:44', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(39, 255, 272, 39, '9', '', '', '5875', '', '', '2015-11-07 00:37:58', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(40, 255, 262, 40, '3', '', '', '20610', '', '', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_invoice_product` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `retailer_order_id` int(11) NOT NULL,
  `retailer_invoice_id` int(11) NOT NULL,
  `retailer_order_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `retailer_quantity` varchar(255) NOT NULL,
  `order_quantity` varchar(255) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_status` enum('0','1') NOT NULL DEFAULT '0',
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_retailer_invoice_product`
--

INSERT INTO `simbanic_retailer_invoice_product` (`id`, `created_by`, `retailer_id`, `retailer_order_id`, `retailer_invoice_id`, `retailer_order_product_id`, `product_id`, `stock_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `retailer_quantity`, `order_quantity`, `batch_no`, `expiry_date`, `stock_status`, `date_confirm`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 255, 267, 1, 1, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '10', 'AF1-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(2, 255, 267, 1, 1, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(3, 255, 267, 1, 1, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-001', '2015-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(4, 255, 267, 1, 1, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(5, 255, 267, 1, 1, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(6, 255, 267, 1, 1, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(7, 255, 267, 1, 1, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(8, 255, 267, 1, 1, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-001', '2017-10-08', '0', '2015-10-08 17:56:15', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(9, 255, 285, 2, 2, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '5', 'GS6-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(10, 255, 285, 2, 2, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '5', '5', 'GS1-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(11, 255, 285, 2, 2, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '5', '5', 'CSS-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(12, 255, 285, 2, 2, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '5', '5', 'CS1-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(13, 255, 285, 2, 2, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '5', 'CS5-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(14, 255, 285, 2, 2, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '5', 'AF5-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(15, 255, 285, 2, 2, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '5', 'AF1-001', '2017-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(16, 255, 285, 2, 2, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '5', 'AFS-001', '2015-10-08', '0', '2015-10-08 17:45:40', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(17, 255, 286, 3, 3, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '25', '20', 'AF5-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(18, 255, 286, 3, 3, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '20', 'AF1-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(19, 255, 286, 3, 3, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '25', '20', 'AFS-001', '2015-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(20, 255, 286, 3, 3, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '25', '20', 'CS5-002', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(21, 255, 286, 3, 3, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '25', '20', 'CSS-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(22, 255, 286, 3, 3, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '20', 'CS1-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(23, 255, 286, 3, 3, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '20', 'GS1-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(24, 255, 286, 3, 3, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '20', 'GS6-001', '2017-10-08', '0', '2015-10-08 18:10:20', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(25, 255, 288, 4, 4, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '15', '15', 'AF5-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(26, 255, 288, 4, 4, 0, 3, 2, 'ALLMIN FORTE', '1', 'kg', '130', '180', '15', '15', 'AF1-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(27, 255, 288, 4, 4, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '15', '15', 'AFS-001', '2015-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(28, 255, 288, 4, 4, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '15', 'CS5-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(29, 255, 288, 4, 4, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '15', '15', 'CSS-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(30, 255, 288, 4, 4, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '15', '15', 'CS1-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(31, 255, 288, 4, 4, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '15', '15', 'GS1-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(32, 255, 288, 4, 4, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '15', '15', 'GS6-001', '2017-10-08', '0', '2015-10-08 18:23:14', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(33, 255, 298, 5, 5, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '25', '25', 'AF5-002', '2017-10-09', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(34, 255, 298, 5, 5, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '25', 'AF1-002', '2017-10-09', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(35, 255, 298, 5, 5, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '25', '25', 'AFS-001', '2015-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(36, 255, 298, 5, 5, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '25', '25', 'CS5-001', '2017-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(37, 255, 298, 5, 5, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '25', '25', 'CSS-001', '2017-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(38, 255, 298, 5, 5, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '25', 'CS1-001', '2017-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(39, 255, 298, 5, 5, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '25', 'GS1-001', '2017-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(40, 255, 298, 5, 5, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '25', 'GS6-001', '2017-10-08', '0', '2015-10-08 18:25:02', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(41, 255, 295, 6, 6, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '25', 'AF1-002', '2017-10-09', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(42, 255, 295, 6, 6, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '20', 'AF5-002', '2017-10-09', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(43, 255, 295, 6, 6, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '15', '15', 'AFS-001', '2015-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(44, 255, 295, 6, 6, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '15', 'CS5-001', '2017-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(45, 255, 295, 6, 6, 0, 6, 11, 'CATTLE SODA', '400', 'gm', '40', '65', '50', '25', 'CSS-001', '2017-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(46, 255, 295, 6, 6, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '50', '25', 'CSS-002', '2017-10-09', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(47, 255, 295, 6, 6, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-001', '2017-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(48, 255, 295, 6, 6, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-001', '2017-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(49, 255, 295, 6, 6, 0, 8, 19, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '25', 'GS6-001', '2017-10-08', '0', '2015-10-08 18:23:58', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(50, 257, 290, 7, 7, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '12', '12', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:27:33', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(51, 257, 290, 7, 7, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '12', '12', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:27:33', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(52, 257, 290, 7, 7, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '12', '12', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:27:33', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(53, 257, 290, 7, 7, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '12', '12', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:27:33', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(54, 257, 289, 8, 8, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '20', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(55, 257, 289, 8, 8, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '20', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(56, 257, 289, 8, 8, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '20', '20', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(57, 257, 289, 8, 8, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '20', 'AF5-003', '2017-10-10', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(58, 257, 289, 8, 8, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '20', '20', 'AF1-002', '2017-10-09', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(59, 257, 289, 8, 8, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '20', '20', 'AFS-001', '2017-10-05', '0', '2015-10-08 19:15:49', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(60, 257, 291, 9, 9, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '20', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:16:51', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(61, 257, 291, 9, 9, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '20', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:16:51', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(62, 257, 291, 9, 9, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '20', '20', 'GS1-002', '2017-10-09', '0', '2015-10-08 19:16:51', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(63, 257, 291, 9, 9, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '20', '20', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:16:51', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(64, 257, 296, 10, 10, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '12', '12', 'AFS-001', '2017-10-05', '0', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(65, 257, 296, 10, 10, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '12', '12', 'AF1-002', '2017-10-09', '0', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(66, 257, 296, 10, 10, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '12', '12', 'AF5-003', '2017-10-10', '0', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(67, 257, 296, 10, 10, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '12', '12', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(68, 257, 296, 10, 10, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '12', '12', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:18:06', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(69, 257, 297, 11, 11, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:18:48', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(70, 257, 297, 11, 11, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '20', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:18:48', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(71, 257, 297, 11, 11, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:18:48', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(72, 257, 297, 11, 11, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '10', 'AF1-002', '2017-10-09', '0', '2015-10-08 19:18:48', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(73, 255, 272, 12, 12, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-002', '2017-10-09', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(74, 255, 272, 12, 12, 0, 1, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-001', '2015-10-08', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(75, 255, 272, 12, 12, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(76, 255, 272, 12, 12, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(77, 255, 272, 12, 12, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-001', '2017-10-08', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(78, 255, 272, 12, 12, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-001', '2017-10-08', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(79, 255, 272, 12, 12, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:06:27', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(80, 255, 274, 13, 13, 0, 7, 17, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '16', '5', 'GS1-001', '2017-10-08', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(81, 255, 274, 13, 13, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '16', '11', 'GS1-002', '2017-10-09', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(82, 255, 274, 13, 13, 0, 5, 15, 'CATTLE SODA', '1', 'kg', '90', '116', '15', '5', 'CS1-001', '2017-10-08', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(83, 255, 274, 13, 13, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '15', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(84, 255, 274, 13, 13, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '17', '17', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(85, 255, 274, 13, 13, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(86, 255, 274, 13, 13, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(87, 255, 274, 13, 13, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-002', '2017-10-09', '0', '2015-10-08 19:07:42', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(88, 255, 273, 14, 14, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(89, 255, 273, 14, 14, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '20', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(90, 255, 273, 14, 14, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '20', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(91, 255, 273, 14, 14, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-001', '2017-10-05', '0', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(92, 255, 273, 14, 14, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-002', '2017-10-09', '0', '2015-10-08 19:08:41', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(93, 255, 284, 15, 15, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '5', 'GS6-002', '2017-10-09', '0', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(94, 255, 284, 15, 15, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(95, 255, 284, 15, 15, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '1'),
(96, 255, 284, 15, 15, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(97, 255, 284, 15, 15, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-001', '2017-10-08', '0', '2015-10-08 19:10:05', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(98, 255, 272, 16, 16, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 22:32:28', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(99, 255, 272, 16, 16, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-001', '2017-10-08', '0', '2015-10-08 22:32:28', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(100, 255, 272, 16, 16, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-002', '2017-10-09', '0', '2015-10-08 22:32:28', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(101, 255, 274, 17, 17, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '1', 'AF5-002', '2017-10-09', '0', '2015-10-08 22:35:45', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(102, 255, 274, 17, 17, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '1', 'GS6-002', '2017-10-09', '0', '2015-10-08 22:35:45', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(103, 255, 273, 18, 18, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-001', '2017-10-05', '0', '2015-10-08 22:36:32', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(104, 255, 273, 18, 18, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-10-08 22:36:32', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(105, 255, 273, 18, 18, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 22:36:32', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(106, 255, 268, 19, 19, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 22:34:26', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(107, 255, 268, 19, 19, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 22:34:26', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(108, 255, 268, 19, 19, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 22:34:26', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(109, 255, 268, 19, 19, 0, 2, 13, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-001', '2017-10-08', '0', '2015-10-08 22:34:26', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(110, 255, 291, 20, 20, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '5', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:09:02', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(111, 255, 291, 20, 20, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-08 23:09:02', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(112, 255, 291, 20, 20, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 23:09:02', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(113, 255, 262, 21, 21, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-002', '2017-10-09', '0', '2015-10-08 23:04:39', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(114, 255, 262, 21, 21, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 23:04:39', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(115, 255, 262, 21, 21, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:04:39', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(116, 255, 261, 22, 22, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '25', 'GS1-002', '2017-10-09', '0', '2015-10-22 12:28:37', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(117, 255, 261, 22, 22, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '25', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:28:37', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(118, 255, 261, 22, 22, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '15', '15', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:28:37', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(119, 255, 277, 23, 23, 0, 4, 9, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '4', 'AF5-002', '2017-10-09', '0', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(120, 255, 277, 23, 23, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '6', 'AF5-003', '2017-10-10', '0', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(121, 255, 277, 23, 23, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(122, 255, 277, 23, 23, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(123, 255, 277, 23, 23, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:37:43', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(124, 255, 278, 24, 24, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:38:54', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(125, 255, 278, 24, 24, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:38:54', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(126, 255, 272, 25, 25, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-10-08 23:44:20', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(127, 255, 272, 25, 25, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:44:20', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(128, 255, 272, 25, 25, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-10-08 23:44:20', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(129, 255, 272, 25, 25, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:44:20', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(130, 255, 272, 26, 26, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '5', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:39:39', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(131, 255, 272, 26, 26, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '5', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:39:39', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(132, 255, 291, 27, 27, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '6', '6', 'AF5-003', '2017-10-10', '0', '2015-10-08 23:48:57', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(133, 255, 291, 27, 27, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '6', '6', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:48:57', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(134, 255, 291, 27, 27, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '2', '2', 'GS6-002', '2017-10-09', '0', '2015-10-08 23:48:57', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(135, 255, 290, 28, 28, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:48:01', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(136, 255, 290, 28, 28, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '40', '40', 'AFS-001', '2017-10-05', '0', '2015-10-08 23:48:01', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(137, 255, 290, 28, 28, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-10-08 23:48:01', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(138, 255, 268, 29, 29, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '4', '4', 'GS1-002', '2017-10-09', '0', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(139, 255, 268, 29, 29, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '5', '5', 'CS1-002', '2017-10-09', '0', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(140, 255, 268, 29, 29, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '4', '4', 'CS5-002', '2017-10-08', '0', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(141, 255, 268, 29, 29, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '40', '40', 'AFS-001', '2017-10-05', '0', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(142, 255, 268, 29, 29, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '18', '18', 'AF5-003', '2017-10-10', '0', '2015-10-08 23:41:07', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(143, 257, 272, 30, 30, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', NULL, '2015-10-10 18:57:08', '2015-10-10 18:57:08', '1'),
(144, 257, 272, 30, 30, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', NULL, '2015-10-10 18:57:08', '2015-10-10 18:57:08', '1'),
(145, 257, 272, 31, 31, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-10-10 18:59:24', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(146, 257, 272, 31, 31, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-10 18:59:24', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(147, 257, 262, 32, 32, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(148, 257, 262, 32, 32, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(149, 257, 262, 32, 32, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(150, 257, 262, 32, 32, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(151, 257, 262, 32, 32, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(152, 257, 262, 32, 32, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-001', '2017-10-05', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(153, 257, 262, 32, 32, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '5', 'AF1-002', '2017-10-09', '0', '2015-10-22 12:21:15', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(154, 257, 261, 33, 33, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '20', '20', 'GS6-002', '2017-10-09', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(155, 257, 261, 33, 33, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '25', 'GS1-002', '2017-10-09', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(156, 257, 261, 33, 33, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '38', '38', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(157, 257, 261, 33, 33, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '6', '6', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(158, 257, 261, 33, 33, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '15', 'CS5-002', '2017-10-08', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(159, 257, 261, 33, 33, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '20', 'AF5-003', '2017-10-10', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(160, 257, 261, 33, 33, 0, 3, 7, 'ALLMIN FORTE', '1', 'kg', '130', '180', '3', '3', 'AF1-002', '2017-10-09', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(161, 257, 261, 33, 33, 0, 1, 5, 'ALLMIN FORTE', '400', 'gm', '60', '100', '8', '8', 'AFS-001', '2017-10-05', '0', '2015-10-22 12:28:01', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(162, 255, 263, 34, 34, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '30', '30', 'AF5-001', '2017-10-08', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(163, 255, 263, 34, 34, 0, 3, 8, 'ALLMIN FORTE', '1', 'kg', '130', '180', '30', '30', 'AF1-003', '2015-10-08', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(164, 255, 263, 34, 34, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '30', '30', 'CS5-002', '2017-10-08', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(165, 255, 263, 34, 34, 0, 1, 21, 'ALLMIN FORTE', '400', 'gm', '60', '100', '30', '30', 'AFS-002', '2017-10-10', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(166, 255, 263, 34, 34, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '30', '30', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(167, 255, 263, 34, 34, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '30', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(168, 255, 263, 34, 34, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '30', '30', 'GS1-002', '2017-10-09', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(169, 255, 263, 34, 34, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '30', '30', 'GS6-002', '2017-10-09', '0', '2015-10-22 12:46:20', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(170, 255, 298, 35, 35, 0, 4, 3, 'ALLMIN FORTE', '5', 'kg', '635', '890', '30', '20', 'AF5-001', '2017-10-08', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(171, 255, 298, 35, 35, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '30', '10', 'AF5-003', '2017-10-10', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(172, 255, 298, 35, 35, 0, 3, 8, 'ALLMIN FORTE', '1', 'kg', '130', '180', '30', '30', 'AF1-003', '2015-10-08', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(173, 255, 298, 35, 35, 0, 1, 21, 'ALLMIN FORTE', '400', 'gm', '60', '100', '30', '30', 'AFS-002', '2017-10-10', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(174, 255, 298, 35, 35, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '30', '30', 'CS5-002', '2017-10-08', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(175, 255, 298, 35, 35, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '30', '30', 'CSS-002', '2017-10-09', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(176, 255, 298, 35, 35, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '30', 'CS1-002', '2017-10-09', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(177, 255, 298, 35, 35, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '30', '30', 'GS1-002', '2017-10-09', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(178, 255, 298, 35, 35, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '30', '30', 'GS6-002', '2017-10-09', '0', '2015-10-22 12:49:17', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(179, 255, 267, 36, 36, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '5', '5', 'GS1-002', '2017-10-09', '0', '2015-11-06 14:59:02', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(180, 255, 267, 36, 36, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-11-06 14:59:02', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(181, 255, 267, 36, 36, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-11-06 14:59:02', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(182, 255, 272, 37, 37, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-11-07 00:05:42', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(183, 255, 272, 37, 37, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-11-07 00:05:42', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(184, 255, 272, 38, 38, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '15', '15', 'AF5-003', '2017-10-10', '0', '2015-11-07 00:07:44', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(185, 255, 272, 38, 38, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-11-07 00:07:44', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(186, 255, 272, 39, 39, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '5', 'AF5-003', '2017-10-10', '0', '2015-11-07 00:37:58', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(187, 255, 272, 39, 39, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '30', 'CS1-002', '2017-10-09', '0', '2015-11-07 00:37:58', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(188, 255, 262, 40, 40, 0, 1, 21, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '10', 'AFS-002', '2017-10-10', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(189, 255, 262, 40, 40, 0, 3, 8, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '10', 'AF1-003', '2015-10-08', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(190, 255, 262, 40, 40, 0, 4, 10, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '10', 'AF5-003', '2017-10-10', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(191, 255, 262, 40, 40, 0, 6, 12, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '10', 'CSS-002', '2017-10-09', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(192, 255, 262, 40, 40, 0, 5, 16, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '10', 'CS1-002', '2017-10-09', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(193, 255, 262, 40, 40, 0, 2, 14, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '10', 'CS5-002', '2017-10-08', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(194, 255, 262, 40, 40, 0, 7, 18, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '10', 'GS1-002', '2017-10-09', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(195, 255, 262, 40, 40, 0, 8, 20, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '10', 'GS6-002', '2017-10-09', '0', '2015-11-07 20:05:10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_order`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_order` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Complete') NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_retailer_order`
--

INSERT INTO `simbanic_retailer_order` (`id`, `created_by`, `retailer_id`, `comment`, `total`, `status`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 255, 267, '', '20610', 'Complete', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(2, 255, 285, '', '10305', 'Complete', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(3, 255, 286, '', '51525', 'Complete', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(4, 255, 288, '', '30915', 'Complete', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(5, 255, 298, '', '51525', 'Complete', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(6, 255, 295, '', '41160', 'Complete', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(7, 257, 290, '', '13440', 'Complete', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(8, 257, 289, '', '28100', 'Complete', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(9, 257, 291, '', '15720', 'Complete', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(10, 257, 296, '', '16380', 'Complete', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(11, 257, 297, '', '13000', 'Complete', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(12, 255, 272, '', '19310', 'Complete', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(13, 255, 274, '', '23636', 'Complete', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(14, 255, 273, '', '14950', 'Complete', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(15, 255, 284, '', '9660', 'Complete', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(16, 255, 272, '', '11750', 'Complete', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(17, 255, 274, '', '1175', 'Complete', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(18, 255, 273, '', '1900', 'Complete', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(19, 255, 268, '', '11960', 'Complete', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(20, 255, 291, '', '4310', 'Complete', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(21, 255, 262, '', '12910', 'Complete', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(22, 255, 261, '', '5750', 'Complete', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(23, 255, 277, '', '17410', 'Complete', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(24, 255, 278, '', '9900', 'Complete', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(25, 255, 272, '', '17410', 'Complete', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(26, 255, 272, '', '4950', 'Complete', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(27, 255, 291, '', '7590', 'Complete', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(28, 255, 290, '', '13250', 'Complete', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(29, 255, 268, '', '16544', 'Complete', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(30, 257, 272, '', '10850', 'Complete', '2015-10-10 18:57:08', '2015-10-10 18:57:08', '0'),
(31, 257, 272, '', '10850', 'Complete', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(32, 257, 262, '', '18800', 'Complete', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(33, 257, 261, '', '36080', 'Complete', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(34, 255, 263, '', '61830', 'Complete', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(35, 255, 298, '', '61830', 'Complete', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(36, 255, 267, '', '11430', 'Complete', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(37, 255, 272, '', '10850', 'Complete', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(38, 255, 272, '', '14025', 'Complete', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(39, 255, 272, '', '5875', 'Complete', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(40, 255, 262, '', '20610', 'Complete', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_order_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_order_product` (
  `id` int(11) NOT NULL,
  `retailer_order_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `packing_size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `mrp` varchar(50) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_retailer_order_product`
--

INSERT INTO `simbanic_retailer_order_product` (`id`, `retailer_order_id`, `created_by`, `product_id`, `name`, `packing_size`, `unit`, `price`, `mrp`, `quantity`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(2, 1, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(3, 1, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(4, 1, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(5, 1, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(6, 1, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(7, 1, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(8, 1, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 16:49:35', '2015-10-08 16:49:35', '0'),
(9, 2, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(10, 2, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(11, 2, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(12, 2, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(13, 2, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(14, 2, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(15, 2, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(16, 2, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '5', '2015-10-08 16:52:51', '2015-10-08 16:52:51', '0'),
(17, 3, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(18, 3, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(19, 3, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(20, 3, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(21, 3, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(22, 3, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(23, 3, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(24, 3, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '2015-10-08 17:09:17', '2015-10-08 17:09:17', '0'),
(25, 4, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(26, 4, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(27, 4, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(28, 4, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(29, 4, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(30, 4, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(31, 4, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(32, 4, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '15', '2015-10-08 17:14:34', '2015-10-08 17:14:34', '0'),
(33, 5, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(34, 5, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(35, 5, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(36, 5, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(37, 5, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(38, 5, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(39, 5, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(40, 5, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '2015-10-08 17:23:08', '2015-10-08 17:23:08', '0'),
(41, 6, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '25', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(42, 6, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(43, 6, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '15', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(44, 6, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(45, 6, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '50', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(46, 6, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(47, 6, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(48, 6, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '25', '2015-10-08 17:24:30', '2015-10-08 17:24:30', '0'),
(49, 7, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '12', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(50, 7, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '12', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(51, 7, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '12', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(52, 7, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '12', '2015-10-08 18:48:35', '2015-10-08 18:48:35', '0'),
(53, 8, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(54, 8, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(55, 8, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(56, 8, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(57, 8, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(58, 8, 257, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '20', '2015-10-08 18:51:43', '2015-10-08 18:51:43', '0'),
(59, 9, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(60, 9, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(61, 9, 257, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '20', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(62, 9, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '20', '2015-10-08 18:55:01', '2015-10-08 18:55:01', '0'),
(63, 10, 257, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '12', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(64, 10, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '12', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(65, 10, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '12', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(66, 10, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '12', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(67, 10, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '12', '2015-10-08 18:55:53', '2015-10-08 18:55:53', '0'),
(68, 11, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(69, 11, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(70, 11, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(71, 11, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '2015-10-08 18:57:20', '2015-10-08 18:57:20', '0'),
(72, 12, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(73, 12, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(74, 12, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(75, 12, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(76, 12, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(77, 12, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(78, 12, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 19:02:25', '2015-10-08 19:02:25', '0'),
(79, 13, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '16', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(80, 13, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '15', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(81, 13, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '17', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(82, 13, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(83, 13, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(84, 13, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 19:03:15', '2015-10-08 19:03:15', '0'),
(85, 14, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(86, 14, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '20', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(87, 14, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '20', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(88, 14, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(89, 14, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 19:04:16', '2015-10-08 19:04:16', '0'),
(90, 15, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(91, 15, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(92, 15, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(93, 15, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(94, 15, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 19:05:06', '2015-10-08 19:05:06', '0'),
(95, 16, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(96, 16, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(97, 16, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 22:22:13', '2015-10-08 22:22:13', '0'),
(98, 17, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '1', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(99, 17, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '1', '2015-10-08 22:23:14', '2015-10-08 22:23:14', '0'),
(100, 18, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(101, 18, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(102, 18, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 22:25:34', '2015-10-08 22:25:34', '0'),
(103, 19, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(104, 19, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(105, 19, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(106, 19, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 22:26:13', '2015-10-08 22:26:13', '0'),
(107, 20, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(108, 20, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(109, 20, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 22:27:46', '2015-10-08 22:27:46', '0'),
(110, 21, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(111, 21, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(112, 21, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 22:30:29', '2015-10-08 22:30:29', '0'),
(113, 22, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(114, 22, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '25', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(115, 22, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '15', '2015-10-08 22:31:52', '2015-10-08 22:31:52', '0'),
(116, 23, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(117, 23, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(118, 23, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(119, 23, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 23:22:28', '2015-10-08 23:22:28', '0'),
(120, 24, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(121, 24, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 23:24:11', '2015-10-08 23:24:11', '0'),
(122, 25, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(123, 25, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(124, 25, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(125, 25, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-08 23:25:36', '2015-10-08 23:25:36', '0'),
(126, 26, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '5', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(127, 26, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '5', '2015-10-08 23:26:21', '2015-10-08 23:26:21', '0'),
(128, 27, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '6', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(129, 27, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '6', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(130, 27, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '2', '2015-10-08 23:28:01', '2015-10-08 23:28:01', '0'),
(131, 28, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(132, 28, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '40', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(133, 28, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-08 23:33:28', '2015-10-08 23:33:28', '0'),
(134, 29, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '4', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(135, 29, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '5', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(136, 29, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '4', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(137, 29, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '40', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(138, 29, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '18', '2015-10-08 23:35:16', '2015-10-08 23:35:16', '0'),
(139, 30, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-10 18:57:08', '2015-10-10 18:57:08', '0'),
(140, 30, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-10 18:57:08', '2015-10-10 18:57:08', '0'),
(141, 31, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(142, 31, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-10 18:58:01', '2015-10-10 18:58:01', '0'),
(143, 32, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(144, 32, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(145, 32, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(146, 32, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(147, 32, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(148, 32, 257, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(149, 32, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '5', '2015-10-22 12:19:09', '2015-10-22 12:19:09', '0'),
(150, 33, 257, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '20', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(151, 33, 257, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '25', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(152, 33, 257, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '38', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(153, 33, 257, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '6', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(154, 33, 257, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '15', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(155, 33, 257, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '20', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(156, 33, 257, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '3', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(157, 33, 257, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '8', '2015-10-22 12:27:04', '2015-10-22 12:27:04', '0'),
(158, 34, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(159, 34, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(160, 34, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(161, 34, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(162, 34, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(163, 34, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(164, 34, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(165, 34, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '30', '2015-10-22 12:45:45', '2015-10-22 12:45:45', '0'),
(166, 35, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(167, 35, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(168, 35, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(169, 35, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(170, 35, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(171, 35, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(172, 35, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(173, 35, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '30', '2015-10-22 12:48:07', '2015-10-22 12:48:07', '0'),
(174, 36, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '5', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(175, 36, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(176, 36, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-06 14:56:17', '2015-11-06 14:56:17', '0'),
(177, 37, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(178, 37, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-11-07 00:04:59', '2015-11-07 00:04:59', '0'),
(179, 38, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '15', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(180, 38, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-11-07 00:07:01', '2015-11-07 00:07:01', '0'),
(181, 39, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '5', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(182, 39, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '30', '2015-11-07 00:37:35', '2015-11-07 00:37:35', '0'),
(183, 40, 255, 1, 'ALLMIN FORTE', '400', 'gm', '60', '100', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(184, 40, 255, 3, 'ALLMIN FORTE', '1', 'kg', '130', '180', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(185, 40, 255, 4, 'ALLMIN FORTE', '5', 'kg', '635', '890', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(186, 40, 255, 6, 'CATTLE SODA', '400', 'gm', '40', '65', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(187, 40, 255, 5, 'CATTLE SODA', '1', 'kg', '90', '116', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(188, 40, 255, 2, 'CATTLE SODA', '5', 'kg', '450', '600', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(189, 40, 255, 7, 'GRASSCAL GOLD', '1.25', 'ltr', '116', '180', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0'),
(190, 40, 255, 8, 'GRASSCAL GOLD', '6.25', 'ltr', '540', '820', '10', '2015-11-07 20:04:53', '2015-11-07 20:04:53', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_payment`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_payment` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `method` varchar(100) NOT NULL,
  `cash_type` varchar(255) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `cheque_no` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `transfer_id` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `confirm_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `date_pending` datetime NOT NULL,
  `date_done` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_retailer_payment`
--

INSERT INTO `simbanic_retailer_payment` (`id`, `created_by`, `depot_id`, `retailer_id`, `created_at`, `amount`, `method`, `cash_type`, `receipt_no`, `cheque_no`, `bank_name`, `bank_branch`, `transfer_id`, `date`, `confirm_date`, `remark`, `status`, `date_pending`, `date_done`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 0, 255, 267, 'depot', '2500', 'Cash', 'cash_on_hand', '11111', '', '', '', '', '2015-10-08', '2015-10-08', '', 'Done', '0000-00-00 00:00:00', '2015-10-08 21:50:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
(2, 0, 255, 262, 'depot', '2000', 'Cash', 'cash_on_hand', '11111', '', '', '', '', '2015-10-10', '2015-10-01', '11', 'Done', '2015-10-10 13:19:32', '2015-10-10 13:19:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
(3, 0, 255, 268, 'depot', '1000', 'Cheque', 'cash_on_hand', '', '12345', 'SBI', 'THARAD', '', '2015-10-10', '2015-10-10', '', 'Done', '2015-10-10 19:32:22', '2015-10-10 19:32:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_stock`
--

CREATE TABLE IF NOT EXISTS `simbanic_stock` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_stock`
--

INSERT INTO `simbanic_stock` (`id`, `created_by`, `product_id`, `batch_no`, `quantity`, `expiry_date`, `status`, `date_created`, `date_modified`, `deleted`) VALUES
(1, 1, 1, 'AFS-001', '100', '2015-10-08', '0', '2015-10-08 10:59:20', '2015-10-08 10:59:20', '0'),
(2, 1, 3, 'AF1-001', '100', '2017-10-08', '0', '2015-10-08 11:00:29', '2015-10-08 11:00:29', '0'),
(3, 1, 4, 'AF5-001', '100', '2017-10-08', '0', '2015-10-08 11:03:13', '2015-10-08 11:03:13', '0'),
(4, 1, 1, 'AFS-002', '100', '2017-10-09', '0', '2015-10-08 11:17:47', '2015-10-08 11:17:47', '1'),
(5, 1, 1, 'AFS-001', '150', '2017-10-05', '0', '2015-10-08 11:18:18', '2015-10-08 11:18:18', '0'),
(6, 1, 3, 'AF1-001', '100', '2017-10-09', '0', '2015-10-08 11:19:23', '2015-10-08 11:19:23', '1'),
(7, 1, 3, 'AF1-002', '100', '2017-10-09', '0', '2015-10-08 11:19:50', '2015-10-08 11:19:50', '0'),
(8, 1, 3, 'AF1-003', '100', '2015-10-08', '0', '2015-10-08 11:20:20', '2015-10-08 11:20:20', '0'),
(9, 1, 4, 'AF5-002', '100', '2017-10-09', '0', '2015-10-08 11:21:04', '2015-10-08 11:21:04', '0'),
(10, 1, 4, 'AF5-003', '500', '2017-10-10', '0', '2015-10-08 11:21:27', '2015-10-08 11:21:27', '0'),
(11, 1, 6, 'CSS-001', '100', '2017-10-08', '0', '2015-10-08 11:21:55', '2015-10-08 11:21:55', '0'),
(12, 1, 6, 'CSS-002', '500', '2017-10-09', '0', '2015-10-08 11:22:19', '2015-10-08 11:22:19', '0'),
(13, 1, 2, 'CS5-001', '100', '2017-10-08', '0', '2015-10-08 11:22:48', '2015-10-08 11:22:48', '0'),
(14, 1, 2, 'CS5-002', '500', '2017-10-08', '0', '2015-10-08 11:23:07', '2015-10-08 11:23:07', '0'),
(15, 1, 5, 'CS1-001', '100', '2017-10-08', '0', '2015-10-08 11:23:32', '2015-10-08 11:23:32', '0'),
(16, 1, 5, 'CS1-002', '500', '2017-10-09', '0', '2015-10-08 11:23:53', '2015-10-08 11:23:53', '0'),
(17, 1, 7, 'GS1-001', '100', '2017-10-08', '0', '2015-10-08 11:24:18', '2015-10-08 11:24:18', '0'),
(18, 1, 7, 'GS1-002', '500', '2017-10-09', '0', '2015-10-08 11:24:39', '2015-10-08 11:24:39', '0'),
(19, 1, 8, 'GS6-001', '100', '2017-10-08', '0', '2015-10-08 11:25:14', '2015-10-08 11:25:14', '0'),
(20, 1, 8, 'GS6-002', '500', '2017-10-09', '0', '2015-10-08 11:25:35', '2015-10-08 11:25:35', '0'),
(21, 1, 1, 'AFS-002', '100', '2017-10-10', '0', '2015-10-08 21:26:23', '2015-10-08 21:26:23', '0'),
(22, 1, 1, 'AFS-123', '200', '2021-11-25', '0', '2015-11-04 15:23:03', '2015-11-04 15:23:03', '1'),
(23, 1, 1, 'afs-009', '500', '2020-11-18', '0', '2015-11-06 17:54:56', '2015-11-06 17:54:56', '0'),
(24, 1, 3, 'Af1-005', '100', '2021-11-05', '0', '2015-11-10 18:36:22', '2015-11-10 18:36:22', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_carry_forward`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_carry_forward` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `sponsor_id` varchar(255) NOT NULL,
  `stage1_gram_quantity` float NOT NULL,
  `stage1_milliliter_quantity` float NOT NULL,
  `stage2_gram_quantity` float NOT NULL,
  `stage2_milliliter_quantity` float NOT NULL,
  `stage3_gram_quantity` float NOT NULL,
  `stage3_milliliter_quantity` float NOT NULL,
  `stage4_gram_quantity` float NOT NULL,
  `stage4_milliliter_quantity` float NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_point`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_point` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `sponsor_id` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `customer_type` varchar(100) NOT NULL,
  `buy_unit` varchar(100) NOT NULL,
  `prescription_unit` varchar(100) NOT NULL,
  `otc_prescription_unit` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total_unit` varchar(50) NOT NULL,
  `cf_unit` varchar(50) NOT NULL,
  `point` bigint(20) NOT NULL,
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simbanic_temp_point`
--

INSERT INTO `simbanic_temp_point` (`id`, `user_id`, `customer_id`, `sponsor_id`, `full_name`, `customer_type`, `buy_unit`, `prescription_unit`, `otc_prescription_unit`, `unit`, `total_unit`, `cf_unit`, `point`, `date_confirm`, `date_created`) VALUES
(1, 262, 'GUJ0009', 'GUJ0006', 'JAYESHBHAI SOLANKI', 'medical_store', '203', '', '65.15', '50', '65.15', '0', 1, '2015-11-07 20:05:10', '2015-11-09 18:15:25'),
(2, 267, 'GUJ0012', 'GUJ0007', 'BHARAT RATHOD', 'doctor', '106.25', '52', '', '150', '158.25', '0', 3, '2015-11-06 14:59:02', '2015-11-09 18:15:25'),
(3, 272, 'GUJ0017', 'GUJ0013', 'B.G KAG', 'doctor', '280', '13.65', '', '250', '293.65', '43.64999999999998', 6, '2015-11-07 00:05:42', '2015-11-09 18:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_report`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `sponsor_id` varchar(255) NOT NULL,
  `stage1_gram_quantity` varchar(255) NOT NULL,
  `stage1_milliliter_quantity` varchar(255) NOT NULL,
  `stage2_gram_quantity` varchar(255) NOT NULL,
  `stage2_milliliter_quantity` varchar(255) NOT NULL,
  `stage3_gram_quantity` varchar(255) NOT NULL,
  `stage3_milliliter_quantity` varchar(255) NOT NULL,
  `stage4_gram_quantity` varchar(255) NOT NULL,
  `stage4_milliliter_quantity` varchar(255) NOT NULL,
  `total_quantity` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_user`
--

CREATE TABLE IF NOT EXISTS `simbanic_user` (
  `id` int(11) unsigned NOT NULL,
  `simbanic_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `sponsor_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `user_type` enum('admin','customer','depot','pharma') NOT NULL DEFAULT 'customer',
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `simbanic_user`
--

INSERT INTO `simbanic_user` (`id`, `simbanic_id`, `customer_id`, `sponsor_id`, `full_name`, `mobile_no`, `user_type`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 0, 'GUJ0001', '0', 'Walart Admin', '', 'admin', '127.0.0.1', 'administrator', '$2y$08$SAHEL/.JFH3vwVrEWl3EN.m5wNrVz/lzTUP6RH8e4AVaMRYl.e05.', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1447159193, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(255, 1, 'GUJ0002D', '0', 'ABHAY RAMANI', '9724154433', 'depot', '1.23.141.222', '', '$2y$08$YbcR2eeteaa8YF6b5ioL0.Zdw3QuyKXAXMhS1TKyBtitE0RXinE0q', NULL, '', NULL, NULL, NULL, NULL, 1441873386, 1447160813, 1, NULL, NULL, NULL, NULL),
(256, 2, 'GUJ0003D', '0', 'VIPUL PATEL', '9714966227', 'depot', '1.23.141.222', '', '$2y$08$a0aQA9bhSk8NqMvulEVGI.rjgEQqrfzPZUTqkUfZa6s5dQwQPgpXG', NULL, '', NULL, NULL, NULL, NULL, 1441873689, 1444823251, 1, NULL, NULL, NULL, NULL),
(257, 3, 'GUJ0004D', '0', 'RAVI BHESANIYA', '8128943424', 'depot', '1.23.141.222', '', '$2y$08$AgqsD07KkVyy5TGNDx7M1ePuz63sZ7YpwOGIDIcERSn8X2vugxvu6', NULL, '', NULL, NULL, NULL, NULL, 1441874141, 1445497009, 1, NULL, NULL, NULL, NULL),
(258, 64, 'GUJ0005', 'GUJ0001', 'YOGESHBHAI', '1234567890', 'customer', '115.118.252.21', '', '$2y$08$mfMKOCemnwz5oO7VE5Ac3.KKyeaZwRWcAQEZZNRM/yit/1EaH95wG', NULL, '', NULL, NULL, NULL, NULL, 1441951906, 1446015132, 1, NULL, NULL, NULL, NULL),
(259, 65, 'GUJ0006', 'GUJ0001', 'JIGISHA', '1234567890', 'customer', '115.118.252.54', '', '$2y$08$/FeDUM4ZZx.Y.2uHRjzMlepI1VC9Jdm3I5c7.F4a47R2bopfqCyae', NULL, '', NULL, NULL, NULL, NULL, 1441962886, 1444326204, 1, NULL, NULL, NULL, NULL),
(260, 66, 'GUJ0007', 'GUJ0006', 'DR KANTILAL BHABHAR', '1234567890', 'customer', '115.118.252.54', '', '$2y$08$OvbSR7pfSVoItYLXGp2F4O37s.8nXC687Rzx.crTpfhmLT/m.9KkS', NULL, '', NULL, NULL, NULL, NULL, 1441963243, 1445259008, 1, NULL, NULL, NULL, NULL),
(261, 67, 'GUJ0008', 'GUJ0006', 'NARSHIBHAI DHANERA', '1234567890', 'customer', '115.118.252.54', '', '$2y$08$vZMsnNOERELAKEUcimAUbuAe1BvMNRFjW6J8UsoDZ5JFOz68mlf.2', NULL, '', NULL, NULL, NULL, NULL, 1441963479, 1446802992, 1, NULL, NULL, NULL, NULL),
(262, 68, 'GUJ0009', 'GUJ0006', 'JAYESHBHAI SOLANKI', '1111111111', 'customer', '115.118.252.54', '', '$2y$08$.Hk254PA5ncr.nOJgXVTqeCf80G4g0YdatuoILAPp8t5PpRDFc95u', NULL, '', NULL, NULL, NULL, NULL, 1441963752, 1447164541, 1, NULL, NULL, NULL, NULL),
(263, 69, 'GUJ0010', 'GUJ0006', 'HARIBHAI DAHIMA', '1234567890', 'customer', '115.118.252.54', '', '$2y$08$pxGG4ArLAM3TbMzV4bTsWO87cm7Q31AuCMuzkq6.dIA8dv1wQSoUC', NULL, '', NULL, NULL, NULL, NULL, 1441963856, 1446834152, 1, NULL, NULL, NULL, NULL),
(266, 72, 'GUJ0011', 'GUJ0006', 'JAYDIPBHAI MORI', '9724563175', 'customer', '43.250.165.193', '', '$2y$08$nPS4sVpQZzJjEooiGRV3pOAKg2La4HIatzjN67rS5wqZGMYpQlzwW', NULL, '', NULL, NULL, NULL, NULL, 1441974310, 1446905408, 1, NULL, NULL, NULL, NULL),
(267, 73, 'GUJ0012', 'GUJ0007', 'BHARAT RATHOD', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$IAa8BoEYs/erle932jSYJ.TldMDl6YbcKzfNg47eI33czULbtp3a6', NULL, '', NULL, NULL, NULL, NULL, 1442049148, 1446802117, 1, NULL, NULL, NULL, NULL),
(268, 74, 'GUJ0013', 'GUJ0012', 'MOMIN SIR', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$fhlcd/KxEWDWi1NZlWjMOeD4FIzBfoYSXarhqi7EiN6Rijdi96B9.', NULL, '', NULL, NULL, NULL, NULL, 1442050312, 1446834535, 1, NULL, NULL, NULL, NULL),
(269, 75, 'GUJ0014', 'GUJ0012', 'HITENDRA', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$On6uGFBRzAy5bW1Q6Ij5huLJUgm/tl9ES4WgJpzyKzScycUzLdEOC', NULL, '', NULL, NULL, NULL, NULL, 1442050477, 1446803437, 1, NULL, NULL, NULL, NULL),
(270, 76, 'GUJ0015', 'GUJ0012', 'VIKRAMBHAI', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$9CTM1tvrTKab35.JZBAJHuGaXyUOc8iRj7yofHoSs5nskbScM8oVW', NULL, '', NULL, NULL, NULL, NULL, 1442050578, 1446797635, 1, NULL, NULL, NULL, NULL),
(271, 77, 'GUJ0016', 'GUJ0012', 'VIKRAMBHAI SUIGAM', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$I6FHRA.AMKx2fFj2g6eyLOLm7NOaMbCCJJisV/bH0u9IGog8vWC8y', NULL, '', NULL, NULL, NULL, NULL, 1442050672, NULL, 1, NULL, NULL, NULL, NULL),
(272, 78, 'GUJ0017', 'GUJ0013', 'B.G KAG', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$mr7117nfBA2vEHJ2cT4Gd.ZihHWhbDXRn8mJTP/Xdz/IUHY1ifNBG', NULL, '', NULL, NULL, NULL, NULL, 1442050738, 1446836869, 1, NULL, NULL, NULL, NULL),
(273, 79, 'GUJ0018', 'GUJ0013', 'UMESHBHAI LAKHANI', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$cNbKPMckqJ3XEWtWFZ927O7n3mpeNWAATX8j/HwbCeX4K2Xy2QECq', NULL, '', NULL, NULL, NULL, NULL, 1442050796, 1445600576, 1, NULL, NULL, NULL, NULL),
(274, 80, 'GUJ0019', 'GUJ0013', 'PADHAR', '9724563175', 'customer', '49.200.243.255', '', '$2y$08$JibC0V4Odtdnm.M0rdSVN.54SNKn.qbzdmIuUBKLZemy4YySE.Jwy', NULL, '', NULL, NULL, NULL, NULL, 1442050857, 1446636491, 1, NULL, NULL, NULL, NULL),
(275, 81, 'GUJ0020', 'GUJ0013', 'NAGARALI', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$QMoqluiNtXajjR7AiW3UZOntOzQSFmZiJCTjzaz2/y7qAxfn6LTaS', NULL, '', NULL, NULL, NULL, NULL, 1442051187, 1444057555, 1, NULL, NULL, NULL, NULL),
(276, 82, 'GUJ0021', 'GUJ0013', 'MOGNOJIYA', '1234567890', 'customer', '49.200.243.255', '', '$2y$08$HOOB5xIxh.9KAK7ZrebiXOhum58Q51ugM0liza2dJ3RtXvOjBxEsy', NULL, '', NULL, NULL, NULL, NULL, 1442051238, 1446125860, 1, NULL, NULL, NULL, NULL),
(277, 83, 'GUJ0022', 'GUJ0017', 'JETHABHAI', '1234567890', 'customer', '49.200.127.180', '', '$2y$08$mpqWbiq1Q./EohuTCcj9DOlerJ/lf55kos.Nl.0u7BT/k79GpMdCO', NULL, '', NULL, NULL, NULL, NULL, 1442058387, 1446014722, 1, NULL, NULL, NULL, NULL),
(278, 84, 'GUJ0023', 'GUJ0017', 'N J PATEL', '1234567890', 'customer', '49.200.127.180', '', '$2y$08$YGbMX1XxhtevVs6EYG348Of39gqtkvp3u/h8AFs27H8dXyXXD87mG', NULL, '', NULL, NULL, NULL, NULL, 1442058551, 1446015510, 1, NULL, NULL, NULL, NULL),
(279, 85, 'GUJ0024', 'GUJ0017', 'R D PATEL', '1234567890', 'customer', '49.200.127.180', '', '$2y$08$/PpXGAgo6MhM5tGAay64auOzdLgM31eXHkuYwhQbWgUyTzm1dwrNG', NULL, '', NULL, NULL, NULL, NULL, 1442058638, 1446015008, 1, NULL, NULL, NULL, NULL),
(280, 86, 'GUJ0025', 'GUJ0018', 'MANSAJI', '1234567890', 'customer', '49.200.127.180', '', '$2y$08$yJKISzAsMUn5oDDe8m.G/.6U7x2TBO.CanPrFdsUEB17PH5wsnr9m', NULL, '', NULL, NULL, NULL, NULL, 1442058776, 1444224857, 1, NULL, NULL, NULL, NULL),
(281, 87, 'GUJ0026', 'GUJ0018', 'LAKHNI DR', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$KwZTeUUTe/VnAs7G4Yb.SeMv0fpPYw/A3thYFof90FHyIvrn7zeKK', NULL, '', NULL, NULL, NULL, NULL, 1442287875, 1444197857, 1, NULL, NULL, NULL, NULL),
(282, 88, 'GUJ0027', 'GUJ0021', 'NAGAR ALI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$gq0Knvuo7eJJMrcIXMMIiO9rd2ubiinAx0LYHOiNDnn0RWz6291IW', NULL, '', NULL, NULL, NULL, NULL, 1442287944, 1446005092, 1, NULL, NULL, NULL, NULL),
(283, 89, 'GUJ0028', 'GUJ0014', 'PRAJAPATI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$wsrpeGQr3jezb06vyESJ3.6F9Nk2i6yUGHp8r6tVemNLVa6KVmxu.', NULL, '', NULL, NULL, NULL, NULL, 1442288071, NULL, 1, NULL, NULL, NULL, NULL),
(284, 90, 'GUJ0029', 'GUJ0015', 'VANRAJ PAN', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$0ole6iFySGN/UjOJuXTnnO2bA2i.PiN1sc3fUG0QVX0O9s8eCI/by', NULL, '', NULL, NULL, NULL, NULL, 1442288166, 1444320350, 1, NULL, NULL, NULL, NULL),
(285, 91, 'GUJ0030', 'GUJ0008', 'DAYABHAI', '1234568090', 'customer', '49.200.243.213', '', '$2y$08$uFIaHpH.0D7oTpAWZpxYeeKiTrNwDzI1eC8CJ5MfIzpIkqIybK1.a', NULL, '', NULL, NULL, NULL, NULL, 1442288287, 1444309032, 1, NULL, NULL, NULL, NULL),
(286, 92, 'GUJ0031', 'GUJ0009', 'KB VALA', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$1L86DNwG2hV776ohY8X7nectis8kzfpix1.etVvvq2OB1uLjUe1QO', NULL, '', NULL, NULL, NULL, NULL, 1442288356, 1444309065, 1, NULL, NULL, NULL, NULL),
(287, 93, 'GUJ0032', 'GUJ0009', 'CHOTHANI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$HHz3xQ4ZRuNTsUdIdAhkvu/sohmBaZe4dLh2Ukjc2WIo0.fhpkH82', NULL, '', NULL, NULL, NULL, NULL, 1442288410, 1444114867, 1, NULL, NULL, NULL, NULL),
(288, 94, 'GUJ0033', 'GUJ0009', 'R B SOLANKI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$2nffYHdYwLWSDjPrce/XSet23KRSafIlpy25nPbSHFu7plrnWLGiW', NULL, '', NULL, NULL, NULL, NULL, 1442288467, 1444309105, 1, NULL, NULL, NULL, NULL),
(289, 95, 'GUJ0034', 'GUJ0032', 'KUNADIYA', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$ZVQwFW5Ovh47b96p2aEjA.MS8DMFB5x7Ge1sGaLisrNzO4dt36EBa', NULL, '', NULL, NULL, NULL, NULL, 1442288600, 1444311786, 1, NULL, NULL, NULL, NULL),
(290, 96, 'GUJ0035', 'GUJ0031', 'PATAT', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$F3zwIrY9T.8Ct3BUwU3b9e5T4tPj4LSw1tTonpaUul/GzA5P9Q4B.', NULL, '', NULL, NULL, NULL, NULL, 1442288654, 1444328267, 1, NULL, NULL, NULL, NULL),
(291, 97, 'GUJ0036', 'GUJ0033', 'KACHOT', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$YN.h0F0C9PzbAF0T7bbZwuLMuLFt8m1HyBFmrFWQnmBs92saKIUz.', NULL, '', NULL, NULL, NULL, NULL, 1442288894, 1444328321, 1, NULL, NULL, NULL, NULL),
(292, 98, 'GUJ0037', 'GUJ0010', 'DAHIMA', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$T.BY6WxN7f7qTEp.9XzbVeYfCsMAbqfLy2D6rPdrRstErOszY.B5m', NULL, '', NULL, NULL, NULL, NULL, 1442288973, 1444308952, 1, NULL, NULL, NULL, NULL),
(293, 99, 'GUJ0038', 'GUJ0037', 'MANUBHAI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$3V7CSmeupoou/J5ibkivguSry8lJzXJqQ7Q4dYAAisEB4aFC2T53u', NULL, '', NULL, NULL, NULL, NULL, 1442289185, 1444227479, 1, NULL, NULL, NULL, NULL),
(294, 100, 'GUJ0039', 'GUJ0011', 'SOLANKI', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$o/Sn4gFpQRZQ36FcIia./.AzpXCFDt8/H1cZsyBW4RQXINiDXrZqe', NULL, '', NULL, NULL, NULL, NULL, 1442289411, 1444463673, 1, NULL, NULL, NULL, NULL),
(295, 101, 'GUJ0040', 'GUJ0039', 'BABUBHAI CHAUDHARY', '1234567890', 'customer', '49.200.243.213', '', '$2y$08$SCp2ApjNQgZQPmgsmpuqtOrgMjnm8SLeS6TViPyKfkmxYmCY8AMU.', NULL, '', NULL, NULL, NULL, NULL, 1442289486, 1444309135, 1, NULL, NULL, NULL, NULL),
(296, 102, 'GUJ0041', 'GUJ0038', 'BHARATSINH', '1234567890', 'customer', '49.200.127.180', '', '$2y$08$zPD0DpZCKqlRxnhABQN4n.hKaCOx5JAA4g8tMODnpLuTReHHbu5O.', NULL, '', NULL, NULL, NULL, NULL, 1443867551, 1444312073, 1, NULL, NULL, NULL, NULL),
(297, 103, 'GUJ0042', 'GUJ0040', 'MUKESHBHAI HADIYA', '1234567890', 'customer', '115.118.252.20', '', '$2y$08$4D5xzbwhd9BfD9poPvwEMukYj8g.dC8V6NOpRYQgpSRy6gKfrC1CC', NULL, '', NULL, NULL, NULL, NULL, 1444125581, 1446803511, 1, NULL, NULL, NULL, NULL),
(298, 104, 'GUJ0043', 'GUJ0037', 'MADHAV MED', '1234567890', 'customer', '115.118.252.20', '', '$2y$08$HiauXW892QAg4UIfIzd0MuPQvJAn1tLayy.8s68XA6fDHKQICNDy.', NULL, '', NULL, NULL, NULL, NULL, 1444125912, 1446801094, 1, NULL, NULL, NULL, NULL),
(299, 105, 'GUJ0044', 'GUJ0035', 'ASHOKBHAI HADIYA', '1111111111', 'customer', '115.118.252.20', '', '$2y$08$avnavl8pR.dtYer5zjrm0ex6CAvqGN7S1eF8ydafc9jaWae9R8gqW', NULL, '', NULL, NULL, NULL, NULL, 1444126675, 1444463773, 1, NULL, NULL, NULL, NULL),
(300, 106, 'GUJ0045', 'GUJ0041', 'BHANBHAI', '9724563175', 'customer', '49.200.127.157', '', '$2y$08$k0c6jZmTgwh0ih7EbJBGN.j.FV5.4uv2HbtBJkX1UzsPRH9rruSa2', NULL, '', NULL, NULL, NULL, NULL, 1444480809, 1445860245, 1, NULL, NULL, NULL, NULL),
(301, 107, 'GUJ0046', 'GUJ0034', 'Dr Aryan N Ramani', '9724154433', 'customer', '49.200.127.197', '', '$2y$08$HFeufa//eXUDJgUSf427vO17qezjSDal6coiksqR6yL02ombV6rTi', NULL, '', NULL, NULL, NULL, NULL, 1445756959, 1446804375, 1, NULL, NULL, NULL, NULL),
(302, 108, 'GUJ0047', 'GUJ0030', 'HARSHAD RAMANI', '7623872700', 'customer', '49.200.127.197', '', '$2y$08$ShCTJCwd8AguRxVTHYyoRumjFc2eZb0nwNh43TR3uKf4rQrTTTqKe', NULL, '', NULL, NULL, NULL, NULL, 1445757281, 1446457184, 1, NULL, NULL, NULL, NULL),
(303, 109, 'GUJ0048', 'GUJ0046', 'JIGU RAMANI', '7383366639', 'customer', '115.118.252.43', '', '$2y$08$N2TKoKA89Z5pDEtWibTL8.QT91vEMa5rhhWH/iFiljy3ttfsg5HhC', NULL, '', NULL, NULL, NULL, NULL, 1446025617, 1446805025, 1, NULL, NULL, NULL, NULL),
(304, 110, 'GUJ0049', 'GUJ0009', 'BABUBHAI RAMANI', '7623872700', 'customer', '115.118.252.43', '', '$2y$08$k/OFosRoFWw3VoqdPRglFO1OnsHmeSOXLF0zy7k3n8FzaZrxySy6a', NULL, '', NULL, NULL, NULL, NULL, 1446025820, 1446803883, 1, NULL, NULL, NULL, NULL),
(305, 111, 'GUJ0050', 'GUJ0032', 'Dr.Vipul R. Patel', '9714966227', 'customer', '49.200.127.229', '', '$2y$08$7R1yee2F5wE9RbekBsaFIOTzUtRTYP6y3/0ZsM7bcHx1DOqE7.BGu', NULL, '', NULL, NULL, NULL, NULL, 1446798274, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_user_group`
--

CREATE TABLE IF NOT EXISTS `simbanic_user_group` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `simbanic_user_group`
--

INSERT INTO `simbanic_user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(249, 255, 4),
(250, 256, 4),
(251, 257, 4),
(252, 258, 3),
(253, 259, 3),
(254, 260, 3),
(255, 261, 3),
(256, 262, 3),
(257, 263, 3),
(258, 266, 3),
(259, 267, 3),
(260, 268, 3),
(261, 269, 3),
(262, 270, 3),
(263, 271, 3),
(264, 272, 3),
(265, 273, 3),
(266, 274, 3),
(267, 275, 3),
(268, 276, 3),
(269, 277, 3),
(270, 278, 3),
(271, 279, 3),
(272, 280, 3),
(273, 281, 3),
(274, 282, 3),
(275, 283, 3),
(276, 284, 3),
(277, 285, 3),
(278, 286, 3),
(279, 287, 3),
(280, 288, 3),
(281, 289, 3),
(282, 290, 3),
(283, 291, 3),
(284, 292, 3),
(285, 293, 3),
(286, 294, 3),
(287, 295, 3),
(288, 296, 3),
(289, 297, 3),
(290, 298, 3),
(291, 299, 3),
(292, 300, 3),
(293, 301, 3),
(294, 302, 3),
(295, 303, 3),
(296, 304, 3),
(297, 305, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simbanic_ci_sessions`
--
ALTER TABLE `simbanic_ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `simbanic_customer`
--
ALTER TABLE `simbanic_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot`
--
ALTER TABLE `simbanic_depot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot_invoice`
--
ALTER TABLE `simbanic_depot_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot_invoice_product`
--
ALTER TABLE `simbanic_depot_invoice_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot_order`
--
ALTER TABLE `simbanic_depot_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot_order_product`
--
ALTER TABLE `simbanic_depot_order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_depot_payment`
--
ALTER TABLE `simbanic_depot_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_group`
--
ALTER TABLE `simbanic_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_login_attempt`
--
ALTER TABLE `simbanic_login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_otc_prescription`
--
ALTER TABLE `simbanic_otc_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_otc_prescription_product`
--
ALTER TABLE `simbanic_otc_prescription_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_pharma`
--
ALTER TABLE `simbanic_pharma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_prescription`
--
ALTER TABLE `simbanic_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_prescription_invoice_product`
--
ALTER TABLE `simbanic_prescription_invoice_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_prescription_medical_store`
--
ALTER TABLE `simbanic_prescription_medical_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_prescription_product`
--
ALTER TABLE `simbanic_prescription_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_prescription_seen`
--
ALTER TABLE `simbanic_prescription_seen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_product`
--
ALTER TABLE `simbanic_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_retailer_invoice`
--
ALTER TABLE `simbanic_retailer_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_retailer_invoice_product`
--
ALTER TABLE `simbanic_retailer_invoice_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_retailer_order`
--
ALTER TABLE `simbanic_retailer_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_retailer_order_product`
--
ALTER TABLE `simbanic_retailer_order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_retailer_payment`
--
ALTER TABLE `simbanic_retailer_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_stock`
--
ALTER TABLE `simbanic_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_temp_carry_forward`
--
ALTER TABLE `simbanic_temp_carry_forward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_temp_point`
--
ALTER TABLE `simbanic_temp_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_temp_report`
--
ALTER TABLE `simbanic_temp_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_user`
--
ALTER TABLE `simbanic_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbanic_user_group`
--
ALTER TABLE `simbanic_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simbanic_customer`
--
ALTER TABLE `simbanic_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `simbanic_depot`
--
ALTER TABLE `simbanic_depot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `simbanic_depot_invoice`
--
ALTER TABLE `simbanic_depot_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `simbanic_depot_invoice_product`
--
ALTER TABLE `simbanic_depot_invoice_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `simbanic_depot_order`
--
ALTER TABLE `simbanic_depot_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `simbanic_depot_order_product`
--
ALTER TABLE `simbanic_depot_order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `simbanic_depot_payment`
--
ALTER TABLE `simbanic_depot_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `simbanic_group`
--
ALTER TABLE `simbanic_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `simbanic_login_attempt`
--
ALTER TABLE `simbanic_login_attempt`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simbanic_otc_prescription`
--
ALTER TABLE `simbanic_otc_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `simbanic_otc_prescription_product`
--
ALTER TABLE `simbanic_otc_prescription_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `simbanic_pharma`
--
ALTER TABLE `simbanic_pharma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simbanic_prescription`
--
ALTER TABLE `simbanic_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `simbanic_prescription_invoice_product`
--
ALTER TABLE `simbanic_prescription_invoice_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `simbanic_prescription_medical_store`
--
ALTER TABLE `simbanic_prescription_medical_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `simbanic_prescription_product`
--
ALTER TABLE `simbanic_prescription_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `simbanic_prescription_seen`
--
ALTER TABLE `simbanic_prescription_seen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `simbanic_product`
--
ALTER TABLE `simbanic_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `simbanic_retailer_invoice`
--
ALTER TABLE `simbanic_retailer_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `simbanic_retailer_invoice_product`
--
ALTER TABLE `simbanic_retailer_invoice_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT for table `simbanic_retailer_order`
--
ALTER TABLE `simbanic_retailer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `simbanic_retailer_order_product`
--
ALTER TABLE `simbanic_retailer_order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `simbanic_retailer_payment`
--
ALTER TABLE `simbanic_retailer_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `simbanic_stock`
--
ALTER TABLE `simbanic_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `simbanic_temp_carry_forward`
--
ALTER TABLE `simbanic_temp_carry_forward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simbanic_temp_point`
--
ALTER TABLE `simbanic_temp_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `simbanic_temp_report`
--
ALTER TABLE `simbanic_temp_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simbanic_user`
--
ALTER TABLE `simbanic_user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=306;
--
-- AUTO_INCREMENT for table `simbanic_user_group`
--
ALTER TABLE `simbanic_user_group`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=298;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `simbanic_user_group`
--
ALTER TABLE `simbanic_user_group`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `simbanic_group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `simbanic_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
