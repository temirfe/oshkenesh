<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
?>
<style type="text/css">
    .comment-form{overflow: hidden;
        width: 84%;padding-left: 12px;}
    .help-block {margin-bottom: 0;}
    .avatar{width:50px;}
    .avatar-col{ margin-top: 5px;}
    .comment-wrap{clear:both;}
    .comment-col{ margin-top: 2px;}
    .comment-name{font-weight: bold;}
    .comment-date{color: #777;
        display: inline-block;
        font-size: 12px;
        line-height: 21px;
        margin-left: 15px;}
    .comment-row{border-top: 1px solid #eaeaea;
        margin: 15px 0 23px;
        overflow: hidden;
        padding-top: 10px;}
    .comment-row .avatar-col{ margin-right: 14px;}
    .twi-button{margin:0 6px 0 101px;}
    .social-wrap{margin-top: 45px;
        position: relative;
        width: 100%;}
    .fb-button{position: absolute; left: 0; top:1px;}
    .my-button{width: 93px;}
    .print-button{margin-top: 3px;}
</style>
<article class="news_view">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <div class="btn-group" role="group" aria-label="admin-actions">
                <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true" title="'.Yii::t('app', 'Update').'"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true" title="'.Yii::t('app', 'Delete').'"></span>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <?php
    }?>


    <h1 class="news_title"><?= Html::encode($this->title) ?></h1>

    <!--<div>
        <?/*=$model->description;*/?>
    </div>-->

    <div class="entry_news_date">
        <?=date("d.m.Y",strtotime($model->date));?>
    </div>
    <br />
    <div class="row-fluid">
        <div class="col-md-8 col-lg-8 text-content">
            <div>
                <?=Html::img("@web/uploads/images/".$model->image, ['class'=>'news_image', 'alt'=>''])?>
            </div>
            <div class="article_text">
                <?=$model->content;?>
            </div>

            <div class="social-wrap iblock">

                <div class="fb-button iblock">
                    <div class="fb-share-button" data-href="<?=Url::toRoute(['news/view','id'=>$model->id],true)?>" data-layout="button"></div>
                </div>
                <div class="twi-button iblock">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru" data-count="none">Твитнуть</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                <div class="my-button iblock">
                    <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{'nc' : '1', 'cm' : '2', 'sz' : '20', 'st' : '3', 'tp' : 'mm'}">Нравится</a>
                    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
                </div>

                <div class="ok-button iblock">
                    <div id="ok_shareWidget"></div>
                </div>

                <div class="print-button pull-right">
                    <a href="javascript:window.print()" class="print print_hide nodecor printshare"><span class="glyphicon glyphicon-print"></span> <?=Yii::t('app', 'Print')?></a>
                </div>
            </div>
            <div class="comment-wrap">

                <h3 class="dots"><?=Yii::t('app', 'Comments');?></h3>
                <div class="news-comments">
                    <?php foreach($model->comments as $comment){
                        if($comment['public'])
                        {
                        ?>
                        <div class="comment-row">
                            <div class="avatar-col pull-left iblock">
                                <?=Html::img('@web/images/avatar.png',['class'=>'avatar']); ?>
                            </div>
                            <div class="comment-col">
                                <div class="comment-name pull-left"><?=$comment['name'];?></div>
                                <div class="comment-date"><?=date('m.d.Y, H:i',strtotime($comment['date']));?></div>
                                <div class="comment-content"><?=$comment['content'];?></div>
                            </div>
                        </div>
                    <?php
                        }
                    }?>
                </div>
                <hr />
                <div class="avatar-col pull-left">
                    <?=Html::img('@web/images/avatar.png',['class'=>'avatar']); ?>
                </div>
                <div class="comment-form">
                    <?php
                    $cmodel=new Comment; $form = ActiveForm::begin([
                        'action'=>['comment/create'],
                    ]); ?>

                    <?= $form->field($cmodel, 'name',['options' => ['style'=>'width:200px;margin-top: -14px;']])->textInput(['maxlength' => true,'placeholder'=>Yii::t('app', 'Your name')])->label('') ?>

                    <?= $form->field($cmodel, 'content')->textArea(['maxlength' => true, 'rows'=>6])->label('') ?>

                    <?=Html::activeHiddenInput($cmodel,'model_name',['value'=>'news'])?>
                    <?=Html::activeHiddenInput($cmodel,'model_id',['value'=>$model->id])?>

                    <div class="form-group">
                        <?= Html::submitButton( Yii::t('app', 'Add comment'), ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-md-4 document-description">
            <a href="javascript:window.print()" class="print print_hide nodecor printshare"><span class="glyphicon glyphicon-print"></span> <?=Yii::t('app', 'Print')?></a>
        </div>
    </div>
    <script>
        !function (d, id, did, st) {
            var js = d.createElement("script");
            js.src = "https://connect.ok.ru/connect.js";
            js.onload = js.onreadystatechange = function () {
                if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                    if (!this.executed) {
                        this.executed = true;
                        setTimeout(function () {
                            OK.CONNECT.insertShareWidget(id,did,st);
                        }, 0);
                    }
                }};
            d.documentElement.appendChild(js);
        }(document,"ok_shareWidget",document.URL,"{width:115,height:30,st:'straight',sz:20,ck:2,nc:1}");


        <!-- facebook begin ----->
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.4&appId=892335240862509";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    <!-- facebook end----->
    </script>
