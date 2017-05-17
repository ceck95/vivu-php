<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;

/**
* @var $this common\core\web\mvc\View
* @var $model common\models\Order*/

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Order Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'order_status',
            'customer_id',
            'customer_full_name:ntext',
            'customer_phone:ntext',
            'quote_id',
            'shipping_address_id',
            'shipping_amount',
            'subtotal',
            'grand_total',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
                    ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
