<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 * @var amnah\yii2\user\models\Role $role
 * @var yii\widgets\ActiveForm $form
 */

$module = $this->context->module;
$role = $module->model("Role");

// Ensure variables are set - if not, the form can't render
if (!isset($user) || !isset($profile) || !$user || !$profile) {
    echo '<div style="padding: 20px; color: #ff6b6b;">Error: Unable to load user data. Please refresh the page.</div>';
    return;
}
?>

<div class="user-form-container">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template' => '{label}{input}{error}',
        ],
    ]); ?>

    <!-- Account Information Card -->
    <div class="form-card">
        <div class="card-header">
            <h2 class="card-title">Account Information</h2>
            <p class="card-description">Email, username, and authentication details</p>
        </div>
        <div class="card-content">
            <div class="form-grid">
                <div class="form-group-wrapper">
                    <?= $form->field($user, 'email')->textInput([
                        'maxlength' => 255,
                        'placeholder' => 'user@example.com',
                        'class' => 'form-input'
                    ])->label('Email Address', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?= $form->field($user, 'username')->textInput([
                        'maxlength' => 255,
                        'placeholder' => 'username',
                        'class' => 'form-input'
                    ])->label('Username', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper full-width">
                    <?= $form->field($user, 'newPassword')->textInput([
                        'type' => 'password',
                        'id' => 'newpassword-input',
                        'placeholder' => 'Leave blank to keep current password',
                        'class' => 'form-input'
                    ])->label('New Password', ['class' => 'form-label']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="form-card">
        <div class="card-header">
            <h2 class="card-title">Profile Information</h2>
            <p class="card-description">User's personal and account details</p>
        </div>
        <div class="card-content">
            <div class="form-grid">
                <div class="form-group-wrapper full-width">
                    <?= $form->field($profile, 'full_name')->textInput([
                        'placeholder' => 'Full Name',
                        'class' => 'form-input'
                    ])->label('Full Name', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?= $form->field($profile, 'money')->textInput([
                        'type' => 'number',
                        'placeholder' => '0',
                        'class' => 'form-input',
                        'id' => 'profile-money'
                    ])->label('Account Balance', ['class' => 'form-label']) ?>

                    <div class="quick-actions">
                        <button type="button" class="quick-btn" data-amount="50">50</button>
                        <button type="button" class="quick-btn" data-amount="100">100</button>
                        <button type="button" class="quick-btn" data-amount="200">200</button>
                        <button type="button" class="quick-btn" data-amount="300">300</button>
                        <button type="button" class="quick-btn" data-amount="400">400</button>
                        <button type="button" class="quick-btn" data-amount="500">500</button>
                        <button type="button" class="quick-btn" data-amount="1000">1K</button>
                        <button type="button" class="quick-btn" data-amount="2000">2K</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role & Status Card -->
    <div class="form-card">
        <div class="card-header">
            <h2 class="card-title">Role & Access</h2>
            <p class="card-description">User role and account status</p>
        </div>
        <div class="card-content">
            <div class="form-grid">
                <div class="form-group-wrapper">
                    <?= $form->field($user, 'role_id')->dropDownList($role::dropdown(), [
                        'prompt' => 'Select a role',
                        'class' => 'form-select',
                        'options' => [
                            $user->role_id => ['selected' => true]
                        ]
                    ])->label('Role', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?= $form->field($user, 'status')->dropDownList($user::statusDropdown(), [
                        'prompt' => 'Select status',
                        'class' => 'form-select',
                        'options' => [
                            $user->status => ['selected' => true]
                        ]
                    ])->label('Status', ['class' => 'form-label']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Card -->
    <div class="form-card">
        <div class="card-header">
            <h2 class="card-title">Security Settings</h2>
            <p class="card-description">Account restrictions and ban settings</p>
        </div>
        <div class="card-content">
            <div class="form-group-wrapper full-width">
                <?= $form->field($user, 'banned_reason')->textInput([
                    'placeholder' => 'Reason for banning (if applicable)',
                    'class' => 'form-input'
                ])->label('Ban Reason', ['class' => 'form-label']) ?>
            </div>

            <div class="form-group-wrapper checkbox-wrapper">
                <?php $user->banned_at = $user->banned_at ? 1 : 0 ?>
                <label class="checkbox-label">
                    <?= Html::activeCheckbox($user, 'banned_at', ['class' => 'form-checkbox']) ?>
                    <span class="checkbox-text">Ban this account</span>
                </label>
                <?= Html::error($user, 'banned_at', ['class' => 'form-error']) ?>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <?= Html::submitButton(
            $user->isNewRecord ? 'Create User' : 'Save Changes',
            ['class' => 'btn btn-primary btn-submit']
        ) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
document.querySelectorAll('.quick-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const amount = this.getAttribute('data-amount');
        const moneyField = document.getElementById('profile-money');
        if (moneyField) {
            moneyField.value = amount;
            moneyField.focus();
        }
    });
});

// Password toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    var passwordField = document.getElementById('newpassword-input');
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

<style>
.user-form-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Card Styling */
.form-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.form-card:hover {
    border-color: rgba(0, 212, 255, 0.2);
    background: rgba(255, 255, 255, 0.03);
}

[data-theme="light"] .form-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .form-card:hover {
    background: rgba(0, 0, 0, 0.04);
    border-color: rgba(0, 0, 0, 0.15);
}

/* Card Header */
.card-header {
    padding: 24px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.08);
}

[data-theme="light"] .card-header {
    border-bottom-color: rgba(0, 0, 0, 0.08);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 6px 0;
    color: #e8eaf0;
}

[data-theme="light"] .card-title {
    color: #1a1a1a;
}

.card-description {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.6);
    margin: 0;
}

[data-theme="light"] .card-description {
    color: rgba(0, 0, 0, 0.6);
}

/* Card Content */
.card-content {
    padding: 24px;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.form-group-wrapper {
    display: flex;
    flex-direction: column;
}

.form-group-wrapper.full-width {
    grid-column: 1 / -1;
}

/* Form Inputs */
.form-label {
    font-size: 0.95rem;
    font-weight: 500;
    color: #e8eaf0;
    margin-bottom: 8px;
    display: block;
}

[data-theme="light"] .form-label {
    color: #2a2a2a;
}

.form-input,
.form-select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 8px;
    background: rgba(0, 0, 0, 0.2);
    color: #e8eaf0;
    font-size: 1rem;
    transition: all 0.2s ease;
    font-family: inherit;
}

[data-theme="light"] .form-input,
[data-theme="light"] .form-select {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: #00d4ff;
    background: rgba(0, 0, 0, 0.25);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .form-input:focus,
[data-theme="light"] .form-select:focus {
    background: rgba(0, 0, 0, 0.05);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.05);
}

.form-input::placeholder {
    color: rgba(232, 234, 240, 0.5);
}

[data-theme="light"] .form-input::placeholder {
    color: rgba(0, 0, 0, 0.4);
}

/* Error Styling */
.form-error,
.help-block {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 6px;
    display: block;
}

/* Checkbox Styling */
.checkbox-wrapper {
    margin-top: 8px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
}

.form-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #00d4ff;
}

