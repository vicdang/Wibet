<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 */

$this->title = 'Match Bets - ' . $match->getMatchTitle();
?>

<style>
/* Modern Bet View Page */
.bet-view {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .bet-view {
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

/* Hero Section */
.bets-hero {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 40px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.bets-hero h3 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0 0 12px 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

[data-theme="light"] .bets-hero h3 {
    color: rgba(0, 0, 0, 0.6);
}

.bets-hero h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -0.5px;
}

[data-theme="light"] .bets-hero h1 {
    color: #1a1a1a;
}

/* Match Info Card */
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

/* GridView Container */
.grid-view {
    background: transparent;
    border: none;
}

.grid-view table {
    width: 100%;
    border-collapse: collapse;
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    overflow: hidden;
    margin-top: 20px;
    font-size: 0.9rem;
}

[data-theme="light"] .grid-view table {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.grid-view thead {
    background: rgba(0, 212, 255, 0.08);
    border-bottom: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
}

[data-theme="light"] .grid-view thead {
    background: rgba(0, 84, 255, 0.04);
}

.grid-view th {
    padding: 16px 14px;
    text-align: left;
    font-weight: 700;
    color: #00d4ff;
    letter-spacing: 0.3px;
}

[data-theme="light"] .grid-view th {
    color: #0084ff;
}

.grid-view td {
    padding: 14px 14px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
}

[data-theme="light"] .grid-view td {
    color: #1a1a1a;
}

.grid-view tbody tr {
    transition: all 0.3s ease;
}

.grid-view tbody tr:hover {
    background: rgba(0, 212, 255, 0.04);
}

[data-theme="light"] .grid-view tbody tr:hover {
    background: rgba(0, 84, 255, 0.03);
}

.grid-view tbody tr:last-child td {
    border-bottom: none;
}

/* Username Column */
.grid-view td:nth-child(2) {
    font-weight: 700;
    min-width: 120px;
}

/* Badge Styling */
.grid-view .badge {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
    letter-spacing: 0.3px;
    border: 1px solid;
}

.grid-view .badge-pill {
    border-radius: 20px;
}

.grid-view .badge-success {
    background: rgba(76, 175, 80, 0.15);
    color: #81c784;
    border-color: rgba(76, 175, 80, 0.3);
}

.grid-view .badge-danger {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    border-color: rgba(244, 67, 54, 0.3);
}

.grid-view .badge-warning {
    background: rgba(255, 193, 7, 0.15);
    color: #ffc107;
    border-color: rgba(255, 193, 7, 0.3);
}

.grid-view .badge-secondary {
    background: rgba(232, 234, 240, 0.15);
    color: rgba(232, 234, 240, 0.8);
    border-color: rgba(232, 234, 240, 0.3);
}

[data-theme="light"] .grid-view .badge-success {
    background: rgba(76, 175, 80, 0.12);
    color: #388e3c;
    border-color: rgba(76, 175, 80, 0.25);
}

[data-theme="light"] .grid-view .badge-danger {
    background: rgba(244, 67, 54, 0.12);
    color: #d32f2f;
    border-color: rgba(244, 67, 54, 0.25);
}

[data-theme="light"] .grid-view .badge-warning {
    background: rgba(255, 193, 7, 0.12);
    color: #f57f17;
    border-color: rgba(255, 193, 7, 0.25);
}

/* Action Column */
.grid-view .btn {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid;
}

.grid-view .btn-danger {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    border-color: rgba(244, 67, 54, 0.3);
}

.grid-view .btn-danger:hover {
    background: rgba(244, 67, 54, 0.25);
    border-color: #ff7043;
}

/* Grid View Summary */
.grid-view .summary {
    padding: 14px;
    text-align: left;
    font-size: 0.85rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    background: rgba(0, 212, 255, 0.04);
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

[data-theme="light"] .grid-view .summary {
    background: rgba(0, 0, 0, 0.02);
    color: rgba(0, 0, 0, 0.65);
}

/* Empty State */
.grid-view .empty {
    padding: 40px;
    text-align: center;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
}

/* Pagination */
.grid-view .pagination {
    margin-top: 20px;
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    padding: 0;
}

.grid-view .pagination li {
    list-style: none;
}

.grid-view .pagination a,
.grid-view .pagination button {
    padding: 8px 12px;
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.2));
    background: var(--card-bg, rgba(255, 255, 255, 0.03));
    color: inherit;
    text-decoration: none;
    border-radius: 6px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: 500;
}

.grid-view .pagination a:hover {
    border-color: #00d4ff;
    color: #00d4ff;
}

.grid-view .pagination li.active a {
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: white;
    border-color: transparent;
}

[data-theme="light"] .grid-view .pagination a {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.12);
}

[data-theme="light"] .grid-view .pagination a:hover {
    border-color: #0084ff;
    color: #0084ff;
}

[data-theme="light"] .grid-view .pagination li.active a {
    background: linear-gradient(135deg, #1f73e6 0%, #4285f4 100%);
}

/* Responsive */
@media (max-width: 768px) {
    .bet-view {
        padding: 20px 16px;
    }

    .bets-hero {
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .bets-hero h3 {
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .bets-hero h1 {
        font-size: 1.8rem;
    }

    .match-info-card {
        padding: 24px;
        margin-bottom: 36px;
    }

    .match-info-content {
        gap: 16px;
    }

    .team-flag-lg {
        width: 70px;
        height: 70px;
    }

    .team-name-lg {
        font-size: 1.1rem;
    }

    .match-score {
        font-size: 2.2rem;
    }

    .grid-view table {
        font-size: 0.8rem;
    }

    .grid-view th,
    .grid-view td {
        padding: 10px 8px;
    }

    .grid-view .badge {
        padding: 5px 10px;
        font-size: 0.7rem;
    }

    .grid-view .btn {
        padding: 5px 8px;
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .bet-view {
        padding: 16px 12px;
    }

    .bets-hero h1 {
        font-size: 1.4rem;
    }

    .match-info-card {
        padding: 18px;
    }

    .match-info-content {
        gap: 12px;
    }

    .team-flag-lg {
        width: 60px;
        height: 60px;
    }

    .team-name-lg {
        font-size: 0.95rem;
    }

    .match-score {
        font-size: 1.8rem;
    }

    .grid-view table {
        font-size: 0.75rem;
    }

    .grid-view th,
    .grid-view td {
        padding: 8px 6px;
    }

    .grid-view .badge {
        padding: 4px 8px;
        font-size: 0.65rem;
    }

    .grid-view .btn {
        padding: 4px 6px;
        font-size: 0.65rem;
    }

    .grid-view td:nth-child(2) {
        min-width: 100px;
    }
}
</style>

<div class="bet-view">
    <div class="bets-wrapper">
        <!-- Hero Section -->
        <div class="bets-hero">
            <h3>Match Bets</h3>
            <h1><?= Html::encode($match->getMatchTitle()) ?></h1>
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

        <!-- Bets Table -->
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'No bets placed on this match yet',
            'showFooter' => true,
            'layout' => "{summary}\n{items}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'label' => 'User',
                    'value' => function($model, $index, $dataColumn) {
                        return $model->user->username;
                    }
                ],
                [
                    'attribute' => 'option',
                    'label' => 'Bet On',
                    'value' => function($model, $index, $dataColumn) {
                        return $model->option == 1 ? $model->match->team1->name : $model->match->team2->name;
                    }
                ],
                [
                    'attribute' => 'money',
                    'label' => 'Amount',
                    'format' => 'raw',
                    'value' => function($model, $index, $dataColumn) {
                        return Helper::formatMoney($model->money);
                    }
                ],
                [
                    'attribute' => 'created_time',
                    'label' => 'Bet Time',
                    'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->created_time, "%b %d, %Y %H:%M");
                    }
                ],
                [
                    'label' => 'Result',
                    'format' => 'raw',
                    'value' => function($model, $index, $dataColumn) {
                        switch ($model->getBettedResult()) {
                            case 'WIN':
                                return '<span class="badge badge-pill badge-success">Win</span>';
                            case 'LOSE':
                                return '<span class="badge badge-pill badge-danger">Loss</span>';
                            case 'DRAW':
                                return '<span class="badge badge-pill badge-warning">Draw</span>';
                            default:
                                return '<span class="badge badge-pill badge-secondary">Cancelled</span>';
                        }
                    },
                    'visible' => !is_null($match->result)
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('Delete', $url, [
                                'title' => 'Delete this bet',
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this bet?',
                                    'method' => 'post'
                                ]
                            ]);
                        }
                    ],
                    'headerOptions' => [
                        'width' => '80'
                    ],
                    'visible' => Yii::$app->user->can('admin')
                ],
            ],
        ]); ?>
    </div>
</div>
