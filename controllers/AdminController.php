<?php

namespace app\controllers;

use amnah\yii2\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function init()
    {
        // Skip the parent permission check to allow unauthenticated access in development
        // Call grandparent init() to bypass the permission check
        \yii\base\Controller::init();
    }
}
