<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 06/12/2016
 * Time: 15:44
 */
/**
 * @var $boxItemsForNewFeed \common\models\BoxItem[]
 */
?>
<section class="index-module index-module__instagram">
    <div class="inner">
        <h2 class="index-module__title">
            <svg class="icon icon-instagram">
                <use xlink:href="#icon-instagram">
                </use>
            </svg>
            New feed
        </h2>
        <?php foreach ($boxItemsForNewFeed as $key => $boxItem): ; ?>
            <?php if ($key == 0 || ($key) % 3 == 0) : ?>
                <div class="instafeed clearfix">
            <?php endif;?>
            <div class="instagram__image-wrapper">
                <a href="<?= $boxItem->link; ?>" target="_blank">
                    <div class="instagram__overlay">
                        <p class="instagram__caption">
                            <?= $boxItem->text; ?>
                        </p>
                        <time class="instagram__date">
                            <?= date('M', strtotime($boxItem->updated_at)) . ' ' . date('d', strtotime($boxItem->updated_at)) . ', ' . date('Y', strtotime($boxItem->updated_at)); ?>
                        </time>
                    </div>
                    <img class="instagram__image" style="max-width: 76%"
                         src="<?= \common\Factory::$app->params['cdn_link'] . '/' . $boxItem->image; ?>">
                </a>
            </div>
            <?php if ($key+1 % 3 == 0): ?>
                </div>
            <?php endif;?>
        <?php endforeach; ?>
    </div>
</section>
