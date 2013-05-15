-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 17, 2008 at 09:42 AM
-- Server version: 5.0.24
-- PHP Version: 4.4.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_grn_master`
-- 

DROP TABLE IF EXISTS `care_tz_grn_master`;
CREATE TABLE `care_tz_grn_master` (
  `grn_no` int(11) NOT NULL auto_increment,
  `order_no` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `delivery_no` varchar(20) collate latin1_general_ci NOT NULL,
  `delivery_date` varchar(20) collate latin1_general_ci NOT NULL,
  `item_received_by` varchar(50) collate latin1_general_ci NOT NULL,
  `date_received` varchar(20) collate latin1_general_ci NOT NULL,
  `cash_credit` varchar(15) collate latin1_general_ci NOT NULL,
  `total_price` double NOT NULL,
  `invoice_amount` double default '0',
  `currency` varchar(15) collate latin1_general_ci NOT NULL,
  `invoice_date` varchar(20) collate latin1_general_ci default NULL,
  `invoice_no` varchar(20) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`grn_no`),
  KEY `supplier_id` (`supplier_id`),
  KEY `order_no_2` (`order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_tz_grn_master`
-- 

INSERT INTO `care_tz_grn_master` VALUES (1, 40, 18, 'd1', '16/06/2008', 'Iddy magohe', '16/06/2008', 'credit', 9000, 0, 'US $', 'n1', '10');
