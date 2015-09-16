<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Announce */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Announces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announce-view">
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

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?=date("d.m.Y",strtotime($model->date));?>
    </div>
    <div>
        <?=$model->content;?>
    </div>

</div>
