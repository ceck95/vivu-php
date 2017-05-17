<?php

namespace backend\business;

use common\models\Box;
use common\modules\file\business\BusinessFile;
use common\models\BoxItem;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessBoxItem extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(BoxItem $model, ObjectScalar $requestData)
    {
        $data = $requestData->toArray();
        if (isset($data['option'])){
            $model->option = json_encode($data['option']);
            unset($data['option']);
        }
        $model->setAttributes($data);
        return $this->save($model);
    }
    
    public function update(BoxItem $model, ObjectScalar $requestData)
    {
        $data = $requestData->toArray();
        if (isset($data['option'])){
            $model->option = json_encode($data['option']);
            unset($data['option']);
        }
        $model->setAttributes($data);

        return $this->save($model);
    }
    
    public function save(BoxItem $model)
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
        return new BoxItem();
    }

    /**
    * @param $id
    * @return BoxItem
    * @throws \yii\web\NotFoundHttpException
    */
    public function findModel($id)
    {
        $model = BoxItem::findOneOrFail($id);

        return $model;
    }

    public function getBoxList($fields = null)
    {
        if (empty($fields)){
            return Box::findKeyValue(['id', 'name']);
        }
        $boxs = Box::find()->all();
        $result = null;

        /**
         * @var $boxs Box[]
         */
        foreach ($boxs as $box){
            $result[$box->id] = $box->name;
            if ($box->code == Box::CODE_OF_SLIDE_SHOW_HOME_PAGE){
                $result['slide_show_id'] = $box->id;
            }
        }
        return $result;

    }

    public function getBoxItemForSlideShow()
    {
        $box = Box::findOne(['code' => Box::CODE_OF_SLIDE_SHOW_HOME_PAGE]);
        $boxItemsSlideShow = BoxItem::find()
            ->andWhere(['box_id' => $box->id])
            ->all();
        $result = [];

        /**
         * @var $boxItemsSlideShow BoxItem[]
         */
        foreach ($boxItemsSlideShow as $boxItem){
            $result[$boxItem->id] = [
                'image' => $boxItem->image,
                'options' => json_decode($boxItem->option, true),
            ];
        }
        return $result;
    }

    /**
     * @param array $condition
     * @return \common\models\BoxItem[]
     */
    public function getBoxItemsByBox($condition = [])
    {
        $box = Box::findOneOrNew($condition)->boxItems;

        return $box;
    }

}