<?php

namespace backend\business;

use common\models\DesignProductDetail;
use common\models\DesignProductGroup;
use common\models\ProductColor;
use common\models\ProductColorPreviewImage;
use common\modules\file\business\BusinessFile;
use Yii;
use common\models\Product;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

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

    public static function types($val = false)
    {
        $arr = [
            Product::TYPE_DESIGN => Yii::t('app', 'Designable'),
            Product::TYPE_SIMPLE => Yii::t('app', 'Simple'),
        ];
        if ($val !== false) {
            return isset($arr[$val]) ? $arr[$val] : null;
        }

        return $arr;
    }

    public function create(Product $model, ObjectScalar $requestData) : bool
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function update(Product $model, ObjectScalar $requestData) : bool
    {
        $model->setAttributes($requestData->toArray());

        return $this->save($model);
    }

    public function save(Product $model) : bool
    {
        $status = $model->save($model);
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model, [], ['image_path' => $model->name]);
        }
        return $status;
    }

    public function newModel()
    {
        return new Product();
    }

    public function findModel($id) : Product
    {
        $model = Product::findOneOrFail($id);

        return $model;
    }

    public function delete(Product $product) : bool
    {
        $productColors = $this->findProductColors($product);
        foreach ($productColors as $productColor) {
            ProductColorPreviewImage::deleteAll(['product_color_id' => $productColor->id]);
        }

        ProductColor::deleteAll(['product_id' => $product->id]);
        return $product->delete();
    }

    public function newProductColor(Product $product)
    {
        return new ProductColor([
            'product_id' => $product->id,
            'priority' => count($this->findProductColors($product)) + 1,
        ]);
    }

    public function saveProductColor(ProductColor $productColor, ObjectScalar $postData)
    {
        $productColor->setAttributes($postData->toArray());
        $status = $productColor->save();
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($productColor, [], ['refer_product_image_path' => $productColor->color_name]);
        }
        return $status;
    }

    public function newProductColorPreviewImage(ProductColor $productColor)
    {
        return new ProductColorPreviewImage([
            'product_color_id' => $productColor->id,
        ]);
    }
    
    public function createProductColorPreviewImages(ProductColor $productColor, ProductColorPreviewImage $previewImage)
    {
        if ($previewImage->save()) {
            BusinessFile::getInstance()->doUploadAndSave($previewImage, [], ['path' => $productColor->color_name . time()]);
        }
        return true;

    }

    public function findProductColors(Product $product)
    {
        return $product->productColors;
    }

    public function findOneOrFailProductColor($productColorId) : ProductColor
    {
        return ProductColor::findOneOrFail($productColorId);
    }

    public function deleteProductColor(ProductColor $productColor)
    {
        ProductColorPreviewImage::deleteAll(['product_color_id' => $productColor->id]);
        return $productColor->delete();
    }

    public function findOneOrFailProductColorPreviewImage($id) : ProductColorPreviewImage
    {
        return ProductColorPreviewImage::findOneOrFail($id);
    }

    public function findStoredProductColorPreviewImages(ProductColor $productColor)
    {
        return $productColor->productColorPreviewImages;
    }
    
    /* DESIGN PRODUCTS */

    public function newDesignProductGroup(Product $product)
    {
        return new DesignProductGroup([
            'product_id' => $product->id,
            'priority' => count($this->findStoredDesignProductGroups($product)) + 1,
        ]);
    }

    public function findOneOrFailDesignProductGroup($designProductGroupId) : DesignProductGroup
    {
        return DesignProductGroup::findOneOrFail($designProductGroupId);
    }

    public function saveDesignProductGroup(DesignProductGroup $productGroup, ObjectScalar $postData)
    {
        $productGroup->setAttributes($postData->toArray());
        return $productGroup->save();
    }

    public function findStoredDesignProductGroups(Product $product)
    {
        return $product->designProductGroups;
    }

    public function deleteDesignProductGroup(DesignProductGroup $productGroup){
        DesignProductDetail::deleteAll(['product_group_id' => $productGroup->id]);
        return $productGroup->delete();
    }

    public function findOrNewDesignProductDetail(DesignProductGroup $productGroup, $designProductDetailId = null) : DesignProductDetail
    {
        $productDetail = DesignProductDetail::findOneOrNew($designProductDetailId);
        if ($productDetail->isNewRecord) {
            $productDetail->product_group_id = $productGroup->id;
        }
        return $productDetail;
    }

    public function findOneOrFailDesignProductDetail($id): DesignProductDetail
    {
        return DesignProductDetail::findOneOrFail($id);
    }

    public function deleteDesignProductDetail(DesignProductDetail $productDetail){
        return $productDetail->delete();
    }

    public function findStoredDesignProductDetails(DesignProductGroup $productGroup)
    {
        return $productGroup->designProductDetails;
    }

    public function saveDesignProductDetail(DesignProductDetail $productDetail, ObjectScalar $postData)
    {
        $productDetail->setAttributes($postData->toArray());
        $status = $productDetail->save();
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($productDetail, [], ['path' => $productDetail->name]);
        }
        return $status;
    }
    
}