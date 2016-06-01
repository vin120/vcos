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
-- Table structure for table `v_m_passport`
--

DROP TABLE IF EXISTS `v_m_passport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_m_passport` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'passport id',
  `passport_number` varchar(20) DEFAULT NULL COMMENT '护照号',
  `type` varchar(20) DEFAULT 'P' COMMENT '护照类型',
  `date_issue` date DEFAULT NULL COMMENT '护照发行日期',
  `date_expire` date DEFAULT NULL COMMENT '护照结束日期',
  `place_issue` varchar(100) DEFAULT NULL COMMENT '签发地',
  `Authority` varchar(100) DEFAULT NULL COMMENT '签发机关',
  `full_name` varchar(100) DEFAULT NULL COMMENT '姓名',
  `last_name` varchar(100) DEFAULT NULL COMMENT '姓',
  `first_name` varchar(100) DEFAULT NULL COMMENT '名',
  `gender` enum('M','F') DEFAULT 'M' COMMENT '性别：M男，F女',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `birth_place` varchar(250) DEFAULT NULL COMMENT '出生地',
  `country_code` varchar(16) DEFAULT NULL COMMENT '国籍编号',
  `MRZ1` varchar(50) DEFAULT NULL COMMENT '识别码1',
  `MRZ2` varchar(50) DEFAULT NULL COMMENT '识别码2',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_m_passport`
--

LOCK TABLES `v_m_passport` WRITE;
/*!40000 ALTER TABLE `v_m_passport` DISABLE KEYS */;
INSERT INTO `v_m_passport` VALUES (2,'12','P','2016-04-20','2016-04-26','121',NULL,NULL,NULL,NULL,'M',NULL,NULL,'LB',NULL,NULL),(8,'123','P','2016-05-18','2016-05-17','123',NULL,NULL,NULL,NULL,'M',NULL,NULL,'LB',NULL,NULL),(10,'123123','P','2016-05-25','2016-05-24','112',NULL,NULL,NULL,NULL,'M',NULL,NULL,'AC',NULL,NULL),(12,'123123123','P','2016-05-18','2016-05-24','123',NULL,NULL,NULL,NULL,'M',NULL,NULL,'AC',NULL,NULL);
/*!40000 ALTER TABLE `v_m_passport` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:09
