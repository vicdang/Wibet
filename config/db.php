<?php
$selectorFile = __DIR__ . '/db_selector.php';
$activeDb = (file_exists($selectorFile) ? trim(file_get_contents($selectorFile)) : 'production');

$databases = [
    'production' => ['dbname' => 'wibet',        'username' => 'wibet', 'password' => 'wibet_password'],
    'staging'    => ['dbname' => 'wibet_staging', 'username' => 'wibet', 'password' => 'wibet_password'],
];

$selected = $databases[$activeDb] ?? $databases['production'];

return [
    'class'    => 'yii\db\Connection',
    'dsn'      => 'mysql:host=localhost;dbname=' . $selected['dbname'],
    'username' => $selected['username'],
    'password' => $selected['password'],
    'charset'  => 'utf8',
];
