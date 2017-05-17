<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\CategoryGroup
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-group-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Category Group Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name:ntext',
                            'priority',
                            'notes:ntext',
                            'url_key:ntext',
                            'meta_desc',
                            'status',
                            'created_at',
                            'created_by',
                            'updated_at',
                            'updated_by',
                            'cover_image_path:imageView',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
