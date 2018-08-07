-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2018 at 11:16 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Dec 01, 2017 at 10:48 PM
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `phone` double NOT NULL,
  PRIMARY KEY (`id`,`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `user_type`, `password`, `phone`) VALUES
(1, 'admin', 'admin@car.com', 'admin', 'admin', 7896585485);

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--
-- Creation: Dec 02, 2017 at 12:56 AM
--

DROP TABLE IF EXISTS `car_details`;
CREATE TABLE IF NOT EXISTS `car_details` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `reg_no` varchar(45) NOT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `model` varchar(45) NOT NULL,
  `year` int(11) NOT NULL,
  `fuel` varchar(45) NOT NULL,
  `kms` int(11) NOT NULL,
  `add_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cid`,`reg_no`),
  UNIQUE KEY `reg_no_UNIQUE` (`reg_no`),
  KEY `oid_idx` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`cid`, `oid`, `reg_no`, `brand`, `model`, `year`, `fuel`, `kms`, `add_desc`) VALUES
(1, 21, 'MH 04 AC 7898', 'SUZUKI', 'SWIFT', 2015, 'PETROL', 15000, NULL),
(2, 22, 'KA 19 DD 4587', 'TOYOTA', 'ETIOS', 2014, 'PETROL', 20000, NULL),
(3, 23, 'KA 78 SA 7784', 'FORD', 'ECO SPORT', 2015, 'DIESEL', 14000, NULL),
(4, 24, 'KA 12 MJ 0989', 'TATA', 'INDIGO', 2012, 'CNG ', 32000, NULL),
(5, 25, 'KA 22 UY 7865', 'FIAT', 'PUNTO', 2015, 'PETROL', 5488, NULL),
(6, 26, 'MH 09 IU 8879', 'BMW ', '720D', 2015, 'PETROL', 1524, NULL),
(7, 27, 'KL 76 YU 8909', 'SUZUKI', 'DZIRE', 2016, 'CNG', 8500, NULL),
(8, 28, 'KL 22 FR 4322 ', 'HYUNDAI', 'ESTEEM', 2016, 'PETROL', 8874, NULL),
(9, 31, 'KL 01 LO 1001', 'Mercedes', 'E221', 2015, 'petrol', 15000, NULL),
(10, 21, 'KA 03 BH 7784', 'TATA', 'INDIGO ES', 2014, 'DIESEL', 15422, NULL),
(11, 35, 'MH 01 AK 7748', 'vovlo', 'M 54', 2014, 'PETROL', 15000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--
-- Creation: Nov 29, 2017 at 01:21 PM
--

DROP TABLE IF EXISTS `mechanics`;
CREATE TABLE IF NOT EXISTS `mechanics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `spec` varchar(20) NOT NULL,
  `xp` varchar(10) NOT NULL,
  `salary` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Triggers `mechanics`
--
DROP TRIGGER IF EXISTS `carservice`.`mechanics_AFTER_DELETE`;
DELIMITER //
CREATE TRIGGER `carservice`.`mechanics_AFTER_DELETE` AFTER DELETE ON `carservice`.`mechanics`
 FOR EACH ROW BEGIN
insert into mech_backup values(old.id,old.fname,old.lname,old.phone,old.email,old.address,old.spec,old.xp,old.salary);
END
//
DELIMITER ;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `fname`, `lname`, `phone`, `email`, `address`, `spec`, `xp`, `salary`) VALUES
(3, 'Jamal', 'Khan', '5487968547', 'Jamal@car.com', 'mumbai', 'Engineer', '10', '500000'),
(4, 'Shreyas', 'Parmar', '4789778978', 'shreyas@car.com', 'udupi', 'Engine', '7', '450000'),
(5, 'Jayesh', 'Ghete', '9875415478', 'jayesh@car.com', 'Mangalore', 'Interior', '8', '480000'),
(6, 'Afzal', 'Quereshi', '778945697', 'afzal@car.com', 'manipal', 'Connections', '15', '700000');

-- --------------------------------------------------------

--
-- Table structure for table `mech_backup`
--
-- Creation: Dec 01, 2017 at 10:00 PM
--

DROP TABLE IF EXISTS `mech_backup`;
CREATE TABLE IF NOT EXISTS `mech_backup` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `specs` varchar(45) NOT NULL,
  `xp` varchar(45) NOT NULL,
  `salary` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mech_backup`
--


-- --------------------------------------------------------

--
-- Table structure for table `message`
--
-- Creation: Dec 02, 2017 at 01:19 AM
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `message`) VALUES
(1, 'Ranjan', 'ranjan@gmail.com', 'Need report for my last Service'),
(21, 'Sarvesh', 'Sarvesh@car.com', 'needed a quote for complete car service of Suzuki Dzire'),
(22, 'Bharat', 'Bharat@car.com', 'Want an e-bill of my last service');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--
-- Creation: Dec 04, 2017 at 03:32 PM
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `carid` int(10) NOT NULL,
  `oid` int(10) NOT NULL,
  `sid` varchar(500) NOT NULL,
  `amount` int(10) NOT NULL,
  `dop` date NOT NULL,
  `dob` date NOT NULL,
  `mechid` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `mechid_idx` (`mechid`),
  KEY `oid_idx` (`oid`),
  KEY `cid_idx` (`carid`),
  KEY `carid` (`carid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`pid`, `carid`, `oid`, `sid`, `amount`, `dop`, `dob`, `mechid`) VALUES
