<?php

namespace app\controllers\admin;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class Admin extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function () {
                    throw new ForbiddenHttpException();
                }
            ],
        ];
    }
}