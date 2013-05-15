-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 10, 2008 at 10:08 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_cornea`
-- 

DROP TABLE IF EXISTS `care_tz_eye_cornea`;
CREATE TABLE `care_tz_eye_cornea` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(30) default NULL,
  `right_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test4` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test5` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test6` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test7` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test4` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test5` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test6` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test7` varchar(100) collate latin1_general_ci default NULL,
  `Signature` varchar(100) collate latin1_general_ci default NULL,
  `Examination_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `care_tz_eye_cornea`
-- 

INSERT INTO `care_tz_eye_cornea` VALUES (1, 10022423, 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '', 'on', 'on', 'cr', '2008-03-28');
INSERT INTO `care_tz_eye_cornea` VALUES (2, 10022423, '', '', '', '', 'on', '', '', '', '', '', '', '', '', '', '', '2008-03-28');
INSERT INTO `care_tz_eye_cornea` VALUES (3, 10022423, '', '', '', '', '', '', '', '', '', '', '', 'on', 'on', '', '', '2008-03-28');
