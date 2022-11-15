<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 * @var amnah\yii2\user\models\Role $role
 * @var yii\widgets\ActiveForm $form
 */

$module = $this->context->module;
$role = $module->model("Role");
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($user, 'email', ['options' => ['class' => 'col-lg-6']])->textInput(['maxlength' => 255]) ?>

    <?= $form->field($profile, 'full_name', ['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($user, 'username', ['options' => ['class' => 'col-lg-6']])->textInput(['maxlength' => 255]) ?>

    <?= $form->field($user, 'newPassword', ['options' => ['class' => 'col-lg-6']])->passwordInput() ?>

    <?= $form->field($profile, 'money', ['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($user, 'role_id', ['options' => ['class' => 'col-lg-6']])->dropDownList($role::dropdown()); ?>

    <?= $form->field($user, 'status', ['options' => ['class' => 'col-lg-6']])->dropDownList($user::statusDropdown()); ?>
    <?= $form->field($user, 'banned_reason', ['options' => ['class' => 'col-lg-6']]); ?>

    <?php // use checkbox for banned_at ?>
    <?php // convert `banned_at` to int so that the checkbox gets set properly ?>
    <?php $user->banned_at = $user->banned_at ? 1 : 0 ?>
    <?= Html::activeLabel($user, 'banned_at', ['label' => Yii::t('user', 'Banned')]); ?>
    <?= Html::activeCheckbox($user, 'banned_at', ['label' => '']); ?>
    <?= Html::error($user, 'banned_at'); ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
