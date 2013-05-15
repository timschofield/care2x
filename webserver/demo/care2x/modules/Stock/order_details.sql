-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 28, 2008 at 05:49 PM
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
  `order_no` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit` varchar(50) collate latin1_general_ci default NULL,
  `quantity` float NOT NULL,
  `unit_cost` double NOT NULL,
  `total_cost` double NOT NULL,
  PRIMARY KEY  (`order_no`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_tz_purchase_order_detail`
-- 

