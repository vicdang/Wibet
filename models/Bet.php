<?php

namespace app\models;

use Yii;
use amnah\yii2\user\models\User;

/**
 * This is the model class for table "bet".
 *
 * @property string $id
 * @property string $user_id
 * @property string $match_id
 * @property integer $option
 * @property integer $is_active
 * @property integer $money
 * @property string $created_time
 *
 * @property User $user
 * @property Match $match
 */
class Bet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $max_money_value = Yii::$app->user->money;
        $action = strtolower(Yii::$app->controller->action->id);
        if ($action == "update") {
            $id = (int)Yii::$app->request->get('id');
            $max_money_value += Bet::findOne($id)->money;
        }
        return [
            [['user_id', 'match_id', 'option', 'money'], 'integer'],
            [['option', 'money'], 'required'],
            [['money'],'integer', 'min' => 1],
            //[['money'], 'isDivisibleByTen'],
            [['money'], 'compare',
                'operator' => '<=',
                'compareValue' => $max_money_value,
                //'message' => 'Please check your available money.'
            ],
            [['option'], 'in', 'range' => [0, 1, 2]],
            [['user_id', 'match_id'], 'unique',
                'targetAttribute' => ['user_id', 'match_id'],
                'message' => 'You have already betted this match.'],
            [['created_time'], 'safe']
        ];
    }

    public function isDivisibleByTen($attribute) {
        if (($this->$attribute % 10) != 0) {
            $this->addError($attribute, 'must be multiple of 10');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'match_id' => 'Match ID',
            'option' => 'Option',
            'money' => 'Money',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Match::className(), ['id' => 'match_id']);
    }

    public function getChoice()
    {
        return $this->hasOne(Team::className(), ['id' => 'option']);
    }

    /**
     * Check if the bet is exist
     * @param $user_id
     * @param $match_id
     * @return bool|\app\models\Bet
     */
    public static function isExist($user_id, $match_id)
    {
        $model = self::findOne(['user_id' => $user_id, 'match_id' => $match_id]);
        if ($model !== null)
            return $model;
        return false;
    }

    public function getBettingOption()
    {
        switch ($this->option) {
            case 1:
                return $this->match->team1->name;
            case 2:
                return $this->match->team2->name;
            default:
                return "-";
        }
    }

    public function getBettedResult()
    {
        if (is_null($this->match->result)) {
            return "-";
        }
        elseif ($this->match->result == 0)
            return "DRAW";
        elseif ($this->match->result == 3)
            return "CANCELED";
        elseif ($this->match->result == $this->option)
            return "WIN";
        else
            return 'LOSE';
    }

    /**
     * Cong/tru tien cua moi user sau khi co ket qua tran dau
     * @param $bet_result
     */
    public function updateBetMoneyResult($bet_result)
    {
        if ($this->is_active) {
            if ($bet_result != 0 && $bet_result != 3 ) {
                if ($this->option == $bet_result) {
                    $this->user->updateMoney( 2*$this->money );
                }
            } else {
                // ket qua hoa, tra tien lai user
                $this->user->updateMoney( $this->money );
            }
            // khoa' bet hien tai
            $this->is_active = false;
            $this->save(false, ['is_active']);
        }
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->is_active = true;
        } else {
            $this->created_time = date('Y-m-d H:i:s', time());
        }
        return parent::beforeSave($insert);
    }

    /**
     * Cong/tru tien cua user sau moi lan bet
     * @param bool $insert
     */
    public function afterSave($insert, $changedAttributes)
    {
        // tru tien da dat cuoc
        if ($this->is_active) {
            if ($insert) {
                $value = ( 0 - $this->money );
            } else {
                $value = $this->oldAttributes['money'] - $this->money;
            }
            $this->user->profile->updateMoney($value);
        }
        return parent::afterSave($insert, $changedAttributes);
    }


    /**
     * Cong/tru tien cua user sau khi huy lan bet
     */
    public function afterDelete()
    {
        $this->user->updateMoney($this->money);
        return parent::afterDelete();
    }
}
