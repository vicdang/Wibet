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
        1 => $match->team1->full_name,
        2 => $match->team2->full_name,
    ]) ?>

    <?= $form->field($model, 'money')->textInput(['min'=>Yii::$app->params['minBetMoney'], 'type'=>"number"]) ?>

    <div class="form-group btn-container">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
