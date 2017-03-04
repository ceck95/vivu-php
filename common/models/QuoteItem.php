<?php

namespace common\models;

use Yii;
use common\core\web\mvc\BaseModel;

/**
 * This is the model class for table "quote_item".
 *
 * @property integer $id
 * @property integer $quote_id
 * @property integer $product_id
 * @property integer $selected_product_color_id
 * @property integer $designed_product_id
 * @property integer $qty
 * @property integer $base_price
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 *
 * @property Product $product
 * @property ProductColor $productColor
 */
class QuoteItem extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quote_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'product_id', 'selected_product_color_id', 'qty', 'base_price'], 'required'],
            [['quote_id', 'product_id', 'selected_product_color_id', 'designed_product_id', 'qty', 'base_price', 'updated_by', 'created_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            /*[['designed_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignedProduct::className(), 'targetAttribute' => ['designed_product_id' => 'id']],*/
            [['selected_product_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductColor::className(), 'targetAttribute' => ['selected_product_color_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['quote_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quote::className(), 'targetAttribute' => ['quote_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quote_id' => Yii::t('app', 'Quote ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'selected_product_color_id' => Yii::t('app', 'Selected Product Color ID'),
            'designed_product_id' => Yii::t('app', 'Designed Product ID'),
            'qty' => Yii::t('app', 'Qty'),
            'base_price' => Yii::t('app', 'Base Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
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
