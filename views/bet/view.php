<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Match Bets - ' . $match->getMatchTitle();
?>

<style>
.bet-view-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .bet-view-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.bets-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.bets-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.bets-hero h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .bets-hero h1 {
    color: #1a1a1a;
}

.back-link {
    color: #00d4ff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(0, 212, 255, 0.1);
    transition: all 0.2s ease;
    margin-bottom: 16px;
}

.back-link:hover {
    color: #7b2fff;
    background: rgba(123, 47, 255, 0.15);
}

.back-link .glyphicon {
    font-size: 1.2rem;
}

.match-info-card {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.08) 0%, rgba(123, 47, 255, 0.08) 100%);
    border: 2px solid rgba(0, 212, 255, 0.25);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 50px;
    text-align: center;
}

[data-theme="light"] .match-info-card {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.06) 0%, rgba(66, 133, 244, 0.06) 100%);
    border-color: rgba(31, 115, 230, 0.2);
}

.match-info-content {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

.team-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.team-flag-lg {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid rgba(0, 212, 255, 0.3);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.team-name-lg {
    font-size: 1.3rem;
    font-weight: 700;
    letter-spacing: -0.3px;
}

.match-score {
    font-size: 3rem;
    font-weight: 800;
    color: #00d4ff;
    letter-spacing: -1px;
    line-height: 1;
}

[data-theme="light"] .match-score {
    color: #0084ff;
}

.match-status {
    font-size: 0.9rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin-top: 12px;
}

.bets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.bet-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.bet-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-3px);
}

[data-theme="light"] .bet-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .bet-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

.bet-card-header {
    background: rgba(0, 212, 255, 0.06);
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

[data-theme="light"] .bet-card-header {
    background: rgba(0, 84, 255, 0.03);
}

.user-avatar-small {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
}

.bet-username {
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0;
}

.bet-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.bet-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.85rem;
}

.info-label {
    color: rgba(232, 234, 240, 0.6);
    font-weight: 600;
}

[data-theme="light"] .info-label {
    color: rgba(0, 0, 0, 0.6);
}

.info-value {
    color: #00d4ff;
    font-weight: 700;
}

[data-theme="light"] .info-value {
    color: #0084ff;
}

