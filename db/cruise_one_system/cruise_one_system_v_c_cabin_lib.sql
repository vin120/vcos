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
-- Table structure for table `v_c_cabin_lib`
--

DROP TABLE IF EXISTS `v_c_cabin_lib`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_c_cabin_lib` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_code` varchar(255) DEFAULT NULL,
  `cabin_type_id` int(11) DEFAULT NULL,
  `cabin_name` varchar(255) DEFAULT NULL,
  `deck_num` int(11) DEFAULT NULL,
  `max_check_in` int(11) DEFAULT NULL,
  `last_aduits_num` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_c_cabin_lib`
--

LOCK TABLES `v_c_cabin_lib` WRITE;
/*!40000 ALTER TABLE `v_c_cabin_lib` DISABLE KEYS */;
INSERT INTO `v_c_cabin_lib` VALUES (10,'002',42,'2003',2,4,3,1),(14,'002',42,'2006',2,4,3,1),(16,'002',42,'1001',1,4,2,1),(18,'002',42,'1002',1,4,2,1),(20,'002',42,'1003',1,4,2,1),(22,'002',42,'1004',1,4,2,1),(24,'002',42,'1005',1,4,2,1),(26,'002',42,'1006',1,4,2,1),(28,'002',42,'1007',1,4,2,1),(30,'002',42,'1008',1,4,2,1),(32,'002',42,'1009',1,4,2,1),(34,'002',42,'1010',1,4,2,1),(36,'002',42,'1011',1,4,2,1),(38,'002',42,'1012',1,4,2,1),(40,'002',42,'1013',1,4,2,1),(42,'002',42,'3001',3,4,1,1),(44,'002',42,'3002',3,4,1,1),(46,'002',42,'3003',3,4,1,1),(48,'002',42,'3004',3,4,1,1),(50,'002',42,'3005',3,4,1,1),(52,'002',42,'3006',3,4,1,1),(54,'002',42,'3007',3,4,1,1),(56,'002',42,'3008',3,4,1,1),(58,'002',42,'3009',3,4,1,1),(60,'002',42,'3010',3,4,1,1),(62,'002',42,'3011',3,4,1,1),(64,'002',42,'3012',3,4,1,1),(66,'002',42,'3013',3,4,1,1),(68,'002',42,'3014',3,4,1,1),(70,'002',44,'1001',1,4,1,1),(72,'002',44,'1002',1,4,1,1),(74,'002',44,'1003',1,4,1,1),(76,'002',44,'1004',1,4,1,1),(78,'002',44,'1005',1,4,1,1),(80,'002',42,'aaaaaaaaaa',12,12,12,1),(82,'002',60,'4001',4,4,2,1),(84,'002',60,'4002',4,4,2,1),(86,'002',60,'4003',4,4,2,1),(88,'002',60,'4004',4,4,2,1),(90,'002',60,'4005',4,4,2,1),(92,'002',60,'4006',4,4,2,1),(94,'002',60,'4007',4,4,2,1),(96,'002',62,'3001',3,4,2,1),(98,'002',62,'3002',3,4,2,1),(100,'002',62,'3003',3,4,2,1),(102,'002',62,'3004',3,4,2,1),(104,'002',62,'3005',3,4,2,1),(106,'002',62,'3006',3,4,2,1);
/*!40000 ALTER TABLE `v_c_cabin_lib` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:11
