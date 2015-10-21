<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Decrees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php
    }?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'emptyText' => Yii::t('app', 'No results found'),
        'summary'=>'',
        'itemView' => function ($model, $key, $index, $widget) {
            return "<div class='entry_news_date'>".date('d.m.Y', strtotime($model->date))."</div><h4 class='session'>".Html::a(Html::encode($model->title), ['view', 'id' => $model->id])."</h4><div class='desc'>".$model->description."</div>";
        },
    ]) ?>

</div>