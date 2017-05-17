<?php

namespace backend\business;

use common\models\Category;
use common\modules\file\business\BusinessFile;
use Yii;
use common\models\CategoryGroup;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;


class BusinessCategoryGroup extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function findCategoryGroupList($fields = ['id', 'name'])
    {
        return CategoryGroup::findKeyValue($fields);
    }

    public function create(CategoryGroup $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function update(CategoryGroup $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function save(CategoryGroup $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model, [], ['cover_image_path' => $model->name]);
        }
        return $status;
    }

    public function newModel()
    {
        return new CategoryGroup();
    }

    public function newCategory(CategoryGroup $categoryGroup){
        return new Category([
           'category_group_id'=>$categoryGroup->id,
            'priority'=>count($this->findCategories($categoryGroup)) + 1
        ]);
    }

    public function findCategories(CategoryGroup $categoryGroup){
        return $categoryGroup->categories;
    }

    public function saveCategory(Category $category,ObjectScalar $postData){
        $category->setAttributes($postData->toArray());
        $status = $category->save();
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($category, [], ['cover_image_path' => $category->name]);
        }
        return $status;
    }

    /**
    * @param $id
    * @return CategoryGroup
    * @throws \yii\web\NotFoundHttpException
    */
    public function findModel($id)
    {
        $model = CategoryGroup::findOneOrFail($id);

        return $model;
    }


}