<?php

namespace app\controllers;


use app\models\base\Posts;
use yii\data\Pagination;
use yii\web\Controller;

class PostsController extends Controller
{
    public function actionIndex()
    {
        $query = Posts::find()
            ->where(['is_visible' => Posts::POST_VISIBLE]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => \Yii::$app->params['paginatorPageSize']
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'posts' => $models,
            'pages' => $pages,
        ]);
    }
}