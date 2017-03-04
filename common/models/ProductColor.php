<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $color_name
 * @property string $refer_product_image_path
 * @property string $price
 * @property integer $priority
 * @property integer $is_sold_out
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * 
 * @property Product $product
 * @property ProductColorPreviewImage[] $productColorPreviewImages
 */
class ProductColor extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'priority', 'is_sold_out', 'created_by', 'updated_by', 'status'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['color_name'], 'string', 'max' => 45],
            [['refer_product_image_path'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'color_name' => Yii::t('app', 'Color Name'),
            'refer_product_image_path' => Yii::t('app', 'Reference Image For Product'),
            'price' => Yii::t('app', 'Price'),
            'priority' => Yii::t('app', 'Priority'),
            'is_sold_out' => Yii::t('app', 'Is Sold Out'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);   
    }

    public function getProductColorPreviewImages()
    {
        return $this->hasMany(ProductColorPreviewImage::className(), ['product_color_id' => 'id']);
    }
    
}
