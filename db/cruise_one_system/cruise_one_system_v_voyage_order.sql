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
-- Table structure for table `v_voyage_order`
--

DROP TABLE IF EXISTS `v_voyage_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_voyage_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cruise_code` varchar(32) DEFAULT NULL COMMENT '邮轮code',
  `voyage_code` varchar(32) DEFAULT NULL COMMENT '航线code',
  `passport_num` varchar(32) DEFAULT NULL COMMENT '护照',
  `order_serial_number` varchar(64) DEFAULT NULL COMMENT '订单号',
  `order_type` tinyint(4) DEFAULT '1' COMMENT '订单类型(1系统，2代理商)',
  `travel_agent_code` varchar(32) DEFAULT NULL COMMENT '代理商code',
  `create_order_time` datetime DEFAULT NULL COMMENT '订单生成时间',
  `total_pay_price` double DEFAULT '0' COMMENT '最后的支付价格(船票价格+税价格+港口费+附加费)',
  `total_ticket_price` double DEFAULT '0' COMMENT '船票价格',
  `total_tax_pric` double DEFAULT '0' COMMENT '税价格',
  `total_port_expenses` double DEFAULT '0' COMMENT '港口费 ',
  `total_additional_price` double DEFAULT '0' COMMENT '附加费',
  `pay_type` tinyint(4) DEFAULT NULL COMMENT '支付类型(1在线网银支付，2在线余额支付)',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  `pay_status` tinyint(4) DEFAULT '0' COMMENT '支付状态(0未支付，1已支付)',
  `order_status` tinyint(4) DEFAULT '0' COMMENT '订单状态 0正常，1取消',
  `source_code` varchar(32) DEFAULT NULL COMMENT '来源code',
  `source_type` tinyint(4) DEFAULT '0' COMMENT '来源类型(0 user，1 agent )',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_voyage_order`
--

LOCK TABLES `v_voyage_order` WRITE;
/*!40000 ALTER TABLE `v_voyage_order` DISABLE KEYS */;
INSERT INTO `v_voyage_order` VALUES (1,'002','1','ABC123456','Abc12345',1,'ABC1','2016-05-12 16:59:05',2000,1000,500,200,300,NULL,NULL,1,0,NULL,0),(2,'002','1','12','ABC222',1,'ABC1','2016-05-12 16:48:53',0,0,0,0,0,NULL,NULL,0,0,NULL,0),(4,'002','1','123','AVC1',1,'AA1','2016-05-04 16:48:56',0,0,0,0,0,NULL,NULL,0,0,NULL,0);
/*!40000 ALTER TABLE `v_voyage_order` ENABLE KEYS */;
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
