<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Legislation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Legislation',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Legislations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="legislation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
