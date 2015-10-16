<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
?>
<div class="gallery-view">
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

    <div class="gdescr">
        <?=$model->description;?>
    </div>
    <br />
    <?php
    echo newerton\fancybox\FancyBox::widget([
        'target' => 'a[rel=fancybox]',
        'helpers' => true,
        'mouse' => true,
        'config' => [
            'maxWidth' => '90%',
            'maxHeight' => '90%',
            'playSpeed' => 4000,
            'padding' => 0,
            'fitToView' => false,
            //'width' => '70%',
            //'height' => '70%',
            'autoSize' => false,
            'closeClick' => false,
            'openEffect' => 'elastic',
            'closeEffect' => 'elastic',
            'prevEffect' => 'elastic',
            'nextEffect' => 'elastic',
            'closeBtn' => false,
            'openOpacity' => true,
            'helpers' => [
                'title' => ['type' => 'over'],
                'buttons' => [],
                'thumbs' => ['width' => 68, 'height' => 50],
                'overlay' => [
                    'css' => [
                        'background' => 'rgba(0, 0, 0, 0.8)'
                    ]
                ]
            ],
        ]
    ]);
    $imgs=scandir("uploads/gallery/".$model->directory.'/small');
    foreach($imgs as $img){
        if($img!='.' && $img!='..'){
            ?>
            <div class="gthumb">
                <?php
                $thumb=Html::img("@web/uploads/gallery/".$model->directory."/small/".$img, ['alt'=>'']);
                $source="@web/uploads/gallery/".$model->directory."/".$img;

                echo Html::a($thumb, $source, ['rel' => 'fancybox']);?>
            </div>
    <?php
        }
    }
    ?>

</div>
