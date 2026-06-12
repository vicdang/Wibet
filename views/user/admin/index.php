<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var amnah\yii2\user\models\User $searchModel
 */

$this->title = 'User Management';

// Get total user count
$userModel = $this->context->module->model('User');
$totalUsers = $userModel::find()->count();
?>

<style>
.user-management-page {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .user-management-page {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.users-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

.users-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    gap: 30px;
    flex-wrap: wrap;
}

.users-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: -1px;
}

[data-theme="light"] .users-hero h1 {
    color: #1a1a1a;
}

.users-hero p {
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

/* Users Grid */
.users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

/* User Card */
.user-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.user-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    transform: translateY(-3px);
}

[data-theme="light"] .user-card {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

[data-theme="light"] .user-card:hover {
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.1);
    border-color: rgba(0, 84, 255, 0.25);
}

/* God Card */
.user-card.god {
    background: rgba(255, 215, 0, 0.08);
    border-color: rgba(255, 215, 0, 0.25);
}

.user-card.god:hover {
    border-color: rgba(255, 215, 0, 0.4);
    box-shadow: 0 8px 24px rgba(255, 215, 0, 0.15);
}

[data-theme="light"] .user-card.god {
    background: rgba(255, 215, 0, 0.05);
}

[data-theme="light"] .user-card.god:hover {
    border-color: rgba(255, 215, 0, 0.3);
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.1);
}

/* Admin Card */
.user-card.admin {
    background: rgba(123, 47, 255, 0.08);
    border-color: rgba(123, 47, 255, 0.25);
}

.user-card.admin:hover {
    border-color: rgba(123, 47, 255, 0.4);
    box-shadow: 0 8px 24px rgba(123, 47, 255, 0.15);
}

[data-theme="light"] .user-card.admin {
    background: rgba(123, 47, 255, 0.05);
}

