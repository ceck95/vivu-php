<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Box*/

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Box',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Boxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="box-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
