-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 03, 2008 at 10:15 AM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_eye_history1`
-- 

DROP TABLE IF EXISTS `care_tz_eye_history1`;
CREATE TABLE `care_tz_eye_history1` (
  `id` int(11) NOT NULL auto_increment,
  `pid` varchar(100) collate latin1_general_ci NOT NULL,
  `hid1` varchar(100) collate latin1_general_ci NOT NULL,
  `hid1e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid1d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid2` varchar(100) collate latin1_general_ci NOT NULL,
  `hid2e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid2d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid3` varchar(100) collate latin1_general_ci NOT NULL,
  `hid3e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid3d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid4` varchar(100) collate latin1_general_ci NOT NULL,
  `hid4e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid4d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid5` varchar(100) collate latin1_general_ci NOT NULL,
  `hid5e` varchar(100) collate latin1_general_ci NOT NULL,
  `hid5d` varchar(100) collate latin1_general_ci NOT NULL,
  `hid6` varchar(100) collate latin1_general_ci NOT NULL,
  `signature` varchar(100) collate latin1_general_ci NOT NULL,
  `remarks` varchar(100) collate latin1_general_ci NOT NULL,
  `examination_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `care_tz_eye_history1`
-- 

