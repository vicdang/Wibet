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
        if (!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $config = [
            'theme' => AdminConfig::get('theme', 'dark'),
            'hide_history' => AdminConfig::get('hide_history', '0'),
            'hide_bet_info' => AdminConfig::get('hide_bet_info', '0'),
            'season_name' => AdminConfig::get('season_name', Yii::$app->params['seasonName']),
            'group_chat' => AdminConfig::get('group_chat', Yii::$app->params['groupChat']),
            'admin_chat' => AdminConfig::get('admin_chat', Yii::$app->params['adminChat']),
            'admin_name' => AdminConfig::get('admin_name', Yii::$app->params['adminName']),
            'admin_email' => AdminConfig::get('admin_email', Yii::$app->params['adminEmail']),
        ];

        $selectorFile = Yii::getAlias('@app') . '/config/db_selector.php';
        $config['db'] = file_exists($selectorFile) ? trim(file_get_contents($selectorFile)) : 'production';

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();

            AdminConfig::set('theme', $post['theme'] ?? 'dark');
            AdminConfig::set('hide_history', $post['hide_history'] ?? '0');
            AdminConfig::set('hide_bet_info', $post['hide_bet_info'] ?? '0');
            AdminConfig::set('season_name', $post['season_name'] ?? '');
            AdminConfig::set('group_chat', $post['group_chat'] ?? '');
            AdminConfig::set('admin_chat', $post['admin_chat'] ?? '');
            AdminConfig::set('admin_name', $post['admin_name'] ?? '');
            AdminConfig::set('admin_email', $post['admin_email'] ?? '');

            // Write DB selector
            if (isset($post['db']) && in_array($post['db'], ['production', 'staging'])) {
                file_put_contents($selectorFile, $post['db']);
            }

            Yii::$app->session->setFlash('success', 'Configuration saved successfully!');
            return $this->refresh();
        }

        return $this->render('index', ['config' => $config]);
    }
}
