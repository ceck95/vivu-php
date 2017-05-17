<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $quote_item_id
 * @property integer $product_id
 * @property integer $selected_product_color_id
 * @property integer $quantity
 * @property double $base_price
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Order $order
 * @property QuoteItem $quoteItem
 * @property Product $product
 * @property ProductColor $productColor
 */
class OrderItem extends BaseModel
{
    public static function tableName()
    {
        return 'vv.order_item';
    }

    public function rules()
    {
        return [
            [['order_id', 'quote_item_id', 'product_id', 'selected_product_color_id', 'quantity', 'base_price'], 'required'],
            [['order_id', 'quote_item_id', 'product_id', 'selected_product_color_id', 'quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['base_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['selected_product_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductColor::className(), 'targetAttribute' => ['selected_product_color_id' => 'id']],
            [['quote_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuoteItem::className(), 'targetAttribute' => ['quote_item_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
            'order_id' => Yii::t('app', 'Order'),
            'quote_item_id' => Yii::t('app', 'Quote Item'),
            'product_id' => Yii::t('app', 'Product'),
            'selected_product_color_id' => Yii::t('app', 'Selected Product Color'),
            'quantity' => Yii::t('app', 'Quantity'),
            'base_price' => Yii::t('app', 'Base Price'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function getQuoteItem()
    {
        return $this->hasOne(QuoteItem::className(), ['id' => 'quote_item_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getProductColor()
    {
        return $this->hasOne(ProductColor::className(), ['id' => 'selected_product_color_id']);
    }
}
