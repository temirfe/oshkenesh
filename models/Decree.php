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
    public $wordFile;
    public $pdfFile;
    public $word_size;
    public $pdf_size;
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
            [['content','word','pdf','word_size','pdf_size'], 'string'],
            [['ru', 'views','session_id'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
            [['number'], 'string', 'max' => 20],
            [['word', 'pdf'], 'string', 'max' => 255],
            [['wordFile'], 'file', 'extensions' => 'doc,docx,rtf'],
            [['pdfFile'], 'file', 'extensions' => 'pdf']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date of adoption'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
            'number' => Yii::t('app', 'Decree number'),
            'session_id' => Yii::t('app', 'Session name'),
            'word' => Yii::t('app', 'Word'),
            'pdf' => Yii::t('app', 'Pdf'),
            'wordFile' => Yii::t('app', 'Word File'),
            'pdfFile' => Yii::t('app', 'PDF File'),
        ];
    }

    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'session_id']);
    }
}
