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
-- Table structure for table `v_c_voyage_boarding_recode`
--

DROP TABLE IF EXISTS `v_c_voyage_boarding_recode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_voyage_boarding_recode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voyage_code` varchar(32) DEFAULT NULL,
  `voyage_port_id` int(11) DEFAULT NULL,
  `passport_number` varchar(32) DEFAULT NULL,
  `boarding_time` datetime DEFAULT NULL,
  `create_by` varchar(32) DEFAULT NULL,
  `person_type` enum('3','2','1') DEFAULT '1' COMMENT '1会员，2船员，3访客',
  `gangway_type` enum('2','1') DEFAULT '1' COMMENT '1登船，2下船',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='航线登船记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_voyage_boarding_recode`
--

LOCK TABLES `v_c_voyage_boarding_recode` WRITE;
/*!40000 ALTER TABLE `v_c_voyage_boarding_recode` DISABLE KEYS */;
INSERT INTO `v_c_voyage_boarding_recode` VALUES (1,'12',21,'12','2016-05-10 18:16:01','1','1','1'),(2,'1461981295',1,'888888','2016-05-09 18:17:37',NULL,'1','1'),(4,'1461981295',1,'888888','2016-05-09 18:17:38',NULL,'1','1'),(6,'1461981295',1,'888888','2016-05-09 18:17:39',NULL,'1','1');
/*!40000 ALTER TABLE `v_c_voyage_boarding_recode` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:07
