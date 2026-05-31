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

<div class="login-page">
    <div class="login-container">
        <!-- Hero Section -->
        <div class="login-hero">
            <div class="hero-logo">
                <span id="brand-logo-login"></span>
            </div>
            <h1 class="hero-title">Wibet</h1>
            <p class="hero-subtitle">FIFA World Cup 2026 Betting</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <div class="card-header">
                <h2><?= Html::encode($this->title) ?></h2>
                <p>Enter your credentials to access your account</p>
            </div>

            <div class="card-content">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'login-form'],
                    'fieldConfig' => [
                        'template' => '<div class="form-group-wrapper">{label}{input}{error}</div>',
                    ],
                ]); ?>

                <!-- Email Field -->
                <?= $form->field($model, 'email')->textInput([
                    'placeholder' => 'Email address or username',
                    'class' => 'form-input',
                    'type' => 'email',
                    'autofocus' => true,
                ])->label('Email / Username', ['class' => 'form-label']) ?>

                <!-- Password Field -->
                <?php
                echo $form->field($model, 'password')->textInput([
                    'type' => 'password',
                    'id' => 'password-input',
                    'class' => 'form-input',
                    'placeholder' => 'Enter your password',
                ])->label('Password', ['class' => 'form-label']);
                ?>

                <!-- Password Toggle Script -->
                <script>
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

                <!-- Remember Me -->
                <div class="remember-me-wrapper">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'class' => 'form-checkbox',
                    ])->label('Remember me on this device', ['class' => 'checkbox-label']) ?>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <span>Sign In</span>
                </button>

                <?php ActiveForm::end(); ?>
            </div>

            <!-- Support Info -->
            <div class="card-footer">
                <p class="support-text">
                    Need help? Contact the <strong>Administrator</strong> for support
                </p>
                <p class="account-text">
                    To update your password, log in first and visit
                    <?= Html::a('Account Settings', ['/user/account'], ['class' => 'support-link']) ?>
                </p>
            </div>
        </div>
    </div>

    <style>
        .login-page {
            background: linear-gradient(135deg, #0a0e1a 0%, #0f1422 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        [data-theme="light"] .login-page {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero Section */
        .login-hero {
            text-align: center;
            margin-bottom: 30px;
        }

        .hero-logo {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 8px 0;
            color: #e8eaf0;
            letter-spacing: -1px;
        }

        [data-theme="light"] .hero-title {
            color: #1a1a1a;
        }

        .hero-subtitle {
            font-size: 0.95rem;
            color: rgba(232, 234, 240, 0.6);
            margin: 0;
            letter-spacing: 0.3px;
        }

        [data-theme="light"] .hero-subtitle {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 212, 255, 0.15);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            border-color: rgba(0, 212, 255, 0.25);
            background: rgba(255, 255, 255, 0.06);
        }

        [data-theme="light"] .login-card {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        [data-theme="light"] .login-card:hover {
            border-color: rgba(0, 0, 0, 0.15);
        }

        /* Card Header */
        .card-header {
            padding: 32px 28px 24px;
            border-bottom: 1px solid rgba(0, 212, 255, 0.08);
        }

        [data-theme="light"] .card-header {
            border-bottom-color: rgba(0, 0, 0, 0.08);
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 6px 0;
            color: #e8eaf0;
        }

        [data-theme="light"] .card-header h2 {
            color: #1a1a1a;
        }

        .card-header p {
            font-size: 0.9rem;
            color: rgba(232, 234, 240, 0.6);
            margin: 0;
        }

        [data-theme="light"] .card-header p {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Card Content */
        .card-content {
            padding: 28px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Form Fields */
        .form-group-wrapper {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #e8eaf0;
            display: block;
        }

        [data-theme="light"] .form-label {
            color: #2a2a2a;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.2);
            color: #e8eaf0;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-input::placeholder {
            color: rgba(232, 234, 240, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: #00d4ff;
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        }

        [data-theme="light"] .form-input {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.15);
            color: #1a1a1a;
        }

        [data-theme="light"] .form-input::placeholder {
            color: rgba(0, 0, 0, 0.4);
        }

        [data-theme="light"] .form-input:focus {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 132, 255, 0.3);
            box-shadow: 0 0 0 3px rgba(0, 132, 255, 0.08);
        }

        /* Password Toggle */
        .password-toggle-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle-wrapper .form-input {
            padding-right: 40px;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 8px;
            color: rgba(232, 234, 240, 0.6);
            font-size: 16px;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle-btn:hover {
            color: #e8eaf0;
        }

        [data-theme="light"] .password-toggle-btn {
            color: rgba(0, 0, 0, 0.5);
        }

        [data-theme="light"] .password-toggle-btn:hover {
            color: rgba(0, 0, 0, 0.8);
        }

        /* Remember Me */
        .remember-me-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
            font-size: 0.9rem;
            color: #e8eaf0;
            margin: 0;
        }

        [data-theme="light"] .checkbox-label {
            color: #2a2a2a;
        }

        .form-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #00d4ff;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            color: #00d4ff;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        [data-theme="light"] .btn-login {
            background: linear-gradient(135deg, rgba(0, 132, 255, 0.15) 0%, rgba(100, 150, 230, 0.15) 100%);
            border-color: #0084ff;
            color: #0084ff;
        }

        [data-theme="light"] .btn-login:hover {
            background: linear-gradient(135deg, rgba(0, 132, 255, 0.25) 0%, rgba(100, 150, 230, 0.25) 100%);
            box-shadow: 0 0 20px rgba(0, 132, 255, 0.2);
        }

        /* Card Footer */
        .card-footer {
            padding: 20px 28px;
            border-top: 1px solid rgba(0, 212, 255, 0.08);
            text-align: center;
        }

        [data-theme="light"] .card-footer {
            border-top-color: rgba(0, 0, 0, 0.08);
        }

        .support-text,
        .account-text {
            font-size: 0.85rem;
            color: rgba(232, 234, 240, 0.6);
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        [data-theme="light"] .support-text,
        [data-theme="light"] .account-text {
            color: rgba(0, 0, 0, 0.6);
        }

        .support-text strong {
            color: #e8eaf0;
        }

        [data-theme="light"] .support-text strong {
            color: #1a1a1a;
        }

        .account-text {
            margin-bottom: 0;
        }

        .support-link {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .support-link:hover {
            color: #00eeff;
            text-decoration: underline;
        }

        [data-theme="light"] .support-link {
            color: #0084ff;
        }

        [data-theme="light"] .support-link:hover {
            color: #0066ff;
        }

        /* Error Messages */
        .help-block {
            color: #ff6b6b;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .card-header {
                padding: 24px 20px 16px;
            }

            .card-content {
                padding: 20px;
            }

            .card-footer {
                padding: 16px 20px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .btn-login {
                padding: 12px 20px;
                font-size: 0.95rem;
            }
        }
    </style>
</div>
