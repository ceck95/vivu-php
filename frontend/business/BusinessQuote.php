<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 09/01/2017
 * Time: 10:20
 */

namespace frontend\business;


use common\business\BaseBusinessPublisher;
use common\models\Quote;

class BusinessQuote extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Quote $model)
    {
        $model->save($model);

        return [
            'id' => $model->id,
            'new' => true
        ];

    }

    public function findById($id)
    {

        $rawDataQuote = Quote::find()->andWhere(['id' => $id])->select('id')->asArray()->one();

        return $rawDataQuote;

    }


    public function newModel()
    {
        return new Quote;
    }

}