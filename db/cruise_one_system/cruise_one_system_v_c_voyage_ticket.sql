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
-- Table structure for table `v_c_voyage_ticket`
--

DROP TABLE IF EXISTS `v_c_voyage_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_voyage_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cruise_code` varchar(32) DEFAULT NULL,
  `voyage_code` varchar(32) DEFAULT NULL,
  `travel_agent_code` varchar(32) DEFAULT NULL,
  `order_serial_number` varchar(64) DEFAULT NULL,
  `m_code` varchar(32) DEFAULT NULL,
  `voyage_cabin_id` int(11) DEFAULT NULL,
  `cabin_name` varchar(32) DEFAULT NULL,
  `cabin_bed_index` tinyint(4) DEFAULT NULL,
  `ticket_type` enum('3','2','1') DEFAULT '1' COMMENT '1普通，2儿童票，3保留值',
  `additional_change` varchar(255) DEFAULT NULL COMMENT '附加费',
  `shore_excursion` varchar(32) DEFAULT NULL COMMENT '旅游路线',
  `tour_group` varchar(32) DEFAULT NULL COMMENT '旅游团',
  `passport_status` tinyint(4) DEFAULT NULL,
  `status` enum('2','1') DEFAULT '1' COMMENT '1正常，2退票',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_voyage_ticket`
--

LOCK TABLES `v_c_voyage_ticket` WRITE;
/*!40000 ALTER TABLE `v_c_voyage_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_c_voyage_ticket` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:02
