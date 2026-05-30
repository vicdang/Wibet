time="2026-05-30T15:29:54+07:00" level=warning msg="/Users/vic/Personal/Wibet/docker-compose.yml: the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion"
mysqldump: [Warning] Using a password on the command line interface can be insecure.
mysqldump: Error: 'Access denied; you need (at least one of) the PROCESS privilege(s) for this operation' when trying to dump tablespaces
-- MySQL dump 10.13  Distrib 8.0.46, for Linux (aarch64)
--
-- Host: localhost    Database: yii2basic
-- ------------------------------------------------------
-- Server version	8.0.46

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` VALUES (1,3,1,1,200,_binary '\0','2026-05-30 08:12:34'),(2,4,1,1,1000,_binary '','2026-05-30 08:14:10'),(3,5,1,2,1500,_binary '','2026-05-30 08:14:10'),(4,6,1,0,500,_binary '','2026-05-30 08:14:10'),(5,4,2,2,800,_binary '','2026-05-30 08:14:10'),(6,5,2,1,1200,_binary '','2026-05-30 08:14:10'),(7,7,2,0,600,_binary '','2026-05-30 08:14:10'),(8,6,3,1,1500,_binary '','2026-05-30 08:14:10'),(9,7,3,2,1000,_binary '','2026-05-30 08:14:10'),(10,4,3,0,700,_binary '','2026-05-30 08:14:10'),(11,5,4,2,1300,_binary '','2026-05-30 08:14:10'),(12,6,4,1,900,_binary '','2026-05-30 08:14:10'),(13,7,4,0,650,_binary '','2026-05-30 08:14:10');
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
INSERT INTO `campaign` VALUES (1,'World Cup 2026','FIFA World Cup 2026','');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
INSERT INTO `match` VALUES (1,NULL,'AUS','IRN',1,2,1,2,'2026-05-30 12:45:00','',NULL,'2026-05-30 07:39:56',NULL,1),(2,1,'FRA','DEU',NULL,NULL,1.5,NULL,'2026-06-12 12:00:00',NULL,1,'2026-05-30 08:14:01',NULL,1),(3,1,'ESP','ENG',NULL,NULL,1.6,NULL,'2026-06-12 15:00:00',NULL,1,'2026-05-30 08:14:01',NULL,1),(4,1,'BRA','ARG',NULL,NULL,1.5,NULL,'2026-06-13 12:00:00',NULL,1,'2026-05-30 08:14:01',NULL,1),(5,1,'NED','BEL',NULL,NULL,1.5,NULL,'2026-06-13 15:00:00','',1,'2026-05-30 08:14:01',NULL,1),(6,1,'POR','CRO',NULL,NULL,1.45,NULL,'2026-06-14 12:00:00',NULL,1,'2026-05-30 08:14:01',NULL,0),(7,1,'PRT','MEX',NULL,NULL,1.5,NULL,'2026-06-14 15:00:00',NULL,1,'2026-05-30 08:14:01',NULL,0),(8,1,'ARG','BRA',NULL,NULL,1.5,NULL,'2026-06-12 12:00:00',NULL,1,'2026-05-30 08:14:10',NULL,1),(9,1,'FRA','DEU',NULL,NULL,1.6,NULL,'2026-06-12 15:00:00',NULL,1,'2026-05-30 08:14:10',NULL,1),(10,1,'ESP','ENG',NULL,NULL,1.5,NULL,'2026-06-13 12:00:00',NULL,1,'2026-05-30 08:14:10',NULL,1),(11,1,'ITA','NLD',NULL,NULL,1.55,NULL,'2026-06-13 15:00:00',NULL,1,'2026-05-30 08:14:10',NULL,1),(12,1,'BEL','URY',NULL,NULL,1.45,NULL,'2026-06-14 12:00:00',NULL,1,'2026-05-30 08:14:10',NULL,0),(13,1,'PRT','MEX',NULL,NULL,1.5,NULL,'2026-06-14 15:00:00',NULL,1,'2026-05-30 08:14:10',NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'2014-06-04 04:17:34','2022-12-02 05:04:13','Administrator','Asia_Ho_Chi_Minh',1),(2,2,'2022-11-16 00:00:09','2022-11-21 05:42:15','Moderator','Asia_Ho_Chi_Minh',1),(3,3,'2026-05-30 07:36:57','2026-05-30 01:12:34','Admin User','Asia_Ho_Chi_Minh',0),(4,4,'2026-05-30 08:14:01','2026-05-30 08:14:01','John Smith','America/New_York',5000),(5,5,'2026-05-30 08:14:01','2026-05-30 08:14:01','Sarah Johnson','Europe/London',7500),(6,6,'2026-05-30 08:14:01','2026-05-30 08:14:01','Mike Wilson','Asia/Bangkok',3500),(7,7,'2026-05-30 08:14:01','2026-05-30 08:14:01','Emma Brown','Australia/Sydney',6000),(8,4,'2026-05-30 08:14:10','2026-05-30 08:14:10','John Smith','America/New_York',5000),(9,5,'2026-05-30 08:14:10','2026-05-30 08:14:10','Sarah Johnson','Europe/London',7500),(10,6,'2026-05-30 08:14:10','2026-05-30 08:14:10','Mike Wilson','Asia/Bangkok',3500),(11,7,'2026-05-30 08:14:10','2026-05-30 08:14:10','Emma Brown','Australia/Sydney',6000);
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
  `full_name` varchar(100) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL,
  `group_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (121,'MEX','Mexico',NULL,'A'),(122,'RSA','South Africa',NULL,'A'),(123,'KOR','South Korea',NULL,'A'),(124,'UEFA_D','Play-off UEFA D',NULL,'A'),(125,'CAN','Canada',NULL,'B'),(126,'CHE','Switzerland',NULL,'B'),(127,'QAT','Qatar',NULL,'B'),(128,'UEFA_A','Play-off UEFA A',NULL,'B'),(129,'BRA','Brazil',NULL,'C'),(130,'MAR','Morocco',NULL,'C'),(131,'SCO','Scotland',NULL,'C'),(132,'HAI','Haiti',NULL,'C'),(133,'USA','United States',NULL,'D'),(134,'AUS','Australia',NULL,'D'),(135,'PAR','Paraguay',NULL,'D'),(136,'UEFA_C','Play-off UEFA C',NULL,'D'),(137,'DEU','Germany',NULL,'E'),(138,'ECU','Ecuador',NULL,'E'),(139,'CIV','Ivory Coast',NULL,'E'),(140,'CUR','Curacao',NULL,'E'),(141,'NED','Netherlands',NULL,'F'),(142,'JPN','Japan',NULL,'F'),(143,'TUN','Tunisia',NULL,'F'),(144,'UEFA_B','Play-off UEFA B',NULL,'F'),(145,'BEL','Belgium',NULL,'G'),(146,'IRN','Iran',NULL,'G'),(147,'EGY','Egypt',NULL,'G'),(148,'NZL','New Zealand',NULL,'G'),(149,'ESP','Spain',NULL,'H'),(150,'URY','Uruguay',NULL,'H'),(151,'SAU','Saudi Arabia',NULL,'H'),(152,'CPV','Cape Verde',NULL,'H'),(153,'FRA','France',NULL,'I'),(154,'SEN','Senegal',NULL,'I'),(155,'NOR','Norway',NULL,'I'),(156,'INTER_2','Play-off Intercontinental 2',NULL,'I'),(157,'ARG','Argentina',NULL,'J'),(158,'AUT','Austria',NULL,'J'),(159,'ALG','Algeria',NULL,'J'),(160,'JOR','Jordan',NULL,'J'),(161,'POR','Portugal',NULL,'K'),(162,'COL','Colombia',NULL,'K'),(163,'UZB','Uzbekistan',NULL,'K'),(164,'INTER_1','Play-off Intercontinental 1',NULL,'K'),(165,'ENG','England',NULL,'L'),(166,'CRO','Croatia',NULL,'L'),(167,'PAN','Panama',NULL,'L'),(168,'GHA','Ghana',NULL,'L');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'admin@gmail.com','admin','$2y$13$gRCTf5ZawzqK5LFxTHN8cux93rjRnDjbRiBgkXlxkIvOxQJKZlqdi',NULL,NULL,'127.0.0.1','2015-12-02 22:06:25',NULL,'2022-11-09 20:29:05','2022-12-02 05:03:41',NULL,NULL,NULL,NULL,1),(2,1,1,'mod@gmail.com','mod','$2y$13$hOW.dDAwmdOX677gYskbh.RP1ZbJPW7DiZCmifsSdVjj0.dAvzRLq',NULL,NULL,'127.0.0.1','2022-12-01 21:33:31',NULL,'2022-11-16 00:00:09','2022-11-21 05:42:15',NULL,NULL,NULL,NULL,1),(3,1,1,'vudnn.dl@gmail.com','vudnn','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,'172.18.0.1','2026-05-30 00:37:33','127.0.0.1','2026-05-30 07:36:57','2026-05-30 07:36:57',NULL,NULL,NULL,NULL,1),(4,1,1,'john@example.com','john','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:01','2026-05-30 08:14:01',NULL,NULL,NULL,NULL,1),(5,1,1,'sarah@example.com','sarah','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:01','2026-05-30 08:14:01',NULL,NULL,NULL,NULL,1),(6,1,1,'mike@example.com','mike','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:01','2026-05-30 08:14:01',NULL,NULL,NULL,NULL,1),(7,1,1,'emma@example.com','emma','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:01','2026-05-30 08:14:01',NULL,NULL,NULL,NULL,1),(8,1,1,'john@example.com','john','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:10','2026-05-30 08:14:10',NULL,NULL,NULL,NULL,1),(9,1,1,'sarah@example.com','sarah','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:10','2026-05-30 08:14:10',NULL,NULL,NULL,NULL,1),(10,1,1,'mike@example.com','mike','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:10','2026-05-30 08:14:10',NULL,NULL,NULL,NULL,1),(11,1,1,'emma@example.com','emma','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,NULL,NULL,'127.0.0.1','2026-05-30 08:14:10','2026-05-30 08:14:10',NULL,NULL,NULL,NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
INSERT INTO `user_token` VALUES (1,1,2,'PZFGQ2VOxvM_NIe12AmKyPziL07EASdp','vudnn.dl@gmail.com','2022-11-06 19:37:32',NULL),(2,1,3,'RQTBJlo4gnzlSISCveaGrD9SyS9Rl-xj',NULL,'2022-11-14 05:09:43','2022-11-16 05:09:43');
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

-- Dump completed on 2026-05-30  8:29:54
