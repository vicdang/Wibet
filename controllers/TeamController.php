<?php

namespace app\controllers;

use app\models\Team;
use Yii;
use yii\web\Controller;

class TeamController extends Controller
{
    public function actionIndex()
    {
        // Get all teams grouped by group_name
        $teams = Team::find()
            ->orderBy(['group_name' => SORT_ASC, 'name' => SORT_ASC])
            ->all();

        // Group teams by their group
        $groupedTeams = [];
        foreach ($teams as $team) {
            $group = $team->group_name ?: 'Unassigned';
            if (!isset($groupedTeams[$group])) {
                $groupedTeams[$group] = [];
            }
            $groupedTeams[$group][] = $team;
        }

        return $this->render('index', [
            'groupedTeams' => $groupedTeams,
        ]);
    }
}
