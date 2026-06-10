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
            'trustedHosts' => ['localhost', '127.0.0.1', '192.168.1.6', 'wibetx.online'],
            'enableCsrfValidation' => true,
        ],
        'response' => [
            'on beforeSend' => function($event) {
                $event->sender->headers->set('X-Frame-Options', 'SAMEORIGIN');
                $event->sender->headers->set('X-Content-Type-Options', 'nosniff');
                $event->sender->headers->set('X-XSS-Protection', '1; mode=block');
                $event->sender->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
                $event->sender->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://api.anthropic.com https://generativelanguage.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; frame-src 'self' https://sketchfab.com; connect-src 'self' https://api.anthropic.com https://generativelanguage.googleapis.com;");
                $event->sender->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
            }
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
                'username' => getenv('MAIL_USERNAME') ?: 'your-email@gmail.com',
                'password' => getenv('MAIL_PASSWORD') ?: '',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // 'viewPath' => '@common/mail',
            // 'useFileTransport' => false,

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => getenv('MAIL_USERNAME') ?: 'your-email@gmail.com',
                'password' => getenv('MAIL_PASSWORD') ?: '',
                'port' => '465',
                'encryption' => 'ssl',
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
            'requireEmail' => true,
            'loginEmail' => true,
            'loginUsername' => true,
            'emailConfirmation' => false,
            'viewPath' => '@app/views/user',
            'controllerMap' => [
                'admin' => 'app\controllers\AdminController',
            ],
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
