<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deputy".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $party
 * @property string $content
 * @property string $image
 * @property string $content_ru
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $views
 */
class Deputy extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deputy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname'], 'required'],
            [['content', 'content_ru'], 'string'],
            [['views','listorder','party_id'], 'integer'],
            [['fullname', 'image', 'phone', 'email', 'address'], 'string', 'max' => 255],
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
            'fullname' => Yii::t('app', 'Full name'),
            'party_id' => Yii::t('app', 'Party'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'views' => Yii::t('app', 'Views'),
            'listorder' => Yii::t('app', 'Order'),
        ];
    }

    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }
}
