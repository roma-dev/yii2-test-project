<?php


namespace app\controllers\admin;


use app\models\search\PostSearch;
use Yii;

class PostsController extends Admin
{
    public function actionList()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}