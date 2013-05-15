/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_purchase_order` */

DROP TABLE IF EXISTS `care_tz_purchase_order`;

CREATE TABLE `care_tz_purchase_order` (
  `order_no` int(11) NOT NULL auto_increment,
  `order_date` varchar(25) collate latin1_general_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `ordered_by` varchar(35) collate latin1_general_ci NOT NULL,
  `status` varchar(50) collate latin1_general_ci default 'new',
  `remarks` varchar(75) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`order_no`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_purchase_order` */

insert into `care_tz_purchase_order` values 
(46,'07/28/08',5,'demo','attended',NULL),
(3,'03/28/08',7,'demo','new',NULL),
(44,'07/25/08',6,'demo','attended',NULL),
(6,'03/28/08',15,'demo','new',NULL),
(7,'03/28/08',0,'demo','new',NULL),
(8,'03/28/08',0,'demo','new',NULL),
(47,'07/28/08',5,'demo','attended',NULL),
(10,'03/28/08',0,'demo','new',NULL),
(48,'09/05/02',23,'demo','attended',NULL),
(14,'03/28/08',16,'demo','new',NULL),
(16,'03/28/08',7,'demo','new',NULL),
(17,'03/28/08',15,'demo','new',NULL),
(19,'03/28/08',7,'demo','new',NULL),
(20,'03/28/08',16,'demo','new',NULL),
(45,'07/28/08',5,'demo','attended',NULL),
(49,'09/08/02',23,'demo','new',NULL),
(50,'09/09/02',23,'demo','new',NULL),
(51,'09/09/02',23,'demo','received',NULL),
(52,'09/09/02',22,'demo','new',NULL),
(53,'09/09/02',23,'demo','received',NULL),
(54,'09/15/02',23,'demo','new',NULL),
(55,'09/15/02',23,'demo','received',NULL),
(56,'09/15/02',5,'demo','attended',NULL),
(57,'10/13/08',5,'demo','received',NULL);
