<?php

namespace backend\controllers;

use Yii;
use backend\business\BusinessCategory;
use backend\models\CategorySearch;
use backend\controllers\BackendBaseController;
use common\models\Category;

class CategoryController extends BackendBaseController
{
    /** @var BusinessCategory */
    private $business;

    public function init()
    {
        $this->business = BusinessCategory::getInstance();
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
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
        $model = $this->business->newModel();
        $postObject = $this->getPostObject('Category');

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

    public function actionGetListByCategoryGroupId($id = null)
    {
        $listCategory = $this->business->findListByCategoryGroup($id);

        $this->setVars([
            'categories' => $listCategory
        ]);

        $this->responseJson();
    }

    public function actionUpdate($id)
    {
        $model = $this->business->findModel($id);
        $postObject = $this->getPostObject('Category');
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