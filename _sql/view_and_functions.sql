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

-- Dumping structure for function funnybet.get_bet_times
DROP FUNCTION IF EXISTS `get_bet_times`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `get_bet_times`(`$user_id` INT) RETURNS int(11)
BEGIN
	DECLARE bet_times INT;
	SET bet_times = ( SELECT COUNT(id) FROM bet WHERE user_id = $user_id);
	RETURN bet_times;
END//
DELIMITER ;


-- Dumping structure for function funnybet.get_total_money
DROP FUNCTION IF EXISTS `get_total_money`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `get_total_money`(`$user_id` INT) RETURNS int(11)
BEGIN
	DECLARE current_money, bet_money INT;
	SET current_money = (SELECT money FROM profile WHERE user_id = $user_id);
	SET bet_money = (SELECT SUM(money) FROM bet WHERE user_id=$user_id AND is_active = 1);
	IF bet_money IS NOT NULL THEN SET current_money = current_money + bet_money; END IF;
	RETURN current_money;
END//
DELIMITER ;


-- Dumping structure for function funnybet.get_win_rate
DROP FUNCTION IF EXISTS `get_win_rate`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `get_win_rate`(`$user_id` INT) RETURNS float
BEGIN
	DECLARE bet_times, win_times INT;
	SET bet_times = get_bet_times($user_id);
	IF bet_times = 0 THEN
		RETURN 0;
	END IF;
	SET win_times = get_win_times($user_id);							
	RETURN ROUND(win_times/bet_times*100, 2);
END//
DELIMITER ;


-- Dumping structure for function funnybet.get_win_times
DROP FUNCTION IF EXISTS `get_win_times`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `get_win_times`(`$user_id` INT) RETURNS int(11)
BEGIN
	RETURN ( SELECT COUNT(b.id) FROM bet b INNER JOIN `match` m ON m.id = match_id 
							WHERE user_id=$user_id AND m.result IS NOT NULL AND `option` = m.result AND m.result <> 0 );
END//
DELIMITER ;


-- Dumping structure for view funnybet.ranking
DROP VIEW IF EXISTS `ranking`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `ranking` (
	`id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`full_name` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`money` INT(11) NULL,
	`total_money` INT(11) NULL,
	`bet_times` INT(11) NULL,
	`win_times` INT(11) NULL,
	`win_rate` FLOAT NULL
) ENGINE=MyISAM;


-- Dumping structure for view funnybet.ranking
DROP VIEW IF EXISTS `ranking`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `ranking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `ranking` AS SELECT u.id, u.username, u.email, p.full_name, p.money,
			get_total_money(u.id) AS total_money, get_bet_times(u.id) AS bet_times, get_win_times(u.id) as win_times, get_win_rate(u.id) AS win_rate
FROM `user` u
	INNER JOIN `profile` p ON p.user_id = u.id
WHERE u.role_id = 2 ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
