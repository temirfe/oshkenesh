<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Announce */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announce-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'ru',['options'=>['class'=>'form-group field140']])->dropDownList(['кыргызча','русский'],[]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/announce/image-upload']),
            'imageManagerJson' => Url::to(['/announce/images-get']),
            'fileUpload' => Url::to(['/announce/file-upload']),
            'fileManagerJson' => Url::to(['/announce/files-get']),
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
