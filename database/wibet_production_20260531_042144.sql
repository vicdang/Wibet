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
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_configs`
--

LOCK TABLES `admin_configs` WRITE;
/*!40000 ALTER TABLE `admin_configs` DISABLE KEYS */;
INSERT INTO `admin_configs` VALUES ('hide_history','1'),('hide_bet_info','0'),('theme','dark'),('season_name',''),('group_chat',''),('admin_chat',''),('admin_name',''),('admin_email','');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
INSERT INTO `match` VALUES (35,NULL,'1','5',NULL,NULL,NULL,NULL,'2026-06-12 18:00:00',NULL,NULL,'2026-05-30 19:01:09',NULL,1),(36,NULL,'9','10',NULL,NULL,NULL,NULL,'2026-06-12 21:00:00',NULL,NULL,'2026-05-30 19:01:09',NULL,1),(37,NULL,'3','6',NULL,NULL,NULL,NULL,'2026-06-13 18:00:00',NULL,NULL,'2026-05-30 19:01:09',NULL,1),(38,NULL,'7','8',NULL,NULL,NULL,NULL,'2026-06-13 21:00:00',NULL,NULL,'2026-05-30 19:01:09',NULL,1),(39,NULL,'2','4',NULL,NULL,NULL,NULL,'2026-06-14 18:00:00',NULL,NULL,'2026-05-30 19:01:09',NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (3,3,'2026-05-30 07:36:57','2026-05-30 01:55:54','Admin User','Asia_Ho_Chi_Minh',999999),(12,4,'2026-05-30 21:17:53','2026-05-30 21:17:53','Test User 1','Asia_Ho_Chi_Minh',50000),(13,5,'2026-05-30 21:17:53','2026-05-30 21:17:53','Test User 2','Asia_Ho_Chi_Minh',75000),(14,6,'2026-05-30 21:17:53','2026-05-30 21:17:53','Test User 3','Asia_Ho_Chi_Minh',100000),(15,7,'2026-05-30 21:17:53','2026-05-30 21:17:53','Test User 4','Asia_Ho_Chi_Minh',60000),(16,8,'2026-05-30 21:17:53','2026-05-30 21:17:53','Test User 5','Asia_Ho_Chi_Minh',80000),(17,12,'2026-05-30 21:18:01','2026-05-30 21:18:01','Test User 1','Asia_Ho_Chi_Minh',50000),(18,13,'2026-05-30 21:18:01','2026-05-30 21:18:01','Test User 2','Asia_Ho_Chi_Minh',75000),(19,14,'2026-05-30 21:18:01','2026-05-30 21:18:01','Test User 3','Asia_Ho_Chi_Minh',100000),(20,15,'2026-05-30 21:18:01','2026-05-30 21:18:01','Test User 4','Asia_Ho_Chi_Minh',60000),(21,16,'2026-05-30 21:18:01','2026-05-30 21:18:01','Test User 5','Asia_Ho_Chi_Minh',80000);
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
  `name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL,
  `group_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'Mexico','United Mexican States',NULL,'A'),(2,'South Africa','South Africa',NULL,'A'),(3,'South Korea','Republic of Korea',NULL,'A'),(4,'Play-off UEFA D','Play-off UEFA D',NULL,'A'),(5,'Canada','Canada',NULL,'B'),(6,'Switzerland','Switzerland',NULL,'B'),(7,'Qatar','Qatar',NULL,'B'),(8,'Play-off UEFA A','Play-off UEFA A',NULL,'B'),(9,'Brazil','Brazil',NULL,'C'),(10,'Morocco','Morocco',NULL,'C'),(11,'Scotland','Scotland',NULL,'C'),(12,'Haiti','Haiti',NULL,'C'),(13,'USA','United States',NULL,'D'),(14,'Australia','Australia',NULL,'D'),(15,'Paraguay','Paraguay',NULL,'D'),(16,'Play-off UEFA C','Play-off UEFA C',NULL,'D'),(17,'Germany','Germany',NULL,'E'),(18,'Ecuador','Ecuador',NULL,'E'),(19,'Ivory Coast','Ivory Coast',NULL,'E'),(20,'Curacao','Curacao',NULL,'E'),(21,'Netherlands','Netherlands',NULL,'F'),(22,'Japan','Japan',NULL,'F'),(23,'Tunisia','Tunisia',NULL,'F'),(24,'Play-off UEFA B','Play-off UEFA B',NULL,'F'),(25,'Belgium','Belgium',NULL,'G'),(26,'Iran','Iran',NULL,'G'),(27,'Egypt','Egypt',NULL,'G'),(28,'New Zealand','New Zealand',NULL,'G'),(29,'Spain','Spain',NULL,'H'),(30,'Uruguay','Uruguay',NULL,'H'),(31,'Saudi Arabia','Saudi Arabia',NULL,'H'),(32,'Cape Verde','Cape Verde',NULL,'H'),(33,'France','France',NULL,'I'),(34,'Senegal','Senegal',NULL,'I'),(35,'Norway','Norway',NULL,'I'),(36,'Play-off Intercontinental 2','Play-off Intercontinental 2',NULL,'I'),(37,'Argentina','Argentina',NULL,'J'),(38,'Austria','Austria',NULL,'J'),(39,'Algeria','Algeria',NULL,'J'),(40,'Jordan','Jordan',NULL,'J'),(41,'Portugal','Portugal',NULL,'K'),(42,'Colombia','Colombia',NULL,'K'),(43,'Uzbekistan','Uzbekistan',NULL,'K'),(44,'Play-off Intercontinental 1','Play-off Intercontinental 1',NULL,'K'),(45,'England','England',NULL,'L'),(46,'Croatia','Croatia',NULL,'L'),(47,'Panama','Panama',NULL,'L'),(48,'Ghana','Ghana',NULL,'L');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,1,1,'vudnn.dl@gmail.com','vudnn','$2y$13$WFsQ9OUNk2eiBU4RG21hXe7RfTf7ovn5r8UYmg1XiNnDU3lzBPNbG',NULL,NULL,'172.18.0.1','2026-05-30 11:03:49','127.0.0.1','2026-05-30 07:36:57','2026-05-30 01:55:34',NULL,NULL,NULL,NULL,1),(12,2,10,'test1@example.com','testuser1','$2y$13$nJ1SHrsSW9/Ypxy6Wjf0he6xGPiQlEG6Wl39Gc5hILGy2p8j5VQhS','key1',NULL,NULL,NULL,NULL,'2026-05-30 21:17:53','2026-05-30 21:17:53',NULL,NULL,NULL,NULL,3),(13,2,10,'test2@example.com','testuser2','$2y$13$nJ1SHrsSW9/Ypxy6Wjf0he6xGPiQlEG6Wl39Gc5hILGy2p8j5VQhS','key2',NULL,NULL,NULL,NULL,'2026-05-30 21:17:53','2026-05-30 21:17:53',NULL,NULL,NULL,NULL,3),(14,2,10,'test3@example.com','testuser3','$2y$13$nJ1SHrsSW9/Ypxy6Wjf0he6xGPiQlEG6Wl39Gc5hILGy2p8j5VQhS','key3',NULL,NULL,NULL,NULL,'2026-05-30 21:17:53','2026-05-30 21:17:53',NULL,NULL,NULL,NULL,3),(15,2,10,'test4@example.com','testuser4','$2y$13$nJ1SHrsSW9/Ypxy6Wjf0he6xGPiQlEG6Wl39Gc5hILGy2p8j5VQhS','key4',NULL,NULL,NULL,NULL,'2026-05-30 21:17:53','2026-05-30 21:17:53',NULL,NULL,NULL,NULL,3),(16,2,10,'test5@example.com','testuser5','$2y$13$nJ1SHrsSW9/Ypxy6Wjf0he6xGPiQlEG6Wl39Gc5hILGy2p8j5VQhS','key5',NULL,NULL,NULL,NULL,'2026-05-30 21:17:53','2026-05-30 21:17:53',NULL,NULL,NULL,NULL,3);
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

-- Dump completed on 2026-05-30 21:21:44
