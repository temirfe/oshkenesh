<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Legislation */

$this->title = Yii::t('app', 'Create Legislation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Legislations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legislation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
