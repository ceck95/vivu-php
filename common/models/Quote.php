<?php

namespace common\models;

use Yii;
use common\core\web\mvc\BaseModel;

/**
 * This is the model class for table "quote".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $subtotal
 * @property integer $grand_total
 * @property string $checkout_method
 * @property integer $customer_id
 * @property integer $customer_address_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 */
class Quote extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vv.quote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'subtotal', 'grand_total', 'customer_id', 'customer_address_id', 'updated_by', 'created_by', 'status'], 'integer'],
            [['checkout_method'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            /*[['customer_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerAddress::className(), 'targetAttribute' => ['customer_address_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesOrder::className(), 'targetAttribute' => ['order_id' => 'id']],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'grand_total' => Yii::t('app', 'Grand Total'),
            'checkout_method' => Yii::t('app', 'Checkout Method'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'customer_address_id' => Yii::t('app', 'Customer Address ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
