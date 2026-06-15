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
            [['flag', 'name', 'full_name'], 'string', 'max' => 255],
            [['group_name'], 'string', 'max' => 10],
            [['knockout_round'], 'string', 'max' => 50],
            [['name', 'full_name'], 'required'],
            [['group_name'], 'required', 'when' => function() { return \app\models\AdminConfig::get('tournament_phase') === 'group_stage'; }, 'whenClient' => false],
            [['flag'], 'url', 'skipOnEmpty' => true]
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
            'knockout_round' => 'Knockout Round',
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

    public static function knockoutRoundDropdown()
    {
        return [
            'Round of 32' => 'Round of 32',
            'Round of 16' => 'Round of 16',
            'Quarterfinals' => 'Quarterfinals',
            'Semifinals' => 'Semifinals',
            'Finals' => 'Finals',
            'Third Place' => 'Third Place',
        ];
    }

    /**
     * Returns standings for every team that has played at least one match,
     * ordered by points (desc), then goal difference (desc).
     *
     * @return array list of ['id', 'name', 'mp', 'w', 'd', 'l', 'gf', 'ga', 'gd', 'pts', 'win_rate']
     */
    public static function getAllStandings()
    {
        $rows = Yii::$app->db->createCommand(
            'SELECT
                t.id,
                t.name,
                COUNT(CASE WHEN (m.team_1 = t.id OR m.team_2 = t.id) AND m.team_1_score IS NOT NULL THEN 1 END) as mp,
                COUNT(CASE WHEN m.team_1 = t.id AND m.team_1_score > m.team_2_score THEN 1 END) +
                COUNT(CASE WHEN m.team_2 = t.id AND m.team_2_score > m.team_1_score THEN 1 END) as w,
                COUNT(CASE WHEN (m.team_1 = t.id OR m.team_2 = t.id) AND m.team_1_score = m.team_2_score AND m.team_1_score IS NOT NULL THEN 1 END) as d,
                COUNT(CASE WHEN m.team_1 = t.id AND m.team_1_score < m.team_2_score THEN 1 END) +
                COUNT(CASE WHEN m.team_2 = t.id AND m.team_2_score < m.team_1_score THEN 1 END) as l,
                COALESCE(SUM(CASE WHEN m.team_1 = t.id THEN m.team_1_score ELSE 0 END), 0) +
                COALESCE(SUM(CASE WHEN m.team_2 = t.id THEN m.team_2_score ELSE 0 END), 0) as gf,
                COALESCE(SUM(CASE WHEN m.team_1 = t.id THEN m.team_2_score ELSE 0 END), 0) +
                COALESCE(SUM(CASE WHEN m.team_2 = t.id THEN m.team_1_score ELSE 0 END), 0) as ga
            FROM team t
            LEFT JOIN `match` m ON (m.team_1 = t.id OR m.team_2 = t.id)
            GROUP BY t.id, t.name
            HAVING mp > 0'
        )->queryAll();

        $standings = [];
        foreach ($rows as $row) {
            $mp = (int) $row['mp'];
            $w = (int) $row['w'];
            $d = (int) $row['d'];
            $l = (int) $row['l'];
            $gf = (int) $row['gf'];
            $ga = (int) $row['ga'];

            $standings[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'mp' => $mp,
                'w' => $w,
                'd' => $d,
                'l' => $l,
                'gf' => $gf,
                'ga' => $ga,
                'gd' => $gf - $ga,
                'pts' => ($w * 3) + $d,
                'win_rate' => $mp > 0 ? round($w / $mp * 100, 1) : 0,
            ];
        }

        usort($standings, function ($a, $b) {
            return $b['pts'] <=> $a['pts'] ?: $b['gd'] <=> $a['gd'];
        });

        return $standings;
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
        if ($this->flag) {
            return $this->flag;
        }

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
