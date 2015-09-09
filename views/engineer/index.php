<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EngineerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Engineers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engineer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Engineer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->Name), ['view', 'id' => $model->id])." ".Url::toRoute(['engineer/view', 'id'=>$model->id])." ".['state'=>$model->State];
        },
    ]) ?>

</div>
