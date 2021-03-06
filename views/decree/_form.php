<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Session;

/* @var $this yii\web\View */
/* @var $model app\models\Decree */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decree-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?php
    $lang=Yii::$app->language;
    if($model->isNewRecord && $lang=='ru') $model->ru=1;
    echo $form->field($model, 'ru',['options'=>['class'=>'form-group field140']])->dropDownList(['кыргызча','русский'],[]); ?>

    <?php
    if($lang=='ru')
    {
        $content_lang='1';
    }
    else{
        $content_lang='0';
    }
    if($sess_id=Yii::$app->request->get('s')) $model->session_id=$sess_id;
    echo $form->field($model, 'session_id')->dropDownList(
        ArrayHelper::map(Session::find()->where(['ru'=>$content_lang])->orderBy('id DESC')->all(), 'id', 'title'),['prompt'=>Yii::t('app', 'Select session')] );
    ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Токтомдун аталышы') ?>
    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'fileUpload' => Url::to(['/decree/file-upload']),
            'fileManagerJson' => Url::to(['/decree/files-get']),
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
            'browseClass' => 'btn btn-default',
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniWord,
            'allowedFileExtensions'=>['doc','docx','rtf','xls','xlsx']
        ],
    ]); ?>

    <?php if($model->pdf) $iniPdf=[
        "<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".Html::a($model->pdf,"@web/uploads/files/".$model->pdf, ['class'=>'file-preview-text'])."</div>",
    ]; else $iniPdf=false;
    echo $form->field($model, 'pdfFile')->widget(FileInput::classname(), [
        'language' => 'ru',
        'pluginOptions' => [
            'browseClass' => 'btn btn-default',
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniPdf,
            'allowedFileExtensions'=>['pdf']
        ],
    ]); ?>

    <?php

    /*echo $form->field($model, 'date',['options'=>['class'=>'form-group field140']])->widget(DatePicker::classname(), [
        'removeButton' => false,
        'language'=>'ru',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ]
    ]);*/
    ?>

    <div class="form-group field140">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>