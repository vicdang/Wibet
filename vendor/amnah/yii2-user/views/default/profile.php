<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use amnah\yii2\user\helpers\Timezone;
use yii\grid\GridView;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-profile">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($profile, 'full_name') ?>

    <?php
    // by default, this contains the entire php timezone list of 400+ entries
    // so you may want to set up a fancy jquery select plugin for this, eg, select2 or chosen
    // alternatively, you could use your own filtered list
    // a good example is twitter's timezone choices, which contains ~143  entries
    // @link https://twitter.com/settings/account
    ?>
    <?= $form->field($profile, 'timezone')->dropDownList(ArrayHelper::map(Timezone::getAll(), 'identifier', 'name')); ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<hr>
<div>
    <?= GridView::widget([
        'dataProvider' => $dataHistory,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'team_1_name',
                'label' => 'Team 1'
            ],
            [
                'attribute' => 'team_2_name',
                'label' => 'Team 2'
            ],
            'rate',
            'result',
            'option',
            [
                'attribute' => 'money',
                'label' => 'Placed'
            ],
            [
                'label' => 'Bet result',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model['result'] != NULL){
                        if($model['result'] == $model['option']){
                            return '<span class="badge badge-pill badge-success"><span class="glyphicon glyphicon-triangle-top"></span></span>';
                        }else{
                            if($model['result'] == 0){
                                return '<span class="badge badge-pill badge-warning"><span class="glyphicon glyphicon-minus"></span></span>';
                            }else if($model['result'] == 3){
                                return '<span class="badge badge-pill badge-secondary"><span class="glyphicon glyphicon-remove"></span></span>';
                            }else{
                                return '<span class="badge badge-pill badge-danger"><span class="glyphicon glyphicon-triangle-bottom"></span></span>';
                            }
                        }
                    }else{
                        return '<span class="badge badge-pill badge-info"><span class="glyphicon glyphicon-repeat"></span></span>';
                    }
                },
            ],
        ],
    ]);
    ?>
</div>

