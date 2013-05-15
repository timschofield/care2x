-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2008 at 10:06 AM
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

DROP TABLE IF EXISTS `care_tz_purchase_order_detail`;
CREATE TABLE `care_tz_purchase_order_detail` (
  `order_no` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit` varchar(50) collate latin1_general_ci default NULL,
  `quantity` float NOT NULL,
  `unit_cost` double NOT NULL,
  `total_cost` double NOT NULL,
  KEY `item_id` (`item_id`),
  KEY `order_no` (`order_no`),
  KEY `order_no_2` (`order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `care_tz_purchase_order_detail`
--

INSERT INTO `care_tz_purchase_order_detail` (`order_no`, `item_id`, `unit`, `quantity`, `unit_cost`, `total_cost`) VALUES
(37, 11, NULL, 1, 100, 100),
(37, 5, NULL, 1, 100, 100),
(37, 11, NULL, 1, 100, 100),
(37, 7, NULL, 10, 10, 100),
(37, 12, NULL, 10, 2, 20),
(37, 11, NULL, 10, 3, 30),
(37, 2, NULL, 10, 100, 1000),
(37, 4, NULL, 8, 100, 800),
(37, 12, NULL, 50, 100, 5000),
(38, 11, NULL, 100, 1000, 100000),
(41, 8, NULL, 12, 3000, 36000),
(41, 11, NULL, 500, 30000, 15000000),
(41, 6, NULL, 2, 5000, 10000),
(41, 10, NULL, 10, 300, 3000),
(41, 1, NULL, 10, 6, 60),
(41, 3, NULL, 12, 1000, 12000),
(41, 5, NULL, 12, 100, 1200),
(41, 9, NULL, 12, 100, 1200),
(41, 9, NULL, 10, 1000, 10000),
(41, 3, NULL, 1, 2, 2);
