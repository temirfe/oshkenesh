<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $description
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date','ru','content'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000]
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
            'ru' => Yii::t('app', 'Ru'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    public function beforeSave($input){
        if(parent::beforeSave($input)){
            $this->content=str_replace('images/editor','uploads',$this->content);
            $this->content=str_replace('http://oshkenesh.kg','',$this->content);
            $this->content=str_replace('http://ru.oshkenesh.kg','',$this->content);
            $this->content=str_replace('ru.oshkenesh.kg','',$this->content);
            $this->content=str_replace('http://','',$this->content);
            return true;
        }
        return false;
    }
}
