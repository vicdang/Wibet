<?php

// Set debug mode based on environment - disabled for production
$isDev = getenv('APP_ENV') === 'dev' || in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']);
defined('YII_DEBUG') or define('YII_DEBUG', $isDev);
defined('YII_ENV') or define('YII_ENV', $isDev ? 'dev' : 'prod');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
