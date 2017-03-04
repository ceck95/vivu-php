<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 8/9/16
 * Time: 10:52 AM
 */

use common\core\web\mvc\form\BaseActiveForm;
use common\helpers\Html;

/**
 * @var $this \common\core\web\mvc\View
 * @var $model \common\modules\adminUser\models\User
 */

$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-form">
    <?php $form = BaseActiveForm::begin(); ?>
    <?= $form->field($model, 'password_hash')->passwordInput(['value' => '']) ?>
    <?= $form->field($model, 'password_hash_repeat')->passwordInput(['value' => '']) ?>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php BaseActiveForm::end(); ?>

</div>