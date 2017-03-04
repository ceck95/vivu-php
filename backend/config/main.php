<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'adminUser'     => [
            'class' => common\modules\adminUser\Module::class,
        ],
        'gridview' =>  [
            'class' => kartik\grid\Module::class
        ],
        'tools' => [
            'class' => common\modules\tools\Module::class,
        ],
        'file' => [
            'class' => common\modules\file\Module::class,
        ],
    ],
    'components' => [
        'user' => [
            'class' => common\modules\adminUser\components\AdminUserComponent::class,
            'identityClass' => common\modules\adminUser\models\User::class,
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => \common\core\web\BaseFormatter::class,
        ],
        'db' => [
            'enableSchemaCache' => true,
        ],

    ],
    'params' => $params,
];
