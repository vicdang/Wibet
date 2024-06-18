<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var amnah\yii2\user\models\User $user
 */

$this->title = "View All Bets";
$this->params['breadcrumbs'][] = ['label' => 'Ranking', 'url' => ['/user/ranking']];
$this->params['breadcrumbs'][] = $user->email;
?>
<div class="bet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'match_id',
                'label' => 'Match',
                'value' => function($model, $index, $dataColumn) {
                        return $model->match->getMatchName();
                    }
            ],
            [
                'label' => 'Matchdate',
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->match->match_date, "%b %d, %Y %H:%M");
                    }
            ],
            [
                'attribute' => 'option',
                'value' => function($model, $index, $dataColumn) {
                        return $model->getBettingOption();
                    }
            ],
            [
                'attribute' => 'money',
                'value' => 'Coin'
            ],
            [
                'attribute' => 'created_time',
                'label' => 'Bet Time',
                'headerOptions' => [
                    'width' => '220',
                ],
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->created_time, "%b %d, %Y %H:%M");
                    }
            ],
            [
                'label' => 'Result',
                'value' => function($model, $index, $dataColumn) {
                        return $model->getBettedResult();
                    },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'headerOptions' => [
                    'width' => '25'
                ],
                'visible' => Yii::$app->user->can('admin')
            ],
        ],
    ]); ?>

</div>