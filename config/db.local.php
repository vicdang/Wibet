<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;dbname=cvas-bet-euro2016',
    'username' => 'dev',
    'password' => 'dev',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
                $event->sender->createCommand("SET time_zone = '+7:00'")->execute();
            }
];
