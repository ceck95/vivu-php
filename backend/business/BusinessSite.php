<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 8/9/16
 * Time: 9:50 AM
 */

namespace backend\business;


use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;
use common\models\Customer;
use common\models\Order;
use common\models\Product;
use common\modules\adminUser\models\User;
use common\modules\file\business\BusinessFile;
use phpseclib\Net\SSH1;

class BusinessSite extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function updateProfile(User $user, ObjectScalar $post)
    {
        $user->setAttributes($post->toArray());
        $status = $user->save();
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($user);
            return $status;
        }

        return false;

    }

    public function countOrderCurrent($orderStatus)
    {
        $count = Order::find()->select('count(*) as total')
            ->andWhere([
                'order_status' => $orderStatus
            ])
            ->andWhere('updated_at >= current_date')->asArray()->one();

        return $count['total'];
    }

    public function countOrderTotal($orderStatus)
    {
        $count = Order::find()->select('count(*) as total')
            ->andWhere([
                'order_status' => $orderStatus
            ])->asArray()->one();

        return $count['total'];
    }

    public function calculatorOrder()
    {
        $orderNew = $this->countOrderCurrent(Order::ORDER_STATUS_NEW);
        $orderNewTotal = $this->countOrderTotal(Order::ORDER_STATUS_NEW);
        $orderAccepted = $this->countOrderCurrent(Order::ORDER_STATUS_ACCEPTED);
        $orderAcceptedTotal = $this->countOrderTotal(Order::ORDER_STATUS_ACCEPTED);
        $orderShipping = $this->countOrderCurrent(Order::ORDER_STATUS_SHIPPING);
        $orderShippingTotal = $this->countOrderTotal(Order::ORDER_STATUS_SHIPPING);
        $orderCompleted = $this->countOrderCurrent(Order::ORDER_STATUS_COMPLETED);
        $orderCompletedTotal = $this->countOrderTotal(Order::ORDER_STATUS_COMPLETED);
        $orderCancel = $this->countOrderCurrent(Order::ORDER_STATUS_CANCEL);
        $orderCancelTotal = $this->countOrderTotal(Order::ORDER_STATUS_CANCEL);

        return [
            'orderNew' => [
                'current' => $orderNew,
                'total' => $orderNewTotal
            ],
            'orderAccepted' => [
                'current' => $orderAccepted,
                'total' => $orderAcceptedTotal
            ],
            'orderShipping' => [
                'current' => $orderShipping,
                'total' => $orderShippingTotal
            ],
            'orderCompleted' => [
                'current' => $orderCompleted,
                'total' => $orderCompletedTotal
            ],
            'orderCancel' => [
                'current' => $orderCancel,
                'total' => $orderCancelTotal
            ]
        ];
    }

    public function totalInCome()
    {
        $monthly = Order::find()->select('SUM(grand_total) as total')->andWhere("date_trunc('month', updated_at) = date_trunc('month', current_date)")->andWhere([
            'order_status' => Order::ORDER_STATUS_COMPLETED
        ])->asArray()->one();
        $total = Order::find()->select('SUM(grand_total) as total')->andWhere([
            'order_status' => Order::ORDER_STATUS_COMPLETED
        ])->asArray()->one();
        if (!$monthly['total']) {
            $monthly['total'] = 0;
        }
        return [
            'monthly' => $monthly['total'],
            'total' => $total['total']
        ];
    }

    public function totalCustomerAndOrderS()
    {
        $totalCustomer = Customer::find()->select('COUNT(*) as total')->asArray()->one();
        $totalProduct = Product::find()->select('COUNT(*) as total')->asArray()->one();

        return [
            'totalCustomer' => $totalCustomer['total'],
            'totalProduct' => $totalProduct['total']
        ];
    }

}