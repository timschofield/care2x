-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 14, 2008 at 05:47 PM
-- Server version: 5.0.24
-- PHP Version: 4.4.4
-- 
-- Database: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `care_menu_main`
-- 

CREATE TABLE `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `sort_nr` tinyint(2) NOT NULL default '0',
  `name` varchar(35) collate latin1_general_ci NOT NULL default '',
  `LD_var` varchar(35) collate latin1_general_ci NOT NULL default '',
  `url` varchar(255) collate latin1_general_ci NOT NULL default '',
  `is_visible` tinyint(1) unsigned NOT NULL default '1',
  `hide_by` text collate latin1_general_ci,
  `status` varchar(25) collate latin1_general_ci NOT NULL default '',
  `modify_id` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `care_menu_main`
-- 

INSERT INTO `care_menu_main` VALUES (1, 1, 'Home', 'LDHome', 'main/startframe.php', 1, '', '', '2003-09-22 14:20:15', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (2, 5, 'Registration', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '2006-07-24 07:23:57', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (3, 10, 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_list.php', 1, '', '', '2006-07-24 08:37:56', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (4, 15, 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '2005-02-25 04:25:09', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (5, 20, 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', 0, '', '', '2005-11-08 05:31:12', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (6, 25, 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', 0, '', '', '2006-06-29 01:34:50', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (7, 35, 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '2007-08-23 10:04:48', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (8, 40, 'OR', 'LDOR', 'main/op-doku.php', 0, '', '', '2006-07-19 22:03:02', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (9, 45, 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '2003-09-22 14:20:15', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (10, 50, 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '2006-12-20 17:53:55', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (11, 55, 'Pharmacy', 'LDPharmacy', 'modules/pharmacy_tz/pharmacy_tz_pass.php', 1, '', '', '2005-09-22 04:24:31', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (12, 60, 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', 0, '', '', '2005-02-02 00:22:56', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (13, 65, 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', 0, '', '', '2005-11-08 05:31:20', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (14, 70, 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', 0, '', '', '2005-11-08 05:31:02', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (15, 72, 'System Admin', 'LDEDP', 'modules/system_admin/edv.php', 1, '', '', '2003-09-22 14:20:15', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (16, 75, 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 0, '', '', '2006-11-08 13:48:04', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (17, 80, 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', 0, '', '', '2005-11-08 05:29:44', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (18, 85, 'Special Tools', 'LDSpecials', 'main/spediens.php', 1, '', '', '2006-06-29 01:35:23', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (23, 91, 'Logout', 'LDLogout', 'main/logout_confirm.php', 1, '', '', '2006-07-19 22:03:02', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (20, 7, 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', '', '2008-01-25 10:08:41', '2003-04-04 14:01:45');
INSERT INTO `care_menu_main` VALUES (21, 16, 'Inpatient', 'LDInpatient', 'modules/inpatient/inpatient.php', 1, '', '', '2007-08-23 10:03:47', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (22, 46, 'Laboratories TZ', 'LDLabs', 'modules/laboratory_tz/labor.php', 0, '', '', '2005-03-08 02:05:45', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (24, 90, 'Login', 'LDLogin', 'main/login.php', 1, '', '', '2005-03-14 04:09:12', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (25, 58, 'Billing', 'LDBilling', 'modules/billing_tz/billing_tz_pass.php', 1, '', '', '2006-07-23 20:31:45', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (27, 59, 'Reporting', 'LDreporting', 'modules/reporting_tz/reporting_tz_pass.php', 1, NULL, '', '2006-08-09 12:43:04', '0000-00-00 00:00:00');
INSERT INTO `care_menu_main` VALUES (0, 0, 'Stock', 'LDStock', 'modules/Stock/index.php', 1, NULL, '', '2008-03-04 15:44:59', '0000-00-00 00:00:00');
