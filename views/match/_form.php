<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;


/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'team_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'match_date')->textInput(['type'=>'datetime-local']) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group btn-container">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
