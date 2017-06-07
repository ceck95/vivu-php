<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;

/**
 * @var $this common\core\web\mvc\View
 * @var $searchModel " . ltrim($generator->searchModelClass, '\\')
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'email:ntext',
            'phone:ntext',
            'full_name:ntext',
            'dob:date',
            'gender:gender',
            // 'password_hash:ntext',
            // 'password_reset_token:ntext',
            'created_at:date',
            // 'updated_at',
//             'created_by',
            // 'updated_by',
            'status' => Html::getStatusSearchForIndex($searchModel),

            [
                'class' => BaseActionColumn::class,
                'template' => '{view} {delete}'
            ],
        ],
    ]); ?>
</div>
