-- 
-- Table structure for table `care_menu_main`
-- 

DROP TABLE IF EXISTS `care_menu_main`;
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

INSERT INTO `care_menu_main` (`nr`, `sort_nr`, `name`, `LD_var`, `url`, `is_visible`, `hide_by`, `status`, `modify_id`, `modify_time`) VALUES (1, 1, 'Home', 'LDHome', 'main/startframe.php', 1, '', '', '2003-09-22 13:20:15', '0000-00-00 00:00:00'),
(2, 5, 'Registration', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '2006-07-24 06:23:57', '0000-00-00 00:00:00'),
(3, 10, 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_list.php', 1, '', '', '2006-07-24 07:37:56', '0000-00-00 00:00:00'),
(4, 15, 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '2005-02-25 02:25:09', '0000-00-00 00:00:00'),
(5, 20, 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', 0, '', '', '2005-11-08 03:31:12', '0000-00-00 00:00:00'),
(6, 25, 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', 0, '', '', '2006-06-29 00:34:50', '0000-00-00 00:00:00'),
(7, 35, 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', 0, '', '', '2006-07-23 21:12:39', '0000-00-00 00:00:00'),
(8, 40, 'OR', 'LDOR', 'main/op-doku.php', 0, '', '', '2006-07-19 21:03:02', '0000-00-00 00:00:00'),
(9, 45, 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '2003-09-22 13:20:15', '0000-00-00 00:00:00'),
(10, 50, 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', 0, '', '', '2007-04-14 09:55:47', '0000-00-00 00:00:00'),
(11, 55, 'Pharmacy', 'LDPharmacy', 'modules/pharmacy_tz/pharmacy_tz_pass.php', 1, '', '', '2005-09-22 03:24:31', '0000-00-00 00:00:00'),
(12, 60, 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', 0, '', '', '2005-02-01 22:22:56', '0000-00-00 00:00:00'),
(13, 65, 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', 0, '', '', '2005-11-08 03:31:20', '0000-00-00 00:00:00'),
(14, 70, 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', 0, '', '', '2005-11-08 03:31:02', '0000-00-00 00:00:00'),
(15, 72, 'System Admin', 'LDEDP', 'modules/system_admin/edv.php', 1, '', '', '2003-09-22 13:20:15', '0000-00-00 00:00:00'),
(16, 75, 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 0, '', '', '2006-11-08 11:48:04', '0000-00-00 00:00:00'),
(17, 80, 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', 0, '', '', '2005-11-08 03:29:44', '0000-00-00 00:00:00'),
(18, 85, 'Special Tools', 'LDSpecials', 'main/spediens.php', 1, '', '', '2006-06-29 00:35:23', '0000-00-00 00:00:00'),
(23, 91, 'Logout', 'LDLogout', 'main/logout_confirm.php', 1, '', '', '2006-07-19 21:03:02', '0000-00-00 00:00:00'),
(20, 7, 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 0, '', '', '2006-06-29 00:34:50', '2003-04-04 13:01:45'),
(21, 16, 'Inpatient', 'LDInpatient', 'modules/inpatient/inpatient.php', 0, '', '', '2005-11-18 21:32:56', '0000-00-00 00:00:00'),
(22, 46, 'Laboratories TZ', 'LDLabs', 'modules/laboratory_tz/labor.php', 0, '', '', '2005-03-08 00:05:45', '0000-00-00 00:00:00'),
(24, 90, 'Login', 'LDLogin', 'main/login.php', 1, '', '', '2005-03-14 02:09:12', '0000-00-00 00:00:00'),
(25, 58, 'Billing', 'LDBilling', 'modules/billing_tz/billing_tz_pass.php', 1, '', '', '2007-07-26 11:06:10', '0000-00-00 00:00:00'),
(27, 59, 'Reporting', 'LDreporting', 'modules/reporting_tz/reporting_tz_pass.php', 1, NULL, '', '2006-08-09 11:43:04', '0000-00-00 00:00:00');
