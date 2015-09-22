<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
?>
<div class="bill-view">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <div class="btn-group" role="group" aria-label="admin-actions">
                <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true" title="'.Yii::t('app', 'Update').'"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true" title="'.Yii::t('app', 'Delete').'"></span>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    <?php
    }?>

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="pull-left">
        <?php

        if($model->word){
            if($model->word_size > 1024) $word_size=round($model->word_size/1024,2)." MB"; else $word_size=$model->word_size." KB";
            echo '<span class="glyphicon glyphicon-file blue"></span> '.Html::a(Yii::t('app', 'Document in MS Word')." (".$word_size.")",
                    "@web/uploads/files/".$model->word, ['class' => '']);
        } ?>
    </div>
    <div class="pull-left">
        <?php if($model->pdf) {
            if($model->pdf_size > 1024) $pdf_size=round($model->pdf_size/1024,2)." MB"; else $pdf_size=$model->pdf_size." KB";
            echo '<span class="glyphicon glyphicon-file blue"></span> '.Html::a(Yii::t('app', 'Document in PDF')."
        (".$pdf_size.")", "@web/uploads/files/".$model->pdf, ['class' => '']);
        } ?>
    </div>
    <div class="pull-right"><a href="javascript:window.print()" class="print print_hide nodecor"><span class="glyphicon glyphicon-print"></span> <?=Yii::t('app', 'Print')?></a></div>

    <div class="mt50 iblock"><?=$model->content;?></div>

</div>
