<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=127.0.0.1;dbname=sgtn_18244028_wc2022',
    'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=test_db',
    'username' => 'root',
    'password' => 'password',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
                $event->sender->createCommand("SET time_zone = '+7:00'")->execute();
            }
];
