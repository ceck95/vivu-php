<?php

namespace common\models;

use common\core\web\mvc\BaseModel;
use Yii;

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 *
 * @property BoxItem[] getBoxItems
 */
class Box extends BaseModel
{
    const CODE_OF_SLIDE_SHOW_HOME_PAGE = 'box-slide-show-home-page';
    const CODE_OF_PRODUCT_MODULE_HOME_PAGE = 'box-product-module-home-page';
    const CODE_OF_NEW_FEED_HOME_PAGE = 'box-new-feed-home-page';
    const CODE_OF_INTRO_WELCOME_HOME_PAGE = 'box-intro-welcome-home-page';

    public static function tableName()
    {
        return 'boxs';
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by', 'status'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getBoxItems()
    {
        return $this->hasMany(BoxItem::className(), ['box_id' => 'id']);
    }

}
