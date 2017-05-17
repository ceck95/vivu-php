<?php

/**
 * @var $this common\core\web\mvc\View
 * @var $product common\models\Product
 * @var $productColor common\models\ProductColor
 * @var $productColorPreviewImage common\models\ProductColorPreviewImage
 * @var $storedPreviewImages common\models\ProductColorPreviewImage[]
 */

use common\models\ProductColorPreviewImage;
use common\Factory;
use common\helpers\Html;
use common\core\web\mvc\form\BaseActiveForm;
use common\modules\file\widgets\FileUploadWidget;

if ($product->is_product_color) {
    $this->title = Yii::t('app', 'Update Product Color:') . ' ' . $productColor->color_name;
    $this->params['breadcrumbs'][] = $productColor->color_name;
    $this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['manage-simple-product', 'id' => $product->id]];
}
$this->title = Yii::t('app', 'Update Product Color Image Previews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
?>

<?php $form = BaseActiveForm::beginMultipart(); ?>

<div class="product-create">
    <?php if ($product->is_product_color): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title"><?= Yii::t('app', 'Product Color Infos'); ?></div>
                    </div>
                    <div class="panel-body">
                        <?= $this->render('_product_color_form', ['form' => $form]); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Preview Images of product for this color'); ?></div>
                </div>
                <div class="panel-body">
                    <div class="productColorInfos table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?= ProductColorPreviewImage::labelOf('path') ?></th>
                                <th><?= ProductColorPreviewImage::labelOf('updated_at') ?></th>
                                <th><?= Yii::t('app', 'Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($storedPreviewImages as $storedPreviewImage) : ?>
                                <tr>
                                    <td><?= Factory::$app->formatter->asImageView($storedPreviewImage->image_path) ?></td>
                                    <td><?= Factory::$app->formatter->asDatetime($storedPreviewImage->updated_at) ?></td>
                                    <td>
                                        <?= Html::a('<i class="fa fa-trash"></i>', ['/product/delete-product-color-preview-image', 'id' => $storedPreviewImage->id], ['class' => 'btn btn-sm btn-danger']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                    <hr/>
                    <h4><strong><?= Yii::t('app', 'Add new preview image'); ?></strong></h4>

                    <?= FileUploadWidget::widget([
                        'form' => $form,
                        'sourceModel' => $productColorPreviewImage,
                        'attr' => 'image_path',
                        'options' => [
                            'accept' => 'image/*',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save All'), [
        'class' => 'btn btn-success',
    ]) ?>
</div>
<?php BaseActiveForm::end(); ?>
