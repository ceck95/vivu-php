<?php

/* @var $this \common\core\web\mvc\View */
/* @var $content string */

use common\helpers\Html;
use common\Factory;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html ng-app="app" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) : null ?></title>
    <?php $this->head() ?>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="styles/products/fonts.css">
    <link rel="stylesheet" type="text/css" href="styles/products/main.css">
    <link type="text/css" rel="stylesheet" href="styles/products/olark.css?http">
    <link rel="stylesheet" type="text/css" href="styles/products/styles.css">
    <link rel="stylesheet" media="print" href="styles/products/print.css">

    <link href="styles/css/fonts.css" rel="stylesheet" type="text/css" media="all">
    <link href="styles/css/theme.scss.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="styles/css/spr.css" media="screen">

    <script>
        let PARAMS_CONF = {
            cdnLink: "<?= Factory::$app->params['cdn_link']?>",
            truncateProduct:"<?= Factory::$app->params['truncate_product']?>"
        }

    </script>
</head>
<body>
<div class="template-index" ng-controller="MainCtrl">
    <div ng-include="'views/components/_icon.html'"></div>
    <div class="page__overlay"></div>

    <div class="page__container" style="position: relative;">

        <div ng-bind-html="pagePartials.top_bar"></div>

        <div ng-bind-html="pagePartials.header_mobile"></div>

        <div ng-include="'views/partials/_header_nav.html'"></div>

        <main class="main" role="main" style="margin-top: 17.5rem">
            <div class="container">
                <div ng-view>

                </div>

        </main>

        <div ng-bind-html="pagePartials.footer"></div>
    </div>
</div>

</body>
<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/libs/modernizr.min.js" type="text/javascript"></script>
<script src="js/libs/polyfill.min.js" type="text/javascript"></script>
<script src="js/libs/libs.js" type="text/javascript"></script>
<script src="js/libs/slideshow.js" type="text/javascript"></script>

<script src="bower_components/angular/angular.js"></script>
<script src="bower_components/angular-cookies/angular-cookies.js"></script>
<script src="bower_components/angular-route/angular-route.js"></script>
<script src="bower_components/angular-animate/angular-animate.js"></script>
<script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
<script src="bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="bower_components/angular-nicescroll/angular-nicescroll.js"></script>
<script src="bower_components/angular-click-outside/clickoutside.directive.js"></script>
<script src="bower_components/angular-truncate/src/truncate.js"></script>

<script src="scripts/app.js"></script>
<script src="scripts/factory/QuantityFactory.js"></script>
<script src="scripts/factory/SlideImageFactory.js"></script>
<script src="scripts/controllers/MainCtrl.js"></script>
<script src="scripts/controllers/ProductCtrl.js"></script>
<script src="scripts/services/ProductService.js"></script>
<script src="scripts/services/CommonService.js"></script>
<script src="scripts/controllers/ProductDetailCtrl.js"></script>
<script src="scripts/controllers/DesignProductCtrl.js"></script>
<script src="scripts/services/DesignProductService.js"></script>
<script src="scripts/controllers/CartCtrl.js"></script>
</html>
<?php $this->endPage() ?>
