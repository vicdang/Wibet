<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GameMatch;

/**
 * MatchSearch represents the model behind the search form about `app\models\GameMatch`.
 */
class MatchSearch extends GameMatch
{
    public $your_bet;
    public $team_id;
    public $match_status;
    public $visible;
    public $match_day;
    public $hide_completed = '1';

    public function rules()
    {
        return [
            [['id', 'team_1_score', 'team_2_score', 'result', 'created_by', 'team_id', 'visible'], 'integer'],
            [['team_1', 'team_2', 'match_date', 'description', 'created_time', 'modified_time', 'your_bet', 'match_status', 'match_day', 'hide_completed'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function formName()
    {
        // Override to use no prefix for query parameters
        return '';
    }

    public function search($params)
    {
        $query = GameMatch::find();
	    $query->addOrderBy(['match_date' => SORT_ASC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => false,
            'sort' => false,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        //$query->addOrderBy(['id' => SORT_DESC]);
        if(isset($params["where"])){
            $query->where($params["where"]);
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'team_1_score' => $this->team_1_score,
            'team_2_score' => $this->team_2_score,
            'match_date' => $this->match_date,
            'created_by' => $this->created_by,
            'created_time' => $this->created_time,
            'modified_time' => $this->modified_time,
        ]);

        // Visible filter
        if ($this->visible !== null && $this->visible !== '') {
            $query->andWhere(['visible' => $this->visible]);
        }

        // Hide completed (finished AND hidden) matches by default
        if ((int)$this->hide_completed === 1) {
            $query->andWhere(['or',
                ['result' => null],
                ['not in', 'result', [0, 1, 2]],
                ['visible' => 1],
            ]);
        }

        // Team filter (filter by team_1 or team_2)
        if (!empty($this->team_id)) {
            $query->andWhere(['or', ['team_1' => $this->team_id], ['team_2' => $this->team_id]]);
        }

        // Status filter (ongoing, finished, withdrawn)
        if (!empty($this->match_status)) {
            if ($this->match_status === 'ongoing') {
                $query->andWhere(['IS', 'result', new \yii\db\Expression('NULL')]);
            } elseif ($this->match_status === 'finished') {
                $query->andWhere(['in', 'result', [0, 1, 2]]);
            } elseif ($this->match_status === 'withdrawn') {
                $query->andWhere(['result' => 3]);
            }
        }

        $query->andFilterWhere(['like', 'description', $this->description]);

        // Day filter (filter matches happening on a specific date)
        if (!empty($this->match_day)) {
            $query->andWhere(['between', 'match_date', $this->match_day . ' 00:00:00', $this->match_day . ' 23:59:59']);
        }

        // Your bet filter
        if (!empty($this->your_bet) && Yii::$app->user->isGuest === false) {
            $userId = Yii::$app->user->id;

            if ($this->your_bet === 'placed') {
                $query->innerJoin('{{%bet}}', '{{%bet}}.match_id = {{%match}}.id AND {{%bet}}.user_id = ' . (int)$userId);
            } elseif ($this->your_bet === 'won') {
                $query->innerJoin('{{%bet}}', '{{%bet}}.match_id = {{%match}}.id AND {{%bet}}.user_id = ' . (int)$userId)
                    ->andWhere('{{%match}}.result = {{%bet}}.option AND {{%match}}.result != 0 AND {{%match}}.result != 3');
            } elseif ($this->your_bet === 'lost') {
                $query->innerJoin('{{%bet}}', '{{%bet}}.match_id = {{%match}}.id AND {{%bet}}.user_id = ' . (int)$userId)
                    ->andWhere(['or',
                        ['and', '{{%match}}.result != 0', '{{%match}}.result != 3', '{{%match}}.result != {{%bet}}.option'],
                    ]);
            }
        }

        return $dataProvider;
    }
}
