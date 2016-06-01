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
-- Table structure for table `v_membership`
--

DROP TABLE IF EXISTS `v_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_membership` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员id',
  `smart_card_number` varchar(50) DEFAULT '0' COMMENT '智能卡号',
  `m_code` varchar(32) DEFAULT NULL COMMENT '会员号',
  `m_name` varchar(50) DEFAULT NULL COMMENT '会员名',
  `email` varchar(100) DEFAULT NULL COMMENT '会员邮箱',
  `mobile_number` varchar(20) DEFAULT NULL COMMENT '手机',
  `fixed_telephone` varchar(20) DEFAULT NULL COMMENT '固定电话',
  `m_password` varchar(100) DEFAULT '888888' COMMENT '密码',
  `balance` double DEFAULT '0' COMMENT '会员金额',
  `max_overdraft_limit` double DEFAULT '0' COMMENT '透支额度，分为单位',
  `curr_overdraft_limit` double DEFAULT '0' COMMENT '透支额度，分为单位',
  `points` int(11) DEFAULT '0' COMMENT '会员积分',
  `vip_grade` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级，默认0',
  `full_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL COMMENT '姓',
  `first_name` varchar(100) DEFAULT NULL COMMENT '名',
  `gender` enum('M','F') DEFAULT 'M' COMMENT '性别：M男，F女',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `birth_place` varchar(250) DEFAULT NULL COMMENT '出生地',
  `country_code` varchar(16) DEFAULT NULL COMMENT '国籍编号',
  `passport_number` varchar(20) DEFAULT NULL COMMENT '护照号',
  `resident_id_card` varchar(32) DEFAULT NULL COMMENT '居民身份证',
  `nation_code` varchar(2) DEFAULT NULL COMMENT '民族',
  `member_verification` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员激活，0默认未激活，1激活,2冻结',
  `email_verification` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证，默认0未验证，1验证',
  `mobile_verification` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '手机验证0未验证，1验证',
  `create_by` varchar(32) DEFAULT NULL COMMENT '创建人',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `remark` varchar(128) DEFAULT NULL,
  `sign` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_membership`
--

LOCK TABLES `v_membership` WRITE;
/*!40000 ALTER TABLE `v_membership` DISABLE KEYS */;
INSERT INTO `v_membership` VALUES (1,'0','2','cc','123@qq.com','12345678901','02012345678','888888',250.33,0,0,0,0,'罗伟栓','罗','伟栓','M','2003-06-16','广东','01','ABC123456','440101020394959022','01',0,0,0,'admin','2016-04-16 16:47:59',NULL,NULL),(2,'12','4','121','1123@qq.com','fewfewf','18688191521','222',12,0,0,12,2,NULL,'12','12','F','2016-04-06','12','LB','12','12',NULL,0,0,0,NULL,'2016-04-07 21:13:03',NULL,NULL),(8,'234','234','234','123312@qq.com','13112212211','18688191521','121232131',234,0,0,234,2,NULL,'234','234','F','2016-05-12','123','AC','123','234',NULL,0,0,0,NULL,'2016-05-24 14:44:37',NULL,NULL),(10,'123','12','121','12e12w@qq.com','13112212211','18688191521','121321312',213,0,0,123,2,NULL,'12','12','M','2016-05-12','super_admin123','LB','123123','123',NULL,0,0,0,NULL,'2016-05-10 15:27:09',NULL,NULL),(12,'234','121231231231213','234','12e111w@qq.com','13112212211','18688191521','12321313',123,0,0,12312,1,NULL,'123','123','F','2016-05-12','123','LB','123123123','234',NULL,0,0,0,NULL,'2016-05-24 15:51:07',NULL,NULL);
/*!40000 ALTER TABLE `v_membership` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-16 10:58:05
