<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Box *
 * @var $form common\core\web\mvc\form\BaseActiveForm
 */
$disableInputCode = false;
if (!$model->isNewRecord){
    $disableInputCode = true;
}
?>

<div class="box-form">

    <?php $form = BaseActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Box') ?></div>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'disabled' => $disableInputCode]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn
        btn-primary']) ?>
    </div>

    <?php BaseActiveForm::end(); ?>

</div>


