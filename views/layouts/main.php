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
use yii\widgets\Menu;

AppAsset::register($this);
SwiperAsset::register($this);
$lang=Yii::$app->language;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-touch-fullscreen" content="yes">
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
    if(Yii::$app->language=='ky')
    {$changeTo='Русский'; $lan='ru';$presidium='1';$dp='2';$apparatus='3';}
    else {$changeTo='Кыргызча'; $lan='ky';$presidium='6';$dp='7';$apparatus='8';}
    ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<div class="logo logo1 js_logo1"></div><div class="logo_name_mobile">'.Yii::t('app','Osh city Kenesh').'</div>',
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
                    ['label' => Yii::t('app', 'Decrees'), 'url' => ['/session/index']],
                    ['label' => Yii::t('app', 'Bills'), 'url' => ['/bill/index']],
                ],
            ],
            [
                'label' => Yii::t('app', 'Structure'),
                'items' => [
                    ['label' => Yii::t('app', 'Presidium'), 'url' => ['/page/'.$presidium]],
                    ['label' => Yii::t('app', 'Deputy Commission'), 'url' => ['/page/'.$dp]],
                    ['label' => Yii::t('app', 'Deputies'), 'url' => ['/deputy/index']],
                ],
            ],
            ['label' => Yii::t('app', 'Apparatus'), 'url' => ['/page/'.$apparatus]],
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
            'options' => ['class' => 'navbar-nav navbar-right langbar'],
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
        <div class="header_wrap">
            <div class="container newsrow">
                <div class="logowrap col-md-6">
                    <div class="logo logo2 pull-left"><?=Html::a('',Yii::$app->homeUrl,['style'=>'display: block; height: 103px;width: 102px;']);?></div>
                    <div class="logotext2 ltext_<?=Yii::$app->language;?>"><?=Html::a('',Yii::$app->homeUrl,['style'=>'display: block; height: 27px;width: 300px;']);?><?php //=Yii::t('app', 'Osh city Kenesh');?></div>
                </div>
                <div class="col-md-3 questions_wrap col-xs-12 pull-right">
                    <div class="ask btn btn-success" style="width:100%;">
                        <?=Html::a(Yii::t('app', 'Questions / Suggestions'),Url::toRoute(['feedback/create']))?>
                    </div>
                </div>
                <?php include_once('_search.php');?>
            </div>
        </div>
        <div class="container main_container">
            <?= Alert::widget() ?>
            <?php if(Yii::$app->controller->action->id=='view')
                echo Breadcrumbs::widget(['homeLink' =>['label' => Yii::t('app', 'Home'), 'url' => ['/index']],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
            <?= $content ?>
        </div>
        <?php
        if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index')
        {
        ?>
            <div class="container main_link">
                <?php
                $links = Yii::$app->db->createCommand("SELECT * FROM link ORDER BY `priority`")->noCache()->queryAll();
                foreach($links as $link){
                if($lang=='ru'){$ltitle=$link['title_ru'];} else{$ltitle=$link['title'];}
                ?>
                <div class="link_wrap pull-left">
                    <?php $uc="<div class='link_title'>{$ltitle}</div><div class='link_url'>{$link['url']}</div>";
                    echo Html::a($uc,'http://'.$link['url'],['target'=>'_blank']); ?>
                </div>
                <?php
                }
                ?>
            </div>
        <?
        }
        ?>

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
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-globe'></span>".Yii::t('app','Sessions'), ['/session/admin'],
                            ['title'=>Yii::t('app','Sessions'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
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
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-king'></span>".Yii::t('app','Toraga'), ['/toraga/update/1'],
                            ['title'=>Yii::t('app','Toraga'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
                    </li>
                    <li>
                        <?=Html::a("<span class='adminicon glyphicon glyphicon-link'></span>".Yii::t('app','Links'), ['/link/index'],
                            ['title'=>Yii::t('app','Links'),'data-toggle'=>'tooltip','data-placement'=>'left']);?>
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
            <div class="footer_menu row">
                <div class="footer_menu_item col-md-2">
                    <div class="footer_menu_item_title"><?=Yii::t('app', 'Documents') ?></div>
                    <?=Html::a(Yii::t('app', 'Legislation'),['/legislation/index']);?>
                    <?=Html::a(Yii::t('app', 'Decrees'),['/session/index']);?>
                    <?=Html::a(Yii::t('app', 'Bills'),['/bill/index']);?>
                </div>

                <div class="footer_menu_item col-md-2">
                    <div class="footer_menu_item_title"><?=Yii::t('app', 'Structure') ?></div>
                    <?=Html::a(Yii::t('app', 'Presidium'),['/page/1']);?>
                    <?=Html::a(Yii::t('app', 'Deputy Commission'),['/page/2']);?>
                    <?=Html::a(Yii::t('app', 'Deputies'),['/deputy/index']);?>
                </div>
                <div class="footer_menu_item col-md-2">
                    <div class="footer_menu_item_title"><?=Yii::t('app', 'Activity') ?></div>
                    <?=Html::a(Yii::t('app', 'Plans'),['/plan']);?>
                    <?=Html::a(Yii::t('app', 'Results'),['/results']);?>
                </div>
                <div class="footer_menu_item col-md-2">
                    <div class="footer_menu_item_title"><?=Yii::t('app', 'Contact') ?></div>
                    <?=Html::a(Yii::t('app', 'Contacts'),['/page/5']);?>
                    <?=Html::a(Yii::t('app', 'Vacancy'),['/page/4']);?>
                </div>
                <div class="footer_menu_item col-md-2 footer_menu_rest">
                    <?php
                        echo Html::a(Yii::t('app', 'News'), ['/news/index']);
                        echo Html::a(Yii::t('app', 'Apparatus'),'/page/3');
                        echo Html::a(Yii::t('app', 'Gallery'),['/gallery']);
                    ?>
                </div>
            </div>
            <div style="color:#fff; margin:15px 0;">

                <p class="pull-left"><?=Yii::t('app','Osh city Kenesh reference service:');?> (3222) 31-98-83</p>
                <p class="pull-right">&copy; <?=Yii::t('app','Osh city Kenesh');?> <?= date('Y') ?></p>
            </div>
        </div>
    </footer>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>