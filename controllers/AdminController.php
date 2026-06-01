<?php

namespace app\controllers;

use Yii;
use amnah\yii2\user\models\User;
use amnah\yii2\user\controllers\AdminController as BaseAdminController;
use yii\web\ForbiddenHttpException;

class AdminController extends BaseAdminController
{
    public function init()
    {
        // Call parent init() to perform proper permission checks
        parent::init();
    }

    /**
     * Check if current user is god
     */
    private function isGod()
    {
        $user = Yii::$app->user;
        if ($user->isGuest) return false;
        return $user->identity->role_id == 5; // God role ID
    }

    /**
     * Check if target user is god
     */
    private function isGodUser($userId)
    {
        $user = User::findOne($userId);
        return $user && $user->role_id == 5;
    }

    /**
     * Override actionUpdate to prevent non-god users from editing god accounts
     */
    public function actionUpdate($id)
    {
        // Only god users can edit god accounts
        if ($this->isGodUser($id) && !$this->isGod()) {
            throw new ForbiddenHttpException('Only god users can edit god accounts.');
        }
        return parent::actionUpdate($id);
    }

    /**
     * Override actionDelete to prevent non-god users from deleting god accounts
     */
    public function actionDelete($id)
    {
        // Only god users can delete god accounts
        if ($this->isGodUser($id) && !$this->isGod()) {
            throw new ForbiddenHttpException('Only god users can delete god accounts.');
        }
        return parent::actionDelete($id);
    }
}
