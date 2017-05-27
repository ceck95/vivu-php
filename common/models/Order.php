<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $order_status
 * @property integer $customer_id
 * @property string $customer_full_name
 * @property string $customer_phone
 * @property integer $quote_id
 * @property integer $shipping_address_id
 * @property double $shipping_amount
 * @property double $subtotal
 * @property double $grand_total
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $code
 *
 * @property Customer $customer
 * @property CustomerAddress $customerAddress
 * @property OrderItem[] $orderItems
 * @property OrderPayment $orderPayment
 * @property OrderStatusHistory $orderStatusHistory
 */
class Order extends BaseModel
{

    const ORDER_STATUS_NEW = 0;
    const ORDER_STATUS_ACCEPTED = 1;
    const ORDER_STATUS_SHIPPING = 2;
    const ORDER_STATUS_PAID = 3;
    const ORDER_STATUS_PAID_ONLINE = 4;
    const ORDER_STATUS_COMPLETED = 5;
    const ORDER_STATUS_CANCEL = 6;
    const ORDER_STATUS_UNPAID_ONLINE = 7;
    const ORDER_STATUS_UNPAID = 8;

    public static function tableName()
    {
        return 'vv.sales_order';
    }

    public function rules()
    {
        return [
            [['order_status', 'quote_id', 'shipping_address_id', 'shipping_amount', 'subtotal', 'grand_total'], 'required'],
            [['order_status', 'customer_id', 'quote_id', 'shipping_address_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['customer_full_name','code', 'customer_phone'], 'string'],
            [['shipping_amount', 'subtotal', 'grand_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['shipping_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerAddress::className(), 'targetAttribute' => ['shipping_address_id' => 'id']],
            [['quote_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quote::className(), 'targetAttribute' => ['quote_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
            'order_status' => Yii::t('app', 'Order Status'),
            'customer_id' => Yii::t('app', 'Customer'),
            'customer_full_name' => Yii::t('app', 'Customer Full Name'),
            'customer_phone' => Yii::t('app', 'Customer Phone'),
            'quote_id' => Yii::t('app', 'Quote'),
            'shipping_address_id' => Yii::t('app', 'Shipping Address'),
            'shipping_amount' => Yii::t('app', 'Shipping Amount'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'grand_total' => Yii::t('app', 'Grand Total'),
            'code'=>Yii::t('app','Code')
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getCustomerAddress()
    {
        return $this->hasOne(CustomerAddress::className(), ['id' => 'shipping_address_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function getOrderPayment()
    {
        return $this->hasOne(OrderPayment::className(), ['order_id' => 'id']);
    }

    public function getOrderStatusHistories()
    {
        return $this->hasMany(OrderStatusHistory::className(), ['order_id' => 'id']);
    }

}
