<?php

/* @var $this \common\core\web\mvc\View */
/* @var $form BaseActiveForm */
/* @var $model \common\models\Contact */
/* @var $message string */

use yii\helpers\Html;
use \common\core\web\mvc\form\BaseActiveForm;
use common\modules\systemSetting\business\BusinessSystemSetting;
use common\modules\systemSetting\models\SystemSetting;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-home-page template-page-contact">
    <section class="page clearfix">
        <div class="container">
            <div class="inner">
                <div class="page__content rte">
                    <?= BusinessSystemSetting::getInstance()->getConfig(SystemSetting::KEY_TEXT_DESCRIPTION_OF_PAGE_ABOUT, ['key' => SystemSetting::TYPE_TECHNIQUE_SYSTEM]); ?>
                </div>
                <div class="contact">
                    <?php $form = BaseActiveForm::begin(['id' => 'contact_form', 'class' => 'contact__form form__control']); ?>

                    <?php if (!empty($message)) : ?>
                        <div class="alert alert--success">
                            <span class="alert-title" style="color: green"><?= $message; ?></span>
                        </div>
                    <?php endif; ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['required' => true]) ?>

                    <?= $form->field($model, 'message')->textarea(['rows' => 5, 'cols' => 75, 'required' => true]) ?>

                    <?= Html::submitButton('Send', ['class' => 'button button--primary', 'style' => 'width: 100%']) ?>

                    <?php BaseActiveForm::end(); ?>
                </div>

            </div>

        </div>
    </section>
</div>