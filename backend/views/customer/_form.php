<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Customer* @var $form common\core\web\mvc\form\BaseActiveForm
*/
?>

<div class="customer-form">

    <?php $form = BaseActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Customer') ?></div>
                </div>
                <div class="panel-body">
<?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'phone')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'full_name')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'dob')->textInput() ?>

<?= $form->field($model, 'gender')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'password_hash')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'password_reset_token')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'created_at')->textInput() ?>

<?= $form->field($model, 'updated_at')->textInput() ?>

<?= $form->field($model, 'created_by')->textInput() ?>

<?= $form->field($model, 'updated_by')->textInput() ?>

<?= $form->field($model, 'status')->dropDownList(Common::getStatusArr()) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create')        : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn
        btn-primary']) ?>
    </div>

    <?php BaseActiveForm::end(); ?>

</div>
