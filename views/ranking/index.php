<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */

$this->title = 'Ranking';
$params = Yii::$app->params;
?>

<style>
.ranking-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .ranking-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.ranking-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.ranking-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.ranking-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .ranking-hero h1 {
    color: #1a1a1a;
}

.ranking-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.rank-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 20px;
}

.rank-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateX(4px);
}

[data-theme="light"] .rank-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .rank-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

.rank-card.top-1 {
    border-left: 4px solid #ffd700;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.08) 0%, rgba(255, 192, 61, 0.04) 100%);
}

.rank-card.top-2 {
    border-left: 4px solid #c0c0c0;
}

.rank-card.top-3 {
    border-left: 4px solid #cd7f32;
}

.rank-position {
    font-size: 1.8rem;
    font-weight: 800;
    min-width: 50px;
    text-align: center;
}

.rank-card.top-1 .rank-position {
    color: #ffd700;
}

.rank-card.top-2 .rank-position {
    color: #c0c0c0;
}

.rank-card.top-3 .rank-position {
    color: #cd7f32;
}

.rank-info {
    flex: 1;
    min-width: 200px;
}

.rank-username {
    font-weight: 700;
    font-size: 1.05rem;
    margin: 0 0 4px 0;
}

.rank-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 16px;
    font-size: 0.85rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
}

.stat-label {
    color: rgba(232, 234, 240, 0.6);
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

[data-theme="light"] .stat-label {
    color: rgba(0, 0, 0, 0.6);
}

.stat-value {
    color: #00d4ff;
    font-weight: 700;
    font-size: 1.05rem;
}

[data-theme="light"] .stat-value {
    color: #0084ff;
}

.stat-positive {
    color: #81c784;
}

.stat-negative {
    color: #ef9a9a;
}

.rank-action {
    flex-shrink: 0;
}

.view-btn {
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 0.8rem;
    text-decoration: none !important;
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
    transition: all 0.2s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.view-btn:hover {
    background: rgba(0, 212, 255, 0.25);
    border-color: #00d4ff;
    text-decoration: none !important;
}

[data-theme="light"] .view-btn {
    background: rgba(0, 84, 255, 0.12);
    color: #0084ff;
    border-color: rgba(0, 84, 255, 0.25);
}

[data-theme="light"] .view-btn:hover {
    background: rgba(0, 84, 255, 0.2);
    border-color: #0084ff;
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

.pagination-container {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 40px;
}

.pagination-container a,
.pagination-container span {
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.2));
    transition: all 0.2s ease;
}

.pagination-container a {
    background: var(--card-bg, rgba(255, 255, 255, 0.03));
    color: inherit;
    cursor: pointer;
}

.pagination-container a:hover {
    border-color: #00d4ff;
    color: #00d4ff;
}

.pagination-container .active {
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: white;
    border-color: transparent;
}

@media (max-width: 768px) {
    .ranking-page {
        padding: 20px 16px;
    }

    .ranking-hero {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .ranking-hero h1 {
        font-size: 2rem;
    }

    .rank-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .rank-info {
        width: 100%;
    }

    .rank-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .rank-action {
        width: 100%;
    }

    .view-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .ranking-page {
        padding: 16px 12px;
    }

    .ranking-hero h1 {
        font-size: 1.5rem;
    }

    .rank-position {
        font-size: 1.5rem;
    }

    .rank-stats {
        grid-template-columns: 1fr;
        gap: 8px;
        font-size: 0.8rem;
    }
}
</style>

<div class="ranking-page">
    <div class="ranking-wrapper">
        <!-- Hero Section -->
        <div class="ranking-hero">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <!-- Ranking List -->
        <div class="ranking-list">
            <?php
            $models = $dataProvider->getModels();
            $page = $dataProvider->getPagination() ? $dataProvider->getPagination()->getPage() : 0;
            $pageSize = $dataProvider->getPagination() ? $dataProvider->getPagination()->pageSize : 20;
            $startRank = ($page * $pageSize) + 1;

            if (empty($models)):
            ?>
                <div class="empty-state">
                    <div class="empty-state-icon"></div>
                    <p>No ranking data available</p>
                </div>
            <?php
            else:
                foreach ($models as $index => $model):
                    $rank = $startRank + $index;
                    $rankClass = $rank === 1 ? 'top-1' : ($rank === 2 ? 'top-2' : ($rank === 3 ? 'top-3' : ''));
                    $totalMoney = $model['total_money'] ?? 0;
                    $isPositive = $totalMoney > 0;
            ?>
                <div class="rank-card <?= $rankClass ?>">
                    <!-- Rank Position -->
                    <div class="rank-position"><?= $rank ?></div>

                    <!-- User Info & Stats -->
                    <div class="rank-info">
                        <p class="rank-username"><?= Html::encode($model['username']) ?></p>
                        <div class="rank-stats">
                            <div class="stat-item">
                                <span class="stat-label">Total</span>
                                <span class="stat-value <?= $isPositive ? 'stat-positive' : 'stat-negative' ?>">
                                    <?= Helper::formatMoney($totalMoney) ?>
                                </span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Placed</span>
                                <span class="stat-value"><?= Helper::formatMoney($model['bet_money'] ?? 0) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Available</span>
                                <span class="stat-value"><?= Helper::formatMoney($model['money'] ?? 0) ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Predictions</span>
                                <span class="stat-value"><?= $model['bet_times'] ?? 0 ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Wins</span>
                                <span class="stat-value"><?= $model['win_times'] ?? 0 ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Rate</span>
                                <span class="stat-value"><?= number_format((float)($model['win_rate'] ?? 0), 2) ?>%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="rank-action">
                        <?php if ($hide_history == 0): ?>
                            <?= Html::a('<span class="glyphicon glyphicon-share-alt"></span>', ['/ranking/view', 'username' => $model['username']], [
                                'class' => 'view-btn',
                                'title' => 'View detailed info'
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Pagination -->
        <?php if ($dataProvider->getPagination()): ?>
            <div class="pagination-container">
                <?php
                $pagination = $dataProvider->getPagination();
                $pageCount = $pagination->getPageCount();
                $currentPage = $pagination->getPage() + 1;

                for ($i = 1; $i <= $pageCount; $i++):
                    if ($i == $currentPage):
                        echo '<span class="active">' . $i . '</span>';
                    else:
                        echo '<a href="?page=' . ($i - 1) . '">' . $i . '</a>';
                    endif;
                endfor;
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
