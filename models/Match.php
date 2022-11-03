<?php

namespace app\models;

use Yii;
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * This is the model class for table "match".
 *
 * @property string $id
 * @property string $campaign_id
 * @property string $team_1
 * @property string $team_2
 * @property integer $team_1_score
 * @property integer $team_2_score
 * @property double $rate
 * @property integer $result
 * @property string $match_date
 * @property string $description
 * @property string $created_by
 * @property string $created_time
 * @property string $modified_time
 *
 * @property Bet[] $bets
 * @property Campaign $campaign
 * @property User $createdBy
 */
class Match extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $action = strtolower(Yii::$app->controller->action->id);
        return [
            [['campaign_id', 'team_1_score', 'team_2_score', 'result', 'created_by'], 'integer'],
            [['rate'], 'number'],
            [['rate'], 'isDivisibleByHalf'],
//            [['match_date'], 'compare',
//                'operator' => '>',
//                'compareValue' => date('Y-m-d H:i:s')
//            ],
            [['match_date', 'created_time', 'modified_time'], 'safe'],
            [['description'], 'string'],
            [['team_1', 'team_2'], 'string', 'max' => 50],
            [['team_1_score', 'team_2_score'], 'integer', 'min' => 0],
            ($action != 'update-score') ?
                [['team_1', 'team_2', 'match_date', 'rate'], 'required'] :
                [['team_1_score', 'team_2_score'], 'required']
        ];
    }

    public function isDivisibleByHalf($attribute) {
        $round = round($this->$attribute, 1) * 10;
        if ($round % 5 != 0) {
            $this->addError($attribute, 'Rate must be multiple of 0.5');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campaign_id' => 'Campaign ID',
            'team_1' => 'Team 1',
            'team_2' => 'Team 2',
            'team_1_score' => 'Team 1 Score',
            'team_2_score' => 'Team 2 Score',
            'rate' => 'Rate',
            'result' => 'Result',
            'match_date' => 'Match Date',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
            'modified_time' => 'Modified Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBets()
    {
        return $this->hasMany(Bet::className(), ['match_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'campaign_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return string
     */
    public  function getMatchName()
    {
        return $this->team_1 .' - '. $this->team_2;
    }

    public function getRateText()
    {
        if ($this->rate == 0) {
            return "0:0";
        }if ($this->rate > 0) {
            return "0:" . $this->rateToString($this->rate);
        } else {
            return $this->rateToString($this->rate) . ":0";
        }
    }

    protected function rateToString($rate) {
        $rate = abs($rate);
        $round = round($rate, 0, PHP_ROUND_HALF_DOWN);
        if ($round == $rate) {
            return $rate;
        } else {
            return ($round > 0 ? $round." " : "") . "1/2";
        }
    }

    /**
     * Chi cho bet truoc tran dau dien ra 5 phut.
     * Vd tran dau dien ra luc 10h thi 9h55 ko cho bet.
     * @return bool
     */
    public function canBet()
    {
        return $this->canUpdate() && (is_null($this->match_date) || date('Y-m-d H:i:s', strtotime('+0 minutes')) <= $this->match_date);
    }

    /**
     * @return bool
     */
    public function canUpdate()
    {
       return (is_null($this->result));
    }

    public function canDelete()
    {
        return (count($this->bets) <= 0);

    }

    public function beforeSave($insert)
    {
        if (!is_null($this->rate) && is_null($this->result)) // update tran dau chua dien ra
        {
            $this->rate = round($this->rate, 1);
        }
        // update ti so => ket qua ca cuoc cua tran dau
        if (!is_null($this->team_1_score) && !is_null($this->team_2_score) && is_null($this->result))
        {
            $rate = $this->team_1_score - $this->team_2_score;
            $this->result = 0;
            if ($rate > $this->rate) {
                $this->result = 1;
            } else if ($rate < $this->rate) {
                $this->result = 2;
            }
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert)
    {
        // sau khi co ket qua tran dau
        // 1. quet tat ca cac user da tham gia dat cuoc
        // 2. xet ket qua dat cuoc de cong, tru tien cho moi user
        if (!is_null($this->result))
        {
            foreach ($this->bets as $bet)
                $bet->updateBetMoneyResult($this->result);
        }

        return parent::afterSave($insert);
    }
}
