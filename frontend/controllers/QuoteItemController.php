<?php
/**
 * Created by PhpStorm.
 * User: nhutdev
 * Date: 09/01/2017
 * Time: 12:20
 */

namespace frontend\controllers;


use common\core\oop\ObjectScalar;
use frontend\business\BusinessQuoteItem;

class QuoteItemController extends BaseController
{
    /**
     * @var BusinessQuoteItem
     */
    private $business;

    public function init()
    {
        $this->business = BusinessQuoteItem::getInstance();
        parent::init();
    }

    public function actionGetAllItem($id = null)
    {
        if ($id) {
            $this->setVars(['quoteItem' => $this->business->findAllItemByQuoteId($id)]);
        }

        $this->responseJson();

    }

    public function actionCreate()
    {
        $model = $this->business->newModel();
        $postObject = $this->getPostObject();

        if (!$postObject->isEmpty()) {

            $idProduct = $postObject['product_id'];
            $dataProductColor = $this->business->findProductColor($postObject['selected_product_color_id'], $idProduct);
            $dataProduct = $this->business->findProduct($idProduct);

            $priceProduct = $this->business->calculateProduct($dataProductColor,$dataProduct);

            $postObject['base_price'] = $priceProduct;

            $createStatus = $this->business->create($model, $postObject);

            if ($createStatus === true) {
                $this->setVars(['message' => 'Insert sucessfully']);
            } else {
                $this->setVars(['error' => 'Insert error']);
            }

        }


        $this->responseJson();

    }

    public function actionUpdateQtyQuoteItem(){

        $dataPost = $this->getPostObject();

        $model = $this->business->findModelQuoteItem($dataPost['quoteId'],$dataPost['productId'],$dataPost['selectedProductColorId']);

        $postObject = new ObjectScalar();
        $postObject['qty'] = $dataPost['qty'];

        if(!empty($postObject)){

            $updateStatus = $this->business->update($model,$postObject);
            if ($updateStatus === true) {
                $this->setVars(['message' => 'Update sucessfully']);
            } else {
                $this->setVars(['error' => 'Update error']);
            }

        }

        $this->responseJson();
    }

    public function  actionDeleteQuoteItem(){

        $dataPost = $this->getPostObject();

        $model = $this->business->findModelQuoteItem($dataPost['quoteId'],$dataPost['productId'],$dataPost['selectedProductColorId']);

        $deleteStatus = $this->business->delete($model);
        if ($deleteStatus === true) {
            $this->setVars(['message' => 'Delete sucessfully']);
        } else {
            $this->setVars(['error' => 'Delete error']);
        }

        $this->responseJson();

    }

}