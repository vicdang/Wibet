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
                'label' => 'User',
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
            [
                'attribute' => 'money',
                'value' => 'money'
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
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    switch ($model->getBettedResult()) {
                        case 'WIN':
                            return '<span class="badge badge-pill badge-success"><span class="glyphicon glyphicon-triangle-top"></span></span>';
                        case 'LOSE':
                            return '<span class="badge badge-pill badge-danger"><span class="glyphicon glyphicon-triangle-bottom"></span></span>';
                            break;
                        case 'DRAW':
                            return '<span class="badge badge-pill badge-warning"><span class="glyphicon glyphicon-minus"></span></span>';
                        default:
                            return '<span class="badge badge-pill badge-secondary"><span class="glyphicon glyphicon-remove"></span></span>';
                    }
               
                },
                'visible' => !is_null($match->result)
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                            'title' => Yii::t('app', 'Delete this bet?'),
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to DELETE this bet ?',
                                'method' => 'post'
                            ]
                        ]);
                    }
                ],
                'headerOptions' => [
                    'width' => '50'
                ],
                'visible' => Yii::$app->user->can('admin')
            ],
        ],
    ]); ?>

</div>
