-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: wibet_1670044606_er2024
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
INSERT INTO `admin_configs` VALUES ('hide_history','0'), ('hide_bet_info','0');
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'2014-06-04 04:17:34','2022-12-02 05:04:13','Administrator','Asia_Ho_Chi_Minh',4911),(2,2,'2022-11-16 00:00:09','2022-11-21 05:42:15','Moderator','Asia_Ho_Chi_Minh',1);
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
-- ) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES ('1','GER','Germany','https://img.uefa.com/imgml/flags/140x140/GER.png'),('2','SCO','Scotland','https://img.uefa.com/imgml/flags/140x140/SCO.png'),('3','HUN','Hungary','https://img.uefa.com/imgml/flags/140x140/HUN.png'),('4','SUI','Switzerland','https://img.uefa.com/imgml/flags/140x140/SUI.png'),('5','ESP','Spain','https://img.uefa.com/imgml/flags/140x140/ESP.png'),('6','CRO','Croatia','https://img.uefa.com/imgml/flags/140x140/CRO.png'),('7','ITA','Italy','https://img.uefa.com/imgml/flags/140x140/ITA.png'),('8','ALB','Albania','https://img.uefa.com/imgml/flags/140x140/ALB.png'),('9','SVN','Slovenia','https://img.uefa.com/imgml/flags/140x140/SVN.png'),('10','DEN','Denmark','https://img.uefa.com/imgml/flags/140x140/DEN.png'),('11','SRB','Serbia','https://img.uefa.com/imgml/flags/140x140/SRB.png'),('12','ENG','England','https://img.uefa.com/imgml/flags/140x140/ENG.png'),('13','POL','Poland','https://img.uefa.com/imgml/flags/140x140/POL.png'),('14','NED','Netherlands','https://img.uefa.com/imgml/flags/140x140/NED.png'),('15','AUT','Austria','https://img.uefa.com/imgml/flags/140x140/AUT.png'),('16','FRA','France','https://img.uefa.com/imgml/flags/140x140/FRA.png'),('17','BEL','Belgium','https://img.uefa.com/imgml/flags/140x140/BEL.png'),('18','SVK','Slovakia','https://img.uefa.com/imgml/flags/140x140/SVK.png'),('19','ROU','Romania','https://img.uefa.com/imgml/flags/140x140/ROU.png'),('20','UKR','Ukraine','https://img.uefa.com/imgml/flags/140x140/UKR.png'),('21','TUR','Türkiye','https://img.uefa.com/imgml/flags/140x140/TUR.png'),('22','MKD','North Macedonia','https://img.uefa.com/imgml/flags/140x140/MKD.png'),('23','POR','Portugal','https://img.uefa.com/imgml/flags/140x140/POR.png'),('24','CZE','Czech Republic','https://img.uefa.com/imgml/flags/140x140/CZE.png');
-- INSERT INTO `team` VALUES (1,'NLD','Netherlands','/images/flags/netherlands.png'),(2,'SEN','Senegal','/images/flags/senegal.png'),(3,'QAT','Qatar','/images/flags/qatar.png'),(4,'ECU','Ecuador','/images/flags/ecuador.png'),(5,'ENG','England','/images/flags/england.png'),(6,'IRN','Iran','/images/flags/iran.png'),(7,'USA','United States','/images/flags/united-states.png'),(8,'WAL','Wales','/images/flags/wales.png'),(9,'ARG','Argentina','/images/flags/argentina.png'),(10,'SAU','Saudi Arabia','/images/flags/saudi-arabia.png'),(11,'MEX','Mexico','/images/flags/mexico.png'),(12,'POL','Poland','/images/flags/poland.png'),(13,'DNK','Denmark','/images/flags/denmark.png'),(14,'TUN','Tunisia','/images/flags/tunisia.png'),(15,'FRA','France','/images/flags/france.png'),(16,'AUS','Australia','/images/flags/australia.png'),(17,'DEU','Germany','/images/flags/germany.png'),(18,'JPN','Japan','/images/flags/japan.png'),(19,'ESP','Spain','/images/flags/spain.png'),(20,'CRI','Costa Rica','/images/flags/costa-rica.png'),(21,'MAR','Morocco','/images/flags/morocco.png'),(22,'HRV','Croatia','/images/flags/croatia.png'),(23,'BEL','Belgium','/images/flags/belgium.png'),(24,'CAN','Canada','/images/flags/canada.png'),(25,'CHE','Switzerland','/images/flags/switzerland.png'),(26,'CMR','Cameroon','/images/flags/cameroon.png'),(27,'BRA','Brazil','/images/flags/brazil.png'),(28,'SRB','Serbia','/images/flags/serbia.png'),(29,'PRT','Portugal','/images/flags/portugal.png'),(30,'GHA','Ghana','/images/flags/ghana.png'),(31,'URY','Uruguay','/images/flags/uruguay.png'),(32,'KOR','South Korea','/images/flags/south-korea.png');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'admin@gmail.com','admin','$2y$13$gRCTf5ZawzqK5LFxTHN8cux93rjRnDjbRiBgkXlxkIvOxQJKZlqdi',NULL,NULL,'127.0.0.1','2015-12-02 22:06:25',NULL,'2022-11-09 20:29:05','2022-12-02 05:03:41',NULL,NULL,NULL,NULL,1),(2,1,1,'mod@gmail.com','mod','$2y$13$hOW.dDAwmdOX677gYskbh.RP1ZbJPW7DiZCmifsSdVjj0.dAvzRLq',NULL,NULL,'127.0.0.1','2022-12-01 21:33:31',NULL,'2022-11-16 00:00:09','2022-11-21 05:42:15',NULL,NULL,NULL,NULL,1);
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

-- Dump completed on 2022-12-03 12:16:46
