<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Product;

class ProductSearch extends Product
{
    public function search($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'is_sold_out' => $this->is_sold_out,
            'is_product_color' => $this->is_product_color,
            'status' => $this->status,
        ]);

        $query->andFilterCompare('base_price', $this->base_price, '=');
        $query->andFilterCompare('created_at', $this->created_at, '=');

        $query->andFilterWhereLowercase(['like', 'name', $this->name])
            ->andFilterWhereLowercase(['like', 'sku', $this->sku]);

        $query->orderBy(['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
