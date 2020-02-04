<?php

namespace app\controllers\admin;


class DashboardController extends Admin
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}