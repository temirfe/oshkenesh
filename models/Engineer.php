<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "engineer_schools".
 *
 * @property integer $id
 * @property string $Name
 * @property string $City
 * @property string $State
 * @property string $Address
 * @property string $Website
 * @property string $Campus_setting
 * @property integer $Campus_housing
 * @property integer $Student_population
 * @property string $Graduation_Rate
 */
class Engineer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engineer_schools';
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
            [['Website'], 'string', 'max' => 45],
            [['Graduation_Rate'], 'string', 'max' => 5]
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
            'Campus_setting' => 'Campus Setting',
            'Campus_housing' => 'Campus Housing',
            'Student_population' => 'Student Population',
            'Graduation_Rate' => 'Graduation  Rate',
        ];
    }
}
