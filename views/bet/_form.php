<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="bet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'option')->dropDownList([
        '' => '',
        1 => $match->team_1,
        2 => $match->team_2,
    ]) ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <div class="form-group btn-container">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
