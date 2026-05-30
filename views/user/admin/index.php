<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var amnah\yii2\user\models\User $searchModel
 */

$this->title = 'User Management';
?>

<div class="user-index-page">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle">Manage application users, roles, and permissions</p>
        </div>
        <div class="header-actions">
            <?= Html::a('Create New User', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="user-grid-container">
        <?php Pjax::begin(['id' => 'user-pjax-grid']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'username',
                    'label' => 'Username',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::a(
                            Html::encode($model->username),
                            ['view', 'id' => $model->id],
                            ['class' => 'user-link']
                        );
                    },
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email Address',
                ],
                [
                    'attribute' => 'role_id',
                    'label' => 'Role',
                    'format' => 'html',
                    'value' => function ($model) {
                        $roleNames = [1 => 'Admin', 2 => 'User', 3 => 'Guest'];
                        $role = $roleNames[$model->role_id] ?? 'Unknown';
                        $roleClass = [1 => 'role-admin', 2 => 'role-user', 3 => 'role-guest'];
                        $class = $roleClass[$model->role_id] ?? '';
                        return "<span class='role-badge {$class}'>{$role}</span>";
                    },
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'format' => 'html',
                    'value' => function ($model) {
                        $statusLabels = [
                            10 => ['text' => 'Active', 'class' => 'status-active'],
                            0 => ['text' => 'Inactive', 'class' => 'status-inactive'],
                        ];
                        $status = $statusLabels[$model->status] ?? ['text' => 'Unknown', 'class' => ''];
                        return "<span class='status-badge {$status['class']}'>{$status['text']}</span>";
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'label' => 'Joined',
                    'format' => ['date', 'php:M d, Y'],
                    'headerOptions' => ['width' => '150px'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '120px'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'class' => 'action-btn action-view',
                                'title' => 'View'
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'class' => 'action-btn action-edit',
                                'title' => 'Edit'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'class' => 'action-btn action-delete',
                                'title' => 'Delete',
                                'data-confirm' => 'Are you sure you want to delete this item?',
                                'data-method' => 'post'
                            ]);
                        },
                    ],
                ],
            ],
            'tableOptions' => ['class' => 'table table-striped user-grid-table'],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

<style>
.user-index-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-header {
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

.page-subtitle {
    font-size: 1rem;
    color: rgba(232, 234, 240, 0.7);
    margin: 0;
}

[data-theme="light"] .page-subtitle {
    color: rgba(0, 0, 0, 0.6);
}

.header-actions {
    display: flex;
    gap: 10px;
}

/* Grid Styling */
.user-grid-container {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

[data-theme="light"] .user-grid-container {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

.user-grid-table {
    margin: 0;
    border: none;
    background: transparent;
}

.user-grid-table thead {
    background: rgba(0, 212, 255, 0.08);
    border-bottom: 2px solid rgba(0, 212, 255, 0.15);
}

[data-theme="light"] .user-grid-table thead {
    background: rgba(0, 0, 0, 0.05);
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.user-grid-table th {
    padding: 16px !important;
    font-weight: 600;
    color: #e8eaf0;
}

[data-theme="light"] .user-grid-table th {
    color: #1a1a1a;
}

.user-grid-table td {
    padding: 14px 16px !important;
    vertical-align: middle;
}

.user-link {
    color: #00d4ff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.user-link:hover {
    color: #00a8cc;
    text-decoration: underline;
}

[data-theme="light"] .user-link {
    color: #0084ff;
}

[data-theme="light"] .user-link:hover {
    color: #0060cc;
}

/* Badge Styling */
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

/* Action Buttons */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    color: #00d4ff;
    border: 1px solid transparent;
    transition: all 0.2s ease;
    margin: 0 2px;
}

.action-btn:hover {
    background: rgba(0, 212, 255, 0.15);
    border-color: rgba(0, 212, 255, 0.3);
    text-decoration: none;
}

.action-view {
    color: #00d4ff;
}

.action-edit {
    color: #7b2fff;
}

.action-edit:hover {
    background: rgba(123, 47, 255, 0.15);
    border-color: rgba(123, 47, 255, 0.3);
}

.action-delete {
    color: #ff6b6b;
}

.action-delete:hover {
    background: rgba(255, 107, 107, 0.15);
    border-color: rgba(255, 107, 107, 0.3);
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .header-actions {
        width: 100%;
    }

    .header-actions .btn {
        flex: 1;
    }
}
</style>
