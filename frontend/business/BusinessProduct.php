<?php

namespace frontend\business;

use common\models\Category;
use common\models\Product;
use common\business\BaseBusinessPublisher;
use common\models\ProductColorPreviewImage;
use yii\web\NotFoundHttpException;

class BusinessProduct extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function findAllProduct()
    {
        return Product::find()->asArray()->all();
    }

    public function findCategory($categoryUrl)
    {
        $category = Category::find()->select(['name', 'id'])->andWhere(['url_key' => $categoryUrl])->one();
        if ($category) {
            return $category;
        }
        throw new NotFoundHttpException(\Yii::t('app', 'Opps. The page you request does not existed.'));
    }

    public function getProductColorPreview($productColorId)
    {
        return ProductColorPreviewImage::find()->andWhere(['product_color_id' => $productColorId])->asArray()->all();
    }

    public function getProductDetail($productUrl)
    {
        return Product::find()
            ->andWhere(['product.url_key' => $productUrl])
            ->joinWith('productColors')
            ->joinWith('category')
            ->asArray()->one();
    }

    public function filterPagination($arrayWherePagination, $page, $totalPage)
    {

        if ($totalPage == 0) {
            $productCount = Product::find()->andWhere($arrayWherePagination)->count();
            $totalPage = $productCount % 2 === 0 ? ($productCount / ITEM_PER_PAGE_FE) : floor($productCount / ITEM_PER_PAGE_FE) + 1;
        }

        $currentPos = ($page - 1) * ITEM_PER_PAGE_FE;
        $productWithRelations = Product::find()
            ->andWhere($arrayWherePagination)
            ->limit(ITEM_PER_PAGE_FE)
            ->offset($currentPos)
            ->asArray()
            ->all();

        $listIdProduct = [];

        foreach ($productWithRelations as $key => $value) {
            array_push($listIdProduct, $value['id']);
        }

        $product = Product::find()
            ->andWhere(['product.id' => $listIdProduct])
            ->joinWith('productColors')
            ->asArray()
            ->all();

        return [
            'products' => $product,
            'pagination' => [
                'totalPage' => $totalPage,
                'currentPage' => $page,
                'pageSize' => ITEM_PER_PAGE_FE
            ]
        ];
    }
}
