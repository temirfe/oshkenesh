<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "toraga".
 *
 * @property integer $id
 * @property string $image
 * @property integer $deputy_id
 *
 * @property Deputy $deputy
 */
class Toraga extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toraga';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deputy_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'jpg,jpeg,gif,png']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'deputy_id' => Yii::t('app', 'Select Deputy'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeputy()
    {
        return $this->hasOne(Deputy::className(), ['id' => 'deputy_id']);
    }
}
