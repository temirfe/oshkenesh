<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Gallery'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => Yii::t('app', 'No results found'),
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'main_img',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img("@web/uploads/gallery/".$model->directory."/small/".$model->main_img, ['alt'=>'']);
                },
            ],
            'title',
            'date',
            // 'views',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
