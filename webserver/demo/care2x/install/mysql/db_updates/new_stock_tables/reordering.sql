/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_drugs_reordering_level` */

DROP TABLE IF EXISTS `care_tz_drugs_reordering_level`;

CREATE TABLE `care_tz_drugs_reordering_level` (
  `item_id` int(11) NOT NULL,
  `reordering_level` int(11) default NULL,
  PRIMARY KEY  (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_drugs_reordering_level` */

insert into `care_tz_drugs_reordering_level` values 
(71,6900),
(400,36000),
(106,4000),
(107,56999),
(178,2540),
(211,5000),
(282,65000),
(114,154000),
(404,89700),
(76,789000),
(397,603),
(104,3000),
(209,60000),
(210,5600),
(212,1000),
(103,5465),
(398,21),
(73,500);
