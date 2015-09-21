<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_ru
 * @property string $description
 * @property string $description_ru
 * @property string $date
 * @property integer $views
 */
class Gallery extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imageFiles=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['date','main_img','directory'], 'safe'],
            [['views'], 'integer'],
            [['title', 'title_ru'], 'string', 'max' => 500],
            [['description', 'description_ru'], 'string', 'max' => 1000],
            [['imageFile'], 'file', 'extensions' => 'jpg,jpeg,gif,png'],
            [['imageFiles'], 'file', 'extensions' => 'jpg,jpeg,gif,png', 'maxSize'=>20*1024*1024, 'maxFiles'=>10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'description' => Yii::t('app', 'Description'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'date' => Yii::t('app', 'Date'),
            'views' => Yii::t('app', 'Views'),
            'main_img' => Yii::t('app', 'Main Image'),
            'imageFile' => Yii::t('app', 'Main Image'),
            'imageFiles' => Yii::t('app', 'Other Images'),
        ];
    }
}
