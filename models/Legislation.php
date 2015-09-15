<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "legislation".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $content
 * @property integer $ru
 * @property integer $views
 */
class Legislation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'legislation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['title'], 'required'],
            [['content','word','pdf'], 'string'],
            [['ru', 'views'], 'integer'],
            [['title'], 'string', 'max' => 500]
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
            'content' => Yii::t('app', 'Content'),
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
        ];
    }
}
