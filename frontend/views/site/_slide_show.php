<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 06/12/2016
 * Time: 15:43
 */
/**
 * @var $slideShow array
 */
?>
<section class="slideshow slideshow--uncropped slider">
    <div class="slideshow__slides slider">
        <?php foreach ($slideShow as $value): $position = ['center', 'left', 'right'];
            $cdnLink = \common\Factory::$app->params['cdn_link'] ?>
            <div class="slideshow__slide"
                 style="background-image: url(<?= $cdnLink . '/' . $value['image']; ?>); width: 1351px;">
                <img class="slideshow__image" src="<?= $cdnLink . '/' . $value['image']; ?>"
                     srcset="<?= $cdnLink . '/' . $value['image']; ?>" sizes="100vw" alt="">

                <div class="slideshow__cover" style="text-align: <?= $position[(int)$value['options']['position']]; ?>">
                    <div class="slideshow__cover-wrapper">
                        <div class="container">
                            <h2 class="slideshow__subheading" style="margin-right: auto">
                                <span><?= $value['options']['small-text']; ?></span>
                            </h2>
                            <h1 class="slideshow__heading"
                                style="margin-right: auto"><?= $value['options']['large-text']; ?></h1>
                            <?php if (!empty($value['options']['button-text'])) :?>
                                <a href="<?= $value['options']['button-link']; ?>"
                                   class="slideshow__button button button--primary" tabindex="-1"
                                   target="_top"><?= $value['options']['button-text']; ?></a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="slideshow__arrows">
        <div class="container">
            <div class="slideshow__arrow slideshow__prev slick-prev slick-next slick-arrow" rel="prev"
                 style="display: inline-block;">
                <svg class="icon icon-arrow-left">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-left">
                    </use>
                </svg>
            </div>
            <div class="slideshow__arrow slideshow__next slick-arrow" rel="next" style="display: inline-block;">
                <svg class="icon icon-arrow-right">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-right">
                    </use>
                </svg>
            </div>
        </div>
    </div>
</section>
