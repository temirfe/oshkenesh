<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeputySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Deputies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deputy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Deputy'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
            [
                'attribute' => 'party_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->party->name;
                },
            ],
            'image',
            // 'content_ru:ntext',
            // 'phone',
            // 'email:email',
            // 'address',
            // 'views',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
