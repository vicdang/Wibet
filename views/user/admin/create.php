<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = 'Create New User';
?>

<div class="user-create-page">
    <div class="user-create-header">
        <div class="header-content">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <!-- <p class="page-subtitle">Add a new user account to the system</p> -->
        </div>
        <div class="header-actions">
            <?= Html::a('Back to Users', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="user-create-container">
        <?= $this->render('_form', [
            'user' => $user,
            'profile' => $profile,
        ]) ?>
    </div>
</div>

<style>
.user-create-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.user-create-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
}

[data-theme="light"] .user-create-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0;
    letter-spacing: -0.5px;
    color: #e8eaf0;
}

[data-theme="light"] .page-title {
    color: #1f73e6;
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

.user-create-container {
    padding: 0;
}

@media (max-width: 768px) {
    .user-create-page {
        padding: 15px;
    }

    .user-create-header {
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
