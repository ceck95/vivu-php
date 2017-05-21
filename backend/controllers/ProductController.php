<?php

namespace backend\controllers;

use backend\business\BusinessCategory;
use backend\business\BusinessCategoryGroup;
use common\Factory;
use frontend\business\BusinessQuoteItem;
use Yii;
use backend\business\BusinessProduct;
use backend\models\ProductSearch;

class ProductController extends BackendBaseController
{
    /** @var BusinessProduct */
    private $business;

    /** @var BusinessCategory */
    private $businessCategory;

    /** @var BusinessCategoryGroup */
    private $businessCategoryGroup;


    public function init()
    {
        $this->business = BusinessProduct::getInstance();
        $this->businessCategory = BusinessCategory::getInstance();
        $this->businessCategoryGroup = BusinessCategoryGroup::getInstance();
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categoryList = $this->businessCategory->findAllJoinCategoryGroup();
        $respCategoryList = [];
        foreach ($categoryList as $value) {
            if (count($value['categories']) > 0) {
                $arrayCategory = [];
                foreach ($value['categories'] as $a) {
                    $arrayCategory[$a['id']] = $a['name'];
                }

                $respCategoryList[$value['name']] = $arrayCategory;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryList' => $respCategoryList,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->business->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = $this->business->newModel();
        $categoryList = $this->businessCategory->findCategoryList();
        $categoryGroupList = $this->businessCategoryGroup->findCategoryGroupList();

        $postObject = $this->getPostObject('Product');

        if (!$postObject->isEmpty()) {

            $createStatus = $this->business->create($model, $postObject);

            if (empty($createStatus->getErrors())) {
                if (!$postObject->is_product_color) {
                    $this->business->createProductColorForProuctNotColor($createStatus);
                }
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList->toArray(),
            'categoryGroupList' => $categoryGroupList->toArray()
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->business->findModel($id);
        $categoryGroupList = $this->businessCategoryGroup->findCategoryGroupList();

        $postObject = $this->getPostObject('Product');
        if (!$postObject->isEmpty()) {
            $updateStatus = $this->business->update($model, $postObject);
            if ($updateStatus === true) {
                flassSuccess();

                return $this->redirect(['index']);
            } else {
                flassError();
            }
        }

        $this->addJsParams([
            'categoryId' => $model->category->id,
            'categoryGroupId' => $model->category->category_group_id
        ]);

        return $this->render('update', [
            'model' => $model,
            'categoryGroupList' => $categoryGroupList->toArray(),
        ]);
    }

    public
    function actionDelete($id)
    {
        $product = $this->business->findModel($id);
        $status = $this->business->delete($product);
        if ($status) {
            flassSuccess();
        } else {
            flassError();
        }

        return $this->redirect(['index']);
    }

//Simple Products & Its Relations
    public
    function actionManageSimpleProduct($id)
    {
        $product = $this->business->findModel($id);
        $productColor = $this->business->newProductColor($product);

        $productColorPostData = $this->getPostObject('ProductColor');
        if (!$productColorPostData->isEmpty()) {
            $status = $this->business->saveProductColor($productColor, $productColorPostData);
            if ($status) {
                flassSuccess();
                return $this->refresh();
            }
            flassError();
        }

        $this->setVars([
            'product' => $product,
            'productColor' => $productColor,
            'storedProductColors' => $this->business->findProductColors($product),
        ]);
    }

    public
    function actionUpdateSimpleProductColor($productColorId)
    {
        $productColor = $this->business->findOneOrFailProductColor($productColorId);
        $storedPreviewImages = $this->business->findStoredProductColorPreviewImages($productColor);
        $productColorPostData = $this->getPostObject('ProductColor');
        $productColorPreviewImage = $this->business->newProductColorPreviewImage($productColor);
        if (!$this->getPostObject()->isEmpty()) {
            if (!$productColorPostData->isEmpty()) {
                $status = $this->business->saveProductColor($productColor, $productColorPostData);
            } else {
                $status = true;
            }

            if ($status) {
                if ($this->business->createProductColorPreviewImages($productColor, $productColorPreviewImage)) {
                    flassSuccess();
                    return $this->refresh();
                } else {
                    flassError();
                }
            } else {
                flassError();
            }
        }

        $this->setVars([
            'product' => $productColor->product,
            'productColor' => $productColor,
            'storedPreviewImages' => $storedPreviewImages,
            'productColorPreviewImage' => $productColorPreviewImage,
        ]);
    }

    public
    function actionDeleteSimpleProductColor($productColorId)
    {
        $productColor = $this->business->findOneOrFailProductColor($productColorId);
        if ($this->business->deleteProductColor($productColor)) {
            flassSuccess();
        } else {
            flassError();
        }

        return $this->redirect(Factory::$app->request->referrer);
    }

    public
    function actionDeleteProductColorPreviewImage($id)
    {
        if ($this->business->findOneOrFailProductColorPreviewImage($id)->delete()) {
            flassSuccess();
        } else {
            flassError();
        }
        return $this->redirect(Factory::$app->request->referrer);
    }

    public
    function actionManageDesignProduct($id)
    {
        $product = $this->business->findModel($id);
        $storedDesignProductGroups = $this->business->findStoredDesignProductGroups($product);
        $designProductGroup = $this->business->newDesignProductGroup($product);

        $groupPostData = $this->getPostObject('DesignProductGroup');
        if (!$groupPostData->isEmpty()) {
            $status = $this->business->saveDesignProductGroup($designProductGroup, $groupPostData);
            if ($status) {
                flassSuccess();
            } else {
                flassError();
            }
            return $this->redirect(Factory::$app->request->referrer);
        }

        $this->setVars([
            'product' => $product,
            'storedDesignProductGroups' => $storedDesignProductGroups,
            'designProductGroup' => $designProductGroup,
        ]);
    }

    public
    function actionUpdateDesignProductGroup($designProductGroupId, $designProductDetailId = null)
    {
        $designProductGroup = $this->business->findOneOrFailDesignProductGroup($designProductGroupId);
        $storedDesignProductDetails = $this->business->findStoredDesignProductDetails($designProductGroup);
        $designProductDetail = $this->business->findOrNewDesignProductDetail($designProductGroup, $designProductDetailId);
        $designProductGroupPostData = $this->getPostObject('DesignProductGroup');

        if (!$designProductGroupPostData->isEmpty()) {
            $status = $this->business->saveDesignProductGroup($designProductGroup, $designProductGroupPostData);
            if ($status) {
                if ($designProductDetail->isNewRecord && $this->getPostObject('isAddNewDesignProductDetail')->isEmpty()) {
                    flassSuccess();
                    return $this->refresh();
                }

                if ($this->business->saveDesignProductDetail($designProductDetail, $this->getPostObject('DesignProductDetail'))) {
                    flassSuccess();
                    return $this->refresh();
                } else {
                    flassError();
                }
            } else {
                flassError();
            }
        }

        $this->setVars([
            'product' => $designProductGroup->product,
            'designProductGroup' => $designProductGroup,
            'designProductDetail' => $designProductDetail,
            'storedDesignProductDetails' => $storedDesignProductDetails,
        ]);
    }

    public
    function actionDeleteDesignProductGroup($designProductGroupId)
    {
        $productGroup = $this->business->findOneOrFailDesignProductGroup($designProductGroupId);
        if ($this->business->deleteDesignProductGroup($productGroup)) {
            flassSuccess();
        } else {
            flassError();
        }

        return $this->redirect(Factory::$app->request->referrer);
    }

    public
    function actionDeleteDesignProductDetail($id)
    {
        $productDetail = $this->business->findOneOrFailDesignProductDetail($id);
        if ($this->business->deleteDesignProductDetail($productDetail)) {
            flassSuccess();
        } else {
            flassError();
        }

        return $this->redirect(Factory::$app->request->referrer);
    }


}