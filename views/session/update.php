<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = Yii::t('app', 'Сессия: ', [
    'modelClass' => 'Session',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sessions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <br />
    <br />
    <h2>Токтомдору</h2>
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout' => "{items}\n{pager}",
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Decree'), ['/decree/create','s'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>
</div>
