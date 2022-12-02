<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 */

$this->title = $match->getMatchTitle();
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['/match/index']];
$this->params['breadcrumbs'][] = ['label' => $match->getMatchTitle(), 'url' => ['/match/view', 'id' => $match->id]];
$this->params['breadcrumbs'][] = "View All Bets";
?>
<div class="bet-view">
    <h3>View all bets </h3>
    <h1><?= $match->getMatchName() ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'label' => 'Username',
                'value' => function($model, $index, $dataColumn) {
                        return $model->user->username;
                    }
            ],
            // [
            //     'label' => 'Fullname',
            //     'value' => function($model, $index, $dataColumn) {
            //             return $model->user->profile->full_name;
            //         }
            // ],
            [
                'attribute' => 'option',
                'value' => function($model, $index, $dataColumn) {
                        return $model->option == 1 ? $model->match->team1->full_name : $model->match->team2->full_name;
                    }
            ],
            'money',
            [
                'attribute' => 'created_time',
                'label' => 'Bet Time',
                'headerOptions' => [
                    'width' => '220',
                ],
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->created_time, "%b %d, %Y %I:%M %p");
                    }
            ],
            [
                'label' => 'Result',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    switch ($model->getBettedResult()) {
                        case 'WIN':
                            return '<span class="badge badge-pill badge-success">W</span>';
                        case 'LOSE':
                            return '<span class="badge badge-pill badge-danger">L</span>';
                            break;
                        case 'DRAW':
                            return '<span class="badge badge-pill badge-warning">D</span>';
                        default:
                            return '<span class="badge badge-pill badge-secondary">&nbsp;Canceled&nbsp;</span>';
                    }
               
                },
                'visible' => !is_null($match->result)
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
