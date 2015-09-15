<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class SwiperAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/swiper.min.css',
    ];
    public $js = [
        'js/swiper.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
