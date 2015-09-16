<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LegislationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Legislation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legislation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Legislation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function($model) {
                    return date('d.m.Y', strtotime($model->date));
                },
            ],
            'title',
            'ru',
            // 'views',
        ],
    ]); ?>

</div>
