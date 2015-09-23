<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => Yii::t('app', 'No results found'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'name',
            'content',
            // 'model_name',
            // 'model_id',
            'public',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
