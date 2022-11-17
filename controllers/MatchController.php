<?php

namespace app\controllers;

use Yii;
use app\models\Match;
use app\models\MatchSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use amnah\yii2\user\models\AdminConfig;

/**
 * MatchController implements the CRUD actions for Match model.
 */
class MatchController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
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
                        'actions' => Yii::$app->user->can("admin") ?
                                ['index', 'view', 'create', 'update', 'update-score', 'delete'] :
                                ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * Lists all Match models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatchSearch;
        if (!isset($_GET['sort'])) $_GET['sort'] = '-match_date';
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $hide_history = AdminConfig::getConfigHistory()->value;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'hide_history' => $hide_history,
        ]);
    }

    /**
     * Displays a single Match model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

            if(is_numeric($id)){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }else{
                throw new NotFoundHttpException('Sorry, the match does not exist.');
            }
    }

    /**
     * Creates a new Match model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Match;
        if ($model->load(Yii::$app->request->post())) {
		//print_r(Yii::$app->request->post());
	    if(Yii::$app->request->post()['Match']['team_1'] == Yii::$app->request->post()['Match']['team_2']){
	      throw new NotFoundHttpException('Sorry, the match cannot be created.');
	    }
	    $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Match model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!$model->canUpdate())
            throw new BadRequestHttpException('Sorry, you can not update this match anymore.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateScore($id)
    {
        $model = $this->findModel($id);

        if (isset($model->result))
            throw new BadRequestHttpException('Sorry, you can not update this match anymore.');

        $request = Yii::$app->request;
        $post = $request->post();
        if ($request->isPost && isset($post['auto_result']) && $post['auto_result'] == '1') {
            $post['Match']['result'] = null;

        }

        if ($model->load($post) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'update_score' => true
            ]);
        }
    }

    /**
     * Deletes an existing Match model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionVisible($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionHide($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Match model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Match the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Match::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
