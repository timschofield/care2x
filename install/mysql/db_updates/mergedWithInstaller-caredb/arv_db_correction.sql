-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 25. Juli 2007 um 15:41
-- Server Version: 5.0.37
-- PHP-Version: 4.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Datenbank: `caredb`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_adher_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_adher_code`;
CREATE TABLE `care_tz_arv_adher_code` (
  `care_tz_arv_adher_code_id` bigint(20) NOT NULL auto_increment,
  `code` char(1) collate latin1_general_ci default NULL,
  `description` varchar(40) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_adher_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_adher_code`
-- 

INSERT INTO `care_tz_arv_adher_code` VALUES (1, 'G', '(good) fewer than 2 missed days ', 0);
INSERT INTO `care_tz_arv_adher_code` VALUES (2, 'P', '(poor) 2 or more missed days', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_adher_reas`
-- 

DROP TABLE IF EXISTS `care_tz_arv_adher_reas`;
CREATE TABLE `care_tz_arv_adher_reas` (
  `care_tz_arv_adher_reas_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL,
  `other` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_adher_reas_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;



-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_adher_reas_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_adher_reas_code`;
CREATE TABLE `care_tz_arv_adher_reas_code` (
  `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL auto_increment,
  `code` tinyint(3) unsigned default NULL,
  `description` varchar(40) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_adher_reas_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_adher_reas_code`
-- 

INSERT INTO `care_tz_arv_adher_reas_code` VALUES (1, 1, 'TOXICITY ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (2, 2, 'SHARE WITH OTHERS ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (3, 3, 'FORGOT ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (4, 4, 'FELT BETTER ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (5, 5, 'TOO ILL ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (6, 6, 'STIGMA ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (7, 7, 'PHARMACY DRUG STOCK OUT ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (8, 8, 'PATIENT LOST / RAN OUT OF  PILLS ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (9, 9, 'DELIVERY 1 TRAVL PROBLEMS ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (10, 10, 'INABILITY TO  PAY ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (11, 11, 'ALCOHOL ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (12, 12, 'DEPRESSION ', 0);
INSERT INTO `care_tz_arv_adher_reas_code` VALUES (13, 13, 'OTHER (SPECIFY)', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_allergies`
-- 

DROP TABLE IF EXISTS `care_tz_arv_allergies`;
CREATE TABLE `care_tz_arv_allergies` (
  `care_tz_arv_allergies_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_registration_id` bigint(20) default NULL,
  `description` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_allergies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=75 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_chairman`
-- 

DROP TABLE IF EXISTS `care_tz_arv_chairman`;
CREATE TABLE `care_tz_arv_chairman` (
  `care_tz_arv_chairman_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_registration_id` bigint(20) default NULL,
  `vname` varchar(60) collate latin1_general_ci default NULL,
  `nname` varchar(60) collate latin1_general_ci default NULL,
  `street` varchar(60) collate latin1_general_ci default NULL,
  `village` varchar(60) collate latin1_general_ci default NULL,
  `hamlet` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_chairman_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_co_medi`
-- 

DROP TABLE IF EXISTS `care_tz_arv_co_medi`;
CREATE TABLE `care_tz_arv_co_medi` (
  `care_tz_arv_co_medi_id` int(11) NOT NULL auto_increment,
  `care_tz_arv_co_medi_other_id` int(10) unsigned default NULL,
  `item_id` bigint(20) default NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_co_medi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=51 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_co_medi_other`
-- 

DROP TABLE IF EXISTS `care_tz_arv_co_medi_other`;
CREATE TABLE `care_tz_arv_co_medi_other` (
  `care_tz_arv_co_medi_other_id` int(10) unsigned NOT NULL auto_increment,
  `description` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  USING BTREE (`care_tz_arv_co_medi_other_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=24 ;



-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_education`
-- 

DROP TABLE IF EXISTS `care_tz_arv_education`;
CREATE TABLE `care_tz_arv_education` (
  `care_tz_arv_education_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_education_topic_id` bigint(20) NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `comment` text collate latin1_general_ci,
  `comment_date` date default NULL,
  `create_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `history` text collate latin1_general_ci NOT NULL,
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`care_tz_arv_education_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=96 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_education_group`
-- 

DROP TABLE IF EXISTS `care_tz_arv_education_group`;
CREATE TABLE `care_tz_arv_education_group` (
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL auto_increment,
  `description` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_education_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_education_group`
-- 

INSERT INTO `care_tz_arv_education_group` VALUES (1, 'Education on basics, prevention, disclosure');
INSERT INTO `care_tz_arv_education_group` VALUES (2, 'Progression, Rx');
INSERT INTO `care_tz_arv_education_group` VALUES (3, 'ARV preparation, initiation, support, monitor');
INSERT INTO `care_tz_arv_education_group` VALUES (4, 'Home-based care, support');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_education_topic`
-- 

DROP TABLE IF EXISTS `care_tz_arv_education_topic`;
CREATE TABLE `care_tz_arv_education_topic` (
  `care_tz_arv_education_topic_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_education_topic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_education_topic`
-- 

INSERT INTO `care_tz_arv_education_topic` VALUES (1, 1, 'Basic HIV education, transmission');
INSERT INTO `care_tz_arv_education_topic` VALUES (2, 1, 'Prevention: abstinence, safer sex, condoms');
INSERT INTO `care_tz_arv_education_topic` VALUES (3, 1, 'Prevention: household, precautions, what is safe');
INSERT INTO `care_tz_arv_education_topic` VALUES (4, 1, 'Post-test counselling: implications of results');
INSERT INTO `care_tz_arv_education_topic` VALUES (5, 1, 'Positive living');
INSERT INTO `care_tz_arv_education_topic` VALUES (6, 1, 'Testing partners');
INSERT INTO `care_tz_arv_education_topic` VALUES (7, 1, 'Disclosure');
INSERT INTO `care_tz_arv_education_topic` VALUES (8, 1, 'To whom disclosured (list)');
INSERT INTO `care_tz_arv_education_topic` VALUES (9, 1, 'Family/ living situation');
INSERT INTO `care_tz_arv_education_topic` VALUES (10, 1, 'Shared confidentially');
INSERT INTO `care_tz_arv_education_topic` VALUES (11, 1, 'Reproductive choices, prevention, MTCT');
INSERT INTO `care_tz_arv_education_topic` VALUES (12, 1, 'Child''s blood test');
INSERT INTO `care_tz_arv_education_topic` VALUES (13, 2, 'Progession of disease');
INSERT INTO `care_tz_arv_education_topic` VALUES (14, 2, 'Available treatment/prophylaxis');
INSERT INTO `care_tz_arv_education_topic` VALUES (15, 2, 'Follow-up appointments, care and treatment team');
INSERT INTO `care_tz_arv_education_topic` VALUES (16, 2, 'CTX, INH, prophylaxis');
INSERT INTO `care_tz_arv_education_topic` VALUES (17, 3, 'ART - educate on essentials (locally adapted)');
INSERT INTO `care_tz_arv_education_topic` VALUES (18, 3, 'Why complete adherance needed');
INSERT INTO `care_tz_arv_education_topic` VALUES (19, 3, 'Adherance preparation, indicate visits');
INSERT INTO `care_tz_arv_education_topic` VALUES (20, 3, 'Indicate when READY for ART: DATE/result, Care and treatment-team discussion');
INSERT INTO `care_tz_arv_education_topic` VALUES (21, 3, 'Explain dose, when to take');
INSERT INTO `care_tz_arv_education_topic` VALUES (22, 3, 'What can occur, how to manage side effects');
INSERT INTO `care_tz_arv_education_topic` VALUES (23, 3, 'What to do if one forgets dose');
INSERT INTO `care_tz_arv_education_topic` VALUES (24, 3, 'What to do when travelling');
INSERT INTO `care_tz_arv_education_topic` VALUES (25, 3, 'Adherance plan (schedule, aids, explain, diary)');
INSERT INTO `care_tz_arv_education_topic` VALUES (26, 3, 'Treatment-supporter preparation');
INSERT INTO `care_tz_arv_education_topic` VALUES (27, 3, 'Which doses, why missed');
INSERT INTO `care_tz_arv_education_topic` VALUES (28, 3, 'ARV support group');
INSERT INTO `care_tz_arv_education_topic` VALUES (29, 4, 'How to contact clinic');
INSERT INTO `care_tz_arv_education_topic` VALUES (30, 4, 'Symptoms management/palliative care at home');
INSERT INTO `care_tz_arv_education_topic` VALUES (31, 4, 'Caregiver Booklet');
INSERT INTO `care_tz_arv_education_topic` VALUES (32, 4, 'Home-based care - specify');
INSERT INTO `care_tz_arv_education_topic` VALUES (33, 4, 'Support groups');
INSERT INTO `care_tz_arv_education_topic` VALUES (34, 4, 'Community support');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_eligible_reason`
-- 

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason`;
CREATE TABLE `care_tz_arv_eligible_reason` (
  `care_tz_arv_eligible_reason_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_lab_id` bigint(20) default NULL,
  PRIMARY KEY  (`care_tz_arv_eligible_reason_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=66 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_eligible_reason_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason_code`;
CREATE TABLE `care_tz_arv_eligible_reason_code` (
  `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL auto_increment,
  `description` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_eligible_reason_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_eligible_reason_code`
-- 

INSERT INTO `care_tz_arv_eligible_reason_code` VALUES (1, 'Clinical only');
INSERT INTO `care_tz_arv_eligible_reason_code` VALUES (2, 'CD4 counts/%');
INSERT INTO `care_tz_arv_eligible_reason_code` VALUES (3, 'TLC');


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_exposure`
-- 

DROP TABLE IF EXISTS `care_tz_arv_exposure`;
CREATE TABLE `care_tz_arv_exposure` (
  `care_tz_arv_exposure_id` int(10) unsigned NOT NULL auto_increment,
  `description` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_exposure_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_exposure`
-- 

INSERT INTO `care_tz_arv_exposure` VALUES (1, 'NONE');
INSERT INTO `care_tz_arv_exposure` VALUES (2, 'PRIOR THERAPY (transfer in without records)');
INSERT INTO `care_tz_arv_exposure` VALUES (3, 'PMTCT MONOTHERAPY');
INSERT INTO `care_tz_arv_exposure` VALUES (4, 'PMTCT COMINATION THERAPY');
INSERT INTO `care_tz_arv_exposure` VALUES (5, 'TRANSFER IN (with records)');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_follow_status`
-- 

DROP TABLE IF EXISTS `care_tz_arv_follow_status`;
CREATE TABLE `care_tz_arv_follow_status` (
  `care_tz_arv_follow_status_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_follow_status_code_id` int(10) unsigned default NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_follow_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=43 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_follow_status_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_follow_status_code`;
CREATE TABLE `care_tz_arv_follow_status_code` (
  `care_tz_arv_follow_status_code_id` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(8) collate latin1_general_ci default NULL,
  `description` varchar(80) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_follow_status_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_follow_status_code`
-- 

INSERT INTO `care_tz_arv_follow_status_code` VALUES (1, 'MISSAPP', '1 OR 2 MISSING APPOINTMENTS ', 0);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (2, 'LTF', 'LOST TO FOLLOW-UP (Not seen for 3 or more months since last scheduled appointmen', 0);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (3, 'OR', '3 or more missing appointments [pre-ART patients] with 2 attempts to follow-up) ', 0);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (4, 'STOP', 'PATIENT/PROVIDER DECISION TO STOP ART, ADD REASON CODE ', 0);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (5, 'TO', 'TRANSFER OUT', 1);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (6, 'DEAD', 'DIED ', 0);
INSERT INTO `care_tz_arv_follow_status_code` VALUES (7, 'RESTART', 'Patient restarts ARVs after interruption from STOP or LOST TO FOLLOW-UP ', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_functional_status`
-- 

DROP TABLE IF EXISTS `care_tz_arv_functional_status`;
CREATE TABLE `care_tz_arv_functional_status` (
  `care_tz_arv_functional_status_id` int(10) unsigned NOT NULL auto_increment,
  `code` char(1) collate latin1_general_ci default NULL,
  `description` varchar(60) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_functional_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_functional_status`
-- 

INSERT INTO `care_tz_arv_functional_status` VALUES (1, 'W', 'Working', 0);
INSERT INTO `care_tz_arv_functional_status` VALUES (2, 'A', 'Ambulant', 0);
INSERT INTO `care_tz_arv_functional_status` VALUES (3, 'B', 'Bedridden', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_illness`
-- 

DROP TABLE IF EXISTS `care_tz_arv_illness`;
CREATE TABLE `care_tz_arv_illness` (
  `care_tz_arv_illness_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_illness_code_id` bigint(20) NOT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(80) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_illness_id`),
  KEY `care_tz_arv_events_FKIndex2` (`care_tz_arv_visit_2_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=136 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_illness_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_illness_code`;
CREATE TABLE `care_tz_arv_illness_code` (
  `care_tz_arv_illness_code_id` bigint(20) NOT NULL auto_increment,
  `code` varchar(10) collate latin1_general_ci NOT NULL,
  `description` varchar(256) collate latin1_general_ci NOT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_illness_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_illness_code`
-- 

INSERT INTO `care_tz_arv_illness_code` VALUES (1, 'AB', 'Abdominal pain', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (2, 'A', 'Anaemia ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (3, 'BN', 'Burning/Numb/tingling ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (4, 'CNS', 'dizzy, anxiety, nightmare, depression ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (5, 'COUGH', 'Cough ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (6, 'CM', 'Cryptococcal Meningitis ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (7, 'DB', 'Difficult Breathing ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (8, 'DE', 'Dementia ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (9, 'D', 'Diarrhoea ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (10, 'ENC', 'HIV Encephalopathy ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (11, 'FAT', 'Fat changes ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (12, 'F', 'Fatigue ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (13, 'FEVER', 'Fewer ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (14, 'GUD', 'Genital Ulcer Disease ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (15, 'H', 'Headache ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (16, 'IRIS', 'Immune Reconstitution Inflammatory ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (17, 'S', 'Syndrome ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (18, 'J', 'Jaundice ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (19, 'KS', 'Kaposi?s Sarcoma ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (20, 'M', 'Molluscum ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (21, 'N', 'Nausea ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (22, 'OC', 'Osephageal Candidiasis ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (23, 'PE', 'Parotid Enlargement ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (24, 'PID', 'Pelvic Inflammatory Disease ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (25, 'P', 'Pneumonia ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (26, 'PCP', 'PneumoCystis Pheumonia ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (27, 'PPE', 'Papular Pruritic Eruptions ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (28, 'R', 'Rash ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (29, 'THRUSH', 'Thrush oral/vaginal ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (30, 'UD', 'Urethral Discharge ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (31, 'ULCERS', 'Ulcers mouth or other ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (32, 'W', 'Weight loss ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (33, 'Z', 'Zoster ', 0);
INSERT INTO `care_tz_arv_illness_code` VALUES (34, 'OTHER', ' if other, specify', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_lab`
-- 

DROP TABLE IF EXISTS `care_tz_arv_lab`;
CREATE TABLE `care_tz_arv_lab` (
  `care_tz_arv_lab_id` bigint(20) NOT NULL auto_increment,
  `nr` bigint(20) NOT NULL,
  `care_tz_arv_visit_2_id` bigint(20) default NULL,
  `value` varchar(6) collate latin1_general_ci default NULL,
  `date_analyse` int(10) unsigned default NULL,
  PRIMARY KEY  (`care_tz_arv_lab_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=241 ;


-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_lab_param`
-- 

DROP TABLE IF EXISTS `care_tz_arv_lab_param`;
CREATE TABLE `care_tz_arv_lab_param` (
  `care_tz_arv_lab_param_id` bigint(20) NOT NULL auto_increment,
  `lab_param` int(10) unsigned default NULL,
  `unit` varchar(20) collate latin1_general_ci default NULL,
  `param_upper` int(10) unsigned default NULL,
  `param_lower` int(10) unsigned default NULL,
  PRIMARY KEY  (`care_tz_arv_lab_param_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_lab_param`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_referred`
-- 

DROP TABLE IF EXISTS `care_tz_arv_referred`;
CREATE TABLE `care_tz_arv_referred` (
  `care_tz_arv_referred_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_referred_code_id` bigint(20) default NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_referred_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_referred_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_referred_code`;
CREATE TABLE `care_tz_arv_referred_code` (
  `care_tz_arv_referred_code_id` bigint(20) NOT NULL auto_increment,
  `code` tinyint(3) unsigned default NULL,
  `description` varchar(60) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_referred_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_referred_code`
-- 

INSERT INTO `care_tz_arv_referred_code` VALUES (1, 1, 'PMTCT', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (2, 2, 'HBC', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (3, 3, 'PLHA SUPPORT GROUP / CLUB', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (4, 4, 'ORPHAN AND VULNERABLE CHILDREN GROUP', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (5, 5, 'MEDICAL SPECIALITY', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (6, 6, 'NUTRITIONAL SUPPORT', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (7, 7, 'LEGAL', 0);
INSERT INTO `care_tz_arv_referred_code` VALUES (8, 8, 'OTHER (SPECIFY)', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_referred_from`
-- 

DROP TABLE IF EXISTS `care_tz_arv_referred_from`;
CREATE TABLE `care_tz_arv_referred_from` (
  `care_tz_arv_referred_from_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `other` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_referred_from_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=48 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_referred_from_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_referred_from_code`;
CREATE TABLE `care_tz_arv_referred_from_code` (
  `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL auto_increment,
  `description` varchar(30) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_referred_from_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_referred_from_code`
-- 

INSERT INTO `care_tz_arv_referred_from_code` VALUES (1, 'OPD');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (2, 'STI');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (3, 'MCH /PMTCT');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (4, 'PLHA GROUP');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (5, 'SELF REFERRAL (INCLUDES VCT)');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (6, 'OTHER (specify)');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (7, 'INPATIENT');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (8, 'TB /DOTS');
INSERT INTO `care_tz_arv_referred_from_code` VALUES (9, 'HBC');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_regimen`
-- 

DROP TABLE IF EXISTS `care_tz_arv_regimen`;
CREATE TABLE `care_tz_arv_regimen` (
  `care_tz_arv_regimen_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_regimen_code_id` bigint(20) default NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(80) collate latin1_general_ci default NULL,
  `regimen_days` int(3) unsigned default NULL,
  PRIMARY KEY  (`care_tz_arv_regimen_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=58 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_regimen_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_regimen_code`;
CREATE TABLE `care_tz_arv_regimen_code` (
  `care_tz_arv_regimen_code_id` bigint(20) NOT NULL auto_increment,
  `code` varchar(10) collate latin1_general_ci default NULL,
  `description` varchar(60) collate latin1_general_ci default NULL,
  `parent` int(10) unsigned default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_regimen_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_regimen_code`
-- 

INSERT INTO `care_tz_arv_regimen_code` VALUES (1, '0', '1ST LINE', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (2, '1a', 'd4T, 3TC, NVP (paediatric patients)', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (3, '1a (30)', 'd4T (30), 3TC, NVP', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (4, '1a (30) S', 'd4T (30), 3TC, NVP starting dose', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (5, '1a (40)', 'd4T (40), 3TC, NVP ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (6, '1a (40) S', 'd4T (40), 3TC, NVP starting dose', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (7, '1b', 'ZDV, 3TC, NVP ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (8, '1c', 'ZDV, 3TC, EFV ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (9, '1d (30)', 'd4T (30), 3TC, EFV ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (10, '1d (40)', 'd4T (40), 3TC, EFV ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (11, '0', '2ND LINE', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (12, '2a', 'ABC, ddl, LPV/r ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (13, '2b', 'ABC, ddl, SQV/r ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (14, '2c', 'ABC, ddl, NFV ', NULL, 0);
INSERT INTO `care_tz_arv_regimen_code` VALUES (15, '99', 'OTHER (SPECIFY) ', NULL, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_registration`
-- 

DROP TABLE IF EXISTS `care_tz_arv_registration`;
CREATE TABLE `care_tz_arv_registration` (
  `care_tz_arv_registration_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_lab_id` bigint(20) default NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned default NULL,
  `care_tz_arv_exposure_id` int(10) unsigned default NULL,
  `pid` int(11) unsigned NOT NULL,
  `ctc_id` varchar(10) collate latin1_general_ci NOT NULL,
  `ten_cell_leader` varchar(60) collate latin1_general_ci default NULL,
  `head_of_household` varchar(60) collate latin1_general_ci default NULL,
  `date_first_hiv_test` datetime default NULL,
  `date_confirmed_hiv` datetime default NULL,
  `date_eligible` datetime default NULL,
  `date_enrolled` datetime default NULL,
  `date_ready` datetime default NULL,
  `date_start_art` datetime default NULL,
  `status_clinical_stage` int(10) unsigned default NULL,
  `status_weight` double default NULL,
  `create_id` varchar(35) collate latin1_general_ci default NULL,
  `create_time` bigint(35) default NULL,
  `modify_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_time` timestamp NULL default NULL,
  `history` text collate latin1_general_ci,
  PRIMARY KEY  (`care_tz_arv_registration_id`),
  UNIQUE KEY `pid` (`pid`),
  UNIQUE KEY `ctc_id` (`ctc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=82 ;



-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_status`
-- 

DROP TABLE IF EXISTS `care_tz_arv_status`;
CREATE TABLE `care_tz_arv_status` (
  `care_tz_arv_status_id` bigint(20) NOT NULL auto_increment,
  `code` tinyint(1) NOT NULL,
  `description` varchar(10) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_status`
-- 

INSERT INTO `care_tz_arv_status` VALUES (1, 1, 'NO ARV', 0);
INSERT INTO `care_tz_arv_status` VALUES (2, 1, 'NO ARV', 0);
INSERT INTO `care_tz_arv_status` VALUES (3, 2, 'START ARV', 0);
INSERT INTO `care_tz_arv_status` VALUES (4, 3, 'CONTINUE', 0);
INSERT INTO `care_tz_arv_status` VALUES (5, 4, 'CHANGE', 0);
INSERT INTO `care_tz_arv_status` VALUES (6, 5, 'STOP', 0);
INSERT INTO `care_tz_arv_status` VALUES (7, 6, 'RESTART', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_status_txt`
-- 

DROP TABLE IF EXISTS `care_tz_arv_status_txt`;
CREATE TABLE `care_tz_arv_status_txt` (
  `care_tz_arv_status_txt_id` bigint(20) unsigned NOT NULL auto_increment,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `care_tz_arv_status_txt_code_id` bigint(50) NOT NULL,
  `other` varchar(60) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_status_txt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=41 ;


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_status_txt_code`
-- 

DROP TABLE IF EXISTS `care_tz_arv_status_txt_code`;
CREATE TABLE `care_tz_arv_status_txt_code` (
  `care_tz_arv_status_txt_code_id` bigint(50) NOT NULL auto_increment,
  `code` tinyint(3) unsigned NOT NULL,
  `description` varchar(50) collate latin1_general_ci NOT NULL,
  `parent` int(4) NOT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_status_txt_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=42 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_status_txt_code`
-- 

INSERT INTO `care_tz_arv_status_txt_code` VALUES (1, 0, 'NO START', 0, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (2, 51, 'DOE5 NOT FULFILL CRITERIA ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (3, 52, 'FULFILLS CRITERIA BUT COUNSELING FOR ARVS ONGOING ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (4, 53, 'FULFILLS CRITERIA BUT NO ARVS AVAILBLE ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (5, 54, 'FULFILLS CRITERIA BUT IS NOT WILLING ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (6, 55, 'FULFILLS CRITERIA BUT IS ON TB RX ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (7, 57, 'FULFILLS CRITERIA BUT AWAITS LAB RESULTS ', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (8, 58, 'FULFILLS CRITERIA BUT HAS OI AND IS TOO SICK TO ST', 1, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (9, 99, 'FULFILLS CRITERIA BUT NO START - OTHER ', 1, 1);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (10, 0, 'CHANGE OR STOP ARVS BECAUSE OF TB OR ADVERSE REACT', 0, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (11, 110, 'START TB TREATMENT ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (12, 111, 'NAUSEA/VOMITING ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (13, 112, 'DIARRHEA ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (14, 113, 'HEADACHE ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (15, 114, 'FEVER ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (16, 115, 'RASH ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (17, 116, 'PERIPHERAL NEUROPATHY ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (18, 117, 'HEPATITIS ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (19, 118, 'JAUNDICE ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (20, 119, 'DEMENTIA ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (21, 120, 'ANAEMIA ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (22, 121, 'PANCREATITIS ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (23, 122, 'CNS ADVERSE EVENT ', 10, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (24, 123, 'OTHER ADVERSE EVENT (SPECIFY) ', 10, 1);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (25, 0, 'CHANCE OR STOP ARVS BECAUSE OF TREATMENT FAILURE ', 0, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (26, 131, 'TREATMENT FAILURE, CLINICAL ', 25, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (27, 132, 'TREATMENT FAILURE, IMMUNOLOGICAL ', 25, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (28, 0, 'CHANGE OR STOP ARVS, OTHER REASON ', 0, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (29, 141, 'POOR ADHERENCE ', 28, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (30, 142, 'PATIENT DECISION ', 28, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (31, 143, 'PREGNANCY ', 28, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (32, 144, 'END OF PMTCT ', 28, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (33, 148, 'STOCK OUT ', 28, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (34, 149, 'OTHER REASON (SPECIFY) ', 28, 1);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (35, 0, 'RESTART', 0, 0);
INSERT INTO `care_tz_arv_status_txt_code` VALUES (36, 151, 'RESTART ARV AFTER 3 OR MORE MONTHS NOT ON ARV ', 35, 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_tb_status`
-- 

DROP TABLE IF EXISTS `care_tz_arv_tb_status`;
CREATE TABLE `care_tz_arv_tb_status` (
  `care_tz_arv_tb_status_id` bigint(20) NOT NULL auto_increment,
  `code` varchar(10) collate latin1_general_ci default NULL,
  `description` varchar(70) collate latin1_general_ci default NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY  (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- 
-- Daten f�r Tabelle `care_tz_arv_tb_status`
-- 

INSERT INTO `care_tz_arv_tb_status` VALUES (1, 'NO', 'not suspected / no signs or symptoms', 0);
INSERT INTO `care_tz_arv_tb_status` VALUES (2, 'REFER', 'TB suspected and referred for avaluation', 0);
INSERT INTO `care_tz_arv_tb_status` VALUES (3, 'SP', 'TB suspected and spulums sample sent or results recorded', 0);
INSERT INTO `care_tz_arv_tb_status` VALUES (4, 'CONFIRM', 'TB confirmed', 0);
INSERT INTO `care_tz_arv_tb_status` VALUES (5, 'INH', 'currently on INH prophylaxis (IPT)', 0);
INSERT INTO `care_tz_arv_tb_status` VALUES (6, 'TB RX', 'currently on TB (record TB ID number)', 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_treatment_supporter`
-- 

DROP TABLE IF EXISTS `care_tz_arv_treatment_supporter`;
CREATE TABLE `care_tz_arv_treatment_supporter` (
  `care_tz_arv_treatment_supporter_id` int(10) unsigned NOT NULL auto_increment,
  `care_tz_arv_registration_id` bigint(20) default NULL,
  `vname` varchar(60) collate latin1_general_ci default NULL,
  `nname` varchar(60) collate latin1_general_ci default NULL,
  `street` varchar(60) collate latin1_general_ci default NULL,
  `village` varchar(60) collate latin1_general_ci default NULL,
  `telephone` varchar(10) collate latin1_general_ci default NULL,
  `organisation` varchar(30) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`care_tz_arv_treatment_supporter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `care_tz_arv_visit_2`
-- 

DROP TABLE IF EXISTS `care_tz_arv_visit_2`;
CREATE TABLE `care_tz_arv_visit_2` (
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_code_id` bigint(20) default NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned default NULL,
  `care_tz_arv_tb_status_id` bigint(20) default NULL,
  `care_tz_arv_status_id` bigint(20) default NULL,
  `encounter_nr` bigint(20) NOT NULL,
  `visit_date` datetime default NULL,
  `weight` double default NULL,
  `height` double default NULL,
  `clinical_stage` tinyint(3) unsigned default NULL,
  `pregnant` tinyint(1) default NULL,
  `date_of_delivery` date default NULL,
  `cotrim` tinyint(1) default '-1',
  `diflucan` tinyint(1) default '-1',
  `nutrition_support` tinyint(1) unsigned default NULL,
  `next_visit_date` date default NULL,
  `create_id` varchar(35) collate latin1_general_ci default NULL,
  `create_time` bigint(20) default NULL,
  `modify_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_time` timestamp NULL default CURRENT_TIMESTAMP,
  `history` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`care_tz_arv_visit_2_id`),
  KEY `care_tz_arv_visit_FKIndex1` (`care_tz_arv_functional_status_id`),
  KEY `care_tz_arv_visit_FKIndex2` (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=135 ;

DROP TABLE IF EXISTS `care_tz_arv_visit`;
CREATE TABLE `care_tz_arv_visit` (
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL auto_increment,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_code_id` bigint(20) default NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned default NULL,
  `care_tz_arv_tb_status_id` bigint(20) default NULL,
  `care_tz_arv_status_id` bigint(20) default NULL,
  `encounter_nr` bigint(20) NOT NULL,
  `visit_date` datetime default NULL,
  `weight` double default NULL,
  `height` double default NULL,
  `clinical_stage` tinyint(3) unsigned default NULL,
  `pregnant` tinyint(1) default NULL,
  `date_of_delivery` date default NULL,
  `cotrim` tinyint(1) default '-1',
  `diflucan` tinyint(1) default '-1',
  `nutrition_support` tinyint(1) unsigned default NULL,
  `next_visit_date` date default NULL,
  `create_id` varchar(35) collate latin1_general_ci default NULL,
  `create_time` bigint(20) default NULL,
  `modify_id` varchar(35) collate latin1_general_ci default NULL,
  `modify_time` timestamp NULL default CURRENT_TIMESTAMP,
  `history` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`care_tz_arv_visit_2_id`),
  KEY `care_tz_arv_visit_FKIndex1` (`care_tz_arv_functional_status_id`),
  KEY `care_tz_arv_visit_FKIndex2` (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=135 ;

