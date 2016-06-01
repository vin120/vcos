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
-- Table structure for table `v_cruise_i18n`
--

DROP TABLE IF EXISTS `v_cruise_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_cruise_i18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_code` varchar(255) DEFAULT NULL,
  `cruise_name` varchar(255) DEFAULT NULL,
  `cruise_desc` varchar(255) DEFAULT NULL,
  `cruise_img` varchar(255) DEFAULT NULL,
  `i18n` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_cruise_i18n`
--

LOCK TABLES `v_cruise_i18n` WRITE;
/*!40000 ALTER TABLE `v_cruise_i18n` DISABLE KEYS */;
INSERT INTO `v_cruise_i18n` VALUES (20,'002','Royal Caribbean International','<p>12<br/></p>','201605/201605061551485583.jpg','en'),(26,'aa','ss','<p>bbbbbgggg<br/></p>','201605/201605061713009001.jpg','en'),(28,'ab','aa','s','201605/201605061717477811.jpg','en'),(30,'bb','bb','<p>ssdd</p>','201605/201605061720365611.jpg','en'),(32,'gg','bb','aa','201605/201605091134549241.jpg','en'),(34,'jj','jj','aa','201605/201605091135192871.jpg','en'),(36,'bh','aa','aa','201605/201605100953273846.jpg','en'),(38,'ff','ff','ee','201605/201605100953464501.jpg','en'),(40,'123','123','<p>123<br/></p>','201605/201605101651436652.jpg','en');
/*!40000 ALTER TABLE `v_cruise_i18n` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:15
