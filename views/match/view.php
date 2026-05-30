<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 */

$this->title = $model->getMatchTitle();
?>

<div class="match-view-page">
    <!-- Header Section -->
    <div class="match-view-header">
        <div class="header-content">
            <h1 class="page-title">Match Details</h1>
            <p class="page-subtitle">
                <?php if ($model->team1 && $model->team2): ?>
                    <?= Html::encode($model->team1->name) ?> vs <?= Html::encode($model->team2->name) ?>
                <?php else: ?>
                    View match information
                <?php endif; ?>
            </p>
        </div>
        <div class="header-actions">
            <?php if (Yii::$app->user->can('admin') && $model->canUpdate()): ?>
                <?= Html::a('Edit Match', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
            <?php if (Yii::$app->user->can('admin') && $model->canDelete()): ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'data-method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Match Score Card -->
    <div class="match-score-card">
        <div class="score-container">
            <!-- Team 1 -->
            <div class="team-section">
                <div class="team-info">
                    <?php if ($model->team1): ?>
                        <?php $flag1 = $model->team1->getFlagUrl(); ?>
                        <?php if ($flag1): ?>
                            <img src="<?= Html::encode($flag1) ?>" class="team-flag" alt="<?= Html::encode($model->team1->name) ?>">
                        <?php elseif ($model->team1->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="team-flag playoff" alt="Playoff">
                        <?php endif; ?>
                        <div class="team-name">
                            <div class="team-short"><?= Html::encode($model->team1->name) ?></div>
                            <div class="team-full"><?= Html::encode($model->team1->full_name) ?></div>
                        </div>
                    <?php else: ?>
                        <div class="team-name">
                            <div class="team-short">Unknown</div>
                            <div class="team-full">Team not found</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Score Display -->
            <div class="score-display">
                <div class="score-value">
                    <span class="score-team1"><?= $model->team_1_score ?? '-' ?></span>
                    <span class="score-separator">:</span>
                    <span class="score-team2"><?= $model->team_2_score ?? '-' ?></span>
                </div>
                <div class="result-badge">
                    <?php if ($model->result === null): ?>
                        <span class="badge badge-pending">Pending</span>
                    <?php elseif ($model->result == 0): ?>
                        <span class="badge badge-draw">Draw</span>
                    <?php elseif ($model->result == 1): ?>
                        <span class="badge badge-winner"><?= Html::encode($model->team1->name) ?> Won</span>
                    <?php elseif ($model->result == 2): ?>
                        <span class="badge badge-winner"><?= Html::encode($model->team2->name) ?> Won</span>
                    <?php elseif ($model->result == 3): ?>
                        <span class="badge badge-canceled">Canceled</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Team 2 -->
            <div class="team-section">
                <div class="team-info">
                    <?php if ($model->team2): ?>
                        <?php $flag2 = $model->team2->getFlagUrl(); ?>
                        <?php if ($flag2): ?>
                            <img src="<?= Html::encode($flag2) ?>" class="team-flag" alt="<?= Html::encode($model->team2->name) ?>">
                        <?php elseif ($model->team2->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="team-flag playoff" alt="Playoff">
                        <?php endif; ?>
                        <div class="team-name">
                            <div class="team-short"><?= Html::encode($model->team2->name) ?></div>
                            <div class="team-full"><?= Html::encode($model->team2->full_name) ?></div>
                        </div>
                    <?php else: ?>
                        <div class="team-name">
                            <div class="team-short">Unknown</div>
                            <div class="team-full">Team not found</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="match-details-container">
        <!-- Match Information Card -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Match Information</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Match Date & Time</span>
                        <span class="info-value">
                            <?php if ($model->match_date): ?>
                                <?= date('F d, Y H:i', strtotime($model->match_date)) ?>
                            <?php else: ?>
                                Not scheduled
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Odds Rate</span>
                        <span class="info-value"><?= $model->rate ?? 'N/A' ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Card -->
        <?php if ($model->description): ?>
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Description</h2>
            </div>
            <div class="card-content">
                <p class="description-text"><?= Html::encode($model->description) ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Metadata Card -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Metadata</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Match ID</span>
                        <span class="info-value">#<?= $model->id ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Created By</span>
                        <span class="info-value"><?= Html::encode($model->createdBy ? $model->createdBy->username : 'System') ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Created Date</span>
                        <span class="info-value"><?= date('M d, Y H:i', strtotime($model->created_time)) ?></span>
                    </div>
                    <?php if ($model->modified_time): ?>
                    <div class="info-item">
                        <span class="info-label">Last Modified</span>
                        <span class="info-value"><?= date('M d, Y H:i', strtotime($model->modified_time)) ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.match-view-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.match-view-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
}

[data-theme="light"] .match-view-header {
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

/* Score Card */
.match-score-card {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(123, 47, 255, 0.1) 100%);
    border: 2px solid rgba(0, 212, 255, 0.2);
    border-radius: 16px;
    padding: 40px;
    margin-bottom: 40px;
}

[data-theme="light"] .match-score-card {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.08) 0%, rgba(66, 133, 244, 0.08) 100%);
    border-color: rgba(31, 115, 230, 0.2);
}

