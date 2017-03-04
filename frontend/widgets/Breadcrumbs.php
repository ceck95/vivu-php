<?php

/**
 * Created by dinhty.luu@gmail.com
 * Date: 07/12/2016
 * Time: 10:41
 */
namespace frontend\widgets;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $itemTemplate = "<li class='breadcrumb__item'><span class='breadcrumb__title'>{link}</span></li>\n";

    public $activeItemTemplate = "<li class=\"breadcrumb__item breadcrumb__item--active\"><span class='breadcrumb__title'>{link}</span></li>\n";

    public $options = ['class' => 'breadcrumb__list list--unstyled'];

    public function init()
    {
        parent::init();
    }

}