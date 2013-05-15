/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_stock_in_hand` */

DROP TABLE IF EXISTS `care_tz_stock_in_hand`;

CREATE TABLE `care_tz_stock_in_hand` (
  `st_in_h_id` int(11) NOT NULL auto_increment,
  `item_id` int(11) NOT NULL,
  `Store_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `expire_date` date default NULL,
  `current_qty` int(11) default NULL,
  PRIMARY KEY  (`st_in_h_id`,`item_id`,`Store_id`,`batch_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_stock_in_hand` */

insert into `care_tz_stock_in_hand` values 
(1,400,1,20,'2008-08-12',81),
(23,36,1,34,'2008-12-12',42),
(12,398,10,20,'2008-08-12',20),
(11,369,12,20,'2008-08-12',11),
(26,397,1,76,'2008-10-13',121),
(28,36,4,34,'2008-12-12',3),
(27,400,4,20,'2008-08-12',6),
(21,397,1,36,'2008-12-12',5372),
(25,15,1,34,'2008-10-17',23);
