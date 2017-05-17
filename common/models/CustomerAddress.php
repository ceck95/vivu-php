<?php

namespace common\models;

use Yii;
use \common\core\web\mvc\BaseModel;


/**
 * @property integer $id
 * @property integer $customer_id
 * @property string $type
 * @property boolean $is_default
 * @property string $full_name
 * @property string $phone
 * @property string $street
 * @property string $postal_code
 * @property string $country_code
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * @property string $province
 * @property string $district
 * @property string $ward
 * @property string $customer_name
 *
 * @property Customer $customer
 */
class CustomerAddress extends BaseModel
{

    const CUSTOMER_HOME = 'CUSTOMER_HOME';
    const CUSTOMER_COMPANY = 'CUSTOMER_COMPANY';

    public static function tableName()
    {
        return 'vv.customer_address';
    }

    public function rules()
    {
        return [
            [['customer_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['type', 'full_name', 'phone', 'street', 'postal_code', 'country_code', 'province', 'district', 'ward', 'customer_name'], 'string'],
            [['is_default'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        $attrs = [
            'customer_id' => Yii::t('app', 'Customer'),
            'type' => Yii::t('app', 'Type'),
            'is_default' => Yii::t('app', 'Is Default'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'street' => Yii::t('app', 'Street'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'country_code' => Yii::t('app', 'Country Code'),
            'province' => Yii::t('app', 'Province'),
            'district' => Yii::t('app', 'District'),
            'ward' => Yii::t('app', 'Ward'),
            'customer_name' => Yii::t('app', 'Customer Name'),
        ];
        return array_merge($attrs, parent::attributeLabels());
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
