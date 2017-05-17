<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $order_id
 * @property string $method
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class OrderPayment extends BaseModel
{
    public static function tableName()
    {
        return 'vv.order_payment';
    }

    public function rules()
    {
        return [
            [['order_id', 'method'], 'required'],
            [['order_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['method'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => VvSalesOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'order_id' => Yii::t('app', 'Order'),
                'method' => Yii::t('app', 'Method'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
