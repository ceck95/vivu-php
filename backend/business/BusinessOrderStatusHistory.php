<?php

namespace backend\business;

use common\models\OrderStatusHistory;
use common\modules\file\business\BusinessFile;
use Yii;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessOrderStatusHistory extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(OrderStatusHistory $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function save(OrderStatusHistory $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model);
        }
        return $status;
    }

}