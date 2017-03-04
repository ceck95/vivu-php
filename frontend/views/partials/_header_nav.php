<?php
use common\models\Category;
use common\helpers\Html;
use frontend\widgets\Breadcrumbs;
use yii\helpers\Url;

/**
 * Created by dinhty.luu@gmail.com
 * Date: 06/12/2016
 * Time: 15:41
 */
/**
 * @var $this \common\core\web\mvc\View
 * @var $coverCategory string
 * @var $listCategory array
 */
$listCategory = isset($this->globalParams['listCategory']) ? $this->globalParams['listCategory'] : null;
$listCateMen = isset($listCategory[Category::FOR_MEN]) ? $listCategory[Category::FOR_MEN] : null;
$listCateWomen = isset($listCategory[Category::FOR_WOMEN]) ? $listCategory[Category::FOR_WOMEN] : null;
$styleForHeader = null;
$classHeader = null;
if (isset($this->params['breadcrumbs'])) {
    $classHeader = 'header-image';
    $styleForHeader = 'style="background-image: url('.Url::home(true) .'images/header_background_image.jpg) !important; position: initial"';
    if (!empty($coverCategory)) {
        $styleForHeader = 'style="background-image: url(' . $coverCategory . ') !important; position: initial; "';
    }
}
?>
<header class="header  header--pushed <?= $classHeader; ?> " <?= $styleForHeader; ?> role="banner">
    <div class="header__container container clearfix">
        <h1 class="header__logo">
            <?= Html::a(Html::img('/images/logo.png', ['class' => 'header__logo-image']), Url::home(true), ['class' => 'header__link']) ?>
        </h1>
        <ul class="header__actions list--unstyled">
            <li class="header__actions-item">
                <a>Login</a>
            </li>
            <li class="header__actions-item">
                <a>Register</a>
            </li>
            <li class="header__actions-item" data-cart-view="data-cart-view">
                <a>Cart (<span rv-text="cart.item_count">0</span>)</a>
            </li>
        </ul>
        <nav class="menu menu--desktop">
            <ul class="menu__links menu__links--level-0  list--unstyled">
                <li class="menu__item menu__item--active menu__item--has-submenu">

                    <?= Html::a(Yii::t('app', 'Men'), null, ['class' => 'menu__link']); ?>

                    <?php if (!empty($listCateMen)) : ?>
                        <ul class="menu__links menu__links--level-1 menu__links--nested list--unstyled">
                            <?php foreach ($listCateMen as $value) : ?>
                                <li class="menu__item  ">
                                    <?= Html::a($value->name, '/home#/category/' . $value->url_key, ['class' => 'menu__link']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
                <li class="menu__item  menu__item--has-submenu">
                    <?= Html::a(Yii::t('app', 'Women'), null, ['class' => 'menu__link']); ?>

                    <?php if (!empty($listCateWomen)) : ?>
                        <ul class="menu__links menu__links--level-1 menu__links--nested list--unstyled">
                            <?php foreach ($listCateWomen as $value) : ?>
                                <li class="menu__item  ">
                                    <?= Html::a($value->name, '/home#/category/' . $value->url_key, ['class' => 'menu__link']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
                <li class="menu__item menu__item--has-submenu">
                    <?= Html::a(Yii::t('app', 'Design'), null, ['class' => 'menu__link']); ?>
                    <ul class="menu__links menu__links--nested menu__links--level-1 menu__mega-nav mega-nav category-men-womnen">
                        <!--                        <li class="mega-nav__image-container">-->
                        <!--                            <img class="mega-nav__image" src="images/navigation_horizontal_image.jpg">-->
                        <!--                        </li>-->
                        <li class="mega-nav__dropdown-column dropdown-column">
                            <?= Html::a(Yii::t('app', 'Men'), null, ['class' => 'dropdown-column__title']); ?>
                            <?php if (!empty($listCateMen)) : ?>
                                <ul class="dropdown-column__list list--unstyled">
                                    <?php foreach ($listCateMen as $value) : ?>
                                        <li class="dropdown-column__list-item">
                                            <?= Html::a($value->name, '/home#/category/' . $value->url_key, ['class' => 'dropdown-column__list-link']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        <li class="mega-nav__dropdown-column dropdown-column">
                            <?= Html::a(Yii::t('app', 'Women'), null, ['class' => 'dropdown-column__title']); ?>
                            <?php if (!empty($listCateWomen)) : ?>
                                <ul class="dropdown-column__list list--unstyled">
                                    <?php foreach ($listCateWomen as $value) : ?>
                                        <li class="dropdown-column__list-item">
                                            <?= Html::a($value->name, '/home#/category/' . $value->url_key, ['class' => 'dropdown-column__list-link']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </li>
                <li class="menu__item  ">
                    <?= Html::a(Yii::t('app', 'Special'), '/home#/special/', ['class' => 'menu__link not-has-submenu']); ?>
                </li>
                <li class="menu__item">
                    <?= Html::a(Yii::t('app', 'Contact'), Url::home(true) . 'site/contact', ['class' => 'menu__link not-has-submenu']); ?>
                </li>
                <li class="menu__item">
                    <?= Html::a(
                        '<svg class="icon icon-search">' .
                        '<use xlink:href="#icon-search">' .
                        '</use>' .
                        '</svg>',
                        'search',
                        [
                            'class' => 'menu__link',
                            'title' => Yii::t('app', 'Search'),
                            'data-action' => 'open-mega-search'
                        ]); ?>
                </li>
            </ul>
        </nav>
    </div>
    <?php if (isset($this->params['breadcrumbs'])) : ?>
        <div class="header__push">
            <div class="container">
                <div class="inner">
                    <nav class="breadcrumb">
                        <?= Breadcrumbs::widget([
                            'links' => $this->params['breadcrumbs'],
                        ]); ?>
                    </nav>
                    <div class="header__push-content">
                        <?= Html::tag('h1', isset($this->title) ? $this->title : '', ['class' => 'header__push-title']); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>
