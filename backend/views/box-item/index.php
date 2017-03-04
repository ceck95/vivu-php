<?php

use common\helpers\Html;
use common\core\web\mvc\grid\BaseActionColumn;
use common\core\web\mvc\grid\BaseGridView;
use yii\widgets\Pjax;
/**
* @var $this common\core\web\mvc\View
* @var $searchModel " . ltrim($generator->searchModelClass, '\\')
* @var $dataProvider yii\data\ActiveDataProvider
 * @var $boxList array
*/

$this->title = Yii::t('app', 'Box Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Box Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'image:imageGrid',
            'box_id' => [
                'attribute' => 'box_id',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'box_id', $boxList, [
                    'class' => 'form-control select2',
                    'prompt' => Yii::t('app', 'All'),
                ]),
                'value' => function (\backend\models\BoxItemSearch $boxItemSearch) {
                    return $boxItemSearch->box ? $boxItemSearch->box->name : null;
                },
            ],
            'link',
            'text' => [
                'attribute' => 'text',
                'value' => function(\common\models\BoxItem $boxItem){
                    if (strlen($boxItem->text) > 80){
                        return substr($boxItem->text, 0, 80) . '...';
                    }
                    return $boxItem->text;
                },
                'format' => 'ntext',
            ],
            'priority',

            ['class' => BaseActionColumn::class],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
