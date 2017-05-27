<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;
use common\models\Order;
use \common\helpers\OrderViewHelper;

/**
 * @var $this common\core\web\mvc\View
 * @var $searchModel " . ltrim($generator->searchModelClass, '\\')
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/order.js', ['depends' => [\backend\assets\AppAsset::class]]);
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
            'order_status' => [
                'attribute' => 'order_status',
                'value' => function (Order $order) {
                    return OrderViewHelper::displayOrderStatus($order);
                },
                'filter' => false

            ],
//            'customer_id',
            'customer_full_name' => [
                'attribute' => 'customer_full_name',
                'format' => 'text',
                'value' => function (Order $order) {
                    return OrderViewHelper::displayCustomerFullName($order);
                }
            ],
            'customer_phone' => [
                'attribute' => 'customer_phone',
                'format' => 'text',
                'value' => function (Order $order) {
                    return OrderViewHelper::displayCustomerPhone($order);
                }
            ],
            // 'quote_id',
            // 'shipping_address_id',
//             'shipping_amount',
//             'subtotal',
            'grand_total:currency',
//            'status' => Html::getStatusSearchForIndex($searchModel),
            'created_at' => [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filterOptions' => [
                    'class' => 'render-datetimepicker'
                ]
            ],
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
                'class' => BaseActionColumn::class,
                'contentOptions' => ['class' => 'action-second'],
                'template' => '{view} {accepted} {cancel} {shipping} {completed}',
                'buttons' => [
                    'accepted' => function ($url, Order $model) {
                        if ($model->order_status == Order::ORDER_STATUS_NEW) {
                            return Html::a('<i class="fa fa-check"></i>', [
                                'change-status-accepted',
                                'id' => $model->id
                            ], [
                                'change' => 'accepted'
                            ]);
                        }

                    },
                    'cancel' => function ($url, Order $model) {
                        if ($model->order_status == Order::ORDER_STATUS_NEW) {
                            return Html::a('<i class="fa fa-ban"></i>', [
                                'change-status-cancel',
                                'id' => $model->id
                            ], [
                                'change' => 'cancel'
                            ]);
                        }
                    },
                    'shipping' => function ($url, Order $model) {
                        if ($model->order_status == Order::ORDER_STATUS_ACCEPTED) {
                            return Html::a('<i class="fa fa-truck"></i>', [
                                'change-status-shipping',
                                'id' => $model->id
                            ], [
                                'data-order-status' => $model->order_status,
                                'change' => 'shipping'
                            ]);
                        }
                    },
                    'completed' => function ($url, Order $model) {
                        if ($model->order_status == Order::ORDER_STATUS_SHIPPING) {
                            return Html::a('<i class="fa fa-check-circle-o"></i>', [
                                'change-status-completed',
                                'id' => $model->id
                            ], [
                                'data-order-status' => $model->order_status,
                                'change' => 'completed'
                            ]);
                        }

                    }
                ]
            ],
        ],
    ]); ?>
</div>
