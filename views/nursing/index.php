<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NursingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nursing Schools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursing-schools-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursing Schools', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Name',
            'City',
            'State',
            'Address',
            // 'Website',
            // 'Type',
            // 'Campus_setting',
            // 'Campus_housing',
            // 'Student_population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
