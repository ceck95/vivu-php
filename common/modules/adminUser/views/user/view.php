<?php

use yii\helpers\Html;
use common\core\web\mvc\widget\BaseDetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\adminUser\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btnDelete']) ?>

    </p>

    <?= BaseDetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'role_id' => ['value' => $model->role ? $model->role->name : null],
            'position:raw',
            'fullname:raw',
            'email:email',
            'username:raw',
            'avatar:image',
            'dob:datetime',
            'status',
            'position',
            'desc:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
