<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;
use common\models\Product;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Product
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Product Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'category_id' => ['value' => $model->category->name],
                            'name',
                            'sku',
                            'is_featured:boolean',
                            'is_special:boolean',
                            'type' => ['value' => Product::types($model->type)],
                            'desc:raw',
                            'about:raw',
                            'url_key',
                            'meta_desc',
                            'size_info:raw',
                            'warranty_note:raw',
                            'image_path:imageView',
                            'base_price:currency',
                            'is_sold_out:boolean',
                            'created_at',
                            'updated_at',
                            'created_by',
                            'updated_by',
                            'status',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
