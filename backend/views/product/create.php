<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Product*/

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
