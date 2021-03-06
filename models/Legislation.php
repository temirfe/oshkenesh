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
 * @property string $word
 * @property string $pdf
 */
class Legislation extends \yii\db\ActiveRecord
{
    public $wordFile;
    public $pdfFile;
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
            [['content','word','pdf','word_size','pdf_size'], 'string'],
            [['ru', 'views'], 'integer'],
            [['title'], 'string', 'max' => 500],
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
            'title' => Yii::t('app', 'Legislation title'),
            'content' => Yii::t('app', 'Content'),
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
            'wordFile' => Yii::t('app', 'Word File'),
            'pdfFile' => Yii::t('app', 'PDF File'),
        ];
    }
}
