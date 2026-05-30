<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use amnah\yii2\user\helpers\Timezone;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var yii\data\ActiveDataProvider $dataHistory
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile');
?>

<style>
.profile-wrapper {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px 0;
}

.profile-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
}

.profile-card h2 {
    font-size: 20px;
    font-weight: 700;
    color: #00d4ff;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #e8eaf0;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
}

.form-control {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(0, 212, 255, 0.2) !important;
    color: #e8eaf0 !important;
    padding: 12px 15px !important;
    border-radius: 6px !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.08) !important;
    border-color: rgba(0, 212, 255, 0.5) !important;
    color: #e8eaf0 !important;
    box-shadow: 0 0 10px rgba(0, 212, 255, 0.2) !important;
    outline: none !important;
}

.submit-btn {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.3) 0%, rgba(123, 47, 255, 0.3) 100%) !important;
    border: 2px solid rgba(0, 212, 255, 0.5) !important;
    color: #00d4ff !important;
    padding: 12px 40px !important;
    font-weight: 600 !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    font-size: 15px !important;
}

.submit-btn:hover {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.5) 0%, rgba(123, 47, 255, 0.5) 100%) !important;
    border-color: rgba(0, 212, 255, 0.8) !important;
    box-shadow: 0 0 20px rgba(0, 212, 255, 0.3) !important;
}

.alert-success {
    background: rgba(76, 175, 80, 0.1) !important;
    border: 1px solid rgba(76, 175, 80, 0.3) !important;
    border-radius: 8px !important;
    color: #a8d5a8 !important;
    padding: 15px 20px !important;
    margin-bottom: 20px !important;
}

.alert-success p {
    margin: 0 !important;
}

.history-section {
    margin-top: 40px;
}

.history-section h2 {
    font-size: 24px;
    font-weight: 700;
    color: #e8eaf0;
    margin-bottom: 25px;
}

.table {
    background: transparent !important;
    border-collapse: collapse !important;
    margin-top: 20px;
}

.table thead th {
    background: rgba(0, 212, 255, 0.1) !important;
    color: #00d4ff !important;
    border: none !important;
    padding: 15px !important;
    text-align: left !important;
    font-weight: 600 !important;
    font-size: 13px !important;
}

.table tbody td {
    border: none !important;
    padding: 15px !important;
    color: #d4d8e0 !important;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1) !important;
    font-size: 14px !important;
}

.table tbody tr {
    background: transparent !important;
}

.table tbody tr:hover {
    background: rgba(0, 212, 255, 0.08) !important;
}

.table .badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-success {
    background: rgba(76, 175, 80, 0.2) !important;
    color: #4caf50 !important;
}

.badge-danger {
    background: rgba(244, 67, 54, 0.2) !important;
    color: #f44336 !important;
}

.badge-warning {
    background: rgba(255, 193, 7, 0.2) !important;
    color: #ffc107 !important;
}

.badge-secondary {
    background: rgba(158, 158, 158, 0.2) !important;
    color: #9e9e9e !important;
}

.badge-info {
    background: rgba(0, 212, 255, 0.2) !important;
    color: #00d4ff !important;
}

h1 {
    color: #e8eaf0 !important;
    margin-bottom: 30px !important;
    font-size: 32px !important;
}

/* Light Theme Overrides */
[data-theme="light"] .profile-card {
    background: #ffffff !important;
    border: 1px solid #dadce0 !important;
}

[data-theme="light"] .profile-card h2 {
    color: #1f73e6 !important;
    border-bottom-color: #dadce0 !important;
}

[data-theme="light"] .form-group label {
    color: #202124 !important;
}

[data-theme="light"] .form-control {
    background: #f8f9fa !important;
    border-color: #dadce0 !important;
    color: #202124 !important;
}

[data-theme="light"] .form-control:focus {
    background: #ffffff !important;
    border-color: #1f73e6 !important;
    box-shadow: 0 0 8px rgba(31, 115, 230, 0.15) !important;
}

