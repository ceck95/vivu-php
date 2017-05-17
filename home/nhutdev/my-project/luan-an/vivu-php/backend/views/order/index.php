<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;

/**
* @var $this common\core\web\mvc\View
* @var $searchModel " . ltrim($generator->searchModelClass, '\\')
* @var $dataProvider yii\data\ActiveDataProvider 
*/

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_status',
            'customer_id',
            'customer_full_name:ntext',
            'customer_phone:ntext',
            // 'quote_id',
            // 'shipping_address_id',
            // 'shipping_amount',
            // 'subtotal',
            // 'grand_total',
            'status' => Html::getStatusSearchForIndex($searchModel),
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => BaseActionColumn::class],
        ],
    ]); ?>
</div>