[data-theme="light"] .user-card.admin:hover {
    border-color: rgba(123, 47, 255, 0.3);
    box-shadow: 0 8px 20px rgba(123, 47, 255, 0.1);
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

.user-card.god .card-header {
    background: rgba(255, 215, 0, 0.1);
    border-bottom-color: rgba(255, 215, 0, 0.15);
}

[data-theme="light"] .user-card.god .card-header {
    background: rgba(255, 215, 0, 0.05);
}

.user-card.admin .card-header {
    background: rgba(123, 47, 255, 0.1);
    border-bottom-color: rgba(123, 47, 255, 0.15);
}

[data-theme="light"] .user-card.admin .card-header {
    background: rgba(123, 47, 255, 0.05);
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    color: white;
    flex-shrink: 0;
}

.user-avatar.god {
    background: linear-gradient(135deg, #ffd700 0%, #ff6b6b 100%);
}

.user-avatar.admin {
    background: linear-gradient(135deg, #7b2fff 0%, #4285f4 100%);
}

.user-avatar.user {
    background: linear-gradient(135deg, #00d4ff 0%, #4285f4 100%);
}

.header-info {
    flex: 1;
}

.user-username {
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0 0 2px 0;
}

.user-fullname {
    font-size: 0.85rem;
    color: rgba(232, 234, 240, 0.8);
    margin: 2px 0;
    font-weight: 500;
}

[data-theme="light"] .user-fullname {
    color: rgba(0, 0, 0, 0.7);
}

.user-email {
    font-size: 0.8rem;
    color: rgba(232, 234, 240, 0.6);
    margin: 0;
}

[data-theme="light"] .user-email {
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

.user-info-row {
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

/* Role Badge */
.role-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.role-god {
    background: rgba(255, 215, 0, 0.2);
    color: #ffd700;
}

.role-admin {
    background: rgba(123, 47, 255, 0.2);
    color: #b085ff;
}

.role-user {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
}

.role-guest {
    background: rgba(232, 234, 240, 0.1);
    color: rgba(232, 234, 240, 0.8);
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.status-active {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.status-inactive {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
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

@media (max-width: 1024px) {
    .users-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
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

@media (max-width: 768px) {
    .user-management-page {
        padding: 20px 16px;
    }

    .users-hero {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .users-hero h1 {
        font-size: 2rem;
    }

    .users-grid {
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

<div class="user-management-page">
    <div class="users-wrapper">
        <!-- Hero Section -->
        <div class="users-hero">
            <div>
                <h1><?= Html::encode($this->title) ?></h1>
                <p><?= $totalUsers ?> <?= $totalUsers == 1 ? 'user' : 'users' ?> in system</p>
            </div>
            <?= Html::a('Create New User', ['create'], ['class' => 'btn-create']) ?>
        </div>

        <!-- Filter Toggle Button -->
        <button type="button" class="filter-toggle-btn" id="filter-toggle" onclick="toggleFilters()">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>

        <!-- Filters Section -->
        <?php
        $userSearchParams = Yii::$app->request->get('UserSearch', []);
        $hasActiveFilters = !empty($userSearchParams['username']) || !empty($userSearchParams['role_id']) || !empty($userSearchParams['status']);
        $collapsedClass = $hasActiveFilters ? '' : 'collapsed';
        ?>
        <form method="GET" action="<?= Yii::$app->urlManager->createUrl(['user/admin/index']) ?>" class="filters-section <?= $collapsedClass ?>" id="user-filter-form">
            <div class="filter-group">
                <label class="filter-label">Username</label>
                <input type="text" name="UserSearch[username]" class="filter-input" placeholder="Search username..." value="<?= Html::encode(Yii::$app->request->get('UserSearch')['username'] ?? '') ?>" onchange="submitFilters('user-filter-form')">
            </div>

            <div class="filter-group">
                <label class="filter-label">Role</label>
                <select name="UserSearch[role_id]" class="filter-select" onchange="submitFilters('user-filter-form')">
                    <option value="">All Roles</option>
                    <option value="1" <?= (Yii::$app->request->get('UserSearch')['role_id'] ?? '') === '1' ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= (Yii::$app->request->get('UserSearch')['role_id'] ?? '') === '2' ? 'selected' : '' ?>>User</option>
                    <option value="3" <?= (Yii::$app->request->get('UserSearch')['role_id'] ?? '') === '3' ? 'selected' : '' ?>>Guest</option>
                    <option value="5" <?= (Yii::$app->request->get('UserSearch')['role_id'] ?? '') === '5' ? 'selected' : '' ?>>God</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select name="UserSearch[status]" class="filter-select" onchange="submitFilters('user-filter-form')">
                    <option value="">All Status</option>
                    <option value="1" <?= (Yii::$app->request->get('UserSearch')['status'] ?? '') === '1' ? 'selected' : '' ?>>Active</option>
                    <option value="2" <?= (Yii::$app->request->get('UserSearch')['status'] ?? '') === '2' ? 'selected' : '' ?>>Unconfirmed</option>
                    <option value="0" <?= (Yii::$app->request->get('UserSearch')['status'] ?? '') === '0' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="button" class="btn-filter" onclick="resetFilters('<?= Yii::$app->urlManager->createUrl(['user/admin/index']) ?>')" title="Clear filters">
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

        <!-- Users Grid -->
        <div class="users-grid">
            <?php
            $users = $dataProvider->getModels();
            if (empty($users)):
            ?>
                <div class="empty-state">No users found</div>
            <?php
            else:
                foreach ($users as $model):
                    $initial = substr($model->username, 0, 1);
                    $roleNames = [1 => 'Admin', 2 => 'User', 3 => 'Guest', 5 => 'God'];
                    $role = $roleNames[$model->role_id] ?? 'Unknown';
                    $roleClass = [1 => 'role-admin', 2 => 'role-user', 3 => 'role-guest', 5 => 'role-god'];
                    $roleClassVal = $roleClass[$model->role_id] ?? '';
                    $cardClass = $model->role_id == 5 ? 'god' : ($model->role_id == 1 ? 'admin' : '');
                    $balance = $model->profile ? $model->profile->money : 0;
            ?>
            <div class="user-card <?= $cardClass ?>">
                <!-- Header -->
                <div class="card-header">
                    <div class="user-avatar <?= $roleClassVal ?>">
                        <?= strtoupper($initial) ?>
                    </div>
                    <div class="header-info">
                        <p class="user-username"><?= Html::encode($model->username) ?></p>
                        <?php if ($model->profile && $model->profile->full_name): ?>
                            <p class="user-fullname"><?= Html::encode($model->profile->full_name) ?></p>
                        <?php endif; ?>
                        <p class="user-email"><?= Html::encode($model->email) ?></p>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="user-info-row">
                        <span class="info-label">Role</span>
                        <span class="role-badge <?= $roleClassVal ?>"><?= $role ?></span>
                    </div>

                    <div class="user-info-row">
                        <span class="info-label">Status</span>
                        <span class="status-badge <?= $model->status == 1 ? 'status-active' : 'status-inactive' ?>">
                            <?= $model->status == 1 ? 'Active' : ($model->status == 2 ? 'Unconfirmed' : 'Inactive') ?>
                        </span>
                    </div>

                    <div class="user-info-row">
                        <span class="info-label">Balance</span>
                        <span class="info-value"><?= Helper::formatMoney($balance) ?></span>
                    </div>

                    <div class="user-info-row">
                        <span class="info-label">Joined</span>
                        <span class="info-value"><?= $model->created_at ? date('M d, Y', strtotime($model->created_at)) : 'N/A' ?></span>
                    </div>
                </div>

                <!-- Footer -->
                <?php $isGod = !Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == 5; ?>
                <?php if (!in_array($model->role_id, [1, 5]) || $isGod): ?>
                <div class="card-footer">
                    <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'action-btn primary']) ?>
                    <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'action-btn primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'action-btn danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']) ?>
                </div>
                <?php else: ?>
                <div class="card-footer">
                    <span class="action-btn" style="opacity:0.6;cursor:not-allowed;">Restricted</span>
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
