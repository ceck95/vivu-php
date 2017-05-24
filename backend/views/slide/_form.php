<?php

use common\helpers\Html;
use common\modules\file\widgets\FileUploadWidget;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Slide*
 * @var $form common\core\web\mvc\form\BaseActiveForm
 */
?>

<div class="slide-form">

    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Slide') ?></div>
                </div>
                <div class="panel-body">
                    <?= FileUploadWidget::widget([
                        'form' => $form,
                        'sourceModel' => $model,
                        'attr' => 'image',
                        'options' => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'link')->textInput() ?>

                    <?= $form->field($model, 'priority')->textInput() ?>

                    <?= $form->field($model, 'status')->dropDownList(Common::getStatusArr()) ?>

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
