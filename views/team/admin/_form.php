<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Team;
use app\models\AdminConfig;

/**
 * @var yii\web\View $this
 * @var app\models\Team $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="team-form-container">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'fieldConfig' => [
            'template' => '{label}{input}{error}',
        ],
    ]); ?>

    <!-- Team Information Card -->
    <div class="form-card">
        <div class="card-header">
            <h2 class="card-title">Team Information</h2>
            <p class="card-description">Team details and group assignment</p>
        </div>
        <div class="card-content">
            <div class="form-grid">
                <div class="form-group-wrapper">
                    <?= $form->field($model, 'name')->textInput([
                        'maxlength' => 50,
                        'placeholder' => 'e.g., Mexico',
                        'class' => 'form-input'
                    ])->label('Team Name', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?php $tournamentPhase = AdminConfig::get('tournament_phase'); ?>
                    <?php if ($tournamentPhase === 'group_stage'): ?>
                        <?= $form->field($model, 'group_name')->dropDownList(Team::groupDropdown(), [
                            'prompt' => 'Select a group',
                            'class' => 'form-select',
                        ])->label('Group', ['class' => 'form-label']) ?>
                    <?php else: ?>
                        <?= $form->field($model, 'knockout_round')->dropDownList(Team::knockoutRoundDropdown(), [
                            'prompt' => 'Select a round',
                            'class' => 'form-select',
                            'onchange' => '',
                        ])->label('Knockout Round', ['class' => 'form-label']) ?>
                    <?php endif; ?>
                </div>

                <div class="form-group-wrapper full-width">
                    <?= $form->field($model, 'full_name')->textInput([
                        'maxlength' => 100,
                        'placeholder' => 'e.g., United Mexican States',
                        'class' => 'form-input'
                    ])->label('Full Name', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper full-width">
                    <?= $form->field($model, 'flag')->textInput([
                        'maxlength' => 255,
                        'placeholder' => 'e.g., https://example.com/flag.png',
                        'class' => 'form-input'
                    ])->label('Custom Flag Image URL (Optional)', ['class' => 'form-label']) ?>
                    <p class="field-hint">Provide a custom flag image URL. If not provided, the default flag will be used automatically.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Create Team' : 'Save Changes',
            ['class' => 'btn btn-primary btn-submit']
        ) ?>
        <?= Html::a('Cancel', ['admin-index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<style>
.team-form-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.form-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.1);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.form-card:hover {
    border-color: rgba(0, 212, 255, 0.2);
    background: rgba(255, 255, 255, 0.03);
}

[data-theme="light"] .form-card {
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .form-card:hover {
    background: rgba(0, 0, 0, 0.04);
    border-color: rgba(0, 0, 0, 0.15);
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
    margin: 0 0 6px 0;
    color: #e8eaf0;
}

[data-theme="light"] .card-title {
    color: #1a1a1a;
}

.card-description {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.6);
    margin: 0;
}

[data-theme="light"] .card-description {
    color: rgba(0, 0, 0, 0.6);
}

.card-content {
    padding: 24px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.form-group-wrapper {
    display: flex;
    flex-direction: column;
}

.form-group-wrapper.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-size: 0.95rem;
    font-weight: 500;
    color: #e8eaf0;
    margin-bottom: 8px;
    display: block;
}

[data-theme="light"] .form-label {
    color: #2a2a2a;
}

.form-input,
.form-select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 8px;
    background: rgba(0, 0, 0, 0.2);
    color: #e8eaf0;
    font-size: 1rem;
    transition: all 0.2s ease;
    font-family: inherit;
}

[data-theme="light"] .form-input,
[data-theme="light"] .form-select {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: #00d4ff;
    background: rgba(0, 0, 0, 0.25);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .form-input:focus,
[data-theme="light"] .form-select:focus {
    background: rgba(0, 0, 0, 0.05);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.05);
}

.form-input::placeholder {
    color: rgba(232, 234, 240, 0.5);
}

[data-theme="light"] .form-input::placeholder {
    color: rgba(0, 0, 0, 0.4);
}

.form-error,
.help-block {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 6px;
    display: block;
}

.field-hint {
    font-size: 0.8rem;
    color: rgba(232, 234, 240, 0.5);
    margin-top: 6px;
    margin-bottom: 0;
}

[data-theme="light"] .field-hint {
    color: rgba(0, 0, 0, 0.5);
}

.form-actions {
    display: flex;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 212, 255, 0.08);
}

[data-theme="light"] .form-actions {
    border-top-color: rgba(0, 0, 0, 0.08);
}

.btn-submit {
    min-width: 140px;
    padding: 12px 24px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-secondary {
    color: #00d4ff;
    background: transparent;
    border: 1px solid #00d4ff;
    padding: 11px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-secondary:hover {
    background: rgba(0, 212, 255, 0.1);
    text-decoration: none;
}

[data-theme="light"] .btn-secondary {
    color: #0084ff;
    border-color: #0084ff;
}

[data-theme="light"] .btn-secondary:hover {
    background: rgba(0, 132, 255, 0.1);
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .card-header,
    .card-content {
        padding: 18px;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-submit,
    .btn-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>

<script>
// Prevent auto-submit - only allow submit when Save button is clicked
let allowSubmit = false;
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        // Prevent form submission by default
        form.addEventListener('submit', function(e) {
            if (!allowSubmit) {
                e.preventDefault();
                return false;
            }
        });

        // Allow submission only when Save button is clicked
        const saveBtn = form.querySelector('.btn-submit');
        if (saveBtn) {
            saveBtn.addEventListener('click', function() {
                allowSubmit = true;
            });
        }
    }
});
</script>
