<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;
use common\models\Product;
use common\modules\file\widgets\FileUploadWidget;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Product
 * @var $form common\core\web\mvc\form\BaseActiveForm
 * @var $categoryList
 */
?>

<div class="product-form">

    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Product') ?></div>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'category_id')->dropDownListWithPrompt($categoryList) ?>

                    <?= $form->field($model, 'name')->textInput(['id' => '_name_for_slug']) ?>

                    <?= $form->field($model, 'url_key')->textInput(['id' => '_slug']) ?>

                    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'is_featured')->checkbox() ?>

                    <?= $form->field($model, 'is_special')->checkbox() ?>

                    <?= $form->field($model, 'type')->dropDownList(Product::types()) ?>

                    <?= $form->field($model, 'desc')->textarea(['class' => 'ckeditor']) ?>

                    <?= $form->field($model, 'about')->textarea(['class' => 'ckeditor']) ?>

                    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'size_info')->textarea(['class' => 'ckeditor']) ?>

                    <?= $form->field($model, 'warranty_note')->textarea(['class' => 'ckeditor']) ?>

                    <?= FileUploadWidget::widget([
                        'form'        => $form,
                        'sourceModel' => $model,
                        'attr' => 'image_path',
                        'options'     => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'base_price', ['template' => $form->currencyTemplate])->textInput(['class' => 'touchspin2 form-control']) ?>

                    <?= $form->field($model, 'is_sold_out')->checkbox() ?>

                    <?= $form->field($model, 'status')->dropDownList(Common::getStatusArr()) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

    <?php BaseActiveForm::end(); ?>

</div>
