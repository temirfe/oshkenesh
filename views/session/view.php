<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decrees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$avisible=false;
?>
<div class="session-view">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <div class="btn-group" role="group" aria-label="admin-actions">
                <?= Html::a(Yii::t('app', 'Create Decree'), ['/decree/create','s'=>$model->id], ['class' => 'btn btn-success btn-sm','style'=>'margin-right:15px;']) ?>
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
        $avisible=true;
    }?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="entry_news_date"><?=date('d.m.Y', strtotime($model->date));?></div>
    <div class="description"><?=$model->description;?></div>
    <br />
    <div class="content"><?=$model->content;?></div>
<br />
    <?php
    if($dataProvider->getCount()){
        echo GridView::widget([
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
                            if(strpos($model->word,'.xls')!==false) $document='Document in MS Excel'; else $document='Document in MS Word';
                            $value.='<div><span class="glyphicon glyphicon-file blue"></span> '.Html::a(Yii::t('app', $document)." (".$word_size.")",
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
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>[
                        'view' => function ($url, $model, $key) {
                            return Html::a("<span class='glyphicon glyphicon-eye-open'></span>", ['/decree/view','id'=>$model->id]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['/decree/update','id'=>$model->id]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a("<span class='glyphicon glyphicon-trash red'></span>", ['/decree/delete','id'=>$model->id,'s'=>$model->session_id],['data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],]);
                        },
                    ], 'visible'=>$avisible
                ],
            ],
            'layout' => "{items}\n{pager}",
        ]);
    }
     ?>

</div>
