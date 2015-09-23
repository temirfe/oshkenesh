<?php
namespace app\components;

use yii\base\BootstrapInterface;
use Yii;

class LanguageSelect implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->language = Yii::$app->request->cookies->getValue('language', 'ky'); //returns language value of cookie, if not set returns ky
    }
}