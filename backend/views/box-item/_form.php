<?php

use common\helpers\Html;
use common\modules\file\widgets\FileUploadWidget;
use common\core\web\mvc\form\BaseActiveForm;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\BoxItem
 * @var $form common\core\web\mvc\form\BaseActiveForm
 * @var $boxList array
 * @var $slide_show_id string
 */
$optionConfig = ['class' => 'input-not-slide-show', 'disabled' => false];
if ($model->id == $slide_show_id) {
    $optionConfig = ['class' => 'input-not-slide-show', 'disabled' => true];
}
$option = json_decode($model->option, true);
$selected = [null, null, null];
if (isset($option['position'])) {
    $selected[(int)$option['position']] = 'selected';
}
$this->registerJsFile('@web/js/box-items.js', ['depends' => [\backend\assets\AppAsset::class]]);
?>
<div class="box-item-form">

    <?php $form = BaseActiveForm::beginMultipart(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Box Item') ?></div>
                </div>
                <div class="panel-body form-box-item">
                    <?= $form->field($model, 'box_id')->dropDownListWithPrompt($boxList, ['slide-show-id' => $slide_show_id, 'id' => 'box-id']) ?>

                    <div class="not-slide-show <?= $model->box_id != $slide_show_id ? null : 'hidden'; ?>">
                        <?= $form->field($model, 'link')->textInput($optionConfig)
                            ->label($model::labelOf('link')) ?>

                        <?= $form->field($model, 'text')->textarea($optionConfig += ['rows' => 6])
                            ->label($model::labelOf('text')) ?>
                    </div>
                    <div class="option-for-slide-show <?= $model->box_id == $slide_show_id ? null : 'hidden'; ?>">
                        <div class="form-group">
                            <?= Html::label(Yii::t('app', 'Small Text')); ?>
                            <?= Html::input('text', $model->formName() . '[option][small-text]', isset($option['small-text']) ? $option['small-text'] : null, ['class' => 'form-control for-slide-show']); ?>
                        </div>

                        <div class="form-group">
                            <?= Html::label(Yii::t('app', 'Large Text')); ?>
                            <?= Html::input('text', $model->formName() . '[option][large-text]', isset($option['large-text']) ? $option['large-text'] : null, ['class' => 'form-control for-slide-show']); ?>
                        </div>

                        <div class="form-group">
                            <?= Html::label(Yii::t('app', 'Button Text')); ?>
                            <?= Html::input('text', $model->formName() . '[option][button-text]', isset($option['button-text']) ? $option['button-text'] : null, ['class' => 'form-control for-slide-show']); ?>
                        </div>

                        <div class="form-group">
                            <?= Html::label(Yii::t('app', 'Button Link')); ?>
                            <?= Html::input('text', $model->formName() . '[option][button-link]', isset($option['button-link']) ? $option['button-link'] : null, ['class' => 'form-control for-slide-show']); ?>
                        </div>

                        <div class="form-group">
                            <?= Html::label(Yii::t('app', 'Position')); ?>
                            <select class="form-control for-slide-show"
                                    name="<?= $model->formName() . '[option][position]'; ?>">
                                <option value="0" <?= $selected[0]; ?>>Center</option>
                                <option value="1" <?= $selected[1]; ?>>Left</option>
                                <option value="2" <?= $selected[2]; ?>>Right</option>
                            </select>
                        </div>
                    </div>

                    <?= FileUploadWidget::widget([
                        'form' => $form,
                        'sourceModel' => $model,
                        'attr' => 'image',
                        'options' => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                    <?= $form->field($model, 'priority')->textInput(['type' => 'number']) ?>

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
