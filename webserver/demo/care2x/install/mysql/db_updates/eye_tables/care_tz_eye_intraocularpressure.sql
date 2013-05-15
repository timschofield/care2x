-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 10, 2008 at 10:10 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_intraocularpressure`
-- 

DROP TABLE IF EXISTS `care_tz_eye_intraocularpressure`;
CREATE TABLE `care_tz_eye_intraocularpressure` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(30) default NULL,
  `right_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `test3` varchar(100) collate latin1_general_ci default NULL,
  `Signature` varchar(100) collate latin1_general_ci default NULL,
  `Examination_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `care_tz_eye_intraocularpressure`
-- 

INSERT INTO `care_tz_eye_intraocularpressure` VALUES (1, 10022423, '16', 'soft', 'perkins', '', '2008-03-27');
INSERT INTO `care_tz_eye_intraocularpressure` VALUES (2, 10022423, '17', '16', '', 'sdfasd', '2008-03-27');
INSERT INTO `care_tz_eye_intraocularpressure` VALUES (3, 10022423, 'Hard', 'soft', 'Digital', 'praak', '2008-03-27');
INSERT INTO `care_tz_eye_intraocularpressure` VALUES (4, 10022423, '10-15', '18', 'perkins', '', '2008-03-31');
