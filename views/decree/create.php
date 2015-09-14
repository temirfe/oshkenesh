<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Decree */

$this->title = Yii::t('app', 'Create Decree');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decrees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
