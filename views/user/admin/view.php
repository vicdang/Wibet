<?php

use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 */

$model = $user;
$profile = $user->profile;
$this->title = $model->username;
?>

<div class="user-view-page">
    <div class="view-header">
        <div class="header-content">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="user-email"><?= Html::encode($model->email) ?></p>
        </div>
        <div class="header-actions">
            <?= Html::a('Edit User', ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary'
            ]) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data-confirm' => 'Are you sure you want to delete this user?',
                'data-method' => 'post',
                'style' => 'cursor: pointer;'
            ]) ?>
            <?= Html::a('Back to List', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="view-container">
        <!-- Account Information -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Account Information</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Username</span>
                        <span class="info-value"><?= Html::encode($model->username) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= Html::encode($model->email) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Role</span>
                        <span class="info-value role-badge <?= ['', 'role-admin', 'role-user', 'role-guest'][$model->role_id] ?? '' ?>">
                            <?= [1 => 'Admin', 2 => 'User', 3 => 'Guest'][$model->role_id] ?? 'Unknown' ?>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value status-badge <?= $model->status == 10 ? 'status-active' : 'status-inactive' ?>">
                            <?= $model->status == 10 ? 'Active' : 'Inactive' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Profile Information</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item full-width">
                        <span class="info-label">Full Name</span>
                        <span class="info-value"><?= Html::encode($profile->full_name ?? 'Not provided') ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Account Balance</span>
                        <span class="info-value"><?= Helper::formatMoney($profile->money ?? 0) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Timezone</span>
                        <span class="info-value"><?= Html::encode($profile->timezone ?? 'Not set') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Information -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Security</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item full-width">
                        <span class="info-label">Ban Status</span>
                        <span class="info-value">
                            <?php if ($model->banned_at): ?>
                                <span class="status-badge" style="background: rgba(255, 107, 107, 0.2); color: #ff6b6b;">Banned</span>
                                <span style="color: rgba(232, 234, 240, 0.7);"><?= Html::encode($model->banned_reason ?? 'No reason provided') ?></span>
                            <?php else: ?>
                                <span class="status-badge status-active">Active</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates -->
        <div class="info-card">
            <div class="card-header">
                <h2 class="card-title">Timestamps</h2>
            </div>
            <div class="card-content">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Account Created</span>
                        <span class="info-value"><?= $model->created_at ? date('M d, Y H:i', strtotime($model->created_at)) : 'N/A' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Last Updated</span>
                        <span class="info-value"><?= $model->updated_at ? date('M d, Y H:i', strtotime($model->updated_at)) : 'N/A' ?></span>
                    </div>
                    <?php if ($model->logged_in_at): ?>
                        <div class="info-item">
                            <span class="info-label">Last Login</span>
                            <span class="info-value"><?= date('M d, Y H:i', strtotime($model->logged_in_at)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-view-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.view-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}

.user-email {
    font-size: 1rem;
    color: rgba(232, 234, 240, 0.7);
    margin: 0;
}

[data-theme="light"] .user-email {
    color: rgba(0, 0, 0, 0.6);
}

.header-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

/* View Container */
.view-container {
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

/* Info Grid */
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

.info-item.full-width {
    grid-column: 1 / -1;
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

/* Badges */
.role-badge,
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    white-space: nowrap;
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

.status-active {
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
}

.status-inactive {
    background: rgba(244, 67, 54, 0.15);
    color: #ef9a9a;
}

@media (max-width: 768px) {
    .view-header {
        flex-direction: column;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .header-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .header-actions .btn {
        flex: 1;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
