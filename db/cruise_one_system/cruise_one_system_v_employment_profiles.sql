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
-- Table structure for table `v_employment_profiles`
--

DROP TABLE IF EXISTS `v_employment_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_employment_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(32) DEFAULT '0' COMMENT '员工编号',
  `ship_id` int(10) DEFAULT NULL COMMENT '船舶',
  `department_id` int(10) DEFAULT NULL COMMENT '部门',
  `post_id` int(10) DEFAULT NULL COMMENT '职务',
  `employee_type` tinyint(4) DEFAULT '0' COMMENT '船员类型：0自有船员 1租赁船员 2外聘船员',
  `employee_source` tinyint(4) DEFAULT '0' COMMENT '员工来源：0应届生招聘 1社会招聘 2内部招聘',
  `employee_status` tinyint(4) DEFAULT '0' COMMENT '在职状态：0 实习 1试用 2转正 3离职',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '银行卡（银行名称）',
  `bank_card_number` varchar(30) DEFAULT NULL COMMENT '银行卡账号',
  `date_of_entry` datetime DEFAULT NULL COMMENT '入职时间',
  `date_of_positive` datetime DEFAULT NULL COMMENT '转正时间',
  `date_of_departure` date DEFAULT NULL COMMENT '离职时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='员工在职信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_employment_profiles`
--

LOCK TABLES `v_employment_profiles` WRITE;
/*!40000 ALTER TABLE `v_employment_profiles` DISABLE KEYS */;
INSERT INTO `v_employment_profiles` VALUES (14,'131696750281464013615',NULL,3,NULL,0,0,0,NULL,NULL,'2016-05-17 10:17:07',NULL,NULL);
/*!40000 ALTER TABLE `v_employment_profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:06
