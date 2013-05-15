-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 10, 2008 at 10:15 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_visualacuity`
-- 

DROP TABLE IF EXISTS `care_tz_eye_visualacuity`;
CREATE TABLE `care_tz_eye_visualacuity` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(30) default NULL,
  `right_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `right_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test1` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test2` varchar(100) collate latin1_general_ci default NULL,
  `left_eye_test3` varchar(100) collate latin1_general_ci default NULL,
  `Signature` varchar(100) collate latin1_general_ci default NULL,
  `Examination_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `care_tz_eye_visualacuity`
-- 

INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (1, 10022423, '6/18', 'CF', 'pinhole', '6/18', 'CF', '', 'adfasdf', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (2, 10022423, '6/18', 'CF', 'pinhole', '6/18', 'CF', '', 'adfasdf', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (3, 10022423, '6/18', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (4, 10022423, '6/18', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (5, 10022423, '6/18', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (6, 10022423, '6/18', 'CF', 'glasses', '6/5', 'CF', '', 'adfasf', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (7, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (8, 10022423, '6/5', 'CF', 'pinhole', '6/5', 'NPL', 'unaided', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (9, 10022423, '6/5', 'CF', 'unaided', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (10, 10022423, '6/5', 'CF', 'unaided', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (11, 10022423, '6/5', 'PL', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (12, 10022423, '6/5', 'PL', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (13, 10022423, '6/5', 'PL', 'pinhole', '6/5', 'PL', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (14, 10022423, '6/5', 'PL', 'pinhole', '6/5', 'PL', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (15, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (16, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (17, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (18, 10022423, '6/5', 'PLP', '', '6/5', 'CF', 'unaided', 'safdsa', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (19, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', 'asdfsdf', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (20, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', '', '2008-03-25');
INSERT INTO `care_tz_eye_visualacuity` (`id`, `pid`, `right_eye_test1`, `right_eye_test2`, `right_eye_test3`, `left_eye_test1`, `left_eye_test2`, `left_eye_test3`, `Signature`, `Examination_date`) VALUES (21, 10022423, '6/5', 'CF', '', '6/5', 'CF', '', 'asdfsadf', '2008-03-25');
