<?php

/* @var $this yii\web\View */
/* @var $model \backend\models\LoginForm */

use common\core\web\mvc\form\BaseActiveForm;

$this->title                   = \common\Factory::$app->name.'CMS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <h1>
        <span class="white"><?= Yii::t('app', 'Login Page') ?></span>
    </h1>

    <?php $form = BaseActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Username')]) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Password')]) ?>
    <?= $form->field($model, 'rememberMe')->checkbox(['label' => Yii::t('app', 'Remember Me')]); ?>

    <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Login'); ?></button>
    <?php BaseActiveForm::end(); ?>
</div>
