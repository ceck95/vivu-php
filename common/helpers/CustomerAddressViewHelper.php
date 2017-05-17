<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 23/04/2017
 * Time: 07:22
 */

namespace common\helpers;


use backend\business\BusinessCustomerAddress;
use common\models\CustomerAddress;

class CustomerAddressViewHelper
{
    public static function displayType(CustomerAddress $customerAddress)
    {
        return BusinessCustomerAddress::getStrType($customerAddress->type);
    }
}