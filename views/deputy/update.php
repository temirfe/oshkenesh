<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deputy */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Deputy',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deputies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="deputy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
