<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Decree;

/**
 * DecreeSearch represents the model behind the search form about `app\models\Decree`.
 */
class DecreeSearch extends Decree
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ru', 'views','session_id'], 'integer'],
            [['date', 'title', 'description', 'content', 'number', 'word', 'pdf'], 'safe'],
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
        $query = Decree::find();

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
            'date' => $this->date,
            'ru' => $this->ru,
            'views' => $this->views,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'word', $this->word])
            ->andFilterWhere(['like', 'pdf', $this->pdf]);

        return $dataProvider;
    }
}
