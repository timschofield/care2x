
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;




CREATE TABLE IF NOT EXISTS `care_encounter_services` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `description` varchar(100) NOT NULL,
  `srvc_item_nr` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL default '',
  `dosage` varchar(255) NOT NULL default '',
  `times_per_day` smallint(10) NOT NULL default '0',
  `days` smallint(10) NOT NULL default '0',
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text NOT NULL,
  `start_date` date default NULL,
  `ordered_by` varchar(60) NOT NULL,
  `is_outpatient_srvc` tinyint(11) unsigned NOT NULL default '0',
  `is_disabled` varchar(255) default NULL,
  `stop_date` date default NULL,
  `status` varchar(25) NOT NULL default '',
  `history` text NOT NULL,
  `bill_number` bigint(20) NOT NULL default '0',
  `bill_status` varchar(10) NOT NULL default '',
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `IX_ARTICLE_ITEM_NUMBER` (`srvc_item_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
