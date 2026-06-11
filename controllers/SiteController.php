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
use app\models\AdminConfig;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'comment'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'comment'],
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
        return $this->render('index');
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
        // Load config values from AdminConfig with fallback to params
        $config = [
            'totalAmount' => AdminConfig::get('total_amount') ?: Yii::$app->params['totalAmount'],
            'mtRate' => AdminConfig::get('mt_rate') ?: Yii::$app->params['mtRate'],
            'p1Rate' => AdminConfig::get('p1_rate') ?: Yii::$app->params['p1Rate'],
            'p1Count' => AdminConfig::get('p1_count') ?: Yii::$app->params['p1Count'],
            'p2Rate' => AdminConfig::get('p2_rate') ?: Yii::$app->params['p2Rate'],
            'p2Count' => AdminConfig::get('p2_count') ?: Yii::$app->params['p2Count'],
            'p3Rate' => AdminConfig::get('p3_rate') ?: Yii::$app->params['p3Rate'],
            'p3Count' => AdminConfig::get('p3_count') ?: Yii::$app->params['p3Count'],
            'p4Rate' => AdminConfig::get('p4_rate') ?: Yii::$app->params['p4Rate'],
            'p4Count' => AdminConfig::get('p4_count') ?: Yii::$app->params['p4Count'],
            'p5Rate' => AdminConfig::get('p5_rate') ?: Yii::$app->params['p5Rate'],
            'p5Count' => AdminConfig::get('p5_count') ?: Yii::$app->params['p5Count'],
            'appName' => AdminConfig::get('season_name') ?: Yii::$app->params['appName'],
            'seasonName' => AdminConfig::get('season_name') ?: Yii::$app->params['seasonName'],
            'adminName' => AdminConfig::get('admin_name') ?: Yii::$app->params['adminName'],
            'adminChat' => AdminConfig::get('admin_chat') ?: Yii::$app->params['adminChat'],
            'adminEmail' => AdminConfig::get('admin_email') ?: Yii::$app->params['adminEmail'],
            'groupChat' => AdminConfig::get('group_chat') ?: Yii::$app->params['groupChat'],
        ];

        return $this->render('rules', ['config' => $config]);
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

        // Load config values from AdminConfig with fallback to params
        $config = [
            'totalAmount' => AdminConfig::get('total_amount') ?: Yii::$app->params['totalAmount'],
            'p1Rate' => AdminConfig::get('p1_rate') ?: Yii::$app->params['p1Rate'],
            'p1Count' => AdminConfig::get('p1_count') ?: Yii::$app->params['p1Count'],
            'p2Rate' => AdminConfig::get('p2_rate') ?: Yii::$app->params['p2Rate'],
            'p2Count' => AdminConfig::get('p2_count') ?: Yii::$app->params['p2Count'],
            'p3Rate' => AdminConfig::get('p3_rate') ?: Yii::$app->params['p3Rate'],
            'p3Count' => AdminConfig::get('p3_count') ?: Yii::$app->params['p3Count'],
            'p4Rate' => AdminConfig::get('p4_rate') ?: Yii::$app->params['p4Rate'],
            'p4Count' => AdminConfig::get('p4_count') ?: Yii::$app->params['p4Count'],
            'p5Rate' => AdminConfig::get('p5_rate') ?: Yii::$app->params['p5Rate'],
            'p5Count' => AdminConfig::get('p5_count') ?: Yii::$app->params['p5Count'],
            'currencyReal' => Yii::$app->params['currencyReal'],
        ];

        return $this->render('analysis', [
            'rankingDataProvider' => $rankingDataProvider,
            'rankingSearchModel' => $rankingSearchModel,
            'matchSearchModel' => $matchSearchModel,
            'matchDataProvider' => $matchDataProvider,
            'config' => $config,
        ]);
    }
}
