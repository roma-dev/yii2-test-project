<?php

use app\models\search\PostSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('main', 'Posts');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="posts-list">

    <div>
        <h1><?= Html::encode($this->title); ?></h1>
        <div class="text-right">
            <?= Html::a(Yii::t('main', 'Create post'), ['/admin/posts/create'], ['class' => 'btn btn-success']); ?>
        </div>
    </div>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'title',
                'value' => static function (PostSearch $model){
                    return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'is_visible',
                'value' => static function (PostSearch $model){
                    return $model->is_visible
                        ? Html::tag('span',Yii::t('main', 'Is visible'), ['class' => 'text-success'])
                        : Html::tag('span',Yii::t('main', 'Is hidden'), ['class' => 'text-danger']);
                },
                'format' => 'raw',
                'filter' => [
                    '0' => Yii::t('main', 'Is hidden'),
                    '1' => Yii::t('main', 'Is visible')
                ]
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', \Yii::$app->params['dateFormatForGrid']],
                'options' => ['width' => '200']
            ],
            [
                'attribute' => 'published_at',
                'format' => 'raw',
                'value' => static function (PostSearch $model){
                    return empty($model->published_at)
                        ? Html::a(
                            Yii::t('main', 'Publish'),
                            ['/admin/posts/published', 'id' => $model->id],
                            [
                                'data' => [
                                    'method' => 'post',
                                    'params' => [
                                        'id' => $model->id,
                                    ],
                                    'confirm' => Yii::t('main', 'Confirm post publication')
                                ],
                                'class' => 'btn btn-success',
                            ]
                        )
                        : Yii::$app->formatter->asDate($model->published_at, \Yii::$app->params['dateFormatForGrid']);
                }
            ],
        ]
    ]); ?>

</div>
