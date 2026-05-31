<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\User $user
 */

$this->title = $user->username . ' Betting History';
$bets = $dataProvider->getModels();
?>

<style>
.ranking-view-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .ranking-view-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.view-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.view-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.view-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .view-header h1 {
    color: #1a1a1a;
}

.back-link {
    color: #00d4ff;
    text-decoration: none !important;
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
    text-decoration: none !important;
}

.back-link .glyphicon {
    font-size: 1.2rem;
}

[data-theme="light"] .back-link {
    color: #0084ff;
}

[data-theme="light"] .back-link:hover {
    color: #1f73e6;
    text-decoration: none !important;
}

.bets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
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

.bet-card.won {
    border-left: 4px solid #81c784;
}

.bet-card.lost {
    border-left: 4px solid #ef9a9a;
}

.bet-card.draw {
    border-left: 4px solid #ffb74d;
}

.bet-card.cancelled {
    border-left: 4px solid #9e9e9e;
}

.bet-card-header {
    background: rgba(0, 212, 255, 0.06);
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bet-card.won .bet-card-header {
    background: rgba(76, 175, 80, 0.08);
}

.bet-card.lost .bet-card-header {
    background: rgba(244, 67, 54, 0.08);
}

.bet-card.draw .bet-card-header {
    background: rgba(255, 152, 0, 0.08);
}

.bet-card.cancelled .bet-card-header {
    background: rgba(158, 158, 158, 0.08);
}

[data-theme="light"] .bet-card-header {
    background: rgba(0, 84, 255, 0.03);
}

.card-title {
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0;
}

.result-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.result-won {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.result-lost {
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

.bet-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.teams-section {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
    gap: 8px;
}

[data-theme="light"] .teams-section {
    border-bottom-color: rgba(0, 0, 0, 0.06);
}

.team {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.team-flag {
    width: 48px;
    height: 48px;
    border-radius: 4px;
    object-fit: cover;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.team-name {
    font-weight: 700;
    font-size: 0.75rem;
    color: #e8eaf0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

[data-theme="light"] .team-name {
    color: #1a1a1a;
}

.vs-text {
    color: rgba(0, 212, 255, 0.5);
    font-weight: 600;
    font-size: 0.8rem;
    padding: 0 4px;
}

.bet-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    font-size: 0.85rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.bet-card.won .info-value {
    color: #81c784;
}

.bet-card.lost .info-value {
    color: #ef9a9a;
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

@media (max-width: 1024px) {
    .bets-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .ranking-view-page {
        padding: 20px 16px;
    }

    .view-header {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .view-header h1 {
        font-size: 2rem;
    }

    .bets-grid {
        grid-template-columns: 1fr;
    }

    .bet-info {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="ranking-view-page">
    <div class="view-wrapper">
        <!-- Header -->
        <div class="view-header">
            <div>
                <a href="<?= \yii\helpers\Url::to(['/ranking/index']) ?>" class="back-link" title="Back to Rankings">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <h1><?= Html::encode($user->username) ?></h1>
            </div>
        </div>

        <!-- Bets Grid -->
        <div class="bets-grid">
            <?php if (empty($bets)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon"></div>
                    <p>No bets found for this user</p>
                </div>
            <?php else: ?>
                <?php foreach ($bets as $model): ?>
                    <?php
                    // Determine bet status
                    $result = $model['result'] !== null ? (int)$model['result'] : null;
                    $option = (int)$model['option'];
                    $isWon = $result !== null && $result === $option && $result !== 0 && $result !== 3;
                    $isLost = $result !== null && $result !== $option && $result !== 0 && $result !== 3;
                    $isDraw = $result === 0;
                    $isCancelled = $result === 3;
                    $isPending = $result === null;

                    $statusClass = $isWon ? 'won' : ($isLost ? 'lost' : ($isDraw ? 'draw' : ($isCancelled ? 'cancelled' : 'pending')));
                    ?>
                    <div class="bet-card <?= $statusClass ?>">
                        <!-- Header -->
                        <div class="bet-card-header">
                            <h3 class="card-title">Match Bet</h3>
                            <span class="result-badge result-<?= $isWon ? 'won' : ($isLost ? 'lost' : ($isDraw ? 'draw' : ($isCancelled ? 'cancelled' : 'pending'))) ?>">
                                <?php if ($isWon): ?>
                                    ✓ Won
                                <?php elseif ($isLost): ?>
                                    ✗ Lost
                                <?php elseif ($isDraw): ?>
                                    = Draw
                                <?php elseif ($isCancelled): ?>
                                    ⊘ Cancelled
                                <?php else: ?>
                                    ⧖ Pending
                                <?php endif; ?>
                            </span>
                        </div>

                        <!-- Body -->
                        <div class="bet-card-body">
                            <!-- Teams -->
                            <div class="teams-section">
                                <div class="team">
                                    <?php
                                    $team1 = \app\models\Team::findOne(['name' => $model['team_1_name']]);
                                    $flag1 = $team1 ? $team1->getFlagUrl() : null;
                                    $shortName1 = $team1 ? substr($team1->name, 0, 3) : substr($model['team_1_name'], 0, 3);
                                    ?>
                                    <?php if ($flag1): ?>
                                        <img src="<?= Html::encode($flag1) ?>" class="team-flag" alt="<?= Html::encode($model['team_1_name']) ?>">
                                    <?php elseif ($team1 && $team1->isPlayoffTeam()): ?>
                                        <img src="/logo.png" class="team-flag" alt="Playoff">
                                    <?php endif; ?>
                                    <div class="team-name"><?= Html::encode($shortName1) ?></div>
                                </div>
                                <div class="vs-text">VS</div>
                                <div class="team">
                                    <?php
                                    $team2 = \app\models\Team::findOne(['name' => $model['team_2_name']]);
                                    $flag2 = $team2 ? $team2->getFlagUrl() : null;
                                    $shortName2 = $team2 ? substr($team2->name, 0, 3) : substr($model['team_2_name'], 0, 3);
                                    ?>
                                    <?php if ($flag2): ?>
                                        <img src="<?= Html::encode($flag2) ?>" class="team-flag" alt="<?= Html::encode($model['team_2_name']) ?>">
                                    <?php elseif ($team2 && $team2->isPlayoffTeam()): ?>
                                        <img src="/logo.png" class="team-flag" alt="Playoff">
                                    <?php endif; ?>
                                    <div class="team-name"><?= Html::encode($shortName2) ?></div>
                                </div>
                            </div>

                            <!-- Bet Info -->
                            <div class="bet-info">
                                <?php
                                $pickedTeamName = $model['option'] == 1 ? $model['team_1_name'] : $model['team_2_name'];
                                $pickedTeam = \app\models\Team::findOne(['name' => $pickedTeamName]);
                                $shortNamePicked = $pickedTeam ? substr($pickedTeam->name, 0, 3) : substr($pickedTeamName, 0, 3);
                                ?>
                                <div class="info-item">
                                    <span class="info-label">Your Pick</span>
                                    <span class="info-value"><?= Html::encode($shortNamePicked) ?></span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Odds</span>
                                    <span class="info-value"><?= $model['rate'] ?></span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Placed</span>
                                    <span class="info-value"><?= Helper::formatMoney($model['money'] ?? 0) ?></span>
                                </div>

                                <?php if ($result !== null && $result !== 3): ?>
                                    <div class="info-item">
                                        <span class="info-label">Result</span>
                                        <span class="info-value">
                                            <?php if ($result == 0): ?>
                                                Draw
                                            <?php elseif ($result == 1): ?>
                                                <?php
                                                $resultTeam1 = \app\models\Team::findOne(['name' => $model['team_1_name']]);
                                                $shortNameResult1 = $resultTeam1 ? substr($resultTeam1->name, 0, 3) : substr($model['team_1_name'], 0, 3);
                                                ?>
                                                <?= Html::encode($shortNameResult1) ?>
                                            <?php elseif ($result == 2): ?>
                                                <?php
                                                $resultTeam2 = \app\models\Team::findOne(['name' => $model['team_2_name']]);
                                                $shortNameResult2 = $resultTeam2 ? substr($resultTeam2->name, 0, 3) : substr($model['team_2_name'], 0, 3);
                                                ?>
                                                <?= Html::encode($shortNameResult2) ?>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
