<?php

namespace backend\business;

use Yii;
use common\models\Customer;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessCustomer extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Customer $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function update(Customer $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function save(Customer $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model);
        }
        return $status;
    }

    public function newModel()
    {
        return new Customer();
    }

    /**
    * @param $id
    * @return Customer
    * @throws \yii\web\NotFoundHttpException
    */
    public function findModel($id)
    {
        $model = Customer::findOneOrFail($id);

        return $model;
    }


}