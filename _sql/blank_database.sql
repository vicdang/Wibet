-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.32 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4780
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table funnybet2.bet
DROP TABLE IF EXISTS `bet`;
CREATE TABLE IF NOT EXISTS `bet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `match_id` int(11) unsigned DEFAULT '0',
  `option` tinyint(4) DEFAULT '0',
  `coin` bigint(20) DEFAULT '0',
  `is_active` bit(1) DEFAULT b'1',
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_match_id` (`user_id`,`match_id`),
  KEY `user_id` (`user_id`),
  KEY `FK_bet_match` (`match_id`),
  CONSTRAINT `FK_bet_match` FOREIGN KEY (`match_id`) REFERENCES `match` (`id`),
  CONSTRAINT `FK_bet_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.bet: ~0 rows (approximately)
DELETE FROM `bet`;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;


-- Dumping structure for table funnybet2.campaign
DROP TABLE IF EXISTS `campaign`;
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.campaign: ~1 rows (approximately)
DELETE FROM `campaign`;
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` (`id`, `name`, `description`, `image`) VALUES
	(1, 'World Cup 2014', '', '');
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;


-- Dumping structure for table funnybet2.match
DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.match: ~1 rows (approximately)
DELETE FROM `match`;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
INSERT INTO `match` (`id`, `campaign_id`, `team_1`, `team_2`, `team_1_score`, `team_2_score`, `rate`, `result`, `match_date`, `description`, `created_by`, `created_time`, `modified_time`) VALUES
	(1, NULL, 'Team A', 'Team B', NULL, NULL, 1.5, NULL, '2016-06-12 03:00:00', 'Team A chap Team B 1/2 trai', NULL, '2016-06-09 11:32:38', NULL);
/*!40000 ALTER TABLE `match` ENABLE KEYS */;


-- Dumping structure for table funnybet2.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.migration: ~2 rows (approximately)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1401873449),
	('m131114_141544_add_user', 1401873454);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Dumping structure for table funnybet2.profile
DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `coin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `profile_user_id` (`user_id`),
  CONSTRAINT `profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.profile: ~2 rows (approximately)
DELETE FROM `profile`;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `user_id`, `create_time`, `update_time`, `full_name`, `coin`) VALUES
	(1, 1, '2014-06-04 18:17:34', '2014-06-11 04:05:05', 'Administrator', 500),
	(2, 2, '2014-06-06 01:53:22', '2014-06-10 13:15:02', 'Demo', 450);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;


-- Dumping structure for table funnybet2.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `can_admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.role: ~3 rows (approximately)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `create_time`, `update_time`, `can_admin`) VALUES
	(1, 'Admin', '2014-06-04 18:17:34', NULL, 1),
	(2, 'User', '2014-06-04 18:17:34', NULL, 0),
	(3, 'Guest', '2014-06-04 18:17:34', NULL, 0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Dumping structure for table funnybet2.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `role_id`, `email`, `new_email`, `username`, `password`, `status`, `auth_key`, `api_key`, `create_time`, `update_time`, `ban_time`, `ban_reason`, `registration_ip`, `login_ip`, `login_time`) VALUES
	(1, 1, 'admin@localhost.com', NULL, 'admin', '$2y$13$9A6v2inghjnLIyKhHjHVx.AEVfbI9zQl83jrxnFzCXT9JOfpFwLZ6', 1, 'KSQVZx_QRLt7Jic-WL2uzQl6tNlHyrE9', '1UneDlwyKNYl8VL2uFD2B6LqHtbXydN8', '2014-06-04 18:17:34', '2014-06-11 04:49:31', NULL, NULL, NULL, '127.0.0.1', '2014-06-26 23:49:28'),
	(2, 2, 'demo@localhost.com', NULL, 'demo', '$2y$13$z7TNFxWOj6IDLR7AkjlPPeQuzbJ6haClutYIlrlfThtjjx6Ur6XLy', 1, 'mX2t9ZBulMzPV9I3tyxXh7EVKjtJk6_u', 'sCxWJ9oSziMovuFGZIM1XJlCwfDNSeg9', '2014-06-06 01:53:22', '2014-06-10 13:15:02', NULL, NULL, '127.0.0.1', '127.0.0.1', '2014-06-06 02:19:52');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table funnybet2.userkey
DROP TABLE IF EXISTS `userkey`;
CREATE TABLE IF NOT EXISTS `userkey` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table funnybet2.userkey: ~2 rows (approximately)
DELETE FROM `userkey`;
/*!40000 ALTER TABLE `userkey` DISABLE KEYS */;
INSERT INTO `userkey` (`id`, `user_id`, `type`, `key`, `create_time`, `consume_time`, `expire_time`) VALUES
	(1, 2, 1, 'ToLB9LOW4FKq-yHNlF8qF3Fh7BxD0YrM', '2014-06-06 01:58:44', NULL, NULL),
	(2, 1, 2, 'dQUAsDInj-6TLB7PrtDaPy1auQ7o2ILq', '2014-06-11 04:04:27', NULL, '2014-06-11 04:49:31');
/*!40000 ALTER TABLE `userkey` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
