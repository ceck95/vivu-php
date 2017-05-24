<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;

/**
* @var $this common\core\web\mvc\View
* @var $searchModel " . ltrim($generator->searchModelClass, '\\')
* @var $dataProvider yii\data\ActiveDataProvider 
*/

$this->title = Yii::t('app', 'Slides');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Slide'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'image:imageGrid',
            'link:ntext',
            'priority',
            'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            'status' => Html::getStatusSearchForIndex($searchModel),

            ['class' => BaseActionColumn::class],
        ],
    ]); ?>
</div>
