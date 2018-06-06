<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'woocomponent' => [
            'class' => 'app\components\WooComponent',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.prosperovelazco.com',
                'username' => 'pedidos@prosperovelazco.com',
                'password' => 'Superi1278',
                'port' => '587',
            ],
        ],
'log' => [
  'targets' => [
[
    'class' => 'yii\log\FileTarget',
    'logFile' => '/tmp/logs/profile.log',
    'logVars' => [],
    'levels' => ['profile'],
    'categories' => ['yii\db\Command::query'],
    'prefix' => function($message) {
        return '';
    }
]
]
],
        'db' => $db,
    //    /*  'authManager' => [
    //          'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
    //     ],*/
    ],
    'params' => $params,
   
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
