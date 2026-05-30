<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */

// Handle variable passing - sometimes $user comes as $model
if (isset($model) && !isset($user)) {
    $user = $model;
}
if (isset($user) && !isset($profile)) {
    $profile = $user->profile;
}

$this->title = isset($user) ? ('Edit User: ' . $user->username) : 'Edit User';
?>

<div class="user-update-page">
    <div class="user-update-header">
        <div class="header-content">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle">Manage user account and profile settings</p>
        </div>
    </div>

    <div class="user-update-container">
        <?= $this->render('_form', [
            'user' => $user,
            'profile' => $profile,
        ]) ?>
    </div>
</div>

<style>
.user-update-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.user-update-header {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

.header-content {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0;
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

.user-update-container {
    padding: 0;
}

@media (max-width: 768px) {
    .user-update-page {
        padding: 15px;
    }

    .page-title {
        font-size: 1.75rem;
    }
}
</style>
