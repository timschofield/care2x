/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_stock_supplier_lists` */

DROP TABLE IF EXISTS `care_tz_stock_supplier_lists`;

CREATE TABLE `care_tz_stock_supplier_lists` (
  `ID` bigint(20) NOT NULL auto_increment,
  `Supplier_id` bigint(20) NOT NULL,
  `Supplier_item_id1` varchar(30) collate latin1_general_ci NOT NULL,
  `Supplier_item_id2` varchar(30) collate latin1_general_ci NOT NULL,
  `Supplier_item_name` varchar(100) collate latin1_general_ci NOT NULL,
  `Supplier_item_description` varchar(255) collate latin1_general_ci NOT NULL,
  `Supplier_item_packsize` varchar(30) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_stock_supplier_lists` */

insert into `care_tz_stock_supplier_lists` values 
(1,1,'AD001','10011001','Acetylsalicylic Acid (Aspirin) Tablet 300mg','','1000'),
(2,1,'AD002','','Acyclovir Tablet 200mg','','200'),
(3,1,'AD013','10101050','Amoxicillin 125mg/5ml Suspension, 100 ml Bottle','','5'),
(4,2,'10011007','','Amoxicillin Capsule 250mg','','1'),
(5,2,'10141004','AD018','Ampicillin Dry Powder for Injection 500mg , Vial','','1'),
(6,2,'10152001','AD024','Anti-Rabies Vaccine Injection, Vial','','25');
