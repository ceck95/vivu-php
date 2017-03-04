<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 07/12/2016
 * Time: 00:14.
 */

/**
 * @var $this \common\core\web\mvc\View
 * @var $listCategory array
 *
 */
/* @var $content string */
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use common\Factory;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) : 'CO.kool' ?></title>
    <?php $this->head() ?>
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/styles/css/fonts.css" rel="stylesheet" type="text/css" media="all">
    <link href="/styles/css/theme.scss.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="<?= Url::home(true); ?>styles/css/spr.css" media="screen">
    <script>
        // This allows to expose several variables to the global scope, to be used in scripts
        window.shop = {
            template: "index",
            currentPage: 1,
            shopCurrency: "EUR",
            moneyFormat: "\u0026euro;{{amount}}",
            moneyWithCurrencyFormat: "\u0026euro;{{amount}} EUR",
            collectionSortBy: "title-ascending"
        };

        window.features = {
            searchMode: "all"
        };

        let PARAMS_CONF = {
            cdnLink: "<?= Factory::$app->params['cdn_link']?>",
            truncateProduct: "<?= Factory::$app->params['truncate_product']?>"
            cookieName: "<?= Factory::$app->params['cookieName']?>""
        };
        let breadCrumbObject = {};
        <?php if (isset($this->params['breadcrumbs'])) :?>
            let breadCrumbItem = [];
            <?php foreach ($this->params['breadcrumbs'] as $value) :?>
                <?php if (is_array($value)) :?>
                    breadCrumbItem.push(
                        {
                            'name': '<?=$value['label'];?>',
                            'link': '<?=$value['url'][0];?>'
                        }
                    );
                <?php else:?>
                    breadCrumbItem.push('<?=$value;?>');
                <?php endif;?>
            <?php endforeach;?>
            breadCrumbObject.list = breadCrumbItem;
            breadCrumbObject.textTitle = '<?= $this->title;?>';
        <?php endif;?>
    </script>
</head>

<body class="template-index">
<?= $this->render('/partials/_icon'); ?>

<div class="page__overlay"></div>

<div class="page__container" style="position: relative;">
    <!--    Top Bar-->
    <?= $this->render('/partials/_top_bar'); ?>

    <!--    Header for Screen Mobile-->
    <?= $this->render('/partials/_header_mobile_nav'); ?>

    <div style="height: 0px; width: 0px; margin: 0px; border-spacing: 0px; border: 0px; padding: 0px; font-size: 1em; position: static; float: none;"></div>

    <?= $this->render('/partials/_header_nav'); ?>

    <main class="main" role="main">
        <?= $content ?>
    </main>

    <!--    Footer-->
    <?= $this->render('/partials/_footer'); ?>


    <!--   Form Search -->
    <div class="mega-search" style="display: none">
        <svg class="icon icon-cross">
            <use xlink:href="#icon-cross">
            </use>
        </svg>
        <form action="https://focal-standard.myshopify.com/search" method="get" class="mega-search__form" role="search">
            <input type="search" class="mega-search__input" name="q" placeholder="Search..." value=""
                   autofocus="autofocus" autocorrect="off" autocomplete="off">
            <div rv-show="loading" class="mega-search__spinner spinner" style="display: none;">
                <div class="spinner__bounce1"></div>
                <div class="spinner__bounce2"></div>
            </div>
        </form>
        <ul class="mega-search__suggestions list--unstyled">
            <!-- rivets: each-suggestion -->
        </ul>
    </div>


</div>

</body>
<script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/js/libs/modernizr.min.js" type="text/javascript"></script>
<script src="/js/libs/currencies.js" type="text/javascript"></script>
<script src="/js/libs/polyfill.min.js" type="text/javascript"></script>
<script src="/js/libs/libs.js" type="text/javascript"></script>
<script src="/js/libs/slideshow.js" type="text/javascript"></script>

<script src="/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>

<!--<script src="<?/*= Url::home(true); */?>scripts/app.js"></script>
<script src="<?/*= Url::home(true); */?>scripts/controllers/MainCtrl.js"></script>
<script src="<?/*= Url::home(true); */?>scripts/services/CommonService.js"></script>-->
</html>
<?php $this->endPage() ?>
