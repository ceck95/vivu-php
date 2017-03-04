<?php
use common\models\DesignProductDetail;
use common\Factory;
use common\helpers\Html;
use common\core\web\mvc\form\BaseActiveForm;
use common\modules\file\widgets\FileUploadWidget;
use yii\widgets\Pjax;

/**
 * @var $this common\core\web\mvc\View
 * @var $product common\models\Product
 * @var $designProductGroup common\models\DesignProductGroup
 * @var $designProductDetail common\models\DesignProductDetail
 * @var $storedDesignProductDetails DesignProductDetail[]
 */

$this->title = Yii::t('app', 'Update Deisgn Product Group:') . ' ' . $designProductGroup->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['manage-design-product', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $designProductGroup->name;
?>

<?php Pjax::begin(); ?>
<?php $form = BaseActiveForm::beginMultipart(); ?>

<div class="product-create">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Design Product Group Infos'); ?></div>
                </div>
                <div class="panel-body">
                    <?= $this->render('_design_product_group_form', ['form' => $form]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Details of this group of product'); ?></div>
                </div>
                <div class="panel-body">
                    <?php if ($storedDesignProductDetails): ?>
                        <div class="productColorInfos table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?= DesignProductDetail::labelOf('thumbnail_path') ?></th>
                                    <th><?= DesignProductDetail::labelOf('name') ?></th>
                                    <th><?= DesignProductDetail::labelOf('tag') ?></th>
                                    <th><?= DesignProductDetail::labelOf('is_default') ?></th>
                                    <th><?= DesignProductDetail::labelOf('price') ?></th>
                                    <th><?= DesignProductDetail::labelOf('is_sold_out') ?></th>
                                    <th><?= DesignProductDetail::labelOf('product_reference_image_1') ?></th>
                                    <th><?= DesignProductDetail::labelOf('product_reference_image_2') ?></th>
                                    <th><?= DesignProductDetail::labelOf('product_reference_image_3') ?></th>
                                    <th><?= Yii::t('app', 'Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($storedDesignProductDetails as $storedDesignProductDetail) : ?>
                                    <tr>
                                        <td><?= Factory::$app->formatter->asImageGrid($storedDesignProductDetail->thumbnail_path) ?></td>
                                        <td><?= $storedDesignProductDetail->name ?></td>
                                        <td><?= $storedDesignProductDetail->tag ?></td>
                                        <td><?= Factory::$app->formatter->asBoolean($storedDesignProductDetail->is_default); ?></td>
                                        <td><?= Factory::$app->formatter->asCurrency($storedDesignProductDetail->price); ?></td>
                                        <td><?= Factory::$app->formatter->asBoolean($storedDesignProductDetail->is_sold_out); ?></td>
                                        <td><?= Factory::$app->formatter->asImageGrid($storedDesignProductDetail->product_reference_image_1) ?></td>
                                        <td><?= Factory::$app->formatter->asImageGrid($storedDesignProductDetail->product_reference_image_2) ?></td>
                                        <td><?= Factory::$app->formatter->asImageGrid($storedDesignProductDetail->product_reference_image_3) ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-pencil"></i>', ['/product/update-design-product-group', 'designProductGroupId' => $designProductGroup->id, 'designProductDetailId' => $storedDesignProductDetail->id], ['class' => 'btn btn-sm btn-info']) ?>
                                            <?= Html::a('<i class="fa fa-trash"></i>', ['/product/delete-design-product-detail', 'id' => $storedDesignProductDetail->id], ['class' => 'btn btn-sm btn-danger']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                        <hr/>
                    <?php endif; ?>

                    <?php if (!Factory::$app->request->get('designProductDetailId')): ?>
                        <h3>
                            <?= Html::checkbox('isAddNewDesignProductDetail', true, ['id' => 'toggleAddNewDesignProductForm']) ?>
                            <strong><?= Yii::t('app', 'Add new design product detail'); ?></strong>
                        </h3>
                    <?php else: ?>
                        <h3><strong><?= Yii::t('app', 'Update design product detail: {detailName}', ['detailName' => $designProductDetail->name]); ?></strong></h3>
                    <?php endif; ?>

                    <div class="design-product-form">
                        <?= FileUploadWidget::widget([
                            'form' => $form,
                            'sourceModel' => $designProductDetail,
                            'attr' => 'thumbnail_path',
                            'options' => [
                                'accept' => 'image/*',
                            ],
                        ]) ?>

                        <?= $form->field($designProductDetail, 'name')->textInput(); ?>
                        <?= $form->field($designProductDetail, 'tag')->textInput(); ?>
                        <?= $form->field($designProductDetail, 'is_default')->checkbox(); ?>
                        <?= $form->field($designProductDetail, 'price', ['template' => $form->currencyTemplate])->textInput(['class' => 'touchspin2 form-control']) ?>
                        <?= $form->field($designProductDetail, 'is_sold_out')->checkbox(); ?>

                        <?= FileUploadWidget::widget([
                            'form' => $form,
                            'sourceModel' => $designProductDetail,
                            'attr' => 'product_reference_image_1',
                            'options' => [
                                'accept' => 'image/*',
                            ],
                        ]) ?>

                        <?= FileUploadWidget::widget([
                            'form' => $form,
                            'sourceModel' => $designProductDetail,
                            'attr' => 'product_reference_image_2',
                            'options' => [
                                'accept' => 'image/*',
                            ],
                        ]) ?>

                        <?= FileUploadWidget::widget([
                            'form' => $form,
                            'sourceModel' => $designProductDetail,
                            'attr' => 'product_reference_image_3',
                            'options' => [
                                'accept' => 'image/*',
                            ],
                        ]) ?>
                    </div>

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
<?php Pjax::end(); ?>

<?php $this->registerJsFile('js/product.js', ['depends' => \yii\web\JqueryAsset::class]) ?>