<?php
use common\core\web\mvc\form\BaseActiveForm;
use common\modules\file\widgets\FileUploadWidget;
use common\utilities\Common;

/**
 * @var $this \common\core\web\mvc\View
 * @var $category \common\models\Category
 * @var $form BaseActiveForm
 */

?>

<?= $form->field($category, 'name')->textInput(['id' => '_name_for_slug']) ?>

<?= $form->field($category, 'url_key')->textInput(['id' => '_slug']) ?>

<?= $form->field($category, 'priority')->textInput(['type' => 'number']) ?>

<?= $form->field($category, 'notes')->textInput() ?>

<?= $form->field($category, 'meta_desc')->textInput() ?>

<?= FileUploadWidget::widget([
    'form'        => $form,
    'sourceModel' => $category,
    'attr' => 'cover_image_path',
    'options'     => [
        'accept' => 'image/*',
    ],
]) ?>

<?= $form->field($category, 'status')->dropDownList(Common::getStatusArr()) ?>