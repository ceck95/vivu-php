<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 12/6/16
 * Time: 5:19 PM
 */

use common\Factory;
use common\helpers\Html;
use common\models\DesignProductGroup;
use common\models\Product;
use common\core\web\mvc\widget\BaseDetailView;
use common\core\web\mvc\form\BaseActiveForm;
use yii\widgets\Pjax;

/**
 * @var $this \common\core\web\mvc\View
 * @var $product \common\models\Product
 * @var $storedDesignProductGroups DesignProductGroup[]
 * @var $designProductGroup DesignProductGroup
 */

$this->registerJsFile('@web/js/product.js', ['depends' => [\backend\assets\AppAsset::class]]);

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Products"), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Designable Product - Groups")];

?>

<div class="product-simple-management">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span><?= Yii::t('app', 'Design Product Information'); ?></span>
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
                        class="panel-title"><?= Yii::t('app', 'Manage groups for details of this Design Product'); ?></div>
                </div>
                <div class="panel-body">
                    <?php Pjax::begin(); ?>

                    <?php if ($storedDesignProductGroups): ?>
                        <div class="productColorInfos table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?= DesignProductGroup::labelOf('name') ?></th>
                                    <th><?= DesignProductGroup::labelOf('priority') ?></th>
                                    <th><?= DesignProductGroup::labelOf('status') ?></th>
                                    <th><?= Yii::t('app', 'Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($storedDesignProductGroups as $storedDesignProductGroup) : ?>
                                    <tr>
                                        <td><?= $storedDesignProductGroup->name ?></td>
                                        <td><?= $storedDesignProductGroup->priority ?></td>
                                        <td><?= Factory::$app->formatter->asStatus($storedDesignProductGroup->status) ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-cogs"></i>', ['/product/update-design-product-group', 'designProductGroupId' => $storedDesignProductGroup->id], ['class' => 'btn btn-sm btn-primary']) ?>
                                            <?= Html::a('<i class="fa fa-trash"></i>', ['/product/delete-design-product-group', 'designProductGroupId' => $storedDesignProductGroup->id], ['class' => 'btn btn-sm btn-danger']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <hr/>
                    <?php endif; ?>

                    <h2><strong><?= Yii::t('app', 'Add new group'); ?></strong></h2>
                    <?php $form = BaseActiveForm::beginMultipart(); ?>

                    <?= $this->render('_design_product_group_form', ['form' => $form]); ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save'), [
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

