<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="news_view">

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

    <div>
        <?=$model->description;?>
    </div>

    <div>
        <?=date("d.m.Y",strtotime($model->date));?>
    </div>
    <div>
        <?=Html::img("@web/uploads/images/".$model->image, ['class'=>'news_image', 'alt'=>''])?>
    </div>
    <div>
        <?=$model->content;?>
    </div>
</article>
<a href="javascript:window.print()" class="print print_hide nodecor"><span class="glyphicon glyphicon-print"></span> print</a>