<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\components\widgets\Alert;
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
    <?php
    $yiiuser=Yii::$app->user;
    if(!$yiiuser->isGuest){
        $username=$yiiuser->identity->username;
        $userid=$yiiuser->identity->id;
    }

    //$isAdmin=$yiiuser->identity->isAdmin;
    ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar',
            ],
        ]);
        $navItems=[
            ['label' => Yii::t('app', 'News'), 'url' => ['/news/index']],
            [
                'label' => Yii::t('app', 'Documents'),
                'items' => [
                    ['label' => Yii::t('app', 'Legislation'), 'url' => ['/legislation/index']],
                    ['label' => Yii::t('app', 'Decrees'), 'url' => ['/decree/index']],
                    ['label' => Yii::t('app', 'Bills'), 'url' => ['/bill/index']],
                ],
            ],
            [
                'label' => Yii::t('app', 'Structure'),
                'items' => [
                    ['label' => Yii::t('app', 'Presidium'), 'url' => ['/page/1']],
                    ['label' => Yii::t('app', 'Deputy Commission'), 'url' => ['/page/2']],
                    ['label' => Yii::t('app', 'Deputies'), 'url' => ['/deputy/index']],
                ],
            ],
            ['label' => Yii::t('app', 'Apparatus'), 'url' => ['/page/3']],
            ['label' => Yii::t('app', 'Activity'), 'url' => ['#']],
            ['label' => Yii::t('app', 'Gallery'), 'url' => ['#']],
            ['label' => Yii::t('app', 'Vacancy'), 'url' => ['/page/4']],
            ['label' => Yii::t('app', 'Contacts'), 'url' => ['/page/5']],
        ];
        if ($yiiuser->isGuest) {
            array_push($navItems,['label' => Yii::t('app', 'Sing in'), 'url' => ['/site/login']],['label' => 'Sign Up', 'url' => ['/site/signup']]);
        } else {
            array_push($navItems,['label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]);
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $navItems,
        ]);
        NavBar::end();
        ?>

        <?php

        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; CollegeStatistics <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>