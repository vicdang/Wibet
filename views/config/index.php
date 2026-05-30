<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '⚙ Configuration';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.config-section {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
}

.config-section-title {
    font-size: 20px;
    font-weight: 700;
    color: #00d4ff;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
    display: flex;
    align-items: center;
    gap: 10px;
}

.config-section-title i {
    font-size: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #e8eaf0;
    margin-bottom: 8px;
}

.form-group .form-control,
.form-group select,
.form-group input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 212, 255, 0.2);
    color: #e8eaf0;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 14px;
}

.form-group .form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
}

.radio-group,
.checkbox-group {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}

.radio-item,
.checkbox-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.radio-item input[type="radio"],
.checkbox-item input[type="checkbox"] {
    margin: 0;
}

.radio-item label,
.checkbox-item label {
    margin: 0;
    font-weight: 500;
    cursor: pointer;
}

.btn-save {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%);
    border: 2px solid rgba(0, 212, 255, 0.5);
    color: #00d4ff;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
}

.btn-save:hover {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.5) 0%, rgba(123, 47, 255, 0.5) 100%);
    border-color: rgba(0, 212, 255, 0.8);
    box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
}

.help-text {
    font-size: 12px;
    color: #8e92a0;
    margin-top: 6px;
}

.alert-flash {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    border-left: 4px solid;
}

.alert-success-flash {
    background: rgba(76, 175, 80, 0.1);
    border-left-color: #4caf50;
    color: #a8d5a8;
}
</style>

<div class="config-index">
    <h1 style="color: #ffffff; margin-bottom: 30px; font-size: 32px;">⚙️ Application Configuration</h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success-flash">
            <strong>✓ Success!</strong> <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => ''],
    ]); ?>

        <!-- System Settings -->
        <div class="config-section">
            <div class="config-section-title">
                <i class="glyphicon glyphicon-cog"></i>
                System Settings
            </div>

            <div class="form-group">
                <label>🎨 Theme</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" name="theme" id="theme-dark" value="dark" <?= $config['theme'] === 'dark' ? 'checked' : '' ?>>
                        <label for="theme-dark">🌙 Dark (Default)</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="theme" id="theme-light" value="light" <?= $config['theme'] === 'light' ? 'checked' : '' ?>>
                        <label for="theme-light">☀️ Light</label>
                    </div>
                </div>
                <p class="help-text">Choose your preferred color scheme across the entire application</p>
            </div>

            <div class="form-group">
                <label>🗄️ Database</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" name="db" id="db-production" value="production" <?= $config['db'] === 'production' ? 'checked' : '' ?>>
                        <label for="db-production">📊 Production (Live)</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="db" id="db-staging" value="staging" <?= $config['db'] === 'staging' ? 'checked' : '' ?>>
                        <label for="db-staging">🧪 Staging (Test)</label>
                    </div>
                </div>
                <p class="help-text">Switch between production and staging databases for testing</p>
            </div>
        </div>

        <!-- Visibility Settings -->
        <div class="config-section">
            <div class="config-section-title">
                <i class="glyphicon glyphicon-eye-open"></i>
                Visibility & Privacy
            </div>

            <div class="form-group">
                <label>📜 History Visibility</label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" name="hide_history" id="hide_history" value="1" <?= $config['hide_history'] == '1' ? 'checked' : '' ?>>
                        <label for="hide_history">Hide betting history from non-admin users</label>
                    </div>
                </div>
                <p class="help-text">When checked, regular users cannot view other players' betting history</p>
            </div>

            <div class="form-group">
                <label>📊 Bet Info Visibility</label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" name="hide_bet_info" id="hide_bet_info" value="1" <?= $config['hide_bet_info'] == '1' ? 'checked' : '' ?>>
                        <label for="hide_bet_info">Hide detailed betting information</label>
                    </div>
                </div>
                <p class="help-text">When checked, detailed betting stats are hidden from regular users</p>
            </div>
        </div>

        <!-- App Settings -->
        <div class="config-section">
            <div class="config-section-title">
                <i class="glyphicon glyphicon-list"></i>
                Application Settings
            </div>

            <div class="form-group">
                <label>🏆 Season Name</label>
                <input type="text" name="season_name" class="form-control" value="<?= Html::encode($config['season_name']) ?>" placeholder="e.g., WC 2026">
                <p class="help-text">Displayed in the countdown dashboard and throughout the app</p>
            </div>

            <div class="form-group">
                <label>👥 Group Chat Link</label>
                <input type="text" name="group_chat" class="form-control" value="<?= Html::encode($config['group_chat']) ?>" placeholder="https://teams.live.com/...">
                <p class="help-text">Main group discussion link for all participants</p>
            </div>

            <div class="form-group">
                <label>💬 Admin Chat Link</label>
                <input type="text" name="admin_chat" class="form-control" value="<?= Html::encode($config['admin_chat']) ?>" placeholder="skype:live:.cid...">
                <p class="help-text">Contact link for admin communication (Skype, Teams, etc.)</p>
            </div>

            <div class="form-group">
                <label>👤 Admin Name</label>
                <input type="text" name="admin_name" class="form-control" value="<?= Html::encode($config['admin_name']) ?>" placeholder="e.g., Giàu Võ">
                <p class="help-text">Display name for the administrator</p>
            </div>

            <div class="form-group">
                <label>📧 Admin Email</label>
                <input type="email" name="admin_email" class="form-control" value="<?= Html::encode($config['admin_email']) ?>" placeholder="admin@example.com">
                <p class="help-text">Contact email for administrative purposes</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div style="text-align: center;">
            <button type="submit" class="btn-save">💾 Save Configuration</button>
        </div>

    <?php ActiveForm::end(); ?>
</div>
