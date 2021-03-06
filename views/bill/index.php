<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeputySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deputy-index">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php
    }?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => Yii::t('app', 'No results found'),
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a(Html::encode($model->title),Url::toRoute(['bill/view','id'=>$model->id]));
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
            [
                'attribute' => 'date',
                'format' => 'text',
                'value' => function($model) {
                    if($model->date) $date=date('d.m.Y', strtotime($model->date)); else $date='';
                    return $date;
                },
                'contentOptions' => ['style' => 'text-align:center; vertical-align:middle;']
            ],
        ],
        'layout' => "{items}\n{pager}",
    ]); ?>


</div>
