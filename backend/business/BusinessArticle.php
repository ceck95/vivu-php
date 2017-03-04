<?php

namespace backend\business;

use common\modules\file\business\BusinessFile;
use common\models\Article;
use common\business\BaseBusinessPublisher;
use common\core\oop\ObjectScalar;

class BusinessArticle extends BaseBusinessPublisher
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create(Article $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function update(Article $model, ObjectScalar $requestData)
    {
        $model->setAttributes($requestData->toArray());
        
        return $this->save($model);
    }
    
    public function save(Article $model)
    {
        $status = $model->save($model);
        //uncomment if upload file
        if ($status) {
            BusinessFile::getInstance()->doUploadAndSave($model, [], ['thumbnail_image' => $model->url_key]);
        }
        return $status;
    }

    public function newModel()
    {
        return new Article();
    }

    /**
    * @param $id
    * @return Article
    * @throws \yii\web\NotFoundHttpException
    */
    public function findModel($id)
    {
        $model = Article::findOneOrFail($id);

        return $model;
    }

    /**
     * @param array $condition
     * @param int $limit
     * @return Article[]
     */
    public function getArticles($condition = [], $limit = 3)
    {
        return Article::find()
            ->andWhere($condition)
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    /**
     * @param Article $article
     * @return Article
     */
    public function updateNumberView(Article $article)
    {
        $article->num_view +=1;
        $article->save(false);
        return $article;
    }

}