-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 11:50 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poda`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `state`) VALUES
(1, 'Umuahia', '16'),
(2, 'Aba', '16'),
(3, 'Yola', '2'),
(4, 'Uyo', '3'),
(5, 'Eket', '3'),
(6, 'Awka', '4'),
(7, 'Onitsha', '4'),
(8, 'Nnewi', '4'),
(9, 'Abakiliki', '8'),
(10, 'Sokoto', '7'),
(11, 'Ikeja', '21'),
(12, 'Bariga', '21'),
(13, 'Surulere', '21'),
(14, 'Calabar', '17'),
(15, 'Enugu', '20'),
(16, 'Ilorin', '19'),
(25, 'Bundle', '20');

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `design` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `itemid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `design`, `description`, `itemid`) VALUES
(1, '917786DESIGN759125.png', 'Jus print this as a roll up banner', '48'),
(10, '547913DESIGN817963.png', 'The chatting system', '63'),
(11, '666351DESIGN712158.png', 'The andela application evidence', '63'),
(14, '144165DESIGN778229.png', 'edfghgfdsdfghjvfdh', '53'),
(16, '390930DESIGN81878.jpg', 'hkgjkjgkhhg hhkjkhjhg hjkrkhtkjkhtn hkkthjhgjhjg', '58'),
(17, '660340DESIGN9979.jpg', 'Nysc camp photo', '58');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `company`, `state`, `city`, `addr`) VALUES
(11, '2', '8', '9', NULL),
(13, '2', '3', '5', NULL),
(14, '2', '4', '8', NULL),
(15, '4', '21', '13', NULL),
(17, '4', '3', '5', NULL),
(18, '4', '21', '11', NULL),
(19, '4', '4', '6', 'No 49 Ekeabasi Street, off eniekam road'),
(25, '8', '17', '14', 'Fendi shopping complex, room 23, Second floor, left wing'),
(26, '9', '16', '1', 'NO 59 Awolowo street by Owerri road'),
(27, '9', '20', '15', 'NO 98 Mobile Crescent,close to water board office'),
(28, '9', '17', '14', 'kjfkjfkhjhkkhfkj hgjkgkhkjkfhg hkjkgkhkg'),
(29, '4', '17', '14', 'No 35 Kilimanjaro Street off Shop rite ufom yon');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `packs` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itemid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `printer_state` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `printer_city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `printer_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orderno` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `progress` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `packs`, `amount`, `itemid`, `printer_state`, `printer_city`, `printer_name`, `orderno`, `progress`) VALUES
(1, 'Master Business Card', '1', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Master Business Card', '1', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Master Business Card', '1', '5000.00', NULL, NULL, NULL, NULL, NULL, 'cancelled'),
(16, 'Master Letterhead', '1', '6500.00', '63', '3', '5', '4', '7437', 'finished'),
(17, 'Master Tri-Fold Leaflet', '2', '10000.00', '52', '3', '5', '2', '7431', NULL),
(18, 'Master MemoPads', '3', '9000.00', '53', '3', '5', '4', '7431', 'initiated'),
(19, 'Master Letterhead', '2', '13000.00', '48', '3', '5', '2', '7430', 'failed'),
(21, 'Master Desktop Calendar', '2', '50000.00', '50', '3', '5', '4', '7430', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`id`, `company_name`, `telephone`, `email`, `password`, `blocked`) VALUES
(2, 'Novateur Nigeria Limited', '09038983787', 'info@novateur.ng', '1f853155adb9e2a753cb6d3668303d60db29927c', NULL),
(3, 'ggfdfffff', 'qwwe', 'info@hfjjfhjf.com', '3bab2b9968fc6a9d3e56bc65ecc76c965ce44067', NULL),
(4, 'bundle incorporated', '07060815446', 'akobundumichael94@gmail.com', '558d9b35628519f7427cb9f4210a2f71fbdf714b', NULL),
(8, 'Nnamdi and co Limited', '45787839957', 'nnamdiprinters@yahoo.com', 'e3ab60f84bfa2b93b09bfaff28547f164f0cad00', NULL),
(9, 'Ogekat print', '334453322224', 'ogekat@gmail.com', '8329ab181f936334eed05739c746955be0a5421f', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `states` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `states`) VALUES
(2, 'Adamawa'),
(3, 'Akwa-ibom'),
(4, 'Anambara'),
(7, 'Sokoto'),
(8, 'Ebonyi'),
(16, 'Abia'),
(17, 'Cross-River'),
(19, 'Kwara'),
(20, 'Enugu'),
(21, 'Lagos'),
(24, 'kogi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
