<?php
namespace frontend\controllers;

use backend\business\BusinessArticle;
use backend\business\BusinessBoxItem;
use common\Factory;
use common\models\Box;
use common\models\Contact;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'frontend\handler\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function init()
    {
        $this->layout = 'home-page';
        parent::init();
    }

    public function actionIndex()
    {
        $businessBoxItems = BusinessBoxItem::getInstance();
        $this->setVars([
            'slideShow' => $businessBoxItems->getBoxItemForSlideShow(),
            'boxItemsForProduct' => $businessBoxItems->getBoxItemsByBox(['code' => Box::CODE_OF_PRODUCT_MODULE_HOME_PAGE]),
            'boxItemsForNewFeed' => $businessBoxItems->getBoxItemsByBox(['code' => Box::CODE_OF_NEW_FEED_HOME_PAGE]),
            'boxItemsForIntroWelcome' => $businessBoxItems->getBoxItemsByBox(['code' => Box::CODE_OF_INTRO_WELCOME_HOME_PAGE]),
            'boxItemsForBlogArticles' => BusinessArticle::getInstance()->getArticles(),
        ]);
    }

    public function actionGetBaseParams()
    {
        $this->setVars([
            'env_prod' => true,
        ]);
        $this->responseJson();
    }
    public function actionContact()
    {
        $this->layout = 'home-page';
        $model = new Contact();
        $message = null;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()){
                $message = Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.');
            }
        }
        return $this->render('contact', [
            'model' => $model,
            'message' => $message
        ]);
    }
    
}
