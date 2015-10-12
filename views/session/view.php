<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sessions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-view">
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
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Decree'), ['/decree/create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php
    }?>
    <div class="entry_news_date"><?=date('d.m.Y', strtotime($model->date));?></div>
    <div class="description"><?=$model->description;?></div>
<br />
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => Yii::t('app', 'No results found'),
        'columns' => [
            [
                'attribute' => 'number',
                'format' => 'text',
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle;'],
                'headerOptions' => ['width' => '80'],
            ],
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a(Html::encode($model->title),Url::toRoute(['decree/view','id'=>$model->id]));
                },
                'contentOptions' => ['style' => 'max-width:500px;']
            ],
            [
                'label' => Yii::t('app', 'Download'),
                'format' => 'html',
                'value' => function($model) {
                    $value='';
                    if($model->word){
                        if($model->word_size > 1024) $word_size=round($model->word_size/1024,2)." MB"; else $word_size=$model->word_size." KB";
                        $value.='<div><span class="glyphicon glyphicon-file blue"></span> '.Html::a(Yii::t('app', 'Document in MS Word')." (".$word_size.")",
                                "@web/uploads/files/".$model->word, ['class' => ''])."</div>";
                    }

                    if($model->pdf) {
                        if($model->pdf_size > 1024) $pdf_size=round($model->pdf_size/1024,2)." MB"; else $pdf_size=$model->pdf_size." KB";
                        $value.='<div><span class="glyphicon glyphicon-file blue"></span> '.Html::a(Yii::t('app', 'Document in PDF')."
                    (".$pdf_size.")", "@web/uploads/files/".$model->pdf, ['class' => ''])."</div>";
                    }
                    return $value;
                },
                'contentOptions' => ['style' => 'vertical-align:middle;']
            ],
        ],
        'layout' => "{items}\n{pager}",
    ]); ?>

</div>
