<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 06/12/2016
 * Time: 15:45
 */
/**
 * @var $this \common\core\web\mvc\View
 * @var $boxItemsForBlogArticles \common\models\Article[]
 */
?>
<?php if (count($boxItemsForBlogArticles) > 0) : ?>
    <section class="index-module index-module__blog">
        <div class="container">
            <h2 class="index-module__title"><?= Yii::t('app', 'Latest articles'); ?></h2>
            <section class="blog__articles blog__articles--grid clearfix">
                <?= $this->render('/blog/_row', [
                    'boxItemsForBlogArticles' => $boxItemsForBlogArticles
                ]); ?>
            </section>
        </div>
    </section>
<?php endif; ?>