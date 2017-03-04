<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'style/css/fonts.css',
        'style/css/spr.css',
        'style/css/theme.scss.css',
    ];
    public $js = [
        'js/libs/modernizr.min.js',
        'js/libs/currencies.js',
        'js/libs/polyfill.min.js',
        'js/libs/libs.js',
        'js/libs/script.js',
        'js/libs/slideshow.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
