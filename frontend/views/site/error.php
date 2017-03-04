<?php

/* @var $this \common\core\web\mvc\View*/
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use common\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;

?>
<?php if (!empty($exception) && $exception->statusCode == 404):?>
    <div class="error-404 container">
        <div class="inner">
            <span class="error-404__icon">404</span>

            <div class="error-404__empty">
                <p>The page you’re looking for could not be found.</p>
                <?= Html::a(Yii::t('app', 'Back to home'), \yii\helpers\Url::home(), ['class' => 'button button--primary']) ;?>
            </div>
        </div>
    </div>
<?php endif;?>
