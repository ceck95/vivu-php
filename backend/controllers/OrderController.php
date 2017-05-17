<?php

namespace backend\controllers;

use Yii;
use backend\business\BusinessOrder;
use backend\models\OrderSearch;
use backend\controllers\BackendBaseController;
use common\models\Order;

class OrderController extends BackendBaseController
{
    /** @var BusinessOrder */
    private $business;

    public function init()
    {
        $this->business = BusinessOrder::getInstance();
        parent::init();
    }

    public function actionListNew()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchNew(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListAccepted()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchAccepted(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListShipping()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchShipping(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListCompleted()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchCompleted(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListCancel()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchCancel(Yii::$app->request->queryParams);

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
        $postObject = $this->getPostObject('Order');
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
        $model = $this->business->findModel($id);
        $postObject = $this->getPostObject('Order');
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

    public function actionChangeStatusCancel($id)
    {
        $model = $this->business->findModel($id);
        $status = $this->business->changeStatusCommon($model, Order::ORDER_STATUS_CANCEL);
        if ($status) {
            flassSuccess('Change status cancel successfully');
            return $this->redirect(['list-new']);
        }
        return $this->redirect(['list-new']);
    }

    public function actionChangeStatusAccepted($id)
    {
        $model = $this->business->findModel($id);
        $status = $this->business->changeStatusCommon($model, Order::ORDER_STATUS_ACCEPTED);
        if ($status) {
            flassSuccess('Change status accepted successfully');
            return $this->redirect(['list-new']);
        }
        return $this->redirect(['list-new']);
    }

    public function actionChangeStatusShipping($id)
    {
        $model = $this->business->findModel($id);
        $status = $this->business->changeStatusCommon($model, Order::ORDER_STATUS_SHIPPING);
        if ($status) {
            flassSuccess('Change status shipping successfully');
            return $this->redirect(['list-accepted']);
        }
        return $this->redirect(['list-accepted']);
    }

    public function actionChangeStatusCompleted($id)
    {
        $model = $this->business->findModel($id);
        $status = $this->business->changeStatusCommon($model, Order::ORDER_STATUS_COMPLETED);
        if ($status) {
            flassSuccess('Change status completed successfully');
            return $this->redirect(['list-shipping']);
        }
        return $this->redirect(['list-shipping']);
    }

}