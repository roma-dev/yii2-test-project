<?php

use app\models\base\Posts;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Posts $model */

$this->title = \Yii::t('main', 'Create post');

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
                'action' => ['/admin/posts/create'],
            ]); ?>

            <?= $form->field($model, 'title')->textInput(); ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]); ?>

            <?= $form->field($model, 'is_visible')->checkbox(); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('main', 'Create'), ['class' => 'btn btn-primary']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
