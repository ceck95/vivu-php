<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => \common\core\web\overrides\gii\generators\BaseCrudGenerator::class,
                'templates' => [
                    'default' =>  APPROOT .'/common/core/web/overrides/gii/crud/default',
                ],
            ],
            'model' => [
                'class' => \yii\gii\generators\model\Generator::class,
                'templates' => [
                    'default' => APPROOT .'/common/core/web/overrides/gii/model/default',
                ],
            ]
        ]
    ];
}

return $config;
