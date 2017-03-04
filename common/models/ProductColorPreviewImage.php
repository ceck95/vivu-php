<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property integer $product_color_id
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class ProductColorPreviewImage extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_color_preview_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_color_id'], 'required'],
            [['product_color_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['product_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductColor::className(), 'targetAttribute' => ['product_color_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'id' => Yii::t('app', 'ID'),
            'product_color_id' => Yii::t('app', 'Product Color'),
            'path' => Yii::t('app', 'Product Preview Image For Color'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
