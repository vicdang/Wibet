<?php

use yii\helpers\Html;
use yii\grid\GridView;
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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="btn-container" style="display:flex;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:12px;">
        <span>
            <?= Html::a(Yii::t('user', 'Create {modelClass}', [
            'modelClass' => 'User',
            ]), ['create'], ['class' => 'btn btn-primary']) ?>
        </span>
        <span>
            <a class="btn btn-primary" role="button" href="update-hide-history?value=<?= $hide_history == '1' ? '0' : '1' ?>"><?= $hide_history == '1' ? 'Show history' : 'Hide history' ?></a>
        </span>
        <span style="margin-left:auto;display:flex;align-items:center;gap:10px;">
            <?php
                $isProduction = ($activeDb === 'production');
                $badgeColor   = $isProduction ? '#d9534f' : '#f0ad4e';
                $badgeLabel   = $isProduction ? 'PRODUCTION' : 'STAGING';
                $switchTarget = $isProduction ? 'staging' : 'production';
                $switchLabel  = $isProduction ? 'Switch to Staging' : 'Switch to Production';
                $switchColor  = $isProduction ? '#f0ad4e' : '#d9534f';
            ?>
            <span style="background:<?= $badgeColor ?>;color:#fff;font-weight:bold;padding:5px 14px;border-radius:4px;font-size:13px;letter-spacing:1px;">
                DB: <?= $badgeLabel ?>
            </span>
            <a href="<?= \yii\helpers\Url::to(['switch-db', 'db' => $switchTarget]) ?>"
               style="background:<?= $switchColor ?>;color:#fff;font-weight:bold;padding:5px 14px;border-radius:4px;font-size:13px;text-decoration:none;"
               onclick="return confirm('Switch database to <?= $switchTarget ?>?')">
                <?= $switchLabel ?>
            </a>
        </span>
    </div>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => '-',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'label' => 'UID',
                'headerOptions' => [
                    'width' => '30',
                ],
            ],
            [
                'attribute' => 'username',
                'label' => 'User',
            ],
            [
                'attribute' => 'role_id',
                'label' => Yii::t('user', 'Role'),
                'filter' => $role::dropdown(),
                'value' => function($model, $index, $dataColumn) use ($role) {
                    $roleDropdown = $role::dropdown();
                    return $roleDropdown[$model->role_id];
                },
            ],
            [
                'attribute' => 'status',
                'label' => Yii::t('user', 'Status'),
                'filter' => $user::statusDropdown(),
                'value' => function($model, $index, $dataColumn) use ($user) {
                    $statusDropdown = $user::statusDropdown();
                    return $statusDropdown[$model->status];
                },
                'headerOptions' => [
                    'width' => '50',
                ],
            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
            ],
            [
                'attribute' => 'profile.full_name',
                'label' => 'Name',
            ],
            [
                'attribute' => 'profile.money',
                'label' => 'Coin',
            ],
            // 'profile.timezone',
            // 'created_at',
            // 'username',
            // 'password',
            // 'auth_key',
            // 'access_token',
            // 'logged_in_ip',
            [
                'attribute' => 'logged_in_at',
                'label' => 'Login',
            ],
            // 'created_ip',
            // 'updated_at',
            'banned_at',
            // 'banned_reason',
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
    
</div>

