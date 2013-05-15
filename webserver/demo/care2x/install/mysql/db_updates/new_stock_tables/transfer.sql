/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_stock_transfer` */

DROP TABLE IF EXISTS `care_tz_stock_transfer`;

CREATE TABLE `care_tz_stock_transfer` (
  `ID` bigint(20) NOT NULL auto_increment,
  `Drugsandservices_id` bigint(20) NOT NULL,
  `Amount` bigint(20) NOT NULL,
  `Transfer_from` bigint(20) NOT NULL,
  `Transfer_to` bigint(20) NOT NULL,
  `Timestamp_started` bigint(20) NOT NULL,
  `Timestamp_finished` bigint(20) NOT NULL,
  `Cancel_flag` tinyint(4) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_stock_transfer` */

insert into `care_tz_stock_transfer` values 
(1,724,12,-1,1,1158963874,1159988928,0),
(2,637,10,-1,1,1159988891,1159988928,0),
(3,143,0,-1,1,1166528017,1166528030,0),
(4,143,0,-1,1,1166528017,1166528030,0),
(5,143,0,-1,1,1166528017,1166528030,0),
(6,143,0,-1,1,1166528017,1166528030,0),
(7,143,0,-1,1,1166528017,1166528030,0),
(8,143,0,-1,1,1166528017,1166528030,0),
(9,143,0,-1,1,1166528017,1166528030,0),
(10,143,0,-1,1,1166528017,1166528030,0),
(11,143,0,-1,1,1166528017,1166528030,0),
(12,143,0,-1,1,1166528017,1166528030,0),
(13,143,0,-1,1,1166528017,1166528030,0),
(14,143,0,-1,1,1166528017,1166528030,0),
(15,143,0,-1,1,1166528017,1166528030,0),
(16,143,0,-1,1,1166528017,1166528030,0),
(17,143,0,-1,1,1166528017,1166528030,0),
(18,143,0,-1,1,1166528017,1166528030,0),
(19,143,0,-1,1,1166528017,1166528030,0),
(20,143,0,-1,1,1166528017,1166528030,0),
(21,143,0,-1,1,1166528017,1166528030,0),
(22,143,0,-1,1,1166528017,1166528030,0);
