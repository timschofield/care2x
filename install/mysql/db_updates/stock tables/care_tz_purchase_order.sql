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
-- Table structure for table `care_tz_purchase_order`
-- 

DROP TABLE IF EXISTS `care_tz_purchase_order`;
CREATE TABLE `care_tz_purchase_order` (
  `order_no` int(11) NOT NULL auto_increment,
  `order_date` varchar(25) collate latin1_general_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `ordered_by` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(50) collate latin1_general_ci default NULL,
  `remarks` varchar(75) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`order_no`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_tz_purchase_order`
-- 

INSERT INTO `care_tz_purchase_order` VALUES (42, '06/06/08', 5, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (3, '03/28/08', 7, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (40, '06/02/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (6, '03/28/08', 15, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (7, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (8, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (10, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (14, '03/28/08', 16, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (16, '03/28/08', 7, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (17, '03/28/08', 15, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (19, '03/28/08', 7, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (20, '03/28/08', 16, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` VALUES (41, '06/04/08', 22, 'demo', NULL, NULL);
