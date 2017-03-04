<?php

namespace frontend\controllers;

use backend\business\BusinessArticle;
use common\Factory;

class BlogController extends BaseController
{
    /** @var BusinessArticle */
    private $business;

    public function init()
    {
        $this->layout = 'home-page';
        $this->business = BusinessArticle::getInstance();
        parent::init();
    }

    public function actionNews()
    {
        $this->setVars(['boxItemsForBlogArticles' => $this->business->getArticles([], 12)]);
    }
    public function actionView($id)
    {
        $model = $this->business->findModel($id);
        if ($model){
            $session = Factory::$app->session;
            //Check session of client to update number view
            if (empty($session->get('view-id'. $model->id))){
                $this->business->updateNumberView($model);
                $session->set('view-id'. $model->id, true);
                //set Time to life this session is: 1 hour
                $session->setTimeout(3600);
            }
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }


}