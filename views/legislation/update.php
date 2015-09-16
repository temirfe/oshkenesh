<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Legislation */
$this->title=Yii::t('app','Osh city Kenesh');
$title = Yii::t('app', 'Update: ', [
    'modelClass' => 'Legislation',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Legislation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="legislation-update">

    <h1><?= Html::encode($title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
