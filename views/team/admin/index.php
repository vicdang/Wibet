<?php

use yii\helpers\Html;
use app\models\Team;

/**
 * @var yii\web\View $this
 * @var app\models\TeamSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Team Management';
?>

<style>
.team-management-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .team-management-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.teams-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

.teams-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.teams-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .teams-hero h1 {
    color: #1a1a1a;
}

.teams-hero p {
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

/* Teams Grid */
.teams-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

/* Team Card */
.team-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.team-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-3px);
}

[data-theme="light"] .team-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .team-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

/* Card Header */
.card-header {
    background: rgba(0, 212, 255, 0.06);
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}

[data-theme="light"] .card-header {
    background: rgba(0, 84, 255, 0.03);
}

.team-flag {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    flex-shrink: 0;
}

.team-flag-placeholder {
    width: 48px;
    height: 48px;
    background: rgba(0, 212, 255, 0.1);
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    flex-shrink: 0;
}

[data-theme="light"] .team-flag,
[data-theme="light"] .team-flag-placeholder {
    border-color: rgba(0, 0, 0, 0.12);
}

.header-info {
    flex: 1;
}

.team-name {
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0 0 6px 0;
}

.team-fullname {
    font-size: 0.8rem;
    color: rgba(232, 234, 240, 0.6);
    margin: 0;
}

[data-theme="light"] .team-fullname {
    color: rgba(0, 0, 0, 0.6);
}

/* Card Body */
.card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.team-info-row {
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

/* Group Badge */
.group-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
}

[data-theme="light"] .group-badge {
    background: rgba(0, 84, 255, 0.12);
    color: #0084ff;
}

/* Card Footer */
.card-footer {
    border-top: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
    padding: 14px 20px;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

[data-theme="light"] .card-footer {
    border-top-color: rgba(0, 0, 0, 0.06);
}

/* Action Buttons */
.action-btn {
    flex: 1;
    min-width: 70px;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    text-decoration: none !important;
    text-align: center;
    border: 1px solid;
    transition: all 0.2s ease;
    cursor: pointer;
}

.action-btn.primary {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border-color: rgba(0, 212, 255, 0.3);
}

.action-btn.primary:hover {
    background: rgba(0, 212, 255, 0.25);
    border-color: #00d4ff;
    text-decoration: none !important;
}

.action-btn.danger {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    border-color: rgba(244, 67, 54, 0.3);
}

.action-btn.danger:hover {
    background: rgba(244, 67, 54, 0.25);
    border-color: #ff7043;
    text-decoration: none !important;
}

/* Empty State */
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

[data-theme="light"] .filters-section {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
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
    padding: 10px 14px;
    background: rgba(0, 212, 255, 0.05);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 6px;
    color: #e8eaf0;
    font-size: 0.9rem;
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
    .teams-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .team-management-page {
        padding: 20px 16px;
    }

    .teams-hero {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .teams-hero h1 {
        font-size: 2rem;
    }

    .teams-grid {
        grid-template-columns: 1fr;
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
}
</style>

<div class="team-management-page">
    <div class="teams-wrapper">
        <!-- Hero Section -->
        <div class="teams-hero">
            <div>
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <?= Html::a('Create New Team', ['admin-create'], ['class' => 'btn-create']) ?>
        </div>

        <!-- Filter Toggle Button -->
        <button type="button" class="filter-toggle-btn" id="filter-toggle" onclick="toggleFilters()">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>

        <!-- Filters Section -->
        <?php
        $teamSearchParams = Yii::$app->request->get('TeamSearch', []);
        $hasActiveFilters = !empty($teamSearchParams['name']) || !empty($teamSearchParams['full_name']) || !empty($teamSearchParams['group_name']);
        $collapsedClass = $hasActiveFilters ? '' : 'collapsed';
        ?>
        <form method="GET" action="<?= Yii::$app->urlManager->createUrl(['team/admin-index']) ?>" class="filters-section <?= $collapsedClass ?>" id="team-filter-form">
            <div class="filter-group">
                <label class="filter-label">Team Name</label>
                <input type="text" name="TeamSearch[name]" class="filter-input" placeholder="Search name..." value="<?= Html::encode(Yii::$app->request->get('TeamSearch')['name'] ?? '') ?>" onchange="submitFilters('team-filter-form')">
            </div>

            <div class="filter-group">
                <label class="filter-label">Full Name</label>
                <input type="text" name="TeamSearch[full_name]" class="filter-input" placeholder="Search full name..." value="<?= Html::encode(Yii::$app->request->get('TeamSearch')['full_name'] ?? '') ?>" onchange="submitFilters('team-filter-form')">
            </div>

            <div class="filter-group">
                <label class="filter-label">Group</label>
                <select name="TeamSearch[group_name]" class="filter-select" onchange="submitFilters('team-filter-form')">
                    <option value="">All Groups</option>
                    <?php foreach (Team::groupDropdown() as $value => $label): ?>
                        <option value="<?= Html::encode($value) ?>" <?= (Yii::$app->request->get('TeamSearch')['group_name'] ?? '') === $value ? 'selected' : '' ?>>
                            <?= Html::encode($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-actions">
                <button type="button" class="btn-filter" onclick="resetFilters('<?= Yii::$app->urlManager->createUrl(['team/admin-index']) ?>')" title="Clear filters">
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

        function submitFilters(formId) {
            document.getElementById(formId).submit();
        }

        function resetFilters(url) {
            window.location = url;
        }
        </script>

        <!-- Teams Grid -->
        <div class="teams-grid">
            <?php
            $teams = $dataProvider->getModels();
            if (empty($teams)):
            ?>
                <div class="empty-state">
                    <div class="empty-icon">⚽</div>
                    <p>No teams found</p>
                </div>
            <?php
            else:
                foreach ($teams as $team):
                    $flagUrl = $team->getFlagUrl();
            ?>
            <div class="team-card">
                <!-- Header -->
                <div class="card-header">
                    <div>
                        <?php if ($flagUrl): ?>
                            <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($team->name) ?>" class="team-flag">
                        <?php elseif ($team->isPlayoffTeam()): ?>
                            <img src="/logo.png" alt="Playoff" class="team-flag">
                        <?php else: ?>
                            <div class="team-flag-placeholder"></div>
                        <?php endif; ?>
                    </div>
                    <div class="header-info">
                        <p class="team-name"><?= Html::encode($team->name) ?></p>
                        <p class="team-fullname"><?= Html::encode($team->full_name) ?></p>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="team-info-row">
                        <span class="info-label">Group</span>
                        <span class="group-badge"><?= Html::encode($team->group_name) ?></span>
                    </div>

                    <?php $stats = $team->getStandings(); ?>
                    <div class="team-info-row">
                        <span class="info-label">Matches</span>
                        <span class="info-value"><?= $stats['mp'] ?></span>
                    </div>

                    <div class="team-info-row">
                        <span class="info-label">Record</span>
                        <span class="info-value"><?= $stats['w'] ?>-<?= $stats['d'] ?>-<?= $stats['l'] ?></span>
                    </div>

                    <div class="team-info-row">
                        <span class="info-label">Points</span>
                        <span class="info-value"><?= $stats['pts'] ?></span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer">
                    <?= Html::a('Edit', ['admin-update', 'id' => $team->id], ['class' => 'action-btn primary']) ?>
                    <?= Html::a('Delete', ['admin-delete', 'id' => $team->id], ['class' => 'action-btn danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']) ?>
                </div>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>
