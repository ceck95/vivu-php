<?php

namespace frontend\handler;
/**
 * Created by dinhty.luu@gmail.com
 * Date: 26/12/2016
 * Time: 10:52
 */

class ErrorAction extends \yii\web\ErrorAction
{
    public function run()
    {
        $this->controller->layout = 'home-page';
        return parent::run();
    }
}