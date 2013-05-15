/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_stock_suppliers` */

DROP TABLE IF EXISTS `care_tz_stock_suppliers`;

CREATE TABLE `care_tz_stock_suppliers` (
  `ID` bigint(20) NOT NULL auto_increment,
  `Name` varchar(50) collate latin1_general_ci NOT NULL,
  `Comment` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_stock_suppliers` */

insert into `care_tz_stock_suppliers` values 
(1,'MEMS','Standard supplier'),
(2,'MSD','Government supllier');
