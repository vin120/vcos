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
-- Table structure for table `v_c_cabin_type_graphic_i18n`
--

DROP TABLE IF EXISTS `v_c_cabin_type_graphic_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_cabin_type_graphic_i18n` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `graphic_id` int(11) DEFAULT NULL,
  `graphic_desc` varchar(255) DEFAULT NULL,
  `graphic_img` varchar(255) DEFAULT NULL,
  `i18n` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_cabin_type_graphic_i18n`
--

LOCK TABLES `v_c_cabin_type_graphic_i18n` WRITE;
/*!40000 ALTER TABLE `v_c_cabin_type_graphic_i18n` DISABLE KEYS */;
INSERT INTO `v_c_cabin_type_graphic_i18n` VALUES (2,2,'vv','201604/201604281047423272.jpg','en'),(4,4,'Within the standard cabin','201604/201604281054279986.jpg','en'),(6,6,'Balcony room','201604/201604281054405954.jpg','en'),(8,8,'vvv','201604/201604281130425062.jpg','en'),(10,10,'<p>bbbb<br/></p>','201605/201605051410071851.jpg','en'),(12,12,'213212321','201605/201605051509357420.png','en'),(14,14,'dsafdas','201605/201605051509547190.png','en'),(16,16,'12321321','201605/201605051510363674.png','en'),(18,18,'xx','201605/201605071058521099.jpg','en'),(20,20,'bb','201605/201605071059058543.jpg','en'),(22,22,'nn','201605/201605071059188755.jpg','en'),(24,24,'<p>cccc<br/></p>','201605/201605111339112197.jpg','en'),(26,26,'<p>aaaaa<br/></p>','201605/201605111419136383.jpg','en');
/*!40000 ALTER TABLE `v_c_cabin_type_graphic_i18n` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:03
