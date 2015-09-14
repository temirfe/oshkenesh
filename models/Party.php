<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $content
 * @property string $content_ru
 * @property integer $views
 * @property integer $order
 */
class Party extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content', 'content_ru'], 'string'],
            [['views'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'content' => Yii::t('app', 'Content'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'views' => Yii::t('app', 'Views'),
        ];
    }
}
