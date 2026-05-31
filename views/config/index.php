<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Configuration';
?>

<style>
.config-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.config-section {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
}

.config-section h3 {
    font-size: 18px;
    font-weight: 700;
    color: #00d4ff;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

.config-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

.config-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.config-label {
    display: flex;
    flex-direction: column;
    gap: 4px;
    flex: 1;
}

.config-label-text {
    font-weight: 600;
    color: #e8eaf0;
    font-size: 15px;
}

.config-label-hint {
    font-size: 12px;
    color: #8e92a0;
}

.toggle-group {
    display: flex;
    gap: 10px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 6px;
    padding: 4px;
    width: fit-content;
}

.toggle-btn {
    padding: 8px 16px;
    border: none;
    background: transparent;
    color: #8e92a0;
    cursor: pointer;
    border-radius: 4px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}

.toggle-btn.active {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%);
    color: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
}

.toggle-btn:hover {
    color: #d4d8e0;
}

.checkbox-toggle {
    position: relative;
    display: inline-flex;
    align-items: center;
    width: 50px;
    height: 28px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 14px;
    cursor: pointer;
    padding: 2px;
    transition: all 0.3s ease;
}

.checkbox-toggle input {
    display: none;
}

.checkbox-toggle .toggle-slider {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.checkbox-toggle input:checked + .toggle-slider {
    left: 24px;
    background: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.4);
}

.form-group {
    margin-bottom: 0;
}

.form-group input[type="text"],
.form-group input[type="email"] {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 212, 255, 0.2);
    color: #e8eaf0;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
    max-width: 300px;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
    outline: none;
}

.btn-save {
    padding: 12px 28px;
    background: transparent;
    color: #00d4ff;
    border: 2px solid #00d4ff;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-block;
}

.btn-save:hover {
    background: rgba(0, 212, 255, 0.1);
    box-shadow: 0 0 15px rgba(0, 212, 255, 0.3);
    text-decoration: none;
}

[data-theme="light"] .btn-save {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-save:hover {
    background: rgba(0, 132, 255, 0.1);
    box-shadow: 0 0 15px rgba(0, 132, 255, 0.2);
}

.alert-flash {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    border-left: 4px solid;
    background: rgba(76, 175, 80, 0.1);
    border-left-color: #4caf50;
    color: #a8d5a8;
}

h1 {
    color: #ffffff;
    margin-bottom: 30px;
    font-size: 28px;
}
</style>

<div class="config-wrapper">
    <h1>Configuration</h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert-flash">
            <strong>✓</strong> <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => ''],
    ]); ?>

        <!-- System Settings -->
        <div class="config-section">
            <h3>System</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Theme</span>
                    <span class="config-label-hint">Choose your preferred color scheme</span>
                </div>
                <div class="toggle-group">
                    <button type="button" class="toggle-btn <?= $config['theme'] === 'dark' ? 'active' : '' ?>" onclick="setTheme('dark')">Dark</button>
                    <button type="button" class="toggle-btn <?= $config['theme'] === 'light' ? 'active' : '' ?>" onclick="setTheme('light')">Light</button>
                </div>
                <input type="hidden" name="theme" id="theme" value="<?= $config['theme'] ?>">
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Database</span>
                    <span class="config-label-hint">Switch between production and staging</span>
                </div>
                <div class="toggle-group">
                    <button type="button" class="toggle-btn <?= $config['db'] === 'production' ? 'active' : '' ?>" onclick="setDb('production')">Production</button>
                    <button type="button" class="toggle-btn <?= $config['db'] === 'staging' ? 'active' : '' ?>" onclick="setDb('staging')">Staging</button>
                </div>
                <input type="hidden" name="db" id="db" value="<?= $config['db'] ?>">
            </div>
        </div>

        <!-- Visibility Settings -->
        <div class="config-section">
            <h3>Privacy</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Hide Betting History</span>
                    <span class="config-label-hint">Hide history from non-admin users</span>
                </div>
                <label class="checkbox-toggle">
                    <input type="checkbox" name="hide_history" value="1" <?= $config['hide_history'] == '1' ? 'checked' : '' ?>>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Hide Bet Details</span>
                    <span class="config-label-hint">Hide detailed betting information</span>
                </div>
                <label class="checkbox-toggle">
                    <input type="checkbox" name="hide_bet_info" value="1" <?= $config['hide_bet_info'] == '1' ? 'checked' : '' ?>>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <!-- App Settings -->
        <div class="config-section">
            <h3>Application</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Season Name</span>
                    <span class="config-label-hint">e.g., WC 2026</span>
                </div>
                <div class="form-group">
                    <input type="text" name="season_name" value="<?= Html::encode($config['season_name']) ?>" placeholder="Season name">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Group Chat</span>
                    <span class="config-label-hint">Main discussion link</span>
                </div>
                <div class="form-group">
                    <input type="text" name="group_chat" value="<?= Html::encode($config['group_chat']) ?>" placeholder="https://...">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Admin Chat</span>
                    <span class="config-label-hint">Contact for admin</span>
                </div>
                <div class="form-group">
                    <input type="text" name="admin_chat" value="<?= Html::encode($config['admin_chat']) ?>" placeholder="skype:...">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Admin Name</span>
                    <span class="config-label-hint">Display name</span>
                </div>
                <div class="form-group">
                    <input type="text" name="admin_name" value="<?= Html::encode($config['admin_name']) ?>" placeholder="Name">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Admin Email</span>
                    <span class="config-label-hint">Contact email</span>
                </div>
                <div class="form-group">
                    <input type="email" name="admin_email" value="<?= Html::encode($config['admin_email']) ?>" placeholder="email@example.com">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div style="text-align: center; padding-top: 20px;">
            <button type="submit" class="btn-save">Save Configuration</button>
        </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
function setTheme(theme) {
    document.getElementById('theme').value = theme;
    document.querySelectorAll('.toggle-group').forEach((group, idx) => {
        if (idx === 0) {
            group.querySelectorAll('.toggle-btn').forEach((btn, i) => {
                btn.classList.remove('active');
                if ((i === 0 && theme === 'dark') || (i === 1 && theme === 'light')) {
                    btn.classList.add('active');
                }
            });
        }
    });
}

function setDb(db) {
    document.getElementById('db').value = db;
    const groups = document.querySelectorAll('.toggle-group');
    if (groups.length > 1) {
        groups[1].querySelectorAll('.toggle-btn').forEach((btn, i) => {
            btn.classList.remove('active');
            if ((i === 0 && db === 'production') || (i === 1 && db === 'staging')) {
                btn.classList.add('active');
            }
        });
    }
}
</script>
