<?php

namespace app\controllers;

use amnah\yii2\user\models\User;
use Yii;
use app\models\Bet;
use app\models\Match;
use app\models\BetSearch;
use app\models\Ranking;
use app\models\RankingSearch;
use amnah\yii2\user\models\AdminConfig;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * RankingController implements the CRUD actions for Bet model.
 */
class RankingController extends Controller
{



   public function actionIndex()
   {
        $searchModel = new RankingSearch;
        $dataProvider = $searchModel->searchBySql(Yii::$app->request->getQueryParams());
        $hide_history = AdminConfig::getConfigHistory()->value;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'hide_history' => $hide_history,
        ]);
    //    return $this->render('index');
   }

   public function actionView($username)
   {
        if(AdminConfig::getConfigHistory()->value == 0){
            $user = new User;
            $user = $user::findOne(['username'=>$username]);
            if (!$user) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
          return $this->render('view', [
               'dataProvider' =>  $this->findModel($username),
               'user' => $user,
           ]);
        }else{
            throw new NotFoundHttpException('You cannot view the history now!.');
        }
   }



    /**
     * Finds the Bet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        $searchModel = new RankingSearch;
        $dataProvider = $searchModel->searchOneBySql($username);
        return $dataProvider;
    }

    // protected function findMatchModel($id)
    // {
    //     if (($model = Match::findOne($id)) !== null) {
    //         return $model;
    //     } else {
    //         throw new NotFoundHttpException('Sorry, the match does not exist.');
    //     }
    // }

    // protected function findUserModel($id)
    // {
    //     if (($model = User::findOne($id)) !== null) {
    //         return $model;
    //     } else {
    //         throw new NotFoundHttpException('Sorry, the user does not exist.');
    //     }
    // }
}
