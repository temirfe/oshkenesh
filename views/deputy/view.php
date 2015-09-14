<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deputy */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deputies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deputy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php if($model->image) {
        echo Html::img("@web/uploads/images/".$model->image, ['class'=>'deputy_image', 'alt'=>'']);
    };?>
    <?php $party=Yii::$app->db->createCommand("SELECT * FROM party WHERE id='{$model->party_id}'")->queryOne();
        echo $party['name'];
    ?>
    <div><?=$model->content;?></div>
    <div><?=$model->phone;?></div>
    <div><?=$model->email;?></div>
    <div><?=$model->address;?></div>

</div>
