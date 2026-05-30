<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\UserToken $userToken
 */

$module = $this->context->module;

$this->title = Yii::t('user', 'Account');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.account-wrapper {
    max-width: 700px;
    margin: 0 auto;
    padding: 20px 0;
}

.account-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
}

.account-card h2 {
    font-size: 20px;
    font-weight: 700;
    color: #00d4ff;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #e8eaf0;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
}

.form-control {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(0, 212, 255, 0.2) !important;
    color: #e8eaf0 !important;
    padding: 12px 15px !important;
    border-radius: 6px !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.08) !important;
    border-color: rgba(0, 212, 255, 0.5) !important;
    color: #e8eaf0 !important;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2) !important;
    outline: none !important;
}

.form-control:disabled {
    background: rgba(0, 0, 0, 0.2) !important;
    color: #8e92a0 !important;
    cursor: not-allowed !important;
}

.hint-text {
    font-size: 12px;
    color: #8e92a0;
    margin-top: 6px;
    display: block;
}

.alert-success {
    background: rgba(76, 175, 80, 0.1) !important;
    border: 1px solid rgba(76, 175, 80, 0.3) !important;
    border-radius: 8px !important;
    color: #a8d5a8 !important;
    padding: 15px 20px !important;
    margin-bottom: 20px !important;
}

.alert-success p {
    margin: 0 !important;
}

.submit-btn {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%) !important;
    border: 2px solid rgba(0, 212, 255, 0.5) !important;
    color: #00d4ff !important;
    padding: 12px 40px !important;
    font-weight: 600 !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    font-size: 15px !important;
}

.submit-btn:hover {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.5) 0%, rgba(123, 47, 255, 0.5) 100%) !important;
    border-color: rgba(0, 212, 255, 0.8) !important;
    box-shadow: 0 0 20px rgba(0, 212, 255, 0.3) !important;
}

.social-accounts {
    background: rgba(0, 212, 255, 0.05);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 8px;
    padding: 20px;
    margin-top: 30px;
}

.social-accounts h3 {
    font-size: 14px;
    color: #00d4ff;
    margin-bottom: 15px;
    font-weight: 600;
}

.social-item {
    padding: 10px 0;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    color: #d4d8e0;
    font-size: 14px;
}

.social-item:last-child {
    border-bottom: none;
}

h1 {
    color: #e8eaf0 !important;
    margin-bottom: 30px !important;
    font-size: 32px !important;
}

/* Light Theme Overrides */
[data-theme="light"] .account-card {
    background: #ffffff !important;
    border: 1px solid #dadce0 !important;
}

[data-theme="light"] .account-card h2 {
    color: #1f73e6 !important;
    border-bottom-color: #dadce0 !important;
}

[data-theme="light"] .form-group label {
    color: #202124 !important;
}

[data-theme="light"] .form-control {
    background: #f8f9fa !important;
    border-color: #dadce0 !important;
    color: #202124 !important;
}

[data-theme="light"] .form-control:focus {
    background: #ffffff !important;
    border-color: #1f73e6 !important;
    box-shadow: 0 0 8px rgba(31, 115, 230, 0.15) !important;
}

[data-theme="light"] .form-control:disabled {
    background: #f0f0f0 !important;
    color: #5f6368 !important;
}

[data-theme="light"] .hint-text {
    color: #5f6368 !important;
}

[data-theme="light"] .alert-success {
    background: rgba(52, 168, 83, 0.1) !important;
    border-left: 4px solid #34a853 !important;
    color: #0d652d !important;
}

[data-theme="light"] .submit-btn {
    background: linear-gradient(135deg, rgba(66, 133, 244, 0.15) 0%, rgba(156, 39, 176, 0.15) 100%) !important;
    border-color: #1f73e6 !important;
    color: #1f73e6 !important;
}

[data-theme="light"] .submit-btn:hover {
    background: linear-gradient(135deg, rgba(66, 133, 244, 0.25) 0%, rgba(156, 39, 176, 0.25) 100%) !important;
    border-color: #1f73e6 !important;
    box-shadow: 0 0 15px rgba(31, 115, 230, 0.2) !important;
}

