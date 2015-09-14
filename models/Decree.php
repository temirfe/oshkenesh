<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decree".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $description
 * @property string $content
 * @property integer $ru
 * @property integer $views
 * @property string $number
 * @property string $session
 * @property string $word
 * @property string $pdf
 */
class Decree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['ru', 'views'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
            [['number'], 'string', 'max' => 20],
            [['session', 'word', 'pdf'], 'string', 'max' => 255]
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
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
            'number' => Yii::t('app', 'Number'),
            'session' => Yii::t('app', 'Session'),
            'word' => Yii::t('app', 'Word'),
            'pdf' => Yii::t('app', 'Pdf'),
        ];
    }
}
