<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 * @var yii\widgets\ActiveForm $form
 * @var integer $userBalance
 */

$minBetMoney = Yii::$app->params['minBetMoney'] ?? 1;
?>

<div class="bet-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template' => '{label}{input}{error}',
        ],
    ]); ?>

    <!-- Select Prediction Section -->
    <div class="form-section">
        <div class="section-header">
            <h3 class="section-title">Select Your Prediction</h3>
            <p class="section-description">Choose which team you think will win</p>
        </div>
        <div class="section-content">
            <div class="prediction-options">
                <div class="option-group">
                    <label class="option-label">
                        <input type="radio" name="Bet[option]" value="1" class="option-radio"
                            <?= ($model->option == 1) ? 'checked' : '' ?> required>
                        <div class="option-card">
                            <div class="option-team">
                                <?php if ($match->team1): ?>
                                    <?php $flag1 = $match->team1->getFlagUrl(); ?>
                                    <?php if ($flag1): ?>
                                        <img src="<?= Html::encode($flag1) ?>" class="option-flag" alt="<?= Html::encode($match->team1->name) ?>">
                                    <?php elseif ($match->team1->isPlayoffTeam()): ?>
                                        <img src="/logo.png" class="option-flag" alt="Playoff">
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="option-text"><?= $match->team1 ? Html::encode($match->team1->name) : 'Select Team' ?></span>
                            </div>
                            <div class="option-check"></div>
                        </div>
                    </label>
                </div>

                <div class="option-group">
                    <label class="option-label">
                        <input type="radio" name="Bet[option]" value="2" class="option-radio"
                            <?= ($model->option == 2) ? 'checked' : '' ?> required>
                        <div class="option-card">
                            <div class="option-team">
                                <?php if ($match->team2): ?>
                                    <?php $flag2 = $match->team2->getFlagUrl(); ?>
                                    <?php if ($flag2): ?>
                                        <img src="<?= Html::encode($flag2) ?>" class="option-flag" alt="<?= Html::encode($match->team2->name) ?>">
                                    <?php elseif ($match->team2->isPlayoffTeam()): ?>
                                        <img src="/logo.png" class="option-flag" alt="Playoff">
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="option-text"><?= $match->team2 ? Html::encode($match->team2->name) : 'Select Team' ?></span>
                            </div>
                            <div class="option-check"></div>
                        </div>
                    </label>
                </div>
            </div>
            <?php if ($model->hasErrors('option')): ?>
                <div class="help-block" style="color: #ff6b6b; margin-top: 12px;">
                    <?= Html::error($model, 'option') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bet Amount Section -->
    <div class="form-section">
        <div class="section-header">
            <h3 class="section-title">Bet Amount</h3>
            <p class="section-description">Minimum: <?= $minBetMoney ?> | Maximum: <?= number_format($userBalance, 0) ?></p>
        </div>
        <div class="section-content">
            <div class="form-group-wrapper full-width">
                <?= $form->field($model, 'money')->textInput([
                    'type' => 'number',
                    'class' => 'form-input',
                    'placeholder' => 'Enter your bet amount',
                    'min' => $minBetMoney,
                    'max' => $userBalance,
                    'step' => '1'
                ])->label('Amount to Bet', ['class' => 'form-label']) ?>
            </div>

            <!-- Bet Information -->
            <div class="bet-info">
                <div class="info-row">
                    <span class="info-title">Your stake:</span>
                    <span class="info-value bet-amount">0</span>
                </div>
                <div class="info-row">
                    <span class="info-title">Remaining balance:</span>
                    <span class="info-value remaining-amount"><?= number_format($userBalance, 0) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <?= Html::submitButton(
            'Place Bet',
            ['class' => 'btn btn-primary btn-submit']
        ) ?>
        <?= Html::a('Cancel', ['/match/view', 'id' => $match->id], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const moneyInput = document.querySelector('input[name="Bet[money]"]');
    const betAmountEl = document.querySelector('.bet-amount');
    const remainingEl = document.querySelector('.remaining-amount');
    const userBalance = <?= $userBalance ?>;

    function updateBetInfo() {
        const amount = parseInt(moneyInput.value) || 0;
        betAmountEl.textContent = amount.toLocaleString();
        remainingEl.textContent = (userBalance - amount).toLocaleString();

        if (amount > userBalance) {
            remainingEl.style.color = '#ff6b6b';
        } else if (amount > 0) {
            remainingEl.style.color = '#81c784';
        } else {
            remainingEl.style.color = 'inherit';
        }
    }

    moneyInput.addEventListener('input', updateBetInfo);
    updateBetInfo();

    // Make option cards clickable and cursor change
    const optionLabels = document.querySelectorAll('.option-label');
    optionLabels.forEach(label => {
        label.style.cursor = 'pointer';
        const card = label.querySelector('.option-card');
        if (card) {
            card.style.cursor = 'pointer';
        }
    });
});
</script>

