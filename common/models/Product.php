<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $sku
 * @property string $notes
 * @property string $url_key
 * @property string $meta_desc
 * @property string $warranty_note
 * @property string $image_path
 * @property string $base_price
 * @property string $search
 * @property string $search_full
 * @property integer $is_sold_out
 * @property integer $is_product_color
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 *
 * @property Category $category
 * @property ProductColor[] $productColors
 * @property ProductColorPreviewImage[] $productColorPreviewImages
 */
class Product extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vv.product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'is_sold_out', 'created_by', 'updated_by', 'status'], 'integer'],
            [['notes', 'details', 'search', 'search_full'], 'string'],
            [['is_product_color'], 'boolean'],
            [['name', 'sku', 'category_id', 'url_key', 'details', 'base_price'], 'required'],
            [['base_price'], 'number'],
            [['sku', 'url_key'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url_key', 'meta_desc', 'image_path'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'category_id' => Yii::t('app', 'Category'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'is_special' => Yii::t('app', 'Is Special'),
            'desc' => Yii::t('app', 'Desc'),
            'about' => Yii::t('app', 'About'),
            'url_key' => Yii::t('app', 'Url Key'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'size_info' => Yii::t('app', 'Size Info'),
            'warranty_note' => Yii::t('app', 'Warranty Note'),
            'image_path' => Yii::t('app', 'Image'),
            'base_price' => Yii::t('app', 'Base Price'),
            'is_sold_out' => Yii::t('app', 'Is Sold Out'),
            'search' => Yii::t('app', 'Search'),
            'search_full' => Yii::t('app', 'Search Full')
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function beforeSave($insert)
    {
        $this->is_product_color = false;
        return parent::beforeSave($insert);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getProductColors()
    {
        return $this->hasMany(ProductColor::className(), ['product_id' => 'id']);
    }

    public function getProductColorPreviewImages()
    {
        return $this->hasMany(ProductColorPreviewImage::className(), ['product_color_id' => 'id'])
            ->via('productColors');
    }
}
