-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2013 at 11:51 AM
-- Server version: 5.1.39
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `area_id`, `title`, `code`) VALUES
(1, 1, 'Azahar Trading Ltd.', 'hs_aztl');

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `representative_id` int(7) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`id`, `representative_id`, `mobile_no`) VALUES
(23, 11, '01730071842'),
(22, 10, '01914825528');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `section_id`, `house_id`, `title`, `outlet_retailer_name`, `code`, `phone_no`, `address`, `priority`) VALUES
(1, NULL, 1, 'SHAH ALOM STORE', 'SHAH ALOM MIAH', 'MVP00281', '01911819492', 'RAJUK COSMO SHOPING', 'MVP');

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
  `sr_code` varchar(20) DEFAULT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'Sales',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`id`, `house_id`, `name`, `sr_code`, `type`) VALUES
(10, 1, 'Hamid', '', 'ss'),
(11, 1, 'Selim', '', 'tsa');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
