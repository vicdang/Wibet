<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use amnah\yii2\user\helpers\Timezone;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var yii\data\ActiveDataProvider $dataHistory
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = 'Profile';
?>

<style>
.profile-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .profile-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.profile-wrapper {
    max-width: 1000px;
    margin: 0 auto;
}

.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.profile-header h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .profile-header h1 {
    color: #1a1a1a;
}

.profile-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.profile-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 30px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.profile-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-3px);
}

[data-theme="light"] .profile-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .profile-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

.profile-card h2 {
    font-size: 18px;
    font-weight: 700;
    color: #00d4ff;
    margin: 0 0 25px 0;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

[data-theme="light"] .profile-card h2 {
    color: #0084ff;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: rgba(232, 234, 240, 0.8);
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

[data-theme="light"] .form-group label {
    color: rgba(0, 0, 0, 0.7);
}

.form-control {
    background: rgba(0, 212, 255, 0.05) !important;
    border: 1px solid rgba(0, 212, 255, 0.2) !important;
    color: #e8eaf0 !important;
    padding: 12px 14px !important;
    border-radius: 6px !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
    width: 100%;
}

.form-control:focus {
    background: rgba(0, 212, 255, 0.1) !important;
    border-color: rgba(0, 212, 255, 0.5) !important;
    color: #e8eaf0 !important;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2) !important;
    outline: none !important;
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

.btn-update {
    padding: 12px 28px;
    background: transparent;
    color: #00d4ff;
    border: 2px solid #00d4ff;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
    margin-top: 15px;
}

.btn-update:hover {
    background: rgba(0, 212, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .btn-update {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-update:hover {
    background: rgba(0, 84, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 84, 255, 0.2);
}

.alert-success {
    background: rgba(76, 175, 80, 0.1);
    border: 1px solid rgba(76, 175, 80, 0.3);
    border-radius: 8px;
    color: #a8d5a8;
    padding: 15px 20px;
    margin-bottom: 20px;
}

[data-theme="light"] .alert-success {
    background: rgba(52, 168, 83, 0.1);
    border-left: 4px solid #34a853;
    color: #0d652d;
}

.history-section {
    margin-top: 40px;
}

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.history-header h2 {
    font-size: 2rem;
    font-weight: 800;
    margin: 0;
}

[data-theme="light"] .history-header h2 {
    color: #1a1a1a;
}

.betting-history-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
}

.history-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
}

.history-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-2px);
}

[data-theme="light"] .history-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .history-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

.history-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.history-teams {
    font-size: 14px;
    font-weight: 700;
}

.history-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-success {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.badge-danger {
    background: rgba(244, 67, 54, 0.2);
    color: #ef9a9a;
}

.badge-warning {
    background: rgba(255, 193, 7, 0.2);
    color: #fdd835;
}

.badge-secondary {
    background: rgba(158, 158, 158, 0.2);
    color: #9e9e9e;
}

.badge-info {
    background: rgba(0, 212, 255, 0.2);
    color: #00d4ff;
}

.history-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 15px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

.stat-label {
    color: rgba(232, 234, 240, 0.6);
}

[data-theme="light"] .stat-label {
    color: rgba(0, 0, 0, 0.6);
}

.stat-value {
    color: #00d4ff;
    font-weight: 700;
}

[data-theme="light"] .stat-value {
    color: #0084ff;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .profile-page {
        padding: 20px 16px;
    }

    .profile-header {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
    }

    .profile-header h1 {
        font-size: 2rem;
    }

    .profile-cards-grid {
        grid-template-columns: 1fr;
    }

    .history-header h2 {
        font-size: 1.5rem;
    }

    .betting-history-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="profile-page">
    <div class="profile-wrapper">
        <!-- Header -->
        <div class="profile-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <!-- Success Message -->
        <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>
            <div class="alert-success">
                <strong>✓</strong> <?= $flash ?>
            </div>
        <?php endif; ?>

        <!-- Profile Cards Grid -->
        <div class="profile-cards-grid">
            <!-- Personal Information Card -->
            <div class="profile-card">
                <h2>Personal Information</h2>

                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => ''],
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => ''],
                    ],
                    'enableAjaxValidation' => true,
                ]); ?>

                <?= $form->field($profile, 'full_name')->textInput(['placeholder' => 'Your Full Name']) ?>

                <?= $form->field($profile, 'timezone')->dropDownList(ArrayHelper::map(Timezone::getAll(), 'identifier', 'name'), ['class' => 'form-control']) ?>

                <?= Html::submitButton('Update Profile', ['class' => 'btn-update']) ?>

                <?php ActiveForm::end(); ?>
            </div>

            <!-- Account Info Card -->
            <div class="profile-card">
                <h2>Account Info</h2>

                <div class="stat-item" style="margin-bottom: 20px;">
                    <span class="stat-label">Email</span>
                    <span style="color: #e8eaf0; font-weight: 600;"><?= Html::encode(Yii::$app->user->identity->email) ?></span>
                </div>

                <div class="stat-item" style="margin-bottom: 20px;">
                    <span class="stat-label">Username</span>
                    <span style="color: #e8eaf0; font-weight: 600;"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Member Since</span>
                    <span style="color: #e8eaf0; font-weight: 600;">
                        <?= Yii::$app->user->identity->created_at ? date('M d, Y', strtotime(Yii::$app->user->identity->created_at)) : 'N/A' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Betting History Section -->
        <div class="history-section">
            <div class="history-header">
                <h2>Betting History</h2>
            </div>

            <?php
            $historyData = $dataHistory->getModels();
            if (empty($historyData)):
            ?>
                <div class="empty-state">
                    <div class="empty-icon">📊</div>
                    <p>No betting history yet</p>
                </div>
            <?php else: ?>
                <div class="betting-history-grid">
                    <?php foreach ($historyData as $model):
                        $result = null;
                        $resultBadge = '';

                        if ($model['result'] != NULL) {
                            if ($model['result'] == $model['option']) {
                                $result = 'Win';
                                $resultBadge = '<span class="history-badge badge-success">✓ Win</span>';
                            } else {
                                if ($model['result'] == 0) {
                                    $result = 'Draw';
                                    $resultBadge = '<span class="history-badge badge-warning">— Draw</span>';
                                } elseif ($model['result'] == 3) {
                                    $result = 'Cancelled';
                                    $resultBadge = '<span class="history-badge badge-secondary">⊘ Cancelled</span>';
                                } else {
                                    $result = 'Loss';
                                    $resultBadge = '<span class="history-badge badge-danger">✕ Loss</span>';
                                }
                            }
                        } else {
                            $result = 'Pending';
                            $resultBadge = '<span class="history-badge badge-info">⟳ Pending</span>';
                        }
                    ?>
                        <div class="history-card">
                            <div class="history-card-header">
                                <div class="history-teams">
                                    <div><?= Html::encode($model['team_1_name']) ?> vs <?= Html::encode($model['team_2_name']) ?></div>
                                </div>
                                <?= $resultBadge ?>
                            </div>

                            <div class="history-stats">
                                <div class="stat-item">
                                    <span class="stat-label">Pick</span>
                                    <span class="stat-value"><?= $model['option'] == 1 ? Html::encode($model['team_1_name']) : ($model['option'] == 2 ? Html::encode($model['team_2_name']) : 'Draw') ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Amount</span>
                                    <span class="stat-value"><?= Helper::formatMoney($model['money']) ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Odds</span>
                                    <span class="stat-value"><?= number_format($model['rate'], 2) ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Date</span>
                                    <span class="stat-value"><?= date('M d, Y', strtotime($model['created_time'] ?? 'now')) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
