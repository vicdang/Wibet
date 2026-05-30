<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Team;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="match-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'fieldConfig' => [
            'template' => '{label}{input}{error}',
        ],
    ]); ?>

    <!-- Teams Section -->
    <div class="form-section">
        <div class="section-header">
            <h3 class="section-title">Match Teams</h3>
            <p class="section-description">Select the two teams playing in this match</p>
        </div>
        <div class="section-content">
            <div class="form-grid">
                <div class="form-group-wrapper">
                    <?= $form->field($model, 'team_1')->dropDownList(Team::dropdown(), [
                        'prompt' => 'Select Team 1',
                        'class' => 'form-select'
                    ])->label('Team 1', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?= $form->field($model, 'team_2')->dropDownList(Team::dropdown(), [
                        'prompt' => 'Select Team 2',
                        'class' => 'form-select'
                    ])->label('Team 2', ['class' => 'form-label']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Match Details Section -->
    <div class="form-section">
        <div class="section-header">
            <h3 class="section-title">Match Details</h3>
            <p class="section-description">Set the match date and odds rate</p>
        </div>
        <div class="section-content">
            <div class="form-grid">
                <div class="form-group-wrapper full-width">
                    <?= $form->field($model, 'match_date')->textInput([
                        'type' => 'datetime-local',
                        'class' => 'form-input',
                        'placeholder' => 'Select match date and time'
                    ])->label('Match Date & Time', ['class' => 'form-label']) ?>
                </div>

                <div class="form-group-wrapper">
                    <?= $form->field($model, 'rate')->textInput([
                        'class' => 'form-input',
                        'placeholder' => 'e.g., 1.5'
                    ])->label('Odds Rate', ['class' => 'form-label']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="form-section">
        <div class="section-header">
            <h3 class="section-title">Description</h3>
            <p class="section-description">Add any additional notes about this match</p>
        </div>
        <div class="section-content">
            <div class="form-group-wrapper full-width">
                <?= $form->field($model, 'description')->textarea([
                    'rows' => 6,
                    'class' => 'form-textarea',
                    'placeholder' => 'Enter match details, notes, or special instructions...'
                ])->label('Description', ['class' => 'form-label']) ?>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Create Match' : 'Save Changes',
            ['class' => 'btn btn-primary btn-submit']
        ) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<style>
.match-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Form Section */
.form-section {
    display: flex;
    flex-direction: column;
    gap: 0;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(0, 212, 255, 0.08);
}

[data-theme="light"] .form-section {
    border-color: rgba(0, 0, 0, 0.08);
}

.section-header {
    padding: 20px;
    background: rgba(0, 212, 255, 0.05);
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .section-header {
    background: rgba(0, 0, 0, 0.03);
    border-bottom-color: rgba(0, 0, 0, 0.08);
}

.section-title {
    font-size: 1.15rem;
    font-weight: 600;
    margin: 0 0 6px 0;
    color: #e8eaf0;
}

[data-theme="light"] .section-title {
    color: #1a1a1a;
}

.section-description {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.6);
    margin: 0;
}

[data-theme="light"] .section-description {
    color: rgba(0, 0, 0, 0.6);
}

.section-content {
    padding: 24px;
}

/* Form Grid */
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

/* Form Inputs */
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
.form-select,
.form-textarea {
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
[data-theme="light"] .form-select,
[data-theme="light"] .form-textarea {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #00d4ff;
    background: rgba(0, 0, 0, 0.25);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .form-input:focus,
[data-theme="light"] .form-select:focus,
[data-theme="light"] .form-textarea:focus {
    background: rgba(0, 0, 0, 0.05);
    border-color: #1f73e6;
    box-shadow: 0 0 0 3px rgba(31, 115, 230, 0.1);
}

.form-input::placeholder,
.form-textarea::placeholder {
    color: rgba(232, 234, 240, 0.5);
}

[data-theme="light"] .form-input::placeholder,
[data-theme="light"] .form-textarea::placeholder {
    color: rgba(0, 0, 0, 0.4);
}

.form-textarea {
    resize: vertical;
    min-height: 150px;
}

/* Error Messages */
.help-block {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 6px;
    display: block;
}

/* Form Actions */
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
    color: #1f73e6;
    border-color: #1f73e6;
}

[data-theme="light"] .btn-secondary:hover {
    background: rgba(31, 115, 230, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-submit,
    .btn-secondary {
        width: 100%;
        text-align: center;
    }

    .section-header {
        padding: 16px;
    }

    .section-content {
        padding: 18px;
    }
}
</style>
