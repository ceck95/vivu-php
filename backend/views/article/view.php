<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Article
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Article Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'title:ntext',
                            'url_key:ntext',
                            'meta_desc:ntext',
                            'content:ntext',
                            'thumbnail_image:ntext',
                            'num_view',
                            'created_at',
                            'updated_at',
                            'updated_by',
                            'created_by',
                            'status',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
