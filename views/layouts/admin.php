<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php if (!Yii::$app->user->isGuest): ?>
        <?php
    NavBar::begin([
        'brandLabel' => Yii::t('main', 'Dashboard'),
        'brandUrl' => '/admin/dashboard',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('main', 'Posts'), 'url' => ['/admin/posts/list']],
            Yii::$app->user->isGuest
                ? (['label' => Yii::t('main', 'Login'), 'url' => ['/admin/dashboard/login']])
                : ('<li>'
                    . Html::beginForm(['/admin/dashboard/logout'], 'post')
                    . Html::submitButton(Yii::t('main', 'Logout'), ['class' => 'btn btn-link logout'])
                    . Html::endForm()
                    . '</li>')
        ],
    ]);
    NavBar::end();
    ?>
    <?php endif; ?>

    <div class="container">

        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Breadcrumbs::widget([
                'homeLink' => ['url' => '/admin/dashboard', 'label' => Yii::t('main', 'Dashboard')],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        <?php endif; ?>

        <?= $content ?>
    </div>
</div>

<?php if (!Yii::$app->user->isGuest): ?>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
