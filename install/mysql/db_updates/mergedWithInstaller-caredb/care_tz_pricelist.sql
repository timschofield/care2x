-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2007 at 01:18 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
--
-- Database: `caredb`
--

-- --------------------------------------------------------

-- DROP TABLE IF EXISTS `care_tz_pricelist`
DROP TABLE IF EXISTS `care_tz_pricelist_accounts`;
DROP TABLE IF EXISTS `care_tz_drugsandservices_description`;
--
-- Adding price description table
--

CREATE TABLE IF NOT EXISTS `care_tz_drugsandservices_description` (
  `ID` bigint(20) NOT NULL auto_increment,
  `last_change` bigint(20) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `Fieldname` varchar(50) NOT NULL,
  `ShowDescription` varchar(50) NOT NULL,
  `FullDescription` varchar(255) NOT NULL,
  `is_insurance_price` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `care_tz_drugsandservices_description`
--

INSERT INTO `care_tz_drugsandservices_description` (`ID`, `last_change`, `UID`, `Fieldname`, `ShowDescription`, `FullDescription`, `is_insurance_price`) VALUES (1, 1183382556, 'Robert', 'unit_price', 'Selians price ', 'TSH (e.g. 12000,00 or 1200) - Standard price for item ', 1),
(2, 1183382556, 'Robert', 'unit_price_1', 'Insured price ', 'TSH (e.g. 1200,00 or 1200) - price for insured people', 0),
(3, 1183382556, 'Robert', 'unit_price_2', 'Private ', 'TSH (e.g. 1200,00 or 1200) - price for self paying people', 0),
(4, 1183382556, 'Robert', 'unit_price_3', 'Company ', 'TSH (e.g. 1200,00 or 1200) - price for Companies', 0);


-- ALTER TABLE `care_tz_drugsandservices` ADD `unit_price_1` VARCHAR( 50 ) NULL AFTER `unit_price` ,
-- ADD `partcode` VCHAR( 255 ) NULL AFTER `item_number`,
-- ADD `unit_price_2` VARCHAR( 50 ) NULL AFTER `unit_price_1` ,
-- ADD `unit_price_3` VARCHAR( 50 ) NULL AFTER `unit_price_2` ;

-- added by RM
-- ALTER TABLE `care_tz_drugsandservices_description` ADD `is_insurance_price` TINYINT NOT NULL DEFAULT '0';
-- ALTER TABLE `care_tz_drugsandservices_description` ADD `last_change` BIGINT NOT NULL AFTER `ID` , ADD `UID` VARCHAR( 50 ) NOT NULL AFTER `last_change` ;
