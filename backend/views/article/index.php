<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;
use yii\widgets\Pjax;

/**
 * @var $this common\core\web\mvc\View
 * @var $searchModel " . ltrim($generator->searchModelClass, '\\')
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'thumbnail_image:imageGrid',
            'title:ntext',
            'url_key:ntext',
            'num_view:ntext',
            'meta_desc' => [
                'attribute' => 'meta_desc',
                'value' => function (\common\models\Article $article){
                     return mb_strimwidth($article->meta_desc, 0, 90, '...');
                },
                'format' => 'raw'
            ],
            'created_at',
            'status' => Html::getStatusSearchForIndex($searchModel),

            ['class' => BaseActionColumn::class],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
