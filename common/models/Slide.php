<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property string $image
 * @property string $link
 * @property integer $priority
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class Slide extends BaseModel
{
    public static function tableName()
    {
        return 'slide';
    }

    public function rules()
    {
        return [
            [['image', 'link'], 'string'],
            [['priority', 'created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'image' => Yii::t('app', 'Image'),
                'link' => Yii::t('app', 'Link'),
                'priority' => Yii::t('app', 'Priority'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
