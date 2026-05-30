<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 */

$this->title = 'Update Bet';
$userBalance = Yii::$app->user->money;
$match = $model->match;
?>

<div class="bet-update-page">
    <!-- Header Section -->
    <div class="update-header">
        <div class="header-content">
            <h1 class="page-title">Update Your Bet</h1>
            <p class="page-subtitle">Modify your prediction and stake</p>
        </div>
        <div class="header-actions">
            <?= Html::a('Back to Match', ['/match/view', 'id' => $match->id], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <!-- Match Preview Card -->
    <div class="match-preview-card">
        <div class="preview-container">
            <!-- Team 1 -->
            <div class="preview-team">
                <div class="preview-team-info">
                    <?php if ($match->team1): ?>
                        <?php $flag1 = $match->team1->getFlagUrl(); ?>
                        <?php if ($flag1): ?>
                            <img src="<?= Html::encode($flag1) ?>" class="preview-flag" alt="<?= Html::encode($match->team1->name) ?>">
                        <?php elseif ($match->team1->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="preview-flag" alt="Playoff">
                        <?php endif; ?>
                        <span class="preview-team-name"><?= Html::encode($match->team1->name) ?></span>
                    <?php else: ?>
                        <span class="preview-team-name">Unknown</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- VS -->
            <div class="preview-vs">VS</div>

            <!-- Team 2 -->
            <div class="preview-team">
                <div class="preview-team-info">
                    <?php if ($match->team2): ?>
                        <?php $flag2 = $match->team2->getFlagUrl(); ?>
                        <?php if ($flag2): ?>
                            <img src="<?= Html::encode($flag2) ?>" class="preview-flag" alt="<?= Html::encode($match->team2->name) ?>">
                        <?php elseif ($match->team2->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="preview-flag" alt="Playoff">
                        <?php endif; ?>
                        <span class="preview-team-name"><?= Html::encode($match->team2->name) ?></span>
                    <?php else: ?>
                        <span class="preview-team-name">Unknown</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Match Info -->
        <div class="match-info-row">
            <div class="info-item">
                <span class="info-label">Match Date</span>
                <span class="info-value">
                    <?= $match->match_date ? date('F d, Y H:i', strtotime($match->match_date)) : 'TBD' ?>
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Odds Rate</span>
                <span class="info-value odds-highlight"><?= $match->rate ?? 'N/A' ?></span>
            </div>
        </div>
    </div>

    <!-- User Balance Card -->
    <div class="balance-card">
        <div class="balance-content">
            <span class="balance-label">Your Available Balance</span>
            <span class="balance-amount"><?= Helper::formatMoney($userBalance) ?></span>
        </div>
    </div>

    <!-- Betting Form Container -->
    <div class="form-container">
        <?= $this->render('_form', [
            'model' => $model,
            'match' => $match,
            'userBalance' => $userBalance
        ]) ?>
    </div>
</div>

<style>
.bet-update-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.update-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
}

[data-theme="light"] .update-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
    color: #e8eaf0;
}

[data-theme="light"] .page-title {
    color: #1f73e6;
}

.page-subtitle {
    font-size: 1rem;
    color: rgba(232, 234, 240, 0.7);
    margin: 0;
}

[data-theme="light"] .page-subtitle {
    color: rgba(0, 0, 0, 0.6);
}

.header-actions {
    display: flex;
    gap: 10px;
}

/* Match Preview Card */
.match-preview-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.15);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 25px;
}

[data-theme="light"] .match-preview-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

.preview-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .preview-container {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.preview-team {
    flex: 1;
    text-align: center;
}

.preview-team-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.preview-flag {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.preview-team-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #e8eaf0;
}

[data-theme="light"] .preview-team-name {
    color: #1a1a1a;
}

.preview-vs {
    font-size: 1.5rem;
    font-weight: bold;
    color: rgba(0, 212, 255, 0.6);
    padding: 0 20px;
}

[data-theme="light"] .preview-vs {
    color: rgba(31, 115, 230, 0.6);
}

/* Match Info Row */
.match-info-row {
    display: flex;
    gap: 30px;
    justify-content: space-around;
}

.info-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.info-label {
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(232, 234, 240, 0.6);
}

[data-theme="light"] .info-label {
    color: rgba(0, 0, 0, 0.6);
}

.info-value {
    font-size: 1.1rem;
    color: #e8eaf0;
    font-weight: 500;
}

[data-theme="light"] .info-value {
    color: #1a1a1a;
}

.odds-highlight {
    font-size: 1.3rem;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
    padding: 8px 16px;
    border-radius: 8px;
    color: #00d4ff;
    font-weight: 700;
}

[data-theme="light"] .odds-highlight {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.1) 0%, rgba(66, 133, 244, 0.1) 100%);
    color: #1f73e6;
}

/* Balance Card */
.balance-card {
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.15) 0%, rgba(76, 175, 80, 0.08) 100%);
    border: 2px solid rgba(76, 175, 80, 0.3);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 30px;
}

[data-theme="light"] .balance-card {
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.08) 0%, rgba(76, 175, 80, 0.04) 100%);
    border-color: rgba(76, 175, 80, 0.25);
}

.balance-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.balance-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #81c784;
}

.balance-amount {
    font-size: 1.8rem;
    font-weight: 700;
    color: #81c784;
    font-variant-numeric: tabular-nums;
}

/* Form Container */
.form-container {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    padding: 30px;
}

[data-theme="light"] .form-container {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .bet-update-page {
        padding: 15px;
    }

    .update-header {
        flex-direction: column;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .preview-container {
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .preview-vs {
        transform: rotate(90deg);
        padding: 10px 0;
    }

    .match-info-row {
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        flex-direction: row;
        justify-content: space-between;
        padding: 12px;
        background: rgba(0, 212, 255, 0.05);
        border-radius: 8px;
    }

    [data-theme="light"] .info-item {
        background: rgba(0, 0, 0, 0.03);
    }

    .header-actions {
        width: 100%;
    }

    .header-actions .btn {
        flex: 1;
    }

    .form-container {
        padding: 20px;
    }
}
</style>
