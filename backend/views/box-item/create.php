<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\BoxItem*/

$this->title = Yii::t('app', 'Create Box Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Box Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
