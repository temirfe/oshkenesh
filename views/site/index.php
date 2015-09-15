<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\SwiperAsset;
SwiperAsset::register($this);
$this->title = 'Ош шаардык Кеңеши';
?>
<style type="text/css">
.deputies-slider{clear: both;}
    .deputy-name{text-align: center;}
    .deputy-name a{display: block;}
    .swiper-slide{text-align: center;}
</style>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<div class="site-index">
    <div class="logowrap">
        <div class="logo logo2 pull-left"></div>
        <div class="logotext2"><?=Yii::t('app', 'Osh city Kenesh');?></div>
    </div>

    <div class="toraga">
        <?php
        $db=Yii::$app->db;
        /*$result = $db->cache(function ($db) {
            return $db->createCommand("SELECT id,fullname, image FROM deputy WHERE image<>''")->queryAll();
        });*/

        $result = $db->createCommand("SELECT id,fullname,listorder,image FROM deputy WHERE image<>''")->queryAll();
        $toraga=array();
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
    }
</script>
