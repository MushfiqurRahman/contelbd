-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2013 at 09:19 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contel`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `region_id`, `title`, `code`) VALUES
(1, 1, 'Dhaka North', 'area_dhk_north_1234'),
(2, 1, 'Dhaka South', 'area_dhk_south_12');

-- --------------------------------------------------------

--
-- Table structure for table `bases`
--

CREATE TABLE IF NOT EXISTS `bases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outlet_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `base_b1` float NOT NULL DEFAULT '100',
  `base_b2` float NOT NULL DEFAULT '100',
  `base_b3` float NOT NULL DEFAULT '100',
  `base_b4` float NOT NULL DEFAULT '100',
  `base_b5` float NOT NULL DEFAULT '100',
  `base_b6` float NOT NULL DEFAULT '100',
  `base_b7` float NOT NULL DEFAULT '100',
  `base_b8` float NOT NULL DEFAULT '100',
  `base_b9` float NOT NULL DEFAULT '100',
  `base_b10` float NOT NULL DEFAULT '100',
  `base_b11` float NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bases`
--

INSERT INTO `bases` (`id`, `outlet_id`, `campaign_id`, `base_b1`, `base_b2`, `base_b3`, `base_b4`, `base_b5`, `base_b6`, `base_b7`, `base_b8`, `base_b9`, `base_b10`, `base_b11`) VALUES
(15, 4, 22, 1.25, 1.375, 1.5, 1.625, 1.75, 1.875, 2, 1.875, 1.75, 1.625, 1.5),
(14, 1, 22, 16.25, 6.625, 8.125, 11, 13.875, 16.75, 19.625, 22.25, 24.875, 25.125, 25.125);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `description`) VALUES
(1, 'B&H L', 'Benson & Hedges'),
(2, 'B&H FF', 'Benson & Hedges Full'),
(3, 'B&H S', 'Benson & Hedges Switch'),
(4, 'JPGL', 'John Player'),
(5, 'PM', 'Pall Mall'),
(6, 'CAP', 'Capstan Filter'),
(7, 'SRFT', 'Star Filter'),
(8, 'SL', 'Star Light'),
(9, 'PL', 'Pilot'),
(10, 'DB', 'Derby'),
(11, 'HW', 'Hollywood');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL DEFAULT '0',
  `house_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `trgt_b1` int(11) NOT NULL DEFAULT '100',
  `trgt_b2` int(11) NOT NULL DEFAULT '100',
  `trgt_b3` int(11) NOT NULL DEFAULT '100',
  `trgt_b4` int(11) NOT NULL DEFAULT '100',
  `trgt_b5` int(11) NOT NULL DEFAULT '100',
  `trgt_b6` int(11) NOT NULL DEFAULT '100',
  `trgt_b7` int(11) NOT NULL DEFAULT '100',
  `trgt_b8` int(11) NOT NULL DEFAULT '100',
  `trgt_b9` int(11) NOT NULL DEFAULT '100',
  `trgt_b10` int(11) NOT NULL DEFAULT '100',
  `trgt_b11` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `region_id`, `area_id`, `house_id`, `title`, `start_date`, `end_date`, `trgt_b1`, `trgt_b2`, `trgt_b3`, `trgt_b4`, `trgt_b5`, `trgt_b6`, `trgt_b7`, `trgt_b8`, `trgt_b9`, `trgt_b10`, `trgt_b11`) VALUES
