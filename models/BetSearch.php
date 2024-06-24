<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bet;

/**
 * BetSearch represents the model behind the search form about `app\models\Bet`.
 */
class BetSearch extends Bet
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'match_id', 'option', 'money'], 'integer'],
            [['created_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Bet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
            // 'pagination' => [
            //     'pageSize' => 10,
            // ],
            //'sort' => false,
        ]);
        //$query->addOrderBy(['id' => SORT_DESC]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'match_id' => $this->match_id,
            'option' => $this->option,
            'money' => $this->money,
            'created_time' => $this->created_time,
        ]);

        return $dataProvider;
    }
}
