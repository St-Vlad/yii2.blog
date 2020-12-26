<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Blog',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hElkpnBu5P2_09t3gBV-ZDZ0WuxomGcS',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\blog\entities\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/main/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'frontend/main/index',
                '<a:(login|logout)>' => 'frontend/auth/<a>',
                '<a:(signup)>' => 'frontend/signup/signup',

                'article/<id:\d+>' => 'frontend/articles/view',

                'cabinet' => 'frontend/cabinet/cabinet/index',
                'cabinet/articles/create' => 'frontend/cabinet/articles/create',

                'cabinet/articles/edit' => 'frontend/cabinet/articles/edit',
                'cabinet/articles/delete' => 'frontend/cabinet/articles/delete',

                'admin' => 'backend/admin/index',
                'admin/users' => 'backend/users/index',
                'admin/articles' => 'backend/articles/index',
                'admin/categories' => 'backend/categories/index',

                'admin/users/<id:\d+>' => 'backend/users/view',
                'admin/category/<id:\d+>' => 'backend/categories/view',

                '<category:[\w\-]+>' => 'frontend/category/index',
            ],
        ],
        /*'as beforeRequest' => [
            'class' => yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'controllers' => 'admin',
                    'roles' => ['admin'],
                ],
            ],
        ],*/
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@', '?'],
            'root' => [
                'class' => 'mihaildev\elfinder\volume\UserPath',
                'path'  => 'static/images/user_{id}',
                'name'  => 'My Images'
            ],
        ],
    ],
    'params' => $params,
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
