<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Category;

class CategorySearch extends Category
{
    public function search($params)
    {
        $query = self::baseSearch();
        if (empty($params)) {
            $query->orderBy(['priority' => SORT_ASC]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterCompare('created_at', $this->created_at, '=');

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc]);

        return $dataProvider;
    }
}
