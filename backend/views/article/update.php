<?php

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Article*/

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Article',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
