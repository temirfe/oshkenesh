<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NursingSchools */

$this->title = 'Update Nursing Schools: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Nursing Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursing-schools-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