(22, 0, 0, 0, 'First Campaign', 1361606400, 1362038400, 150, 200, 100, 100, 100, 100, 100, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `code` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `code`) VALUES
(4, 'Pant', 'cat_pnt'),
(3, 'Shirt', 'cat_sht'),
(5, 'Tie', 'cat_Tie'),
(6, 'Short', 'cat_shrt'),
(7, 'Gengy', 'cat_gng');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `representative_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `coupon_counter` int(4) NOT NULL,
  `total_score` int(11) NOT NULL,
  `first_act_score` int(11) NOT NULL,
  `second_act_score` int(11) NOT NULL,
  `third_act_score` int(11) NOT NULL,
  `date_time` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `representative_id`, `outlet_id`, `section_id`, `coupon_counter`, `total_score`, `first_act_score`, `second_act_score`, `third_act_score`, `date_time`, `date`) VALUES
(1, 2, 2, 2, 1, 50, 20, 10, 20, 1360987200, '0000-00-00'),
(2, 2, 2, 2, 0, 100, 40, 40, 20, 1361073780, '0000-00-00'),
(3, 2, 2, 2, 1, 80, 20, 25, 35, 1361470979, '0000-00-00'),
(4, 2, 2, 2, 1, 80, 40, 20, 20, 1361471321, '2013-02-22'),
(5, 1, 1, 1, 0, 110, 90, 10, 10, 1364799600, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE IF NOT EXISTS `houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `houses`
--


-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `representative_id` int(7) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`id`, `representative_id`, `mobile_no`) VALUES
(2, 7, '01717111530'),
(3, 7, '01717123456'),
(4, 8, '01717111531'),
(21, 9, '01195300581');

-- --------------------------------------------------------

--
-- Table structure for table `mo_logs`
--

