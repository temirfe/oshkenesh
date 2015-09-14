<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\Url;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use app\models\Party;

/* @var $this yii\web\View */
/* @var $model app\models\Deputy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deputy-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'party_id')->dropDownList(
            ArrayHelper::map(Party::find()->all(), 'id', 'name'),['prompt'=>Yii::t('app', 'Select party')] )
    ?>

    <?php
    if($model->image) $iniImg=[
        Html::img("@web/uploads/images/".$model->image, ['class'=>'file-preview-image', 'alt'=>'']),
    ]; else $iniImg=false;
    echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'name' => 'input-ru[]',
        'language' => 'ru',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniImg,
        ],
    ]); ?>
    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'fontcolor',
                'table',
                'fontsize',
                //'clips',
                'fullscreen',
            ],
        ]
    ]); ?>

    <?= $form->field($model, 'content_ru')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'fontcolor',
                'table',
                'fontsize',
                //'clips',
                'fullscreen',
            ],
        ]
    ]); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'listorder',['options'=>['class'=>'form-group field140']])->textInput() ?>

    <div class="form-group field140">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
