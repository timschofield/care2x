-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 16, 2008 at 12:20 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_supplier_deatail`
-- 

DROP TABLE IF EXISTS `care_tz_supplier_deatail`;
CREATE TABLE `care_tz_supplier_deatail` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `care_tz_supplier_deatail`
-- 

INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (6, 'UCC', '', 'BOX 76908', '', '+255756354180', '', '88888', '', 'iddy85@yahoo.com', '677567', 'NBC', '', '030201131405', '6666', '8years ');
INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (7, 'UCCtttt', '', 'BOX 76908', '', '+255756354180', '', '88888', '', 'iddy85@yahoo.com', '677567', 'NBC', '', '030201131405', '6666', '8years ');
INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (8, 'astra', '', 'box 111 bunda', '', '99999', '', '0713131765', '', 'hhh@me.com', 'xxxxx', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (9, 'astra', '', 'box 111 bunda', '', '99999', '', '0713131765', '', 'hhh@me.com', 'xxxxx', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (10, 'astra', '', 'box 111 bunda', '', '99999', '', '0713131765', '', 'hhh@me.com', 'xxxxx', '', '', '', '', ' ');
INSERT INTO `care_tz_supplier_deatail` (`Suplier_id`, `Company_Name`, `Contact_Person`, `Address1`, `Address2`, `Phone1`, `Phone2`, `Cell1`, `Cell2`, `Email`, `Fax`, `Banker`, `Bank_Details`, `Account_no`, `Credit_Limit`, `Credit_Period`) VALUES (11, 'astra', '', 'box 111 bunda', '', '99999', '', '0713131765', '', 'hhh@me.com', 'xxxxx', '', '', '', '', ' ');
