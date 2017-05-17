<?php

namespace backend\models;

use common\core\web\mvc\BaseActiveQuery;
use common\core\web\mvc\BaseModel;
use Yii;
use yii\data\ActiveDataProvider;
use common\models\Order;

class OrderSearch extends Order
{
    public function searchNew($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'order_status' => Order::ORDER_STATUS_NEW
        ]);

        return $this->search($query, $dataProvider);
    }

    public function searchAccepted($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'order_status' => Order::ORDER_STATUS_ACCEPTED
        ]);

        return $this->search($query, $dataProvider);
    }

    public function searchShipping($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'order_status' => Order::ORDER_STATUS_SHIPPING
        ]);

        return $this->search($query, $dataProvider);
    }

    public function searchCompleted($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'order_status' => Order::ORDER_STATUS_COMPLETED
        ]);

        return $this->search($query, $dataProvider);
    }

    public function searchCancel($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'order_status' => Order::ORDER_STATUS_CANCEL
        ]);

        return $this->search($query, $dataProvider);
    }


    public function search(BaseActiveQuery $query, ActiveDataProvider $dataProvider)
    {

        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'quote_id' => $this->quote_id,
            'shipping_address_id' => $this->shipping_address_id,
            'shipping_amount' => $this->shipping_amount,
            'subtotal' => $this->subtotal,
            'grand_total' => $this->grand_total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'customer_full_name', $this->customer_full_name])
            ->andFilterWhere(['like', 'customer_phone', $this->customer_phone]);

        $query->orderBy(['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
