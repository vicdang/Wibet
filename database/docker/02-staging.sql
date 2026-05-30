-- Create staging DB and grant the app user access to it
CREATE DATABASE IF NOT EXISTS `yii2basic_staging` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON `yii2basic_staging`.* TO 'yii2user'@'%';
FLUSH PRIVILEGES;
