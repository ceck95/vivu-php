<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Order* @var $form common\core\web\mvc\form\BaseActiveForm
*/
?>

<div class="order-form">

    <?php $form = BaseActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Order') ?></div>
                </div>
                <div class="panel-body">
<?= $form->field($model, 'order_status')->textInput() ?>

<?= $form->field($model, 'customer_id')->textInput() ?>

<?= $form->field($model, 'customer_full_name')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'customer_phone')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'quote_id')->textInput() ?>

<?= $form->field($model, 'shipping_address_id')->textInput() ?>

<?= $form->field($model, 'shipping_amount')->textInput() ?>

<?= $form->field($model, 'subtotal')->textInput() ?>

<?= $form->field($model, 'grand_total')->textInput() ?>

<?= $form->field($model, 'status')->dropDownList(Common::getStatusArr()) ?>

<?= $form->field($model, 'created_at')->textInput() ?>

<?= $form->field($model, 'created_by')->textInput() ?>

<?= $form->field($model, 'updated_at')->textInput() ?>

<?= $form->field($model, 'updated_by')->textInput() ?>

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
