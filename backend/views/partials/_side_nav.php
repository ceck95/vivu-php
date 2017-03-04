<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 6/3/16
 * Time: 12:46 PM
 */

use common\modules\tools\business\BusinessTranslate;
use yii\helpers\Url;
use common\Factory;
use common\modules\adminUser\business\BusinessAdminUser;

$module = Factory::$app->controller->module->id;
$controllerCategory = Factory::$app->controller->category;
$action = Factory::$app->request->absoluteUrl;
$listProvidedActions = BusinessAdminUser::getProvidedActions(adminuser()->role_id);
$isSuperAdmin = BusinessAdminUser::getInstance()->isSuperAdmin();

$urls = [
    'dashboard' => [
        'icon' => '<i class="fa fa-th-large"></i>',
        'link' => '/',
        'label' => Yii::t('app', 'Dashboard'),
    ],
    'adminUser' => [
        'icon' => '<i class="fa fa-fw fa-user-md"></i>',
        'label' => Yii::t('app', 'System Users'),
        'viewable' => isset($listProvidedActions['adminUser']),
        'submenus' => [
            [
                'link' => ['/adminUser/user/index'],
                'label' => Yii::t('app', 'Users'),
                'viewable' => isset($listProvidedActions['adminUser']['UserController']) && isset($listProvidedActions['adminUser']['UserController']['Index']),
            ],
            [
                'link' => ['/adminUser/role/index'],
                'label' => Yii::t('app', 'Roles'),
                'viewable' => isset($listProvidedActions['adminUser']['RoleController']) && isset($listProvidedActions['adminUser']['RoleController']['Index']),
            ],
        ]
    ],
    'category' => [
        'icon' => '<i class="fa fa-navicon"></i>',
        'label' => Yii::t('app', 'Categories'),
        'viewable' => isset($listProvidedActions['no_value']) && isset($listProvidedActions['no_value']['CategoryController']),
        'submenus' => [
            [
                'link' => ['/category/index'],
                'label' => Yii::t('app', 'List Category'),
                'viewable' => isset($listProvidedActions['no_value']['CategoryController']['Index']),
            ],
            [
                'link' => ['/category/create'],
                'label' => Yii::t('app', 'Create Category'),
                'viewable' => isset($listProvidedActions['no_value']['CategoryController']['Create']),
            ],
        ]
    ],
    'product' => [
        'icon' => '<i class="fa fa-cubes"></i>',
        'label' => Yii::t('app', 'Products'),
        'viewable' => isset($listProvidedActions['no_value']) && isset($listProvidedActions['no_value']['ProductController']),
        'submenus' => [
            [
                'link' => ['/product/index'],
                'label' => Yii::t('app', 'List Product'),
                'viewable' => isset($listProvidedActions['no_value']['ProductController']['Index']),
            ],
            [
                'link' => ['/product/create'],
                'label' => Yii::t('app', 'Create Product'),
                'viewable' => isset($listProvidedActions['no_value']['ProductController']['Create']),
            ],
        ]
    ],
    'box' => [
        'icon' => '<i class="fa fa-credit-card"></i>',
        'label' => Yii::t('app', 'Box'),
        'viewable' => isset($listProvidedActions['no_value']) && isset($listProvidedActions['no_value']['BoxController']),
        'submenus' => [
            [
                'link' => ['/box/index'],
                'label' => Yii::t('app', 'List Box'),
                'viewable' => isset($listProvidedActions['no_value']['BoxController']['Index']),
            ],
            [
                'link' => ['/box/create'],
                'label' => Yii::t('app', 'Create Box'),
                'viewable' => isset($listProvidedActions['no_value']['BoxController']['Create']),
            ],
            [
                'link' => ['/box-item/index'],
                'label' => Yii::t('app', 'List Box Item'),
                'viewable' => isset($listProvidedActions['no_value']['BoxItemController']['Index']),
            ],
            [
                'link' => ['/box-item/create'],
                'label' => Yii::t('app', 'Create Box Item'),
                'viewable' => isset($listProvidedActions['no_value']['BoxItemController']['Create']),
            ],
        ]
    ],
    'tools' => [
        'icon' => '<i class="fa fa-cog"></i>',
        'label' => Yii::t('app', 'Tools'),
        'viewable' => isset($listProvidedActions['tools']),
        'submenus' => [
            [
                'link' => ['/tools/translate', 'language' => BusinessTranslate::LANGUAGE_2_VI],
                'label' => Yii::t('app', 'Translate CMS Texts To Vietnamese'),
                'viewable' => isset($listProvidedActions['tools']['TranslateController']),
            ],
        ]
    ],
    'systemSetting' => [
        'icon' => '<i class="fa fa-wrench"></i>',
        'label' => Yii::t('app', 'System Setting'),
        'viewable' => isset($listProvidedActions['systemSetting']),
        'submenus' => [
            [
                'link' => ['/systemSetting/default/index'],
                'label' => Yii::t('app', 'Manage'),
                'viewable' => isset($listProvidedActions['systemSetting']['DefaultController']) && isset($listProvidedActions['systemSetting']['DefaultController']['Index']),
            ]
        ]
    ],
    'article' => [
        'icon' => '<i class="fa fa-newspaper-o"></i>',
        'label' => Yii::t('app', 'Article'),
        'viewable' => isset($listProvidedActions['no_value']) && isset($listProvidedActions['no_value']['ArticleController']),
        'submenus' => [
            [
                'link' => ['/article/index'],
                'label' => Yii::t('app', 'List Article'),
                'viewable' => isset($listProvidedActions['no_value']['ArticleController']['Index']),
            ],
            [
                'link' => ['/article/create'],
                'label' => Yii::t('app', 'Create Article'),
                'viewable' => isset($listProvidedActions['no_value']['ArticleController']['Create']),
            ],
        ]
    ],

];
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <?= \common\helpers\Html::displayImageFromRelativePath(adminuser()->avatar, ['class' => 'img-circle', 'type' => 'avatar']) ?>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold"><?= adminuser()->fullname ?></strong>
                             </span> <span class="text-muted text-xs block"><?= adminuser()->position ?> <b
                                        class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= Url::to(['/site/profile']) ?>"><?= Yii::t('app', 'Profile'); ?></a></li>
                        <li><a href="#"><?= Yii::t('app', 'Mailbox'); ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?= Url::to(['/site/logout']) ?>"><?= Yii::t('app', 'Logout'); ?></a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <?php $isActiveIn = false; ?>
            <?php foreach ($urls as $group => $urlArray): ?>
                <?php if ($isSuperAdmin || isset($urlArray['viewable']) && $urlArray['viewable']): ?>
                    <?php if ($controllerCategory == $group) {
                        $isActiveIn = true;
                    }; ?>
                    <li class="<?= $isActiveIn ? 'active' : null; ?>">
                        <?php if (is_array($urlArray) && isset($urlArray['submenus'])): ?>
                            <a><?= isset($urlArray['icon']) ? $urlArray['icon'] : null ?> <span
                                    class="nav-label"><?= $urlArray['label']; ?></span>
                                <span class="fa arrow"></span></a>
                            <ul id="<?= $group ?>"
                                class="nav nav-second-level collapse <?= $isActiveIn ? 'in' : null; ?>">
                                <?php foreach ($urlArray['submenus'] as $submenu): ?>
                                    <?php if ($isSuperAdmin || isset($submenu['viewable']) && $submenu['viewable']): ?>
                                        <li><a href="<?= Url::to($submenu['link']) ?>"><?= $submenu['label']; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?= Url::to($urlArray['link']) ?>"><?= isset($urlArray['icon']) ? $urlArray['icon'] : null ?>
                                <span class="nav-label"><?= $urlArray['label']; ?></span></a>
                        <?php endif; ?>
                    </li>
                    <?php $isActiveIn = false; ?>
                <?php endif; ?>

            <?php endforeach; ?>

        </ul>

    </div>
</nav>
