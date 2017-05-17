<?php

/* @var $this \common\core\web\mvc\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\modules\file\FileAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
FileAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>var PARAMS = <?php echo json_encode($this->jsConstants) ?></script>
    <link rel="shortcut icon" href="<?= \common\Factory::$app->getHomeUrl() ?>favicon.ico?v=1">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <?= $this->render('@backend/views/partials/_side_nav') ?>

    <div id="page-wrapper" class="gray-bg">
        <?= $this->render('@backend/views/partials/nav') ?>

        <?= Alert::widget() ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?= Html::encode($this->title) ?></h2>
                <?= Breadcrumbs::widget([
                    'tag' => 'ol',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <div class="col-lg-2">
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <?= $content ?>
        </div>

        <div class="footer">
            <div>
                <strong><?= Yii::t('app', 'Copyright'); ?></strong> <?= \common\Factory::$app->name ?> &copy; 2016-2020
            </div>
        </div>

    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
