<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Article;

class ArticleSearch extends Article
{
    public function search($params)
    {
        $query = self::baseSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->orderBy(['updated_at' => SORT_DESC]);

        $query->andFilterWhere([
            'id' => $this->id,
            'num_view' => $this->num_view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'thumbnail_image', $this->thumbnail_image]);

        return $dataProvider;
    }
}
