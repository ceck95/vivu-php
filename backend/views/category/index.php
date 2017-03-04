<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;
use backend\business\BusinessCategory;
use backend\models\CategorySearch;

/* @var $this common\core\web\mvc\View */
/* @var $searchModel CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cover_image_path:imageGrid',
            'name',
            'url_key',
            'for_gender' => [
                'attribute' => 'for_gender',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'for_gender', BusinessCategory::forGenders(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('app', 'All')
                ]),
                'value' => function (CategorySearch $model) {
                    return BusinessCategory::forGenders($model->for_gender);
                }
            ],
            'created_at:datetime',
            'status' => Html::getStatusSearchForIndex($searchModel),

            ['class' => BaseActionColumn::class],
        ],
    ]); ?>
</div>
