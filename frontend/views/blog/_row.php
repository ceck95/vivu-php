<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 27/12/2016
 * Time: 13:15
 */
use common\helpers\Html;
/**
 * @var $this \common\core\web\mvc\View
 * @var $boxItemsForBlogArticles \common\models\Article[]
 */
?>

<?php foreach ($boxItemsForBlogArticles as $blogArticle):?>
    <article class="blog__article article">
        <header class="article__header">
            <div class="article__meta">
                <time class="article__date">
                    <?= date('M', strtotime($blogArticle->created_at)) . ' ' . date('d', strtotime($blogArticle->created_at)) . ', ' . date('Y', strtotime($blogArticle->created_at)); ?>
                </time>
            </div>
            <h3 class="article__title">
                <?= Html::a($blogArticle->title, ['blog/view', 'id' => $blogArticle->id] );?>
            </h3>
            <?= Html::a(Html::img($this->cdnLink . $blogArticle->thumbnail_image, ['class' => 'article__image']),[
                'blog/view', 'id' => $blogArticle->id
            ]);?>
        </header>
        <div class="article__excerpt rte">
            <?= mb_strimwidth($blogArticle->meta_desc, 0, 87, '...') ;?>
        </div>
        <div class="button-wrapper">
            <?= Html::a('Read more', ['blog/view', 'id' => $blogArticle->id], ['class' => 'button button--primary'] );?>
        </div>
    </article>
<?php endforeach;?>
