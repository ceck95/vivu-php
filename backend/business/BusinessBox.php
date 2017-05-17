<?php

namespace backend\business;

use Yii;
use common\models\Box;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;
use common\modules\file\business\BusinessFile;

class BusinessBox extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Box $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function update(Box $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function save(Box $model)
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
        return new Box();
    }

    /**
    * @param $id
    * @return Box
    * @throws \yii\web\NotFoundHttpException
    */
    public function findModel($id)
    {
        $model = Box::findOneOrFail($id);

        return $model;
    }


}