<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ranking".
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $full_name
 * @property integer $money
 * @property integer $total_money
 * @property integer $bet_times
 * @property integer $win_times
 * @property double $win_rate
 */
class Ranking extends \yii\db\ActiveRecord
{
    /**
     * @return string|\string[]
     */
//    public static function primaryKey()
//    {
//        return 'id';
//    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ranking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'money', 'total_money', 'bet_times', 'win_times'], 'integer'],
            [['win_rate'], 'number'],
            [['username', 'email', 'full_name'], 'string', 'max' => 255]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'full_name' => 'Full Name',
            'money' => 'Current Money',
            'total_money' => 'Total Money',
            'bet_times' => 'Bet Times',
            'win_times' => 'Win Times',
            'win_rate' => 'Win Rate (%)',
        ];
    }
}
