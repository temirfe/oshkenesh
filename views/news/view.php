<?php

use yii\helpers\Html;
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
    .avatar-col{ margin-top: 6px;}
    .comment-wrap{clear:both;}
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

            <div class="comment-wrap">
                <div class="avatar-col pull-left">
                    <?=Html::img('@web/images/avatar.png',['class'=>'avatar']); ?>
                </div>
                <div class="comment-form">

                    <?php

                    $urname=Yii::t('app', 'Your name');

                    $cmodel=new Comment; $form = ActiveForm::begin([
                        'action'=>['comment/create'],
                    ]); ?>

                    <?= $form->field($cmodel, 'name',['options' => ['style'=>'width:200px;margin-top: -14px;']])->textInput(['maxlength' => true,'placeholder'=>'name'])->label('') ?>

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
</article>

