<?php
/* @var $this yii\web\View
 * @var $order array[]
 * @var $inCome array[]
 * @var $totalCustomerAndProduct array[]
 */
use \common\utilities\Number;

$this->title = 'General Admin Dashboard';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                    <h5><?= Yii::t('app', 'Order new') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($order['orderNew']['current']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumber($order['orderNew']['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                    <h5><?= Yii::t('app', 'Order Accepted') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($order['orderAccepted']['current']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumber($order['orderAccepted']['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                    <h5><?= Yii::t('app', 'Order Shipping') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($order['orderShipping']['current']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumber($order['orderShipping']['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                    <h5><?= Yii::t('app', 'Order Completed') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($order['orderCompleted']['current']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumber($order['orderCompleted']['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                    <h5><?= Yii::t('app', 'Order Cancel') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($order['orderCancel']['current']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumber($order['orderCancel']['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Monthly') ?></span>
                    <h5><?= Yii::t('app', 'InCome') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumberCurrency($inCome['monthly']) ?></h1>
                    <div class="stat-percent font-bold text-success"><?= Number::formatNumberCurrency($inCome['total']) ?></div>
                    <small>Total</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Total') ?></span>
                    <h5><?= Yii::t('app', 'Product') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($totalCustomerAndProduct['totalProduct']) ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?= Yii::t('app', 'Total') ?></span>
                    <h5><?= Yii::t('app', 'Customer') ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= Number::formatNumber($totalCustomerAndProduct['totalCustomer']) ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
