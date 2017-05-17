<?php

namespace backend\business;

use common\models\CategoryGroup;
use common\modules\file\business\BusinessFile;
use common\utilities\ArraySimple;
use Yii;
use common\models\Category;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessCategory extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public function create(Category $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function update(Category $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function save(Category $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {

            BusinessFile::getInstance()->doUploadAndSave($model, [], ['image_path' => $model->name]);
        }
        return $status;
    }

    public function newModel()
    {
        $priority = Category::getCount();
        return new Category(['priority' => $priority + 1]);
    }

    public function findModel($id): Category
    {
        $model = Category::findOneOrFail($id);

        return $model;
    }

    public function findCategoryList($fields = ['id', 'name'])
    {
        return Category::findKeyValue($fields);
    }

    public function findListByCategoryGroup($id = null, $fields = ['id', 'name'])
    {
        return Category::find()->select($fields)->andWhere(['category_group_id' => $id])->asArray()->all();
    }

    public function findAllJoinCategoryGroup()
    {
        return CategoryGroup::find()->joinWith('categories')->asArray()->all();
    }

}