.score-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.team-section {
    flex: 1;
    display: flex;
    justify-content: center;
}

.team-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    text-align: center;
}

.team-flag {
    width: 100px;
    height: 100px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.team-flag.playoff {
    background: rgba(0, 212, 255, 0.1);
    padding: 10px;
}

.team-name {
    min-width: 150px;
}

.team-short {
    font-size: 1.2rem;
    font-weight: 600;
    color: #e8eaf0;
}

[data-theme="light"] .team-short {
    color: #1f73e6;
}

.team-full {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.6);
}

[data-theme="light"] .team-full {
    color: rgba(0, 0, 0, 0.6);
}

/* Score Display */
.score-display {
    flex: 1;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.score-value {
    font-size: 4rem;
    font-weight: bold;
    letter-spacing: 10px;
}

.score-team1, .score-team2 {
    color: #00d4ff;
}

[data-theme="light"] .score-team1,
[data-theme="light"] .score-team2 {
    color: #1f73e6;
}

.score-separator {
    margin: 0 10px;
    opacity: 0.5;
}

.result-badge {
    display: flex;
    justify-content: center;
}

.match-view-page .badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.match-view-page .badge-pending {
    background: rgba(232, 234, 240, 0.1);
    color: rgba(232, 234, 240, 0.8);
}

.match-view-page .badge-draw {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.match-view-page .badge-winner {
    background: rgba(0, 212, 255, 0.2);
    color: #00d4ff;
}

[data-theme="light"] .match-view-page .badge-winner {
    background: rgba(31, 115, 230, 0.15);
    color: #1f73e6;
}

.match-view-page .badge-canceled {
    background: rgba(244, 67, 54, 0.15);
    color: #ef9a9a;
}

/* Details Container */
.match-details-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Info Cards */
.info-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

[data-theme="light"] .info-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

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
    margin: 0;
    color: #e8eaf0;
}

[data-theme="light"] .card-title {
    color: #1a1a1a;
}

.card-content {
    padding: 24px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.info-label {
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(232, 234, 240, 0.6);
}

[data-theme="light"] .info-label {
    color: rgba(0, 0, 0, 0.6);
}

.info-value {
    font-size: 1rem;
    color: #e8eaf0;
    word-break: break-word;
}

[data-theme="light"] .info-value {
    color: #1a1a1a;
}

.description-text {
    font-size: 1rem;
    line-height: 1.6;
    color: rgba(232, 234, 240, 0.8);
    margin: 0;
    white-space: pre-wrap;
    word-wrap: break-word;
}

[data-theme="light"] .description-text {
    color: rgba(0, 0, 0, 0.7);
}

/* Responsive */
@media (max-width: 768px) {
    .match-view-page {
        padding: 15px;
    }

    .match-view-header {
        flex-direction: column;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .score-container {
        flex-direction: column;
        gap: 20px;
    }

    .score-value {
        font-size: 2.5rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .team-flag {
        width: 80px;
        height: 80px;
    }

    .header-actions {
        width: 100%;
        flex-direction: column;
    }

    .header-actions .btn {
        width: 100%;
    }
}
</style>
