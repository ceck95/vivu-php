<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\BoxItem
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Box Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-item-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Box Item Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'box_id' => [
                                'attribute' => 'box_id',
                                'value' => $model->box->name
                            ],
                            'link',
                            'text:ntext',
                            'priority',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
