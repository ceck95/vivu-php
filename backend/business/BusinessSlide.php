<?php

namespace backend\business;

use common\modules\file\business\BusinessFile;
use Yii;
use common\models\Slide;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessSlide extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Slide $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function update(Slide $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function save(Slide $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model, [], ['image' => $model->id . time()]);
        }
        return $status;
    }

    public function newModel()
    {
        $priority = Slide::getCount();
        return new Slide(['priority' => $priority + 1]);
    }

    /**
     * @param $id
     * @return Slide
     * @throws \yii\web\NotFoundHttpException
     */
    public function findModel($id)
    {
        $model = Slide::findOneOrFail($id);

        return $model;
    }


}