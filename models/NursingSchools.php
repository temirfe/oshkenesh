<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nursing_schools".
 *
 * @property integer $id
 * @property string $Name
 * @property string $City
 * @property string $State
 * @property string $Address
 * @property string $Website
 * @property string $Type
 * @property string $Campus_setting
 * @property integer $Campus_housing
 * @property integer $Student_population
 */
class NursingSchools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nursing_schools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Student_population'], 'required'],
            [['id', 'Campus_housing', 'Student_population'], 'integer'],
            [['Name', 'Address'], 'string', 'max' => 255],
            [['City', 'State', 'Campus_setting'], 'string', 'max' => 25],
            [['Website', 'Type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'City' => 'City',
            'State' => 'State',
            'Address' => 'Address',
            'Website' => 'Website',
            'Type' => 'Type',
            'Campus_setting' => 'Campus Setting',
            'Campus_housing' => 'Campus Housing',
            'Student_population' => 'Student Population',
        ];
    }
}
