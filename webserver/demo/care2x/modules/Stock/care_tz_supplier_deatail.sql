-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 14, 2008 at 05:38 PM
-- Server version: 5.0.24
-- PHP Version: 4.4.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_supplier_deatail`
-- 

CREATE TABLE IF NOT EXISTS `care_tz_supplier_deatail` (
  `Suplier_id` int(11) NOT NULL auto_increment,
  `Company_Name` varchar(50) collate latin1_general_ci NOT NULL,
  `Contact_Person` varchar(50) collate latin1_general_ci NOT NULL,
  `Address1` varchar(150) collate latin1_general_ci NOT NULL,
  `Address2` varchar(150) collate latin1_general_ci default NULL,
  `Phone1` varchar(50) collate latin1_general_ci NOT NULL,
  `Phone2` varchar(50) collate latin1_general_ci default NULL,
  `Cell1` varchar(50) collate latin1_general_ci NOT NULL,
  `Cell2` varchar(50) collate latin1_general_ci default NULL,
  `Email` varchar(75) collate latin1_general_ci NOT NULL,
  `Fax` varchar(75) collate latin1_general_ci default NULL,
  `Banker` varchar(50) collate latin1_general_ci default NULL,
  `Bank_Details` varchar(100) collate latin1_general_ci default NULL,
  `Account_no` varchar(50) collate latin1_general_ci default NULL,
  `Credit_Limit` varchar(50) collate latin1_general_ci default NULL,
  `Credit_Period` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`Suplier_id`),
  KEY `Company_Name` (`Company_Name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=26 ;

-- 
-- Dumping data for table `care_tz_supplier_deatail`
-- 

INSERT INTO `care_tz_supplier_deatail` VALUES (6, 'UCC', '', 'BOX 76908', '', '+255756354180', '', '88888', '', 'iddy85@yahoo.com', '677567', 'NBC', '', '030201131405', '6666', '8years ');
INSERT INTO `care_tz_supplier_deatail` VALUES (5, 'SURA TECHNOLOGY', 'DFSBSFB', 'BOX 76908', 'DSM', '+255756354180', 'FDBDFB', '88888', 'FDBFDBF', 'iddy85@yahoo.com', '12321233', 'DFBFDBDF', 'BFDBFDB', 'DFBFDSBF', 'SDFBSFDBVF', ' BSDFBSDB');
INSERT INTO `care_tz_supplier_deatail` VALUES (14, 'fdgdgfd', '', 'fdgdgfd', '', 'fdgdgfd', 'fdgdgfd', 'fdgdgfd', 'fdgdgfd', 'fdgdgfd', 'fdgdgfd', 'fdgdgfd', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (17, 'gfdgfd', 'fbvdsfbfgb', 'fbvdsfbfgb', '', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', '', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (18, 'gfdgfd', 'fbvdsfbfgb', 'fbvdsfbfgb', '', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', 'fbvdsfbfgb', '', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (19, 'telecom', 'Alex', 'dsm', 'Dsm', '31213', '1231', '3169161', '84551', 'fvfdvfdvbfd', 'dfvfdvdfv', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (20, 'telecom', 'Alex', 'dsm', 'Dsm', '3169161', '84551', '31213', '1231', 'fvfdvfdvbfd', '', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (21, 'telecom', 'Alex', 'dsm', 'Dsm', '3169161', '84551', '31213', '1231', 'fvfdvfdvbfd', '', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` VALUES (22, 'telecom', 'Alex', 'dsm', 'Dsm', '3169161', '84551', '31213', '1231', 'fvfdvfdvbfd', 'bsbg', 'dfbvfdb', '', '030201131405', '200000', 'gdfsgdfgf');
INSERT INTO `care_tz_supplier_deatail` VALUES (23, 'TAZARA', 'JIMMY', 'TZ', 'TRA', '6235', '026561', '+255', '+255', 'CDSFSVD', '23161', 'CRDB', '', '21321', '485', '2 YRS ');
