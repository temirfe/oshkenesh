<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commission".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_ru
 * @property string $description
 * @property string $description_ru
 */
class Commission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_ru'], 'required'],
            [['description', 'description_ru'], 'string'],
            [['title', 'title_ru'], 'string', 'max' => 255]
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
            'description' => Yii::t('app', 'Content'),
            'description_ru' => Yii::t('app', 'Content Ru'),
        ];
    }
}
