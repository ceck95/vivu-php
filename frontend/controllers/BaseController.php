<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 10/21/16
 * Time: 10:27 AM
 */

namespace frontend\controllers;


use common\controllers\CommonBaseController;
use common\Factory;
use backend\business\BusinessCategory;

class BaseController extends CommonBaseController
{
    public function beforeAction($action)
    {
        $view = Factory::$app->view;
        $view->globalParams['listCategory'] = BusinessCategory::getInstance()->getAllCategoryByForGender();
        return parent::beforeAction($action);
    }

    public function actionGetPagePartials()
    {
        $view = Factory::$app->view;
        $this->setVars([
            'header' => [
                'listCategory' => isset($view->globalParams['listCategory']) ? $view->globalParams['listCategory'] :
                    BusinessCategory::getInstance()->getAllCategoryByForGender()
            ],
            'footer' => $this->renderPartial('/partials/_footer'),
            'icon' => $this->renderPartial('/partials/_icon'),
            'top_bar' => $this->renderPartial('/partials/_top_bar'),
            'header_mobile' => $this->renderPartial('/partials/_header_mobile_nav'),
        ]);
        $this->responseJson();
    }
}
