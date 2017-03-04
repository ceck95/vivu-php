<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 1/1/17
 * Time: 4:52 PM
 */

namespace frontend\business;


use common\business\BaseBusinessPublisher;
use common\models\DesignProductGroup;
use common\models\Product;

class BusinessDesignProduct extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function getProductDetail($productUrl) : Product
    {
        return Product::find()->andWhere(['product.url_key' => $productUrl])->oneOrFail();
    }

    public function getRelationalDataOfProduct(Product $product)
    {
        $data = DesignProductGroup::find()
            ->asArray()
            ->andWhere(['product_id' => $product->id])
            ->joinWith('designProductDetails')
            ->all();
        
        return $data;
    }

}