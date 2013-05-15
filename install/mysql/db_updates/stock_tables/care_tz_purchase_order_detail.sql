-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 17, 2008 at 09:45 AM
-- Server version: 5.0.24
-- PHP Version: 4.4.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_purchase_order_detail`
-- 

DROP TABLE IF EXISTS `care_tz_purchase_order_detail`;
CREATE TABLE `care_tz_purchase_order_detail` (
  `no` bigint(20) NOT NULL auto_increment,
  `order_no` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit` varchar(50) collate latin1_general_ci default NULL,
  `quantity` float NOT NULL,
  `received_quantity` float default '0',
  `unit_cost` double NOT NULL,
  `total_cost` double NOT NULL,
  PRIMARY KEY  (`no`),
  KEY `item_id` (`item_id`),
  KEY `order_no` (`order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_tz_purchase_order_detail`
-- 

INSERT INTO `care_tz_purchase_order_detail` VALUES (1, 40, 12, NULL, 10, 10, 360, 3600);
INSERT INTO `care_tz_purchase_order_detail` VALUES (2, 40, 8, NULL, 9, 9, 600, 5400);
INSERT INTO `care_tz_purchase_order_detail` VALUES (3, 42, 5, NULL, 300, 0, 90, 27000);
INSERT INTO `care_tz_purchase_order_detail` VALUES (4, 42, 9, NULL, 600, 0, 100, 60000);
INSERT INTO `care_tz_purchase_order_detail` VALUES (5, 41, 282, NULL, 152, 0, 150, 22800);
