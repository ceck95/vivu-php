<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 21/12/2016
 * Time: 22:42
 */

namespace frontend\controllers;


class HomeController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'frontend\handler\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex()
    {
        $this->layout = 'main';
    }
}