<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\search\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id', ['options' => ['class' => 'col-lg-2']]) ?>

    <?php echo $form->field($model, 'username', ['options' => ['class' => 'col-lg-3']]) ?>

    <?php // echo $form->field($model, 'role_id', ['options' => ['class' => 'col-lg-2']]) ?>

    <?php echo $form->field($model, 'status', ['options' => ['class' => 'col-lg-3']]) ?>

    <?php echo $form->field($model, 'email', ['options' => ['class' => 'col-lg-3']]) ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'access_token') ?>

    <?php // echo $form->field($model, 'logged_in_ip') ?>

    <?php // echo $form->field($model, 'logged_in_at') ?>

    <?php // echo $form->field($model, 'created_ip') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'banned_at') ?>

    <?php // echo $form->field($model, 'banned_reason') ?>

    <div class="col-lg-3">
        <?= Html::submitButton(Yii::t('user', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('user', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
