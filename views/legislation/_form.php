<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Legislation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legislation-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <?php echo $form->field($model, 'ru',['options'=>['class'=>'form-group field140']])->dropDownList(['кыргызча','русский'],[]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'fileUpload' => Url::to(['/legislation/file-upload']),
            'fileManagerJson' => Url::to(['/legislation/files-get']),
            'plugins' => [
                'filemanager',
                'table',
                'fontsize',
                'fullscreen',
            ],
        ]
    ]); ?>



    <?php if($model->word) $iniWord=[
        "<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".Html::a($model->word,"@web/uploads/files/".$model->word, ['class'=>'file-preview-text'])."</div>"
    ]; else $iniWord=false;
    echo $form->field($model, 'wordFile')->widget(FileInput::classname(), [
        'language' => 'ru',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniWord,
            'allowedFileExtensions'=>['doc','docx','rtf']
        ],
    ]); ?>

    <?php if($model->pdf) $iniPdf=[
        "<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".Html::a($model->pdf,"@web/uploads/files/".$model->pdf, ['class'=>'file-preview-text'])."</div>",
    ]; else $iniPdf=false;
    echo $form->field($model, 'pdfFile')->widget(FileInput::classname(), [
        'language' => 'ru',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniPdf,
            'allowedFileExtensions'=>['pdf']
        ],
    ]); ?>

    <?php

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
