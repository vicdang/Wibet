<?php

namespace app\components;

use amnah\yii2\user\models\User;
use yii\base\BootstrapInterface;
use yii\db\ActiveRecord;
use yii\base\Application;
use yii\base\Event;

/**
 * Assigns the next sequential user_no to new users.
 *
 * The User model comes from a vendor package and cannot be overridden
 * with a beforeSave() method, so the assignment is hooked in via an event.
 */
class UserNoBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Event::on(User::class, ActiveRecord::EVENT_BEFORE_INSERT, function (Event $event) {
            /** @var User $user */
            $user = $event->sender;
            if (empty($user->user_no)) {
                $user->user_no = (int) (User::find()->max('user_no')) + 1;
            }
        });
    }
}
