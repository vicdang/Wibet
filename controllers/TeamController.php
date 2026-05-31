<?php

namespace app\controllers;

use app\models\Team;
use app\models\TeamSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionAdminIndex()
    {
        $searchModel = new TeamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdminCreate()
    {
        $model = new Team();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Team created successfully.');
            return $this->redirect(['admin-index']);
        }

        return $this->render('admin/create', [
            'model' => $model,
        ]);
    }

    public function actionAdminUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Team updated successfully.');
            return $this->redirect(['admin-index']);
        }

        return $this->render('admin/update', [
            'model' => $model,
        ]);
    }

    public function actionAdminDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Team deleted successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Unable to delete team.');
        }

        return $this->redirect(['admin-index']);
    }

    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested team does not exist.');
    }
}
