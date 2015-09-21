<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Results */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="results-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <?php echo $form->field($model, 'ru',['options'=>['class'=>'form-group field140']])->dropDownList(['кыргызча','русский'],[]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/results/image-upload']),
            'imageManagerJson' => Url::to(['/results/images-get']),
            'fileUpload' => Url::to(['/results/file-upload']),
            'fileManagerJson' => Url::to(['/results/files-get']),
            'plugins' => [
                'imagemanager',
                'filemanager',
                'fontcolor',
                'table',
                'fontsize',
                'video',
                //'clips',
                'fullscreen',
            ],
        ]
    ]); ?>
    <?php if($model->image) $iniImg=[
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
    ]); ?>

    <?php
    if(!$model->date) $model->date=date("Y-m-d");

    echo $form->field($model, 'date',['options'=>['class'=>'form-group field140']])->widget(DatePicker::classname(), [
        'removeButton' => false,
        'language'=>'ru',
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
