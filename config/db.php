<?php
$selectorFile = __DIR__ . '/db_selector.php';
$activeDb = (file_exists($selectorFile) ? trim(file_get_contents($selectorFile)) : 'production');

// Docker env vars take precedence over hardcoded server values
if (getenv('DB_HOST')) {
    $host     = getenv('DB_HOST');
    $user     = getenv('DB_USER')         ?: 'yii2user';
    $pass     = getenv('DB_PASSWORD')     ?: 'yii2password';
    $dbProd   = getenv('DB_NAME')         ?: 'yii2basic';
    $dbStage  = getenv('DB_NAME_STAGING') ?: $dbProd . '_staging';
} else {
    $host    = 'localhost';
    $user    = 'wibet';
    $pass    = 'wibet_password';
    $dbProd  = 'wibet';
    $dbStage = 'wibet_staging';
}

$databases = [
    'production' => $dbProd,
    'staging'    => $dbStage,
];

$dbName = $databases[$activeDb] ?? $dbProd;

return [
    'class'    => 'yii\db\Connection',
    'dsn'      => "mysql:host={$host};dbname={$dbName}",
    'username' => $user,
    'password' => $pass,
    'charset'  => 'utf8',
    'on afterOpen' => function($event) {
        $event->sender->createCommand("SET time_zone = '+7:00'")->execute();
    }
];