[data-theme="light"] .social-accounts {
    background: rgba(31, 115, 230, 0.05) !important;
    border-color: #dadce0 !important;
}

[data-theme="light"] .social-accounts h3 {
    color: #1f73e6 !important;
}

[data-theme="light"] .social-item {
    color: #202124 !important;
    border-bottom-color: #f0f0f0 !important;
}

[data-theme="light"] h1 {
    color: #202124 !important;
}
</style>

<div class="account-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($flash = Yii::$app->session->getFlash("Account-success")): ?>
        <div class="alert-success">
            <p><?= $flash ?></p>
        </div>
    <?php elseif ($flash = Yii::$app->session->getFlash("Resend-success")): ?>
        <div class="alert-success">
            <p><?= $flash ?></p>
        </div>
    <?php elseif ($flash = Yii::$app->session->getFlash("Cancel-success")): ?>
        <div class="alert-success">
            <p><?= $flash ?></p>
        </div>
    <?php endif; ?>

    <div class="account-card">
        <h2>Security Settings</h2>

        <?php $form = ActiveForm::begin([
            'id' => 'account-form',
            'options' => ['class' => ''],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => ''],
            ],
            'enableAjaxValidation' => true,
        ]); ?>

        <?php if ($user->password): ?>
            <?= $form->field($user, 'currentPassword')->passwordInput(['placeholder' => 'Current Password']) ?>
        <?php endif ?>

        <?= $form->field($user, 'newPassword')->passwordInput(['placeholder' => 'New Password (leave blank to keep current)']) ?>
        <span class="hint-text">Leave blank if you don't want to change your password</span>

        <?php if ($module->useEmail): ?>
            <hr style="margin: 30px 0; border-color: rgba(0, 212, 255, 0.2);">
            <h2 style="margin-top: 0;">Email Settings</h2>

            <?= $form->field($user, 'email')->textInput(['disabled' => true]) ?>
            <span class="hint-text">Your email address cannot be changed</span>

            <?php if (!empty($userToken->data)): ?>
                <div style="background: rgba(255, 193, 7, 0.1); border-left: 4px solid #fbbc04; padding: 15px; border-radius: 6px; margin-top: 20px; color: #fdd06a;">
                    <p style="margin: 0 0 10px 0; font-weight: 600;">Pending Email Confirmation</p>
                    <p style="margin: 0 0 10px 0; font-size: 14px;">New email: <strong><?= Html::encode($userToken->data) ?></strong></p>
                    <p style="margin: 0; font-size: 13px;">
                        <?= Html::a('Resend Confirmation', ["/user/resend-change"], ['style' => 'color: #fbbc04; text-decoration: underline;']) ?>
                        /
                        <?= Html::a('Cancel', ["/user/cancel"], ['style' => 'color: #fbbc04; text-decoration: underline;']) ?>
                    </p>
                </div>
            <?php elseif ($module->emailConfirmation): ?>
                <span class="hint-text">Changing your email requires confirmation</span>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($module->useUsername): ?>
            <hr style="margin: 30px 0; border-color: rgba(0, 212, 255, 0.2);">
            <h2 style="margin-top: 0;">Username</h2>
            <?= $form->field($user, 'username')->textInput(['disabled' => true]) ?>
            <span class="hint-text">Your username cannot be changed</span>
        <?php endif; ?>

        <div style="margin-top: 30px; text-align: center;">
            <?= Html::submitButton(Yii::t('user', 'Update Account'), ['class' => 'submit-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?php if (!empty($user->userAuths)): ?>
        <div class="social-accounts">
            <h3>Connected Accounts</h3>
            <?php foreach ($user->userAuths as $userAuth): ?>
                <div class="social-item">
                    <strong><?= ucfirst($userAuth->provider) ?></strong> — <?= Html::encode($userAuth->provider_id) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
