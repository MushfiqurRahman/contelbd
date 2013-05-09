-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2013 at 10:16 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `campaigns`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mo_log_id` int(11) NOT NULL,
  `representative_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `coupon_counter` int(4) NOT NULL,
  `is_redeem` tinyint(1) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL,
  `first_act_score` int(11) NOT NULL,
  `second_act_score` int(11) NOT NULL,
  `third_act_score` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `mo_log_id`, `representative_id`, `outlet_id`, `section_id`, `coupon_counter`, `is_redeem`, `total_score`, `first_act_score`, `second_act_score`, `third_act_score`, `date`) VALUES
(2, 0, 11, 1, 0, 1, 1, -100, 0, 0, 0, '2013-04-30 00:00:00'),
(3, 0, 11, 1, 0, 2, 0, 250, 80, 90, 80, '2013-04-30 00:00:00'),
(4, 143, 11, 1, 0, 1, 0, 220, 80, 90, 50, '2013-05-07 11:54:10'),
(5, 145, 13, 2, 0, 1, 0, 220, 80, 90, 50, '2013-05-08 19:30:29'),
(6, 0, 11, 1, 0, 1, 1, -200, 0, 0, 0, '2013-05-09 22:58:15'),
(7, 154, 11, 1, 0, 1, 0, 320, 80, 90, 150, '2013-05-09 23:05:59'),
(8, 0, 11, 1, 0, 2, 1, -100, 0, 0, 0, '2013-05-09 23:06:44'),
(9, 0, 11, 1, 0, 3, 1, -100, 0, 0, 0, '2013-05-09 23:12:53'),
(10, 162, 11, 1, 0, 2, 0, 320, 80, 90, 150, '2013-05-09 23:14:32');

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
(1, 1, 'Azahar Trading Ltd.', 'hs_aztl'),
(2, 1, 'Mazhar Trading Inc', 'hs_mz_td');

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `representative_id` int(7) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`id`, `representative_id`, `mobile_no`) VALUES
(23, 11, '8801730071842'),
(22, 10, '8801914825528'),
(26, 12, '8801685089560'),
(27, 13, '8801981270858'),
(29, 12, '8801963329350');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `mo_logs`
--

