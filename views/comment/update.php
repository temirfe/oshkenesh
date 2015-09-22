<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = Yii::t('app', 'Update Comment', [
    'modelClass' => 'Comment',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comment-update">
    <h1><?=$this->title;?></h1>
    <div><?=Html::a($model->news->title, ['news/view','id'=>$model->model_id])?></div>
    <br />
    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
