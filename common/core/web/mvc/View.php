<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 1/19/16
 * Time: 9:33 AM
 */

namespace common\core\web\mvc;
use common\Factory;


class View extends \yii\web\View
{
    public $jsConstants = [];
    
    public $globalParams = [];

    public $cdnLink = null;

    public function init()
    {
        $this->cdnLink = Factory::$app->params['cdn_link'];
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function render($view, $params = [], $context = null)
    {
        if (empty($this->globalParams)) {
            $this->globalParams = $params;
        }

        $params = $params + $this->globalParams;
        return parent::render($view, $params, $context);
    }

}