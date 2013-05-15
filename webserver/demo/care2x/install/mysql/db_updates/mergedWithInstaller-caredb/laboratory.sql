/*

update `care_tz_laboratory_param` set add_type='radio' where add_type='checkbox'
*/
-- --------------------------------------------------------
--
-- Table structure for table `care_test_findings_chemlabor_sub`
--
DROP TABLE IF EXISTS `care_test_findings_chemlabor_sub`;
CREATE TABLE `care_test_findings_chemlabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL default '0',
  `job_id` varchar(25) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `paramater_name` varchar(255) default '0',
  `parameter_value` varchar(255) default '0',
  `status` varchar(255) character set latin1 collate latin1_general_ci default NULL,
  `history` text character set latin1 collate latin1_general_ci,
  `test_date` date NOT NULL default '0000-00-00',
  `test_time` time default NULL,
  `create_id` varchar(35) character set latin1 collate latin1_general_ci default NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`sub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `care_test_findings_chemlabor_sub`
--
CREATE TABLE IF NOT EXISTS `care_test_findings_laboratory` (
  `findings_nr` int(11) NOT NULL auto_increment,
  `parent` int(11) default NULL COMMENT 'Point to the HEAD finding_nr for follow up findings',
  `task_nr` int(11) NOT NULL default '-1',
  `timestamp` bigint(20) NOT NULL,
  `finding` text NOT NULL,
  `status` varchar(20) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `history` text NOT NULL COMMENT 'Should be empty for follow ups, just for HEAD findings',
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`findings_nr`,`task_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `care_test_request_chemlabor_sub`
--
DROP TABLE IF EXISTS `care_test_request_chemlabor_sub`;
CREATE TABLE `care_test_request_chemlabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `paramater_name` varchar(255) default '0',
  `parameter_value` varchar(255) default '0',
  PRIMARY KEY  (`sub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- Table structure for table `care_test_request_laboratory`
--

CREATE TABLE IF NOT EXISTS `care_test_request_laboratory` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `room_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `doctor_sign` varchar(255) NOT NULL default '',
  `highrisk` smallint(1) NOT NULL default '0',
  `notes` varchar(255) NOT NULL default '',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sample_time` time NOT NULL default '00:00:00',
  `sample_weekday` smallint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL default '',
  `history` varchar(255) NOT NULL default '',
  `is_disabled` varchar(255) default NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_laboratory_tasks`
--

CREATE TABLE IF NOT EXISTS `care_test_request_laboratory_tasks` (
  `task_nr` int(11) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL,
  `test_nr` int(11) NOT NULL,
  `bill_number` bigint(20) NOT NULL default '0',
  `bill_status` varchar(10) NOT NULL default '',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(15) NOT NULL default '',
  `is_disabled` tinyint(4) default '0',
  PRIMARY KEY  (`task_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `care_tz_laboratory_param`
--
DROP TABLE IF EXISTS `care_tz_laboratory_param`;
CREATE TABLE IF NOT EXISTS `care_tz_laboratory_param` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) NOT NULL default '',
  `name` varchar(35) NOT NULL default '',
  `shortname` varchar(10) NOT NULL,
  `sort_nr` tinyint(4) NOT NULL default '0',
  `id` varchar(50) NOT NULL,
  `msr_unit` varchar(15) NOT NULL default '',
  `median` varchar(20) default NULL,
  `hi_bound` varchar(20) default NULL,
  `lo_bound` varchar(20) default NULL,
  `hi_critical` varchar(20) default NULL,
  `lo_critical` varchar(20) default NULL,
  `hi_toxic` varchar(20) default NULL,
  `lo_toxic` varchar(20) default NULL,
  `median_f` varchar(20) default NULL,
  `hi_bound_f` varchar(20) default NULL,
  `lo_bound_f` varchar(20) default NULL,
  `hi_critical_f` varchar(20) default NULL,
  `lo_critical_f` varchar(20) default NULL,
  `hi_toxic_f` varchar(20) default NULL,
  `lo_toxic_f` varchar(20) default NULL,
  `median_n` varchar(20) default NULL,
  `hi_bound_n` varchar(20) default NULL,
  `lo_bound_n` varchar(20) default NULL,
  `hi_critical_n` varchar(20) default NULL,
  `lo_critical_n` varchar(20) default NULL,
  `hi_toxic_n` varchar(20) default NULL,
  `lo_toxic_n` varchar(20) default NULL,
  `median_y` varchar(20) default NULL,
  `hi_bound_y` varchar(20) default NULL,
  `lo_bound_y` varchar(20) default NULL,
  `hi_critical_y` varchar(20) default NULL,
  `lo_critical_y` varchar(20) default NULL,
  `hi_toxic_y` varchar(20) default NULL,
  `lo_toxic_y` varchar(20) default NULL,
  `median_c` varchar(20) default NULL,
  `hi_bound_c` varchar(20) default NULL,
  `lo_bound_c` varchar(20) default NULL,
  `hi_critical_c` varchar(20) default NULL,
  `lo_critical_c` varchar(20) default NULL,
  `hi_toxic_c` varchar(20) default NULL,
  `lo_toxic_c` varchar(20) default NULL,
  `method` varchar(255) default NULL,
  `field_type` varchar(20) NOT NULL default 'input_box' COMMENT 'values are input_box, dropdown and limited',
  `add_type` varchar(255) NOT NULL default '',
  `add_label` varchar(255) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `price` varchar(10) NOT NULL,
  `price_3` varchar(10) default NULL,
  `price_2` varchar(10) default NULL,
  `price_1` varchar(10) default NULL,
  PRIMARY KEY  (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `care_tz_laboratory_param`
--

INSERT INTO `care_tz_laboratory_param` (`nr`, `group_id`, `name`, `shortname`, `sort_nr`, `id`, `msr_unit`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `add_type`, `add_label`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`, `price`, `price_3`, `price_2`, `price_1`) VALUES
(1, 'chemisteries', 'Amylase', 'Amyl', 0, '_amylase__chemisteries', 'md/ld', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:10:26 Moye Masenga\n'')Update 2008-11-18 01:11:57 Niemi\nUpdate 2008-11-18 01:50:04 Niemi\n', 'Niemi', '2008-11-18 01:50:04', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(2, 'chemisteries', 'Bilirubin', 'Bil', 0, '_bilirubin__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 08:55:33 Winnie\r\n'')Update 2008-11-18 01:12:05 Niemi\nUpdate 2008-11-18 01:50:50 Niemi\n', 'Niemi', '2008-11-18 01:50:50', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(3, 'chemisteries', 'Acid Phosphotate', 'AcPhos', 0, '_acid_phosphotate__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2007-10-29 14:42:09 Niemi\n'')Update 2008-11-18 01:21:25 Niemi\nUpdate 2008-11-18 01:49:49 Niemi\n', 'Niemi', '2008-11-18 01:49:49', '', '0000-00-00 00:00:00', '100,00', NULL, NULL, NULL),
(4, 'chemisteries', 'Total Protein', 'TotProt', 0, '_total_protein__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:14:34 Winnie\r\n'')Update 2008-11-18 01:14:59 Niemi\nUpdate 2008-11-18 01:51:55 Niemi\n', 'Niemi', '2008-11-18 01:51:55', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(5, 'chemisteries', 'Creatinine', 'Creat', 0, '_creatinine__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:11:52 Moye Masenga\n'')Update 2008-11-18 01:12:43 Niemi\nUpdate 2008-11-18 01:51:05 Niemi\n', 'Niemi', '2008-11-18 01:51:05', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(6, 'chemisteries', 'HDL', '', 0, '_hdl__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-01-08 11:18:25 Niemi\n'')Update 2008-11-18 01:13:02 Niemi\nUpdate 2008-11-18 01:51:22 Niemi\n', 'Niemi', '2008-11-18 01:51:22', '', '0000-00-00 00:00:00', '20000,00', NULL, NULL, NULL),
(7, 'chemisteries', 'LDL', '', 0, '_ldl__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-01-08 11:18:39 Niemi\n'')Update 2008-11-18 01:13:08 Niemi\nUpdate 2008-11-18 01:51:27 Niemi\n', 'Niemi', '2008-11-18 01:51:27', '', '0000-00-00 00:00:00', '20000,00', NULL, NULL, NULL),
(8, 'chemisteries', 'Potassium K plu', 'K+', 0, '_potassium_k_plu__chemisteries', 'mmol/l', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-04-14 16:12:15 sophy\n'')Update 2008-11-18 01:13:13 Niemi\nUpdate 2008-11-18 01:13:18 Niemi\nUpdate 2008-11-18 01:14:02 Niemi\nUpdate 2008-11-18 01:51:30 Niemi\nUpdate 2008-11-18 01:57:32 Niemi\n', 'Niemi', '2008-11-18 01:57:32', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(9, 'chemisteries', 'SGOT/AST', 'ASAT', 0, '_sgot_ast__chemisteries', 'u/l', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 08:50:00 Winnie\r\n'')Update 2008-11-18 01:14:44 Niemi\nUpdate 2008-11-18 01:51:43 Niemi\n', 'Niemi', '2008-11-18 01:51:43', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(10, 'chemisteries', 'Cholesterol', 'Chol', 0, '_cholesterol__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 08:56:16 Winnie\r\n'')Update 2008-11-18 01:12:20 Niemi\nUpdate 2008-11-18 01:51:02 Niemi\n', 'Niemi', '2008-11-18 01:51:02', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(11, 'chemisteries', 'Sodium Na plus', 'Na+', 0, '_sodium_na_plus__chemisteries', 'mmol/l', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-04-14 16:11:42 sophy\n'')Update 2008-11-18 01:14:53 Niemi\nUpdate 2008-11-18 01:51:51 Niemi\nUpdate 2008-11-18 01:57:40 Niemi\n', 'Niemi', '2008-11-18 01:57:40', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(12, 'chemisteries', 'Uric acid', 'U acid', 0, '_uric_acid__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:00:39 Winnie\r\n'')Update 2008-11-18 01:15:08 Niemi\nUpdate 2008-11-18 01:52:05 Niemi\n', 'Niemi', '2008-11-18 01:52:05', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(13, 'urinalysis', 'Urine Sugar', 'U sug', 0, '_urine_sugar__urinalysis', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:45:47 Niemi\r\n'')Update 2008-11-18 01:19:55 Niemi\nUpdate 2008-11-18 01:55:30 Niemi\n', 'Niemi', '2008-11-18 01:55:30', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(14, 'urinalysis', 'Urine Dip Stick', 'U DipSt', 0, '_urine_dip_stick__urinalysis', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:46:13 Niemi\r\n'')Update 2008-11-18 01:19:52 Niemi\nUpdate 2008-11-18 01:55:27 Niemi\n', 'Niemi', '2008-11-18 01:55:27', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(15, 'urinalysis', 'Routine Urine Analysis w Micro', 'U anal', 0, '_routine_urine_analysis_w_micro__urinalysis', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:45:34 Niemi\r\n'')Update 2008-11-18 01:19:49 Niemi\nUpdate 2008-11-18 01:55:14 Niemi\n', 'Niemi', '2008-11-18 01:55:14', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(16, 'hematology', 'Complete blood count (CBC)', 'CBC', 0, '_complete_blood_count__cbc___hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 08:55:06 Moye Masenga\n'')Update 2008-11-18 01:17:06 Niemi\nUpdate 2008-11-18 01:53:05 Niemi\n', 'Niemi', '2008-11-18 01:53:05', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(17, 'hematology', 'Hemoglobin (Hb)', 'Hb', 0, '_hemoglobin__hb___hematology', 'g/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 08:56:17 Moye Masenga\n'')Update 2008-11-18 01:17:17 Niemi\nUpdate 2008-11-18 01:53:17 Niemi\n', 'Niemi', '2008-11-18 01:53:17', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(18, 'hematology', 'White blood count (WBC)', 'WBC', 0, '_white_blood_count__wbc___hematology', 'mm/3', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-10-03 09:29:05 sekunda shirima\n'')Update 2008-11-18 01:17:55 Niemi\nUpdate 2008-11-18 01:53:46 Niemi\n', 'Niemi', '2008-11-18 01:53:46', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(19, 'hematology', 'Red Blood Cell Count', 'RBC', 0, '_red_blood_cell_count__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:21:21 Winnie\r\n'')Update 2008-11-18 01:22:35 Niemi\nUpdate 2008-11-18 01:53:25 Niemi\n', 'Niemi', '2008-11-18 01:53:25', '', '0000-00-00 00:00:00', '2500,00', NULL, NULL, NULL),
(20, 'hematology', 'Platelet count', 'Platelet c', 0, '_platelet_count__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 08:56:39 Moye Masenga\n'')Update 2008-11-18 01:22:44 Niemi\nUpdate 2008-11-18 01:53:21 Niemi\n', 'Niemi', '2008-11-18 01:53:21', '', '0000-00-00 00:00:00', '2500,00', NULL, NULL, NULL),
(21, 'hematology', 'Reticulocyte count', 'Retic', 0, '_reticulocyte_count__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:19:35 Winnie\r\n'')Update 2008-11-18 01:17:39 Niemi\nUpdate 2008-11-18 01:53:28 Niemi\n', 'Niemi', '2008-11-18 01:53:28', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(22, 'hematology', 'ESR', '', 0, '_esr__hematology', 'mm/hr', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-01-16 14:00:30 Gladnes\n'')Update 2008-11-18 01:17:13 Niemi\nUpdate 2008-11-18 01:53:14 Niemi\n', 'Niemi', '2008-11-18 01:53:14', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(23, 'hematology', 'Sickle cell test', 'SCT', 0, '_sickle_cell_test__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:21:59 Winnie\r\n'')Update 2008-11-18 01:17:44 Niemi\nUpdate 2008-11-18 01:53:32 Niemi\n', 'Niemi', '2008-11-18 01:53:32', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(24, 'hematology', 'Type and Screen Donors', 'Donor T&S', 0, '_type_and_screen_donors__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:23:46 Winnie\r\n'')Update 2008-11-18 01:17:52 Niemi\nUpdate 2008-11-18 01:53:43 Niemi\n', 'Niemi', '2008-11-18 01:53:43', '', '0000-00-00 00:00:00', '4000,00', NULL, NULL, NULL),
(26, 'hematology', 'Coomb''s Test', 'Coomb''s', 0, '_coomb__s_test__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', ' ', 'CONCAT(history,''Update 2006-02-07 09:19:01 Winnie\r\n'')Update 2008-11-18 01:17:09 Niemi\nUpdate 2008-11-18 01:53:08 Niemi\n', 'Niemi', '2008-11-18 01:53:08', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(27, 'hematology', 'Type and Cross Match Patient', 'PatientT&C', 0, '_type_and_cross_match_patient__hematology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', ' ', 'CONCAT(history,''Update 2007-05-28 08:58:20 Moye Masenga\n'')Update 2008-11-18 01:17:48 Niemi\nUpdate 2008-11-18 01:53:36 Niemi\nUpdate 2008-11-18 01:53:40 Niemi\n', 'Niemi', '2008-11-18 01:53:40', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(28, 'serology', 'HIV - Private request', 'HIV priv', 0, '_hiv___private_request__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Positive', ' ', 'CONCAT(history,''Update 2007-05-25 08:48:06 Winnie Dunstan\n'')Update 2008-11-18 01:19:06 Niemi\nUpdate 2008-11-18 01:54:50 Niemi\n', 'Niemi', '2008-11-18 01:54:50', '', '0000-00-00 00:00:00', '0,00', NULL, NULL, NULL),
(29, 'serology', 'Widal Test', 'Widal', 0, '_widal_test__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Positive', ' ', 'CONCAT(history,''Update 2007-05-25 08:47:10 Winnie Dunstan\n'')Update 2008-11-18 01:19:43 Niemi\nUpdate 2008-11-18 01:55:07 Niemi\n', 'Niemi', '2008-11-18 01:55:07', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(30, 'serology', 'HBsAg', '', 0, '_hbsag__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:02:47 Moye Masenga\n'')Update 2008-11-18 01:18:58 Niemi\nUpdate 2008-11-18 01:54:43 Niemi\n', 'Niemi', '2008-11-18 01:54:43', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(31, 'serology', 'HIV - Patient', 'HIV pat', 0, '_hiv___patient__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Positive', ' ', 'CONCAT(history,''Update 2007-05-25 08:48:22 Winnie Dunstan\n'')Update 2008-11-18 01:19:03 Niemi\nUpdate 2008-11-18 01:54:47 Niemi\n', 'Niemi', '2008-11-18 01:54:47', '', '0000-00-00 00:00:00', '0,00', NULL, NULL, NULL),
(32, 'serology', 'Brucellosis', 'Bruc', 0, '_brucellosis__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:42:29 Niemi\r\n'')Update 2008-11-18 01:18:42 Niemi\nUpdate 2008-11-18 01:54:30 Niemi\n', 'Niemi', '2008-11-18 01:54:30', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(33, 'serology', 'H. pylori', 'H.pyl', 0, '_h__pylori__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:42:58 Niemi\r\n'')Update 2008-11-18 01:18:54 Niemi\nUpdate 2008-11-18 01:54:39 Niemi\n', 'Niemi', '2008-11-18 01:54:39', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(34, 'stool', 'Haematest', 'Haemat', 0, '_haematest__stool', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:50:44 Niemi\r\n'')Update 2008-11-18 01:18:28 Niemi\nUpdate 2008-11-18 01:54:18 Niemi\n', 'Niemi', '2008-11-18 01:54:18', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(35, 'stool', 'Stool for O&P', 'Stool O&P', 0, '_stool_for_o_p__stool', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-01-16 14:11:06 Gladnes\r\n'')Update 2008-11-18 01:18:31 Niemi\nUpdate 2008-11-18 01:54:21 Niemi\n', 'Niemi', '2008-11-18 01:54:21', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(36, 'bacteriology', 'AFB (tuberculosis) No. 1', 'AFB no1', 0, '_afb__tuberculosis__no__1__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', 'Positivie', ' ', 'CONCAT(history,''Update 2006-02-18 14:12:09 Niemi\r\n'')Update 2008-11-18 01:15:30 Niemi\nUpdate 2008-11-18 01:44:48 Niemi\nUpdate 2008-11-18 01:52:12 Niemi\n', 'Niemi', '2008-11-18 01:52:12', '', '0000-00-00 00:00:00', '0,00', NULL, NULL, NULL),
(37, 'bacteriology', 'Gram Stain', 'Gram st', 0, '_gram_stain__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:17:47 Moye Masenga\n'')Update 2008-11-18 01:16:19 Niemi\nUpdate 2008-11-18 01:16:37 Niemi\nUpdate 2008-11-18 01:52:33 Niemi\n', 'Niemi', '2008-11-18 01:52:33', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(40, 'bacteriology', 'HVS/URETHRA WET', 'C&S', 0, '_hvs_urethra_wet__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-06-19 17:18:45 Gladness John\n'')Update 2008-11-18 01:16:45 Niemi\nUpdate 2008-11-18 01:47:22 Niemi\nUpdate 2008-11-18 01:52:41 Niemi\n', 'Niemi', '2008-11-18 01:52:41', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(41, 'bacteriology', 'KOH Stain', 'KOH', 0, '_koh_stain__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', ' ', 'CONCAT(history,''Update 2005-11-15 10:48:38 Niemi\r\n'')Update 2008-11-18 01:16:49 Niemi\n', 'Niemi', '2008-11-18 01:16:49', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(42, 'parasitology', 'Malaria - QBC', 'Mal QBC', 0, '_malaria___qbc__parasitology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', 'Positive', ' ', 'CONCAT(history,''Update 2006-02-18 14:13:37 Niemi\r\n'')Update 2008-11-18 01:18:14 Niemi\nUpdate 2008-11-18 01:54:04 Niemi\n', 'Niemi', '2008-11-18 01:54:04', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(43, 'parasitology', 'Malaria Smear', 'Mal smear', 0, '_malaria_smear__parasitology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', 'Positive', ' ', 'CONCAT(history,''Update 2006-02-18 14:13:48 Niemi\r\n'')Update 2008-11-18 01:18:18 Niemi\nUpdate 2008-11-18 01:54:07 Niemi\n', 'Niemi', '2008-11-18 01:54:07', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(44, 'parasitology', 'Leishmaniasis', 'Leishm', 0, '_leishmaniasis__parasitology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:17:41 Niemi\r\n'')Update 2008-11-18 01:18:02 Niemi\nUpdate 2008-11-18 01:54:01 Niemi\n', 'Niemi', '2008-11-18 01:54:01', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(45, 'parasitology', 'Schistosomiasis', 'Schisto', 0, '_schistosomiasis__parasitology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'text', 'specify site', ' ', 'CONCAT(history,''Update 2005-11-15 11:18:22 Niemi\r\n'')Update 2008-11-18 01:18:22 Niemi\nUpdate 2008-11-18 01:54:10 Niemi\n', 'Niemi', '2008-11-18 01:54:10', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(46, 'other', 'Pregnancy Test', 'Pregn', 0, '_pregnancy_test__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:00:58 Niemi\r\n'')Update 2008-11-18 01:20:55 Niemi\nUpdate 2008-11-18 01:55:50 Niemi\n', 'Niemi', '2008-11-18 01:55:50', '', '0000-00-00 00:00:00', '2500,00', NULL, NULL, NULL),
(47, 'other', 'CSF (Full Exam)', 'CSF-full', 0, '_csf__full_exam___other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:01:29 Niemi\r\n'')Update 2008-11-18 01:20:34 Niemi\nUpdate 2008-11-18 01:55:40 Niemi\n', 'Niemi', '2008-11-18 01:55:40', '', '0000-00-00 00:00:00', '3500,00', NULL, NULL, NULL),
(48, 'other', 'Effusion (same as CSF Screen)', 'Effusion', 0, '_effusion__same_as_csf_screen___other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:02:09 Niemi\r\n'')Update 2008-11-18 01:20:38 Niemi\nUpdate 2008-11-18 01:55:43 Niemi\n', 'Niemi', '2008-11-18 01:55:43', '', '0000-00-00 00:00:00', '3500,00', NULL, NULL, NULL),
(53, 'other', 'Bleed Time', 'Bl time', 0, '_bleed_time__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:07:30 Moye Masenga\n'')Update 2008-11-18 01:20:13 Niemi\nUpdate 2008-11-18 01:55:36 Niemi\n', 'Niemi', '2008-11-18 01:55:36', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(56, 'other', 'Rheumatoid Factor', 'Rh fact', 0, '_rheumatoid_factor__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 11:59:23 Niemi\r\n'')Update 2008-11-18 01:21:03 Niemi\nUpdate 2008-11-18 01:55:53 Niemi\n', 'Niemi', '2008-11-18 01:55:53', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(58, 'other', 'CD4', '', 0, '_cd4__other', '+lymph/m/3', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 11:59:32 Niemi\n'')Update 2008-11-18 01:20:31 Niemi\n', 'Niemi', '2008-11-18 01:20:31', '', '0000-00-00 00:00:00', '15000,00', NULL, NULL, NULL),
(59, 'other', 'Thyroid Function', 'Thyr funct', 0, '_thyroid_function__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-25 08:50:20 Winnie Dunstan\n'')Update 2008-11-18 01:21:11 Niemi\nUpdate 2008-11-18 01:56:00 Niemi\n', 'Niemi', '2008-11-18 01:56:00', '', '0000-00-00 00:00:00', '45000,00', NULL, NULL, NULL),
(61, 'other', 'Glucometer Glucose', 'BG Glucom', 0, '_glucometer_glucose__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-25 08:49:48 Winnie Dunstan\n'')Update 2008-11-18 01:20:42 Niemi\nUpdate 2008-11-18 01:55:47 Niemi\n', 'Niemi', '2008-11-18 01:55:47', '', '0000-00-00 00:00:00', '2500,00', NULL, NULL, NULL),
(63, 'other', 'Semen Analysis', 'Semen', 0, '_semen_analysis__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:04:02 Niemi\r\n'')Update 2008-11-18 01:21:08 Niemi\nUpdate 2008-11-18 01:55:57 Niemi\n', 'Niemi', '2008-11-18 01:55:57', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(64, 'other', 'PPT', '', 0, '_ppt__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:08:06 Niemi\n'')Update 2008-11-18 01:20:50 Niemi\n', 'Niemi', '2008-11-18 01:20:50', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(65, 'other', 'HVS', '', 0, '_hvs__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:02:39 Niemi\n'')Update 2008-11-18 01:20:46 Niemi\n', 'Niemi', '2008-11-18 01:20:46', '', '0000-00-00 00:00:00', '1000,00', NULL, NULL, NULL),
(69, 'other', 'PT', '', 0, '_pt__other', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 11:05:19 Niemi\n'')Update 2008-11-18 01:20:59 Niemi\n', 'Niemi', '2008-11-18 01:20:59', '', '0000-00-00 00:00:00', '3000,00', NULL, NULL, NULL),
(71, 'bacteriology', 'AFB (tuberculosis) No. 2', 'AFB no2', 0, '_afb__tuberculosis__no__2__bacteriology', '', '12', '12', '', '', '', '', '', NULL, NULL, '12', '12', NULL, NULL, NULL, NULL, NULL, '01', '01', NULL, NULL, NULL, NULL, '112', '112', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '114', NULL, 'radio', 'Positive', ' ', 'CONCAT(history,''Update 2006-02-18 14:12:24 Niemi\r\n'')Update 2008-11-10 16:59:09 Niemi\nUpdate 2008-11-10 16:59:50 Niemi\nUpdate 2008-11-10 17:00:19 Niemi\nUpdate 2008-11-10 17:29:43 Niemi\nUpdate 2008-11-18 01:15:34 Niemi\nUpdate 2008-11-18 01:45:12 Niemi\nUpdate 2008-11-18 01:52:14 Niemi\n', 'Niemi', '2008-11-18 01:52:14', '', '0000-00-00 00:00:00', '0,00', NULL, NULL, NULL),
(72, 'bacteriology', 'AFB (tuberculosis) No. 3', 'AFB no3', 0, '_afb__tuberculosis__no__3__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', 'Positive', ' ', 'CONCAT(history,''Update 2006-02-18 14:12:34 Niemi\r\n'')Update 2008-11-18 01:16:01 Niemi\nUpdate 2008-11-18 01:45:16 Niemi\nUpdate 2008-11-18 01:46:03 Niemi\nUpdate 2008-11-18 01:52:19 Niemi\n', 'Niemi', '2008-11-18 01:52:19', '', '0000-00-00 00:00:00', '0,00', NULL, NULL, NULL),
(73, 'chemisteries', 'Albumin', 'Alb', 0, '_albumin__chemisteries', 'md/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:08:34 Winnie\r\n'')Update 2008-11-18 01:11:15 Niemi\nUpdate 2008-11-18 01:49:56 Niemi\n', 'Niemi', '2008-11-18 01:49:56', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(74, 'chemisteries', 'Blood Urea Nitrogen', 'BUN', 0, '_blood_urea_nitrogen__chemisteries', 'md/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:05:00 Winnie\r\n'')Update 2008-11-18 01:12:16 Niemi\nUpdate 2008-11-18 01:50:58 Niemi\n', 'Niemi', '2008-11-18 01:50:58', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(75, 'chemisteries', 'GGT', '', 0, '_ggt__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:12:57 Moye Masenga\n'')Update 2008-11-18 01:12:52 Niemi\nUpdate 2008-11-18 01:51:13 Niemi\n', 'Niemi', '2008-11-18 01:51:13', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(76, 'chemisteries', 'Alkaline Phosphate', 'Al Phos', 0, '_alkaline_phosphate__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:37:16 Niemi\r\n'')Update 2008-11-18 01:11:52 Niemi\nUpdate 2008-11-18 01:50:00 Niemi\n', 'Niemi', '2008-11-18 01:50:00', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(77, 'chemisteries', 'Glucose Tolerance Test', 'Gluc TT', 0, '_glucose_tolerance_test__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:16:40 Winnie\r\n'')Update 2008-11-18 01:12:57 Niemi\nUpdate 2008-11-18 01:51:17 Niemi\n', 'Niemi', '2008-11-18 01:51:17', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(78, 'chemisteries', 'Fasting Blood Sugar', 'FBS', 0, '_fasting_blood_sugar__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-07 09:15:02 Winnie\r\n'')Update 2008-11-18 01:12:48 Niemi\nUpdate 2008-11-18 01:51:09 Niemi\n', 'Niemi', '2008-11-18 01:51:09', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(79, 'chemisteries', 'Random Blood Sugar', 'RBS', 0, '_random_blood_sugar__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-01-16 13:57:45 Gladnes\r\n'')Update 2008-11-18 01:14:32 Niemi\nUpdate 2008-11-18 01:51:34 Niemi\n', 'Niemi', '2008-11-18 01:51:34', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(80, 'serology', 'VDRL', '', 0, '_vdrl__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', 'Positive', ' ', 'CONCAT(history,''Update 2006-02-18 14:14:32 Niemi\n'')Update 2008-11-18 01:19:40 Niemi\n', 'Niemi', '2008-11-18 01:19:40', '', '0000-00-00 00:00:00', '2000,00', NULL, NULL, NULL),
(81, 'serology', 'Syphillis by Determine', 'Syph Det', 0, '_syphillis_by_determine__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2005-11-15 10:43:45 Niemi\r\n'')Update 2008-11-18 01:19:23 Niemi\nUpdate 2008-11-18 01:55:04 Niemi\n', 'Niemi', '2008-11-18 01:55:04', '', '0000-00-00 00:00:00', '1500,00', NULL, NULL, NULL),
(82, 'serology', 'Strept - Rapid Test', 'Strept RT', 0, '_strept___rapid_test__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 11:53:43 Niemi\r\n'')Update 2008-11-18 01:19:18 Niemi\nUpdate 2008-11-18 01:55:00 Niemi\n', 'Niemi', '2008-11-18 01:55:00', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(83, 'serology', 'IgE (allergy)', 'IGE', 0, '_ige__allergy___serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 11:55:48 Niemi\r\n'')Update 2008-11-18 01:19:11 Niemi\nUpdate 2008-11-18 01:54:54 Niemi\n', 'Niemi', '2008-11-18 01:54:54', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(84, 'serology', 'Rheumatoid factor', 'RF', 0, '_rheumatoid_factor__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:03:48 Moye Masenga\n'')Update 2008-11-18 01:19:14 Niemi\nUpdate 2008-11-18 01:54:57 Niemi\n', 'Niemi', '2008-11-18 01:54:57', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(85, 'serology', 'Chlamydia', 'Chlam', 0, '_chlamydia__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:02:19 Moye Masenga\n'')Update 2008-11-18 01:18:50 Niemi\n', 'Niemi', '2008-11-18 01:18:50', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(86, 'serology', 'CD4', '', 0, '_cd4__serology', '+lymph/m/3', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:01:33 Moye Masenga\n'')Update 2008-11-18 01:18:45 Niemi\nUpdate 2008-11-18 01:54:33 Niemi\n', 'Niemi', '2008-11-18 01:54:33', '', '0000-00-00 00:00:00', '30000,00', NULL, NULL, NULL),
(87, 'serology', 'ASOT', '', 0, '_asot__serology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:00:36 Moye Masenga\n'')Update 2008-11-18 01:18:38 Niemi\nUpdate 2008-11-18 01:54:27 Niemi\n', 'Niemi', '2008-11-18 01:54:27', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(88, 'bacteriology', 'Body fluids C/S', 'BF C/S', 0, '_body_fluids_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:02:28 Niemi\r\n'')Update 2008-11-18 01:16:10 Niemi\nUpdate 2008-11-18 01:46:27 Niemi\nUpdate 2008-11-18 01:52:26 Niemi\n', 'Niemi', '2008-11-18 01:52:26', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(89, 'bacteriology', 'HVS,Urethreal swap C/S', 'HVS, Ur sw', 0, '_hvs_urethreal_swap_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:03:12 Niemi\r\n'')Update 2008-11-18 01:16:41 Niemi\nUpdate 2008-11-18 01:48:17 Niemi\nUpdate 2008-11-18 01:52:37 Niemi\n', 'Niemi', '2008-11-18 01:52:37', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(90, 'bacteriology', 'CSF Analysis C/S', 'CSFanalC/S', 0, '_csf_analysis_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:03:52 Niemi\r\n'')Update 2008-11-18 01:16:15 Niemi\nUpdate 2008-11-18 01:46:31 Niemi\nUpdate 2008-11-18 01:52:29 Niemi\n', 'Niemi', '2008-11-18 01:52:29', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(91, 'bacteriology', 'Blood C/S', '', 0, '_blood_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:18:34 Moye Masenga\n'')Update 2008-11-18 01:16:05 Niemi\nUpdate 2008-11-18 01:46:22 Niemi\nUpdate 2008-11-18 01:52:22 Niemi\n', 'Niemi', '2008-11-18 01:52:22', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(92, 'bacteriology', 'Stool C/S', '', 0, '_stool_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checkbox', '', ' ', 'CONCAT(history,''Update 2007-05-28 09:16:14 Moye Masenga\n'')Update 2008-11-18 01:16:56 Niemi\nUpdate 2008-11-18 01:47:31 Niemi\nUpdate 2008-11-18 01:52:48 Niemi\n', 'Niemi', '2008-11-18 01:52:48', '', '0000-00-00 00:00:00', '10000,00', NULL, NULL, NULL),
(93, 'bacteriology', 'Pus C/S', '', 0, '_pus_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:04:49 Niemi\n'')Update 2008-11-18 01:16:53 Niemi\nUpdate 2008-11-18 01:47:27 Niemi\nUpdate 2008-11-18 01:52:45 Niemi\n', 'Niemi', '2008-11-18 01:52:45', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(94, 'bacteriology', 'Urine C/S', '', 0, '_urine_c_s__bacteriology', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-06 12:05:08 Niemi\n'')Update 2008-11-18 01:16:59 Niemi\nUpdate 2008-11-18 01:47:34 Niemi\nUpdate 2008-11-18 01:52:51 Niemi\n', 'Niemi', '2008-11-18 01:52:51', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(95, 'chemisteries', 'SGPT/ALAT', 'ALAT', 0, '_sgpt_alat__chemisteries', 'u/l', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2006-11-20 11:20:50 Niemi\n'')Update 2008-11-18 01:14:48 Niemi\nUpdate 2008-11-18 01:51:47 Niemi\n', 'Niemi', '2008-11-18 01:51:47', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(96, 'chemisteries', 'TRYGLYCERIDE', 'Trigly', 0, '_tryglyceride__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'radio', '', ' ', 'CONCAT(history,''Update 2007-01-10 11:18:39 Niemi\n'')Update 2008-11-18 01:15:04 Niemi\nUpdate 2008-11-18 01:52:01 Niemi\n', 'Niemi', '2008-11-18 01:52:01', '', '0000-00-00 00:00:00', '20000,00', NULL, NULL, NULL),
(97, 'chemisteries', 'ACP', '', 0, '_acp__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-10 15:58:08 Rehema\n'')Update 2008-11-18 01:10:15 Niemi\nUpdate 2008-11-18 01:49:53 Niemi\n', 'Niemi', '2008-11-18 01:49:53', '', '0000-00-00 00:00:00', '5000.00', NULL, NULL, NULL),
(98, 'chemisteries', 'B/GLUCOSE ANALYSER', 'Bgluc anal', 0, '_b_glucose_analyser__chemisteries', 'mg/dl', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2006-02-14 10:38:06 Winnie\r\n'')Update 2008-11-18 01:12:01 Niemi\nUpdate 2008-11-18 01:50:08 Niemi\n', 'Niemi', '2008-11-18 01:50:08', '', '0000-00-00 00:00:00', '5000,00', NULL, NULL, NULL),
(99, 'chemisteries', 'Red blood cells mophorlogy', '', 0, '_red_blood_cells_mophorlogy__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2007-01-20 11:36:37 Winnie Dunstan\n'')Update 2008-11-18 01:14:37 Niemi\nUpdate 2008-11-18 01:51:39 Niemi\n', 'Niemi', '2008-11-18 01:51:39', '', '0000-00-00 00:00:00', '2500.00', NULL, NULL, NULL),
(100, 'chemisteries', 'Blood Group', '', 0, '_blood_group__chemisteries', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'CONCAT(history,''Update 2007-03-22 09:20:51 Winnie Dunstan\n'')Update 2008-11-18 01:12:10 Niemi\nUpdate 2008-11-18 01:50:54 Niemi\n', 'Niemi', '2008-11-18 01:50:54', '', '0000-00-00 00:00:00', '1000', NULL, NULL, NULL),
(101, '-1', 'Chemistries', 'chems', 1, 'chemisteries', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'Update 2008-11-10 17:15:22 Niemi\nUpdate 2008-11-10 17:15:36 Niemi\n', 'Niemi', '2008-11-10 17:28:11', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(102, '-1', 'Bacteriology', 'Bacteriolo', 2, 'bacteriology', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:11', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(103, '-1', 'Hematology', 'Hematology', 3, 'hematology', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:12', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(104, '-1', 'Parasitology', 'Parasitolo', 4, 'parasitology', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:13', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(105, '-1', 'Serology', 'Serology', 6, 'serology', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:53', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(106, '-1', 'Stool', 'Stool', 5, 'stool', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:53', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(107, '-1', 'Urinalysis', 'Urinalysis', 7, 'urinalysis', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ' ', 'Update 2008-11-10 17:27:07 Niemi\n', 'Niemi', '2008-11-10 17:28:46', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL),
(108, '-1', 'Other', 'other', 8, 'other', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2008-11-10 17:28:46', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `care_tz_laboratory_param_type`
--

CREATE TABLE IF NOT EXISTS `care_tz_laboratory_param_type` (
  `id` int(11) NOT NULL auto_increment,
  `param_id` varchar(50) collate utf8_unicode_ci NOT NULL,
  `input_value` varchar(35) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

