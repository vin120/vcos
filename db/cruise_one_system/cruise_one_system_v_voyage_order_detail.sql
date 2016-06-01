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
-- Table structure for table `v_voyage_order_detail`
--

DROP TABLE IF EXISTS `v_voyage_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_voyage_order_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_serial_number` varchar(64) DEFAULT NULL COMMENT '订单号',
  `voyage_code` varchar(32) DEFAULT NULL COMMENT '航线code',
  `cabin_type` varchar(32) DEFAULT NULL COMMENT 'cabin类型',
  `cabin_id` int(11) DEFAULT NULL,
  `check_in_number` tinyint(4) DEFAULT '0' COMMENT '入住人数',
  `cabin_price` double DEFAULT '0' COMMENT '房间费',
  `tax_price` double DEFAULT '0' COMMENT '税收费',
  `passport_number_one` varchar(32) DEFAULT NULL,
  `passport_number_two` varchar(32) DEFAULT NULL,
  `passport_number_three` varchar(32) DEFAULT NULL,
  `passport_number_four` varchar(32) DEFAULT NULL,
  `assign_cabin_status` tinyint(4) DEFAULT '0' COMMENT '分配客舱状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_voyage_order_detail`
--

LOCK TABLES `v_voyage_order_detail` WRITE;
/*!40000 ALTER TABLE `v_voyage_order_detail` DISABLE KEYS */;
INSERT INTO `v_voyage_order_detail` VALUES (1,'Abc12345','1','ff',NULL,1,1000,100,'2',NULL,NULL,NULL,0),(2,'ABC222','1','ggg',NULL,1,1000,100,'4',NULL,NULL,NULL,0),(4,'AVC1','1','ff',NULL,1,10000,100,'2',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `v_voyage_order_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:08
