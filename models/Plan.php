<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $ru
 * @property integer $views
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['title', 'image'], 'required'],
            [['content'], 'string'],
            [['ru', 'views'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
        ];
    }
}
