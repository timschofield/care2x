-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 18, 2007 at 12:14 PM
-- Server version: 5.0.21
-- PHP Version: 5.1.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_tz_mtuha_cat`
-- 

DROP TABLE IF EXISTS `care_tz_mtuha_cat`;
CREATE TABLE `care_tz_mtuha_cat` (
  `cat_ID` int(50) NOT NULL auto_increment,
  `description` varchar(100) character set latin1 default NULL,
  PRIMARY KEY  (`cat_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=59 ;

-- 
-- Dumping data for table `care_tz_mtuha_cat`
-- 

INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (1, 'Acute Respiratory Infections');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (2, 'Diarrhoeal Diseases- bacterial');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (3, 'Diarrhoeal Diseases- non-bacterial');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (4, 'Hepatitis HAV');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (5, 'Hepatitis HBV');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (6, 'Hepatitis Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (7, 'Intestinal Worms');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (8, 'Leprosy');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (9, 'Malaria - severe, complicated');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (10, 'Malaria - uncomplicated');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (11, 'Schistosomiasis');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (12, 'Tuberculosis');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (13, 'Genital Discharge Syndrome');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (14, 'Genital Ulcers Disease');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (15, 'Sex trans. dise (others)');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (16, 'Severe Protein Energy Malnutrition');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (17, 'Nutritional Disorders');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (18, 'Anaemia, Sickle cell');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (19, 'Anaemia, Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (20, 'Neuroses');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (21, 'Psychoses');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (22, 'Epilepsy');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (23, 'Ear Infetions');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (24, 'Eye Infections');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (25, 'Other eye diseases, Cataract');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (26, 'Other eye diseases, other non inf');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (27, 'Vitamin A Defic/Xerophtalmia');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (28, 'Cardiov Dis, Cardiac Failure');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (29, 'Cardiov Dis, Hypertension');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (30, 'Cardiov Dis, Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (31, 'Rheumatic fever');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (32, 'Asthma');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (33, 'Pneumonia');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (34, 'Respiratory Diseases, Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (35, 'Non inf GI diseases, Peptic ulcer');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (36, 'Non inf GI diseases, Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (37, 'Non inf liver diseases');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (38, 'Gynecological disorders, PID');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (39, 'Gynecological disorders, Others');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (40, 'UTI');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (41, 'Non-infectious kidney diseases');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (42, 'Skin Diseases, Infectious');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (43, 'Skin Diseases, Non-infectious');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (44, 'Rheumatoid or Joint Diseases');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (45, 'Perinatal, neonatal Conditions');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (46, 'Snake and Insect bites');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (47, 'Burns');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (48, 'Poisonings');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (49, 'Clinical AIDS');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (50, 'Neoplasms');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (51, 'Thyroid Diseases');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (52, 'Diabetes Mellitus');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (53, 'Haematological diseases (excl anaemias)');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (54, 'Osteomyelitis');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (55, 'Congenital diseases');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (56, 'Fractures, dislocations');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (57, 'Ill defined symptoms, no diagnosis');
INSERT INTO `care_tz_mtuha_cat` (`cat_ID`, `description`) VALUES (58, 'Diagnosis, others');
