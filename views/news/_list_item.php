<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="item" data-key="<?=$model->id;?>">
    <div class="img_list pull-left">
        <?php
        if($model->image){
            $img=Html::img("@web/uploads/images/small/s_".$model->image, ['alt'=>'']);
            echo Html::a($img,Url::toRoute(['news/view','id'=>$model->id]));
        }
            else echo Html::img("@web/uploads/images/small/no.jpg", ['alt'=>'']);
        ?>
    </div>
    <h2 class="title">
        <?=Html::a(Html::encode($model->title),Url::toRoute(['news/view','id'=>$model->id]),['title'=>$model->title])?>
    </h2>
    <div class="desc_list">
        <?php
        echo Html::a(Html::encode($model->description),Url::toRoute(['news/view','id'=>$model->id]));
        ?>
    </div>
</article>