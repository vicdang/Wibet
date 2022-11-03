<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Match;

/**
 * MatchSearch represents the model behind the search form about `app\models\Match`.
 */
class MatchSearch extends Match
{
    public function rules()
    {
        return [
            [['id', 'team_1_score', 'team_2_score', 'result', 'created_by'], 'integer'],
            [['team_1', 'team_2', 'match_date', 'description', 'created_time', 'modified_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Match::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
            //'sort' => false,
        ]);
        //$query->addOrderBy(['id' => SORT_DESC]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'team_1_score' => $this->team_1_score,
            'team_2_score' => $this->team_2_score,
            'result' => $this->result,
            'match_date' => $this->match_date,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'team_1', $this->team_1])
            ->andFilterWhere(['like', 'team_2', $this->team_2])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
