<?php

use common\helpers\Html;
use common\utilities\Common;
use common\core\web\mvc\form\BaseActiveForm;
use common\models\Product;
use common\modules\file\widgets\FileUploadWidget;

/**
 * @var $this \common\core\web\mvc\View
 * @var $model Product
 * @var $form BaseActiveForm
 * @var $categoryList
 * @var $categoryGroupList
 */
$this->registerJsFile('@web/js/product.js', ['depends' => [\backend\assets\AppAsset::class]]);
?>

<div class="product-form">

    <?php $form = BaseActiveForm::beginMultipart([
        'enableClientValidation' => true
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Product') ?></div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label"
                               for="product-category_group"><?= \common\models\Category::labelOf('category_group_id') ?></label>
                        <select class="select2 form-control category-group">
                            <option value="">Select one</option>
                            <?php foreach ($categoryGroupList as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?= $form->field($model, 'category_id')->dropDownListWithPrompt([]) ?>

                    <?= $form->field($model, 'name')->textInput(['id' => '_name_for_slug']) ?>

                    <?= $form->field($model, 'url_key')->textInput(['id' => '_slug']) ?>

                    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'details')->textarea(['class' => 'ckeditor']) ?>

                    <?= FileUploadWidget::widget([
                        'form' => $form,
                        'sourceModel' => $model,
                        'attr' => 'image_path',
                        'options' => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'base_price', ['template' => $form->currencyTemplate])->textInput(['class' => 'touchspin2 form-control']) ?>

                    <?= $form->field($model, 'notes')->textInput() ?>

                    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

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
