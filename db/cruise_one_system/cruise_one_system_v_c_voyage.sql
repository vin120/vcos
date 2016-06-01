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
-- Table structure for table `v_c_voyage`
--

DROP TABLE IF EXISTS `v_c_voyage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_voyage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `voyage_code` varchar(255) DEFAULT NULL,
  `cruise_code` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `start_book_time` datetime DEFAULT NULL,
  `stop_book_time` datetime DEFAULT NULL,
  `ticket_price` double(10,0) DEFAULT NULL,
  `ticket_taxes` int(10) DEFAULT NULL,
  `harbour_taxes` int(10) DEFAULT NULL,
  `deposit_ratio` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_voyage`
--

LOCK TABLES `v_c_voyage` WRITE;
/*!40000 ALTER TABLE `v_c_voyage` DISABLE KEYS */;
INSERT INTO `v_c_voyage` VALUES (2,'1','002','2016-08-13 16:43:38','2016-09-13 16:43:38',1,'001','201605/201605131643499898.pdf','2016-05-13 16:43:38','2016-08-13 16:43:38',1,1,1,1),(4,'2','002','2016-08-14 09:51:17','2016-09-14 09:51:17',1,'001','201605/201605140951465124.pdf','2016-05-14 09:51:17','2016-08-14 09:51:17',2,2,2,2);
/*!40000 ALTER TABLE `v_c_voyage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:57:54
