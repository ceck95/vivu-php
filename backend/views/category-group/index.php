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

$this->title = Yii::t('app', 'Category Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cover_image_path:imageGrid',
            'name:ntext',
            'priority',
            'notes:raw',
            'url_key:ntext',
            // 'meta_desc',
            'status' => Html::getStatusSearchForIndex($searchModel),
            'created_at:datetime',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            [
                'class' => BaseActionColumn::class,
                'template' => '{manage} {view} {update} {delete}',
                'buttons' => [
                    'manage' => function ($url, \common\models\CategoryGroup $model) {
                        return Html::a('<i class="fa fa-cogs"></i>', [
                            'manager-category',
                            'id' => $model->id
                        ], [
                            'title' => Yii::t('app', 'Manage Category'),
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
