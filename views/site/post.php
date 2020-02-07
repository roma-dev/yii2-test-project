<?php

use app\models\base\Posts;
use yii\helpers\Html;

/** @var Posts $post */

$this->params['breadcrumbs'][] = $post->title;

?>

<div class="row">
    <div class="col-lg-12">
        <h2><?= Html::encode($post->title); ?></h2>

        <p><?= Html::encode($post->content); ?></p>
    </div>
</div>