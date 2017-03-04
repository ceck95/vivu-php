<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 09/01/2017
 * Time: 12:21
 */

namespace frontend\business;


use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;
use common\models\Product;
use common\models\ProductColor;
use common\models\QuoteItem;

class BusinessQuoteItem extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function findAllItemByQuoteId($id)
    {
        return QuoteItem::find()->select(['quote_item.base_price','quote_item.designed_product_id','quote_item.product_id','quote_item.qty','quote_item.quote_id','quote_item.selected_product_color_id'])->andWhere(['quote_id' => $id])->joinWith('product')->joinWith('productColor')->asArray()->all();
    }

    public function findProductColor($id, $idProduct)
    {
        return ProductColor::find()->select('price')->andWhere(['id' => $id, 'product_id' => $idProduct])->asArray()->one();
    }

    public function findProduct($id)
    {
        return Product::find()->select('base_price')->andWhere(['id' => $id])->asArray()->one();
    }

    public function create(QuoteItem $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        return $model->save($model);
    }

    public function update(QuoteItem $model,ObjectScalar $requestData){
        $model->setAttributes($requestData->toArray());
        return $model->save($model);
    }

    public function delete(QuoteItem $model){
        return $model->delete();
    }

    public function newModel()
    {
        return new QuoteItem();
    }

    public function calculateProduct($dataProductColor, $dataProduct)
    {
        return $dataProductColor['price'] + $dataProduct['base_price'];
    }

    public function findModelQuoteItem($quoteId, $productId,$selectedProductColorId)
    {
        return QuoteItem::find()->andWhere(['quote_id' => $quoteId, 'product_id' => $productId,'selected_product_color_id'=>$selectedProductColorId])->one();
    }

}