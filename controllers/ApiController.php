<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class ApiController extends Controller
{

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

    public function actionGetMatchByDate()
    {
        $email = "didi00889900@gmail.com";
        $password = "12345678";

        $now = date("m/d/Y");


        if (!isset($_SESSION['token'])) {
             $this->setApiToken($email, $password);
        }

        $token = $_SESSION['token'];
        
        

        $result = $this->getMatchAPI($token, $now);

        return json_encode($result);
    }



    public function loginAPI($email, $password)
    {
        $service_url = 'http://api.cup2022.ir/api/v1/user/login';
        $curl = curl_init();

        $curl_post_data = json_encode(['email' => $email,  'password' => $password]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_URL, $service_url);


        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);


        curl_setopt($curl, CURLOPT_HTTPHEADER, [
                                                    'accept: application/json',
                                                    'content-type: application/json'
                                                ]);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }

        if($decoded->data->token){
            return $decoded->data->token;
        }else{
            return false;
        }
    }

    public function getMatchAPI($token, $date)
    {
        $service_url = 'http://api.cup2022.ir/api/v1/bydate';
        $curl = curl_init();

        $curl_post_data = json_encode(['date' =>  $date]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_URL, $service_url);


        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);


        curl_setopt($curl, CURLOPT_HTTPHEADER, [
                                                    'accept: application/json',
                                                    'content-type: application/json',
                                                    'Authorization: Bearer ' . $token,
                                                ]);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            session_unset($_SESSION['token']);
            die('error occured: ' . $decoded->response->errormessage);
        }

        if($decoded->data){
            return $decoded->data;
        }
        return false;
    }

    public function setApiToken($email, $password)
    {        
        $_SESSION['token'] = $this->loginAPI($email, $password);

    }
}
