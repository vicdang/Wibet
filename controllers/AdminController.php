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
     * Role IDs that are considered admin-level accounts (Admin and God)
     */
    const ADMIN_ROLE_IDS = [1, 5];

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
     * Check if target user is an admin-level account (Admin or God)
     */
    private function isAdminUser($userId)
    {
        $user = User::findOne($userId);
        return $user && in_array($user->role_id, self::ADMIN_ROLE_IDS);
    }

    /**
     * Override actionView to prevent non-god users from viewing admin accounts
     */
    public function actionView($id)
    {
        if ($this->isAdminUser($id) && !$this->isGod()) {
            throw new ForbiddenHttpException('Only god users can manage admin accounts.');
        }
        return parent::actionView($id);
    }

    /**
     * Override actionCreate to prevent non-god users from creating admin accounts
     */
    public function actionCreate()
    {
        if (!$this->isGod()) {
            $post = Yii::$app->request->post();
            if (isset($post['User']['role_id']) && in_array($post['User']['role_id'], self::ADMIN_ROLE_IDS)) {
                throw new ForbiddenHttpException('Only god users can create admin accounts.');
            }
        }
        return parent::actionCreate();
    }

    /**
     * Override actionUpdate to prevent non-god users from editing admin accounts
     */
    public function actionUpdate($id)
    {
        // Only god users can edit admin accounts
        if ($this->isAdminUser($id) && !$this->isGod()) {
            throw new ForbiddenHttpException('Only god users can manage admin accounts.');
        }

        // Only god users can promote accounts to admin/god roles
        if (!$this->isGod()) {
            $post = Yii::$app->request->post();
            if (isset($post['User']['role_id']) && in_array($post['User']['role_id'], self::ADMIN_ROLE_IDS)) {
                throw new ForbiddenHttpException('Only god users can assign admin roles.');
            }
        }

        return parent::actionUpdate($id);
    }

    /**
     * Override actionDelete to prevent non-god users from deleting admin accounts
     */
    public function actionDelete($id)
    {
        // Only god users can delete admin accounts
        if ($this->isAdminUser($id) && !$this->isGod()) {
            throw new ForbiddenHttpException('Only god users can manage admin accounts.');
        }
        return parent::actionDelete($id);
    }
}
