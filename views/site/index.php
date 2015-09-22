<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\SwiperAsset;
SwiperAsset::register($this);
$this->title = Yii::t('app','Osh city Kenesh');

$db=Yii::$app->db;
$news = $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title,`date`,image FROM news ORDER BY date DESC LIMIT 4")->queryAll();
},300);
//$news = $db->createCommand("SELECT id,title,`date`,image FROM news ORDER BY date DESC LIMIT 4")->queryAll();
$main_news=array();
$other_news=array();


$result = $db->cache(function ($db) {
    return $db->createCommand("SELECT id,fullname, image,listorder FROM deputy WHERE image<>''")->queryAll();
},3600);
//$result = $db->createCommand("SELECT id,fullname,listorder,image FROM deputy WHERE image<>''")->queryAll();
$toraga=array();

$legislations = $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title FROM legislation LIMIT 3")->queryAll();
},3600);

$decrees = $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title FROM decree ORDER BY id DESC LIMIT 2")->queryAll();
},3600);

$bills= $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title FROM bill ORDER BY id DESC LIMIT 2")->queryAll();
},3600);

$galleries= $db->cache(function ($db) {
    return $db->createCommand("SELECT id,title, main_img FROM gallery ORDER BY id DESC LIMIT 4")->queryAll();
},3600);
?>
<style type="text/css">
    .logo1{display: none;}
    .main_laws{ border-bottom: 1px solid #eaeaea;
        border-top: 1px solid #eaeaea;
        margin: 60px 0;
        padding-bottom: 15px;
        background-color: #f9f9f9;}
    h3.dots{ color: #333;
        font-family: "roboto condensed",sans-serif;
        font-size: 20px;
        margin-bottom: 15px;}
    h3.dots:after{background-color: #ffcb05;
        border-radius: 4px;
        content: "";
        display: inline-block;
        height: 8px;
        margin: 0 0 2px 6px;
        width: 8px;}
    .law_title{margin-bottom: 15px;}
    .ask{margin-top: 35px;}
    .ask a{color: #fff;
        text-decoration: none;}
    a:active {
        outline: none;
    }

</style>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<div class="site-index">
    <div class="logowrap">
        <div class="logo logo2 pull-left"></div>
        <div class="logotext2"><?=Yii::t('app', 'Osh city Kenesh');?></div>
    </div>
    <div class="ask pull-right btn btn-success">
        <?=Html::a(Yii::t('app', 'Questions / Suggestions'),Url::toRoute(['feedback/create']))?>
    </div>
    <div class="row">
        <div class="col-md-6 mains_news">
            <?php
            foreach ($news as $n) {
                if($n['image'] && empty($main_news)) $main_news=$n;
                else $other_news[]=$n;
            }
            ?>
            <?php
                $img=Html::img("@web/uploads/images/".$main_news['image'], ['class'=>'', 'alt'=>$main_news['title']]);
                echo Html::a($img,Url::toRoute(['news/view','id'=>$main_news['id']]));
            ?>
            <div class="entry_news_date mains_news_date">
                <?=date("d.m.Y",strtotime($main_news['date']));?>
            </div>
            <div class="mains_news_title">
                <?=Html::a(Html::encode($main_news['title']),Url::toRoute(['news/view','id'=>$main_news['id']]))?>
            </div>

        </div>
        <div class="col-md-3">
            <?php foreach($other_news as $on){
                ?>
                <div class="other_news">
                    <div class="other_news_title">
                        <?=Html::a(Html::encode($on['title']),Url::toRoute(['news/view','id'=>$on['id']]))?>
                    </div>
                    <div class="entry_news_date other_news_date">
                        <?=date("d.m.Y",strtotime($on['date']));?>
                    </div>
                </div>
            <?php
            }?>
            <p><a class="btn btn-default btn-sm" href="<?=Yii::getAlias('@web');?>/news"><?=Yii::t('app','All news');?> &raquo;</a></p>
        </div>
        <div class="col-md-3">
            <div class="toraga">
                <?php
                foreach ($result as $deputy) {
                    if($deputy['listorder']==1) $toraga=$deputy;
                }

                ?>
                <div class="toraga_image">
                    <?php
                    $img=Html::img("@web/uploads/images/".$toraga['image'], ['alt'=>'']);
                    echo Html::a($img,Url::toRoute(['deputy/view','id'=>$toraga['id']]));
                    ?>
                </div>
                <div class="toraga_name">
                    <span><?=Yii::t('app', 'Chairman');?></span>
                    <?php
                    echo Html::a($toraga['fullname'],Url::toRoute(['deputy/view','id'=>$toraga['id']]));
                    ?>
                </div>
            </div>
            <div class="announce">
                <h3><?=Yii::t('app', 'Announce');?></h3>
                <?php
                    $announce = $db->cache(function ($db) {
                        return $db->createCommand("SELECT id,title,`date` FROM announce ORDER BY id DESC LIMIT 1")->queryOne();
                    },300);
                ?>
                <div class="announce_title"><?=Html::a(Html::encode($announce['title']),Url::toRoute(['announce/view','id'=>$main_news['id']]))?></div>
                <div class="entry_news_date"><?=date("d.m.Y",strtotime($announce['date']));?></div>
            </div>
        </div>
    </div>

    <div class="row main_laws">
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                foreach ($result as $deputy) {
                    if($deputy['listorder']!=1) {
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
        <?php
            foreach($galleries as $gal){

            }
        ?>
    </div>


</div>
<script>
    window.onload = function(){
        var mySwiper = new Swiper ('.swiper-container', {
            // If we need pagination
            slidesPerView: 6,
            spaceBetween: 30,
            freeMode: true,
            autoplay: 2500,
            scrollbar: '.swiper-scrollbar',
            autoplayDisableOnInteraction:false
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $('.js_logo1').fadeIn();
            }
            else {
                $('.js_logo1').fadeOut();
            }
        });

        $(".js_logo1").click(function() {
            $("html, body").animate({ scrollTop: 0 });
            return false;
        });
    }
</script>
