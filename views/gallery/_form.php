<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['row' => 6]) ?>
    <?= $form->field($model, 'description_ru')->textArea(['row' => 6]) ?>

    <?php if($model->main_img) $iniImg=[
        Html::img("@web/uploads/gallery/".$model->directory."/".$model->main_img, ['class'=>'file-preview-image', 'alt'=>'']),
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
    ]); ?>

    <?php
    $iniImg=false;
    if($model->main_img && $model->directory) {
        $iniImg=array();
        $imgs=scandir("uploads/gallery/".$model->directory.'/small');
        foreach($imgs as $img){
            if($img!='.' && $img!='..' && $img!=$model->main_img){
                $iniImg[]=Html::img("@web/uploads/gallery/".$model->directory."/small/".$img, ['class'=>'file-preview-image', 'alt'=>'']);
            }
        }
    }
    echo $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','multiple'=>true],
        'language' => 'ru',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'overwriteInitial'=>false,
            'initialPreview'=>$iniImg,
        ],
    ]); ?>

    <?php
    if(!$model->date) $model->date=date("Y-m-d");

    echo $form->field($model, 'date',['options'=>['class'=>'form-group field140']])->widget(DatePicker::classname(), [
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ]
    ]);
    ?>

    <div class="form-group field140">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
