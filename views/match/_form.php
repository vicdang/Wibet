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

    <?= $form->field($model, 'match_date')->widget(DateTimePicker::className(), [
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => true,
        'clientOptions' => [
            'startView' => 1,
            'autoclose' => true,
            'linkFormat' => 'HH:ii P', // if inline = true
            'format' => 'yyyy-mm-dd hh:ii:ss', // if inline = false
            'showMeridian' => true,
            'pickerPosition' => "bottom-left",
            'minuteStep' => 15,
            'startDate' => date('Y-m-d H:i:s'),
            'todayBtn' => true,
        ]
    ]);?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group btn-container">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
