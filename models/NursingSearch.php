<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NursingSchools;

/**
 * NursingSearch represents the model behind the search form about `app\models\NursingSchools`.
 */
class NursingSearch extends NursingSchools
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Campus_housing', 'Student_population'], 'integer'],
            [['Name', 'City', 'State', 'Address', 'Website', 'Type', 'Campus_setting'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = NursingSchools::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'Campus_housing' => $this->Campus_housing,
            'Student_population' => $this->Student_population,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'City', $this->City])
            ->andFilterWhere(['like', 'State', $this->State])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'Website', $this->Website])
            ->andFilterWhere(['like', 'Type', $this->Type])
            ->andFilterWhere(['like', 'Campus_setting', $this->Campus_setting]);

        return $dataProvider;
    }
}
