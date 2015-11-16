-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2015 at 07:41 AM
-- Server version: 5.6.25-73.1-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simbanne_walartpharma_db`
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
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_customer`
--

CREATE TABLE IF NOT EXISTS `simbanic_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Dumping data for table `simbanic_customer`
--

INSERT INTO `simbanic_customer` (`id`, `user_id`, `created_by`, `customer_id`, `sponsor_id`, `tree_id`, `customer_type`, `full_name`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `mobile_no`, `gender`, `dob`, `home_address`, `work_address`, `home_street1`, `home_street2`, `home_state`, `home_district`, `home_taluka`, `home_city`, `home_area`, `refer_to`, `marriage_anni`, `designation`, `pancard_no`, `blood_group`, `nominee`, `nominee_relation`, `nominee_dob`, `income`, `payment`, `bank_name`, `account_no`, `ifsc_code`, `related_medical`, `date_created`, `date_modified`, `deleted`) VALUES
(52, 1, 1, 'GUJ0001', '0', 0, 'doctor', 'Hardik Panseriya', '', '', '', '', 'panseriya', '9724563176', 'male', '1992-02-17', 'Ahmedabad', 'Ahmedabad', '', '', 'gujarat', 'ahmedabad', '', '', 'ahmedabad_city', 'Hardik', 'N/A', 'Developer', '123456', 'N/A', 'N/A', 'N/A', '2015-08-12', '2', '', 'state bank', '12345678901', 'SBIN0060434', '', '2015-08-12 17:50:16', '2015-08-12 18:00:27', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_invoice`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_invoice_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_order`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Complete') NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_order_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_depot_payment`
--

CREATE TABLE IF NOT EXISTS `simbanic_depot_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_group`
--

CREATE TABLE IF NOT EXISTS `simbanic_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_otc_prescription`
--

CREATE TABLE IF NOT EXISTS `simbanic_otc_prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date_confirm` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_otc_prescription_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_otc_prescription_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_pharma`
--

CREATE TABLE IF NOT EXISTS `simbanic_pharma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_invoice_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_medical_store`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_medical_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_prescription_seen`
--

CREATE TABLE IF NOT EXISTS `simbanic_prescription_seen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `seen_by` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `sync_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_invoice`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_invoice_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_invoice_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_order`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Complete') NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_order_product`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_retailer_payment`
--

CREATE TABLE IF NOT EXISTS `simbanic_retailer_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_stock`
--

CREATE TABLE IF NOT EXISTS `simbanic_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_carry_forward`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_carry_forward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_point`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `sponsor_id` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `customer_type` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total_unit` varchar(50) NOT NULL,
  `cf_unit` varchar(50) NOT NULL,
  `point` bigint(20) NOT NULL,
  `date_confirm` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_temp_report`
--

CREATE TABLE IF NOT EXISTS `simbanic_temp_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_user`
--

CREATE TABLE IF NOT EXISTS `simbanic_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=306 ;

--
-- Dumping data for table `simbanic_user`
--

INSERT INTO `simbanic_user` (`id`, `simbanic_id`, `customer_id`, `sponsor_id`, `full_name`, `mobile_no`, `user_type`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 52, 'GUJ0001', '0', 'Walart Admin', '', 'admin', '127.0.0.1', 'administrator', '$2y$08$SAHEL/.JFH3vwVrEWl3EN.m5wNrVz/lzTUP6RH8e4AVaMRYl.e05.', '', 'info@walartpharma.com', '', NULL, NULL, NULL, 1268889823, 1446834165, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simbanic_user_group`
--

CREATE TABLE IF NOT EXISTS `simbanic_user_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=298 ;

--
-- Dumping data for table `simbanic_user_group`
--

INSERT INTO `simbanic_user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

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
