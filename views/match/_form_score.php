<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $this->registerJs("
    var \$divResult = $('#hidden-wrapper');
    $('#auto-result').change(function(){
        if ($(this).is(':checked')) {
            \$divResult.css('display', 'none');
            $(this).val(1);
        } else {
            \$divResult.css('display', 'block');
            $(this).val(0);
        }
    });

", \yii\web\View::POS_END); ?>

<div class="match-form">

    <?php $form = ActiveForm::begin([
        'beforeSubmit' => new \yii\web\JsExpression('function($form) {
            if (confirm("Are you sure ?")) {
                $form.find(":submit").attr("disabled", true);
                return true;
            }
            return false;
        }'),
    ]); ?>

    <div class="alert alert-warning">
        <p><b>Note:</b> After you update score of this match, you cannot update this match anymore.</p>
    </div>

    <?= $form->field($model, 'team_1_score')->textInput()->label($model->team1->full_name) ?>

    <?= $form->field($model, 'team_2_score')->textInput()->label($model->team2->full_name) ?>

    <div class="form-group">
        <label style="font-weight: normal">
            <input id="auto-result" name="auto_result" type="checkbox" value="1" checked="checked" />
        Auto generate the bet result of this match.</label>
    </div>

    <div id="hidden-wrapper" style="display: none">
        <?= $form->field($model, 'result', [
                /*'options'=> [
                    'id' => 'result-wrapper',
                    'style' => 'display: none'
                ]*/
            ])->dropDownList([
                0 => 'Draw',
                1 => $model->team_1,
                2 => $model->team_2,
            ])->label('Bet result'); ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update Score',[
                'class' => 'btn btn-primary'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
