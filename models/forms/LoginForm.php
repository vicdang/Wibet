<?php

namespace app\models\forms;

use Yii;
use amnah\yii2\user\models\forms\LoginForm as BaseLoginForm;

/**
 * Overrides the base LoginForm to give a clear message when an account
 * has been deactivated by an administrator (status = STATUS_INACTIVE),
 * instead of attempting to resend a confirmation email.
 */
class LoginForm extends BaseLoginForm
{
    public function validateUser()
    {
        $user = $this->getUser();

        // check for valid user or if user registered using social auth
        if (!$user || !$user->password) {
            if ($this->module->loginEmail && $this->module->loginUsername) {
                $attribute = "Email / Username";
            } else {
                $attribute = $this->module->loginEmail ? "Email" : "Username";
            }
            $this->addError("email", Yii::t("user", "$attribute not found"));
            return;
        }

        // check if user is banned
        if ($user->banned_at) {
            $this->addError("email", Yii::t("user", "User is banned - {banReason}", [
                "banReason" => $user->banned_reason,
            ]));
            return;
        }

        // account deactivated by an administrator
        if ($user->status == $user::STATUS_INACTIVE) {
            $this->addError("email", Yii::t("user", "Your account has been deactivated. Please contact the administrator."));
            return;
        }
    }
}
