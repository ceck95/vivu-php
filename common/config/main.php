<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout' => 1200,
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'view' => [
            'class' => common\core\web\mvc\View::class,
        ],
        'errorHandler' => [
            'class' => common\core\web\ErrorHandler::class,
        ],
//        'db' => [
//            'charset' => 'utf8',
//            'enableSchemaCache' => true,
//        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'systemSetting' => [
            'class' => common\modules\systemSetting\Module::class,
        ],
    ]

];
