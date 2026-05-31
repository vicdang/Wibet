<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */

$this->title = Yii::t('user', 'Login');
?>
<div class="user-default-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],

    ]); ?>

    <?= $form->field($model, 'email') ?>

    <?php
    echo $form->field($model, 'password')->textInput([
        'type' => 'password',
        'id' => 'password-input',
        'class' => 'form-control password-input',
    ]);
    ?>
    <script>
    // After field is rendered, wrap it with toggle button
    document.addEventListener('DOMContentLoaded', function() {
        var passwordField = document.getElementById('password-input');
        if (passwordField) {
            var wrapper = document.createElement('div');
            wrapper.className = 'password-toggle-wrapper';
            passwordField.parentNode.insertBefore(wrapper, passwordField);
            wrapper.appendChild(passwordField);

            var toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'password-toggle-btn';
            toggleBtn.innerHTML = '<i class="glyphicon glyphicon-eye-open"></i>';
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var isPassword = passwordField.type === 'password';
                passwordField.type = isPassword ? 'text' : 'password';
                toggleBtn.innerHTML = isPassword
                    ? '<i class="glyphicon glyphicon-eye-close"></i>'
                    : '<i class="glyphicon glyphicon-eye-open"></i>';
            });
            wrapper.appendChild(toggleBtn);
        }
    });
    </script>

    <?= $form->field($model, 'rememberMe', [
        'template' => "{label}<div class=\"col-lg-offset-2 col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary']) ?>
            <br/><br/>
            <!-- <?= Html::a(Yii::t("user", "Register"), ["/user/register"]) ?>
            <?= Html::a(Yii::t("user", "Forgot password") . "?", ["/user/forgot"]) ?> 
            <?= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/resend"]) ?> -->
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if (Yii::$app->get("authClientCollection", false)): ?>
        <div class="col-lg-offset-2 col-lg-10">
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/auth/login']
            ]) ?>
        </div>
    <?php endif; ?>

   <div class="col-lg-offset-2" style="color:#999;">
        Please contact the <strong>Administrator</strong> for support<br>
        To modify the username/password, log in first and then <?= HTML::a("update your account", ["/user/account"]) ?>.
    </div>

    <style>
        .login-container {
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }

        .password-toggle-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-input {
            flex: 1;
            padding-right: 38px;
        }

        .password-toggle-btn {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 8px;
            color: #666;
            font-size: 16px;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle-btn:hover {
            color: #333;
        }

        .password-toggle-btn i {
            display: inline-block;
        }
    </style>
<!-- <div class="row">
    <div class="col-lg-4 offset-lg-4">
    <div class="login-container">
    <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
    <form>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <div class="text-center mt-3">
            <a href="#">Forgot password?</a>
        </div>
    </form>
</div>
    </div>
    </div> -->

</div>
