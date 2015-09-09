<?php
use yii\helpers\Html;
use kartik\builder\Form;
echo Html::beginForm('', '', ['class'=>'form-horizontal','enctype' => 'multipart/form-data']);
echo Form::widget([
    // formName is mandatory for non active forms
    // you can get all attributes in your controller
    // using $_POST['upform']
    'formName'=>'upform',

    // default grid columns
    'columns'=>2,

    'attributes'=>[       // 2 column layout
        'field1'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter txt...']],
        'xfile'=>['type'=>Form::INPUT_FILE],
    ]
]);
echo Html::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']);
echo Html::endForm();