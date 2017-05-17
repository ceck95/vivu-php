<?php

use yii\helpers\Html;
use common\core\web\mvc\widget\BaseDetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this \common\core\web\mvc\View */
/* @var $model \common\modules\adminUser\models\User */
$this->title                   = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="gis-country-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update Profile', Url::to(['site/update-profile']), ['class' => 'btn btn-info']) ?>
        <?= Html::a('Change password', Url::to(['site/change-password']), ['class' => 'btn btn-primary']) ?>
    </p>

    <?= BaseDetailView::widget([
        'model'      => $model,
        'attributes' => [
            'role_id' => ['value' => $model->role->name],
            'email',
            'username',
            'avatar:image',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>