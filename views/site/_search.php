<?php
use yii\helpers\Html;
?>
<div class="ask pull-right" style=" margin-right: 106px; width: 322px;;">
    <?= Html::beginForm(['site/search'], 'post') ?>
        <div class="form-group rel">
            <!--type, input name, input value, options-->
            <?= Html::input('text', 'search', '', ['class' => 'form-control search_input','minlength'=>3,'placeholder'=>Yii::t('app','Search')]) ?>
            <?= Html::button("<span class='searchicon glyphicon glyphicon-search '></span>", ['class' => 'btn btn-primary abs search_btn', 'type'=>'submit', 'style'=>'top:0;right:0;']) ?>
        </div>
    <?= Html::endForm() ?>
</div>