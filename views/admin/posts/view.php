<?php

use app\models\base\Posts;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Posts $model */

$this->title = \Yii::t('main', 'Post: {title}', ['title' => $model->title]);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('main', 'Posts'),
    'url' => ['list'],
];

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="post-view">

    <div class="row">
        <div class="col-sm-12">
            <h2><?= Html::encode($this->title); ?></h2>
        </div>
    </div>

    <div class="row">

        <div class="col-md-9">

            <?php $form = ActiveForm::begin([
                'action' => ['/admin/posts/update', 'id' => $model->id],
            ]); ?>

            <?= $form->field($model, 'title')->textInput(); ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]); ?>

            <?= $form->field($model, 'is_visible')->checkbox(); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('main', 'Refresh'), ['class' => 'btn btn-primary']); ?>

                <?php if ($model->published_at === null): ?>
                    <?= Html::a(
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
                    ); ?>
                <?php endif; ?>

                <?= Html::a(
                    Yii::t('main', 'Delete'),
                    ['/admin/posts/delete', 'id' => $model->id],
                    [
                        'data' => [
                            'method' => 'post',
                            'params' => [
                                'id' => $model->id,
                            ],
                            'confirm' => Yii::t('main', 'Confirm post deletion')
                        ],
                        'class' => 'btn btn-danger',
                    ]
                ); ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
