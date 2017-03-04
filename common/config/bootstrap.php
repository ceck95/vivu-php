<?php
require(__DIR__ . '/../../common/config/functions.php');
define('APPROOT', dirname(dirname(__DIR__)));
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', APPROOT . '/frontend');
Yii::setAlias('backend', APPROOT . '/backend');
Yii::setAlias('static', APPROOT . '/static');
Yii::setAlias('console', APPROOT . '/console');

define('STATUS_DELETED', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_HIDE', 2);//hide

define('THUMBNAIL_SIZE_200x200', '200x200');

define('ITEM_PER_PAGE', 100);
