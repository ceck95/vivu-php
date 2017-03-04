<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;
use backend\business\BusinessCategory;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Category
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Category Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'desc:raw',
                            'url_key:url',
                            'meta_desc',
                            'cover_image_path:imageView',
                            'for_gender' => ['value' => BusinessCategory::forGenders($model->for_gender)],
                            'created_at',
                            'updated_at',
                            'created_by',
                            'updated_by',
                            'status',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
