<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = Yii::t('app', 'The Question')." №".$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
?>
<div class="feedback-view">
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

    <?php
    $arr=[Yii::t('app','General question'),Yii::t('app','To deputy'),Yii::t('app','To commission')];
    if($model->to_parent==1) $tochild=$arr[$model->to_parent].": ".$model->deputy->fullname;
    elseif($model->to_parent==2) $tochild=$arr[$model->to_parent].": ".$model->commission->title;
    else $tochild=$arr[$model->to_parent];

    $datecreate=date('d.m.Y', strtotime($model->date_create));

    if($model->answer) $answer=$model->answer; else $answer= "<div style='color:red;'>".Yii::t('app', "Haven't been answered yet")."</div>";
    if($model->date_answered) $dateanswer=date('d.m.Y', strtotime($model->date_answered)); else $dateanswer='';
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'from_name',
            'from_email:email',
            [
                'attribute' => 'date_create',
                'format' => 'raw',
                'value' => $datecreate
            ],
            [
                'attribute' => 'to_parent',
                'format' => 'raw',
                'value' => $tochild
            ],
            'text',
            [
                'attribute' => 'answer',
                'format' => 'raw',
                'value' => $answer
            ],
            [
                'attribute' => 'date_answered',
                'format' => 'raw',
                'value' => $dateanswer
            ],
            'public',
        ],
    ]) ?>

</div>
<div class="feedback-update">

    <div class="feedback-form">

        <?php $form = ActiveForm::begin(['action'=>'@web/feedback/answer/'.$model->id]); ?>

        <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton( Yii::t('app', 'Send'), ['class' =>'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
