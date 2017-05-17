<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 22/04/2017
 * Time: 11:11
 */

namespace common\helpers;


use backend\business\BusinessOrder;
use common\models\CustomerAddress;
use common\models\Order;

class OrderViewHelper
{
    public static function displayCustomerFullName(Order $order)
    {
        if (!empty($order->customer_full_name)) {
            return $order->customer_full_name;
        }
        return $order->customerAddress->customer_name;
    }

    public static function displayCustomerPhone(Order $order)
    {
        if (!empty($order->customer_phone)) {
            return $order->customer_phone;
        }
        return $order->customerAddress->phone;
    }

    public static function displayOrderStatus(Order $order)
    {
        return BusinessOrder::getStrOrderStatus($order->order_status);
    }

    public static function displayCustomerAddress(Order $order)
    {
        return $order->customerAddress->full_name;
    }
}