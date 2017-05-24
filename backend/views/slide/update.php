<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Slide*/

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Slide',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slide-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
