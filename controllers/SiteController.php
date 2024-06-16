<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\RankingSearch;
use app\models\MatchSearch;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $APIkey=Yii::$app->params['api_key'];
        $from = date("Y-m-d");
        $to = date("Y-m-d");
        $league = 1; 

        $curl_options = array(
        CURLOPT_URL => "https://apiv2.allsportsapi.com/football/?met=Fixtures&APIkey=$APIkey&from=$from&to=$to&leagueId=$league",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 5
        );

        $curl = curl_init();
        curl_setopt_array( $curl, $curl_options );
        $result = curl_exec( $curl );

        $result = (array) json_decode($result);

        // var_dump($result['result'][0]);
        // var_dump($result['result'][0]['event_home_team']);
        // var_dump($result['result'][1]['event_away_team']);
        $incomming_matches = [123,1,2];
        return $this->render('index', [
            'incomming_matches' => $incomming_matches,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        
            
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionComment()
    {
        return $this->render('comment');
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionBrackets()
    {
        return $this->render('brackets');
    }

    public function actionAnalysis()
    {
        $rankingSearchModel = new RankingSearch;
        $rankingDataProvider = $rankingSearchModel->searchBySql(Yii::$app->request->getQueryParams());

        $matchSearchModel = new MatchSearch;
        $request = Yii::$app->request->getQueryParams();
        $request["where"] = ["visible"=>1];
        $matchDataProvider = $matchSearchModel->search($request);

        return $this->render('analysis', [
            'rankingDataProvider' => $rankingDataProvider,
            'rankingSearchModel' => $rankingSearchModel,
            'matchSearchModel' => $matchSearchModel,
            'matchDataProvider' => $matchDataProvider,
        ]);
    }
}
