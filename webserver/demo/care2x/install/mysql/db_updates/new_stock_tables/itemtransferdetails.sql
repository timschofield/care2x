/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_item_transfer_detail` */

DROP TABLE IF EXISTS `care_tz_item_transfer_detail`;

CREATE TABLE `care_tz_item_transfer_detail` (
  `Transfer_id` int(11) NOT NULL,
  `st_in_h_id` int(11) NOT NULL,
  `quantity` int(11) default NULL,
  PRIMARY KEY  (`Transfer_id`,`st_in_h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_item_transfer_detail` */

insert into `care_tz_item_transfer_detail` values 
(127,1,30),
(128,1,10),
(129,11,13),
(130,1,0),
(131,1,20),
(131,13,1),
(0,1,10),
(0,13,0),
(0,12,10),
(138,1,10),
(140,1,2),
(140,13,0),
(142,1,3),
(143,18,2),
(144,1,1),
(145,1,1),
(149,1,0),
(153,1,1),
(154,1,0),
(155,16,2),
(156,1,5),
(157,20,2),
(182,1,6),
(182,23,3);
