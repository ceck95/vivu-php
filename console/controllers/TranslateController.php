<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 10/10/2016
 * Time: 16:40
 */

namespace console\controllers;
use \yii\console\controllers\MessageController;

class TranslateController extends MessageController
{
    public function actionExtract($configFile = '@app/config/i18n.php')
    {
        return parent::actionExtract($configFile);
    }
}