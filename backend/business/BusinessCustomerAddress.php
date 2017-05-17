<?php

namespace backend\business;

use common\business\BaseBusinessPublisher;
use common\models\CustomerAddress;


class BusinessCustomerAddress extends BaseBusinessPublisher
{

    public static function getTypes()
    {
        return [
            CustomerAddress::CUSTOMER_HOME => \Yii::t('app', 'Home'),
            CustomerAddress::CUSTOMER_COMPANY => \Yii::t('app', 'Company')
        ];
    }

    public static function getStrType($type)
    {
        $listType = self::getTypes();
        if (isset($listType[$type])) {
            return $listType[$type];
        }
        return '';
    }

}