<?php

namespace app\controllers\admin;


use app\models\form\LoginForm;
use Yii;

class DashboardController extends Admin
{
    const DASHBOARD_URL = '/admin/dashboard';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(self::DASHBOARD_URL);
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(self::DASHBOARD_URL);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}