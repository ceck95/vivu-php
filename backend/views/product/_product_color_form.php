<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 12/21/16
 * Time: 8:05 PM
 */
use common\core\web\mvc\form\BaseActiveForm;
use common\modules\file\widgets\FileUploadWidget;
use common\models\ProductColor;

/**
 * @var $this \common\core\web\mvc\View
 * @var $productColor ProductColor
 * @var $form BaseActiveForm
 */

?>

<?= FileUploadWidget::widget([
    'form' => $form,
    'sourceModel' => $productColor,
    'attr' => 'refer_product_image_path',
    'options' => [
        'accept' => 'image/*',
    ],
]) ?>

<?= $form->field($productColor, 'color_name')->textInput(); ?>
<?= $form->field($productColor, 'price', ['template' => $form->currencyTemplate])->textInput(['class' => 'touchspin2 form-control']) ?>
<?= $form->field($productColor, 'is_sold_out')->checkbox(); ?>
