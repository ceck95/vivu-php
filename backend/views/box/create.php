<?php

use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Box*/

$this->title = Yii::t('app', 'Create Box');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Boxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-create">

    <?= $this->render('_form') ?>

</div>
