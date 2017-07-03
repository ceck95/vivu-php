<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;
use \common\helpers\OrderViewHelper;
use \common\models\Product;
use \common\Factory;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Order
 * @var $customerAddress \common\models\CustomerAddress
 * @var $customer \common\models\Customer
 * @var $orderItems \common\models\OrderItem[]
 */

$this->title = '#' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['list-new']];
$this->params['breadcrumbs'][] = $this->title;
$customerAddress = $model->customerAddress;
$customer = $model->customer;
$orderItems = $model->orderItems;
?>
<div class="order-view">

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
//                            'id',
                            'order_status' => [
                                'attribute' => 'order_status',
                                'value' => OrderViewHelper::displayOrderStatus($model)
                            ],
//                            'customer_id',
                            'customer_full_name:ntext',
                            'customer_phone:ntext',
//                            'quote_id',
                            'shipping_address_id' => [
                                'attribute' => 'shipping_address_id',
                                'value' => OrderViewHelper::displayCustomerAddress($model)
                            ],
                            'shipping_amount:currency',
                            'subtotal:currency',
                            'grand_total:currency',
//            'status',
                            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <?php if (isset($model->customer->attributes['id'])): ?>
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title"><?= Yii::t('app', 'Customer') ?></div>
                    </div>
                    <div class="panel-body">
                        <?= BaseDetailView::widget(['model' => $customer,
                            'attributes' => ['full_name',
                                'gender:gender',
                                'dob:date',
                                'email',
                                'phone',
                                'status'],]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Shipping Address') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget(['model' => $customerAddress,
                        'attributes' => ['customer_name',
                            'phone',
                            'full_name',
                            'type' => ['attribute' => 'type',
                                'value' => \common\helpers\CustomerAddressViewHelper::displayType($customerAddress)]],]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Cart') ?></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?= Product::labelOf('image_path') ?></th>
                                <th><?= Product::labelOf('sku') ?></th>
                                <th><?= Product::labelOf('name') ?></th>
                                <th><?= Product::labelOf('is_sold_out') ?></th>
                                <th><?= \common\models\ProductColor::labelOf('color_name') ?></th>
                                <th><?= \common\models\OrderItem::labelOf('quantity') ?></th>
                                <th><?= \common\models\OrderItem::labelOf('base_price') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orderItems as $orderItem) : ?>
                                <tr>
                                    <td><?= Factory::$app->formatter->asImageView($orderItem->product->image_path) ?></td>
                                    <td><?= $orderItem->product->sku ?></td>
                                    <td><?= $orderItem->product->name ?></td>
                                    <td><?= Factory::$app->formatter->asBoolean($orderItem->product->is_sold_out) ?></td>
                                    <td><?= Factory::$app->formatter->asText($orderItem->productColor->color_name) ?></td>
                                    <td><?= $orderItem->quantity ?></td>
                                    <td><?= Factory::$app->formatter->asCurrency($orderItem->base_price) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
