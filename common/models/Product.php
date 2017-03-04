<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $sku
 * @property integer $is_featured
 * @property integer $is_special
 * @property string $type
 * @property string $desc
 * @property string $about
 * @property string $url_key
 * @property string $meta_desc
 * @property string $size_info
 * @property string $warranty_note
 * @property string $image_path
 * @property string $base_price
 * @property integer $is_sold_out
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 *
 * @property Category $category
 * @property ProductColor[] $productColors
 * @property ProductColorPreviewImage[] $productColorPreviewImages
 * @property DesignProductGroup[] $designProductGroups
 * @property DesignProductDetail[] $designProductDetails
 */
class Product extends BaseModel
{
    const TYPE_DESIGN = 'design';
    const TYPE_SIMPLE = 'simple';

    public static function types($val = false)
    {
        $arr = [
            Product::TYPE_DESIGN => Yii::t('app', 'Designable'),
            Product::TYPE_SIMPLE => Yii::t('app', 'Simple'),
        ];
        if ($val !== false) {
            return isset($arr[$val]) ? $arr[$val] : null;
        }

        return $arr;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'is_featured', 'is_special', 'is_sold_out', 'created_by', 'updated_by', 'status'], 'integer'],
            [['desc', 'about', 'size_info', 'warranty_note'], 'string'],
            [['name', 'sku'], 'required'],
            [['base_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url_key', 'meta_desc', 'image_path'], 'string', 'max' => 255],
            [['sku', 'type'], 'string', 'max' => 45],
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
            'type' => Yii::t('app', 'Type'),
            'desc' => Yii::t('app', 'Desc'),
            'about' => Yii::t('app', 'About'),
            'url_key' => Yii::t('app', 'Url Key'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'size_info' => Yii::t('app', 'Size Info'),
            'warranty_note' => Yii::t('app', 'Warranty Note'),
            'image_path' => Yii::t('app', 'Image'),
            'base_price' => Yii::t('app', 'Base Price'),
            'is_sold_out' => Yii::t('app', 'Is Sold Out'),
        ];
        return array_merge($attrs, parent::attributeLabels());
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

    public function getDesignProductGroups()
    {
        return $this->hasMany(DesignProductGroup::className(), ['product_id' => 'id']);
    }

    public function getDesignProductDetails()
    {
        return $this->hasMany(DesignProductDetail::className(), ['product_group_id' => 'id'])
            ->via('designProductGroups');
    }

}
