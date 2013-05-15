-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2008 at 02:40 PM
-- Server version: 5.0.45
-- PHP Version: 4.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `caredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_tz_purchase_order_detail`
--

CREATE TABLE `care_tz_purchase_order_detail` (
  `no` bigint(20) NOT NULL auto_increment,
  `order_no` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit` varchar(50) collate latin1_general_ci default NULL,
  `quantity` float NOT NULL,
  `unit_cost` double NOT NULL,
  `total_cost` double NOT NULL,
  PRIMARY KEY  (`no`),
  KEY `item_id` (`item_id`),
  KEY `order_no` (`order_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `care_tz_purchase_order_detail`
--

INSERT INTO `care_tz_purchase_order_detail` (`no`, `order_no`, `item_id`, `unit`, `quantity`, `unit_cost`, `total_cost`) VALUES
(39, 38, 11, NULL, 67, 100, 6700),
(29, 33, 12, NULL, 56, 400, 22400),
(42, 45, 11, NULL, 89, 100, 8900),
(11, 33, 27, NULL, 23, 100, 2300),
(23, 33, 5, NULL, 23, 1222, 28106),
(40, 44, 11, NULL, 0, 670, 0),
(43, 45, 11, NULL, 90, 234, 21060),
(44, 48, 12, NULL, 3, 100, 300),
(49, 48, 12, NULL, 68, 7000, 476000),
(46, 47, 11, NULL, 8, 900, 7200),
(53, 46, 8, NULL, 22, 100, 2200),
(52, 46, 12, NULL, 222, 100, 22200);
