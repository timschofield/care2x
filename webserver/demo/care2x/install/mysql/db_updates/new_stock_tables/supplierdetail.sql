/*
SQLyog - Free MySQL GUI v5.01
Host - 5.0.21-community-nt : Database - caredb
*********************************************************************
Server version : 5.0.21-community-nt
*/

/*Table structure for table `care_tz_supplier_deatail` */

DROP TABLE IF EXISTS `care_tz_supplier_deatail`;

CREATE TABLE `care_tz_supplier_deatail` (
  `Suplier_id` int(11) NOT NULL auto_increment,
  `Company_Name` varchar(50) collate latin1_general_ci NOT NULL,
  `Contact_Person` varchar(50) collate latin1_general_ci NOT NULL,
  `Address1` varchar(150) collate latin1_general_ci NOT NULL,
  `Address2` varchar(150) collate latin1_general_ci default NULL,
  `Phone1` varchar(50) collate latin1_general_ci NOT NULL,
  `Phone2` varchar(50) collate latin1_general_ci default NULL,
  `Cell1` varchar(50) collate latin1_general_ci NOT NULL,
  `Cell2` varchar(50) collate latin1_general_ci default NULL,
  `Email` varchar(75) collate latin1_general_ci NOT NULL,
  `Fax` varchar(75) collate latin1_general_ci default NULL,
  `Banker` varchar(50) collate latin1_general_ci default NULL,
  `Bank_Details` varchar(100) collate latin1_general_ci default NULL,
  `Account_no` varchar(50) collate latin1_general_ci default NULL,
  `Credit_Limit` varchar(50) collate latin1_general_ci default NULL,
  `Credit_Period` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`Suplier_id`),
  KEY `Company_Name` (`Company_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `care_tz_supplier_deatail` */

insert into `care_tz_supplier_deatail` values 
(6,'UCC','','BOX 76908','','+255756354180','','88888','','iddy85@yahoo.com','677567','NBC','','030201131405','6666','8years '),
(5,'SURA TECHNOLOGY','DFSBSFB','BOX 76908','DSM','+255756354180','FDBDFB','88888','FDBFDBF','iddy85@yahoo.com','12321233','DFBFDBDF','BFDBFDB','DFBFDSBF','SDFBSFDBVF',' BSDFBSDB'),
(14,'fdgdgfd','','fdgdgfd','','fdgdgfd','fdgdgfd','fdgdgfd','fdgdgfd','fdgdgfd','fdgdgfd','fdgdgfd','','','',' '),
(17,'gfdgfd','fbvdsfbfgb','fbvdsfbfgb','','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','','','','','',' '),
(18,'gfdgfd','fbvdsfbfgb','fbvdsfbfgb','','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','fbvdsfbfgb','','','','','',' '),
(19,'telecom','Alex','dsm','Dsm','31213','1231','3169161','84551','fvfdvfdvbfd','dfvfdvdfv','','','','',' '),
(20,'telecom','Alex','dsm','Dsm','3169161','84551','31213','1231','fvfdvfdvbfd','','','','','',' '),
(21,'telecom','Alex','dsm','Dsm','3169161','84551','31213','1231','fvfdvfdvbfd','','','','','',' '),
(22,'telecom','Alex','dsm','Dsm','3169161','84551','31213','1231','fvfdvfdvbfd','bsbg','dfbvfdb','','030201131405','200000','gdfsgdfgf'),
(23,'TAZARA','JIMMY','TZ','TRA','6235','026561','+255','+255','CDSFSVD','23161','CRDB','','21321','485','2 YRS ');
