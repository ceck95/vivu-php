<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;
use backend\models\ProductSearch;
use backend\business\BusinessProduct;
use common\models\Product;
use yii\widgets\Pjax;

/* @var $this common\core\web\mvc\View */
/* @var $searchModel ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $categoryList array
 */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'image_path:imageGrid',
            'category_id' => [
                'attribute' => 'category_id',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'category_id', $categoryList, [
                    'class' => 'form-control select2',
                    'prompt' => Yii::t('app', 'All'),
                ]),
                'value' => function (ProductSearch $productSearch) {
                    return $productSearch->category ? $productSearch->category->name : null;
                },
            ],
            'name:raw',
            'sku:raw',
            'is_featured:boolean',
            'is_special:boolean',
            'type' => [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList($searchModel, 'type', Product::types(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('app', 'All')
                ]),
                'value' => function (ProductSearch $model) {
                    return BusinessProduct::types($model->type);
                }
            ],
            'base_price:currency',
            'is_sold_out:boolean',
            'created_at:datetime',
            'status' => Html::getStatusSearchForIndex($searchModel),

            [
                'class' => BaseActionColumn::class,
                'template' => '{manage} {view} {update} {delete}',
                'buttons' => [
                    'manage' => function ($url, ProductSearch $model) {
                        switch ($model->type) {
                            case Product::TYPE_SIMPLE :
                                return Html::a('<i class="fa fa-cogs"></i>', [
                                    'manage-simple-product',
                                    'id' => $model->id
                                ], [
                                    'title' => Yii::t('app', 'Manage Product Relations'),
                                ]);
                                break;
                            case Product::TYPE_DESIGN :
                                return Html::a('<i class="fa fa-cogs"></i>', [
                                    'manage-design-product',
                                    'id' => $model->id
                                ], [
                                    'title' => Yii::t('app', 'Manage Product Relations'),
                                ]);
                                break;
                            default:
                                return null;
                        }
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
