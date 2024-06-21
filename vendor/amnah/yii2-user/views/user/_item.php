<?php
use yii\helpers\Html;

/* @var $model amnah\yii2\user\models\User */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($model->username) ?></h3>
    </div>
    <div class="panel-body">
        <p><strong><?= Yii::t('user', 'Role') ?>:</strong> <?= Html::encode($role::dropdown()[$model->role_id]) ?></p>
        <p><strong><?= Yii::t('user', 'Status') ?>:</strong> <?= Html::encode($user::statusDropdown()[$model->status]) ?></p>
        <p><strong><?= Yii::t('user', 'Email') ?>:</strong> <?= Html::encode($model->email) ?></p>
        <p><strong><?= Yii::t('user', 'Name') ?>:</strong> <?= Html::encode($model->profile->full_name) ?></p>
        <p><strong><?= Yii::t('user', 'Coin') ?>:</strong> <?= Html::encode($model->profile->money) ?></p>
        <p><strong><?= Yii::t('user', 'Login') ?>:</strong> <?= Yii::$app->formatter->asDatetime($model->logged_in_at) ?></p>
        <p><strong><?= Yii::t('user', 'Banned At') ?>:</strong> <?= $model->banned_at ? Yii::$app->formatter->asDatetime($model->banned_at) : Yii::t('app', 'Not Banned') ?></p>
        <div>
            <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
