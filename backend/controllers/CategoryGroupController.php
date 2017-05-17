<?php

namespace backend\controllers;

use Yii;
use backend\business\BusinessCategoryGroup;
use backend\models\CategoryGroupSearch;

class CategoryGroupController extends BackendBaseController
{
    /** @var BusinessCategoryGroup */
    private $business;

    public function init()
    {
        $this->business = BusinessCategoryGroup::getInstance();
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new CategoryGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->business->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model      = $this->business->newModel();
        $postObject = $this->getPostObject('CategoryGroup');
        if (!$postObject->isEmpty()) {
            $createStatus = $this->business->create($model, $postObject);
            if ($createStatus === true) {
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionManagerCategory($id)
    {
        $categoryGroup = $this->business->findModel($id);
        $category = $this->business->newCategory($categoryGroup);

        $categoryPostData = $this->getPostObject('Category');
        if (!$categoryPostData->isEmpty()) {
            $status = $this->business->saveCategory($category, $categoryPostData);
            if ($status) {
                flassSuccess();
                return $this->refresh();
            }
            flassError();
        }

        $this->setVars([
            'categoryGroup' => $categoryGroup,
            'category' => $category,
            'storedCategories' => $this->business->findCategories($categoryGroup),
        ]);
    }

    public function actionUpdate($id)
    {
        $model      = $this->business->findModel($id);
        $postObject = $this->getPostObject('CategoryGroup');
        if (!$postObject->isEmpty()) {
            $updateStatus = $this->business->update($model, $postObject);
            if ($updateStatus === true) {
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->business->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}