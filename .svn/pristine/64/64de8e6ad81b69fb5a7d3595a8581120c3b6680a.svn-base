-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2012 at 06:06 PM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leskoweb_c2x_tz`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_tz_laboratory_tests`
--

DROP TABLE IF EXISTS `care_tz_laboratory_tests`;
CREATE TABLE IF NOT EXISTS `care_tz_laboratory_tests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `is_common` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment_required` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `care_tz_laboratory_tests`
--

INSERT INTO `care_tz_laboratory_tests` (`id`, `parent`, `name`, `is_common`, `is_comment_required`, `comment`, `price`, `is_enabled`) VALUES
(1, -1, 'Clinical Chemisteries', 0, 0, '', 0, 1),
(2, -1, 'Haematology', 0, 0, '', 0, 1),
(3, -1, 'Hormones', 0, 0, '', 0, 1),
(4, -1, 'Microbiology', 0, 0, '', 0, 1),
(5, -1, 'Parasitology', 0, 0, '', 0, 1),
(6, -1, 'Serology', 0, 0, '', 0, 1),
(7, -1, 'Pathology', 0, 0, '', 0, 1),
(8, -1, 'Others', 0, 0, '', 0, 1),
(9, 1, ' ACP', 0, 0, '', 0, 1),
(10, 1, ' ALP', 0, 0, '', 0, 1),
(11, 1, ' AMYLASE', 0, 0, '', 0, 1),
(12, 1, ' B/ GLUCOSE ANALYZER', 0, 0, '', 0, 1),
(13, 1, ' BILLIRUBIN T&D', 0, 0, '', 0, 1),
(14, 1, ' BLOOD GLUCOSE', 0, 0, '', 0, 1),
(15, 1, ' BLOOD UREA', 0, 0, '', 0, 1),
(16, 1, ' CALCIUM', 0, 0, '', 0, 1),
(17, 1, ' CHOLESTEROL', 0, 0, '', 0, 1),
(18, 1, ' CREATININE', 0, 0, '', 0, 1),
(19, 1, ' GGT', 0, 0, '', 0, 0),
(20, 1, ' GTT', 0, 0, '', 0, 1),
(21, 1, ' HDL', 0, 0, '', 0, 1),
(22, 1, ' LDL', 0, 0, '', 0, 1),
(23, 1, ' POTASIUM', 0, 0, '', 0, 1),
(24, 1, ' SERUM ALBUMIN', 0, 0, '', 0, 1),
(25, 1, ' SERUM PROTEIN', 0, 0, '', 0, 1),
(26, 1, ' SGOT/ASAT', 0, 0, '', 0, 1),
(27, 1, ' SGPT/ALAT', 0, 0, '', 0, 1),
(28, 1, ' SODIUM', 0, 0, '', 0, 1),
(29, 1, ' TRYGLYCERICE', 0, 0, '', 0, 1),
(30, 1, ' URIC ACID', 0, 0, '', 0, 1),
(31, 2, ' BLEEDING TIME', 0, 0, '', 0, 1),
(32, 2, ' BLOOD TYPING', 0, 0, '', 0, 1),
(33, 2, ' CBC', 0, 1, '', 0, 1),
(34, 2, ' COAGULATION TIME', 0, 1, '', 0, 1),
(35, 2, ' COOMBS TEST', 0, 0, '', 0, 1),
(36, 2, ' DONOR SCREENING', 0, 0, '', 0, 1),
(37, 2, ' ESR', 0, 0, '', 0, 1),
(38, 2, ' FIBRINOGEN TIME', 0, 0, '', 0, 1),
(39, 2, ' HB/HCT', 0, 0, '', 0, 1),
(40, 2, ' PLATELETES COUNT', 0, 0, '', 0, 1),
(41, 2, ' PROTHROMBIN TIME(PT)', 0, 0, '', 0, 1),
(42, 2, ' PTT', 0, 0, '', 0, 1),
(43, 2, ' RBC COUNT', 0, 0, '', 0, 1),
(44, 2, ' RETICULOCYTE COUNT', 0, 0, '', 0, 1),
(45, 2, ' SICKLING TEST', 0, 0, '', 0, 1),
(46, 2, ' TYPING AND XMATCHING', 0, 1, '', 0, 1),
(47, 2, ' WBC T&D', 0, 1, '', 0, 1),
(48, 3, ' ALLERGY (CAT)', 0, 0, '', 0, 0),
(49, 3, ' ALLERGY (COW MILK)', 0, 0, '', 0, 0),
(50, 3, ' ALLERGY (DOG)', 0, 1, '', 0, 0),
(51, 3, ' ALLERGY GENERAL', 0, 0, '', 0, 0),
(52, 3, ' CMV  IgM', 0, 0, '', 0, 0),
(53, 3, ' DIGOXIN', 0, 0, '', 0, 0),
(54, 3, ' FERRITIN/IRONE', 0, 0, '', 0, 0),
(55, 3, ' FSH- FOLLICAL', 0, 0, '', 0, 0),
(56, 3, ' HCG  Serum', 0, 0, '', 0, 0),
(57, 3, ' LH-LUTENIZING', 0, 0, '', 0, 0),
(58, 3, ' PROGESTERONE', 0, 0, '', 0, 0),
(59, 3, ' PROLACTIN HORMONE', 0, 0, '', 0, 0),
(60, 3, ' PSA ', 0, 0, '', 0, 0),
(61, 3, ' TESTESTERONE', 0, 0, '', 0, 0),
(62, 3, ' THYROIDFUNCTIONTEST', 0, 0, '', 0, 0),
(63, 3, ' TOXOPLASMOSIS IgM', 0, 0, '', 0, 0),
(64, 4, ' BLOOD C/S', 0, 0, '', 0, 1),
(65, 4, ' BODY FLUIDS C/S', 0, 0, '', 0, 1),
(66, 4, ' CSF ANALYSIS&C/S', 0, 0, '', 0, 1),
(67, 4, ' HVS,URETHRAL SWAB C/S', 0, 0, '', 0, 1),
(68, 4, ' KOH PREPARATION', 0, 0, '', 0, 1),
(69, 4, ' PUS C/S', 0, 0, '', 0, 1),
(70, 4, ' SPUTUM AFB', 0, 0, '', 0, 1),
(71, 4, ' STOOL C/S', 0, 0, '', 0, 1),
(72, 4, ' URINE C/S', 0, 0, '', 0, 1),
(73, 4, ' WET &GRAM STAIN', 0, 0, '', 0, 1),
(74, 8, ' HISTOLOGY *', 0, 0, '', 0, 1),
(75, 8, ' PAP SMEAR+', 0, 0, '', 0, 1),
(76, 8, ' SEMINALYSIS', 0, 0, '', 0, 1),
(77, 8, ' STOOL OCCULT', 0, 0, '', 0, 1),
(78, 8, ' UPT', 0, 0, '', 0, 1),
(79, 5, ' B/S-HEMOPARASITES', 0, 0, '', 0, 1),
(80, 5, ' QBC- HEMOPARASITES', 0, 0, '', 0, 0),
(81, 5, ' STOOL MICROSCOPY', 0, 0, '', 0, 1),
(82, 5, ' URINE MICROSCOPY', 0, 0, '', 0, 1),
(83, 6, ' PYLORI', 0, 0, '', 0, 1),
(84, 6, ' ASOT', 0, 0, '', 0, 1),
(85, 6, ' BRUCELLA TEST  SCREENING', 0, 0, '', 0, 1),
(86, 6, ' CD4', 0, 0, '', 0, 1),
(87, 6, ' CHLAMIDIA', 0, 0, '', 0, 1),
(88, 6, ' HbsAg', 0, 0, '', 0, 1),
(89, 6, '', 0, 0, '', 0, 1),
(90, 6, ' HIV SCREENING', 0, 0, '', 0, 1),
(91, 6, ' (ALLERGY) GENERAL', 0, 0, '', 0, 1),
(92, 6, ' RHEUMATOID FACTOR', 0, 0, '', 0, 1),
(93, 6, ' STREPT', 0, 0, '', 0, 1),
(94, 6, ' VDRL', 0, 0, '', 0, 1),
(95, 6, ' WIDAL TEST SCREENING', 0, 0, '', 0, 1),
(96, 3, 'T4', 0, 0, '', 0, 0),
(97, 3, 'T3', 0, 0, '', 0, 0),
(98, 3, 'TSH', 0, 0, '', 0, 0),
(99, 3, 'PSA', 0, 0, '', 0, 0),
(102, 1, '', 0, 0, '', 0, 1),
(103, 2, 'INR', 0, 0, '', 0, 1),
(104, 2, '', 0, 0, '', 0, 0),
(105, 2, 'Peripheral/thin blood film', 0, 0, '', 0, 1),
(106, 8, 'Urine albumin', 0, 0, '', 0, 1),
(107, 8, 'Urine glucose', 0, 0, '', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
