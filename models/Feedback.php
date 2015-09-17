<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $from_name
 * @property string $from_email
 * @property string $date_create
 * @property string $date_answered
 * @property string $text
 * @property string $answer
 * @property integer $to_parent
 * @property integer $to_child
 * @property integer $public
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_name', 'from_email','text'], 'required'],
            [['date_create', 'date_answered'], 'safe'],
            [['text', 'answer'], 'string'],
            [['to_parent', 'to_child', 'public'], 'integer'],
            [['from_name', 'from_email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_name' => Yii::t('app', 'From Name'),
            'from_email' => Yii::t('app', 'From Email'),
            'date_create' => Yii::t('app', 'Date Asked'),
            'date_answered' => Yii::t('app', 'Date Answered'),
            'text' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'to_parent' => Yii::t('app', 'To Whom'),
            'to_child' => Yii::t('app', 'To Child'),
            'public' => Yii::t('app', 'Public'),
        ];
    }

    public function getDeputy()
    {
        return $this->hasOne(Deputy::className(), ['id' => 'to_child']);
    }

    public function getCommission()
    {
        return $this->hasOne(Commission::className(), ['id' => 'to_child']);
    }

    public function afterFind()
    {
        if(Yii::$app->controller->action->id!='update')
        {
            /*if($this->hasAttribute('public'))
                $this->setAttribute('public', Yii::t('dictionary', $this->public ? 'Enable':'Disable') );  */

            $language=Yii::$app->language;
            if($language!='kg-KG' && $language!='kg')
            {
                $part=explode('-',$language);
                $language=$part[0];
                if($this->hasAttribute('title_'.$language) && $this['title_'.$language])
                    $this->setAttribute('title', $this['title_'.$language] );
                if($this->hasAttribute('text_'.$language) && $this['text_'.$language])
                    $this->setAttribute('text', $this['text_'.$language] );
            }
        }
    }

    public function beforeSave($insert)
    {
        if($this->to_parent==0) $this->to_child=0;
        return parent::beforeSave($insert);
    }
}
