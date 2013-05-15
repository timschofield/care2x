/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_store_info` */

DROP TABLE IF EXISTS `care_tz_store_info`;

CREATE TABLE `care_tz_store_info` (
  `Store_id` int(11) NOT NULL auto_increment,
  `Store_type` varchar(50) collate latin1_general_ci default NULL,
  `Store_name` varchar(50) collate latin1_general_ci default NULL,
  `location_id` int(11) default NULL,
  PRIMARY KEY  (`Store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_store_info` */

insert into `care_tz_store_info` values 
(1,'repository','mainstore',1),
(2,'pharmacy','paharmacy 1',1),
(3,'phamacy','ali',1),
(4,'repository','juma',1),
(9,'Pharmacy','paharmacy 1',8),
(8,'Repository store','largest store',7),
(10,'Pharmacy','paharmacy 1',6),
(11,'Repository store','attendant',9),
(12,'Repository store','new store',10);
