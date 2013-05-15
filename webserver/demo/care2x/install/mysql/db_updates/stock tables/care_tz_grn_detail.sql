-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 17, 2008 at 09:43 AM
-- Server version: 5.0.24
-- PHP Version: 4.4.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_grn_detail`
-- 

DROP TABLE IF EXISTS `care_tz_grn_detail`;
CREATE TABLE `care_tz_grn_detail` (
  `item_no` int(11) NOT NULL,
  `grn_no` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ordered_quantity` int(11) NOT NULL,
  `received_quantity` int(11) default NULL,
  `unit_cost` double NOT NULL,
  `invoice_total` double NOT NULL,
  `receiving_status` varchar(20) collate latin1_general_ci NOT NULL,
  `batch_no` varchar(20) collate latin1_general_ci default NULL,
  `exp_date` varchar(20) collate latin1_general_ci default NULL,
  KEY `grn_no` (`grn_no`,`item_id`),
  KEY `order_no` (`order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_tz_grn_detail`
-- 

INSERT INTO `care_tz_grn_detail` VALUES (2, 1, 40, 8, 9, 9, 0, 5400, 'credit', 'b1', '1');
INSERT INTO `care_tz_grn_detail` VALUES (1, 1, 40, 12, 10, 5, 0, 1800, 'credit', '22', '2');
INSERT INTO `care_tz_grn_detail` VALUES (1, 1, 40, 12, 10, 5, 0, 1800, 'credit', '2', '20/4/2005');
