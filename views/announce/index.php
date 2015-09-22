<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnnounceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Announces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announce-index">
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
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        },
    ]) ?>

</div>
