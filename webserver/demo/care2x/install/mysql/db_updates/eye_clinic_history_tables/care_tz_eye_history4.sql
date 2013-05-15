-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 03, 2008 at 10:19 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_history4`
-- 

DROP TABLE IF EXISTS `care_tz_eye_history4`;
CREATE TABLE `care_tz_eye_history4` (
  `id` int(11) NOT NULL auto_increment,
  `pid` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid1` varchar(100) collate latin1_general_ci NOT NULL,
  `hid1e` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid1d` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid2` varchar(100) collate latin1_general_ci NOT NULL,
  `hid2e` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid2d` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid3` varchar(100) collate latin1_general_ci NOT NULL,
  `hid3e` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid3d` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid4` varchar(100) collate latin1_general_ci NOT NULL,
  `hid4e` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid4d` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid5` varchar(100) collate latin1_general_ci NOT NULL,
  `hid5e` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid5d` varchar(100) collate latin1_general_ci NOT NULL default '',
  `hid6` varchar(100) collate latin1_general_ci NOT NULL,
  `hid6e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid6d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid7` varchar(100) collate latin1_general_ci NOT NULL,
  `signature` varchar(100) collate latin1_general_ci NOT NULL default '',
  `remarks` varchar(100) collate latin1_general_ci NOT NULL default '',
  `examination_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `care_tz_eye_history4`
-- 

