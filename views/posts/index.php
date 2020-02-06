<?php

use app\models\base\Posts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var Posts[] $posts */
?>

    <div class="row">
        <?php if (isset($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="col-lg-12">
                    <h2><?= Html::encode($post->title); ?></h2>

                    <p><?= Html::encode($post->content); ?></p>

                    <p><a class="btn btn-default" href="<?= Url::to(['/post', 'id' => $post->id]);?>"><?= Yii::t('main', 'More details')?> &raquo;</a></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>


