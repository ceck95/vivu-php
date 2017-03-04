<?php

namespace backend\controllers;

use Yii;
use backend\business\BusinessBoxItem;
use backend\models\BoxItemSearch;
use yii\filters\VerbFilter;

class BoxItemController extends BackendBaseController
{
    /** @var BusinessBoxItem */
    private $business;

    public function init()
    {
        $this->business = BusinessBoxItem::getInstance();
        parent::init();
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new BoxItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $boxList    = $this->business->getBoxList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'boxList' => $boxList->toArray(),
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
        $postObject = $this->getPostObject('BoxItem');
        if (!$postObject->isEmpty()) {
            $createStatus = $this->business->create($model, $postObject);
            if ($createStatus === true) {
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }
        $boxList    = $this->business->getBoxList(true);
        $slideShowId = null;
        if (isset($boxList['slide_show_id'])){
            $slideShowId = $boxList['slide_show_id'];
            unset($boxList['slide_show_id']);
        }
        return $this->render('create', [
            'model' => $model,
            'boxList' => $boxList,
            'slide_show_id' => $slideShowId
        ]);
    }

    public function actionUpdate($id)
    {
        $model      = $this->business->findModel($id);
        $postObject = $this->getPostObject('BoxItem');
        if (!$postObject->isEmpty()) {
            $updateStatus = $this->business->update($model, $postObject);
            if ($updateStatus === true) {
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }
        $boxList    = $this->business->getBoxList(true);
        $slideShowId = null;
        if (isset($boxList['slide_show_id'])){
            $slideShowId = $boxList['slide_show_id'];
            unset($boxList['slide_show_id']);
        }
        return $this->render('update', [
            'model' => $model,
            'boxList' => $boxList,
            'slide_show_id' => $slideShowId
        ]);
    }

    public function actionDelete($id)
    {
        $this->business->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}