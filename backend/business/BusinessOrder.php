<?php

namespace backend\business;

use common\models\OrderStatusHistory;
use common\modules\file\business\BusinessFile;
use Yii;
use common\models\Order;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessOrder extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Order $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function update(Order $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function save(Order $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model);
        }
        return $status;
    }

    public function newModel()
    {
        return new Order();
    }

    /**
     * @param $id
     * @return Order
     * @throws \yii\web\NotFoundHttpException
     */
    public function findModel($id)
    {
        $model = Order::findOneOrFail($id);

        return $model;
    }

    public static function getStrOrderStatus($status)
    {
        $orderStatusList = self::getOrderStatus();
        if (isset($orderStatusList[$status])) {
            return $orderStatusList[$status];
        }
        return '';
    }

    public static function getOrderStatus()
    {
        return [
            Order::ORDER_STATUS_NEW => Yii::t('app', 'New'),
            Order::ORDER_STATUS_ACCEPTED => Yii::t('app', 'Accepted'),
            Order::ORDER_STATUS_CANCEL => Yii::t('app', 'Cancel'),
            Order::ORDER_STATUS_COMPLETED => Yii::t('app', 'Completed'),
            Order::ORDER_STATUS_PAID => Yii::t('app', 'Paid'),
            Order::ORDER_STATUS_PAID_ONLINE => Yii::t('app', 'Paid Online'),
            Order::ORDER_STATUS_SHIPPING => Yii::t('app', 'Shipping'),
            Order::ORDER_STATUS_UNPAID => Yii::t('app', 'Unpaid'),
            Order::ORDER_STATUS_UNPAID_ONLINE => Yii::t('app', 'Unpaid Online')
        ];
    }

    public function changeStatusCommon(Order $model, $status)
    {
        $orderStatus = $model->order_status;
        $businessOrderStatusHistory = BusinessOrderStatusHistory::getInstance();
        $checkChangeStatus = false;

        switch ($status) {
            case Order::ORDER_STATUS_CANCEL :
                if ($orderStatus != Order::ORDER_STATUS_NEW) {
                    flassError('Order must order status new');
                } else {
                    $checkChangeStatus = true;
                }
                break;
            case Order::ORDER_STATUS_ACCEPTED :
                if ($orderStatus != Order::ORDER_STATUS_NEW) {
                    flassError('Order must order status new');
                } else {
                    $checkChangeStatus = true;
                }
                break;
            case Order::ORDER_STATUS_SHIPPING :
                if ($orderStatus != Order::ORDER_STATUS_ACCEPTED) {
                    flassError('Order must order status accepted');
                } else {
                    $checkChangeStatus = true;
                }
                break;
            case Order::ORDER_STATUS_COMPLETED :
                if ($orderStatus != Order::ORDER_STATUS_SHIPPING) {
                    flassError('Order must order status shipping');
                } else {
                    $checkChangeStatus = true;
                }
                break;
            default:
                break;
        }

        if ($checkChangeStatus) {
            $post = new ObjectScalar();
            $businessOrderStatusHistory->create(new OrderStatusHistory(), $post->setData([
                'order_id' => $model->id,
                'order_status' => $status
            ]));
            $this->update($model, $post->setData([
                'order_status' => $status
            ]));
            return true;
        }

        return false;

    }

    public function getCount()
    {
        $orders = Order::find()->asArray()->all();
        $result = [
            'new' => 0,
            'accepted' => 0,
            'shipping' => 0,
            'completed' => 0,
            'cancel' => 0
        ];

        foreach ($orders as $value) {
            if ($value['order_status'] === Order::ORDER_STATUS_NEW) {
                $result['new'] += 1;
            } elseif ($value['order_status'] === Order::ORDER_STATUS_ACCEPTED) {
                $result['accepted'] += 1;
            } elseif ($value['order_status'] === Order::ORDER_STATUS_SHIPPING) {
                $result['shipping'] += 1;
            } elseif ($value['order_status'] === Order::ORDER_STATUS_COMPLETED) {
                $result['completed'] += 1;
            } elseif ($value['order_status'] === Order::ORDER_STATUS_CANCEL) {
                $result['cancel'] += 1;
            }
        }
        return $result;
    }

}