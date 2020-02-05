<?php

namespace app\controllers\admin;


use app\models\base\Posts;
use app\models\search\PostSearch;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\filters\VerbFilter;

class PostsController extends Admin
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'update' => ['post'],
                'published' => ['post'],
                'delete' => ['post'],
            ],
        ];

        return $behaviors;
    }

    public function actionList()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findPost($id)]);
    }

    public function actionUpdate($id)
    {
        $post = $this->findPost($id);

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            Yii::$app->session->addFlash('success', Yii::t('main', 'Data updated'));
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('view', ['model' => $post]);
    }

    public function actionPublished($id)
    {
        $post = $this->findPost($id);
        $post->is_visible = true;
        $post->published_at = time();

        if ($post->save()) {
            Yii::$app->session->addFlash('success', Yii::t('main', 'Data updated'));
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('view', ['model' => $post]);
    }

    public function actionDelete($id)
    {
        $post = $this->findPost($id);

        if ($post->delete()) {
            return $this->redirect(['list']);
        }

        throw new ErrorException(Yii::t('main', 'Failed to delete model: {class}::{id}', [
            'class' => Posts::class,
            'id' => $post->id
        ]));
    }

    public function actionCreate()
    {
        $post = new Posts();

        if (
            Yii::$app->request->isPost
            && $post->load(Yii::$app->request->post())
            && $post->save()
        ) {
            Yii::$app->session->addFlash('success', Yii::t('main', 'Post created'));
            return $this->redirect(['view', 'id' => $post->id]);
        }

        return $this->render('create', ['model' => $post]);
    }

    private function findPost($id)
    {
        $post = Posts::findOne($id);

        if ($post instanceof Posts) {
            return $post;
        }

        throw new Exception(Yii::t('main', 'Not found model: {0}', [Posts::class]));
    }
}