/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_location` */

DROP TABLE IF EXISTS `care_tz_location`;

CREATE TABLE `care_tz_location` (
  `id` int(11) NOT NULL auto_increment,
  `Name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_location` */

insert into `care_tz_location` values 
(1,'Hospitalini'),
(6,'main location'),
(5,'ware house'),
(7,'mybig house'),
(8,'sura Building'),
(9,'container'),
(10,'sura'),
(11,'idd'),
(12,'makongo');
