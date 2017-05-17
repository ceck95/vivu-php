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
    <?php Pjax::begin(); ?>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function (Product $model) {
            if (count($model->productColors) === 0) {
                return ['class' => 'highlight-common'];
            } else {
                return [];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'image_path:imageGrid',
            'name:raw',
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
            'sku:raw',
            'base_price:currency',
            'is_product_color:boolean',
            'is_sold_out:boolean',
            'created_at:datetime',
            'status' => Html::getStatusSearchForIndex($searchModel),

            [
                'class' => BaseActionColumn::class,
                'template' => '{manage} {view} {update} {delete}',
                'buttons' => [
                    'manage' => function ($url, ProductSearch $model) {
                        if ($model->is_product_color) {
                            return Html::a('<i class="fa fa-cogs"></i>', [
                                'manage-simple-product',
                                'id' => $model->id
                            ], [
                                'title' => Yii::t('app', 'Manage Product Relations'),
                            ]);
                        }
                        if (count($model->productColors) > 0) {
                            return Html::a('<i class="fa fa-cogs"></i>', [
                                'update-simple-product-color',
                                'productColorId' => $model->productColors[0]->id
                            ], [
                                'title' => Yii::t('app', 'Manage Product Relations')
                            ]);
                        }
                        return null;
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
