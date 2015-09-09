<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NursingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nursing-schools-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'City') ?>

    <?= $form->field($model, 'State') ?>

    <?= $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'Website') ?>

    <?php // echo $form->field($model, 'Type') ?>

    <?php // echo $form->field($model, 'Campus_setting') ?>

    <?php // echo $form->field($model, 'Campus_housing') ?>

    <?php // echo $form->field($model, 'Student_population') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
