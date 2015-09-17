<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'from_name') ?>

    <?= $form->field($model, 'from_email') ?>

    <?= $form->field($model, 'date_create') ?>

    <?= $form->field($model, 'date_answered') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'to_parent') ?>

    <?php // echo $form->field($model, 'to_child') ?>

    <?php // echo $form->field($model, 'public') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
