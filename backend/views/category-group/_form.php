<?php

use common\helpers\Html;
use common\modules\file\widgets\FileUploadWidget;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;

/**
 * @var $this \common\core\web\mvc\View
 * @var $model \common\models\CategoryGroup
 * @var $form BaseActiveForm
 */
?>

<div class="category-group-form">

    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Category Group') ?></div>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['id' => '_name_for_slug']) ?>

                    <?= $form->field($model, 'url_key')->textInput(['id' => '_slug']) ?>

                    <?= $form->field($model, 'priority')->textInput(['type' => 'number']) ?>

                    <?= $form->field($model, 'notes')->textInput() ?>

                    <?= $form->field($model, 'meta_desc')->textInput() ?>

                    <?= FileUploadWidget::widget([
                        'form'        => $form,
                        'sourceModel' => $model,
                        'attr' => 'cover_image_path',
                        'options'     => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'show_page_home')->checkbox() ?>

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
