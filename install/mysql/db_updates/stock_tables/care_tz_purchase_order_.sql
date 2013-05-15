-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 16, 2008 at 12:15 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=50 ;

-- 
-- Dumping data for table `care_tz_purchase_order`
-- 

INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (1, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (2, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (4, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (5, '03/28/08', 14, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (6, '03/28/08', 15, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (7, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (8, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (9, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (10, '03/28/08', 0, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (48, '05/07/08', 10, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (45, '05/05/08', 11, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (13, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (14, '03/28/08', 16, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (15, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (44, '05/05/08', 7, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (17, '03/28/08', 15, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (18, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (38, '04/14/08', 11, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (20, '03/28/08', 16, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (21, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (22, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (23, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (24, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (25, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (26, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (46, '05/05/08', 11, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (28, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (29, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (30, '03/28/08', 18, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (33, '04/04/08', 5, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (47, '05/05/08', 11, 'demo', NULL, NULL);
INSERT INTO `care_tz_purchase_order` (`order_no`, `order_date`, `supplier_id`, `ordered_by`, `status`, `remarks`) VALUES (49, '05/20/08', 11, 'demo', NULL, NULL);