.checkbox-text {
    color: #e8eaf0;
    font-weight: 500;
}

[data-theme="light"] .checkbox-text {
    color: #1a1a1a;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 212, 255, 0.08);
}

[data-theme="light"] .form-actions {
    border-top-color: rgba(0, 0, 0, 0.08);
}

.btn-submit {
    min-width: 140px;
    padding: 12px 24px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-secondary {
    color: #00d4ff;
    background: transparent;
    border: 1px solid #00d4ff;
    padding: 11px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-secondary:hover {
    background: rgba(0, 212, 255, 0.1);
    text-decoration: none;
}

[data-theme="light"] .btn-secondary {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-secondary:hover {
    background: rgba(0, 132, 255, 0.1);
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-top: 12px;
}

.quick-btn {
    padding: 8px 12px;
    background: rgba(0, 212, 255, 0.1);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 6px;
    color: #00d4ff;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-btn:hover {
    background: rgba(0, 212, 255, 0.2);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 8px rgba(0, 212, 255, 0.2);
}

.quick-btn:active {
    background: rgba(0, 212, 255, 0.3);
    transform: scale(0.98);
}

[data-theme="light"] .quick-btn {
    background: rgba(0, 84, 255, 0.08);
    border-color: rgba(0, 84, 255, 0.2);
    color: #0084ff;
}

[data-theme="light"] .quick-btn:hover {
    background: rgba(0, 84, 255, 0.15);
    border-color: rgba(0, 84, 255, 0.4);
    box-shadow: 0 0 8px rgba(0, 84, 255, 0.15);
}

[data-theme="light"] .quick-btn:active {
    background: rgba(0, 84, 255, 0.25);
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .card-header,
    .card-content {
        padding: 18px;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-submit,
    .btn-secondary {
        width: 100%;
        text-align: center;
    }
}

/* Password Toggle */
.password-toggle-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.form-input.password-toggle-wrapper input {
    flex: 1;
    padding-right: 40px;
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
    top: 50%;
    transform: translateY(-50%);
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

.password-toggle-btn i {
    display: inline-block;
}
</style>
