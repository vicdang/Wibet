<?php

namespace app\controllers;

use Yii;
use app\models\AdminConfig;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ConfigController extends Controller
{
    public function beforeAction($action)
    {
        if ($action->id === 'get-ai-config') {
            if (Yii::$app->user->isGuest) {
                throw new ForbiddenHttpException('You must be logged in.');
            }
            return parent::beforeAction($action);
        }

        if (!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return parent::beforeAction($action);
    }

    /**
     * Check if current user is god (role_id 5)
     */
    private function isGod()
    {
        $user = Yii::$app->user;
        return !$user->isGuest && $user->identity->role_id == 5;
    }

    public function actionIndex()
    {
        $isGod = $this->isGod();

        $config = [
            // System Settings
            'theme' => AdminConfig::get('theme', 'dark'),
            'hide_history' => AdminConfig::get('hide_history', '0'),
            'hide_bet_info' => AdminConfig::get('hide_bet_info', '0'),
            'show_account_name' => AdminConfig::get('show_account_name', '0'),
            'bankruptcy_text' => AdminConfig::get('bankruptcy_text', 'Bankruptcy'),
            'tournament_phase' => AdminConfig::get('tournament_phase', 'group_stage'),

            // Application Settings
            'season_name' => AdminConfig::get('season_name', Yii::$app->params['seasonName']),
            'group_chat' => AdminConfig::get('group_chat', Yii::$app->params['groupChat']),
            'admin_chat' => AdminConfig::get('admin_chat', Yii::$app->params['adminChat']),
            'admin_name' => AdminConfig::get('admin_name', Yii::$app->params['adminName']),
            'admin_email' => AdminConfig::get('admin_email', Yii::$app->params['adminEmail']),
            'sender_name' => AdminConfig::get('sender_name', Yii::$app->params['senderName']),

            // Betting Settings
            'starting_money' => AdminConfig::get('starting_money', Yii::$app->params['startingMoney']),
            'min_bet_money' => AdminConfig::get('min_bet_money', Yii::$app->params['minBetMoney']),
            'min_bet_times' => AdminConfig::get('min_bet_times', Yii::$app->params['minBetTimes']),
            'max_refill_times' => AdminConfig::get('max_refill_times', Yii::$app->params['maxRefillTimes']),
            'account_per_user' => AdminConfig::get('account_per_user', Yii::$app->params['accountPerUser']),

            // Payment Settings
            'min_pay_money' => AdminConfig::get('min_pay_money', Yii::$app->params['minPayMoney']),
            'max_pay_money' => AdminConfig::get('max_pay_money', Yii::$app->params['maxPayMoney']),
            'pay_time' => AdminConfig::get('pay_time', implode(',', Yii::$app->params['payTime'])),

            // Prize Pool Settings
            'total_amount' => AdminConfig::get('total_amount', Yii::$app->params['totalAmount']),
            'gift_item' => AdminConfig::get('gift_item', Yii::$app->params['giftItem']),
            'mt_rate' => AdminConfig::get('mt_rate', Yii::$app->params['mtRate']),
            'adj_rate' => AdminConfig::get('adj_rate', Yii::$app->params['adjRate']),
            'p1_rate' => AdminConfig::get('p1_rate', Yii::$app->params['p1Rate']),
            'p1_count' => AdminConfig::get('p1_count', Yii::$app->params['p1Count']),
            'p2_rate' => AdminConfig::get('p2_rate', Yii::$app->params['p2Rate']),
            'p2_count' => AdminConfig::get('p2_count', Yii::$app->params['p2Count']),
            'p3_rate' => AdminConfig::get('p3_rate', Yii::$app->params['p3Rate']),
            'p3_count' => AdminConfig::get('p3_count', Yii::$app->params['p3Count']),
            'p4_rate' => AdminConfig::get('p4_rate', Yii::$app->params['p4Rate']),
            'p4_count' => AdminConfig::get('p4_count', Yii::$app->params['p4Count']),
            'p5_rate' => AdminConfig::get('p5_rate', Yii::$app->params['p5Rate']),
            'p5_count' => AdminConfig::get('p5_count', Yii::$app->params['p5Count']),

            // AI Agent Settings
            'ai_provider' => AdminConfig::get('ai_provider', 'huggingface'),
            'ai_api_key_claude' => AdminConfig::get('ai_api_key_claude', ''),
            'ai_api_key_gemini' => AdminConfig::get('ai_api_key_gemini', ''),
            'ai_api_key_huggingface' => AdminConfig::get('ai_api_key_huggingface', ''),
            'ai_demo_mode' => AdminConfig::get('ai_demo_mode', '1'),
        ];

        $selectorFile = Yii::getAlias('@app') . '/config/db_selector.php';
        $config['db'] = file_exists($selectorFile) ? trim(file_get_contents($selectorFile)) : 'production';

        if (Yii::$app->request->post()) {
            if (!$isGod) {
                throw new ForbiddenHttpException('Only god users can edit configuration.');
            }

            $post = Yii::$app->request->post();

            // System Settings
            AdminConfig::set('theme', $post['theme'] ?? 'dark');
            AdminConfig::set('hide_history', $post['hide_history'] ?? '0');
            AdminConfig::set('hide_bet_info', $post['hide_bet_info'] ?? '0');
            AdminConfig::set('show_account_name', $post['show_account_name'] ?? '0');
            AdminConfig::set('bankruptcy_text', $post['bankruptcy_text'] ?? 'Bankruptcy');
            AdminConfig::set('tournament_phase', $post['tournament_phase'] ?? 'group_stage');

            // Application Settings
            AdminConfig::set('season_name', $post['season_name'] ?? '');
            AdminConfig::set('group_chat', $post['group_chat'] ?? '');
            AdminConfig::set('admin_chat', $post['admin_chat'] ?? '');
            AdminConfig::set('admin_name', $post['admin_name'] ?? '');
            AdminConfig::set('admin_email', $post['admin_email'] ?? '');
            AdminConfig::set('sender_name', $post['sender_name'] ?? '');

            // Betting Settings
            AdminConfig::set('starting_money', $post['starting_money'] ?? '300');
            AdminConfig::set('min_bet_money', $post['min_bet_money'] ?? '50');
            AdminConfig::set('min_bet_times', $post['min_bet_times'] ?? '4');
            AdminConfig::set('max_refill_times', $post['max_refill_times'] ?? '4');
            AdminConfig::set('account_per_user', $post['account_per_user'] ?? '2');

            // Payment Settings
            AdminConfig::set('min_pay_money', $post['min_pay_money'] ?? '300');
            AdminConfig::set('max_pay_money', $post['max_pay_money'] ?? '300');
            AdminConfig::set('pay_time', $post['pay_time'] ?? '');

            // Prize Pool Settings
            AdminConfig::set('total_amount', $post['total_amount'] ?? '6000000');
            AdminConfig::set('gift_item', $post['gift_item'] ?? '');
            AdminConfig::set('mt_rate', $post['mt_rate'] ?? '10');
            AdminConfig::set('adj_rate', $post['adj_rate'] ?? '5');
            AdminConfig::set('p1_rate', $post['p1_rate'] ?? '25');
            AdminConfig::set('p1_count', $post['p1_count'] ?? '1');
            AdminConfig::set('p2_rate', $post['p2_rate'] ?? '20');
            AdminConfig::set('p2_count', $post['p2_count'] ?? '1');
            AdminConfig::set('p3_rate', $post['p3_rate'] ?? '10');
            AdminConfig::set('p3_count', $post['p3_count'] ?? '2');
            AdminConfig::set('p4_rate', $post['p4_rate'] ?? '5');
            AdminConfig::set('p4_count', $post['p4_count'] ?? '4');
            AdminConfig::set('p5_rate', $post['p5_rate'] ?? '0');
            AdminConfig::set('p5_count', $post['p5_count'] ?? '5');

            // AI Agent Settings
            AdminConfig::set('ai_provider', $post['ai_provider'] ?? 'huggingface');
            AdminConfig::set('ai_api_key_claude', $post['ai_api_key_claude'] ?? '');
            AdminConfig::set('ai_api_key_gemini', $post['ai_api_key_gemini'] ?? '');
            AdminConfig::set('ai_api_key_huggingface', $post['ai_api_key_huggingface'] ?? '');
            AdminConfig::set('ai_demo_mode', $post['ai_demo_mode'] ?? '0');

            // Write DB selector
            if (isset($post['db']) && in_array($post['db'], ['production', 'staging'])) {
                file_put_contents($selectorFile, $post['db']);
            }

            Yii::$app->session->setFlash('success', 'Configuration saved successfully!');
            return $this->refresh();
        }

        return $this->render('index', ['config' => $config, 'isGod' => $isGod]);
    }

    public function actionGetAiConfig()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $apiKey = AdminConfig::get('ai_api_key_huggingface', '');

        return [
            'api_key' => $apiKey,
            'provider' => AdminConfig::get('ai_provider', 'huggingface')
        ];
    }
}
