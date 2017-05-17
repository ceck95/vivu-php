<?php
use common\Factory;
use common\helpers\Html;
use common\models\Category;
use common\models\ProductColor;
use common\models\Product;
use common\core\web\mvc\widget\BaseDetailView;
use common\core\web\mvc\form\BaseActiveForm;
use yii\widgets\Pjax;

/**
 * @var $this \common\core\web\mvc\View
 * @var $categoryGroup \common\models\CategoryGroup
 * @var $storedCategories \common\models\Category[]
 */

$this->registerJsFile('@web/js/product.js', ['depends' => [\backend\assets\AppAsset::class]]);

$this->title = $categoryGroup->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Category Group"), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $categoryGroup->name];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Categories Management")];

?>

<div class="product-simple-management">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span><?= Yii::t('app', 'Category Group Information'); ?></span>
                        <?= Html::updownBtn('#categoryGroup', false); ?>
                    </div>
                </div>
                <div class="panel-body" id="categoryGroup">
                    <?= BaseDetailView::widget([
                        'model' => $categoryGroup,
                        'attributes' => [
                            'cover_image_path:imageView',
                            'name:ntext',
                            'url_key:ntext',
                            'priority'
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
                        class="panel-title"><?= Yii::t('app', 'Categories'); ?></div>
                </div>
                <div class="panel-body">
                    <?php Pjax::begin(); ?>

                    <div class="categoriesInfos table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?= Category::labelOf('cover_image_path') ?></th>
                                <th><?= Category::labelOf('name') ?></th>
                                <th><?= Category::labelOf('url_key') ?></th>
                                <th><?= Category::labelOf('priority') ?></th>
                                <th><?= Category::labelOf('notes') ?></th>
                                <th><?= Category::labelOf('status') ?></th>
                                <th><?= Yii::t('app', 'Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($storedCategories as $storeCategory) : ?>
                                <tr>
                                    <td><?= Factory::$app->formatter->asImageView($storeCategory->cover_image_path) ?></td>
                                    <td><?= $storeCategory->name ?></td>
                                    <td><?= $storeCategory->url_key ?></td>
                                    <td><?= $storeCategory->priority ?></td>
                                    <td><?= Factory::$app->formatter->asRaw($storeCategory->notes) ?></td>
                                    <td><?= Factory::$app->formatter->asStatus($storeCategory->status) ?></td>
                                    <td>
                                        <?= Html::a('<i class="fa fa-edit"></i>', ['/category/update', 'id' => $storeCategory->id], ['class' => 'btn btn-sm btn-primary ']) ?>
                                        <?= Html::a('<i class="fa fa-trash"></i>', ['/category/delete', 'id' => $storeCategory->id], ['class' => 'btn btn-sm btn-danger']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <hr/>
                    <h2><strong><?= Yii::t('app', 'Add category new'); ?></strong></h2>
                    <?php $form = BaseActiveForm::beginMultipart(); ?>
                    <?= $this->render('_form_category', ['form' => $form]); ?>
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