[data-theme="light"] .submit-btn {
    background: linear-gradient(135deg, rgba(66, 133, 244, 0.15) 0%, rgba(156, 39, 176, 0.15) 100%) !important;
    border-color: #1f73e6 !important;
    color: #1f73e6 !important;
}

[data-theme="light"] .submit-btn:hover {
    background: linear-gradient(135deg, rgba(66, 133, 244, 0.25) 0%, rgba(156, 39, 176, 0.25) 100%) !important;
    border-color: #1f73e6 !important;
    box-shadow: 0 0 15px rgba(31, 115, 230, 0.2) !important;
}

[data-theme="light"] .alert-success {
    background: rgba(52, 168, 83, 0.1) !important;
    border-left: 4px solid #34a853 !important;
    color: #0d652d !important;
}

[data-theme="light"] .history-section h2 {
    color: #202124 !important;
}

[data-theme="light"] .table thead th {
    background: rgba(31, 115, 230, 0.08) !important;
    color: #1f73e6 !important;
}

[data-theme="light"] .table tbody td {
    color: #202124 !important;
    border-bottom-color: #f0f0f0 !important;
}

[data-theme="light"] .table tbody tr:hover {
    background: rgba(31, 115, 230, 0.05) !important;
}

[data-theme="light"] h1 {
    color: #202124 !important;
}
</style>

<div class="profile-wrapper">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>
        <div class="alert-success">
            <p><?= $flash ?></p>
        </div>
    <?php endif; ?>

    <div class="profile-card">
        <h2>Personal Information</h2>

        <?php $form = ActiveForm::begin([
            'id' => 'profile-form',
            'options' => ['class' => ''],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => ''],
            ],
            'enableAjaxValidation' => true,
        ]); ?>

        <?= $form->field($profile, 'full_name')->textInput(['placeholder' => 'Your Full Name']) ?>

        <?= $form->field($profile, 'timezone')->dropDownList(ArrayHelper::map(Timezone::getAll(), 'identifier', 'name'), ['class' => 'form-control']) ?>

        <div style="margin-top: 30px; text-align: center;">
            <?= Html::submitButton(Yii::t('user', 'Update Profile'), ['class' => 'submit-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="history-section">
        <h2>Betting History</h2>

        <?= GridView::widget([
                'dataProvider' => $dataHistory,
                'columns' => [
                    [
                        'attribute' => 'team_1_name',
                        'label' => 'Team 1',
                        'headerOptions' => ['style' => 'width: 15%;'],
                    ],
                    [
                        'attribute' => 'team_2_name',
                        'label' => 'Team 2',
                        'headerOptions' => ['style' => 'width: 15%;'],
                    ],
                    [
                        'attribute' => 'rate',
                        'label' => 'Odds',
                        'headerOptions' => ['style' => 'width: 10%;'],
                    ],
                    [
                        'attribute' => 'option',
                        'label' => 'Pick',
                        'headerOptions' => ['style' => 'width: 10%;'],
                    ],
                    [
                        'attribute' => 'money',
                        'label' => 'Amount',
                        'headerOptions' => ['style' => 'width: 12%;'],
                    ],
                    [
                        'label' => 'Result',
                        'headerOptions' => ['style' => 'width: 10%;'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            if ($model['result'] != NULL) {
                                if ($model['result'] == $model['option']) {
                                    return '<span class="badge badge-success">✓ Win</span>';
                                } else {
                                    if ($model['result'] == 0) {
                                        return '<span class="badge badge-warning">— Draw</span>';
                                    } else if ($model['result'] == 3) {
                                        return '<span class="badge badge-secondary">⊘ Cancel</span>';
                                    } else {
                                        return '<span class="badge badge-danger">✕ Loss</span>';
                                    }
                                }
                            } else {
                                return '<span class="badge badge-info">⟳ Pending</span>';
                            }
                        },
                    ],
                ],
                'tableOptions' => ['class' => 'table'],
                'emptyText' => '<div style="padding: 20px; text-align: center; color: #8e92a0;">No betting history yet</div>',
                'emptyTextOptions' => ['class' => ''],
            ]); ?>
    </div>
</div>
