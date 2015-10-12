<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DecreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Decrees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decree-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Decree'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php $db=Yii::$app->db;
        $result = $db->createCommand("SELECT id,title FROM session ORDER BY id DESC")->queryAll(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->title,['decree/view','id'=>$model->id]);
                },
            ],
            // 'ru',
            // 'views',
             'number',

            [
                'attribute' => 'session_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->session->title;
                },
                'filter' => Html::activeDropDownList($searchModel, 'session_id', ArrayHelper::map($result, 'id', 'title'),['class'=>'form-control','prompt' => '']),
            ],
            // 'word',
            // 'pdf',
        ],
    ]); ?>

</div>
