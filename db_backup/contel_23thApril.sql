-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2013 at 05:12 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `area_id`, `title`, `code`) VALUES
(1, 1, 'First House', 'hse_frst_12345'),
(2, 1, 'DN Second House', 'hse_dn_sec_house');

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
  `code` varchar(20) NOT NULL,
  `priority` varchar(10) NOT NULL DEFAULT 'P',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `section_id`, `house_id`, `title`, `code`, `priority`) VALUES
(1, 1, 1, 'Almas general store', 'OC_ALMS_STR', 'MVP'),
(2, 2, 2, 'Mina Grossery Shoap', 'OC_MINA', 'P'),
(3, 1, 1, 'Swapno Super Store', 'OC_SWPNO', 'P'),
(4, 2, 2, 'Agora Super Store', 'OC_AGORA', 'P');

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
  `mobile_no` varchar(15) NOT NULL,
  `sr_code` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'Sales',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`id`, `house_id`, `name`, `mobile_no`, `sr_code`, `type`) VALUES
(1, 1, 'Mushfiqur Rahman', '8801685089560', 'SR_MSFQ', 'Sales'),
(2, 2, 'Khandaker Shamim', '8801963329350', 'SR_KNDKR', 'Coupon');

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
  `sls_b1` int(11) NOT NULL,
  `sls_b2` int(11) NOT NULL,
  `sls_b3` int(11) NOT NULL,
  `sls_b4` int(11) NOT NULL,
  `sls_b5` int(11) NOT NULL,
  `sls_b6` int(11) NOT NULL,
  `sls_b7` int(11) NOT NULL,
  `sls_b8` int(11) NOT NULL,
  `sls_b9` int(11) NOT NULL,
  `sls_b10` int(11) NOT NULL,
  `sls_b11` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `representative_id`, `outlet_id`, `section_id`, `date_time`, `sale_counter`, `sls_b1`, `sls_b2`, `sls_b3`, `sls_b4`, `sls_b5`, `sls_b6`, `sls_b7`, `sls_b8`, `sls_b9`, `sls_b10`, `sls_b11`, `date`) VALUES
(1, 1, 1, 1, 1360900500, 1, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, NULL),
(2, 1, 1, 1, 1361027280, 2, 11, 11, 11, 22, 33, 44, 55, 66, 77, 88, 99, NULL),
(3, 1, 1, 1, 1361388652, 1, 99, 20, 30, 40, 50, 60, 70, 80, 90, 81, 70, '2013-02-21'),
(4, 1, 1, 1, 1361473080, 1, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, '2013-02-22'),
(5, 2, 4, 2, 1361473664, 1, 10, 11, 12, 13, 14, 15, 16, 15, 14, 13, 12, '2013-02-22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `house_id`, `representative_id`, `title`, `code`) VALUES
(1, 1, 1, 'Uttora Ek', 'house_code_uttora_ek'),
(2, 2, 0, 'Uttora dui', 'sec_uttora_dui');

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
