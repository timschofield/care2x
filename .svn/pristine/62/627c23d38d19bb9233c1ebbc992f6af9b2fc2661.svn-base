-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2012 at 10:21 AM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leskoweb_c2xelct`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_chemlabor`
--

DROP TABLE IF EXISTS `care_test_request_chemlabor`;
CREATE TABLE IF NOT EXISTS `care_test_request_chemlabor` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `item_id` varchar(20) NOT NULL,
  `room_nr` varchar(10) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parameters` text NOT NULL,
  `doctor_sign` varchar(35) NOT NULL DEFAULT '',
  `highrisk` smallint(1) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sample_time` time NOT NULL DEFAULT '00:00:00',
  `sample_weekday` smallint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text,
  `bill_number` bigint(20) NOT NULL DEFAULT '0',
  `bill_status` varchar(10) NOT NULL DEFAULT '',
  `is_disabled` varchar(255) DEFAULT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(1) NOT NULL,
  PRIMARY KEY (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10012041 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