CREATE TABLE IF NOT EXISTS `mo_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(15) NOT NULL,
  `sms` varchar(160) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `time_int` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `mo_logs`
--

INSERT INTO `mo_logs` (`id`, `msisdn`, `sms`, `keyword`, `datetime`, `time_int`) VALUES
(12, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 10, 20, 30, 40, 50, 60, 70, 80, 90, 88, 77, 1', 'TLP', '2013-02-21', 1361388652),
(13, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 1000, 20, 30, 40, 50, 60, 70, 80, 90, 88, 77, 1', 'TLP', '2013-02-21', 1361388813),
(14, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 1000, 20, 30, 40, 50, 60, 70, 80, 90, 88, 77, 1', 'TLP', '2013-02-21', 1361388854),
(15, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 99, 20, 30, 40, 50, 60, 70, 80, 90, 88, 77, 1', 'TLP', '2013-02-21', 1361388897),
(16, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 99, 20, 30, 40, 50, 60, 70, 80, 90, 88, 70, 1', 'TLP', '2013-02-21', 1361388968),
(17, '8801685089560', 'TLP SR_MSFQ, OC_ALMS_STR, 99, 20, 30, 40, 50, 60, 70, 80, 90, 81, 70, 1', 'TLP', '2013-02-21', 1361389024),
(18, '8801963329350', 'CUP OC_MINA, 80, 20, 25, 35, 1', 'CUP', '2013-02-22', 1361470933),
(19, '8801963329350', 'CUP OC_MINA, 80, 20, 25, 35, 1', 'CUP', '2013-02-22', 1361470979),
(20, '88880196332935', 'CUP OC_MINA, 80, 20, 25, 35, 2', 'CUP', '2013-02-22', 1361471258),
(21, '8801963329350', 'CUP OC_MIN, 80, 20, 25, 35, 2', 'CUP', '2013-02-22', 1361471273),
(22, '8801963329350', 'CUP OC_MIN, 88, 20, 25, 35, 2', 'CUP', '2013-02-22', 1361471286),
(23, '8801963329350', 'CUP OC_MIN, 80, 20, 20, 40, 1', 'CUP', '2013-02-22', 1361471312),
(24, '8801963329350', 'CUP OC_MINA, 80, 20, 20, 40, 1', 'CUP', '2013-02-22', 1361471321),
(25, '8801963329350', 'CUP OC_MINA, 80, 40, 20,20, 1', 'CUP', '2013-02-22', 1361471368),
(26, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472728),
(27, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472777),
(28, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472821),
(29, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472839),
(30, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472891),
(31, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361472932),
(32, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361473007),
(33, '8801685089560', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361473080),
(34, '8801963329350', 'TLP SR_MSFQ, OC_SWPNO, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361473593),
(35, '8801963329350', 'TLP SR_KNDKR, OC_AGORA, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361473664),
(36, '8801963329350', 'TLP SR_KNDKR, OC_AGORA, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, 1', 'TLP', '2013-02-22', 1361478712),
(37, '8801685089560', 'CUP OC_MIN, 80, 20, 20, 40, 1', 'CUP', '2013-03-04', 1362373427);

-- --------------------------------------------------------

--
-- Table structure for table `mt_logs`
--

CREATE TABLE IF NOT EXISTS `mt_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(15) NOT NULL,
  `sms` varchar(160) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `time_int` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mt_logs`
--

INSERT INTO `mt_logs` (`id`, `msisdn`, `sms`, `keyword`, `datetime`, `time_int`) VALUES
(1, '8801685089560', 'Your record have been successfully updated, thanks.', 'TLP', '2013-02-21', 1361389024),
(2, '8801963329350', 'We have received your request. Thank you.', 'CUP', '2013-02-22', 1361470979),
(3, '88880196332935', 'Invalid user or TLP code! Please try again with valid info.', 'CUP', '2013-02-22', 1361471258),
(4, '8801963329350', 'Invalid user or TLP code! Please try again with valid info.', 'CUP', '2013-02-22', 1361471273),
(5, '8801963329350', 'Invalid value! Total point is not equal to the sum of activity points', 'CUP', '2013-02-22', 1361471286),
(6, '8801963329350', 'Invalid user or TLP code! Please try again with valid info.', 'CUP', '2013-02-22', 1361471312),
(7, '8801963329350', 'We have received your request. Thank you.', 'CUP', '2013-02-22', 1361471321),
(8, '8801963329350', 'Your record have been successfully updated, thanks.', 'CUP', '2013-02-22', 1361471368),
(9, '8801685089560', 'Your SMS format is wrong, plesae try again with right format.', 'TLP', '2013-02-22', 1361472728),
(10, '8801685089560', 'Your SMS format is wrong, plesae try again with right format.', 'TLP', '2013-02-22', 1361472777),
(11, '8801685089560', 'Your SMS format is wrong, plesae try again with right format.', 'TLP', '2013-02-22', 1361472821),
(12, '8801685089560', 'Invalid SR or TLP code! Please try again with valid code.', 'TLP', '2013-02-22', 1361472839),
(13, '8801685089560', 'Invalid SR or TLP code! Please try again with valid code.', 'TLP', '2013-02-22', 1361472891),
(14, '8801685089560', 'Invalid SR or TLP code! Please try again with valid code.', 'TLP', '2013-02-22', 1361472932),
(15, '8801685089560', 'Invalid SR or TLP code! Please try again with valid code.', 'TLP', '2013-02-22', 1361473007),
(16, '8801685089560', 'We have received your request. Thank you.', 'TLP', '2013-02-22', 1361473080),
(17, '8801963329350', 'Invalid SR or TLP code! Please try again with valid code.', 'TLP', '2013-02-22', 1361473593),
(18, '8801963329350', 'We have received your request. Thank you.', 'TLP', '2013-02-22', 1361473664),
(19, '8801963329350', 'Your record have been successfully updated, thanks.', 'TLP', '2013-02-22', 1361478712),
(20, '8801685089560', 'Your SMS format is wrong, plesae try again with right format.', 'CUP', '2013-03-04', 1362373427),
(21, '88', 'Your SMS format is wrong, plesae try again with right format.', '', '2013-03-04', 1362373445);

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE IF NOT EXISTS `outlets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) DEFAULT NULL,
  `house_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `outlet_retailer_name` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `priority` varchar(10) NOT NULL DEFAULT 'P',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outlets`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `brand_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `name`, `code`) VALUES
(1, 1, 'Benson & Hedges Lights 20 HL', 'A01'),
(2, 2, 'Benson & Hedges Full Flavour 20 HL', 'A02'),
(3, 3, 'Benson & Hedges Switch 20 HL', 'A03'),
(4, 4, 'John Player Gold Leaf 20 HL', 'A04'),
(5, 5, 'Pall Mall Lights 20 HL', 'A05'),
(6, 6, 'Capstan Filter 20 HL', 'A06'),
(7, 7, 'Star Filter 20 HL', 'A07'),
(8, 7, 'Star Filter 20 HL LEP', 'A08'),
(9, 7, 'Star Filter 10 SS', 'A09'),
(10, 7, 'Star Filter 10 HL', 'A10'),
(11, 7, 'Star Filter 10 HL LEP', 'A11'),
(12, 8, 'Starlight 20 HL', 'A12'),
(13, 8, 'Starlight 20 HL LEP', 'A13'),
(14, 8, 'Starlight 10 HL', 'A14'),
(15, 8, 'Starlight 10 HL LEP', 'A15'),
(16, 9, 'Pilot 20 HL LEP', 'A16'),
(17, 10, 'Derby 20 HL', 'A17'),
(18, 10, 'Derby 10 HL', 'A18'),
(19, 10, 'Derby 10 SS', 'A19'),
(20, 10, 'Derby Style 20 HL', 'A20'),
(21, 10, 'Derby Style 10 HL', 'A21'),
(22, 10, 'Derby Style 10 SS', 'A22'),
(23, 11, 'Hollywood 20 HL', 'A23'),
(24, 11, 'Hollywood 10 SS', 'A24');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `title`, `code`) VALUES
(1, 'Dhaka', 'reg_dhaka_12345'),
(2, 'Rajshahi', 'reg_rajshahi_123');

-- --------------------------------------------------------

--
-- Table structure for table `representatives`
--

CREATE TABLE IF NOT EXISTS `representatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sr_code` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'Sales',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`id`, `house_id`, `name`, `sr_code`, `type`) VALUES
(1, 1, 'Mushfiqur Rahman', 'SR_MSFQ', 'Sales'),
(2, 2, 'Khandaker Shamim', 'SR_KNDKR', 'Coupon'),
(7, 1, 'Test Representative', 'tst_code', 'Sales'),
(8, 1, 'Second Test Rep', 'sr_sec_ts', 'Sales'),
(9, 1, 'Again Test', 'rp_agt', 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `representative_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `date_time` int(11) NOT NULL,
  `sale_counter` int(4) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `representative_id`, `outlet_id`, `section_id`, `date_time`, `sale_counter`, `date`) VALUES
(3, 1, 1, 1, 1361388652, 1, '2013-02-21'),
(4, 1, 1, 1, 1361473080, 1, '2013-02-22'),
(5, 2, 4, 2, 1361473664, 1, '2013-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sale_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `representative_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sections`
--


-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `title`, `code`) VALUES
(2, 4, 'Small', 'sc_sm_pnt'),
(3, 4, 'Medium', 'sc_md_pnt'),
(4, 4, 'Large', 'sc_lg_pnt'),
(5, 4, 'Extra Large', 'sc_x_pnt'),
(6, 3, 'Small', 'sc_sm_srt'),
(7, 3, 'Medium', 'sc_md_srt'),
(8, 5, 'Medium', 'sc_md_ti'),
(9, 6, 'Medium', 'sc_md_sot'),
(10, 7, 'Large', 'sc_lg_gng');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created`, `modified`) VALUES
(3, 'Mushfiqur', 'Rahman', 'mushfique@codetrio.com', '88567bda01446a5ad951a1593f0101db0c867ea9', '2013-03-03 20:58:14', 1362373094),
(4, 'Asif', 'Imran', 'imran@contelbd.com', '88567bda01446a5ad951a1593f0101db0c867ea9', '2013-03-04 18:06:31', 1362449191);
