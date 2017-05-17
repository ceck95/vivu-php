<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\CategoryGroup*/

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Category Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="category-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
