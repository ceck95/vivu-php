<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property string $title
 * @property string $url_key
 * @property string $meta_desc
 * @property string $content
 * @property string $thumbnail_image
 * @property integer $num_view
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 */
class Article extends BaseModel
{
    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['title', 'url_key'], 'required'],
            [['title', 'url_key', 'meta_desc', 'content', 'thumbnail_image'], 'string'],
            [['num_view', 'updated_by', 'created_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'title' => Yii::t('app', 'Title'),
                'url_key' => Yii::t('app', 'Url Key'),
                'meta_desc' => Yii::t('app', 'Meta Desc'),
                'content' => Yii::t('app', 'Content'),
                'thumbnail_image' => Yii::t('app', 'Thumbnail Image'),
                'num_view' => Yii::t('app', 'Num View'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
