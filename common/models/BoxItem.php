<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $box_id
 * @property string $link
 * @property string $text
 * @property integer $priority
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 * @property string $option
 *
 * @property Box $box
 */
class BoxItem extends BaseModel
{
    public static function tableName()
    {
        return 'box_items';
    }

    public function rules()
    {
        return [
            [['box_id', 'priority', 'updated_by', 'created_by', 'status'], 'integer'],
            [['text', 'image', 'option'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['link'], 'string', 'max' => 255],
            [['box_id'], 'exist', 'skipOnError' => true, 'targetClass' => Box::className(), 'targetAttribute' => ['box_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'box_id' => Yii::t('app', 'Box'),
                'link' => Yii::t('app', 'Link'),
                'text' => Yii::t('app', 'Text'),
                'priority' => Yii::t('app', 'Priority'),
                'image' => Yii::t('app', 'Image'),
                                    'option' => Yii::t('app', 'Option'),
            ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getBox()
    {
        $this->hasOne(Box::className(), ['id' => 'box_id']);
    }
}
