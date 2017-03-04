<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 09/01/2017
 * Time: 10:20
 */

namespace frontend\controllers;


use frontend\business\BusinessQuote;

class QuoteController extends BaseController
{
    /**
     * @var BusinessQuote
     */
    private $business;

    public function init()
    {
        $this->business = BusinessQuote::getInstance();
        parent::init();
    }

    public function actionGetOrCreate($id = null)
    {
        $model = $this->business->newModel();

        if ($id == 'undefined') {

            $dataResp = $this->business->create($model);

        } else {

            $dataResp = $this->business->findById($id);

        }

        $this->setVars(['quote' => $dataResp]);

        $this->responseJson();

    }

}