<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property string $id
 * @property string $name
 * @property string $flag
 * @property string $full_name

 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @return string|\string[]
     */
    public static function primaryKey()
    {
       return 'id';
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['flag', 'name', 'full_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'full_name' => 'Full Name',
            'flag' => 'Flag images',
        ];
    }
    public static function dropdown()
    {
        // get all records from database and generate
        static $dropdown;
        if ($dropdown === null) {
            $dropdown = [];
            $models = static::find()->all();
            foreach ($models as $model) {
                $dropdown[$model->id] = $model->name . " - " . $model->full_name;
            }
        }
        return $dropdown;
    }

    private static $countryCodeMap = [
        'Mexico' => 'MEX',
        'South Africa' => 'RSA',
        'South Korea' => 'KOR',
        'Czechia' => 'CZE',
        'Canada' => 'CAN',
        'Bosnia and Herzegovina' => 'BIH',
        'Qatar' => 'QAT',
        'Switzerland' => 'SUI',
        'Brazil' => 'BRA',
        'Morocco' => 'MAR',
        'Scotland' => 'SCO',
        'Haiti' => 'HAI',
        'USA' => 'USA',
        'Australia' => 'AUS',
        'Paraguay' => 'PAR',
        'Germany' => 'GER',
        'Ecuador' => 'ECU',
        'Ivory Coast' => 'CIV',
        'Curacao' => 'CUW',
        'Netherlands' => 'NED',
        'Japan' => 'JPN',
        'Tunisia' => 'TUN',
        'Belgium' => 'BEL',
        'Iran' => 'IRN',
        'Egypt' => 'EGY',
        'New Zealand' => 'NZL',
        'Spain' => 'ESP',
        'Uruguay' => 'URU',
        'Saudi Arabia' => 'KSA',
        'Cape Verde' => 'CPV',
        'France' => 'FRA',
        'Senegal' => 'SEN',
        'Norway' => 'NOR',
        'Play-off Intercontinental 2' => 'INT',
        'Argentina' => 'ARG',
        'Austria' => 'AUT',
        'Algeria' => 'ALG',
        'Jordan' => 'JOR',
        'Portugal' => 'POR',
        'Colombia' => 'COL',
        'Uzbekistan' => 'UZB',
        'Play-off Intercontinental 1' => 'INT',
        'England' => 'ENG',
        'Croatia' => 'CRO',
        'Panama' => 'PAN',
        'Ghana' => 'GHA',
        'Play-off UEFA A' => 'EUA',
        'Play-off UEFA B' => 'EUB',
        'Play-off UEFA C' => 'EUC',
        'Play-off UEFA D' => 'EUD',
    ];

    public function getFlagUrl()
    {
        $code = self::$countryCodeMap[$this->name] ?? null;
        if ($code && strpos($code, 'INT') === false && strpos($code, 'EU') === false) {
            return "https://img.uefa.com/imgml/flags/140x140/{$code}.png";
        }
        return null;
    }

    public function isPlayoffTeam()
    {
        return strpos($this->name, 'Play-off') !== false;
    }
}
