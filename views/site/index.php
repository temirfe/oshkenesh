<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Toraga;
$this->title = Yii::t('app','Osh city Kenesh');
$db=Yii::$app->db;
$lang=Yii::$app->language;
if($lang=='ru')
{
    $content_lang='1';
}
else{
    $content_lang='0';
}
$news = $db->cache(function ($db) use($content_lang) {
    return $db->createCommand("SELECT id,title,`date`,image FROM news WHERE ru='{$content_lang}' ORDER BY `date` DESC LIMIT 4")->queryAll();
},300);
//$news = $db->createCommand("SELECT id,title,`date`,image FROM news ORDER BY date DESC LIMIT 4")->queryAll();
$main_news=array();
$other_news=array();


$result = $db->cache(function ($db) {
    return $db->createCommand("SELECT id,fullname, image,listorder FROM deputy WHERE image<>''")->queryAll();
},600);
//$result = $db->createCommand("SELECT id,fullname,listorder,image FROM deputy WHERE image<>''")->queryAll();

$legislations = $db->cache(function ($db) use($content_lang) {
    return $db->createCommand("SELECT id,title FROM legislation WHERE ru='{$content_lang}' LIMIT 3")->queryAll();
},600);

$decrees = $db->cache(function ($db) use($content_lang) {
    return $db->createCommand("SELECT id,title FROM decree WHERE ru='{$content_lang}' ORDER BY id DESC LIMIT 2")->queryAll();
},600);

$bills= $db->cache(function ($db) use($content_lang) {
    return $db->createCommand("SELECT id,title FROM bill WHERE ru='{$content_lang}' ORDER BY id DESC LIMIT 2")->queryAll();
},600);
$galleries= $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title,title_ru, main_img, directory FROM gallery ORDER BY id DESC LIMIT 4")->queryAll();
},600);
$announce = $db->cache(function ($db) use($content_lang) {
    return $db->createCommand("SELECT id,title,`date` FROM announce WHERE ru='{$content_lang}' ORDER BY id DESC LIMIT 1")->queryOne();
},600);

//$galleries= $db->createCommand("SELECT id,title, main_img, directory FROM gallery ORDER BY id DESC LIMIT 4")->queryAll();
/*$toraga = $db->cache(function ($db) {
    return $db->createCommand("SELECT toraga.*, deputy.fullname FROM toraga LEFT JOIN deputy ON toraga.deputy_id=deputy.id")->queryOne();
},600);*/
$toraga=$db->createCommand("SELECT toraga.*, deputy.fullname FROM toraga LEFT JOIN deputy ON toraga.deputy_id=deputy.id")->queryOne();
?>

<style type="text/css">


