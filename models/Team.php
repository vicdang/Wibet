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
       return ['id'];
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
            [['flag', 'name', 'full_name'], 'string', 'max' => 100],
            [['group_name'], 'string', 'max' => 10],
            [['name', 'full_name', 'group_name'], 'required']
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
            'flag' => 'Flag Images',
            'group_name' => 'Group',
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

    public static function groupDropdown()
    {
        return [
            'A' => 'Group A',
            'B' => 'Group B',
            'C' => 'Group C',
            'D' => 'Group D',
            'E' => 'Group E',
            'F' => 'Group F',
            'G' => 'Group G',
            'H' => 'Group H',
            'I' => 'Group I',
            'J' => 'Group J',
            'K' => 'Group K',
            'L' => 'Group L',
        ];
    }

    public function getStandings()
    {
        $stats = Yii::$app->db->createCommand(
            'SELECT
                COUNT(CASE WHEN (team_1 = :team_id OR team_2 = :team_id) AND team_1_score IS NOT NULL THEN 1 END) as matches_played,
                COUNT(CASE WHEN team_1 = :team_id AND team_1_score > team_2_score THEN 1 END) +
                COUNT(CASE WHEN team_2 = :team_id AND team_2_score > team_1_score THEN 1 END) as wins,
                COUNT(CASE WHEN (team_1 = :team_id OR team_2 = :team_id) AND team_1_score = team_2_score AND team_1_score IS NOT NULL THEN 1 END) as draws,
                COUNT(CASE WHEN team_1 = :team_id AND team_1_score < team_2_score THEN 1 END) +
                COUNT(CASE WHEN team_2 = :team_id AND team_2_score < team_1_score THEN 1 END) as losses,
                SUM(CASE WHEN team_1 = :team_id THEN team_1_score ELSE 0 END) +
                SUM(CASE WHEN team_2 = :team_id THEN team_2_score ELSE 0 END) as goals_for,
                SUM(CASE WHEN team_1 = :team_id THEN team_2_score ELSE 0 END) +
                SUM(CASE WHEN team_2 = :team_id THEN team_1_score ELSE 0 END) as goals_against
            FROM `match`
            WHERE (team_1 = :team_id OR team_2 = :team_id)'
        )->bindValue(':team_id', $this->id)->queryOne();

        $matches = $stats['matches_played'] ?? 0;
        $wins = $stats['wins'] ?? 0;
        $draws = $stats['draws'] ?? 0;
        $losses = $stats['losses'] ?? 0;
        $goals_for = $stats['goals_for'] ?? 0;
        $goals_against = $stats['goals_against'] ?? 0;
        $goal_diff = $goals_for - $goals_against;
        $points = ($wins * 3) + ($draws * 1);

        return [
            'mp' => $matches,
            'w' => $wins,
            'd' => $draws,
            'l' => $losses,
            'gf' => $goals_for,
            'ga' => $goals_against,
            'gd' => $goal_diff,
            'pts' => $points
        ];
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
