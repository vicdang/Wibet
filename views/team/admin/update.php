<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Team $model
 */

$this->title = 'Edit Team: ' . $model->name;
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
    max-width: 900px;
    margin: 0 auto;
}

.admin-header {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .admin-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.admin-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0 0 10px 0;
    letter-spacing: -1px;
}

[data-theme="light"] .admin-header h1 {
    color: #1a1a1a;
}

.admin-header p {
    color: rgba(232, 234, 240, 0.6);
    font-size: 1.1rem;
    margin: 0;
}

[data-theme="light"] .admin-header p {
    color: rgba(0, 0, 0, 0.6);
}
</style>

<div class="team-admin-page">
    <div class="team-admin-wrapper">
        <div class="admin-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Update team information</p>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
