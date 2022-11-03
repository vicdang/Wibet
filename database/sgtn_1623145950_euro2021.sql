-- MySQL dump 10.13  Distrib 5.7.34, for Linux (x86_64)
--
-- Host: localhost    Database: sgtn_18244028_euro2021
-- ------------------------------------------------------
-- Server version	5.7.34

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
-- Table structure for table `bet`
--

DROP TABLE IF EXISTS `bet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `match_id` int(11) unsigned DEFAULT '0',
  `option` tinyint(4) DEFAULT '0',
  `money` bigint(20) DEFAULT '0',
  `is_active` bit(1) DEFAULT b'1',
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_match_id` (`user_id`,`match_id`),
  KEY `user_id` (`user_id`),
  KEY `FK_bet_match` (`match_id`),
  CONSTRAINT `FK_bet_match` FOREIGN KEY (`match_id`) REFERENCES `match` (`id`),
  CONSTRAINT `FK_bet_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign`
--

LOCK TABLES `campaign` WRITE;
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) unsigned DEFAULT NULL,
  `team_1` varchar(50) DEFAULT NULL,
  `team_2` varchar(50) DEFAULT NULL,
  `team_1_score` tinyint(4) DEFAULT NULL,
  `team_2_score` tinyint(4) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `match_date` timestamp NULL DEFAULT NULL,
  `description` text,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `campaign_id` (`campaign_id`),
  CONSTRAINT `FK_match_campaign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`),
  CONSTRAINT `FK_match_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
/*!40000 ALTER TABLE `match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1401873449),('m131114_141544_add_user',1401873454);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `profile_user_id` (`user_id`),
  CONSTRAINT `profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'2014-06-04 18:17:34','2021-06-07 03:32:55','Administrator',1),(25,25,'2021-06-07 00:55:41','2021-06-07 03:51:21','mod_01',1),(27,27,'2021-06-07 03:25:06','2021-06-07 23:51:00','Tai Le',200),(28,29,'2021-06-07 03:29:53','2021-06-07 04:08:22','Hiep Thai',200),(32,33,'2021-06-07 04:07:53','2021-06-07 04:24:23','RB Automation',200),(33,34,'2021-06-07 06:38:58',NULL,'Vu Hoang',200),(34,35,'2021-06-07 07:02:19',NULL,'Phong Nguyen',200),(35,36,'2021-06-07 23:44:49','2021-06-07 23:50:58','HLV online',200),(36,37,'2021-06-08 00:01:45',NULL,'RB TLO',200),(37,38,'2021-06-08 00:08:26',NULL,'Linh Truong',200),(38,39,'2021-06-08 00:35:09',NULL,'DSC_dev_00',200),(39,40,'2021-06-08 00:35:54',NULL,'DSC_dev_01',200),(40,41,'2021-06-08 00:42:09','2021-06-08 00:57:45','May Mua Ra RIC',200),(41,42,'2021-06-08 00:44:17','2021-06-08 00:57:06','Thao Phan',200),(42,43,'2021-06-08 00:46:30','2021-06-08 00:55:24','MenloQA',200),(43,44,'2021-06-08 00:48:18','2021-06-08 00:50:15','nmcam2',200),(44,45,'2021-06-08 00:49:55',NULL,'nmcam1',200),(45,46,'2021-06-08 00:53:36','2021-06-08 00:55:03','menlo1',200),(46,47,'2021-06-08 00:54:43',NULL,'menlo2',200),(47,48,'2021-06-08 01:21:56',NULL,'DSC_dev_02',200),(48,49,'2021-06-08 01:22:42','2021-06-08 01:23:40','DSC_dev_03',200),(49,50,'2021-06-08 01:23:22',NULL,'DSC_dev_04',200),(50,51,'2021-06-08 01:24:18','2021-06-08 01:36:02','Tien Kieu',200),(51,52,'2021-06-08 01:32:39',NULL,'tlnhan',200),(52,54,'2021-06-08 02:16:26',NULL,'Nhi Tran',200);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `can_admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin','2014-06-04 18:17:34',NULL,1),(2,'User','2014-06-04 18:17:34',NULL,0),(3,'Guest','2014-06-04 18:17:34',NULL,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `new_email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `ban_time` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(255) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `login_ip` varchar(45) DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'admin@localhost.com',NULL,'admin','$2y$13$wjOTSyyprN2m5DFDn.LQN.xSbngtdXFxCbQ2kHIms0C1CVX1QP9Wu',1,'KSQVZx_QRLt7Jic-WL2uzQl6tNlHyrE9','1UneDlwyKNYl8VL2uFD2B6LqHtbXydN8','2014-06-04 18:17:34','2021-06-07 03:32:55',NULL,NULL,NULL,'1.52.111.65','2021-06-08 02:15:41'),(25,1,'vudnn.dl@gmail.com',NULL,'mod_01','$2y$13$AS2pDvQNUHfKm9jv46V2oOP4qZjPu1iZeinFPKQm7kkDgQutMn5DS',1,'pDB_J74qXCrIrSDqyEt_t44pI4lqtPyt','jUnINvwHaJD1WfbBwPkmtozbEWiDVDBI','2021-06-07 00:55:41','2021-06-08 00:06:53',NULL,NULL,NULL,'103.199.7.5','2021-06-08 00:07:13'),(27,2,'lttai@tma.com.vn',NULL,'taile_tlo','$2y$13$HN/FmRW8fkPcLzzAJSKbreCzC6aZK1CMl04OGHiwTuiHoeA0vVKJS',1,'ZqDXDTEvXY33NH3VTVDvj1I2rTbKIpmy','oT5_6FNiAHC-36AF-D8LqPwP9kxzRDVY','2021-06-07 03:25:06','2021-06-07 23:58:34',NULL,NULL,NULL,'103.199.7.5','2021-06-07 23:56:56'),(29,2,'tpvhiep@tma.com.vn',NULL,'hiepthai_dsc_01','$2y$13$apZhSbMixBs.KQEdhSRoXOfHyoI239e4BsXvDSbrT8NV/M6nlbDGu',1,'bOGgOQENzirp0wPkvi_zOnIT8BXo-uBl','Q3lFl6JuDrYjcLV7cVLmg-MRf6tOL-MB','2021-06-07 03:29:53','2021-06-07 03:57:51',NULL,NULL,NULL,'103.199.7.53','2021-06-07 04:12:01'),(33,2,'rb_automation@tma.comvn','nhtai2@tma.com.vn','rb_automation','$2y$13$g/Ha3hRWLR8qc8Ays7Ysxu66hLCw6THwOrfZgZxfKmIeOp4OCdgDO',2,'43m527mgfcRWwFbzPm0EX1Um4p5f17Dq','WNk_XZQtU8WusKFxPZRfwTx4vmWzafWH','2021-06-07 04:07:53','2021-06-07 04:28:05',NULL,NULL,NULL,'103.199.7.5','2021-06-07 04:23:58'),(34,2,'hqvu@tma.com.vn',NULL,'hqvu','$2y$13$iXaZ4bhD9K58ZnGkKvSOvu9TjNXHVvF3c1F4G7utWYWGDX7DuW/O2',1,'YxFilLDW--92mGCQ2UKwB9VBH-a_19oc','qJwsnDcFqOH_cglAa8hYgMthvBDNZCaC','2021-06-07 06:38:58',NULL,NULL,NULL,NULL,'119.82.134.132','2021-06-08 00:31:46'),(35,2,'ncqphong@tma.com.vn',NULL,'ncqphong','$2y$13$a1rjBQ/ziLSVtw6.2TBxQ.9hlKaAcZP6IQ5jMIzaeZnYx2VfvER8K',1,'a7tLsbbt49Qs9s4tt7t6qW5nrLqT4bCK','AURN3NZM7PIjtfLc4Zz1t7KLR7tTSDN-','2021-06-07 07:02:19',NULL,NULL,NULL,NULL,NULL,NULL),(36,2,'nvduong@tma.com.vn',NULL,'nvduong','$2y$13$lpyerPHD.1bm8swa9fHyUuMEmGtWUXbb4QAPMkoKaiSKlOUAaamyy',1,'dlXbyqfqt8T4fLP4caU_2UMDPphk99fN','c6UlIY79Vr6LR_1DRob56mKAY9pODb8q','2021-06-07 23:44:49','2021-06-07 23:50:08',NULL,NULL,NULL,'103.199.7.5','2021-06-08 02:14:38'),(37,2,'rb_tlo@tma.com.vn',NULL,'rb_tlo','$2y$13$57EEub033F2whoVxxM882.53Jrvgb2ckBJXcjTbse/HuN0amNiZOW',2,'PkKqMip5VWGdeqDGVpOY13EcJGhPMBic','H_Ppr6XjELRgDnnvdfT7QHJinBdzDhng','2021-06-08 00:01:45','2021-06-08 00:03:57',NULL,NULL,NULL,'103.199.7.5','2021-06-08 00:03:03'),(38,2,'thlinh@tma.com.vn',NULL,'thlinh','$2y$13$2UHE4Tkhby5MijGePlpKaeXnvrh8gfUp1MOrgTLkkeke5VFBZiQg2',1,'n2I22S01_0CPl-KyGSvjerseheksBatV','Jvt1H1q5aP_5Ggj39Hy2G_7KpRSEU-NP','2021-06-08 00:08:26',NULL,NULL,NULL,NULL,NULL,NULL),(39,2,'DSC_dev_00@tma.com.vn',NULL,'DSC_dev_00','$2y$13$V8n.YPCrp.zqcyZHjirASuycf0i4Ek7nwWl/IqVApY2ypSMyiUwJS',1,'eDF-O0IV8hntiVTWbadLPLTaWuV0NpRK','kj37AuGAacdA3-wcfvE4ge8nZuPn6H3l','2021-06-08 00:35:09',NULL,NULL,NULL,NULL,'103.199.7.5','2021-06-08 00:45:51'),(40,2,'DSC_dev_01@tma.com.vn',NULL,'DSC_dev_01','$2y$13$h65gZyTTRNWW8Q1b.Kxj4ubpgac4N/5HoC0xtRACJnnLmS.923Rwq',1,'B05RfLqwHMMkZ7TC2x9RQ_H12Gz2nr3Y','M6X8J2yyQyJWCT_8JLL1QAKijvZgB060','2021-06-08 00:35:54',NULL,NULL,NULL,NULL,'103.199.7.5','2021-06-08 01:10:39'),(41,2,'ntquan@tma.com.vn',NULL,'ntquan','$2y$13$WsLmfubkAulvBIaVgLfPw.Zjm5pwDjmWwBIeK4op6DoX5Gf4Aw3qu',1,'7vG27enrLYDlcREbM6cBeSbJu13UABQm','g210BIvj2X-86mPrRNNP3plGWntNJfO4','2021-06-08 00:42:09',NULL,NULL,NULL,NULL,'113.172.81.45','2021-06-08 00:56:59'),(42,2,'pcthao@tma.com.vn',NULL,'pcthao','$2y$13$9UPD1x8ARrZGTv.vbQn6kOuQ/tQRO4qBNbwTz6Etn30ec4nDodyEG',1,'I4x82SavNHsNTRL3WVVWbtXm-dMMBHb0','p4FVkscK1SKAMSkQNWa4SEvpRDzBPsWL','2021-06-08 00:44:17','2021-06-08 00:52:17',NULL,NULL,NULL,'42.119.81.68','2021-06-08 02:50:56'),(43,2,'menloqa@tma.com.vn',NULL,'menloqa','$2y$13$/2q6E.k4hCohS/gwnva/wOU4I5BMTa2ZS12rd0ijaynpzPL0D65Em',1,'WA1bRYcMsj5TiBytbudoLMauoON32S7l','VywFJPPMsZ9W7Mpmwp3JTrETOHNEzowk','2021-06-08 00:46:30','2021-06-08 00:56:03',NULL,NULL,NULL,'42.119.81.68','2021-06-08 00:56:48'),(44,2,'nmcam2@tma.com.vn',NULL,'nmcam2','$2y$13$NOxYz7dHbrgKkkVzCozqWuacDjD9r.vlpdv47POBdBmK2Y.x.W/jy',1,'N8XeWZCuQvxFTPKgqkx9DXrMFA8Q6G-O','ybW8yZ595g0pyjjmzpq74aZMPYjKhMhX','2021-06-08 00:48:18','2021-06-08 00:50:15',NULL,NULL,NULL,NULL,NULL),(45,2,'nmcam1@tma.com.vn',NULL,'nmcam1','$2y$13$At9s0AcCnWF3uvEcZ2J2wuEnGtFxJoNYylGLxhHDPyEYOCUuUxm/i',1,'LcpNoNsX0lwjdctCF2jLnD1BaVutwZxN','brWsyNUpM5_l4Q-5ckFGo69e8a0JzwWg','2021-06-08 00:49:55','2021-06-08 01:07:20',NULL,NULL,NULL,'171.252.153.35','2021-06-08 02:12:44'),(46,2,'menlo1@tma.com.vn',NULL,'menlo1','$2y$13$8p1f8Und6Ca9ijJvpMMU2eXcYhg3sJm.JbVyWylxB0/m2oLdEc9uq',1,'uL0K05U0B36SHkOuvmC0UZ8Tc0mAVQxC','tQQ82cNASfYnRWw34t1GUAbQj8lDQr7o','2021-06-08 00:53:36','2021-06-08 00:55:03',NULL,NULL,NULL,'12.219.129.130','2021-06-08 02:19:00'),(47,2,'menlo2@tma.com.vn',NULL,'menlo2','$2y$13$X9yS4ZGPvyrQNyQxIS3oxuLSNodwwFEDuQzeXU8P..wxSQX5/KdkW',1,'ptKdQz5ILlPrM4Xnv27XCrABb2lz4zG8','BO8sM7Nsued2uive4bU_JCln9oh9UPY-','2021-06-08 00:54:43',NULL,NULL,NULL,NULL,NULL,NULL),(48,2,'DSC_dev_02@tma.com.vn',NULL,'DSC_dev_02','$2y$13$zDXy/pHdnMned/zXmzw/xuKBccjdYMxCpwPNt/f/Q6j0MhB1JXH0K',1,'d0z9lOQRwDmX4jmiOTzwJ184HRCKQQeg','eCOLIdpqY-uZtH9CEphNn7qS7Beqx5K0','2021-06-08 01:21:56',NULL,NULL,NULL,NULL,'14.169.160.182','2021-06-08 01:33:27'),(49,2,'DSC_dev_03@tma.com.vn',NULL,'DSC_dev_03','$2y$13$t7iDZNeiuhsHfhhoDtvf/uN69skDMpSV4K9s2I2FJtQdds0D7TVPe',1,'9_RYAAdRtLZJFhbBFgyP5SApRfaV3Mz8','4pQ9nJJRSF9Wc7CKCdvrtJQHoURDYWYw','2021-06-08 01:22:42','2021-06-08 01:23:40',NULL,NULL,NULL,'171.248.168.143','2021-06-08 01:40:09'),(50,2,'DSC_dev_04@tma.com.vn',NULL,'DSC_dev_04','$2y$13$/v4U0Z1bqIQ2hypSp6ZjlOxcVvIrxoWCr.AM3MsdzNiI4GHDspWDm',1,'8gwxKhMpiKmYhiUW8h9V1uwHD8RlT7k7','EuPs8jLYOBDQZEPOxbyAVa2jlb6BSNwu','2021-06-08 01:23:22','2021-06-08 02:01:15',NULL,NULL,NULL,'14.191.85.242','2021-06-08 02:01:38'),(51,2,'kvtien@tma.com.vn',NULL,'kvtien','$2y$13$yL3J6pzfdOH22rDacR/3qeMxlPAaOyTp13Ecrzaw9Icr9xAdKQgKO',1,'HsSxyOku0QbqddfGG8iutAij9i8D-RsV','9Q8W_WvdTLiwCv9c-9yenycJrjhqSd2r','2021-06-08 01:24:18','2021-06-08 01:54:26',NULL,NULL,NULL,'14.173.44.150','2021-06-08 01:55:08'),(52,2,'tlnhan@tma.com.vn',NULL,'tlnhan','$2y$13$Nzkzxo8AyyErFnn1.O5iaeEX1fVtXwGadZ622f5wWod/qQ3SJErBK',1,'wJPXXiOLg7WmY6UdGjyusS2tP3LEHJGY','K2wEDRyVInFIlfSK9DU5UnyU9eViPrxo','2021-06-08 01:32:39',NULL,NULL,NULL,NULL,'103.199.7.5','2021-06-08 01:35:50'),(54,2,'ttnhi@tma.com.vn',NULL,'ttnhi','$2y$13$FgLt6nwEQxYAWBeiXkSI3uDsjrv92fI4bro.IRdMf7m.N4r9ZHWim',1,'yTxo9PH8ZxpfdgMIACKdjTjjfOs1Hb8p','MzB9kZ0Tl3oDj18BQraYq0ufxdqtK5ik','2021-06-08 02:16:26',NULL,NULL,NULL,NULL,'1.52.111.65','2021-06-08 02:21:25');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userkey`
--

DROP TABLE IF EXISTS `userkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userkey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL,
  `key` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `consume_time` timestamp NULL DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userkey_key` (`key`),
  KEY `userkey_user_id` (`user_id`),
  CONSTRAINT `userkey_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userkey`
--

LOCK TABLES `userkey` WRITE;
/*!40000 ALTER TABLE `userkey` DISABLE KEYS */;
INSERT INTO `userkey` VALUES (1,1,3,'kEfEtnZMGUpa-tKQkFU8N3_xp-0k-FD2','2021-06-07 00:05:06',NULL,'2021-06-09 00:05:06'),(2,29,3,'e1yoVMSrhLbyqCT0WSCqOGKOMk9ZX_mD','2021-06-07 04:07:46',NULL,'2021-06-09 04:07:46'),(3,33,2,'s5aLtXFiuiYYFsQ-l-zDkkQX5vjLl0iI','2021-06-07 04:25:09',NULL,'2021-06-07 04:26:00'),(4,33,2,'c8zCxdiKdwUVJ2BlXAR-v3XnBXL-hV15','2021-06-07 04:28:04',NULL,NULL);
/*!40000 ALTER TABLE `userkey` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-08  9:52:30
