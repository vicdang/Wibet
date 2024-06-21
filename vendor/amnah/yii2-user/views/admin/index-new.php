<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\search\UserSearch $searchModel
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Role $role
 */

$module = $this->context->module;
$user = $module->model("User");
$role = $module->model("Role");

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="btn-container">
        <span>
            <?= Html::a(Yii::t('user', 'Create {modelClass}', [
                'modelClass' => 'User',
            ]), ['create'], ['class' => 'btn btn-primary']) ?>
        </span>
        <span>
            <a class="btn btn-primary" role="button" href="update-hide-history?value=<?= $hide_history == '1' ? '0' : '1' ?>"><?= $hide_history == '1' ? 'Show history' : 'Hide history' ?></a>
        </span>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['index'], // ensure this points to the correct action
        'options' => ['data-pjax' => true],
    ]); ?>
    
    <?= $form->field($searchModel, 'username') ?>
    <?= $form->field($searchModel, 'role_id')->dropDownList($role::dropdown(), ['prompt' => 'Select Role']) ?>
    <?= $form->field($searchModel, 'status')->dropDownList($user::statusDropdown(), ['prompt' => 'Select Status']) ?>
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'user/_item', // path to the custom item view
        'layout' => "{summary}\n{items}\n{pager}",
    ]); ?>
    <?php Pjax::end(); ?>

</div>
