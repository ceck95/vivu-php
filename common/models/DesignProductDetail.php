<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $product_group_id
 * @property string $name
 * @property string $tag
 * @property integer $is_default
 * @property string $price
 * @property string $thumbnail_path
 * @property string $product_reference_image_1
 * @property string $product_reference_image_2
 * @property string $product_reference_image_3
 * @property integer $is_sold_out
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class DesignProductDetail extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'design_product_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_group_id'], 'required'],
            [['product_group_id', 'is_default', 'is_sold_out', 'created_by', 'updated_by', 'status'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'tag', 'thumbnail_path', 'product_reference_image_1', 'product_reference_image_2', 'product_reference_image_3'], 'string', 'max' => 255],
            [['product_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignProductGroup::className(), 'targetAttribute' => ['product_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'id' => Yii::t('app', 'ID'),
            'product_group_id' => Yii::t('app', 'Product Group'),
            'tag' => Yii::t('app', 'Tag'),
            'is_default' => Yii::t('app', 'Is Default'),
            'price' => Yii::t('app', 'Price'),
            'thumbnail_path' => Yii::t('app', 'Thumbnail'),
            'product_reference_image_1' => Yii::t('app', 'Product Ref Image 1'),
            'product_reference_image_2' => Yii::t('app', 'Product Ref Image 2'),
            'product_reference_image_3' => Yii::t('app', 'Product Ref Image 3'),
            'is_sold_out' => Yii::t('app', 'Is Sold Out'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function attributeHints()
    {
        $attrs = [
            'tag' => Yii::t('app', "The details name with same tag will be gather as a child group"),
            'product_reference_image_1' => Yii::t('app', 'Product Reference Image 1'),
            'product_reference_image_2' => Yii::t('app', 'Product Reference Image 2'),
            'product_reference_image_3' => Yii::t('app', 'Product Reference Image 3'),
        ];
        return array_merge($attrs, parent::attributeHints());
    }

}
