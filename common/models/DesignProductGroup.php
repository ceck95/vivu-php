<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * 
 * @property DesignProductDetail[] $designProductDetails
 * @property Product $product
 */
class DesignProductGroup extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'design_product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'priority', 'created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'product_id' => Yii::t('app', 'Product'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getDesignProductDetails()
    {
        return $this->hasMany(DesignProductDetail::className(), ['product_group_id' => 'id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
