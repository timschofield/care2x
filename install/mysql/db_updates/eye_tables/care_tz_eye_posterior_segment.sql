-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 10, 2008 at 10:11 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_posterior_segment`
-- 

DROP TABLE IF EXISTS `care_tz_eye_posterior_segment`;
CREATE TABLE `care_tz_eye_posterior_segment` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(30) default NULL,
  `right_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test4` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test5` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test6` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test7` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test8` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test9` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test4` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test5` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test6` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test7` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test8` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test9` varchar(100) collate latin1_general_ci default NULL,
  `Signature` varchar(100) collate latin1_general_ci default NULL,
  `Examination_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `care_tz_eye_posterior_segment`
-- 

INSERT INTO `care_tz_eye_posterior_segment` VALUES (1, 10022423, 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'ps', '2008-03-30');
