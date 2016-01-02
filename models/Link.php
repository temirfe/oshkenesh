<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $title_ru
 */
class Link extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'title', 'title_ru'], 'required'],
            [['url','image'], 'string', 'max' => 255],
            [['title', 'title_ru'], 'string', 'max' => 500],
            [['priority'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'priority' => Yii::t('app', 'priority'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            $this->url=preg_replace("/http:\/\/www./i","",$this->url);
            $this->url=preg_replace("/http:\/\//i","",$this->url);
            $this->url=preg_replace("/www./i","",$this->url);
            return true;
        }
        return false;
    }
}
