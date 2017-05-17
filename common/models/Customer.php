<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property string $email
 * @property string $phone
 * @property string $full_name
 * @property string $dob
 * @property string $gender
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class Customer extends BaseModel
{
    public static function tableName()
    {
        return 'vv.customer';
    }

    public function rules()
    {
        return [
            [['email', 'phone', 'full_name', 'gender', 'password_hash', 'password_reset_token'], 'string'],
            [['phone', 'full_name', 'gender'], 'required'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['phone'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
                'email' => Yii::t('app', 'Email'),
                'phone' => Yii::t('app', 'Phone'),
                'full_name' => Yii::t('app', 'Full Name'),
                'dob' => Yii::t('app', 'Dob'),
                'gender' => Yii::t('app', 'Gender'),
                'password_hash' => Yii::t('app', 'Password Hash'),
                'password_reset_token' => Yii::t('app', 'Password Reset Token'),
                                ];
        return array_merge($attrs, parent::attributeLabels());
    }
}
