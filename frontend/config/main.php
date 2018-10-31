<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
'modules' => [
    'user' => [
        // following line will restrict access to admin controller from frontend application
        'as frontend' => 'dektrium\user\filters\FrontendFilter',
    ],
],
    'components' => [
	'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@frontend/views'
             ],
         ],
    	],
	'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
      /*  'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
         'user' => [
	'enableAutoLogin' => false,//nuevo
            'enableSession' => true,//nuevo
            'authTimeout' => 3000,//nuevo
        'identityCookie' => [
            'name'     => '_frontendIdentity',
            'path'     => '/',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        'name' => 'FRONTENDSESSID',
        'cookieParams' => [
            'httpOnly' => true,
            'path'     => '/',
        ],
	'timeout' => 3000,//nuevo
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
