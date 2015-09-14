<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Deputy */

$this->title = Yii::t('app', 'Create Deputy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deputies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deputy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
