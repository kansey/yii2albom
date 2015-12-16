<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Gallery',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
     
   if (Yii::$app->user->isGuest) {
       echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => [
                ['label' => 'Home',    'url' => ['/site/index']],
                ['label' => 'SignUp',  'url' =>['/site/signup']],
                ['label' => 'Login', 'url' => ['/site/login']]
            ]
        ]);
        NavBar::end();
   }
   else {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items'   => [
                ['label' => 'Home',    'url' => ['/site/index']],
                [
                  'label' => 'Logout (' . Yii::$app->user->identity->login . ')',
                  'url' => ['/site/logout'],
                  'linkOptions' => ['data-method' => 'post']
                ],
                ['label' => 'Show',    'url' => ['/image/show']],
                ['label' => 'Edit',    'url' => ['/image/edit']],
            ]
        ]);
        NavBar::end();
   }

    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
