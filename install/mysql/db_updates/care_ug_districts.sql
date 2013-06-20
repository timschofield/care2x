-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: care2xkhl
-- ------------------------------------------------------
-- Server version	5.1.41-1.dotdeb.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `care_ug_districts`
--

DROP TABLE IF EXISTS `care_ug_districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_ug_districts` (
  `district_name` varchar(25) DEFAULT NULL,
  `compass` varchar(1) NOT NULL,
  `sector` varchar(1) NOT NULL,
  `district_code` varchar(2) DEFAULT NULL,
  `country` varchar(2) NOT NULL,
  `ucc` varchar(3) NOT NULL,
  `exthasc` varchar(6) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `district` (`district_name`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `care_ug_districts`
--

LOCK TABLES `care_ug_districts` WRITE;
/*!40000 ALTER TABLE `care_ug_districts` DISABLE KEYS */;
INSERT INTO `care_ug_districts` VALUES ('Agago','N','7','AG','UG','AAG','UG-AAG',1),('Alebtong','N','7','AL','UG','AAL','UG-AAL',2),('Amolatar','N','7','AM','UG','AAM','UG-AAM',3),('Amuru','N','7','AU','UG','AAU','UG-AAU',4),('Apac','N','7','AP','UG','AAP','UG-AAP',5),('Dokolo','N','7','DO','UG','ADO','UG-ADO',6),('Gulu','N','7','GU','UG','AGU','UG-AGU',7),('Kitgum','N','7','KI','UG','AKI','UG-AKI',8),('Kole','N','7','KO','UG','AKO','UG-AKO',9),('Lamwo','N','7','LA','UG','ALA','UG-ALA',10),('Lira','N','7','LI','UG','ALI','UG-ALI',11),('Nwoya','N','7','NW','UG','ANW','UG-ANW',12),('Otuke','N','7','OT','UG','AOT','UG-AOT',13),('Oyam','N','7','OY','UG','AOY','UG-AOY',14),('Pader','N','7','PA','UG','APA','UG-APA',15),('Budaka','E','2','BU','UG','BBU','UG-BBU',16),('Bududa','E','2','BD','UG','BBD','UG-BBD',17),('Bugiri','E','2','BG','UG','BBG','UG-BBG',18),('Bukwo','E','2','BK','UG','BBK','UG-BBK',19),('Busia','E','2','BS','UG','BBS','UG-BBS',20),('Butaleja','E','2','BT','UG','BBT','UG-BBT',21),('Buyende','E','2','BY','UG','BBY','UG-BBY',22),('Iganga','E','2','IG','UG','BIG','UG-BIG',23),('Jinja','E','2','JJ','UG','BJJ','UG-BJJ',24),('Kaliro','E','2','KR','UG','BKR','UG-BKR',25),('Kamuli','E','2','KM','UG','BKM','UG-BKM',26),('Kibuku','E','2','KB','UG','BKB','UG-BKB',27),('Luuka','E','2','LU','UG','BLU','UG-BLU',28),('Manafwa','E','2','MN','UG','BMN','UG-BMN',29),('Mayuge','E','2','MY','UG','BMY','UG-BMY',30),('Mbale','E','2','MB','UG','BMB','UG-BMB',31),('Namayingo','E','2','NY','UG','BNY','UG-BNY',32),('Namutumba','E','2','NM','UG','BNM','UG-BNM',33),('Ngora','E','2','NG','UG','BNG','UG-BNG',34),('Pallisa','E','2','PA','UG','BPA','UG-BPA',35),('Sironko','E','2','SR','UG','BSR','UG-BSR',36),('Tororo','E','2','TR','UG','BTR','UG-BTR',37),('Buikwe','C','1','BK','UG','cBK','UG-cBK',38),('Central','C','1','CN','UG','CCN','UG-CCN',39),('Kawempe','C','1','KW','UG','CKW','UG-CKW',40),('Makindye','C','1','MA','UG','CMA','UG-CMA',41),('Nakawa','C','1','NW','UG','CNW','UG-CNW',42),('Rubaga','C','1','RB','UG','CRB','UG-CRB',43),('Bukomansimbi','C','3','BK','UG','GBK','UG-GBK',44),('Butambala','C','3','BT','UG','GBT','UG-GBT',45),('Buvuma','C','3','BV','UG','GBV','UG-GBV',46),('Gomba','C','3','GM','UG','GGM','UG-GGM',47),('Kalangala','C','3','KL','UG','GKL','UG-GKL',48),('Kalungu','C','3','KG','UG','GKG','UG-GKG',49),('Kayunga','C','3','KY','UG','GKY','UG-GKY',50),('Kiboga','C','3','KB','UG','GKB','UG-GKB',51),('Kyankwanzi','C','3','KZ','UG','GKZ','UG-GKZ',52),('Luwero','C','3','LW','UG','GLW','UG-GLW',53),('Lwengo','C','3','LG','UG','GLG','UG-GLG',54),('Lyantonde','C','3','LY','UG','GLY','UG-GLY',55),('Masaka','C','3','MS','UG','GMS','UG-GMS',56),('Mityana','C','3','MT','UG','GMT','UG-GMT',57),('Mpigi','C','3','MG','UG','GMG','UG-GMG',58),('Mubende','C','3','MB','UG','GMB','UG-GMB',59),('Mukono','C','3','MK','UG','GMK','UG-GMK',60),('Nakaseke','C','3','NS','UG','GNS','UG-GNS',61),('Nakasongola','C','3','NK','UG','GNK','UG-GNK',62),('Rakai','C','3','RK','UG','GRK','UG-GRK',63),('Sembabule','C','3','SB','UG','GSB','UG-GSB',64),('Wakiso','C','3','WA','UG','GWA','UG-GWA',65),('Buhweju','W','4','BH','UG','KBH','UG-KBH',66),('Bushenyi','W','4','BS','UG','KBS','UG-KBS',67),('Ibanda','W','4','IB','UG','KIB','UG-KIB',68),('Isingiro','W','4','IN','UG','KIN','UG-KIN',69),('Kabale','W','4','KB','UG','KKB','UG-KKB',70),('Kanungu','W','4','KN','UG','KKN','UG-KKN',71),('Kiruhuura','W','4','KH','UG','KKH','UG-KKH',72),('Kisoro','W','4','KS','UG','KKS','UG-KKS',73),('Mbarara','W','4','MB','UG','KMB','UG-KMB',74),('Mitoma','W','4','MT','UG','KMT','UG-KMT',75),('Ntungamo','W','4','NT','UG','KNT','UG-KNT',76),('Rubirizi','W','4','RZ','UG','KRZ','UG-KRZ',77),('Rukungiri','W','4','RK','UG','KRK','UG-KRK',78),('Sheema','W','4','SH','UG','KSH','UG-KSH',79),('Buliisa','W','5','BL','UG','RBL','UG-RBL',80),('Bundibugyo','W','5','BN','UG','RBN','UG-RBN',81),('Hoima','W','5','HM','UG','RHM','UG-RHM',82),('Kabarole','W','5','KB','UG','RKB','UG-RKB',83),('Kamwenge','W','5','KM','UG','RKM','UG-RKM',84),('Kasese','W','5','KS','UG','RKS','UG-RKS',85),('Kibaale','W','5','KI','UG','RKI','UG-RKI',86),('Kiryandongo','W','5','KR','UG','RKR','UG-RKR',87),('Kyegegwa','W','5','KW','UG','RKW','UG-RKW',88),('Kyenjojo','W','5','KY','UG','RKY','UG-RKY',89),('Masindi','W','5','MS','UG','RMS','UG-RMS',90),('Ntoroko','W','5','NT','UG','RNT','UG-RNT',91),('Abim','N','8','AB','UG','SAB','UG-SAB',92),('Amudat','N','8','AT','UG','SAT','UG-SAT',93),('Amuria','E','8','AR','UG','SAR','UG-SAR',94),('Bukedea','E','8','BK','UG','SBK','UG-SBK',95),('Bulambuli','E','8','BL','UG','SBL','UG-SBL',96),('Kaabong','N','8','KA','UG','SKA','UG-SKA',97),('Kaberamaido','E','8','KB','UG','SKB','UG-SKB',98),('Kapchorwa','E','8','KP','UG','SKP','UG-SKP',99),('Katakwi','E','8','KT','UG','SKT','UG-SKT',100),('Kotido','N','8','KO','UG','SKO','UG-SKO',101),('Kumi','E','8','KM','UG','SKM','UG-SKM',102),('Kween','E','8','KW','UG','SKW','UG-SKW',103),('Moroto','N','8','MT','UG','SMT','UG-SMT',104),('Nakapiripirit','N','8','NT','UG','SNT','UG-SNT',105),('Napak','N','8','NP','UG','SNP','UG-SNP',106),('Serere','E','8','SR','UG','SSR','UG-SSR',107),('Soroti','E','8','ST','UG','SST','UG-SST',108),('Adjumani','N','6','AJ','UG','WAJ','UG-WAJ',109),('Arua','N','6','AU','UG','WAU','UG-WAU',110),('Koboko','N','6','KB','UG','WKB','UG-WKB',111),('Moyo','N','6','MO','UG','WMO','UG-WMO',112),('Nebbi','N','6','NB','UG','WNB','UG-WNB',113),('Nyadri','N','6','NY','UG','WNY','UG-WNY',114),('Yumbe','N','6','YU','UG','WYU','UG-WYU',115),('Zombo','N','6','ZO','UG','WZO','UG-WZO',116);
/*!40000 ALTER TABLE `care_ug_districts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-20 14:51:23
