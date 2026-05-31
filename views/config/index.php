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
.form-group input[type="email"],
.form-group input[type="number"] {
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
.form-group input[type="email"]:focus,
.form-group input[type="number"]:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
    outline: none;
}

[data-theme="light"] .form-group input[type="text"],
[data-theme="light"] .form-group input[type="email"],
[data-theme="light"] .form-group input[type="number"] {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

[data-theme="light"] .form-group input[type="text"]:focus,
[data-theme="light"] .form-group input[type="email"]:focus,
[data-theme="light"] .form-group input[type="number"]:focus {
    background: rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.3);
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
