<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $created_by
 * @property integer $status
 */
class Contact extends BaseModel
{
    /**
     * @var string
     */
//    public $captcha;

    public static function tableName()
    {
        return 'contact';
    }

    public function rules()
    {
        return [
            [['name', 'message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['updated_by', 'created_by', 'status'], 'integer'],
            [['email'], 'string', 'max' => 255],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'email' => Yii::t('app', 'Email'),
                'name' => Yii::t('app', 'Name'),
                'message' => Yii::t('app', 'Message'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
