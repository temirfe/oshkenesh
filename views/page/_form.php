<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'ru',['options'=>['class'=>'form-group field140']])->dropDownList(['кыргызча','русский'],[]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/page/image-upload']),
            'imageManagerJson' => Url::to(['/page/images-get']),
            'fileUpload' => Url::to(['/page/file-upload']),
            'fileManagerJson' => Url::to(['/page/files-get']),
            'plugins' => [
                'imagemanager',
                'filemanager',
                'fontcolor',
                'table',
                'fontsize',
                //'clips',
                'fullscreen',
            ],
        ]
    ]); ?>

    <div class="form-group field140">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
