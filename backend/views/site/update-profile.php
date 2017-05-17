<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 8/9/16
 * Time: 9:39 AM
 */

use common\core\web\mvc\form\BaseActiveForm;
use common\modules\file\widgets\FileUploadWidget;
use common\helpers\Html;

/**
 * @var $this \common\core\web\mvc\View
 * @var $model \common\modules\adminUser\models\User
 */

$this->title = Yii::t('app', 'Update your profile');
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-form">
    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= FileUploadWidget::widget([
        'form'        => $form,
        'sourceModel' => $model,
        'attr'        => 'avatar',
        'options'     => [
            'accept' => 'image/*',
        ]
    ]) ?>
    
    <?= $form->field($model, 'dob')->dateInput(); ?>

    <?= $form->field($model, 'fullname')->textInput() ?>
    
    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php BaseActiveForm::end(); ?>
</div>
