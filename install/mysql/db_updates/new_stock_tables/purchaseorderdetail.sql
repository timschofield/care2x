/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_purchase_order_detail` */

DROP TABLE IF EXISTS `care_tz_purchase_order_detail`;

CREATE TABLE `care_tz_purchase_order_detail` (
  `no` bigint(20) NOT NULL auto_increment,
  `order_no` int(11) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit` varchar(50) collate latin1_general_ci default NULL,
  `quantity` float NOT NULL,
  `received_quantity` float default '0',
  `unit_cost` double NOT NULL,
  `total_cost` double NOT NULL,
  PRIMARY KEY  (`no`),
  KEY `item_id` (`item_id`),
  KEY `order_no` (`order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_purchase_order_detail` */

insert into `care_tz_purchase_order_detail` values 
(10,45,8,NULL,33,33,60,1980),
(8,47,5,NULL,33,33,1200,39600),
(9,46,9,NULL,100,100,900,90000),
(11,48,5,NULL,10,10,100,1000),
(7,44,12,NULL,21,21,100,2100),
(12,44,12,NULL,14,46,1000,14000),
(13,46,12,NULL,501,453,58200,29158200),
(31,44,11,NULL,12000,2248,1100,13200000),
(15,46,26,NULL,700,23,21000,14700000),
(20,46,12,NULL,45,0,12000,540000),
(22,53,12,NULL,1200,1200,5000,6000000),
(24,53,12,NULL,123000,0,1200000,147600000000),
(25,53,12,NULL,456000,0,1200000,547200000000),
(26,51,12,NULL,4500,4500,450000,2025000000),
(27,51,12,NULL,4500,0,45000,202500000),
(29,51,5,NULL,4500,0,12000,54000000),
(30,51,1,NULL,45000,0,12000,540000000),
(32,44,397,NULL,56000,5965,258700,14487200000),
(33,55,71,NULL,45300,0,230,10419000),
(34,55,282,NULL,50000,0,90,4500000),
(35,57,71,NULL,4000,0,60,240000),
(36,56,71,NULL,6744,45,90,606960);