</style>
<div class="site-index">
    <div class="row">
        <div class="col-md-6 mains_news col-sm-8">
            <?php
            $i=0;
            foreach ($news as $n) {
                if($i==0) {
                    $visible='';
                    $main_news=$n;
                    $firs_img='js_first_img';
                    }
                else {$visible='display:none;'; $other_news[]=$n; $firs_img='';}
                $img=Html::img("@web/uploads/images/".$n['image'], ['alt'=>$n['title'],'class'=>'img-responsive']);
                echo Html::a($img,Url::toRoute(['news/view','id'=>$n['id']]),['class'=>$firs_img.' js_news_img js_img_'.$n['id'], 'style'=>$visible]);
                $i++;
            }
            ?>
            <?php
            /*  $img=Html::img("@web/uploads/images/".$main_news['image'], ['alt'=>$main_news['title']]);
                echo Html::a($img,Url::toRoute(['news/view','id'=>$main_news['id']]),['class'=>'js_main_img_'.$main_news['id']]);
            */?>
            <div class="entry_news_date mains_news_date js_main_news">
                <?php if($main_news) echo date("d.m.Y",strtotime($main_news['date']));?>
            </div>
            <div class="mains_news_title js_main_news">
                <?php if($main_news) echo Html::a(Html::encode($main_news['title']),Url::toRoute(['news/view','id'=>$main_news['id']]))?>
            </div>

        </div>
        <div class="col-md-3 col-sm-4">
            <?php foreach($other_news as $on){
                ?>
                <div class="other_news js_other_news">
                    <div class="other_news_title">
                        <?=Html::a(Html::encode($on['title']),Url::toRoute(['news/view','id'=>$on['id']]),['class'=>'js_news', 'news'=>$on['id']])?>
                    </div>
                    <div class="entry_news_date other_news_date">
                        <?=date("d.m.Y",strtotime($on['date']));?>
                    </div>
                </div>
            <?php
            }?>
            <p><a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/news"><?=Yii::t('app','All news');?> &raquo;</a></p>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="toraga">
                <div class="toraga_image">
                    <?php
                    $img=Html::img("@web/uploads/images/".$toraga['image'], ['alt'=>'']);
                    echo Html::a($img,Url::toRoute(['deputy/view','id'=>$toraga['id']]));
                    ?>
                </div>
                <div class="toraga_name">
                    <span><?=Yii::t('app', 'Chairman');?></span>
                    <?php
                    echo Html::a($toraga['fullname'],Url::toRoute(['deputy/view','id'=>$toraga['deputy_id']]));
                    ?>
                </div>
            </div>
            <div class="announce">
                <h3><?=Yii::t('app', 'Announce');?></h3>
                <div class="announce_title"><?php if(!empty($announce['title'])) echo Html::a(Html::encode($announce['title']),Url::toRoute(['announce/view','id'=>$announce['id']]))?></div>
                <div class="entry_news_date"><?php if(!empty($announce['date'])) echo date("d.m.Y",strtotime($announce['date']));?></div>
            </div>
        </div>
    </div>

    <div class="row main_laws">
        <div class="col-md-4 col-sm-12">
            <h3 class="dots"><?=Yii::t('app', 'Legislation');?></h3>
            <?php foreach($legislations as $leg){
                ?>
                <div class="law_title">
                    <?=Html::a(Html::encode($leg['title']),Url::toRoute(['legislation/view','id'=>$leg['id']]))?>
                </div>
            <?php
            }?>
            <p><a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/legislation"><?=Yii::t('app','All legislation');?> &raquo;</a></p>
        </div>
        <div class="col-md-4 col-sm-12">
            <h3 class="dots"><?=Yii::t('app', 'Decrees');?></h3>
            <?php foreach($decrees as $leg){
                ?>
                <div class="law_title">
                    <?=Html::a(Html::encode($leg['title']),Url::toRoute(['decree/view','id'=>$leg['id']]))?>
                </div>
            <?php
            }?>
            <p><a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/decree"><?=Yii::t('app','All decrees');?> &raquo;</a></p>
        </div>
        <div class="col-md-4 col-sm-12">
            <h3 class="dots"><?=Yii::t('app', 'Bills');?></h3>
            <?php foreach($bills as $leg){
                ?>
                <div class="law_title">
                    <?=Html::a(Html::encode($leg['title']),Url::toRoute(['bill/view','id'=>$leg['id']]))?>
                </div>
            <?php
            }?>
            <p><a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/bill"><?=Yii::t('app','All bills');?> &raquo;</a></p>
        </div>
    </div>

    <div class="deputies-slider">
        <h3 class="dots"><?=Yii::t('app', 'Deputies');?></h3>
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                foreach ($result as $deputy) {
                    if($deputy['listorder']!=1)
                    {
                        ?>
                        <div class="swiper-slide">
                            <div class="toraga_image">
                                <?php
                                $img=Html::img("@web/uploads/images/".$deputy['image'], ['alt'=>'']);
                                echo Html::a($img,Url::toRoute(['deputy/view','id'=>$deputy['id']]));
                                ?>
                            </div>
                            <div class="deputy-name">
                                <?php
                                echo Html::a($deputy['fullname'],Url::toRoute(['deputy/view','id'=>$deputy['id']]));
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <!-- If we need pagination -->
            <!--<div class="swiper-pagination"></div>-->
            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>

    <div class="row main_gal">

        <h3 class="dots" style="margin-left:15px;"><?=Yii::t('app', 'Gallery');?></h3>
        <?php
            foreach($galleries as $gal){
                if($lang=='ru'){$gtitle=$gal['title_ru'];} else{$gtitle=$gal['title'];}
                ?>
                <div class="gal_wrap pull-left col-sm-3">
                    <div class="gal_index_item">
                        <?php $img=Html::img("@web/uploads/gallery/".$gal['directory']."/small/".$gal['main_img'], ['alt'=>'']);
                        echo Html::a($img,Url::toRoute(['gallery/view','id'=>$gal['id']]));
                        ?>
                    </div>
                    <div class="gal_title">
                        <?=Html::a(Html::encode($gtitle),Url::toRoute(['gallery/view','id'=>$gal['id']])); ?>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
</div>
