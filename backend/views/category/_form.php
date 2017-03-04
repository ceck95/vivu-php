<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;
use backend\business\BusinessCategory;
use common\modules\file\widgets\FileUploadWidget;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Category* 
 * @var $form common\core\web\mvc\form\BaseActiveForm
 */
?>

<div class="category-form">

    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Category') ?></div>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['id' => '_name_for_slug']) ?>

                    <?= $form->field($model, 'url_key')->textInput(['id' => '_slug']) ?>

                    <?= $form->field($model, 'desc')->textarea(['class' => 'ckeditor']) ?>

                    <?= $form->field($model, 'priority')->textInput(['type' => 'number']) ?>

                    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

                    <?= FileUploadWidget::widget([
                        'form'        => $form,
                        'sourceModel' => $model,
                        'attr' => 'cover_image_path',
                        'options'     => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'for_gender')->dropDownList(BusinessCategory::forGenders()) ?>

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
