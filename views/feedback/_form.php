<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_email')->textInput(['maxlength' => true])->input('email') ?>
    <?php
    $catList=[Yii::t('app','General question'),Yii::t('app','To deputy'),Yii::t('app','To commission')];
    echo $form->field($model, 'to_parent')->dropDownList($catList, ['id'=>'topar']);?>

    <?php
    if($model->to_child) $tochild=''; else $tochild='myhide';
    if($model->to_parent==1)$selected=[$model->to_child=>$model->deputy->fullname];
    elseif($model->to_parent==2)$selected=[$model->to_child=>$model->commission->title];
    else $selected=[];
    echo $form->field($model, 'to_child', ['options'=>['class'=>'form-group js_tochild '.$tochild]])->widget(DepDrop::classname(), [
        'options'=>['id'=>'tochild'],
        'type'=>DepDrop::TYPE_SELECT2,
        'data'=>$selected,
        'pluginOptions'=>[
            'depends'=>['topar'],
            'placeholder'=>Yii::t('app','Select...'),
            'url'=>Url::to(['/feedback/subcat'])
        ]
    ])->label('');
    ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Send') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    window.onload = function(){
        $('#topar').change(function () {
            if($(this).val()==='0'){
                $('.js_tochild').hide();
            }
            else $('.js_tochild').show();
        })
    }
</script>