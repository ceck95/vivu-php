<?php

namespace backend\controllers;

use backend\business\BusinessSite;
use common\models\Trip;
use Yii;
use backend\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends BackendBaseController
{
    /**
     * @var BusinessSite
     */
    private $business;

    public function init()
    {
        $this->business = BusinessSite::getInstance();
        parent::init();
    }

    /**
     * @inheritdoc
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $order = $this->business->calculatorOrder();
        $inCome = $this->business->totalInCome();
        $totalCustomerAndProduct = $this->business->totalCustomerAndOrderS();

        $this->setVars([
            'order' => $order,
            'inCome' => $inCome,
            'totalCustomerAndProduct' => $totalCustomerAndProduct
        ]);
    }

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
            $model = adminuser();

            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateProfile()
    {
        $model = adminuser();
        $post = $this->getPostObject('User');
        if (!$post->isEmpty()) {
            if ($this->business->updateProfile($model, $post)) {
                flassSuccess(Yii::t('app', 'Update your profile successfully'));

                return $this->redirect(['profile']);
            }
            flassError();
        }

        return $this->render('update-profile', ['model' => $model,]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (adminuser()->status == STATUS_HIDE) {
                Yii::$app->session->setFlash('error', 'You are not active.');

                return $this->redirect(['site/login']);
            } else {
                return $this->goBack();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword()
    {
        $model = adminuser();
        $data = $this->getPostObject('User');
        if (!$data->isEmpty()) {
            $model->setPassword($data['password_hash']);
            if ($model->save(false)) {
                flassSuccess(Yii::t('app', 'Change password successfully'));
                return $this->redirect(['profile']);
            }
        }
        $this->setVar('model', $model);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
