<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $description
 * @property string $content
 * @property integer $ru
 * @property integer $views
 * @property string $number
 * @property string $author
 * @property string $word
 * @property string $pdf
 */
class Bill extends \yii\db\ActiveRecord
{
    public $wordFile;
    public $pdfFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
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
            [['description'], 'string', 'max' => 1000],
            [['number'], 'string', 'max' => 20],
            [['author', 'word', 'pdf'], 'string', 'max' => 255],
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
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'ru' => Yii::t('app', 'Ru'),
            'views' => Yii::t('app', 'Views'),
            'number' => Yii::t('app', 'Number'),
            'author' => Yii::t('app', 'Author'),
            'word' => Yii::t('app', 'Word'),
            'pdf' => Yii::t('app', 'Pdf'),
            'wordFile' => Yii::t('app', 'Word File'),
            'pdfFile' => Yii::t('app', 'PDF File'),
        ];
    }
}
