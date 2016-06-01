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
-- Table structure for table `v_employee`
--

DROP TABLE IF EXISTS `v_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_employee` (
  `employee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(32) DEFAULT '0' COMMENT '员工编号',
  `employee_card_number` varchar(32) DEFAULT '0' COMMENT '员工卡号',
  `employee_status` tinyint(4) DEFAULT '0' COMMENT '船员状态：0 等待上船，1 已上船，2休假中',
  `full_name` varchar(100) DEFAULT NULL COMMENT '全名',
  `first_name` varchar(100) DEFAULT NULL COMMENT '名',
  `last_name` varchar(100) DEFAULT NULL COMMENT '姓',
  `country_code` varchar(16) DEFAULT NULL COMMENT '国籍代号',
  `nation_code` varchar(2) DEFAULT NULL COMMENT '民族',
  `political_status` tinyint(4) DEFAULT '0' COMMENT '政治面貌：0群众，1团员，2党员，3民主党派',
  `gender` enum('2','M','1') DEFAULT '1' COMMENT '性别:1男,2女',
  `date_of_birth` datetime DEFAULT NULL COMMENT '出生日期',
  `birth_place` varchar(250) DEFAULT NULL COMMENT '出生地',
  `card_type` tinyint(4) DEFAULT '0' COMMENT '证件类型:0护照，1身份证，2其他证件',
  `resident_id_card` varchar(32) DEFAULT NULL COMMENT '居民身份证',
  `passport_number` varchar(20) DEFAULT NULL COMMENT '护照号',
  `other_card_number` varchar(32) DEFAULT NULL COMMENT '其他证件',
  `marry_status` tinyint(4) DEFAULT '0' COMMENT '婚姻状况：0未婚，1已婚，2离异，3丧偶',
  `health_status` tinyint(4) DEFAULT '0' COMMENT '健康状况：0健康，1一般，2较差',
  `height` varchar(5) DEFAULT NULL COMMENT '身高：（CM）',
  `weight` varchar(5) DEFAULT NULL COMMENT '体重：（KG）',
  `shoe_size` varchar(5) DEFAULT NULL COMMENT '鞋码 ',
  `blood_type` tinyint(4) DEFAULT '0' COMMENT '血型：0 A型，1 B型，2 AB型， 3 O型',
  `working_life` varchar(5) DEFAULT NULL COMMENT '工作年限:(年)',
  `major` varchar(50) DEFAULT NULL COMMENT '所学专业',
  `education` tinyint(4) DEFAULT '0' COMMENT '学历：0 高中以下，1中专，2大专，3本科，4硕士，5博士',
  `foreign_language` varchar(50) DEFAULT NULL COMMENT '外语等级',
  `mailing_address` varchar(250) DEFAULT NULL COMMENT '通信地址',
  `dormitory_num` varchar(50) DEFAULT NULL COMMENT '宿舍号',
  `telephone_num` varchar(20) DEFAULT NULL COMMENT '办公电话',
  `mobile_num` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `emergency_contact` varchar(100) DEFAULT NULL COMMENT '紧急联系人',
  `emergency_contact_phone` varchar(20) DEFAULT NULL COMMENT '紧急联系人手机号码',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='员工基本信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_employee`
--

LOCK TABLES `v_employee` WRITE;
/*!40000 ALTER TABLE `v_employee` DISABLE KEYS */;
INSERT INTO `v_employee` VALUES (14,'131696750281464013615','wr',0,'ewrw','234','23','ca',NULL,0,'1','2016-05-19 22:26:40','12',0,'12',NULL,'32',0,0,'12','23','23',0,'123','12',0,'12','12','12','123','13169675028','12','12');
/*!40000 ALTER TABLE `v_employee` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:57:56
