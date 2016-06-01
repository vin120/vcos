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
-- Table structure for table `v_travel_agent`
--

DROP TABLE IF EXISTS `v_travel_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_travel_agent` (
  `travel_agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_agent_code` varchar(32) NOT NULL COMMENT '代理商编号',
  `travel_agent_name` varchar(64) NOT NULL,
  `travel_agent_address` varchar(128) DEFAULT NULL,
  `travel_agent_phone` varchar(32) NOT NULL,
  `travel_agent_post_code` varchar(32) DEFAULT NULL,
  `travel_agent_email` varchar(128) DEFAULT NULL,
  `travel_agent_fax` varchar(32) DEFAULT NULL,
  `travel_agent_bank_holder` varchar(64) DEFAULT NULL COMMENT '开户人',
  `travel_agent_account_bank` varchar(128) DEFAULT NULL,
  `travel_agent_account` varchar(32) DEFAULT NULL,
  `travel_agent_contact_name` varchar(32) DEFAULT NULL,
  `travel_agent_contact_phone` varchar(32) DEFAULT NULL,
  `travel_agent_admin` varchar(32) DEFAULT NULL,
  `travel_agent_password` varchar(32) DEFAULT NULL,
  `pay_password` varchar(32) DEFAULT NULL COMMENT '支付密码',
  `travel_agent_last_login_time` datetime DEFAULT '0000-00-00 00:00:00',
  `travel_agent_last_change_password_time` datetime DEFAULT '0000-00-00 00:00:00',
  `sort_order` int(11) DEFAULT NULL,
  `travel_agent_status` int(1) DEFAULT '0',
  `contract_start_time` datetime DEFAULT '0000-00-00 00:00:00',
  `contract_end_time` datetime DEFAULT '0000-00-00 00:00:00',
  `overdraft_amount` int(11) DEFAULT '0' COMMENT '透支最高额度  -1为无限透支',
  `current_amount` float(11,0) DEFAULT '0' COMMENT '账户余额',
  `create_by` varchar(32) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `city_code` varchar(255) DEFAULT NULL,
  `is_online_booking` tinyint(4) DEFAULT '0' COMMENT '在线预订代理商：0不是，1是(0 普通  1 内部)',
  `commission_percent` int(11) DEFAULT '0' COMMENT '佣金 : 20=20%    必须 <=50%',
  `travel_agent_level` int(11) DEFAULT NULL,
  `superior_travel_agent_code` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`travel_agent_id`),
  KEY `travel_agent_code` (`travel_agent_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='代理商';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_travel_agent`
--

LOCK TABLES `v_travel_agent` WRITE;
/*!40000 ALTER TABLE `v_travel_agent` DISABLE KEYS */;
INSERT INTO `v_travel_agent` VALUES (4,'10000037','Shandong in the new international travel agency co., LTD','bbbb','13754232332',NULL,NULL,NULL,NULL,NULL,NULL,'Li si',NULL,NULL,'123456','123456','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,11,NULL,NULL,NULL,NULL,0,0,2,NULL),(6,'10000038','The bohai sea ferry international travel agency co., LTD','ccccc','13457324238','12','1287934077@qq.com','12','12','12','1234567890123456','Zhao six','13169675028','12','123456','123456','0000-00-00 00:00:00','0000-00-00 00:00:00',12,1,'2016-04-20 00:00:00','2016-04-06 00:00:00',0,0,NULL,NULL,'ca','sh',0,11,2,'6'),(10,'1070502812','12','12','12','122','1287934077@qq.com','12','12','12','12','12','13169675028','12','12','12','0000-00-00 00:00:00','0000-00-00 00:00:00',12,1,'2016-04-28 16:37:50','2016-04-29 16:37:52',0,0,NULL,NULL,'ca','sh',0,12,4,'2'),(23,'10000036','Liability co., LTD. Suzhou taihu international travel service','aaaaa','13877478433',NULL,NULL,NULL,NULL,NULL,NULL,'Zhang SAN',NULL,NULL,'123456','123456','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,122,NULL,NULL,NULL,NULL,0,0,0,NULL);
/*!40000 ALTER TABLE `v_travel_agent` ENABLE KEYS */;
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
