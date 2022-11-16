<?php

namespace app\models;

use Yii;
use yii\base\Model;
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
                    WHERE u.role_id = 2) AS ranking_table ORDER BY `total_money` DESC';
	
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $dataProvider;
    }

    public function searchOneBySql($username)
    {
        //$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user')->queryScalar();
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) AS total FROM `user`')->queryOne();
        $count = intval($count['total']);
        $sql = "select `match`.`team_1` ,`match`.`team_2`, `match`.`rate`, `match`.`result`, `match`.`match_date`, `bet`.`option`, `bet`.`money`, `bet`.`is_active`, `user`.`username`,
        (select `full_name` from `team` where `id` = `match`.`team_1`) as team_1_name,
        (select `full_name` from `team` where `id` = `match`.`team_2`) as team_2_name
        from `bet` , `match`, `user`
        where  `bet`.`match_id` = `match`.`id`
        and `user`.id = `bet`.`user_id`
        and `user`.`username` = '".$username."' ORDER BY `match_date` DESC";

        $count = Yii::$app->db->createCommand('select count(*) as total from `bet`, `user` where `bet`.`user_id` = `user`.`id` and `user`.`id` = "' .$username .'"')->queryOne();
        $count = intval($count['total']);
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $dataProvider;
    }
    
}
