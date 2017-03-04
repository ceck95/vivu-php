<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $url_key
 * @property string $meta_desc
 * @property string $cover_image_path
 * @property string $for_gender
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class Category extends BaseModel
{
    const FOR_MEN = 'men';
    const FOR_WOMEN = 'women';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status', 'priority'], 'integer'],
            [['name', 'url_key', 'meta_desc', 'cover_image_path'], 'string', 'max' => 255],
            [['for_gender'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrs = [
            'name' => Yii::t('app', 'Name'),
            'priority' => Yii::t('app', 'Priority'),
            'desc' => Yii::t('app', 'Desc'),
            'url_key' => Yii::t('app', 'Url Key'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'cover_image_path' => Yii::t('app', 'Cover Image'),
            'for_gender' => Yii::t('app', 'For Gender'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