<style>
.bet-form {
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

/* Prediction Options */
.prediction-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.option-group {
    margin: 0;
}

.option-label {
    display: block;
    cursor: pointer;
}

.option-radio {
    display: none;
}

.option-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 16px;
    border: 2px solid rgba(0, 212, 255, 0.15);
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}

[data-theme="light"] .option-card {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.1);
}

.option-radio:checked + .option-card {
    border-color: #00d4ff !important;
    background: rgba(0, 212, 255, 0.15) !important;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15) !important;
}

[data-theme="light"] .option-radio:checked + .option-card {
    border-color: #1f73e6 !important;
    background: rgba(31, 115, 230, 0.1) !important;
    box-shadow: 0 0 0 3px rgba(31, 115, 230, 0.1) !important;
}

.option-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .option-card:hover {
    border-color: rgba(31, 115, 230, 0.3);
}

.option-team {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.option-flag {
    width: 48px;
    height: 48px;
    border-radius: 6px;
    object-fit: cover;
}

.option-text {
    font-size: 1rem;
    font-weight: 600;
    color: #e8eaf0;
}

[data-theme="light"] .option-text {
    color: #1a1a1a;
}

.option-check {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    border: 2px solid rgba(0, 212, 255, 0.3);
    background: transparent;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
}

.option-check::before {
    content: '✓';
    font-size: 16px;
    font-weight: bold;
    color: transparent;
    transition: color 0.2s ease;
    line-height: 1;
}

.option-radio:checked + .option-card .option-check {
    background: #00d4ff !important;
    border-color: #00d4ff !important;
}

.option-radio:checked + .option-card .option-check::before {
    color: #0a0e1a !important;
}

[data-theme="light"] .option-radio:checked + .option-card .option-check {
    background: #1f73e6 !important;
    border-color: #1f73e6 !important;
}

[data-theme="light"] .option-radio:checked + .option-card .option-check::before {
    color: #ffffff !important;
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

.form-input {
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

[data-theme="light"] .form-input {
    background: rgba(0, 0, 0, 0.03);
    border-color: rgba(0, 0, 0, 0.15);
    color: #1a1a1a;
}

.form-input:focus {
    outline: none;
    border-color: #00d4ff;
    background: rgba(0, 0, 0, 0.25);
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .form-input:focus {
    background: rgba(0, 0, 0, 0.05);
    border-color: #1f73e6;
    box-shadow: 0 0 0 3px rgba(31, 115, 230, 0.1);
}

.form-input::placeholder {
    color: rgba(232, 234, 240, 0.5);
}

[data-theme="light"] .form-input::placeholder {
    color: rgba(0, 0, 0, 0.4);
}

/* Bet Information */
.bet-info {
    margin-top: 16px;
    padding: 16px;
    background: rgba(0, 212, 255, 0.05);
    border-radius: 8px;
    border-left: 4px solid #00d4ff;
}

[data-theme="light"] .bet-info {
    background: rgba(31, 115, 230, 0.05);
    border-left-color: #1f73e6;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
}

.info-title {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.7);
    font-weight: 500;
}

[data-theme="light"] .info-title {
    color: rgba(0, 0, 0, 0.6);
}

.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #00d4ff;
    font-variant-numeric: tabular-nums;
}

[data-theme="light"] .info-value {
    color: #1f73e6;
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
    min-width: 160px;
    padding: 12px 28px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: #0a0e1a;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

[data-theme="light"] .btn-submit {
    background: linear-gradient(135deg, #1f73e6 0%, #7b2fff 100%);
    color: #ffffff;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
}

.btn-secondary {
    color: #00d4ff;
    background: transparent;
    border: 1px solid #00d4ff;
    padding: 11px 28px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
}

[data-theme="light"] .btn-secondary {
    color: #1f73e6;
    border-color: #1f73e6;
}

.btn-secondary:hover {
    background: rgba(0, 212, 255, 0.1);
    text-decoration: none;
}

[data-theme="light"] .btn-secondary:hover {
    background: rgba(31, 115, 230, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .prediction-options {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .option-card {
        padding: 14px;
        flex-direction: column;
        text-align: center;
    }

    .option-team {
        flex-direction: column;
        width: 100%;
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

    .bet-info {
        margin-top: 12px;
        padding: 12px;
    }
}
</style>
