<?php

use app\assets\Helper;
use yii\helpers\Html;
use \app\models\Bet;
use \app\models\GameMatch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MatchSearch $searchModel
 */

$this->title = 'Matches';

// Get total match count
$totalMatches = GameMatch::find()->count();
?>

<style>
/* Modern Matches Card View */
.match-index {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .match-index {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.matches-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

/* Hero Section */
.matches-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.matches-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .matches-hero h1 {
    color: #1a1a1a;
}

.matches-hero p {
    font-size: 0.9rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
}

.btn-create {
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

.btn-create:hover {
    background: rgba(0, 212, 255, 0.1);
    box-shadow: 0 0 15px rgba(0, 212, 255, 0.3);
    text-decoration: none;
}

[data-theme="light"] .btn-create {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-create:hover {
    background: rgba(0, 132, 255, 0.1);
    box-shadow: 0 0 15px rgba(0, 132, 255, 0.2);
}

/* Cards Grid */
.matches-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

/* Match Card */
.match-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    position: relative;
}

.match-card.is-greyed {
    filter: grayscale(60%);
    opacity: 0.7;
    border-color: rgba(100, 100, 120, 0.4);
}

[data-theme="light"] .match-card.is-greyed {
    filter: grayscale(50%);
    opacity: 0.75;
    border-color: rgba(150, 150, 170, 0.4);
}

.match-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-3px);
}

.match-card.hidden:hover {
    filter: grayscale(50%);
    border-color: rgba(100, 100, 120, 0.3);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .match-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .match-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

/* Card Header with Date */
.card-header {
    background: rgba(0, 212, 255, 0.06);
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    padding: 12px 18px;
    text-align: center;
    font-size: 0.75rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    transition: all 0.3s ease;
}

[data-theme="light"] .card-header {
    background: rgba(0, 84, 255, 0.03);
}

/* Scored Match Header - Green/Gold */
.match-card.scored .card-header {
    background: rgba(76, 175, 80, 0.1);
    border-bottom-color: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

[data-theme="light"] .match-card.scored .card-header {
    background: rgba(76, 175, 80, 0.08);
    border-bottom-color: rgba(76, 175, 80, 0.15);
    color: #2e7d32;
}

/* Cancelled Match Header - Red */
.match-card.cancelled .card-header {
    background: rgba(244, 67, 54, 0.1);
    border-bottom-color: rgba(244, 67, 54, 0.2);
    color: #ff7043;
}

[data-theme="light"] .match-card.cancelled .card-header {
    background: rgba(244, 67, 54, 0.08);
    border-bottom-color: rgba(244, 67, 54, 0.15);
    color: #c62828;
}

/* Card Body */
.card-body {
    padding: 20px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Match Info */
.match-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.team {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    flex: 1;
    text-align: center;
}

.team-flag {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
}

.team-name {
    font-size: 0.8rem;
    font-weight: 700;
    line-height: 1.2;
}

.score {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    min-width: 50px;
}

.score-value {
    font-size: 1.8rem;
    font-weight: 800;
    color: #00d4ff;
}

[data-theme="light"] .score-value {
    color: #0084ff;
}

.score-status {
    font-size: 0.65rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    text-transform: uppercase;
    letter-spacing: 0.3px;
    font-weight: 600;
}

/* Bet Info */
.bet-info {
    background: rgba(0, 212, 255, 0.04);
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    font-size: 0.8rem;
}

[data-theme="light"] .bet-info {
    background: rgba(0, 84, 255, 0.03);
}

/* Match Stats Section */
.match-stats {
    background: rgba(0, 212, 255, 0.04);
    padding: 12px;
    border-radius: 8px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
    font-size: 0.75rem;
}

[data-theme="light"] .match-stats {
    background: rgba(0, 84, 255, 0.03);
}

.bet-option {
    font-weight: 700;
    color: #81c784;
    margin-bottom: 2px;
}

.bet-amount {
    font-size: 0.7rem;
    color: #fdd835;
    font-weight: 600;
}

/* Card Footer */
.card-footer {
    border-top: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
    padding: 12px 18px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

[data-theme="light"] .card-footer {
    border-top-color: rgba(0, 0, 0, 0.06);
}

/* Action Buttons */
.action-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.action-btn {
    flex: 1;
    min-width: 70px;
    padding: 7px 10px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    border: 1px solid;
    transition: all 0.2s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.action-btn.primary {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border-color: rgba(0, 212, 255, 0.3);
}

.action-btn.primary:hover {
    background: rgba(0, 212, 255, 0.25);
    border-color: #00d4ff;
}

.action-btn.success {
    background: rgba(76, 175, 80, 0.15);
    color: #81c784;
    border-color: rgba(76, 175, 80, 0.3);
}

.action-btn.success:hover {
    background: rgba(76, 175, 80, 0.25);
    border-color: #81c784;
}

.action-btn.danger {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    border-color: rgba(244, 67, 54, 0.3);
}

.action-btn.danger:hover {
    background: rgba(244, 67, 54, 0.25);
    border-color: #ff7043;
}

.action-btn.warning {
    background: rgba(255, 193, 7, 0.15);
    color: #fdd835;
    border-color: rgba(255, 193, 7, 0.3);
}

.action-btn.warning:hover {
    background: rgba(255, 193, 7, 0.25);
    border-color: #fdd835;
}

/* Admin Actions Dropdown */
.admin-menu {
    position: relative;
    display: inline-block;
    width: 100%;
}

.admin-btn {
    width: 100%;
    padding: 7px 10px;
    background: rgba(123, 47, 255, 0.15);
    color: #b39ddb;
    border: 1px solid rgba(123, 47, 255, 0.3);
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.admin-btn:hover {
    background: rgba(123, 47, 255, 0.25);
    border-color: #b39ddb;
}

.admin-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 8px;
    margin-top: 4px;
    min-width: 160px;
    z-index: 1000;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.admin-menu:hover .admin-dropdown {
    display: flex;
    flex-direction: column;
}

.admin-item {
    padding: 8px 12px;
    text-decoration: none;
    color: inherit;
    font-size: 0.75rem;
    font-weight: 600;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
    transition: all 0.2s ease;
    cursor: pointer;
    display: block;
}

.admin-item:last-child {
    border-bottom: none;
}

.admin-item:hover {
    background: rgba(0, 212, 255, 0.08);
}

.admin-item.success {
    color: #81c784;
}

.admin-item.success:hover {
    background: rgba(76, 175, 80, 0.1);
}

.admin-item.warning {
    color: #fdd835;
}

.admin-item.warning:hover {
    background: rgba(255, 193, 7, 0.1);
}

.admin-item.danger {
    color: #ff7043;
}

.admin-item.danger:hover {
    background: rgba(244, 67, 54, 0.1);
}

.admin-item.info {
    color: #64b5f6;
}

.admin-item.info:hover {
    background: rgba(33, 150, 243, 0.1);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
}

/* Custom Modal */
.confirm-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.confirm-modal.active {
    display: flex;
}

.confirm-modal-content {
    background: rgba(20, 25, 50, 0.95);
    border: 2px solid rgba(0, 212, 255, 0.3);
    border-radius: 12px;
    padding: 32px;
    max-width: 400px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    animation: slideUp 0.3s ease;
    color: #e8eaf0;
}

[data-theme="light"] .confirm-modal-content {
    background: #ffffff;
    border-color: rgba(31, 115, 230, 0.3);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.confirm-modal-title {
    font-size: 1.3rem;
    font-weight: 800;
    margin: 0 0 12px 0;
    color: #00d4ff;
}

[data-theme="light"] .confirm-modal-title {
    color: #0084ff;
}

.confirm-modal-message {
    font-size: 0.95rem;
    color: rgba(232, 234, 240, 0.8);
    margin: 0 0 28px 0;
    line-height: 1.5;
}

[data-theme="light"] .confirm-modal-message {
    color: rgba(0, 0, 0, 0.7);
}

.confirm-modal-buttons {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.confirm-modal-btn {
    padding: 10px 24px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    border: 1px solid;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.confirm-modal-btn.cancel {
    background: rgba(100, 100, 120, 0.3);
    color: rgba(232, 234, 240, 0.9);
    border-color: rgba(0, 212, 255, 0.3);
}

.confirm-modal-btn.cancel:hover {
    background: rgba(100, 100, 120, 0.5);
    border-color: rgba(0, 212, 255, 0.5);
}

[data-theme="light"] .confirm-modal-btn.cancel {
    background: rgba(0, 0, 0, 0.08);
    color: rgba(0, 0, 0, 0.8);
    border-color: rgba(0, 0, 0, 0.15);
}

[data-theme="light"] .confirm-modal-btn.cancel:hover {
    background: rgba(0, 0, 0, 0.12);
    border-color: rgba(0, 0, 0, 0.2);
}

.confirm-modal-btn.confirm {
    background: linear-gradient(135deg, #ff7043 0%, #d32f2f 100%);
    color: white;
    border-color: transparent;
}

.confirm-modal-btn.confirm:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
}

/* Responsive */
/* Filter Toggle Button */
.filter-toggle-btn {
    background: transparent;
    border: 2px solid #00d4ff;
    color: #00d4ff;
    padding: 10px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    margin-left: auto;
}

.filter-toggle-btn:hover {
    background: rgba(0, 212, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
}

.filter-toggle-btn.active {
    background: rgba(0, 212, 255, 0.15);
    border-color: #00d4ff;
}

[data-theme="light"] .filter-toggle-btn {
    border-color: #0084ff;
    color: #0084ff;
}

[data-theme="light"] .filter-toggle-btn:hover {
    background: rgba(0, 84, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 84, 255, 0.2);
}

/* Filters Section */
.filters-section {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 40px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
    max-height: 500px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.filters-section.collapsed {
    max-height: 0;
    padding: 0;
    margin-bottom: 0;
    border: none;
    opacity: 0;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.filter-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: rgba(232, 234, 240, 0.7);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

[data-theme="light"] .filter-label {
    color: rgba(0, 0, 0, 0.65);
}

.filter-input,
.filter-select {
    box-sizing: border-box;
    height: 42px;
    padding: 10px 14px;
    background: rgba(0, 212, 255, 0.05);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 6px;
    color: #e8eaf0;
    font-size: 0.9rem;
    line-height: 1.2;
    transition: all 0.3s ease;
    min-width: 180px;
}

.filter-select {
    cursor: pointer;
}

.filter-input:focus,
.filter-select:focus {
    background: rgba(0, 212, 255, 0.1);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2);
    outline: none;
}

input[type="date"].filter-input {
    color-scheme: dark;
}

[data-theme="light"] input[type="date"].filter-input {
    color-scheme: light;
}

[data-theme="light"] .filter-input,
[data-theme="light"] .filter-select {
    background: rgba(0, 84, 255, 0.03);
    border-color: rgba(0, 84, 255, 0.2);
    color: #1a1a1a;
}

[data-theme="light"] .filter-input:focus,
[data-theme="light"] .filter-select:focus {
    background: rgba(0, 84, 255, 0.08);
    border-color: rgba(0, 84, 255, 0.5);
    box-shadow: 0 0 10px rgba(0, 84, 255, 0.15);
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.btn-filter {
    padding: 10px 16px;
    background: transparent;
    color: #00d4ff;
    border: 2px solid #00d4ff;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-filter:hover {
    background: rgba(0, 212, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
}

.btn-filter.search-btn {
    padding: 10px 12px;
    font-size: 1rem;
}

[data-theme="light"] .btn-filter {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-filter:hover {
    background: rgba(0, 84, 255, 0.1);
    box-shadow: 0 0 10px rgba(0, 84, 255, 0.2);
}

@media (max-width: 1024px) {
    .matches-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .match-index {
        padding: 20px 16px;
    }

    .matches-hero {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .matches-hero h1 {
        font-size: 2rem;
    }

    .filters-section {
        flex-direction: column;
        width: 100%;
    }

    .filter-group,
    .filter-input,
    .filter-select {
        width: 100%;
        min-width: unset;
    }

    .filter-actions {
        width: 100%;
    }

    .btn-filter {
        flex: 1;
    }

    .matches-grid {
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }

    .card-body {
        padding: 16px;
        gap: 12px;
    }

    .score-value {
        font-size: 1.6rem;
    }

    .team-flag {
        width: 44px;
        height: 44px;
    }

    .team-name {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .match-index {
        padding: 16px 12px;
    }

    .matches-hero h1 {
        font-size: 1.5rem;
    }

    .matches-grid {
        grid-template-columns: 1fr;
    }

    .score-value {
        font-size: 1.4rem;
    }

    .team-flag {
        width: 40px;
        height: 40px;
    }

    .action-btn {
        min-width: 60px;
        padding: 6px 8px;
        font-size: 0.65rem;
    }
}
</style>

<div class="match-index">
    <div class="matches-wrapper">
        <!-- Hero Section -->
        <div class="matches-hero">
            <div>
                <h1><?= Html::encode($this->title) ?></h1>
                <p><?= $totalMatches ?> <?= $totalMatches == 1 ? 'match' : 'matches' ?> in system</p>
            </div>
            <?php if (Yii::$app->user->can('admin')) : ?>
                <?= Html::a('Create Match', ['create'], ['class' => 'btn-create']) ?>
            <?php endif; ?>
        </div>

        <!-- Filter Toggle Button -->
        <button type="button" class="filter-toggle-btn" id="filter-toggle" onclick="toggleFilters()">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>

        <!-- Filters Section -->
        <?php
        use app\models\Team;

        $isAdminUser = Yii::$app->user->can('admin');
        $hasActiveFilters = !empty(Yii::$app->request->get('team_id')) || !empty(Yii::$app->request->get('match_status')) || !empty(Yii::$app->request->get('your_bet')) || !empty(Yii::$app->request->get('match_day')) || (!$isAdminUser && Yii::$app->request->get('visible') !== null);
        $collapsedClass = $hasActiveFilters ? '' : 'collapsed';

        // Get all teams for dropdown
        $teams = Team::find()->orderBy(['name' => SORT_ASC])->all();
        $teamOptions = ['All Teams'];
        foreach ($teams as $team) {
            $teamOptions[$team->id] = $team->name;
        }
        ?>
        <form method="GET" action="<?= Yii::$app->urlManager->createUrl(['match/index']) ?>" class="filters-section <?= $collapsedClass ?>" id="match-filter-form">
            <div class="filter-group">
                <label class="filter-label">Team</label>
                <select name="team_id" class="filter-select" onchange="submitFilters()">
                    <option value="">All Teams</option>
                    <?php foreach ($teams as $team): ?>
                        <option value="<?= $team->id ?>" <?= (Yii::$app->request->get('team_id') ?? '') == $team->id ? 'selected' : '' ?>>
                            <?= Html::encode($team->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select name="match_status" class="filter-select" onchange="submitFilters()">
                    <option value="">All Status</option>
                    <option value="ongoing" <?= (Yii::$app->request->get('match_status') ?? '') === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                    <option value="finished" <?= (Yii::$app->request->get('match_status') ?? '') === 'finished' ? 'selected' : '' ?>>Finished</option>
                    <option value="withdrawn" <?= (Yii::$app->request->get('match_status') ?? '') === 'withdrawn' ? 'selected' : '' ?>>Withdrawn</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Day</label>
                <input type="date" name="match_day" class="filter-input" value="<?= Html::encode(Yii::$app->request->get('match_day') ?? '') ?>" onchange="submitFilters()">
            </div>

            <div class="filter-group">
                <label class="filter-label">Your Prediction</label>
                <select name="your_bet" class="filter-select" onchange="submitFilters()">
                    <option value="">All</option>
                    <option value="placed" <?= (Yii::$app->request->get('your_bet') ?? '') === 'placed' ? 'selected' : '' ?>>Placed</option>
                    <option value="won" <?= (Yii::$app->request->get('your_bet') ?? '') === 'won' ? 'selected' : '' ?>>Won</option>
                    <option value="lost" <?= (Yii::$app->request->get('your_bet') ?? '') === 'lost' ? 'selected' : '' ?>>Lost</option>
                </select>
            </div>

            <?php if ($isAdminUser): ?>
            <div class="filter-group">
                <label class="filter-label">Card Visibility</label>
                <select name="visible" class="filter-select" onchange="submitFilters()">
                    <option value="">All Cards</option>
                    <option value="1" <?= (Yii::$app->request->get('visible') ?? '') === '1' ? 'selected' : '' ?>>Visible</option>
                    <option value="0" <?= (Yii::$app->request->get('visible') ?? '') === '0' ? 'selected' : '' ?>>Hidden</option>
                </select>
            </div>
            <?php endif; ?>

            <div class="filter-actions">
                <button type="button" class="btn-filter" onclick="resetFilters()" title="Clear filters">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div>
        </form>

        <script>
        function toggleFilters() {
            const filtersSection = document.querySelector('.filters-section');
            const toggleBtn = document.getElementById('filter-toggle');

            filtersSection.classList.toggle('collapsed');
            toggleBtn.classList.toggle('active');
        }

        function submitFilters() {
            document.getElementById('match-filter-form').submit();
        }

        function resetFilters() {
            window.location = '<?= Yii::$app->urlManager->createUrl(['match/index']) ?>';
        }
        </script>

        <!-- Matches Grid -->
        <div class="matches-grid">
            <?php
            $matches = $dataProvider->getModels();
            if (empty($matches)):
            ?>
                <div class="empty-state">No matches available</div>
            <?php
            else:
                foreach ($matches as $model):
                    $bet = Bet::isExist(Yii::$app->user->id, $model->id);
                    $team1_flag = $model->team1 ? ($model->team1->getFlagUrl() ?: ($model->team1->isPlayoffTeam() ? '/logo.png' : null)) : null;
                    $team2_flag = $model->team2 ? ($model->team2->getFlagUrl() ?: ($model->team2->isPlayoffTeam() ? '/logo.png' : null)) : null;
                    $team1_name = $model->team1 ? Html::encode($model->team1->name) : 'Unknown';
                    $team2_name = $model->team2 ? Html::encode($model->team2->name) : 'Unknown';
            ?>
            <div class="match-card <?= $model->visible == 0 ? 'is-greyed' : '' ?> <?= ($model->team_1_score !== null && $model->team_2_score !== null) ? ($model->result == 3 ? 'cancelled' : 'scored') : '' ?>" data-match-id="<?= $model->id ?>">
                <!-- Date Header -->
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                        <span><?= Helper::printDatetime($model->match_date, "%b %d, %Y %H:%M") ?></span>
                        <div style="display: flex; gap: 6px;">
                            <?php if ($model->visible == 0): ?>
                                <span style="background: rgba(255, 193, 7, 0.3); color: #fdd835; padding: 3px 8px; border-radius: 3px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px;">Hidden</span>
                            <?php endif; ?>
                            <?php if ($model->result === null): ?>
                                <span style="background: rgba(0, 212, 255, 0.3); color: #00d4ff; padding: 3px 8px; border-radius: 3px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; text-shadow: 0 0 8px rgba(0, 212, 255, 0.5);">Ongoing</span>
                            <?php elseif ($model->result == 3): ?>
                                <span style="background: rgba(244, 67, 54, 0.3); color: #ff7043; padding: 3px 8px; border-radius: 3px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px;">Withdrawn</span>
                            <?php else: ?>
                                <span style="background: rgba(76, 175, 80, 0.3); color: #81c784; padding: 3px 8px; border-radius: 3px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px;">Finished</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Match Info Body -->
                <div class="card-body">
                    <div class="match-info">
                        <!-- Team 1 -->
                        <div class="team">
                            <?php if ($team1_flag): ?>
                                <img src="<?= Html::encode($team1_flag) ?>" alt="<?= $team1_name ?>" class="team-flag">
                            <?php else: ?>
                                <div class="team-flag" style="background: rgba(0, 212, 255, 0.1);"></div>
                            <?php endif; ?>
                            <div class="team-name"><?= $team1_name ?></div>
                        </div>

                        <!-- Score -->
                        <div class="score">
                            <div class="score-value"><?= $model->team_1_score ?? '-' ?> : <?= $model->team_2_score ?? '-' ?></div>
                            <div class="score-status">
                                <?php if ($model->result !== null): ?>
                                    <?= $model->result == 3 ? 'Cancelled' : 'Final' ?>
                                <?php else: ?>
                                    Pending
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Team 2 -->
                        <div class="team">
                            <?php if ($team2_flag): ?>
                                <img src="<?= Html::encode($team2_flag) ?>" alt="<?= $team2_name ?>" class="team-flag">
                            <?php else: ?>
                                <div class="team-flag" style="background: rgba(0, 212, 255, 0.1);"></div>
                            <?php endif; ?>
                            <div class="team-name"><?= $team2_name ?></div>
                        </div>
                    </div>

                    <!-- Match Stats: Total Bets & Handicap -->
                    <div class="match-stats">
                        <div style="text-align: center;">
                            <div style="color: #81c784; font-weight: 700; font-size: 1rem;"><?= Helper::formatMoney($model->getBetMoneyByTeam(1) ?? 0) ?></div>
                            <?php if ($bet && $bet->option == 1): ?>
                                <div style="color: #fdd835; font-weight: 600; font-size: 0.8rem; margin-top: 2px;">You: <?= Helper::formatMoney($bet->money) ?></div>
                            <?php endif; ?>
                        </div>
                        <div style="text-align: center; border-left: 1px solid rgba(0, 212, 255, 0.1); border-right: 1px solid rgba(0, 212, 255, 0.1);">
                            <div style="color: #00d4ff; font-weight: 700; font-size: 1rem;"><?= $model->getRateText() ?></div>
                        </div>
                        <div style="text-align: center;">
                            <div style="color: #81c784; font-weight: 700; font-size: 1rem;"><?= Helper::formatMoney($model->getBetMoneyByTeam(2) ?? 0) ?></div>
                            <?php if ($bet && $bet->option == 2): ?>
                                <div style="color: #fdd835; font-weight: 600; font-size: 0.8rem; margin-top: 2px;">You: <?= Helper::formatMoney($bet->money) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card-footer">
                    <!-- Line 1: Betting Actions -->
                    <div class="action-row">
                        <?php if ($model->visible == 0): ?>
                            <span style="font-size: 0.7rem; color: var(--text-secondary, rgba(232, 234, 240, 0.5)); padding: 7px 10px;">Match Hidden</span>
                        <?php elseif ($bet && $model->result !== 3): ?>
                            <?= Html::a('Update', ['bet/update', 'id' => $bet->id], ['class' => 'action-btn primary']) ?>
                            <?= Html::a('Delete', ['bet/delete', 'id' => $bet->id], ['class' => 'action-btn danger', 'data' => ['confirm' => 'Are you sure?', 'method'=>'post']]) ?>
                        <?php elseif ($model->canBet()): ?>
                            <?= Html::a('Predict', ['bet/create', 'match_id' => $model->id], ['class' => 'action-btn success']) ?>
                        <?php else: ?>
                            <span style="font-size: 0.7rem; color: var(--text-secondary, rgba(232, 234, 240, 0.5)); padding: 7px 10px;">Predictions Closed</span>
                        <?php endif; ?>
                        <?= Html::a('Details', ['view', 'id' => $model->id], ['class' => 'action-btn primary']) ?>
                        <?php if ($hide_history == 0 || Yii::$app->user->can('admin')): ?>
                            <?= Html::a('Predictions', ['bet/view', 'match_id' => $model->id], ['class' => 'action-btn info']) ?>
                        <?php endif; ?>
                    </div>

                    <!-- Line 2: Admin Actions -->
                    <?php if (Yii::$app->user->can('admin')): ?>
                        <div class="action-row" style="border-top: 1px solid var(--border-color, rgba(0, 212, 255, 0.08)); padding-top: 10px;">
                            <?php if ($model->canUpdate()): ?>
                                <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'action-btn primary']) ?>
                                <?= Html::a('Score', ['update-score', 'id' => $model->id], ['class' => 'action-btn success']) ?>
                            <?php endif; ?>

                            <?php if ($model->visible == 1): ?>
                                <?= Html::a('Hide', ['set-visible', 'value' => 0, 'id' => $model->id], ['class' => 'action-btn warning']) ?>
                            <?php else: ?>
                                <?= Html::a('Show', ['set-visible', 'value' => 1, 'id' => $model->id], ['class' => 'action-btn info']) ?>
                            <?php endif; ?>

                            <?php if ($model->result === null): ?>
                                <?= Html::a('Withdraw', '#', ['class' => 'action-btn danger', 'data-action' => 'withdraw', 'data-id' => $model->id, 'onclick' => 'return false;']) ?>
                            <?php endif; ?>

                            <?= Html::a('Delete', '#', ['class' => 'action-btn danger', 'data-action' => 'delete', 'data-id' => $model->id, 'onclick' => 'return false;']) ?>
                        </div>
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

<!-- Custom Confirmation Modal -->
<div class="confirm-modal" id="confirmModal">
    <div class="confirm-modal-content">
        <h2 class="confirm-modal-title" id="modalTitle">Confirm Action</h2>
        <p class="confirm-modal-message" id="modalMessage">Are you sure?</p>
        <div class="confirm-modal-buttons">
            <button class="confirm-modal-btn cancel" id="cancelBtn">Cancel</button>
            <button class="confirm-modal-btn confirm" id="confirmBtn">Confirm</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('confirmModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    let pendingAction = null;

    // Action configurations
    const actions = {
        withdraw: {
            title: 'Withdraw Match',
            message: 'This action will affect all related bets. Are you sure you want to withdraw this match?'
        },
        delete: {
            title: 'Delete Match',
            message: 'Are you sure you want to delete this match? This action cannot be undone.'
        }
    };

    // Handle Withdraw and Delete button clicks
    document.addEventListener('click', function(e) {
        const actionBtn = e.target.closest('[data-action]');
        if (!actionBtn) return;

        e.preventDefault();
        const action = actionBtn.getAttribute('data-action');
        const id = actionBtn.getAttribute('data-id');

        if (!actions[action]) return;

        // Show modal
        modalTitle.textContent = actions[action].title;
        modalMessage.textContent = actions[action].message;
        modal.classList.add('active');

        // Store pending action
        pendingAction = { action, id };
    });

    // Cancel button
    cancelBtn.addEventListener('click', function() {
        modal.classList.remove('active');
        pendingAction = null;
    });

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        if (!pendingAction) return;

        const { action, id } = pendingAction;

        if (action === 'withdraw') {
            // Submit form for POST request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/match/cancel?id=' + id;
            document.body.appendChild(form);
            form.submit();
        } else if (action === 'delete') {
            // Submit form for DELETE request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/match/delete?id=' + id;
            document.body.appendChild(form);
            form.submit();
        }

        modal.classList.remove('active');
        pendingAction = null;
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('active');
            pendingAction = null;
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modal.classList.remove('active');
            pendingAction = null;
        }
    });
});
</script>
