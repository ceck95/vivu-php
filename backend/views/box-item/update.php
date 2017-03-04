<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\BoxItem*/

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Box Item',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Box Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="box-item-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