(13, 1, 21, 'AC checkk & Sanitization,Minor Repairs', 4500, '2017-12-01', '2017-12-01', 3),
(15, 9, 31, 'Replace spare wheel,Matt finishing', 4500, '2017-12-01', '2017-12-03', 3),
(16, 2, 22, 'Bumpers Safe Guard ( Front),Replace spare wheel', 0, '2017-12-02', '2017-12-05', NULL),
(17, 2, 22, 'Replace spare wheel,Matt finishing', 1822, '2017-12-02', '2017-12-03', 4),
(46, 1, 21, 'Matt finishing', 4500, '2017-12-04', '2017-12-06', 5),
(48, 11, 35, 'Replace spare wheel,Wheel Alignment and Balancing', 7582, '2017-12-06', '2017-12-06', 6),
(50, 11, 35, 'Wheel Alignment and Balancing,Matt finishing,Repainting', 7000, '2017-12-06', '2017-12-06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--
-- Creation: Dec 02, 2017 at 12:05 AM
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cost` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `cost`) VALUES
(2, 'AC checkk & Sanitization', '2500-4000'),
(3, 'Minor Repairs', '1000-4500'),
(4, 'Dent Removal & Repaint', '2500-7500'),
(5, 'Exterior Wash', '1000-2000'),
(6, 'Express Service', '3000-8000'),
(7, 'Eco Wash+ Intensive Interior Cleaning', '4500-9000'),
(8, 'Dead Battery', '800-1500'),
(9, 'Tyre Puncture', '500-2000'),
(10, 'Car care - Annual Subscription Package', '10000-25000'),
(11, 'Windshield Installation', '2400-4800'),
(12, 'Clean Shine Coat', '3200-7600'),
(13, 'Nano coating for exterior car paint surface', '12000-23000'),
(14, 'Nano diamond Premium Treatment', '20000-45000'),
(15, 'Bumpers Safe Guard ( Front)', '3500-6800'),
(16, 'Replace spare wheel', '1500-3000'),
(17, 'Wheel Alignment and Balancing', '3000-5000'),
(19, 'Matt finishing', '3000-6000'),
(20, 'Repainting', '4500-8000'),
(21, 'pressure wash', '700-1500');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Nov 29, 2017 at 04:03 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `phone` double NOT NULL,
  PRIMARY KEY (`id`,`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `phone`) VALUES
(21, 'Sarvesh', 'sarvesh@car.com', 'user', '9452f266332bbb5008b1321beff0ecf9', 7458961235),
(22, 'Bharat', 'bharat@car.com', 'user', 'dfb57b2e5f36c1f893dbc12dd66897d4', 4587412596),
(23, 'Tejas', 'tejas@car.com', 'user', '6041d0363da08612bcb0f536e00dba50', 4785698125),
(24, 'Rohit', 'rohit@car.com', 'user', '2d235ace000a3ad85f590e321c89bb99', 7895468521),
(25, 'Ayesh', 'ayesha@car.com', 'user', 'cec9818936add98229817fb432540b18', 7841523698),
(26, 'Manoj', 'Manoj@car.com', 'user', '5e81f9859d223ea420aca993c647b839', 7897458746),
(27, 'Sahil', 'sahil@gmail.com', 'user', '1006f0ae5a7ece19828a67ac62288e05', 7798478956),
(28, 'Janit', 'janit@car.com', 'user', '9dbd12ec2f6b3772ea00199de9c40536', 7897854698),
(29, 'Alia', 'alia@car.com', 'user', '86c8c6c90abd00c209e39736da1ec1fd', 7897458746),
(30, 'Jane', 'jane@car.com', 'user', '5844a15e76563fedd11840fd6f40ea7b', 7458698548),
(31, 'Aneesh', 'aneesh@car.com', 'user', 'd1470756a9290460caf49fa8c424c1a5', 4798569874),
(32, 'Mary', 'mary@car.com', 'user', 'b8e7be5dfa2ce0714d21dcfc7d72382c', 7845968458),
(33, 'Rishab', 'rishab@car.com', 'user', '7e663263c00050dfe773e21dae3a31d8', 7896584587),
(34, 'Ramesh', 'ramesh@car.com', 'user', '6fc42c4388ed6f0c5a91257f096fef3c', 9820184451),
(35, 'ranjan K', 'ranjan@gmail.com', 'user', 'a7cd2205b8031f5858acdfb9eb7d9952', 9874586254);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `mechid` FOREIGN KEY (`mechid`) REFERENCES `mechanics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oid` FOREIGN KEY (`oid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`carid`) REFERENCES `car_details` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `mech`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mech`()
select * from mechanics$$

DROP PROCEDURE IF EXISTS `sum`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sum`()
BEGIN
select sum(amount)
from users u, purchase p
where p.oid=u.id
group by(p.oid);
END$$

DROP PROCEDURE IF EXISTS `users`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `users`()
select * from users$$

DELIMITER ;
