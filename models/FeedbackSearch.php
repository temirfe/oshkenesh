<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feedback;

class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'to_parent', 'to_child', 'public'], 'integer'],
            [['from_name', 'from_email', 'date_create', 'date_answered', 'text', 'answer'], 'safe'],
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
        $query = Feedback::find();

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
            'date_create' => $this->date_create,
            'date_answered' => $this->date_answered,
            'to_parent' => $this->to_parent,
            'to_child' => $this->to_child,
            'public' => $this->public,
        ]);

        $query->andFilterWhere(['like', 'from_name', $this->from_name])
            ->andFilterWhere(['like', 'from_email', $this->from_email])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}