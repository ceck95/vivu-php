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

$this->title = Yii::t('app', 'Boxes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Box'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
        <?= BaseGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'code',
                'name',

                ['class' => BaseActionColumn::class],
            ],
        ]); ?>
    <?php Pjax::end(); ?></div>
