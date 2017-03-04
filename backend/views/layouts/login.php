<?php

/* @var $this \common\core\web\mvc\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= \common\Factory::$app->language ?>" data-sbro-popup-lock="true" data-sbro-deals-lock="true" data-sbro-ads-lock="true">
<head>
    <meta charset="<?= \common\Factory::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::t('app', 'Admin Login page') ?></title>
    <script>var PARAMS = <?php echo json_encode($this->jsConstants) ?></script>
    <link rel="shortcut icon" href="/favicon.ico?v=1">
    <?php $this->head() ?>
</head>
<body style="background-color: #1d2024">
<?php $this->beginBody() ?>

<div id="page-wrapper" style="margin: 0 auto; max-width: 400px;">
    <?= Alert::widget() ?>
    <?= $content ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
