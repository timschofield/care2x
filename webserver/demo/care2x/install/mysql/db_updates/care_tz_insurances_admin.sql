DROP TABLE IF EXISTS care_tz_insurances_admin;

CREATE TABLE `care_tz_insurances_admin` (
  `insurance_ID` smallint(5) NOT NULL auto_increment,
  `insurer` smallint(5) NOT NULL default '-1',
  `name` varchar(30) default NULL,
  `max_pay` int(10) default NULL,
  `deleted` tinyint(1) NOT NULL default '0',
  `creation` text NOT NULL,
  `id_insurer_hist` text,
  `name_hist` text,
  `max_pay_hist` text,
  `deleted_hist` text,
  `contact_person` varchar(60) default NULL,
  `contact_person_hist` text NOT NULL,
  `po_box` varchar(50) default NULL,
  `po_box_hist` text NOT NULL,
  `city` varchar(60) default NULL,
  `city_hist` text NOT NULL,
  `phone` varchar(35) default NULL,
  `phone_hist` text NOT NULL,
  `email` varchar(60) default NULL,
  `email_hist` text NOT NULL,
  PRIMARY KEY  (`insurance_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

