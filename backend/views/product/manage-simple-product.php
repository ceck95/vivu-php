<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 12/6/16
 * Time: 5:19 PM
 */

use common\Factory;
use common\helpers\Html;
use common\models\ProductColor;
use common\models\Product;
use common\core\web\mvc\widget\BaseDetailView;
use common\core\web\mvc\form\BaseActiveForm;
use yii\widgets\Pjax;

/**
 * @var $this \common\core\web\mvc\View
 * @var $product \common\models\Product
 * @var $storedProductColors ProductColor[]
 */

$this->registerJsFile('@web/js/product.js', ['depends' => [\backend\assets\AppAsset::class]]);

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Products"), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Colors Management")];

?>

<div class="product-simple-management">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span><?= Yii::t('app', 'Product Information'); ?></span>
                        <?= Html::updownBtn('#productInfo', false); ?>
                    </div>
                </div>
                <div class="panel-body" id="productInfo">
                    <?= BaseDetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'image_path:imageView',
                            'name:ntext',
                            'sku:ntext',
                            'base_price:currency',
                            'type' => ['value' => Product::types($product->type)],
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div
                        class="panel-title"><?= Yii::t('app', 'Color of Product & Reference Images, Pricing...'); ?></div>
                </div>
                <div class="panel-body">
                    <?php Pjax::begin(); ?>

                    <div class="productColorInfos table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?= ProductColor::labelOf('refer_product_image_path') ?></th>
                                <th><?= ProductColor::labelOf('color_name') ?></th>
                                <th><?= ProductColor::labelOf('price') ?></th>
                                <th><?= ProductColor::labelOf('priority') ?></th>
                                <th><?= ProductColor::labelOf('is_sold_out') ?></th>
                                <th><?= ProductColor::labelOf('status') ?></th>
                                <th><?= Yii::t('app', 'Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($storedProductColors as $storedProductColor) : ?>
                                <tr>
                                    <td><?= Factory::$app->formatter->asImageView($storedProductColor->refer_product_image_path) ?></td>
                                    <td><?= $storedProductColor->color_name ?></td>
                                    <td><?= Factory::$app->formatter->asCurrency($storedProductColor->price) ?></td>
                                    <td><?= $storedProductColor->priority ?></td>
                                    <td><?= Factory::$app->formatter->asBoolean($storedProductColor->is_sold_out) ?></td>
                                    <td><?= Factory::$app->formatter->asStatus($storedProductColor->status) ?></td>
                                    <td>
                                        <?= Html::a('<i class="fa fa-edit"></i>', ['/product/update-simple-product-color', 'productColorId' => $storedProductColor->id], ['class' => 'btn btn-sm btn-primary ']) ?>
                                        <?= Html::a('<i class="fa fa-trash"></i>', ['/product/delete-simple-product-color', 'productColorId' => $storedProductColor->id], ['class' => 'btn btn-sm btn-danger']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <hr/>
                    <h2><strong><?= Yii::t('app', 'Add new color'); ?></strong></h2>
                    <?php $form = BaseActiveForm::beginMultipart(); ?>
                    <?= $this->render('_product_color_form', ['form' => $form]); ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save All'), [
                            'class' => 'btn btn-success',
                        ]) ?>
                    </div>
                    <?php BaseActiveForm::end(); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