INSERT INTO `mo_logs` (`id`, `msisdn`, `sms`, `keyword`, `datetime`, `time_int`) VALUES
(117, '8801914825528', 'PSTT MVP00281,A02 201,A03 205,A04 25,1', 'PSTT', '2013-05-05', 1367691913),
(118, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A06 25,2', 'PSTT', '2013-05-05', 1367691998),
(119, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A06 55,2', 'PSTT', '2013-05-05', 1367692040),
(120, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A08 55,2', 'PSTT', '2013-05-05', 1367692073),
(121, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A08 55,2', 'PSTT', '2013-05-05', 1367693326),
(122, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A08 55,2', 'PSTT', '2013-05-05', 1367693349),
(123, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A08 55,2', 'PSTT', '2013-05-05', 1367693397),
(124, '8801914825528', 'PSTT MVP00281,A01 201,A05 205,A08 75,2', 'PSTT', '2013-05-05', 1367693420),
(125, '8801685089560', 'PSTT VP023,A01 201,A05 205,A08 75,1', 'PSTT', '2013-05-05', 1367693629),
(127, '8801963329353', 'PSTT VP023,A03 201,A04 205,A07 75,2', 'PSTT', '2013-05-05', 1367693809),
(128, '8801914825528', 'PSTT MVP00281,A01 201,A01 205,A13 25,1', 'PSTT', '2013-05-07', 1367903372),
(129, '8801914825528', 'PSTT MVP00281,A01 201,A01 205,A13 25,2', 'PSTT', '2013-05-07', 1367903672),
(130, '8801914825528', 'PSTT MVP00281,A01 201,A01 205,A13 25,3', 'PSTT', '2013-05-07', 1367903713),
(131, '8801914825528', 'PSTT MVP00281,A01 201,A01 205,A13 25,4', 'PSTT', '2013-05-07', 1367904157),
(132, '8801914825528', 'PSTT MVP00281,A01 201,A01 205,A13 25,5', 'PSTT', '2013-05-07', 1367904193),
(133, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,6', 'PSTT', '2013-05-07', 1367904682),
(134, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367904802),
(135, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367904843),
(136, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367904975),
(137, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367904990),
(138, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367905008),
(139, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367905319),
(140, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,7', 'PSTT', '2013-05-07', 1367905329),
(141, '8801914825528', 'PSTT MVP00281,A01 201,A21 205,A13 25,8', 'PSTT', '2013-05-07', 1367905336),
(142, '8801685089560', 'CUP MVP00281,220,80,90,50,1', 'CUP', '2013-05-07', 1367905982),
(143, '8801730071842', 'CUP MVP00281,220,80,90,50,1', 'CUP', '2013-05-07', 1367906050),
(144, '8801730071842', 'CUP MVP00281,220,80,90,50,1', 'CUP', '2013-05-07', 1367906061),
(145, '8801981270858', 'CUP VP023,220,80,90,50,1', 'CUP', '2013-05-08', 1368019829),
(146, '8801981270858', 'CUP VP023,220,80,90,50,1', 'CUP', '2013-05-08', 1368025176),
(147, '8801730071842', 'RP MVP00281,400,1', 'RP', '2013-05-09', 1368118493),
(148, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368118587),
(149, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368118695),
(150, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368118770),
(151, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368118883),
(152, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368119098),
(153, '8801730071842', 'RP MVP00281,200,1', 'RP', '2013-05-09', 1368119111),
(154, '8801730071842', 'CUP MVP00281,220,80,90,50,1', 'CUP', '2013-05-09', 1368119159),
(155, '8801730071842', 'RP MVP00281,400,2', 'RP', '2013-05-09', 1368119194),
(156, '8801730071842', 'RP MVP00281,100,2', 'RP', '2013-05-09', 1368119204),
(157, '8801730071842', 'RP MVP00281,100,2', 'RP', '2013-05-09', 1368119557),
(158, '8801730071842', 'RP MVP00281,100,3', 'RP', '2013-05-09', 1368119573),
(159, '8801730071842', 'RP MVP00281,100,3', 'RP', '2013-05-09', 1368119626),
(160, '8801730071842', 'CUP MVP00281,220,80,90,150,1', 'CUP', '2013-05-09', 1368119652),
(161, '8801730071842', 'CUP MVP00281,320,80,90,150,1', 'CUP', '2013-05-09', 1368119660),
(162, '8801730071842', 'CUP MVP00281,320,80,90,150,2', 'CUP', '2013-05-09', 1368119672);

-- --------------------------------------------------------

--
-- Table structure for table `mt_logs`
--

CREATE TABLE IF NOT EXISTS `mt_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outlet_id` int(11) NOT NULL,
  `msisdn` varchar(15) NOT NULL,
  `sms` varchar(160) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `time_int` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `mt_logs`
--

INSERT INTO `mt_logs` (`id`, `outlet_id`, `msisdn`, `sms`, `keyword`, `datetime`, `time_int`) VALUES
(66, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-05', 1367691913),
(67, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367691998),
(68, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367692040),
(69, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367692073),
(70, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367693397),
(71, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367693420),
(72, 0, '8801685089560', 'We have received your request. Thank you.', 'PSTT', '2013-05-05', 1367693629),
(73, 0, '8801963329350', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-05', 1367693706),
(74, 0, '8801963329353', 'Invalid Mobile no or Outlet code! Please try again with valid code.', 'PSTT', '2013-05-05', 1367693809),
(75, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-07', 1367903372),
(76, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-07', 1367903672),
(77, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-07', 1367903713),
(78, 0, '8801914825528', 'Invalid message format. You have entered same product code for twice.', 'PSTT', '2013-05-07', 1367904157),
(79, 0, '8801914825528', 'Invalid message format. You have entered same product code for twice.', 'PSTT', '2013-05-07', 1367904193),
(80, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-07', 1367904682),
(81, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-07', 1367905319),
(82, 0, '8801914825528', 'Your record have been successfully updated, thanks.', 'PSTT', '2013-05-07', 1367905329),
(83, 0, '8801914825528', 'We have received your request. Thank you.', 'PSTT', '2013-05-07', 1367905336),
(84, 0, '8801685089560', 'Invalid user or TLP code! Please try again with valid info.', 'CUP', '2013-05-07', 1367905982),
(85, 0, '8801730071842', 'After successful add your current coupon point total is: 370. Thank you.', 'CUP', '2013-05-07', 1367906050),
(86, 0, '8801730071842', 'After successful update your current coupon point total is: 370. Thank you.', 'CUP', '2013-05-07', 1367906061),
(87, 0, '8801981270858', 'After successful add your current coupon point total is: 220. Thank you.', 'CUP', '2013-05-08', 1368019829),
(88, 2, '8801981270858', 'After successful update your current coupon point total is: 220. Thank you.', 'CUP', '2013-05-08', 1368025176),
(89, 1, '8801730071842', 'Invalid request! Sorry, your redeem point is larger than your total point. You total point is: 370', 'RP', '2013-05-09', 1368118493),
(90, 1, '8801730071842', 'After successful redeem your current coupon point total is: 370. Thank you.', 'RP', '2013-05-09', 1368118695),
(91, 1, '8801730071842', 'Invalid request! Sorry, your redeem point is greater than your total point. You total point is: 170', 'RP', '2013-05-09', 1368118770),
(92, 1, '8801730071842', 'After successful update your current coupon point total is: 170. Thank you.', 'RP', '2013-05-09', 1368119111),
(93, 1, '8801730071842', 'After successful add your current coupon point total is: 390. Thank you.', 'CUP', '2013-05-09', 1368119159),
(94, 1, '8801730071842', 'Invalid request! Sorry, your redeem point is greater than your total point. You total point is: 390', 'RP', '2013-05-09', 1368119194),
(95, 1, '8801730071842', 'After successful redeem your current coupon point total is: 390. Thank you.', 'RP', '2013-05-09', 1368119204),
(96, 1, '8801730071842', 'After successful update your current coupon point total is: 290. Thank you.', 'RP', '2013-05-09', 1368119557),
(97, 1, '8801730071842', 'Redeem successful. Redeemed 3 point. Current total coupon point is: 287. Thank you.', 'RP', '2013-05-09', 1368119573),
(98, 1, '8801730071842', 'After successful update your current coupon point total is: 190. Thank you.', 'RP', '2013-05-09', 1368119626),
(99, 0, '8801730071842', 'Invalid value! Total point is not equal to the sum of activity points', 'CUP', '2013-05-09', 1368119652),
(100, 1, '8801730071842', 'After successful update your current coupon point total is: 290. Thank you.', 'CUP', '2013-05-09', 1368119660),
(101, 1, '8801730071842', 'After successful add your current coupon point total is: 610. Thank you.', 'CUP', '2013-05-09', 1368119672);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `section_id`, `house_id`, `title`, `outlet_retailer_name`, `code`, `phone_no`, `address`, `priority`) VALUES
(1, NULL, 1, 'SHAH ALOM STORE', 'SHAH ALOM MIAH', 'MVP00281', '8801911819492', 'RAJUK COSMO SHOPING', 'MVP'),
(2, NULL, 2, 'Mithu General Store', 'Mithu Mia', 'VP023', '8801911174811', 'Uttara, robindro shoroni', 'VP');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`id`, `house_id`, `name`, `sr_code`, `type`) VALUES
(10, 1, 'Hamid', '', 'ss'),
(11, 1, 'Selim', '', 'tsa'),
(12, 2, 'Sohel', 'sr_shl', 'sr'),
(13, 2, 'Tona', 'tsa_tona', 'tsa');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `representative_id` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `representative_id`, `outlet_id`, `section_id`, `date`) VALUES
(22, 10, 1, NULL, '2013-05-05 00:00:00'),
(23, 12, 2, NULL, '2013-05-05 21:00:00'),
(26, 10, 1, NULL, '2013-05-07 11:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `mo_log_id` int(11) NOT NULL,
  `sale_counter` int(3) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `mo_log_id`, `sale_counter`, `product_id`, `quantity`) VALUES
(67, 26, 130, 3, 1, 201),
(66, 25, 129, 2, 13, 25),
(65, 25, 129, 2, 1, 205),
(64, 25, 129, 2, 1, 201),
(61, 24, 128, 1, 1, 201),
(62, 24, 128, 1, 1, 205),
(63, 24, 128, 1, 13, 25),
(57, 23, 125, 1, 8, 75),
(56, 23, 125, 1, 5, 205),
(54, 22, 124, 2, 8, 75),
(53, 22, 124, 2, 5, 205),
(52, 22, 124, 2, 1, 201),
(55, 23, 125, 1, 1, 201),
(44, 22, 117, 1, 4, 25),
(43, 22, 117, 1, 3, 205),
(42, 22, 117, 1, 2, 201),
(68, 26, 130, 3, 1, 205),
(69, 26, 130, 3, 13, 25),
(70, 24, 133, 6, 1, 201),
(71, 24, 133, 6, 21, 205),
(72, 24, 133, 6, 13, 25),
(78, 26, 140, 7, 13, 25),
(77, 26, 140, 7, 21, 205),
(76, 26, 140, 7, 1, 201),
(79, 26, 141, 8, 1, 201),
(80, 26, 141, 8, 21, 205),
(81, 26, 141, 8, 13, 25);

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
