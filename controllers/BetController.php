<?php

namespace app\controllers;

use amnah\yii2\user\models\User;
use Yii;
use app\models\Bet;
use app\models\Match;
use app\models\BetSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BetController implements the CRUD actions for Bet model.
 */
class BetController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
//                        'actions' => Yii::$app->user->can("admin") ?
//                                ['view', 'create', 'update', 'delete'] :
//                                ['view', 'create', 'update'],
                        'actions' => ['view', 'view-by-user', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
//    public function init() {
//
//        // check for admin permission in web requests. console requests should not throw the exception
//        if (!isset($_GET['match_id']) || (int)$_GET['match_id'] == 0) {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//
//        parent::init();
//    }

    /**
     * Lists all Bet models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new BetSearch;
//        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//            'searchModel' => $searchModel,
//        ]);
//    }

    /**
     * View all bets of a match
     * @return string
     */

    public function actionView()
    {
        $match_id = (int)$_GET['match_id'];
        $searchModel = new BetSearch;
        $searchModel->match_id = $match_id;
        if (!isset($_GET['sort'])) $_GET['sort'] = '-created_time';
        $dataProvider = $searchModel->search(['BetSearch' => $searchModel->attributes]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'match' => $this->findMatchModel($match_id),
        ]);
    }

    /**
     * View bet history of a user
     * @param $id
     * @return string
     */
    public function actionViewByUser($id)
    {
        $searchModel = new BetSearch;
        $searchModel->user_id = $id;
        if (!isset($_GET['sort'])) $_GET['sort'] = '-created_time';
        $dataProvider = $searchModel->search(['BetSearch' => $searchModel->attributes]);

        return $this->render('view-user-history', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'user' => $this->findUserModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = new Bet;
        $match = $this->findMatchModel((int)$_GET['match_id']);

        if (!$match->canBet())
            throw new NotFoundHttpException('The requested page does not exist.');
        else if (Yii::$app->user->money <= 0) {
            throw new BadRequestHttpException('Sorry, you don\'t have enough money to create new bet.');
        } elseif (Bet::isExist(Yii::$app->user->id, $match->id)) {
            throw new BadRequestHttpException('You have already betted this match.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->match_id = $match->id;
            if ($model->save())
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['/match']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'match' => $match
            ]);
        }
    }

    /**
     * Update an existing bet model
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id != Yii::$app->user->id || !$model->match->canBet())
            throw new NotFoundHttpException('The requested page does not exist.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['/match']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id != Yii::$app->user->id || !$model->match->canBet())
            throw new NotFoundHttpException('The requested page does not exist.');

        $model->delete();

        return $this->redirect(['/match/index']);
    }

    /**
     * Finds the Bet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findMatchModel($id)
    {
        if (($model = Match::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Sorry, the match does not exist.');
        }
    }

    protected function findUserModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Sorry, the user does not exist.');
        }
    }
}
