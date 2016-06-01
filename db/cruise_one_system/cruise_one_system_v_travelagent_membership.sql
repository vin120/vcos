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
-- Table structure for table `v_travelagent_membership`
--

DROP TABLE IF EXISTS `v_travelagent_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_travelagent_membership` (
  `m_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL COMMENT '全名',
  `last_name` varchar(100) DEFAULT NULL COMMENT '姓',
  `first_name` varchar(100) DEFAULT NULL COMMENT '名',
  `gender` enum('M','F') DEFAULT 'M' COMMENT '性别：M男，F女',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `birth_place` varchar(250) DEFAULT NULL COMMENT '出生地',
  `country_code` varchar(16) DEFAULT NULL COMMENT '国籍编号',
  `passport_num` varchar(32) DEFAULT NULL COMMENT '护照号',
  `date_issue` date DEFAULT NULL COMMENT '护照发行日期',
  `date_expire` date DEFAULT NULL COMMENT '护照过期时间',
  `email` varchar(100) DEFAULT NULL COMMENT '会员邮箱',
  `phone` varchar(25) DEFAULT NULL COMMENT '手机',
  `create_by` varchar(32) DEFAULT NULL COMMENT 'agent_code',
  `create_time` datetime DEFAULT NULL COMMENT '生成时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='代理商会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_travelagent_membership`
--

LOCK TABLES `v_travelagent_membership` WRITE;
/*!40000 ALTER TABLE `v_travelagent_membership` DISABLE KEYS */;
INSERT INTO `v_travelagent_membership` VALUES (2,'aa',NULL,NULL,'M',NULL,NULL,NULL,'ST001',NULL,NULL,NULL,NULL,NULL,NULL),(6,'aa','aa','aaa','M','2015-10-14','aa','LB','aa','2016-05-11','2016-05-23','aa','aa','author','2016-05-13 07:38:45');
/*!40000 ALTER TABLE `v_travelagent_membership` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:17
