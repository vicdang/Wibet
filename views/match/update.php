<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 */

$this->title = !isset($update_score) ? 'Edit Match' : 'Update Match Score';
$pageSubtitle = !isset($update_score) ? 'Update match details' : 'Update match score result';
?>

<div class="match-update-page">
    <!-- Header Section -->
    <div class="update-header">
        <div class="header-content">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle"><?= Html::encode($pageSubtitle) ?></p>
        </div>
        <div class="header-actions">
            <?= Html::a('Back to Match', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <!-- Match Preview Card -->
    <div class="match-preview-card">
        <div class="preview-container">
            <!-- Team 1 -->
            <div class="preview-team">
                <div class="preview-team-info">
                    <?php if ($model->team1): ?>
                        <?php $flag1 = $model->team1->getFlagUrl(); ?>
                        <?php if ($flag1): ?>
                            <img src="<?= Html::encode($flag1) ?>" class="preview-flag" alt="<?= Html::encode($model->team1->name) ?>">
                        <?php elseif ($model->team1->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="preview-flag" alt="Playoff">
                        <?php endif; ?>
                        <span class="preview-team-name"><?= Html::encode($model->team1->name) ?></span>
                    <?php else: ?>
                        <span class="preview-team-name">Select Team</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- VS -->
            <div class="preview-vs">VS</div>

            <!-- Team 2 -->
            <div class="preview-team">
                <div class="preview-team-info">
                    <?php if ($model->team2): ?>
                        <?php $flag2 = $model->team2->getFlagUrl(); ?>
                        <?php if ($flag2): ?>
                            <img src="<?= Html::encode($flag2) ?>" class="preview-flag" alt="<?= Html::encode($model->team2->name) ?>">
                        <?php elseif ($model->team2->isPlayoffTeam()): ?>
                            <img src="/logo.png" class="preview-flag" alt="Playoff">
                        <?php endif; ?>
                        <span class="preview-team-name"><?= Html::encode($model->team2->name) ?></span>
                    <?php else: ?>
                        <span class="preview-team-name">Select Team</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <?= $this->render(!isset($update_score) ? '_form' : '_form_score', [
            'model' => $model,
        ]) ?>
    </div>
</div>

<style>
.match-update-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.update-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
    gap: 20px;
}

[data-theme="light"] .update-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0 0 8px 0;
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

/* Match Preview Card */
.match-preview-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.15);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

[data-theme="light"] .match-preview-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

.preview-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.preview-team {
    flex: 1;
    text-align: center;
}

.preview-team-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.preview-flag {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
}

.preview-team-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #e8eaf0;
}

[data-theme="light"] .preview-team-name {
    color: #1a1a1a;
}

.preview-vs {
    font-size: 1.5rem;
    font-weight: bold;
    color: rgba(0, 212, 255, 0.6);
    padding: 0 20px;
}

[data-theme="light"] .preview-vs {
    color: rgba(31, 115, 230, 0.6);
}

/* Form Container */
.form-container {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    padding: 30px;
}

[data-theme="light"] .form-container {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .match-update-page {
        padding: 15px;
    }

    .update-header {
        flex-direction: column;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .preview-container {
        flex-direction: column;
    }

    .preview-vs {
        transform: rotate(90deg);
        padding: 10px 0;
    }

    .header-actions {
        width: 100%;
    }

    .header-actions .btn {
        flex: 1;
    }
}
</style>
