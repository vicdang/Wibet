-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: wibet_1670044606_er2024
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.22.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_configs`
--

DROP TABLE IF EXISTS `admin_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_configs` (
  `key` varchar(25) DEFAULT NULL,
  `value` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_configs`
--

LOCK TABLES `admin_configs` WRITE;
/*!40000 ALTER TABLE `admin_configs` DISABLE KEYS */;
INSERT INTO `admin_configs` VALUES ('hide_history','0'),('hide_bet_info','0');
/*!40000 ALTER TABLE `admin_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bet`
--

DROP TABLE IF EXISTS `bet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bet` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT '0',
  `match_id` int unsigned DEFAULT '0',
  `option` tinyint DEFAULT '0',
  `money` bigint DEFAULT '0',
  `is_active` bit(1) DEFAULT b'1',
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` VALUES (1,4,1,2,50,_binary '\0','2024-06-13 06:09:17'),(2,13,2,1,400,_binary '\0','2024-06-14 06:51:45'),(3,6,2,1,800,_binary '\0','2024-06-14 04:09:22'),(5,15,2,2,100,_binary '\0','2024-06-14 05:34:31'),(6,16,2,1,400,_binary '\0','2024-06-14 17:28:19'),(8,17,2,2,200,_binary '\0','2024-06-14 06:54:00'),(10,19,2,2,50,_binary '\0','2024-06-14 18:28:01'),(11,19,4,2,50,_binary '','2024-06-14 07:02:52'),(12,22,2,1,100,_binary '\0','2024-06-14 07:14:47'),(14,21,2,1,50,_binary '\0','2024-06-14 07:25:07'),(15,21,3,2,50,_binary '','2024-06-14 07:25:20'),(18,24,2,1,200,_binary '\0','2024-06-14 07:41:01'),(19,25,2,2,50,_binary '\0','2024-06-14 07:49:00'),(21,9,2,2,150,_binary '\0','2024-06-14 08:09:27'),(22,27,2,2,50,_binary '\0','2024-06-14 08:27:01'),(23,28,2,1,150,_binary '\0','2024-06-14 18:25:55'),(25,23,2,2,200,_binary '\0','2024-06-14 09:36:24'),(26,14,2,1,100,_binary '\0','2024-06-14 10:52:48'),(27,20,2,1,100,_binary '\0','2024-06-14 17:43:34'),(28,8,2,1,300,_binary '\0','2024-06-14 17:02:07'),(29,5,2,2,300,_binary '\0','2024-06-14 17:21:16'),(30,5,4,2,200,_binary '','2024-06-15 02:53:58'),(33,23,4,1,200,_binary '','2024-06-15 03:17:41'),(34,26,4,2,50,_binary '','2024-06-15 05:37:15'),(35,32,4,1,50,_binary '','2024-06-15 05:47:50');
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaign` (
  `id` int unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign`
--

LOCK TABLES `campaign` WRITE;
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` VALUES (1,'World Cup 2022','','');
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `match` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int unsigned DEFAULT NULL,
  `team_1` varchar(50) DEFAULT NULL,
  `team_2` varchar(50) DEFAULT NULL,
  `team_1_score` tinyint DEFAULT NULL,
  `team_2_score` tinyint DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `result` tinyint DEFAULT NULL,
  `match_date` timestamp NULL DEFAULT NULL,
  `description` text,
  `created_by` int unsigned DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  `visible` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
INSERT INTO `match` VALUES (1,NULL,'1','7',1,0,0.25,1,'2024-06-13 14:06:00','',NULL,'2024-06-13 06:06:33',NULL,0),(2,NULL,'1','2',5,1,1.5,1,'2024-06-14 19:00:00','',NULL,'2024-06-13 09:55:25',NULL,1),(3,NULL,'5','6',NULL,NULL,0.5,NULL,'2024-06-15 16:00:00','',NULL,'2024-06-13 09:57:10',NULL,1),(4,NULL,'4','3',NULL,NULL,0.5,NULL,'2024-06-15 13:00:00','',NULL,'2024-06-13 09:58:17',NULL,1),(5,NULL,'7','8',NULL,NULL,1.5,NULL,'2024-06-15 19:00:00','',NULL,'2024-06-15 06:22:29',NULL,1),(6,NULL,'14','13',NULL,NULL,1,NULL,'2024-06-16 13:00:00','',NULL,'2024-06-15 06:25:20',NULL,0),(7,NULL,'10','9',NULL,NULL,1,NULL,'2024-06-16 16:00:00','',NULL,'2024-06-15 06:27:20',NULL,0);
/*!40000 ALTER TABLE `match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `timezone` varchar(25) DEFAULT 'Asia_Ho_Chi_Minh',
  `money` int DEFAULT '200',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'2014-06-04 04:17:34','2024-06-14 05:31:49','Administrator','Asia_Ho_Chi_Minh',1),(2,2,'2022-11-16 00:00:09','2022-11-21 05:42:15','Moderator','Asia_Ho_Chi_Minh',1),(3,3,'2024-06-12 21:40:58','2024-06-14 05:32:07','Admin vngiau','Asia_Ho_Chi_Minh',1),(5,5,'2024-06-13 00:29:13','2024-06-14 19:53:58','An Hoang','Pacific/Midway',300),(6,6,'2024-06-13 00:38:01','2024-06-14 18:54:39','Tài Lê','Asia/Ho_Chi_Minh',1600),(7,7,'2024-06-13 03:35:44','2024-06-13 03:35:44','GVBM','Asia_Ho_Chi_Minh',200),(8,8,'2024-06-13 04:14:29','2024-06-14 18:54:39','Trương Thành Ý','Asia_Ho_Chi_Minh',1100),(9,9,'2024-06-13 09:52:39','2024-06-14 01:09:27','Duy Văn','Asia_Ho_Chi_Minh',250),(10,10,'2024-06-13 19:37:55','2024-06-13 19:43:24','Tân Trần','Asia_Ho_Chi_Minh',200),(11,11,'2024-06-13 19:42:59','2024-06-13 19:42:59','Tân Trần','Asia_Ho_Chi_Minh',200),(12,12,'2024-06-13 19:45:13','2024-06-13 19:45:13','Tân Trần','Asia_Ho_Chi_Minh',200),(13,13,'2024-06-13 19:47:49','2024-06-14 18:54:39','Nguyễn Thanh Quân','Asia_Ho_Chi_Minh',1200),(14,14,'2024-06-13 19:50:25','2024-06-14 18:54:39','Phan Lãng Tử','Asia_Ho_Chi_Minh',200),(15,15,'2024-06-13 20:10:32','2024-06-13 22:34:31','Cầm Nguyễn','Asia_Ho_Chi_Minh',700),(16,16,'2024-06-13 23:33:11','2024-06-14 18:54:39','Đức Phạm','Asia_Ho_Chi_Minh',800),(17,17,'2024-06-13 23:39:47','2024-06-14 01:32:28','Nguyễn Thanh Quân','Asia/Ho_Chi_Minh',0),(18,18,'2024-06-13 23:42:57','2024-06-14 05:06:51','Thai Tran','Asia_Ho_Chi_Minh',500),(19,19,'2024-06-13 23:55:21','2024-06-14 00:02:52','Ngô Hoàng Nghĩa','Asia_Ho_Chi_Minh',0),(20,20,'2024-06-13 23:57:49','2024-06-14 18:54:39','Dương & Thắng','Asia_Ho_Chi_Minh',300),(21,21,'2024-06-14 00:02:21','2024-06-14 18:54:39','Hau Phan','Asia_Ho_Chi_Minh',200),(22,22,'2024-06-14 00:04:05','2024-06-14 18:54:39','Đạt Phạm','Asia_Ho_Chi_Minh',200),(23,23,'2024-06-14 00:09:42','2024-06-14 20:11:01','LS team','Asia/Ho_Chi_Minh',600),(24,24,'2024-06-14 00:29:23','2024-06-14 18:54:39','Trương Minh Hoàng','Asia_Ho_Chi_Minh',400),(25,25,'2024-06-14 00:37:29','2024-06-14 00:49:00','Quang Pham','Asia_Ho_Chi_Minh',750),(26,26,'2024-06-14 00:47:04','2024-06-14 22:37:15','Hiep Thai','Asia_Ho_Chi_Minh',150),(27,27,'2024-06-14 00:47:55','2024-06-14 01:27:01','Hiep Thai','Asia_Ho_Chi_Minh',150),(28,28,'2024-06-14 01:45:06','2024-06-14 18:54:39','Bùi Xuân Trường','Asia_Ho_Chi_Minh',350),(29,29,'2024-06-14 03:07:07','2024-06-14 03:14:23','Nhật Đặng','Asia_Ho_Chi_Minh',200),(30,30,'2024-06-14 21:47:07','2024-06-14 21:47:07','Nhà Cái Uy Tín','Asia_Ho_Chi_Minh',200),(31,31,'2024-06-14 22:15:06','2024-06-14 22:15:06','Menlo RBI','Asia_Ho_Chi_Minh',200),(32,32,'2024-06-14 22:17:28','2024-06-14 22:39:16','DC26 MBA','Asia_Ho_Chi_Minh',150);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranking` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `money` int DEFAULT NULL,
  `total_money` int DEFAULT NULL,
  `bet_times` int DEFAULT NULL,
  `win_times` int DEFAULT NULL,
  `win_rate` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranking`
--

LOCK TABLES `ranking` WRITE;
/*!40000 ALTER TABLE `ranking` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `can_admin` smallint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin','2022-11-05 07:00:25',NULL,1),(2,'User','2022-06-04 11:17:34',NULL,0),(3,'Guest','2022-06-04 11:17:34',NULL,0),(4,'Test','2022-06-04 11:17:34',NULL,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `full_name` varchar(25) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'GER','Germany','https://img.uefa.com/imgml/flags/140x140/GER.png'),(2,'SCO','Scotland','https://img.uefa.com/imgml/flags/140x140/SCO.png'),(3,'HUN','Hungary','https://img.uefa.com/imgml/flags/140x140/HUN.png'),(4,'SUI','Switzerland','https://img.uefa.com/imgml/flags/140x140/SUI.png'),(5,'ESP','Spain','https://img.uefa.com/imgml/flags/140x140/ESP.png'),(6,'CRO','Croatia','https://img.uefa.com/imgml/flags/140x140/CRO.png'),(7,'ITA','Italy','https://img.uefa.com/imgml/flags/140x140/ITA.png'),(8,'ALB','Albania','https://img.uefa.com/imgml/flags/140x140/ALB.png'),(9,'SVN','Slovenia','https://img.uefa.com/imgml/flags/140x140/SVN.png'),(10,'DEN','Denmark','https://img.uefa.com/imgml/flags/140x140/DEN.png'),(11,'SRB','Serbia','https://img.uefa.com/imgml/flags/140x140/SRB.png'),(12,'ENG','England','https://img.uefa.com/imgml/flags/140x140/ENG.png'),(13,'POL','Poland','https://img.uefa.com/imgml/flags/140x140/POL.png'),(14,'NED','Netherlands','https://img.uefa.com/imgml/flags/140x140/NED.png'),(15,'AUT','Austria','https://img.uefa.com/imgml/flags/140x140/AUT.png'),(16,'FRA','France','https://img.uefa.com/imgml/flags/140x140/FRA.png'),(17,'BEL','Belgium','https://img.uefa.com/imgml/flags/140x140/BEL.png'),(18,'SVK','Slovakia','https://img.uefa.com/imgml/flags/140x140/SVK.png'),(19,'ROU','Romania','https://img.uefa.com/imgml/flags/140x140/ROU.png'),(20,'UKR','Ukraine','https://img.uefa.com/imgml/flags/140x140/UKR.png'),(21,'TUR','Türkiye','https://img.uefa.com/imgml/flags/140x140/TUR.png'),(22,'MKD','North Macedonia','https://img.uefa.com/imgml/flags/140x140/MKD.png'),(23,'POR','Portugal','https://img.uefa.com/imgml/flags/140x140/POR.png'),(24,'CZE','Czech Republic','https://img.uefa.com/imgml/flags/140x140/CZE.png');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `status` smallint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `logged_in_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `banned_reason` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `new_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'admin@gmail.com','admin','$2y$13$j3toTCQHsWAcs3PjxSadM.Qq8Rgup4ULy.JzF/RvEzsdOCkiWlmtm',NULL,NULL,'127.0.0.1','2024-06-14 23:21:35',NULL,'2022-11-09 20:29:05','2024-06-14 05:31:49',NULL,NULL,NULL,NULL,1),(2,1,1,'mod@gmail.com','mod','$2y$13$hOW.dDAwmdOX677gYskbh.RP1ZbJPW7DiZCmifsSdVjj0.dAvzRLq',NULL,NULL,'127.0.0.1','2022-12-01 21:33:31',NULL,'2022-11-16 00:00:09','2022-11-21 05:42:15',NULL,NULL,NULL,NULL,1),(3,1,1,'vngiau@tma.com.vn','vngiau','$2y$13$uIsI9o7oi/Dk0R1wYF24ku.ld1j0kZ0/W3dvYBGYfXE.to6yLS41O',NULL,NULL,'127.0.0.1','2024-06-14 23:28:13','127.0.0.1','2024-06-12 21:40:58','2024-06-14 05:32:07',NULL,NULL,NULL,NULL,1),(5,2,1,'hnan@tma.com.vn','cristuan','$2y$13$wLoxe4tCIk5NKsIbZD6HLuucEmRDA8W53ViXiVsMZg.xvdsPydEDq',NULL,NULL,'127.0.0.1','2024-06-14 19:53:40','127.0.0.1','2024-06-13 00:29:13','2024-06-13 00:38:28',NULL,NULL,NULL,NULL,3),(6,2,1,'lttai@tma.com.vn','CaptainLC','$2y$13$jf/5P/BoB22OodIcrRRrwuXGCrsnnenFKgEZTVuIFeIRgwgViQKAG',NULL,NULL,'127.0.0.1','2024-06-14 04:14:32','127.0.0.1','2024-06-13 00:38:01','2024-06-13 02:36:54',NULL,NULL,NULL,NULL,3),(7,2,1,'ptthoai@tma.com.vn','dc2gvbm','$2y$13$pSXnWhfOn9QyzmhRJ3mDwOUXw3SQ7jOjlO4rX/hSnv.lqpAk3Mjmq',NULL,NULL,'127.0.0.1','2024-06-14 07:08:00','127.0.0.1','2024-06-13 03:35:44','2024-06-13 03:40:04',NULL,NULL,NULL,NULL,3),(8,2,1,'tty@tma.com.vn','A6','$2y$13$e5R2ZIrBvAW33SUKyTuEX.RuFC4W/QDeYSsGItGVrg9ds1.P4Vjse',NULL,NULL,'127.0.0.1','2024-06-15 00:08:47','127.0.0.1','2024-06-13 04:14:29','2024-06-14 02:02:31',NULL,NULL,NULL,NULL,3),(9,2,1,'vcduy@tma.com.vn','Crossbone','$2y$13$9V9nw.Bui/gNXJH33FLSHO3gYJGHiSidwkSnHZZz05kSEST3fTyz6',NULL,NULL,'127.0.0.1','2024-06-15 00:21:19','127.0.0.1','2024-06-13 09:52:39','2024-06-13 10:12:40',NULL,NULL,NULL,NULL,3),(10,2,1,'lhlinh@tma.com.vn','DC2TIP','$2y$13$VUASCz4y4eDyrCJ6O5ZuQ.cvP63WRjOaIQEvHFwB542p8hWb5Aa5W',NULL,NULL,'127.0.0.1','2024-06-14 03:26:33','127.0.0.1','2024-06-13 19:37:55','2024-06-13 19:43:24',NULL,NULL,NULL,NULL,3),(11,2,1,'tdviet@tma.com.vn','DC22TIP','$2y$13$fh/a7ySvT9pCREaF83B7uOpA5MpY2dhT45f2eapn7vXSAtLea.K/S',NULL,NULL,'127.0.0.1','2024-06-13 23:37:07','127.0.0.1','2024-06-13 19:42:59','2024-06-13 19:42:59',NULL,NULL,NULL,NULL,3),(12,2,1,'vthung@tma.com.vn','DC26TIP','$2y$13$0tVocUWI63.8REIC2WrfJuxaCOQqVD8GnpPINu3ZTqcyGjF7JwAmC',NULL,NULL,NULL,NULL,'127.0.0.1','2024-06-13 19:45:13','2024-06-13 19:45:13',NULL,NULL,NULL,NULL,3),(13,2,1,'ntquan@tma.com.vn','TonyLam','$2y$13$k8Y6usYNPeNcvYaz.dGscuOJ8cSM4cws3kfnbLP.nGhGexUNKcGt2',NULL,NULL,'127.0.0.1','2024-06-14 19:42:18','127.0.0.1','2024-06-13 19:47:49','2024-06-13 23:38:57',NULL,NULL,NULL,NULL,3),(14,2,1,'pmnhut2@tma.com.vn','rolando','$2y$13$F.j3BC7uSzgqrPV2n/P0BeSPX0tIxbmAAd4yld.En9I5Z.SrEmj0e',NULL,NULL,'127.0.0.1','2024-06-14 03:14:47','127.0.0.1','2024-06-13 19:50:25','2024-06-13 19:54:26',NULL,NULL,NULL,NULL,3),(15,2,1,'nmcam@tma.com.vn','DC226FC','$2y$13$KwPubVGqhCt7/EJil7eQ/.jG.rVXEkosUMIq5LCwxLMVXOiVIm4NC',NULL,NULL,'127.0.0.1','2024-06-14 23:26:06','127.0.0.1','2024-06-13 20:10:32','2024-06-13 21:40:44',NULL,NULL,NULL,NULL,3),(16,2,1,'pgduc@tma.com.vn','capybara','$2y$13$.Qz0C4I9BA2j4VFeit3Hlum1laLhQOLwzRFECBSlAWRI0zFLIDOJm',NULL,NULL,'127.0.0.1','2024-06-14 18:13:19','127.0.0.1','2024-06-13 23:33:11','2024-06-13 23:37:11',NULL,NULL,NULL,NULL,3),(17,2,1,'ntquan1@tma.com.vn','NhaCai','$2y$13$vhkX8Rc6tfomaR.k1rPszeQfPJMK.bcnlwPAALR3/yXAgOvwQlj3m',NULL,NULL,'127.0.0.1','2024-06-14 19:42:03','127.0.0.1','2024-06-13 23:39:47','2024-06-13 23:52:29',NULL,NULL,NULL,NULL,3),(18,2,1,'tqthai1@tma.com.vn','MBappe','$2y$13$LnihxCYm1PnM2/nommWcWuGgqw/miNJ7YbPgSsx7VfaDT.BtlwVWK',NULL,NULL,'127.0.0.1','2024-06-14 17:45:56','127.0.0.1','2024-06-13 23:42:57','2024-06-13 23:47:42',NULL,NULL,NULL,NULL,3),(19,2,1,'nhoangnghia@tma.com.vn','MahrezNN27','$2y$13$Yg3gF7qqqED/Smv8/wZjEOFlSQ8qw6mPI.u6IXRUcJKsH4C2C6Lve',NULL,NULL,'127.0.0.1','2024-06-14 11:27:41','127.0.0.1','2024-06-13 23:55:21','2024-06-14 00:54:56',NULL,NULL,NULL,NULL,3),(20,2,1,'nvanduong@tma.com.vn','BetKing','$2y$13$p3kuCBvCfLj9RTzP7WTiuuLc1DK2jhYIoXm6mtgeMFLQbjx/2hwCy',NULL,NULL,'127.0.0.1','2024-06-14 23:53:50','127.0.0.1','2024-06-13 23:57:49','2024-06-13 23:58:15',NULL,NULL,NULL,NULL,3),(21,2,1,'pvanhau@tma.com.vn','connhangheo','$2y$13$pcFq8Tf51BOEQL.5FBY9kusoAkk4UcYls.TX1pHewGsEmDxxSj2BO',NULL,NULL,'127.0.0.1','2024-06-14 00:22:46','127.0.0.1','2024-06-14 00:02:21','2024-06-14 00:22:31',NULL,NULL,NULL,NULL,3),(22,2,1,'pthanhdat@tma.com.vn','NLSRKousei','$2y$13$DL56K7YzGj9GgFpXX2tF2u.TV3dya.YWRAuuxtch6hYFHbDcROo.2',NULL,NULL,'127.0.0.1','2024-06-14 00:05:06','127.0.0.1','2024-06-14 00:04:04','2024-06-14 00:05:50',NULL,NULL,NULL,NULL,3),(23,2,1,'rbbn_lst@tma.com.vn','LargeSystem','$2y$13$blBwXYDJ3BGRIq2l0.CLpuDQJNhp123zMBh7Jk9m2HY/NEenwTkFe',NULL,NULL,'127.0.0.1','2024-06-15 00:18:44','127.0.0.1','2024-06-14 00:09:42','2024-06-14 00:12:32',NULL,NULL,NULL,NULL,3),(24,2,1,'rbbn_trunking@tma.com.vn','CuLiGod','$2y$13$sF8c/bZDne05WkUhPLdj6uT2tkEs6OE//mewX18wOm.DtVSTc7uHO',NULL,NULL,'127.0.0.1','2024-06-14 19:51:15','127.0.0.1','2024-06-14 00:29:23','2024-06-14 00:35:42',NULL,NULL,NULL,NULL,3),(25,2,1,'pxquang@tma.com.vn','AE_Mo_Cau','$2y$13$IFKsEesheirz98XRo3fa/udhyi8bVZS.ZJWUa3e7F5fP7OsxrgBVS',NULL,NULL,'127.0.0.1','2024-06-15 00:21:59','127.0.0.1','2024-06-14 00:37:29','2024-06-14 00:40:56',NULL,NULL,NULL,NULL,3),(26,2,1,'tpvhiep@tma.com.vn','hthai','$2y$13$bOFeu5bX7Eo4EwYMxgNRguqgJIEfhFk91/ZqvS.M2qS.nF11YvJxK',NULL,NULL,'127.0.0.1','2024-06-15 00:13:15','127.0.0.1','2024-06-14 00:47:04','2024-06-14 01:09:13',NULL,NULL,NULL,NULL,3),(27,2,1,'tpvhiep1@tma.com.vn','hthai1','$2y$13$Spxr9a/cbeZ3HSdPnA9A/eY53NUKcp1eVDfVmF8.tT5/yYeP2532e',NULL,NULL,'127.0.0.1','2024-06-14 22:17:47','127.0.0.1','2024-06-14 00:47:55','2024-06-14 01:08:21',NULL,NULL,NULL,NULL,3),(28,2,1,'bxuantruong@tma.com.vn','betkeothaycom','$2y$13$f5h9Jwqv2wbUskt1uY9WmuUg4Dkx3tqjnukgO/83UXOTbUYrBodAm',NULL,NULL,'127.0.0.1','2024-06-14 12:40:49','127.0.0.1','2024-06-14 01:45:06','2024-06-14 01:49:25',NULL,NULL,NULL,NULL,3),(29,2,1,'dmnhat@tma.com.vn','ocpeo','$2y$13$hCaN0J.nSHoZdARcPz1E1OrRzFFf6NWmvA3g0NnP3XTG2j6yjAX.m',NULL,NULL,'127.0.0.1','2024-06-14 06:06:21','127.0.0.1','2024-06-14 03:07:07','2024-06-14 03:44:58',NULL,NULL,NULL,NULL,3),(30,2,1,'dnnphuong@tma.com.vn','Cam_So_Lien_Lac','$2y$13$XgSKtRjAjC1BW5LJJ3cH2uA73wwCCopu94RMrGzxneKr4JwDdkbla',NULL,NULL,'127.0.0.1','2024-06-14 22:22:40','127.0.0.1','2024-06-14 21:47:07','2024-06-14 21:54:14',NULL,NULL,NULL,NULL,3),(31,2,1,'menlo_rbi@tma.com.vn','Menlo_RBI','$2y$13$rxZXVvX49TxSHMQkOJzOjuWMLPEf02t/YhGzNnKjaoj9rJ1E6lSPy',NULL,NULL,'127.0.0.1','2024-06-14 22:28:24','127.0.0.1','2024-06-14 22:15:06','2024-06-14 22:28:45',NULL,NULL,NULL,NULL,3),(32,2,1,'dc26_mba@tma.com.vn','DC26_MBA','$2y$13$EBBJMAh5GQHKM07uc71gL.6qYuU2FOvnYd4eHOa.zBfmfXeHsqjUC',NULL,NULL,'127.0.0.1','2024-06-14 22:35:46','127.0.0.1','2024-06-14 22:17:28','2024-06-14 22:35:23',NULL,NULL,NULL,NULL,3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_auth`
--

DROP TABLE IF EXISTS `user_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_auth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider_attributes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_provider_id` (`provider_id`),
  KEY `user_auth_user_id` (`user_id`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_auth`
--

LOCK TABLES `user_auth` WRITE;
/*!40000 ALTER TABLE `user_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `type` smallint NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_token_token` (`token`),
  KEY `user_token_user_id` (`user_id`),
  CONSTRAINT `user_token_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
INSERT INTO `user_token` VALUES (1,1,2,'PZFGQ2VOxvM_NIe12AmKyPziL07EASdp','vudnn.dl@gmail.com','2022-11-06 19:37:32',NULL),(2,1,3,'RQTBJlo4gnzlSISCveaGrD9SyS9Rl-xj',NULL,'2022-11-14 05:09:43','2022-11-16 05:09:43'),(3,15,1,'CfpXI0OII2224JGFNpsNByHBWQ8e1xF5',NULL,'2024-06-13 21:27:58',NULL);
/*!40000 ALTER TABLE `user_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userkey`
--

DROP TABLE IF EXISTS `userkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userkey` (
  `id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `type` tinyint NOT NULL,
  `key` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `consume_time` timestamp NULL DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userkey`
--

LOCK TABLES `userkey` WRITE;
/*!40000 ALTER TABLE `userkey` DISABLE KEYS */;
INSERT INTO `userkey` VALUES (1,2,1,'ToLB9LOW4FKq-yHNlF8qF3Fh7BxD0YrM','2014-06-05 18:58:44',NULL,NULL),(2,1,2,'dQUAsDInj-6TLB7PrtDaPy1auQ7o2ILq','2014-06-10 21:04:27',NULL,'2014-06-10 21:49:31');
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

-- Dump completed on 2024-06-15 14:22:49
