<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Blog',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
    ],
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
            'loginUrl' => ['frontend/auth/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/blog/error',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}',
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'elfinder/<a>' => 'elfinder/<a>',
                '' => 'frontend/blog/index',
                '<a:(login|logout)>' => 'frontend/auth/<a>',
                '<a:(signup)>' => 'frontend/signup/signup',

                'admin' => 'backend/admin/index',

                'admin/articles' => 'backend/articles/index',
                'admin/articles/<id:\d+>' => 'backend/articles/view',
                'admin/articles/update/<id:\d+>' => 'backend/articles/update',
                'admin/articles/delete/<id:\d+>' => 'backend/articles/delete',
                'admin/articles/swap/<id:\d+>' => 'backend/articles/swap',

                'admin/tags' => 'backend/tags/index',
                'admin/tags/<id:\d+>' => 'backend/tags/view',
                'admin/tags/update/<id:\d+>' => 'backend/tags/update',
                'admin/tags/delete/<id:\d+>' => 'backend/tags/delete',

                'admin/categories' => 'backend/categories/index',
                'admin/categories/<id:\d+>' => 'backend/categories/view',
                'admin/categories/create' => 'backend/categories/create',
                'admin/categories/update/<id:\d+>' => 'backend/categories/update',
                'admin/categories/delete/<id:\d+>' => 'backend/categories/delete',

                'admin/users' => 'backend/users/index',
                'admin/users/<id:\d+>' => 'backend/users/view',
                'admin/users/update/<id:\d+>' => 'backend/users/update',
                'admin/users/delete/<id:\d+>' => 'backend/users/delete',

                'cabinet' => 'frontend/cabinet/cabinet/index',
                'cabinet/articles/create' => 'frontend/cabinet/articles/create',
                'cabinet/articles/edit/<slug:[\w-]+>' => 'frontend/cabinet/articles/update',
                'cabinet/articles/delete/<id:\d+>' => 'frontend/cabinet/articles/delete',

                'tag/<tag_name:[\w]+>' => 'frontend/blog/tag',
                '<category_name:[\w-]+>/<slug:[\w-]+>' => 'frontend/blog/article',
                '<slug:[\w-]+>' => 'frontend/blog/category',
            ],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['admin', 'user'],
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
