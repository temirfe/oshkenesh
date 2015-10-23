<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<article class="item" data-key="<?=$model->id;?>">
    <h2 class="title">
        <?php if(Yii::$app->language=='ru') $title=$model->title_ru; else $title=$model->title;
        echo Html::a(Html::encode($title),Url::toRoute(['gallery/view','id'=>$model->id]),['title'=>$title])?>
    </h2>
    <div class="pull-left gthumb">
        <?=Html::img("@web/uploads/gallery/".$model->directory."/small/".$model->main_img, ['alt'=>'']); ?>
    </div>
    <?php
    $imgs=scandir("uploads/gallery/".$model->directory.'/small');
    $i=0;
    foreach($imgs as $img){
        if($img!='.' && $img!='..' && $img!=$model->main_img && $i<2){
            ?>
            <div class="pull-left gthumb">
                <?php
                echo Html::img("@web/uploads/gallery/".$model->directory."/small/".$img, ['alt'=>'']);?>
            </div>
            <?php
            $i++;
        }
    }
    ?>
    <div class="gal_enter">
        <a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/gallery/<?=$model->id;?>"><?=Yii::t('app','Go to gallery');?> &raquo;</a>
    </div>
</article>