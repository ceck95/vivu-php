<?php

namespace backend\assets;

use common\core\web\mvc\View;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'inspinia-theme/font-awesome/css/font-awesome.min.css',
        'libs/datetimebootstrap/css/bootstrap-datetimepicker.min.css',
        'libs/select2/select2.min.css',
        'inspinia-theme/css/style.css',
        'css/common.css',
    ];
    public $js = [
        'libs/jquery-ui.js',
        'inspinia-theme/js/bootstrap.min.js',
        'inspinia-theme/js/plugins/metisMenu/jquery.metisMenu.js',
        'inspinia-theme/js/plugins/slimscroll/jquery.slimscroll.min.js',
        //flot
        'inspinia-theme/js/plugins/flot/jquery.flot.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.tooltip.min.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.spline.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.resize.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.pie.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.symbol.js',
        'inspinia-theme/js/plugins/flot/jquery.flot.time.js',
        //Peity
        'inspinia-theme/js/plugins/peity/jquery.peity.min.js',
        //Custom and plugin javascript
        'inspinia-theme/js/inspinia.js',
        'inspinia-theme/js/plugins/pace/pace.min.js',
        //Jvectormap
        'inspinia-theme/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
        'inspinia-theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        //EayPIE
        'inspinia-theme/js/plugins/easypiechart/jquery.easypiechart.js',
        //Sparkline
        'inspinia-theme/js/plugins/sparkline/jquery.sparkline.min.js',

        //chosen
//        'inspinia-theme/js/plugins/chosen/chosen.jquery.js',
        
        'libs/ckeditor/ckeditor.js',
        'libs/jquery.tmpl.min.js',
        'libs/select2/select2.full.min.js',
        'libs/notify.min.js',
        'js/admin.js',
        'js/functions.js',
    ];

    public $jsOptions = array(
        'position' => View::POS_HEAD
    );

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
