<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=wibet_1670044606_er2024',
    // 'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=test_db',
    'username' => 'root',
    'password' => 'password',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
                $event->sender->createCommand("SET time_zone = '+7:00'")->execute();
            }
];
