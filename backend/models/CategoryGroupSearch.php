<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\CategoryGroup;

class CategoryGroupSearch extends CategoryGroup
{
    public function search($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'id' => $this->id,
            'priority' => $this->priority,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'cover_image_path', $this->cover_image_path]);

        return $dataProvider;
    }
}
