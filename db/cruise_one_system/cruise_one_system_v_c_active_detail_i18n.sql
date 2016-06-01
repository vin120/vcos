CREATE DATABASE  IF NOT EXISTS `cruise_one_system` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cruise_one_system`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: bisheng.8800.org    Database: cruise_one_system
-- ------------------------------------------------------
-- Server version	5.5.17-log

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
-- Table structure for table `v_c_active_detail_i18n`
--

DROP TABLE IF EXISTS `v_c_active_detail_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_active_detail_i18n` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active_detail_id` int(11) DEFAULT NULL,
  `detail_title` varchar(255) DEFAULT NULL,
  `detail_desc` varchar(255) DEFAULT NULL,
  `i18n` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_active_detail_i18n`
--

LOCK TABLES `v_c_active_detail_i18n` WRITE;
/*!40000 ALTER TABLE `v_c_active_detail_i18n` DISABLE KEYS */;
INSERT INTO `v_c_active_detail_i18n` VALUES (1,1,'12','<p>this is a test of the desc ,and you can delete it if you want .1234</p>','en'),(2,2,'1234567','asdfg','en'),(62,0,'aaaa','','en'),(64,0,'aaaa','aaaaaa','en'),(66,0,'cccccc','','en'),(68,0,'dddd','dddddd','en'),(70,0,'abcacbacb','acacac','en'),(72,0,'12345678','123456789','en'),(74,0,'12345','213456','en'),(76,0,'1234','123','en'),(78,0,'2134','2345','en'),(80,0,'123456','123468','en'),(94,74,'1234','123','en'),(96,76,'1234','1234','en'),(98,78,'12345','ytr','en'),(100,80,'123','bbb','en'),(102,82,'123','1234','en'),(104,84,'12','5432','en'),(108,88,'12345','654321','en'),(110,90,'3322','2233','en'),(112,92,'aa','aa','en'),(114,94,'1234','<p>654321.。。。。<br/></p>','en'),(116,96,'abc','','en'),(118,98,'1234','','en'),(120,100,'1234','','en'),(122,102,'1234','','en'),(124,104,'12345','<p>12345<br/></p>','en'),(126,106,'12345','','en'),(128,108,'1234','','en'),(130,110,'12','<p>123<br/></p>','en');
/*!40000 ALTER TABLE `v_c_active_detail_i18n` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:57:55
