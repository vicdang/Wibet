<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

class RankingSearch extends Ranking
{

    public function rules()
    {
        return [
            [['id', 'money', 'total_money', 'bet_times', 'win_times'], 'integer'],
            [['username', 'email', 'full_name', 'bet_times', 'win_times', 'win_rate', 'money', 'total_money'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Ranking::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false
            //'sort' => false,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'bet_times' => $this->bet_times,
            'win_times' => $this->win_times,
            'win_rate' => $this->win_rate,
            'money' => $this->money,
            'total_money' => $this->total_money,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }

    public function searchBySql()
    {
        //$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user')->queryScalar();
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) AS total FROM `user`')->queryOne();
        $count = intval($count['total']);
        $sql = 'SELECT *, ROUND(win_times/bet_times*100,2) AS win_rate, (money+bet_money) AS total_money
                FROM
                    ( SELECT u.id, u.username, u.email, p.full_name, p.money,
                                ( SELECT COUNT(id) FROM bet WHERE user_id = u.id ) AS bet_times,
                                ( SELECT COUNT(b.id) FROM bet b INNER JOIN `match` m ON m.id = match_id
                                                WHERE user_id=u.id AND m.result IS NOT NULL AND `option` = m.result AND m.result <> 0 ) AS win_times,
                                ( SELECT IF(COUNT(money) > 0, SUM(money), 0) FROM bet WHERE user_id=u.id AND is_active = 1 ) AS bet_money
                    FROM `user` u
                        INNER JOIN `profile` p ON p.user_id = u.id
                    WHERE u.role_id = 2 ) AS ranking_table';

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        // add extra sort attributes
        $addSortAttributes = ["money", "total_money", "bet_times", "win_times", "win_rate"];
        //$attributeLabels = $this->getAttributeLabels();
        foreach ($addSortAttributes as $addSortAttribute) {
            $dataProvider->sort->attributes[$addSortAttribute] = [
                'asc' => [$addSortAttribute => SORT_ASC],
                'desc' => [$addSortAttribute => SORT_DESC],
                //'label' => $attributeLabels[$addSortAttribute],
            ];
        }

        return $dataProvider;
    }
}
