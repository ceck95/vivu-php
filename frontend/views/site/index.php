<?php

use common\helpers\Html;

/**
 * @var $boxItemsForProduct \common\models\BoxItem[]
 * @var $boxItemsForNewFeed \common\models\BoxItem[]
 * @var $boxItemsForIntroWelcome \common\models\BoxItem[]
 * @var $slideShow array
 * @var $boxItemsForBlogArticles \common\models\Article[]

 */
$cdnLink = \common\Factory::$app->params['cdn_link'] . '/';
?>

<?= $this->render('/site/_slide_show', [
    'slideShow' => $slideShow
]); ?>

<section class="marketing-module container">
    <div class="marketing-module__wrapper">
        <?php if (!empty($boxItemsForProduct)) : ?>
            <div class="marketing-module__column div-image">
                <a href="<?= $boxItemsForProduct[0]->link ? $boxItemsForProduct[0]->link : '#'; ?>"
                   class="marketing-module__item marketing-module__link">
                    <?= Html::img($cdnLink . $boxItemsForProduct[0]->image, ['class' => 'marketing-module__image']); ?>
                    <div class="btn-title">
                        <button class="img__button button button--primary"><?= $boxItemsForProduct[0]->text; ?></button>
                    </div>
                </a>
            </div>
            <div class="marketing-module__column">
                <?php foreach ($boxItemsForProduct as $key => $boxItem): ; ?>
                    <?php if ($key == 3) break; ?>
                    <?php if ($key != 0) : ?>
                        <div class="div-image">
                            <a href="<?= $boxItem->link ? $boxItem->link : '#'; ?>"
                               class="marketing-module__item marketing-module__link">
                                <?= Html::img($cdnLink . $boxItem->image, ['class' => 'marketing-module__image']); ?>
                                <div class="btn-title">
                                    <button class="img__button button button--primary"><?= $boxItem->text; ?></button>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="index-module index-module__free-text-1">
    <div class="container">
        <h2 class="index-module__title">Welcome to COkool</h2>
        <div class="rte" style="text-align: center;">
            <span>
                <?php foreach ($boxItemsForIntroWelcome as $key => $boxItem): ; ?>
                    <?= $boxItem->text;?>
                    <br/>
                <?php endforeach;?>
            </span>
        </div>
    </div>
</section>

<!--  Content      -->

<!--   News feed blog-->
<?= $this->render('/site/_news_feed_blog', [
    'boxItemsForBlogArticles' => $boxItemsForBlogArticles
]); ?>

<!--   News feed image-->
<?= $this->render('/site/_news_feed_image', [
    'boxItemsForNewFeed' => $boxItemsForNewFeed
]); ?>
