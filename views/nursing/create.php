<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NursingSchools */

$this->title = 'Create Nursing Schools';
$this->params['breadcrumbs'][] = ['label' => 'Nursing Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursing-schools-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
