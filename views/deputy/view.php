<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deputy */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deputies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
<div class="deputy-view row">
    <div class="col-md-2">
        <?php if($model->image) {
            echo Html::img("@web/uploads/images/small/s_".$model->image, ['class'=>'deputy_image', 'alt'=>'']);
        };?>
    </div>
    <div class="col-md-10">
        <?php $party=Yii::$app->db->createCommand("SELECT * FROM party WHERE id='{$model->party_id}'")->queryOne();
        echo $party['name'];
        ?>
        <div><?=$model->phone;?></div>
        <div><?=$model->email;?></div>
        <div><?=$model->address;?></div>
        <div><?php if(Yii::$app->language=='ru') echo $model->content_ru; else echo $model->content;?></div>
    </div>
</div>
