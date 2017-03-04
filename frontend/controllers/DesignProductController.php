<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 1/1/17
 * Time: 4:02 PM
 */

namespace frontend\controllers;


use frontend\business\BusinessDesignProduct;
use frontend\business\BusinessProduct;

class DesignProductController extends BaseController
{
    /**
     * @var BusinessDesignProduct
     */
    private $business;

    public function init()
    {
        $this->business = BusinessDesignProduct::getInstance();
        parent::init();
    }
    
    public function actionGetRelationalData($productUrl)
    {
        $product = $this->business->getProductDetail($productUrl);
        $productRelationalData = $this->business->getRelationalDataOfProduct($product);
        
        $this->setVars([
            'product' => $product->toArray(),
            'productRelationalData' => $productRelationalData,
        ]);
        $this->responseJson();   
    }
}