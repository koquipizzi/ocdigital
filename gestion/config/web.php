<?php
use kartik\datecontrol\Module; //se usa más abajo
use kartik\mpdf\Pdf;
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'Comandas',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],//, 'audit'
    'language'=>'es', // spanish
    'params' => $params,
    'modules' => [
         //  'audit' => 'bedezign\yii2\audit\Audit',

         'audit' => [
             'class' => 'bedezign\yii2\audit\Audit',
               'accessRoles' => ['admin'],
                'layout' => 'main',
            // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
            'accessUsers' => [1, 2, 3, 4 , 5, 6, 7 ],
              'userIdentifierCallback' => ['app\models\User', 'userIdentifierCallback'],
 		//	'panelsMerge' => [
 		//		'app/views' => [
         //			'class' => '@app\views\panels\ViewsPanel',
       //  'class' => 'site\index',
 		//		],
 		//	],
		],

         'comment' => [
            'class' => 'yii2mod\comments\Module',
            // when admin can edit comments on frontend
            'enableInlineEdit' => true,
            'controllerMap' => [
            //    'comments' => 'yii2mod\comments\controllers\ManageController',
                // Also you can override some controller properties in following way:
                'comments' => [
                    'class' => 'yii2mod\comments\controllers\ManageController',
                    'searchClass' => [
                        'class' => 'yii2mod\comments\models\search\CommentSearch',
                        'pageSize' => 25
                    ],
                    'indexView' => '@vendor/yii2mod/yii2-comments/views/manage/index',
                    'updateView' => '@vendor/yii2mod/yii2-comments/views/manage/update',
                ],
            ]
        ],
        'admin' => [
           'class' => 'mdm\admin\Module',
           'layout' => 'left-menu', // defaults to null, using the application's layout without the menu
        ],
         'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd/MM/yyyy', //HH:mm:ss
            ],

            //format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            // set your display timezone
            'displayTimezone' => 'America/Argentina/Buenos_Aires',

            // set your timezone for date saved to db
            'saveTimezone' => 'America/Argentina/Buenos_Aires',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,
        ]
    ],
    'components' => [
            'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'decimalSeparator' => ',',
                'thousandSeparator' => '.',
                'numberFormatterSymbols' => [
                    NumberFormatter::CURRENCY_SYMBOL => '$',
                ],
                'nullDisplay' => '',
            ],
            'assetManager' => [
                'bundles' => [
                    'wbraganca\dynamicform\DynamicFormAsset' => [
                        'sourcePath' => '@app/web/js',
                        'js' => [
                            'yii2-dynamic-form.js'
                        ],
                    ],
                ],
            ],
            'woocomponent' => [
                'class' => 'app\components\WooComponent',
                // ... you can configure more properties of the component here
            ],
            'WordpressApi' => [
                'class' => 'app\components\WordpressApi'
            ],
            'qr' => [
                'class' => '\Da\QrCode\Component\QrCodeComponent',
                // ... you can configure more properties of the component here
            ],
            'i18n' => [
                'translations' => [
                    'app*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@app/common/messages',
                        'sourceLanguage' => 'es-ES',
                        'fileMap' => [
                            'app' => 'app.php',
                            'app/error' => 'error.php',
                        ],
                    ],
                    'yii2mod.comments' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                      //  'basePath' => '@yii2mod/comments/messages',
                        'sourceLanguage' => 'es-ES',
                        'basePath' => '@app/common/messages',
                    ],
                    'yii' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'sourceLanguage' => 'es-ES',
                        'basePath' => '@app/common/messages',
                        'sourceLanguage' => 'es-ES',
                        'fileMap' => [
                            'yii' => 'yii.php',
                            //'app/error' => 'error.php',
                        ],
                    ],
                ],
            ],
   /*     'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],
        */
        'authManager' => [
             'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xJUEoJ6HdS8pQxuW4N-FaeVTqWWTjNEL',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]            
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'rules' => [
                  '<controller:\w+>/<id:\d+>' => '<controller>/view',
                  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                  '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
		'allowActions' => [
			'admin/*', // add or remove allowed actions to this list
            'comment/*',
         //   'audit/*',
            'debug/*'
		]
    ],
    'params' => $params,
    'aliases'=>[
        //'@asset'=> dirname(dirname(dirname(dirname(rtrim(dirname($_SERVER['PHP_SELF']), '\\/'))))).'/assets/'
        '@asset'=> rtrim(dirname($_SERVER['PHP_SELF']), '\\/').'/assets/',
   //     '@mdm/admin' => rtrim(dirname($_SERVER['PHP_SELF']), '\\/').'/vendor/mdmsoft/yii2-admin/',
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
