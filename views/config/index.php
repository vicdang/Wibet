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

[data-theme="light"] .config-section {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.config-section h3 {
    font-size: 18px;
    font-weight: 700;
    color: #00d4ff;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

[data-theme="light"] .config-section h3 {
    color: #1f73e6;
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.config-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .config-row {
    border-bottom-color: rgba(0, 0, 0, 0.08);
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

[data-theme="light"] .config-label-text {
    color: #1a1a1a;
}

.config-label-hint {
    font-size: 12px;
    color: #8e92a0;
}

[data-theme="light"] .config-label-hint {
    color: rgba(0, 0, 0, 0.55);
}

.toggle-group {
    display: flex;
    gap: 10px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 6px;
    padding: 4px;
    width: fit-content;
}

[data-theme="light"] .toggle-group {
    background: rgba(0, 0, 0, 0.08);
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

[data-theme="light"] .toggle-btn {
    color: rgba(0, 0, 0, 0.55);
}

.toggle-btn.active {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%);
    color: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
}

[data-theme="light"] .toggle-btn.active {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.2) 0%, rgba(66, 133, 244, 0.2) 100%);
    color: #1f73e6;
    box-shadow: 0 0 10px rgba(31, 115, 230, 0.15);
}

.toggle-btn:hover {
    color: #d4d8e0;
}

[data-theme="light"] .toggle-btn:hover {
    color: #1a1a1a;
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

[data-theme="light"] .checkbox-toggle {
    background: rgba(0, 0, 0, 0.1);
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

[data-theme="light"] .checkbox-toggle .toggle-slider {
    background: rgba(0, 0, 0, 0.2);
}

.checkbox-toggle input:checked + .toggle-slider {
    left: 24px;
    background: #00d4ff;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.4);
}

[data-theme="light"] .checkbox-toggle input:checked + .toggle-slider {
    background: #1f73e6;
    box-shadow: 0 0 10px rgba(31, 115, 230, 0.3);
}

.form-group {
    margin-bottom: 0;
}

body[data-theme="dark"] .form-group input[type="text"],
body[data-theme="dark"] .form-group input[type="email"],
body[data-theme="dark"] .form-group input[type="number"],
body[data-theme="dark"] .form-group input[type="password"],
body[data-theme="dark"] .form-group select,
.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="number"],
.form-group input[type="password"],
.form-group select {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(0, 212, 255, 0.2) !important;
    color: #e8eaf0 !important;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
    max-width: 300px;
}

body[data-theme="dark"] .form-group input[type="text"]:focus,
body[data-theme="dark"] .form-group input[type="email"]:focus,
body[data-theme="dark"] .form-group input[type="number"]:focus,
body[data-theme="dark"] .form-group input[type="password"]:focus,
body[data-theme="dark"] .form-group select:focus,
.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus,
.form-group input[type="number"]:focus,
.form-group input[type="password"]:focus,
.form-group select:focus {
    background: rgba(255, 255, 255, 0.08) !important;
    border-color: rgba(0, 212, 255, 0.5) !important;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
    outline: none;
    color: #e8eaf0 !important;
}

[data-theme="light"] .form-group input[type="text"],
[data-theme="light"] .form-group input[type="email"],
[data-theme="light"] .form-group input[type="number"],
[data-theme="light"] .form-group input[type="password"],
[data-theme="light"] .form-group select {
    background: rgba(0, 0, 0, 0.03) !important;
    border-color: rgba(0, 0, 0, 0.15) !important;
    color: #1a1a1a !important;
}

[data-theme="light"] .form-group input[type="text"]:focus,
[data-theme="light"] .form-group input[type="email"]:focus,
[data-theme="light"] .form-group input[type="number"]:focus,
[data-theme="light"] .form-group input[type="password"]:focus,
[data-theme="light"] .form-group select:focus {
    background: rgba(0, 0, 0, 0.05) !important;
    border-color: rgba(0, 0, 0, 0.3) !important;
    box-shadow: 0 0 10px rgba(0, 132, 255, 0.1);
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

[data-theme="light"] .alert-flash {
    background: rgba(76, 175, 80, 0.08);
    color: #2e7d32;
}

h1 {
    color: #ffffff;
    margin-bottom: 30px;
    font-size: 28px;
}

[data-theme="light"] h1 {
    color: #1a1a1a;
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
        <fieldset <?= $isGod ? '' : 'disabled' ?> style="border: none; margin: 0; padding: 0;">

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

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Tournament Phase</span>
                    <span class="config-label-hint">Select current tournament stage</span>
                </div>
                <div class="toggle-group">
                    <button type="button" class="toggle-btn <?= $config['tournament_phase'] === 'group_stage' ? 'active' : '' ?>" onclick="setTournamentPhase('group_stage')">Group Stage</button>
                    <button type="button" class="toggle-btn <?= $config['tournament_phase'] === 'knockout_stage' ? 'active' : '' ?>" onclick="setTournamentPhase('knockout_stage')">Knockout Stage</button>
                </div>
                <input type="hidden" name="tournament_phase" id="tournament_phase" value="<?= $config['tournament_phase'] ?>">
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

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Show Account Name on Ranking</span>
                    <span class="config-label-hint">Show @username instead of the full name on the ranking page</span>
                </div>
                <label class="checkbox-toggle">
                    <input type="checkbox" name="show_account_name" value="1" <?= $config['show_account_name'] == '1' ? 'checked' : '' ?>>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Zero Balance Label</span>
                    <span class="config-label-hint">Text shown on the ranking page when a user's total reaches 0</span>
                </div>
                <div class="form-group">
                    <input type="text" name="bankruptcy_text" value="<?= Html::encode($config['bankruptcy_text']) ?>" placeholder="Bankruptcy">
                </div>
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

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Sender Name</span>
                    <span class="config-label-hint">Email sender name</span>
                </div>
                <div class="form-group">
                    <input type="text" name="sender_name" value="<?= Html::encode($config['sender_name']) ?>" placeholder="Sender name">
                </div>
            </div>
        </div>

        <!-- Betting Settings -->
        <div class="config-section">
            <h3>Betting</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Starting Money</span>
                    <span class="config-label-hint">Initial account balance</span>
                </div>
                <div class="form-group">
                    <input type="number" name="starting_money" value="<?= Html::encode($config['starting_money']) ?>" placeholder="300">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Minimum Bet Amount</span>
                    <span class="config-label-hint">Lowest allowed bet</span>
                </div>
                <div class="form-group">
                    <input type="number" name="min_bet_money" value="<?= Html::encode($config['min_bet_money']) ?>" placeholder="50">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Minimum Bet Times</span>
                    <span class="config-label-hint">Minimum bets required</span>
                </div>
                <div class="form-group">
                    <input type="number" name="min_bet_times" value="<?= Html::encode($config['min_bet_times']) ?>" placeholder="4">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Max Refill Times</span>
                    <span class="config-label-hint">Maximum account refills allowed</span>
                </div>
                <div class="form-group">
                    <input type="number" name="max_refill_times" value="<?= Html::encode($config['max_refill_times']) ?>" placeholder="4">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Accounts Per User</span>
                    <span class="config-label-hint">Maximum accounts per player</span>
                </div>
                <div class="form-group">
                    <input type="number" name="account_per_user" value="<?= Html::encode($config['account_per_user']) ?>" placeholder="2">
                </div>
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="config-section">
            <h3>Payment</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Minimum Withdrawal</span>
                    <span class="config-label-hint">Minimum amount to withdraw</span>
                </div>
                <div class="form-group">
                    <input type="number" name="min_pay_money" value="<?= Html::encode($config['min_pay_money']) ?>" placeholder="300">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Maximum Withdrawal</span>
                    <span class="config-label-hint">Maximum amount to withdraw</span>
                </div>
                <div class="form-group">
                    <input type="number" name="max_pay_money" value="<?= Html::encode($config['max_pay_money']) ?>" placeholder="300">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Payment Times</span>
                    <span class="config-label-hint">Times (comma separated, e.g., 09h00,22h30)</span>
                </div>
                <div class="form-group">
                    <input type="text" name="pay_time" value="<?= Html::encode($config['pay_time']) ?>" placeholder="09h00,22h30">
                </div>
            </div>
        </div>

        <!-- Prize Pool Settings -->
        <div class="config-section">
            <h3>Prize Pool</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Total Prize Amount</span>
                    <span class="config-label-hint">Total funds for prizes</span>
                </div>
                <div class="form-group">
                    <input type="number" name="total_amount" value="<?= Html::encode($config['total_amount']) ?>" placeholder="6000000">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Gift Item</span>
                    <span class="config-label-hint">Prize item description</span>
                </div>
                <div class="form-group">
                    <input type="text" name="gift_item" value="<?= Html::encode($config['gift_item']) ?>" placeholder="e.g., Móc Khoá">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Maintain Rate (%)</span>
                    <span class="config-label-hint">MT rate percentage</span>
                </div>
                <div class="form-group">
                    <input type="number" name="mt_rate" value="<?= Html::encode($config['mt_rate']) ?>" placeholder="10">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Adjust Rate (%)</span>
                    <span class="config-label-hint">ADJ rate percentage</span>
                </div>
                <div class="form-group">
                    <input type="number" name="adj_rate" value="<?= Html::encode($config['adj_rate']) ?>" placeholder="5">
                </div>
            </div>

            <div style="padding: 15px 0; border-top: 1px solid rgba(0, 212, 255, 0.1); margin-top: 20px; margin-bottom: 20px;">
                <p style="color: #8e92a0; font-size: 13px; margin: 0 0 15px 0; font-weight: 600;">Prize Tiers</p>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">1st Place Rate (%)</span>
                    <span class="config-label-hint">P1 percentage</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p1_rate" value="<?= Html::encode($config['p1_rate']) ?>" placeholder="25" style="max-width: 100px;">
                    </div>
                    <span style="color: #8e92a0;">Count:</span>
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p1_count" value="<?= Html::encode($config['p1_count']) ?>" placeholder="1" style="max-width: 100px;">
                    </div>
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">2nd Place Rate (%)</span>
                    <span class="config-label-hint">P2 percentage</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p2_rate" value="<?= Html::encode($config['p2_rate']) ?>" placeholder="20" style="max-width: 100px;">
                    </div>
                    <span style="color: #8e92a0;">Count:</span>
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p2_count" value="<?= Html::encode($config['p2_count']) ?>" placeholder="1" style="max-width: 100px;">
                    </div>
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">3rd Place Rate (%)</span>
                    <span class="config-label-hint">P3 percentage</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p3_rate" value="<?= Html::encode($config['p3_rate']) ?>" placeholder="10" style="max-width: 100px;">
                    </div>
                    <span style="color: #8e92a0;">Count:</span>
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p3_count" value="<?= Html::encode($config['p3_count']) ?>" placeholder="2" style="max-width: 100px;">
                    </div>
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">4th Place Rate (%)</span>
                    <span class="config-label-hint">P4 percentage</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p4_rate" value="<?= Html::encode($config['p4_rate']) ?>" placeholder="5" style="max-width: 100px;">
                    </div>
                    <span style="color: #8e92a0;">Count:</span>
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p4_count" value="<?= Html::encode($config['p4_count']) ?>" placeholder="4" style="max-width: 100px;">
                    </div>
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">5th Place Rate (%)</span>
                    <span class="config-label-hint">P5 percentage</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p5_rate" value="<?= Html::encode($config['p5_rate']) ?>" placeholder="0" style="max-width: 100px;">
                    </div>
                    <span style="color: #8e92a0;">Count:</span>
                    <div class="form-group" style="margin: 0;">
                        <input type="number" name="p5_count" value="<?= Html::encode($config['p5_count']) ?>" placeholder="5" style="max-width: 100px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Agent Settings -->
        <div class="config-section">
            <h3>AI Agent</h3>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">AI Provider</span>
                    <span class="config-label-hint">Choose which AI service to use</span>
                </div>
                <div class="form-group">
                    <select name="ai_provider" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(0, 212, 255, 0.2); background: rgba(0, 0, 0, 0.3); color: #e8eaf0;">
                        <option value="huggingface" <?= $config['ai_provider'] === 'huggingface' ? 'selected' : '' ?>>HuggingFace (FREE 100%)</option>
                        <option value="claude" <?= $config['ai_provider'] === 'claude' ? 'selected' : '' ?>>Claude (Anthropic)</option>
                        <option value="gemini" <?= $config['ai_provider'] === 'gemini' ? 'selected' : '' ?>>Gemini (Google)</option>
                    </select>
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Claude API Key</span>
                    <span class="config-label-hint">Your Anthropic API key (sk-ant-...)</span>
                </div>
                <div class="form-group">
                    <input type="password" name="ai_api_key_claude" value="<?= Html::encode($config['ai_api_key_claude']) ?>" placeholder="sk-ant-...">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Gemini API Key</span>
                    <span class="config-label-hint">Your Google Gemini API key</span>
                </div>
                <div class="form-group">
                    <input type="password" name="ai_api_key_gemini" value="<?= Html::encode($config['ai_api_key_gemini']) ?>" placeholder="AIza...">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">HuggingFace API Key</span>
                    <span class="config-label-hint">Free token from huggingface.co (100% free, no credit card)</span>
                </div>
                <div class="form-group">
                    <input type="password" name="ai_api_key_huggingface" value="<?= Html::encode($config['ai_api_key_huggingface']) ?>" placeholder="hf_...">
                </div>
            </div>

            <div class="config-row">
                <div class="config-label">
                    <span class="config-label-text">Demo Mode</span>
                    <span class="config-label-hint">Use sample responses for testing (no API calls needed). Turn OFF in production.</span>
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: 12px;">
                    <input type="hidden" name="ai_demo_mode" value="0">
                    <input type="checkbox" id="aiDemoMode" name="ai_demo_mode" value="1" <?= $config['ai_demo_mode'] === '1' || $config['ai_demo_mode'] === 1 ? 'checked' : '' ?> style="width: 20px; height: 20px; cursor: pointer; accent-color: #00d4ff;">
                    <label for="aiDemoMode" style="cursor: pointer; margin: 0; color: var(--text-primary, #e8eaf0);">Enable Demo Mode (use sample AI responses)</label>
                </div>
            </div>
        </div>

        </fieldset>

        <!-- Submit Button -->
        <?php if ($isGod): ?>
        <div style="text-align: center; padding-top: 20px;">
            <button type="submit" class="btn-save">Save Configuration</button>
        </div>
        <?php endif; ?>

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

function setTournamentPhase(phase) {
    document.getElementById('tournament_phase').value = phase;
    const groups = document.querySelectorAll('.toggle-group');
    if (groups.length > 2) {
        groups[2].querySelectorAll('.toggle-btn').forEach((btn, i) => {
            btn.classList.remove('active');
            if ((i === 0 && phase === 'group_stage') || (i === 1 && phase === 'knockout_stage')) {
                btn.classList.add('active');
            }
        });
    }
}
</script>
