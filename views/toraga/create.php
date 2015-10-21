<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Toraga */

$this->title = Yii::t('app', 'Create Toraga');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Toragas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toraga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
