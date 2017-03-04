<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 26/12/2016
 * Time: 23:09
 */

/* @var $this \common\core\web\mvc\View */
/* @var $model \common\models\Article */

use yii\helpers\Url;
use common\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog'), 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container template-home-page">
    <div class="inner">
        <article class="article article--full">
            <header class="article__header">
                <div class="article__meta" style="margin-top: 20px">
                    <time class="article__date">
                        <?= date('M', strtotime($model->created_at)) . ' ' . date('d', strtotime($model->created_at)) . ', ' . date('Y', strtotime($model->created_at)); ?>
                    </time>
                    <span class="article__meta-separator">/</span>
                    <a href="" class="article__comments-count">
                        <svg class="icon icon-comment">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-comment">

                            </use>
                        </svg>
                        <?= $model->num_view . ' View';?>
                    </a>
                </div>
            </header>

            <?= Html::img($this->cdnLink . $model->thumbnail_image, ['class' => 'article__image', 'alt' => $model->title]); ?>


            <div class="article__body rte">
                <?= $model->content; ?>
            </div>

            <div class="article__footer">
                <div class="share-buttons">
                    <span class="share-buttons__label">Share</span>

                    <ul class="share-buttons__list list--unstyled">


                        <li class="share-buttons__item">
                            <a href="https://www.facebook.com/sharer.php?u=<?= Url::home(true) . 'blog/view?id=' . $model->id; ?>"
                               target="_top">
                                <svg class="icon icon-facebook">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook">

                                        <title>Facebook</title>

                                    </use>
                                </svg>
                            </a>
                        </li>

                        <li class="share-buttons__item">
                            <a href="https://twitter.com/share?text=<?= $model->title; ?>url=<?= Url::home(true) . 'blog/view?id=' . $model->id; ?>"
                               target="_top">
                                <svg class="icon icon-twitter">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter">

                                        <title>Twitter</title>

                                    </use>
                                </svg>
                            </a>
                        </li>


                        <li class="share-buttons__item">
                            <a href="https://pinterest.com/pin/create/button/?url=<?= Url::home(true) . 'blog/view?id=' . $model->id; ?>;media=<?= $this->cdnLink . $model->thumbnail_image;?>"
                               target="_top">
                                <svg class="icon icon-pinterest">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-pinterest">

                                        <title>Pinterest</title>

                                    </use>
                                </svg>
                            </a>
                        </li>


                        <li class="share-buttons__item">
                            <a href="https://plus.google.com/share?url=<?= Url::home(true) . 'blog/view?id=' . $model->id; ?>"
                               target="_top">
                                <svg class="icon icon-google-plus">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google-plus">

                                        <title>Google+</title>

                                    </use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </article>

    </div>
</div>

