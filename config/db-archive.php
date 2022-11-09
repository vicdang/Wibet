<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=sgtn_18244028_wc2022',
    'username' => 'root',
    'password' => 'password',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
                $event->sender->createCommand("SET time_zone = '+7:00'")->execute();
            }
];
