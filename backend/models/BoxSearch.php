<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Box;

class BoxSearch extends Box
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
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
