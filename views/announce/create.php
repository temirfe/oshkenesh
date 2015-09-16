<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Announce */

$this->title = Yii::t('app', 'Create Announce');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Announces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announce-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
