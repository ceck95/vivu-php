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
            'is_featured' => $this->is_featured,
            'is_special' => $this->is_special,
            'is_sold_out' => $this->is_sold_out,
            'status' => $this->status,
        ]);

        $query->andFilterCompare('base_price', $this->base_price, '=');
        $query->andFilterCompare('created_at', $this->created_at, '=');

        $query->andFilterWhereLowercase(['like', 'name', $this->name])
            ->andFilterWhereLowercase(['like', 'sku', $this->sku])
            ->andFilterWhereLowercase(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
