<?php

use common\core\web\mvc\widget\BaseDetailView;
use common\helpers\Html;

/**
 * @var $this common\core\web\mvc\View
 * @var $model common\models\Customer
 */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Yii::t('app', 'Customer Information') ?></div>
                </div>
                <div class="panel-body">
                    <?= BaseDetailView::widget([
                        'model' => $model,
                        'attributes' => [
//                            'id',
                            'email:ntext',
                            'phone:ntext',
                            'full_name:ntext',
                            'dob:date',
                            'gender:gender',
//                            'password_hash:ntext',
//                            'password_reset_token:ntext',
                            'created_at',
                            'address' => [
                                'value'=> $model->addressDefault->full_name
                            ],
//                            'updated_at',
//                            'created_by',
//                            'updated_by',
                            'status',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
