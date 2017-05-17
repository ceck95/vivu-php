<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\BoxItem;

class BoxItemSearch extends BoxItem
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
            'box_id' => $this->box_id,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
