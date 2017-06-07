<?php

namespace backend\controllers;

use Yii;
use backend\business\BusinessCustomer;
use backend\models\CustomerSearch;
use backend\controllers\BackendBaseController;
use common\models\Customer;

class CustomerController extends BackendBaseController
{
    /** @var BusinessCustomer */
    private $business;

    public function init()
    {
        $this->business = BusinessCustomer::getInstance();
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
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
        $postObject = $this->getPostObject('Customer');
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

    public function actionUpdate($id)
    {
        $model      = $this->business->findModel($id);
        $postObject = $this->getPostObject('Customer');
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