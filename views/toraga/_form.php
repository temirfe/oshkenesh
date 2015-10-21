<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use app\models\Deputy;

/* @var $this yii\web\View */
/* @var $model app\models\Toraga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toraga-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?php
    if($model->image) $iniImg=[
        Html::img("@web/uploads/images/".$model->image, ['class'=>'file-preview-image', 'alt'=>'']),
    ]; else $iniImg=false;
    echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'language' => 'ru',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniImg,
        ],
    ])->label(Yii::t('app','Image File'));
    ?>

    <?=$form->field($model, 'deputy_id')->dropDownList(
        ArrayHelper::map(Deputy::find()->all(), 'id', 'fullname'),['prompt'=>Yii::t('app', 'Select Deputy')] )
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
