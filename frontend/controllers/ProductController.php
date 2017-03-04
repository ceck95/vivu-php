<?php

namespace frontend\controllers;

use frontend\business\BusinessProduct;

class ProductController extends BaseController
{
    /**
     * @var BusinessProduct
     */
    private $business;

    public function init()
    {
        $this->business = BusinessProduct::getInstance();
        parent::init();
    }


    public function actionListProductByCategory($categoryUrl = '', $page = 1, $totalPage = null)
    {
        $category = $this->business->findCategory($categoryUrl);

        $arrayWherePagination = ['category_id' => $category->id];

        $arrayRespPagination = $this->business->filterPagination($arrayWherePagination, $page, $totalPage);


        $this->setVars(array_merge($arrayRespPagination, ['category' => $category]));

        $this->responseJson();

    }

    public function actionListProductByClassify($classify,$page = 1, $totalPage = null)
    {
        $arrayWhere = [];
        $nameTitle = null;

        if ($classify === 'feature') {
            $arrayWhere = [
                'is_featured' => 1
            ];
            $nameTitle = 'Feature';

        } else if ($classify === 'special') {
            $arrayWhere = [
                'is_special' => 1
            ];

            $nameTitle = 'Special';
        }

        if (!empty($arrayWhere)) {

            $arrayRespPagination = $this->business->filterPagination($arrayWhere, $page, $totalPage);


            $this->setVars(array_merge($arrayRespPagination, ['title' => $nameTitle]));

        }

        $this->responseJson();

    }

    public function actionListProductColorImagePreview($productColorId)
    {

        $productColorImagePreview = $this->business->getProductColorPreview($productColorId);

        $this->setVars(['productColorImagePreview' => $productColorImagePreview]);

        $this->responseJson();

    }

    public function actionDetail($productUrl)
    {
        $productDetail = $this->business->getProductDetail($productUrl);

        $this->setVars(['product' => $productDetail]);

        $this->responseJson();

    }

}
