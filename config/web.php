<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'baseUrl' => '/',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
            // 'suffix' => '.html',
            'rules' => [],
        ],
        'user' => [
            // 'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => true,
            'class' => 'amnah\yii2\user\components\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // 'mail' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     'useFileTransport' => true,
        //     'messageConfig' => [
        //         'from' => ['admin@website.com' => 'Crazy Bet'], // this is needed for sending emails
        //         'charset' => 'UTF-8',
        //     ],
        //     'transport' => [
        //         'class' => 'Swift_SmtpTransport',
        //         'host' => 'localhost',
        //         'username' => 'username',
        //         'password' => 'password',
        //         'port' => '587',
        //         'encryption' => 'tls',
        //     ],
        // ],
        'mailerGmail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'dc22.wibet@gmail.com',
                'password' => '12345678x@X',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            // set custom module properties here ...
            'requireUsername' => true,
            'emailConfirmation' => false,

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
