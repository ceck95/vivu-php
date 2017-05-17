<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $order_status
 * @property string $notes
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class OrderStatusHistory extends BaseModel
{
    public static function tableName()
    {
        return 'vv.order_status_history';
    }

    public function rules()
    {
        return [
            [['order_id', 'order_status'], 'required'],
            [['order_id', 'order_status', 'status', 'created_by', 'updated_by'], 'integer'],
            [['notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'order_id' => Yii::t('app', 'Order'),
                'order_status' => Yii::t('app', 'Order Status'),
                'notes' => Yii::t('app', 'Notes'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