.result-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.result-win {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.result-loss {
    background: rgba(244, 67, 54, 0.2);
    color: #ef9a9a;
}

.result-draw {
    background: rgba(255, 152, 0, 0.2);
    color: #ffb74d;
}

.result-cancelled {
    background: rgba(158, 158, 158, 0.2);
    color: #bdbdbd;
}

.result-pending {
    background: rgba(0, 212, 255, 0.2);
    color: #00d4ff;
}

.bet-card-footer {
    border-top: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
    padding: 14px 20px;
    display: flex;
    gap: 8px;
}

[data-theme="light"] .bet-card-footer {
    border-top-color: rgba(0, 0, 0, 0.06);
}

.delete-btn {
    flex: 1;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none !important;
    text-align: center;
    border: 1px solid rgba(244, 67, 54, 0.3);
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    transition: all 0.2s ease;
    cursor: pointer;
}

.delete-btn:hover {
    background: rgba(244, 67, 54, 0.25);
    border-color: #ff7043;
    text-decoration: none !important;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
}

.empty-state-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .bet-view-page {
        padding: 20px 16px;
    }

    .bets-hero {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .bets-hero h1 {
        font-size: 2rem;
    }

    .bets-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 480px) {
    .bet-view-page {
        padding: 16px 12px;
    }

    .bets-hero h1 {
        font-size: 1.5rem;
    }

    .bets-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="bet-view-page">
    <div class="bets-wrapper">
        <!-- Back Button and Title -->
        <div class="bets-hero">
            <div>
                <a href="<?= \yii\helpers\Url::to(['/match/index']) ?>" class="back-link" title="Back to Matches">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <h1><?= Html::encode($match->getMatchTitle()) ?></h1>
            </div>
        </div>

        <!-- Match Info Card -->
        <div class="match-info-card">
            <div class="match-info-content">
                <!-- Team 1 -->
                <div class="team-info">
                    <?php if ($match->team1): ?>
                        <?php $flagUrl = $match->team1->getFlagUrl(); ?>
                        <?php if ($flagUrl): ?>
                            <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($match->team1->name) ?>" class="team-flag-lg">
                        <?php elseif ($match->team1->isPlayoffTeam()): ?>
                            <img src="/logo.png" alt="Playoff" class="team-flag-lg">
                        <?php endif; ?>
                        <div class="team-name-lg"><?= Html::encode($match->team1->name) ?></div>
                    <?php else: ?>
                        <div class="team-name-lg">Unknown</div>
                    <?php endif; ?>
                </div>

                <!-- Score -->
                <div>
                    <div class="match-score">
                        <?= $match->team_1_score ?? '-' ?> : <?= $match->team_2_score ?? '-' ?>
                    </div>
                    <div class="match-status">
                        <?php if ($match->result !== null): ?>
                            <?php if ($match->result == 3): ?>
                                Cancelled
                            <?php else: ?>
                                Match Finished
                            <?php endif; ?>
                        <?php else: ?>
                            Accepting Bets
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Team 2 -->
                <div class="team-info">
                    <?php if ($match->team2): ?>
                        <?php $flagUrl = $match->team2->getFlagUrl(); ?>
                        <?php if ($flagUrl): ?>
                            <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($match->team2->name) ?>" class="team-flag-lg">
                        <?php elseif ($match->team2->isPlayoffTeam()): ?>
                            <img src="/logo.png" alt="Playoff" class="team-flag-lg">
                        <?php endif; ?>
                        <div class="team-name-lg"><?= Html::encode($match->team2->name) ?></div>
                    <?php else: ?>
                        <div class="team-name-lg">Unknown</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bets Grid -->
        <div class="bets-grid">
            <?php
            $bets = $dataProvider->getModels();
            if (empty($bets)):
            ?>
                <div class="empty-state">
                    <div class="empty-state-icon"></div>
                    <p>No bets placed on this match yet</p>
                </div>
            <?php
            else:
                foreach ($bets as $bet):
                    $initial = substr($bet->user->username, 0, 1);
                    $betResult = $bet->getBettedResult();
                    $resultClass = $betResult === 'WIN' ? 'win' : ($betResult === 'LOSE' ? 'loss' : ($betResult === 'DRAW' ? 'draw' : ($betResult === 'CANCELED' ? 'cancelled' : 'pending')));
            ?>
                <div class="bet-card">
                    <!-- Header -->
                    <div class="bet-card-header">
                        <div class="user-avatar-small"><?= strtoupper($initial) ?></div>
                        <p class="bet-username"><?= Html::encode($bet->user->username) ?></p>
                    </div>

                    <!-- Body -->
                    <div class="bet-card-body">
                        <div class="bet-info-row">
                            <span class="info-label">Bet On</span>
                            <span class="info-value" style="display: flex; align-items: center; gap: 8px;">
                                <?php
                                $betTeam = $bet->option == 1 ? $bet->match->team1 : $bet->match->team2;
                                $flagUrl = $betTeam ? $betTeam->getFlagUrl() : null;
                                $shortName = $betTeam ? substr($betTeam->name, 0, 3) : '?';
                                ?>
                                <?php if ($flagUrl): ?>
                                    <img src="<?= Html::encode($flagUrl) ?>" style="width: 24px; height: 24px; border-radius: 3px; object-fit: cover;">
                                <?php elseif ($betTeam && $betTeam->isPlayoffTeam()): ?>
                                    <img src="/logo.png" style="width: 24px; height: 24px; border-radius: 3px; object-fit: cover;">
                                <?php endif; ?>
                                <span><?= Html::encode($shortName) ?></span>
                            </span>
                        </div>

                        <div class="bet-info-row">
                            <span class="info-label">Amount</span>
                            <span class="info-value"><?= Helper::formatMoney($bet->money) ?></span>
                        </div>

                        <div class="bet-info-row">
                            <span class="info-label">Bet Time</span>
                            <span class="info-value" style="font-size: 0.8rem;">
                                <?= $bet->created_time ? date('M d, Y H:i', strtotime($bet->created_time)) : 'N/A' ?>
                            </span>
                        </div>

                        <?php if ($match->result !== null): ?>
                            <div class="bet-info-row">
                                <span class="info-label">Result</span>
                                <span class="result-badge result-<?= $resultClass ?>">
                                    <?php if ($betResult === 'WIN'): ?>
                                        ✓ Win
                                    <?php elseif ($betResult === 'LOSE'): ?>
                                        ✗ Loss
                                    <?php elseif ($betResult === 'DRAW'): ?>
                                        Draw
                                    <?php else: ?>
                                        Cancelled
                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Footer -->
                    <?php if (Yii::$app->user->can('admin')): ?>
                        <div class="bet-card-footer">
                            <?= Html::a('Delete', ['/bet/delete', 'id' => $bet->id], [
                                'class' => 'delete-btn',
                                'data-confirm' => 'Are you sure you want to delete this bet?',
                                'data-method' => 'post'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Pagination -->
        <?php if ($dataProvider->getPagination()): ?>
            <div style="display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; margin-top: 40px;">
                <?php
                $pagination = $dataProvider->getPagination();
                $pageCount = $pagination->getPageCount();
                $currentPage = $pagination->getPage() + 1;

                for ($i = 1; $i <= $pageCount; $i++):
                    if ($i == $currentPage):
                        echo '<span style="padding: 8px 12px; border-radius: 6px; background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%); color: white; font-weight: 600;">' . $i . '</span>';
                    else:
                        echo '<a href="?page=' . $i . '" style="padding: 8px 12px; border: 1px solid var(--border-color, rgba(0, 212, 255, 0.2)); border-radius: 6px; text-decoration: none; color: inherit; transition: all 0.2s ease;" onmouseover="this.style.borderColor=\'rgba(0, 212, 255, 0.5)\';" onmouseout="this.style.borderColor=\'rgba(0, 212, 255, 0.2)\';">' . $i . '</a>';
                    endif;
                endfor;
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
