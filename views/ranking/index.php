<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
/* Modern Ranking Page */
.bet-index {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .bet-index {
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

/* Hero Section */
.ranking-hero {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.ranking-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 16px 0;
    letter-spacing: -1px;
}

[data-theme="light"] .ranking-hero h1 {
    color: #1a1a1a;
}

.ranking-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
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
    white-space: nowrap;
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

/* Rank Badge */
.grid-view .serial-column {
    width: 60px;
    text-align: center;
    font-weight: 700;
}

/* Username Column */
.grid-view td:nth-child(2) {
    font-weight: 700;
    min-width: 150px;
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

/* Action Column */
.grid-view .action-column {
    width: 60px;
    text-align: center;
}

.grid-view .btn {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}

.grid-view .btn-primary {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.grid-view .btn-primary:hover {
    background: rgba(0, 212, 255, 0.25);
    border-color: #00d4ff;
    color: #ffffff;
}

[data-theme="light"] .grid-view .btn-primary {
    background: rgba(0, 84, 255, 0.12);
    color: #0084ff;
    border-color: rgba(0, 84, 255, 0.25);
}

[data-theme="light"] .grid-view .btn-primary:hover {
    background: rgba(0, 84, 255, 0.2);
    border-color: #0084ff;
}

/* Grid View Footer */
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

/* Empty State */
.grid-view .empty {
    padding: 40px;
    text-align: center;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
}

/* Responsive */
@media (max-width: 1024px) {
    .ranking-wrapper {
        max-width: 100%;
    }

    .grid-view table {
        font-size: 0.85rem;
    }

    .grid-view th,
    .grid-view td {
        padding: 12px 10px;
    }
}

@media (max-width: 768px) {
    .bet-index {
        padding: 20px 16px;
    }

    .ranking-hero {
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .ranking-hero h1 {
        font-size: 2rem;
    }

    .ranking-hero p {
        font-size: 0.95rem;
    }

    .grid-view table {
        font-size: 0.8rem;
    }

    .grid-view th,
    .grid-view td {
        padding: 10px 8px;
    }

    .grid-view .serial-column {
        width: 50px;
    }

    .grid-view td:nth-child(2) {
        min-width: 120px;
    }
}

@media (max-width: 480px) {
    .bet-index {
        padding: 16px 12px;
    }

    .ranking-hero h1 {
        font-size: 1.6rem;
    }

    .grid-view table {
        font-size: 0.75rem;
    }

    .grid-view th,
    .grid-view td {
        padding: 8px 6px;
    }

    .grid-view .serial-column {
        width: 40px;
    }

    .grid-view td:nth-child(2) {
        min-width: 100px;
    }

    .grid-view .badge {
        padding: 4px 10px;
        font-size: 0.7rem;
    }

    .grid-view .btn {
        padding: 5px 8px;
        font-size: 0.75rem;
    }
}
</style>

<div class="bet-index">
    <div class="ranking-wrapper">
        <!-- Hero Section -->
        <div class="ranking-hero">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Live leaderboard showing all players' performance and statistics</p>
        </div>

        <!-- Ranking Table -->
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => '📊 No ranking data available',
            'showFooter' => true,
            'layout' => "{summary}\n{items}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'username',
                    'label' => 'User',
                ],
                [
                    'label' => 'Total',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if($model['total_money'] != NULL){
                            $formatted = Helper::formatMoney($model['total_money']);
                            if($model['total_money'] <= 0){
                                return '<span class="badge badge-pill badge-danger">'.$formatted.'</span>';
                            } else {
                                return '<span class="badge badge-pill badge-success">'.$formatted.'</span>';
                            }
                        }
                    }
                ],
                [
                    'label' => 'Placed',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Helper::formatMoney($model['bet_money'] ?? 0);
                    }
                ],
                [
                    'label' => 'Available',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Helper::formatMoney($model['money'] ?? 0);
                    }
                ],
                [
                    'label' => 'Bet',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if($model['bet_times'] != NULL){
                            if($model['bet_times'] < Yii::$app->params['minBetTimes']){
                                return '<span class="badge badge-pill badge-danger">'.$model['bet_times'].'</span>';
                            } else {
                                return '<span class="badge badge-pill badge-success">'.$model['bet_times'].'</span>';
                            }
                        }
                    }
                ],
                [
                    'attribute' => 'win_times',
                    'label' => 'Win',
                ],
                [
                    'attribute' => 'win_rate',
                    'label' => 'Rate',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $hide_history == 0 ? '{view}' : "",
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-share-alt"></span>', array('/ranking/view', 'username' => $model['username']), [
                                'title' => 'View detailed info',
                                'data-id' => $model['username'],
                                'class' => 'btn btn-primary',
                            ]);
                        },
                    ]
                ],
            ],
        ]);
        ?>
    </div>
</div>
