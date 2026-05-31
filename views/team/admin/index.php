<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Team;

/**
 * @var yii\web\View $this
 * @var app\models\TeamSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Team Management';
?>

<style>
.team-admin-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .team-admin-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
}

.team-admin-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
    flex-wrap: wrap;
}

[data-theme="light"] .admin-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.admin-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .admin-header h1 {
    color: #1a1a1a;
}

.btn-create {
    padding: 12px 24px;
    background: #00d4ff;
    color: #0a0e1a;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
    font-size: 0.95rem;
}

.btn-create:hover {
    background: #00b8d4;
    box-shadow: 0 0 15px rgba(0, 212, 255, 0.4);
}

[data-theme="light"] .btn-create {
    background: #0084ff;
    color: #ffffff;
}

[data-theme="light"] .btn-create:hover {
    background: #0066cc;
    box-shadow: 0 0 15px rgba(0, 132, 255, 0.3);
}

.filter-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 30px;
}

[data-theme="light"] .filter-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 16px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-label {
    font-size: 0.9rem;
    font-weight: 500;
    color: #e8eaf0;
}

[data-theme="light"] .filter-label {
    color: #2a2a2a;
}

.filter-input {
    padding: 10px 12px;
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 6px;
    background: rgba(0, 0, 0, 0.2);
    color: #e8eaf0;
    font-size: 0.95rem;
}

[data-theme="light"] .filter-input {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

.filter-input:focus {
    outline: none;
    border-color: #00d4ff;
}

.filter-buttons {
    display: flex;
    gap: 12px;
}

.btn-filter {
    padding: 10px 20px;
    background: rgba(0, 212, 255, 0.1);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 6px;
    color: #00d4ff;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter:hover {
    background: rgba(0, 212, 255, 0.2);
}

.btn-filter-reset {
    padding: 10px 20px;
    background: transparent;
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 6px;
    color: rgba(232, 234, 240, 0.7);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter-reset:hover {
    border-color: rgba(0, 212, 255, 0.5);
}

.teams-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.teams-table thead {
    background: rgba(0, 212, 255, 0.05);
}

[data-theme="light"] .teams-table thead {
    background: rgba(0, 84, 255, 0.05);
}

.teams-table th {
    padding: 16px;
    text-align: left;
    font-weight: 600;
    color: #e8eaf0;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .teams-table th {
    color: #1a1a1a;
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.teams-table td {
    padding: 16px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.05);
    color: #e8eaf0;
}

[data-theme="light"] .teams-table td {
    border-bottom-color: rgba(0, 0, 0, 0.05);
    color: #1a1a1a;
}

.teams-table tbody tr:hover {
    background: rgba(0, 212, 255, 0.05);
}

[data-theme="light"] .teams-table tbody tr:hover {
    background: rgba(0, 84, 255, 0.05);
}

.team-name {
    font-weight: 600;
    color: #00d4ff;
}

[data-theme="light"] .team-name {
    color: #0084ff;
}

.group-badge {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(0, 212, 255, 0.15);
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #00d4ff;
}

[data-theme="light"] .group-badge {
    background: rgba(0, 84, 255, 0.1);
    color: #0084ff;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.85rem;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-weight: 500;
}

.btn-edit {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.btn-edit:hover {
    background: rgba(0, 212, 255, 0.25);
}

.btn-delete {
    background: rgba(255, 107, 107, 0.15);
    color: #ff6b6b;
    border: 1px solid rgba(255, 107, 107, 0.3);
}

.btn-delete:hover {
    background: rgba(255, 107, 107, 0.25);
}

[data-theme="light"] .btn-edit {
    background: rgba(0, 84, 255, 0.1);
    color: #0084ff;
    border-color: rgba(0, 84, 255, 0.3);
}

[data-theme="light"] .btn-edit:hover {
    background: rgba(0, 84, 255, 0.2);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: rgba(232, 234, 240, 0.7);
}

[data-theme="light"] .empty-state {
    color: rgba(0, 0, 0, 0.6);
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .filter-grid {
        grid-template-columns: 1fr;
    }

    .teams-table {
        font-size: 0.9rem;
    }

    .teams-table th,
    .teams-table td {
        padding: 12px;
    }

    .action-buttons {
        flex-wrap: wrap;
    }
}
</style>

<div class="team-admin-page">
    <div class="team-admin-wrapper">
        <div class="admin-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= Html::a('+ Create Team', ['admin-create'], ['class' => 'btn-create']) ?>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <form method="get" id="team-filter-form">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label">Team Name</label>
                        <input type="text" name="TeamSearch[name]" class="filter-input" placeholder="Search name..." value="<?= Html::encode($searchModel->name) ?>">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Full Name</label>
                        <input type="text" name="TeamSearch[full_name]" class="filter-input" placeholder="Search full name..." value="<?= Html::encode($searchModel->full_name) ?>">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Group</label>
                        <select name="TeamSearch[group_name]" class="filter-input">
                            <option value="">All Groups</option>
                            <?php foreach (Team::groupDropdown() as $value => $label): ?>
                                <option value="<?= Html::encode($value) ?>" <?= $searchModel->group_name === $value ? 'selected' : '' ?>>
                                    <?= Html::encode($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn-filter">Search</button>
                    <?= Html::a('Reset', ['admin-index'], ['class' => 'btn-filter-reset']) ?>
                </div>
            </form>
        </div>

        <!-- Teams Table -->
        <?php $teams = $dataProvider->getModels(); ?>
        <?php if (!empty($teams)): ?>
            <table class="teams-table">
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Full Name</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teams as $team): ?>
                        <tr>
                            <td><span class="team-name"><?= Html::encode($team->name) ?></span></td>
                            <td><?= Html::encode($team->full_name) ?></td>
                            <td><span class="group-badge"><?= Html::encode($team->group_name) ?></span></td>
                            <td>
                                <div class="action-buttons">
                                    <?= Html::a('Edit', ['admin-update', 'id' => $team->id], ['class' => 'btn-sm btn-edit']) ?>
                                    <?= Html::a('Delete', ['admin-delete', 'id' => $team->id], [
                                        'class' => 'btn-sm btn-delete',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this team?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">⚽</div>
                <p>No teams found</p>
            </div>
        <?php endif; ?>
    </div>
</div>
