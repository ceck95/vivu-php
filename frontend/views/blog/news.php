<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 27/12/2016
 * Time: 13:10
 */
/**
 * @var $this \common\core\web\mvc\View
 * @var $boxItemsForBlogArticles \common\models\Article[]
 */
$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="template-home-page container">
    <div class="inner">
        <section class="blog__articles clearfix" style="margin-top: 20px;margin-bottom: 20px">
            <?= $this->render('_row', [
                'boxItemsForBlogArticles' => $boxItemsForBlogArticles
            ]);?>
        </section>
    </div>
</div>
