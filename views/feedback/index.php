<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feedbacks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php
    }?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => Yii::t('app', 'No results found'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'from_name',
            'from_email:email',
            'date_create',
            'date_answered',
            // 'text:ntext',
            // 'answer:ntext',
            // 'to_parent',
            // 'to_child',
            // 'public',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
