<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\components\widgets\Alert;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\SwiperAsset;

AppAsset::register($this);
SwiperAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <link rel="shortcut icon" href="<?=Yii::getAlias('@web');?>/favicon.ico?v=2" type="image/x-icon" />
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css">
            .admin-panel{
                background-color: #eaeaea;
                box-shadow: 0 0 2px #777;
                color: #676767;
                height: 100%;
                padding-top: 16px;
                position: fixed;
                right: 0;
                top:0;
                width: 40px;
                z-index: 2000;
            }
            .admin-panel ul{list-style-type: none;
                padding: 0;margin-top: 28px;}
            .admin-panel ul li{ margin: 10px 0;}
            .admin-panel ul li a{padding: 5px 0 5px 13px; text-decoration: none; white-space: nowrap;}
            .panel-opened{width: 140px;}
            .adminicon{color:#3a5a96;; padding-right: 13px;}
            .adminicon:hover, a:hover .adminicon{cursor:pointer;color:#1e2d4c;}
            .tooltiphide .tooltip{display:none !important;}
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- facebook begin ----->
    <div id="fb-root"></div>
    <!-- facebook end----->
    <?php
    $current_url=Url::current();
    $yiiuser=Yii::$app->user;
    if(Yii::$app->language=='ky') {$changeTo='Русский'; $lan='ru';} else {$changeTo='Кыргызча'; $lan='ky';}
    ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<div class="logo logo1 js_logo1"></div>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if ($yiiuser->isGuest) {
            $addItems=['label' => Yii::t('app', 'Sign in'), 'url' => ['/site/login']];
        } else {
            $addItems=['label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        $navItems=[
            ['label' => Yii::t('app', 'Home'), 'url' => ['/']],
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
            [
                'label' => Yii::t('app', 'Activity'),
                'items' => [
                    ['label' => Yii::t('app', 'Plans'), 'url' => ['/plan']],
                    ['label' => Yii::t('app', 'Results'), 'url' => ['/results']],

                ],
            ],
            ['label' => Yii::t('app', 'Gallery'), 'url' => ['/gallery']],
            [
                'label' => Yii::t('app', 'Contact'),
                'items' => [
                    ['label' => Yii::t('app', 'Contacts'), 'url' => ['/page/5']],
                    ['label' => Yii::t('app', 'Vacancy'), 'url' => ['/page/4']],
                    $addItems

                ],
            ],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => $changeTo, 'url' => ['site/language', 'l' => $lan]],
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $navItems,
        ]);
        NavBar::end();
        ?>
        <div class="container">
            <?= Alert::widget() ?>
            <?php if(Yii::$app->controller->action->id=='view')
                echo Breadcrumbs::widget(['homeLink' =>['label' => Yii::t('app', 'Home'), 'url' => ['/index']],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
            <?= $content ?>
        </div>
    </div>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <section>
            <div class="admin-panel js_panel">
                <span class='adminicon glyphicon glyphicon-option-vertical js_panel_toggle' style='padding-left:13px;'></span>
                <ul>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-header'></span>".Yii::t('app','News'), ['/news/admin'],
                            ['title'=>Yii::t('app','News'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-picture'></span>".Yii::t('app','Gallery'), ['/gallery/admin'],
                            ['title'=>Yii::t('app','Gallery'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-bullhorn'></span>".Yii::t('app','Announces'), ['/announce/admin'],
                            ['title'=>Yii::t('app','Announces'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-user'></span>".Yii::t('app','Deputies'), ['/deputy/admin'],
                            ['title'=>Yii::t('app','Deputies'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-bookmark'></span>".Yii::t('app','Laws'), ['/legislation/admin'],
                            ['title'=>Yii::t('app','Laws'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-folder-close'></span>".Yii::t('app','Decrees'), ['/decree/admin'],
                            ['title'=>Yii::t('app','Decrees'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-folder-open'></span>".Yii::t('app','Bills'), ['/bill/admin'],
                            ['title'=>Yii::t('app','Bills'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-duplicate'></span>".Yii::t('app','Pages'), ['/page/admin'],
                            ['title'=>Yii::t('app','Pages'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-envelope'></span>".Yii::t('app','Feedback '), ['/feedback/admin'],
                            ['title'=>Yii::t('app','Feedback '),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-comment'></span>".Yii::t('app','Comments '), ['/comment/admin'],
                            ['title'=>Yii::t('app','Comments'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                </ul>
            </div>
        </section>
    <?php
    }?>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=Yii::t('app', 'Authentication');?></h4>
                </div>
                <div class="modal-body">
                    <div class="socialicons adf">
                        <div class="fb_icon s_icon" style="margin: 0;">
                            <?=Html::a('Facebook',['site/redirect','to'=>'fb','from'=>$current_url],['title'=>'facebook']);?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('app', 'Close');?></button>
                </div>
            </div>

        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Ош Шаардык Кеңеши <?= date('Y') ?></p>

            <p class="pull-right"></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>